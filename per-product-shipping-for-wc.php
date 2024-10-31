<?php
/* @wordpress-plugin
 * Plugin Name:       Per Product Shipping for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/per-product-shipping-for-wc/
 * Description:       The easiest way to add shipping costs for each product.
 * Version:           1.0.1
 * WC requires at least: 3.0
 * WC tested up to: 6.7
 * Author:            WPRuby
 * Author URI:        https://wpruby.com
 * Text Domain:       per-product-shipping-for-woocommerce
 * license:           GPL-2.0+
 * license URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

namespace PerProduct;
use PerProduct\Core\WPRPP_Bootstrap;

require_once( dirname( __FILE__ ) . '/includes/autoload.php' );


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PER_PRODUCT_URL', plugin_dir_url( __FILE__ ) );

/** initiate the plugin */
WPRPP_Bootstrap::get_instance();
