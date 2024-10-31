<?php
namespace PerProduct\Api\Endpoints;

class WPRPP_Update_Rule_Endpoint extends WPRPP_Abstract_Endpoint {

	public function callback( $data )
	{
		$this->validate($data);

		$rules = get_option(self::PER_PRODUCT_RULES_KEY);

		$rule = $this->sanitize_array($data['rule']);
		$rule_id = intval($rule['id']);

		if (isset($rules[$rule_id])) {
			$rules[$rule_id] = $rule;
		}

		update_option(self::PER_PRODUCT_RULES_KEY, $rules);

		$this->ok();
	}

	public function action()
	{
		return 'per_product_update_rule';
	}

	private function validate( $data )
	{
		if (!isset($data['id'])) {
			$this->abort('[id] is required');
		}

		if (!isset($data['rule'])) {
			$this->abort('[rule] is required');
		}

		if (intval($data['id']) < 0) {
			$this->abort('[id] must be a number');
		}
	}
}
