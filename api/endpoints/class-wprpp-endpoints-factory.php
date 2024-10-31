<?php

namespace PerProduct\Api\Endpoints;


class WPRPP_Endpoints_Factory {

	public static function boot()
	{
		foreach (self::available_endpoints() as $endpoint)
		{
			if (class_exists($endpoint)) {
				new $endpoint();
			}
		}
	}

	/**
	 * @param string $endpoint
	 *
	 * @return array|string
	 */
	public static function get_endpoints_nonce ($endpoint = '') {

		if ($endpoint !== '') {
			if (class_exists($endpoint)) {
				/** @var WPRPP_Abstract_Endpoint $endpoint */
				$endpointClass = new $endpoint();
				return wp_create_nonce( $endpointClass->action() );
			}
		}

		$nonce = [];
		foreach (self::available_endpoints() as $endpoint) {
			/** @var WPRPP_Abstract_Endpoint $endpoint */
			$endpointClass = new $endpoint();
			$nonce[$endpointClass->action()] = wp_create_nonce( $endpointClass->action() );
		}

		return $nonce;
	}

	/**
	 * @return string[]
	 */
	public static function available_endpoints() {
		return [
			WPRPP_Search_Products_Endpoint::class,
			WPRPP_Create_Rule_Endpoint::class,
			WPRPP_Load_Rules_Endpoint::class,
			WPRPP_Delete_Rule_Endpoint::class,
			WPRPP_Update_Rule_Endpoint::class,
			WPRPP_Sort_Rules_Endpoint::class,
		];
	}

}
