<?php

namespace PerProduct\Api\Endpoints;

class WPRPP_Delete_Rule_Endpoint extends WPRPP_Abstract_Endpoint {

	public function callback( $data )
	{
		$this->validate($data);

		$rules = get_option(self::PER_PRODUCT_RULES_KEY);

		if (isset($rules[$data['id']])) {
			array_splice($rules, intval($data['id']), 1);
		}

		update_option(self::PER_PRODUCT_RULES_KEY, $rules);

		$this->ok();
	}

	public function action()
	{
		return 'per_product_delete_rule';
	}

	private function validate( $data )
	{
		if (!isset($data['id'])) {
			$this->abort('[id] is required');
		}

		if (intval($data['id']) < 0) {
			$this->abort('[id] must be a number');
		}
	}
}
