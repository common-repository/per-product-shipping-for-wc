<?php
namespace PerProduct\Core;

use PerProduct\Api\Endpoints\WPRPP_Endpoints_Factory;
use PerProduct\App\WPRPP_App_Settings_Page;

class WPRPP_Bootstrap
{
	/**
	 * The single instance of the class.
	 *
	 * @var WPRPP_Bootstrap
	 * @since 2.1.1
	 */
	protected static $_instance = null;

	/**
	 * @return WPRPP_Bootstrap
	 */
	public static function get_instance()
	{
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct()
	{
		WPRPP_App_Settings_Page::get_instance();
		WPRPP_Endpoints_Factory::boot();

		add_filter( 'woocommerce_shipping_methods', [$this, 'add_per_product_shipping_method'] );
		add_action( 'woocommerce_shipping_init', [$this, 'shipping_method_init'] );

	}

	public function add_per_product_shipping_method( $methods )
	{
		$methods['per_product'] = WPRPP_Per_Product_Shipping_Method::class;
		return $methods;
	}

	public function shipping_method_init()
	{
		require_once( dirname( __FILE__ ) . '/class-wprpp-per-product-shipping-method.php' );
	}
}
