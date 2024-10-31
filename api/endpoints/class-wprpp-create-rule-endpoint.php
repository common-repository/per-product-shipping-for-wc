<?php
namespace PerProduct\Api\Endpoints;

class WPRPP_Create_Rule_Endpoint extends WPRPP_Abstract_Endpoint
{

	public function callback( $data )
	{
		if (!isset($data['rule'])) {
			$this->abort('[rule] is required.');
		}

		$rule = $this->sanitize_array($data['rule']);

		$rules = get_option(self::PER_PRODUCT_RULES_KEY);

		if (!$rules) {
			$rules[] = $rule;
		} else {
			array_push($rules, $rule);
		}

		update_option(self::PER_PRODUCT_RULES_KEY, $rules);

		$this->ok();

	}

	public function action() {
		return 'per_product_create_rule';
	}
}
