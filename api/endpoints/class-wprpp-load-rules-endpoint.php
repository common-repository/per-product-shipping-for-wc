<?php
namespace PerProduct\Api\Endpoints;

class WPRPP_Load_Rules_Endpoint extends WPRPP_Abstract_Endpoint
{

	public function callback( $data )
	{

		$rules = get_option(self::PER_PRODUCT_RULES_KEY);

		if (!$rules) {
			return ['rules' => []];
		}

		return ['rules' => $rules];
	}

	public function action()
	{
		return 'per_product_load_rules';
	}

}
