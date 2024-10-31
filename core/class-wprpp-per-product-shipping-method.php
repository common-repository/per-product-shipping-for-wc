<?php
namespace PerProduct\Core;

use WC_Shipping_Method;

class WPRPP_Per_Product_Shipping_Method extends WC_Shipping_Method {

	public function __construct($instance_id = 0)
	{
		$this->instance_id = absint( $instance_id );

		$this->supports  = [
			'shipping-zones',
			'instance-settings',
			'instance-settings-modal',
		];

		$this->id = 'per_product';
		$this->method_title = __( 'Per Product Shipping', 'per-product-shipping-for-woocommerce' );
		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();
		// Define user set variables
		$this->enabled  = $this->get_option( 'enabled' );
		$this->title     = $this->get_option( 'title' );

		add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
	}

	public function init_form_fields()
	{
		$this->instance_form_fields = [
			'enabled' => [
				'title'     => __( 'Enable/Disable', 'per-product-shipping-for-woocommerce' ),
				'type'       => 'checkbox',
				'label'     => __( 'Enable Per Product Shipping', 'per-product-shipping-for-woocommerce' ),
				'default'     => 'yes'
			],
			'title' => [
				'title'     => __( 'Method Title', 'per-product-shipping-for-woocommerce' ),
				'type'       => 'text',
				'description'   => __( 'This controls the title which the user sees during checkout.', 'per-product-shipping-for-woocommerce' ),
				'default'    => __( 'Per Product Shipping', 'per-product-shipping-for-woocommerce' ),
			]
		];
	}
	public function is_available( $package )
	{
		return true;
	}

	public function calculate_shipping($package = array())
	{
		$rate = (new WPRPP_Calculator($package))->get_rate();

		if ($rate !== null) {
			$this->add_rate([
				'id' =>  'per_product',
				'cost' => $rate,
				'label' => $this->title,
			]);
		}

	}
}
