<?php
namespace PerProduct\Core;

class WPRPP_Rule {
	/** @var integer */
	private $product_id;


	/** @var string */
	private $country = '*';

	/** @var string */
	private $state = '*';

	/** @var array */
	private $postcodes;

	/** @var float */
	private $line_cost;

	/** @var float */
	private $item_cost;

	/**
	 * @return int
	 */
	public function getProductId() {
		return $this->product_id;
	}

	/**
	 * @param int $product_id
	 *
	 * @return WPRPP_Rule
	 */
	public function setProductId( $product_id ) {
		$this->product_id = $product_id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param string $country
	 *
	 * @return WPRPP_Rule
	 */
	public function setCountry( $country ) {
		$this->country = $country;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @param string $state
	 *
	 * @return WPRPP_Rule
	 */
	public function setState( $state ) {
		$this->state = $state;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getPostcodes() {
		return $this->postcodes;
	}

	/**
	 * @param array $postcodes
	 *
	 * @return WPRPP_Rule
	 */
	public function setPostcodes( $postcodes ) {
		$this->postcodes = $postcodes;

		return $this;
	}

	/**
	 * @return float
	 */
	public function getLineCost() {
		return $this->line_cost;
	}

	/**
	 * @param float $line_cost
	 *
	 * @return WPRPP_Rule
	 */
	public function setLineCost( $line_cost ) {
		$this->line_cost = $line_cost;

		return $this;
	}

	/**
	 * @return float
	 */
	public function getItemCost() {
		return $this->item_cost;
	}

	/**
	 * @param float $item_cost
	 *
	 * @return WPRPP_Rule
	 */
	public function setItemCost( $item_cost ) {
		$this->item_cost = $item_cost;

		return $this;
	}

	/**
	 * @param array $rule
	 *
	 * @return WPRPP_Rule
	 */
	public static function fromPerShippingRule($rule)
	{
		$instance = new self();

		$instance->setProductId($rule['product']['code']);

		$instance->setCountry($rule['country']['code']);
		$instance->setState($rule['state']);
		if (trim($rule['postcode']) !== '*') {
			$instance->setPostcodes(explode(',', $rule['postcode']));
		}
		$instance->setLineCost($rule['line_cost']);
		$instance->setItemCost($rule['item_cost']);

		return $instance;
	}

}
