<?php


namespace PerProduct\Api\Endpoints\Errors;


class WPRPP_Generic_Error extends WPRPP_Error
{

	/**
	 * @return mixed
	 */
	public function error_message() {
		return $this->message;
	}
}
