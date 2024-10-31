<?php

namespace PerProduct\Api\Endpoints;

class WPRPP_Sort_Rules_Endpoint extends WPRPP_Abstract_Endpoint {

	public function callback( $data )
	{
		if (!isset($data['rules'])) {
			$this->abort('[rules] field is required');
		}

		if (!is_array($data['rules'])) {
			$this->abort('[rules] must be an array');
		}

		$rules = $data['rules'];
		foreach ($rules as $key => $rule) {
			$rules[$key] = $this->sanitize_array($rule);
		}


		update_option(self::PER_PRODUCT_RULES_KEY, $rules);

		$this->ok();
	}

	public function action()
	{
		return 'per_product_sort_rules';
	}
}
