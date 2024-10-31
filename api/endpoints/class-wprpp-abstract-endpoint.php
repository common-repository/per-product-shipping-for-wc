<?php

namespace PerProduct\Api\Endpoints;

use PerProduct\Api\Endpoints\Errors\WPRPP_Errors_Factory;
use PerProduct\Api\Endpoints\Errors\WPRPP_Generic_Error;


abstract class WPRPP_Abstract_Endpoint {

	const PER_PRODUCT_RULES_KEY = '_per_product_rules';

	public function __construct()
	{
		add_action('wp_ajax_' . $this->action(), [$this, 'process']);
	}

	public function process()
	{

		check_ajax_referer( $this->action(), '_ajax_nonce' );

		$data = json_decode(file_get_contents('php://input'), true);

		$response = $this->callback($data);

		echo json_encode($response);
		exit;
	}

	/**
	 * @param array|string $errors
	 */
	protected function abort($errors)
	{
		$errorsMessages = [];

		if (is_array($errors)) {
			foreach($errors as $error) {
				if (isset($error['code']) || isset($error['error_code'])) {
					$errorsMessages[] = WPRPP_Errors_Factory::make($error)->error_message();
				}
			}
		} else {
			$errorsMessages = [$errors];
		}

		if ($errors === []) {
			$errorsMessages[] = (new WPRPP_Generic_Error([]))->error_message();
		}

		echo json_encode(['errors' => $errorsMessages]);
		exit;
	}

	protected function ok()
	{
		echo json_encode(['success' => true]);
		exit;
	}

	protected function sanitize_array($data)
	{
		return array_map(function($value) {
			if (is_array($value)) {
				return $this->sanitize_array($value);
			}

			return sanitize_text_field($value);

		}, $data);
	}

	/**
	 * @param mixed
	 * @return array
	 */
	public abstract function callback($data);

	/**
	 * @return string
	 */
	public abstract function action();

}
