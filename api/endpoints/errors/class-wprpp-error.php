<?php
namespace PerProduct\Api\Endpoints\Errors;


abstract class WPRPP_Error {

	protected $code;
	protected $message;
	protected $field;

	/**
	 * Error constructor.
	 *
	 * @param $error
	 */
	public function __construct($error) {

		if (isset($error['code'])) {
			$this->code = $error['code'];
		}

		if (isset($error['message'])) {
			$this->message = $error['message'];
		}

		if (isset($error['field'])) {
			$this->field = $error['field'];
		}
	}


	/**
	 * @return string
	 */
	abstract public function error_message();
}
