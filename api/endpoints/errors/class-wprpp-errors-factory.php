<?php

namespace PerProduct\Api\Endpoints\Errors;


class WPRPP_Errors_Factory {

	/**
	 * @param $error
	 * @return Error
	 */
	public static function make($error)
	{
		return new Generic_Error($error);
	}

}
