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

namespace SkyVerge\WooCommerce\Cybersource\API\Responses\Flex;

use SkyVerge\WooCommerce\Cybersource\API\Helper;
use SkyVerge\WooCommerce\Cybersource\API\Responses;
use \CyberSource\Model as SDK;
use SkyVerge\WooCommerce\PluginFramework\v5_7_1\SV_WC_Payment_Gateway_API_Create_Payment_Token_Response;

defined( 'ABSPATH' ) or exit;

/**
 * Class Tokenize
 *
 * @method SDK\InlineResponseDefault|SDK\FlexV1TokensPost200Response get_response_object()
 */
class Tokenize extends Responses\Payment_Token implements SV_WC_Payment_Gateway_API_Create_Payment_Token_Response {


	/** @var \WC_Order $order order object */
	protected $order;


	/**
	 * Payment_Instruments constructor.
	 *
	 * @since 2.0.0
	 *
	 * @param string $raw_response_json raw response data
	 */
	public function __construct( $raw_response_json ) {

		parent::__construct( $raw_response_json );

		if ( ! empty( $this->response_data->_embedded->icsReply->instrumentIdentifier ) ) {
			$this->response_data->instrumentIdentifier = $this->response_data->_embedded->icsReply->instrumentIdentifier;
		}
	}


	/**
	 * Gets the tokenized ID.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_token_id() {

		return ! empty( $this->response_data->token ) ? $this->response_data->token : '';
	}


	/**
	 * Gets the returned card type.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_type() {

		return Helper::convert_code_to_card_type( ! empty( $this->response_data->cardType ) ? $this->response_data->cardType : '' );
	}


	/**
	 * Gets the returned masked PAN.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_account_number() {

		return ! empty( $this->response_data->maskedPan ) ? $this->response_data->maskedPan : '';
	}


	/**
	 * Gets the card expiration month.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_expiry_month() {

		return ! empty( $this->order->payment->exp_month ) ? $this->order->payment->exp_month : '';
	}


	/**
	 * Gets the card expiration year.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_expiry_year() {

		return ! empty( $this->order->payment->exp_year ) ? $this->order->payment->exp_year : '';
	}


	/**
	 * Gets the response status message, or null if there is no status message
	 * associated with this transaction.
	 *
	 * @since 2.0.0
	 *
	 * @return string status message
	 */
	public function get_status_message() {

		$status  = $this->get_status();
		$details = [];
		$message = '';

		if ( $status && ! empty( $status->details ) && is_array( $status->details ) ) {

			foreach ( $status->details as $detail ) {
				$details[] = ! empty( $detail->message ) ? $detail->message : '';
			}

			$message = ! empty( $details ) ? implode( '. ', array_filter( $details ) ) : $status->message;
		}

		return $message;
	}


	/**
	 * Gets the response status code, or null if there is no status code
	 * associated with this transaction.
	 *
	 * @since 2.0.0
	 *
	 * @return string status code
	 */
	public function get_status_code() {

		return ! empty( $this->get_status()->reason ) ? $this->get_status()->reason : '';
	}


	/**
	 * Gets the response status (in case of errors).
	 *
	 * @since 2.0.0
	 *
	 * @return \stdClass|null
	 */
	public function get_status() {

		return ! empty( $this->response_data->responseStatus ) ? $this->response_data->responseStatus : null;
	}


	/**
	 * Gets the payment type.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_payment_type() {

		return 'credit_card';
	}


	/**
	 * Gets the transaction ID.
	 *
	 * @since 2.0.0
	 */
	public function get_transaction_id() {}


	/**
	 * Sets the order object for this response.
	 *
	 * @since 2.0.0
	 *
	 * @param \WC_Order $order order object
	 */
	public function set_order( \WC_Order $order ) {

		$this->order = $order;
	}


}
