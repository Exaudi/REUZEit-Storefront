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

use SkyVerge\WooCommerce\Cybersource\API\Response;

defined( 'ABSPATH' ) or exit;

/**
 * CyberSource API Key Generation Response Class
 *
 * Provides common functionality to Credit Card & other transaction response classes
 *
 * @since 2.0.0
 */
class Key_Generation extends Response {


	/**
	 * Gets the generated key ID.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function get_key_id() {

		return ! empty( $this->response_data->keyId ) ? $this->response_data->keyId : '';
	}


	/**
	 * Gets the response JWK array.
	 *
	 * @since 2.0.0
	 *
	 * @return array
	 */
	public function get_jwk_array() {

		$jwk_array = [];

		if ( ! empty( $this->response_data->jwk ) ) {

			$jwk = $this->response_data->jwk;

			$jwk_array = [
				'kty' => $jwk->kty,
				'kid' => $jwk->kid,
				'use' => $jwk->use,
				'n'   => $jwk->n,
				'e'   => $jwk->e,
			];
		}

		return $jwk_array;
	}


}
