<?php
namespace PerProduct\Core;

use PerProduct\Api\Endpoints\WPRPP_Abstract_Endpoint;

class WPRPP_Calculator {

	/** @var array */
	private $rules;
	/** @var array */
	private $package;

	public function __construct($package)
	{
		$this->package = $package;
		$this->rules = get_option(WPRPP_Abstract_Endpoint::PER_PRODUCT_RULES_KEY, true);
	}

	/**
	 * @return ?float
	 */
	public function get_rate()
	{
		$matching_rules = $this->get_matching_rules();

		if (count($matching_rules) === 0) {
			return null;
		}

		$quantities = [];
		foreach ($this->package['contents'] as $item) {
			$_product = $item['data'];
			$quantities[$_product->get_id()] = $item['quantity'];
		}


		$rate = 0;
		/** @var WPRPP_Rule $matching_rule */
		foreach ($matching_rules as $matching_rule) {
			$cost =  $matching_rule->getItemCost() * $quantities[$matching_rule->getProductId()];
			$cost += $matching_rule->getLineCost();
			$rate += round($cost, 2);
		}

		return $rate;
	}

	/**
	 * @return array<WPRPP_Rule>
	 */
	private function get_matching_rules()
	{
		$product_ids = [];
		$items = $this->package['contents'];
		foreach ($items as $item) {
			/** @var \WC_Product $_product */
			$_product = $item['data'];
			$product_ids[] = $_product->get_id();
		}

		$matchingRules = [];
		foreach ($this->rules as $rule) {
			$rule = WPRPP_Rule::fromPerShippingRule($rule);


			if ($rule->getCountry() !== '*' && $rule->getCountry() !== $this->package['destination']['country']) {
				continue;
			}

			if ($rule->getState() !== '*' && $rule->getState() !== $this->package['destination']['state']) {
				continue;
			}

			if ($rule->getPostcodes() !== null) {
				if (count($rule->getPostcodes()) > 0 && !in_array($this->package['destination']['postcode'], $rule->getPostcodes())) {
					continue;
				}
			}


			if (!in_array($rule->getProductId(), $product_ids)) {
				continue;
			}

			$matchingRules[] = $rule;

		}

		return $matchingRules;
	}
}
