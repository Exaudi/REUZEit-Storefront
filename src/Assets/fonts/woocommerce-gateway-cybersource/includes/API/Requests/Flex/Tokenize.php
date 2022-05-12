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

namespace SkyVerge\WooCommerce\Cybersource\API\Requests\Flex;

use SkyVerge\WooCommerce\Cybersource\API\Helper;
use SkyVerge\WooCommerce\Cybersource\API\Request;

defined( 'ABSPATH' ) or exit;

class Tokenize extends Request {


	/**
	 * Tokenize constructor.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {

		$this->path = '/flex/v1/tokens';
	}


	/**
	 * Tokenizes a card.
	 *
	 * @since 2.0.0
	 *
	 * @param string $key_id Flex key ID
	 * @param \WC_Order $order order object
	 */
	public function tokenize_card( $key_id, \WC_Order $order ) {

		$this->order  = $order;
		$this->method = 'POST';

		$this->data = [
			'keyId'    => $key_id,
			'cardInfo' => [
				'cardNumber'          => $order->payment->account_number,
				'cardExpirationMonth' => $order->payment->exp_month,
				'cardExpirationYear'  => '20' . $order->payment->exp_year,
				'cardType'            => Helper::convert_card_type_to_code( $order->payment->card_type ),
			],
		];
	}


	/**
	 * Gets the string representation of this request with all sensitive information masked.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function to_string_safe() {

		$string = $this->to_string();
		$data   = $this->get_data();

		// card number
		if ( isset( $data['cardInfo']['cardNumber'] ) ) {

			$number = $data['cardInfo']['cardNumber'];

			$string = str_replace( $number, str_repeat( '*', strlen( $number ) - 4 ) . substr( $number, -4 ), $string );
		}

		return $string;
	}


}
