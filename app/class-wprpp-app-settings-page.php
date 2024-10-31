<?php
namespace PerProduct\App;


use PerProduct\Api\Endpoints\WPRPP_Endpoints_Factory;

class WPRPP_App_Settings_Page
{

	const SECTION = 'per-product-shipping';

	/**
	 * The single instance of the class.
	 *
	 * @var WPRPP_App_Settings_Page
	 */
	protected static $_instance = null;

	/**
	 * @return WPRPP_App_Settings_Page
	 */
	public static function get_instance()
	{
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_scripts'] );
		add_filter( 'woocommerce_get_sections_shipping', [$this, 'add_section'] );
		add_filter( 'woocommerce_get_settings_shipping', [$this, 'add_settings'], 10, 2 );

	}

	public function enqueue_admin_scripts($hook)
	{
		if (!isset($_GET['page']) || $_GET['page'] !== 'wc-settings') return;
		if (!isset($_GET['section']) || $_GET['section'] !== self::SECTION) return;

		wp_enqueue_script(self::SECTION . '-app', PER_PRODUCT_URL . 'app/frontend/dist/app.js', [], '1.0', true);
		wp_enqueue_style(self::SECTION . '-css',  PER_PRODUCT_URL . 'app/frontend/dist/css/app.css', [], '1.0');
	}

	public function add_section( $sections ) {

		$sections[self::SECTION] = __( 'Per Product Shipping', 'per-product-shipping-for-woocommerce' );
		return $sections;

	}

	public function add_settings( $settings, $current_section ) {

		if ( $current_section !== self::SECTION ) {
			return $settings;
		}

		if (!is_admin()) {
			return [];
		}

		$countries = [['label' => 'All', 'code' => '*']];
		foreach (WC()->countries->get_countries() as $key => $country) {
			$countries[] = ['label' => $country, 'code' => $key];
		}

		$states = WC()->countries->get_states();

		$nonce = WPRPP_Endpoints_Factory::get_endpoints_nonce();

		include 'placeholder.php';
		return [];

	}

}
