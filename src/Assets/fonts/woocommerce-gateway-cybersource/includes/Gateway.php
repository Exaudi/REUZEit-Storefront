<?php
/**
 * WooCommerce CyberSource
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce CyberSource to newer
 * versions in the future. If you wish to customize WooCommerce CyberSource for your
 * needs please refer to http://docs.woocommerce.com/document/cybersource-payment-gateway/
 *
 * @author      SkyVerge
 * @copyright   Copyright (c) 2012-2020, SkyVerge, Inc. (info@skyverge.com)
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

namespace SkyVerge\WooCommerce\Cybersource;

use SkyVerge\WooCommerce\Cybersource\Gateway\Base_Payment_Form;
use SkyVerge\WooCommerce\PluginFramework\v5_7_1 as Framework;

defined( 'ABSPATH' ) or exit;

/**
 * CyberSource Base Gateway Class
 *
 * @since 2.0.0
 */
abstract class Gateway extends Framework\SV_WC_Payment_Gateway_Direct {


	/** @var string the flex form feature */
	const FEATURE_FLEX_FORM = 'flex_form';


	/** @var string production merchant ID */
	protected $merchant_id;

	/** @var string production API key */
	protected $api_key;

	/** @var string production API shared secret */
	protected $api_shared_secret;

	/** @var string Token Management Service profile ID */
	protected $tokenization_profile_id;

	/** @var string test merchant ID */
	protected $test_merchant_id;

	/** @var string test API key */
	protected $test_api_key;

	/** @var string test API shared secret */
	protected $test_api_shared_secret;

	/** @var string test Token Management Service profile ID */
	protected $test_tokenization_profile_id;

	/** @var string whether the flex form is enabled */
	protected $enable_flex_form;

	/** @var API instance */
	protected $api;

	/** @var array shared settings names */
	protected $shared_settings_names = [ 'merchant_id', 'api_key', 'api_shared_secret', 'test_merchant_id', 'test_api_key', 'test_api_shared_secret', 'tokenization_profile_id' ];


	/**
	 * Enqueues the gateway assets.
	 *
	 * @since 2.1.0
	 */
	protected function enqueue_gateway_assets() {

		// bail if on my account page and *not* on add payment method page
		if ( is_account_page() && ! is_add_payment_method_page() ) {
			return;
		}

		parent::enqueue_gateway_assets();
	}


	/**
	 * Initializes the payment form instance.
	 *
	 * @since 2.1.0
	 *
	 * @return Base_Payment_Form
	 */
	protected function init_payment_form_instance() {

		return new Base_Payment_Form( $this );
	}


	/** Admin settings methods ************************************************/


	/**
	 * Returns an array of form fields specific for this method.
	 *
	 * @see SV_WC_Payment_Gateway::get_method_form_fields()
	 *
	 * @since 2.0.0
	 *
	 * @return array of form fields
	 */
	protected function get_method_form_fields() {

		$fields = [

			// production
			'merchant_id' => [
				'title'    => __( 'Merchant ID', 'woocommerce-gateway-cybersource' ),
				'type'     => 'text',
				'class'    => 'environment-field production-field',
				'desc_tip' => __( 'The Merchant ID for your CyberSource account.', 'woocommerce-gateway-cybersource' ),
			],

			'api_key' => [
				'title'    => __( 'API Key Detail', 'woocommerce-gateway-cybersource' ),
				'type'     => 'text',
				'class'    => 'environment-field production-field',
				'desc_tip' => __( 'The API key ID for your CyberSource account.', 'woocommerce-gateway-cybersource' ),
			],

			'api_shared_secret' => [
				'title'    => __( 'API Shared Secret Key', 'woocommerce-gateway-cybersource' ),
				'type'     => 'password',
				'class'    => 'environment-field production-field',
				'desc_tip' => __( 'The API shared secret key for your CyberSource account.', 'woocommerce-gateway-cybersource' ),
			],

			// test
			'test_merchant_id' => [
				'title'    => __( 'Test Merchant ID', 'woocommerce-gateway-cybersource' ),
				'type'     => 'text',
				'class'    => 'environment-field test-field',
				'desc_tip' => __( 'The Merchant ID for your CyberSource sandbox account.', 'woocommerce-gateway-cybersource' ),
			],

			'test_api_key' => [
				'title'    => __( 'Test API Key Detail', 'woocommerce-gateway-cybersource' ),
				'type'     => 'text',
				'class'    => 'environment-field test-field',
				'desc_tip' => __( 'The API key ID for your CyberSource sandbox account.', 'woocommerce-gateway-cybersource' ),
			],

			'test_api_shared_secret' => [
				'title'    => __( 'Test API Shared Secret Key', 'woocommerce-gateway-cybersource' ),
				'type'     => 'password',
				'class'    => 'environment-field test-field',
				'desc_tip' => __( 'The API shared secret key for your CyberSource sandbox account.', 'woocommerce-gateway-cybersource' ),
			],
		];

		if ( $this->supports_flex_form() ) {

			$fields['enable_flex_form'] = [
				'title'   => __( 'Flex Microform', 'woocommerce-gateway-cybersource' ),
				'label'   => __( 'Use Flex Microform (a hosted form field) to collect payment information on checkout and reduce PCI-compliance assessment scope.', 'woocommerce-gateway-cybersource' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			];
		}

		// if it was migrated from legacy or SOP (if either option exist, regardless of value),
		// add a button to migrate historical orders
		$migrated        = get_option( 'wc_' . $this->get_plugin()->get_id() . '_legacy_active', false ) ||
		                   get_option( 'wc_' . $this->get_plugin()->get_id() . '_migrated_from_sop', false );
		$orders_migrated = get_option( 'wc_' . $this->get_id() . '_legacy_orders_migrated', false );

		if ( $migrated && ! $orders_migrated ) {

			$fields['migrate_legacy_orders'] = [
				'title' => __( 'Migrate historical orders', 'woocommerce-gateway-cybersource' ),
				'type'  => 'migrate_orders_button',
			];

		}

		return $fields;
	}


	/**
	 * Adds the tokenization feature form fields for gateways that support it.
	 *
	 * @since 2.0.0
	 *
	 * @param array $form_fields form fields
	 * @return array
	 */
	protected function add_tokenization_form_fields( $form_fields ) {

		$form_fields = parent::add_tokenization_form_fields( $form_fields );

		$form_fields['tokenization_profile_id'] = array(
			'title'       => __( 'Tokenization Profile ID', 'woocommerce-gateway-cybersource' ),
			'description' => __( 'Your Token Management Server profile ID, provided by CyberSource.', 'woocommerce-gateway-cybersource' ),
			'type'        => 'text',
			'class'       => 'environment-field production-field profile-id-field',
			'placeholder' => 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX',
		);

		$form_fields['test_tokenization_profile_id'] = array(
			'title'       => __( 'Tokenization Profile ID', 'woocommerce-gateway-cybersource' ),
			'description' => __( 'Your Token Management Server profile ID, provided by CyberSource.', 'woocommerce-gateway-cybersource' ),
			'type'        => 'text',
			'class'       => 'environment-field test-field profile-id-field',
			'placeholder' => 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX',
		);

		return $form_fields;
	}


	/**
	 * Displays the admin options.
	 *
	 * Overridden to add a little extra JS for toggling dependant settings.
	 *
	 * @since 2.0.0
	 */
	public function admin_options() {

		parent::admin_options();

		if ( isset( $this->form_fields['tokenization'] ) ) {

			// add inline javascript to show/hide any shared settings fields as needed
			ob_start(); ?>

			$( '#woocommerce_<?php echo esc_js( $this->get_id() ); ?>_tokenization' ).change( function() {

				var enabled     = $( this ).is( ':checked' );
				var environment = $( '#woocommerce_<?php echo esc_js( $this->get_id() ); ?>_environment' ).val()

				if ( enabled ) {
					$( '.profile-id-field.' + environment + '-field' ).closest( 'tr' ).show();
				} else {
					$( '.profile-id-field.' + environment + '-field' ).closest( 'tr' ).hide();
				}

			} ).change();

			<?php

			wc_enqueue_js( ob_get_clean() );
		}
	}


	/**
	 * Generates a "Migrate historical orders" button.
	 *
	 * @since 2.0.0
	 *
	 * @param string $key the field key
	 * @param array $data the field params
	 * @return false|string
	 */
	public function generate_migrate_orders_button_html( $key, $data ) {

		$data = wp_parse_args( $data, [
			'title'       => '',
			'class'       => '',
			'description' => '',
		] );

		$migrate_button_text = __( 'Update records', 'woocommerce-gateway-cybersource' );
		$disabled_text       = __( 'Please save your API credentials before migrating your historical orders', 'woocommerce-gateway-cybersource' );

		if ( $this->get_plugin()->is_subscriptions_active() ) {
			$migrate_text      = __( 'Migrate orders and subscriptions to use this gateway instead of the legacy CyberSource plugin', 'woocommerce-gateway-cybersource' );
			$confirmation_text = __( 'This action will update the payment method on historical orders and subscriptions to use the new CyberSource gateway. This allows you to capture existing payments or process refunds for historical transactions. For subscription records with manual renewals, this will not enable automatic renewals, as customers need to save a payment method first.', 'woocommerce-gateway-cybersource' );
		} else {
			$migrate_text      = __( 'Migrate orders to use this gateway instead of the legacy CyberSource plugin', 'woocommerce-gateway-cybersource' );
			$confirmation_text = __( 'This action will update the payment method on historical orders to use the new CyberSource gateway. This allows you to capture existing payments or process refunds for historical transactions.', 'woocommerce-gateway-cybersource' );
		}

		wp_enqueue_script( 'wc-cybersource-admin', $this->get_plugin()->get_plugin_url() . '/assets/js/admin/wc-cybersource-admin.min.js', [ 'jquery' ], $this->get_plugin()->get_version() );

		wp_localize_script( 'wc-cybersource-admin', 'wc_cybersource_admin', [
			'ajax_url'              => admin_url( 'admin-ajax.php' ),
			'migrate_nonce'         => wp_create_nonce( 'wc_cybersource_migrate_orders' ),
			'gateway_id'            => $this->get_id(),
			'confirmation_text'     => $confirmation_text,
			'migrate_disabled'      => ! $this->is_configured(),
			'migrate_disabled_text' => $disabled_text,
			'migrate_error_message' => __( 'Error executing the migration, please check the debug logs.', 'wc_cybersource_admin' ),
		] );

		ob_start();

		?>

		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $data['title'] ); ?></label>
			</th>
			<td class="forminp <?php echo esc_attr( $data['class'] ); ?>">
				<p class="description">
					<?php echo esc_html( $migrate_text ); ?>
				</p>
				<br />
				<a id="js-wc-cybersource-migrate-orders"
				   href="#"
				   class="button <?php echo ( ! $this->is_configured() ? 'disabled' : '' ); ?>">
					<?php echo esc_html( $migrate_button_text ); ?>
				</a>
				<p id="wc-cybersource-migrate-status" class="description">
					<?php if ( ! $this->is_configured() && ! empty( $disabled_text ) ): ?>
						<?php echo esc_html( $disabled_text ); ?>
					<?php endif; ?>
				</p>
			</td>
		</tr>

		<?php

		return ob_get_clean();
	}


	/**
	 * Adds transaction data to the order that's specific to this gateway.
	 *
	 * @since 2.0.0
	 *
	 * @param \WC_Order $order order object
	 * @param Framework\SV_WC_Payment_Gateway_API_Customer_Response $response API response object
	 */
	public function add_payment_gateway_transaction_data( $order, $response ) {

		if ( ! empty( $order->payment->instrument_identifier ) ) {
			$this->update_order_meta( $order, 'instrument_identifier_id', $order->payment->instrument_identifier->id );
			$this->update_order_meta( $order, 'instrument_identifier_new', $order->payment->instrument_identifier->new ? 'yes' : 'no' );
			$this->update_order_meta( $order, 'instrument_identifier_state', $order->payment->instrument_identifier->state );
		}

		// if the transaction is pending review, it could still be captured if the merchant deems it legitimate
		if ( $response instanceof API\Responses\Payments ) {

			if ( $reconciliation_id = $response->get_reconciliation_id() ) {
				$this->update_order_meta( $order, 'reconciliation_id', $reconciliation_id );
			}

			if ( $transaction_id = $response->get_processor_transaction_id() ) {
				$this->update_order_meta( $order, 'processor_transaction_id', $transaction_id );
			}

			if ( $response->transaction_held() && API\Responses\Payments\Payment::STATUS_AUTHORIZED_PENDING_REVIEW === $response->get_status_code() ) {
				$this->update_order_meta( $order, 'charge_captured', 'no' );
			}
		}
	}


	/** Tokenization methods ******************************************************************************************/


	/**
	 * Determines if tokenization is enabled.
	 *
	 * Overridden to check configuration for the Profile ID.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	public function tokenization_enabled() {

		return parent::tokenization_enabled() && $this->get_tokenization_profile_id();
	}


	/**
	 * Tokenize before sale.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	public function tokenize_before_sale() {

		return true;
	}


	/**
	 * Gets a user's customer ID.
	 *
	 * CyberSource does not support customer IDs.
	 *
	 * @since 2.0.0
	 *
	 * @param int $user_id WordPress user ID
	 * @param array $args customer ID args
	 * @return false
	 */
	public function get_customer_id( $user_id, $args = [] ) {

		return false;
	}


	/**
	 * Gets a guest customer ID.
	 *
	 * CyberSource does not support customer IDs.
	 *
	 * @since 2.0.0
	 *
	 * @param \WC_Order $order order object
	 * @return false
	 */
	public function get_guest_customer_id( \WC_Order $order ) {

		return false;
	}


	/** Getters ***************************************************************/


	/**
	 * Gets the order's transaction URL for use in the admin.
	 *
	 * @since 2.0.0
	 *
	 * @param \WC_Order $order order object
	 * @return string
	 */
	public function get_transaction_url( $order ) {

		// build the URL to the test/production environment
		if ( self::ENVIRONMENT_TEST === $this->get_order_meta( $order, 'environment' ) ) {
			$base_url = 'https://ubctest.cybersource.com/ebc2/app/TransactionManagement/details';
		} else {
			$base_url = 'https://ubc.cybersource.com/ebc2/app/TransactionManagement/details';
		}

		$this->view_transaction_url = $base_url . '?requestId=%s&merchantId=' . $this->get_merchant_id();

		return parent::get_transaction_url( $order );
	}


	/**
	 * Determines if the gateway is properly configured to perform transactions.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	public function is_configured() {

		$is_configured = parent::is_configured();

		if ( ! $this->get_merchant_id() || ! $this->get_api_key() || ! $this->get_api_shared_secret() ) {
			$is_configured = false;
		}

		return $is_configured;
	}


	/**
	 * Gets the API object.
	 *
	 * @see SV_WC_Payment_Gateway::get_api()
	 *
	 * @since 2.0.0
	 *
	 * @return API instance
	 */
	public function get_api() {

		if ( is_object( $this->api ) ) {
			return $this->api;
		}

		return $this->api = new API( $this );
	}


	/**
	 * Returns the merchant account ID based on the current environment.
	 *
	 * @since 2.0.0
	 *
	 * @param string $environment_id optional one of 'test' or 'production', defaults to current configured environment
	 * @return string
	 */
	public function get_merchant_id( $environment_id = null ) {

		if ( null === $environment_id ) {
			$environment_id = $this->get_environment();
		}

		return self::ENVIRONMENT_PRODUCTION === $environment_id ? $this->merchant_id : $this->test_merchant_id;
	}


	/**
	 * Returns the API key ID based on the current environment.
	 *
	 * @since 2.0.0
	 *
	 * @param string $environment_id optional one of 'test' or 'production', defaults to current configured environment
	 * @return string
	 */
	public function get_api_key( $environment_id = null ) {

		if ( null === $environment_id ) {
			$environment_id = $this->get_environment();
		}

		return self::ENVIRONMENT_PRODUCTION === $environment_id ? $this->api_key : $this->test_api_key;
	}


	/**
	 * Returns the API shared secret based on the current environment.
	 *
	 * @since 2.0.0
	 *
	 * @param string $environment_id optional one of 'test' or 'production', defaults to current configured environment
	 * @return string
	 */
	public function get_api_shared_secret( $environment_id = null ) {

		if ( null === $environment_id ) {
			$environment_id = $this->get_environment();
		}

		return self::ENVIRONMENT_PRODUCTION === $environment_id ? $this->api_shared_secret : $this->test_api_shared_secret;
	}


	/**
	 * Gets the Token Management Server Profile ID.
	 *
	 * @since 2.0.0
	 *
	 * @param string $environment_id optional one of 'test' or 'production', defaults to current configured environment
	 * @return string
	 */
	public function get_tokenization_profile_id( $environment_id = null ) {

		if ( null === $environment_id ) {
			$environment_id = $this->get_environment();
		}

		return self::ENVIRONMENT_PRODUCTION === $environment_id ? $this->tokenization_profile_id : $this->test_tokenization_profile_id;
	}


	/**
	 * Determines whether the flex form is enabled.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	public function is_flex_form_enabled() {

		return $this->supports_flex_form() && 'yes' === $this->enable_flex_form;
	}


	/**
	 * Determines whether the flex form is supported by this gateway.
	 *
	 * @since 2.0.0
	 *
	 * @return bool
	 */
	public function supports_flex_form() {

		return $this->supports( self::FEATURE_FLEX_FORM );
	}


}
