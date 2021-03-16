<?php

namespace CustomStockMessagesForWoocommerce;
// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// if class already defined, bail out
if ( class_exists( 'CustomStockMessagesForWoocommerce\Woocommerce' ) ) {
	return;
}


/**
 * This class will create meta boxes for Taxonomies
 *
 * @package    CustomStockMessagesForWoocommerce
 * @subpackage CustomStockMessagesForWoocommerce/includes
 * @author     Rao <raoabid491@gmail.com>
 */
class Woocommerce {

	/**
	 * The prefix of this plugin.
	 */

	private $prefix;

	/**
	 * Initialize the class and set its properties.
	 *
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->prefix = Globals::get_meta_prefix();

		add_shortcode( 'custom_stock_messages', [ $this, 'custom_stock_messages_cb' ] );


	}

	// Shortcode_display :  custom_stock_messages    // like: show_post_list

	function custom_stock_messages_cb( $atts = [], $content = null, $tag = '' ) {
		return $this->display_custom_stock_messages();
	}

	/**
	 * @hooked woocommerce_before_add_to_cart_form
	 */
	public function display_custom_stock_messages() {

		echo $this->get_custom_stock_messages();

	}

	public function get_custom_stock_messages() {

		global $product;

		$is_in_stock = $product->is_in_stock();

		$css_class = $is_in_stock ? 'csmfw-in-stock' : 'csmfw-out-of-stock';

		$option_key = $is_in_stock ? 'csmfw_in_stock_message' : 'csmfw_out_of_stock_message';

		$product_level_settings = get_post_meta( $product->get_id(), "_" . $option_key, true );

		if ( ! empty( $product_level_settings ) ) {
			$message = do_shortcode( $product_level_settings );
		} else {
			$message = do_shortcode( get_option( $option_key ) );
		}

		if ( empty( $message ) ) {
			return null;
		}

		ob_start();

		printf( '<div class="%s">%s</div>',
			$css_class,
			$message
		);

		return ob_get_clean();

	}

	/**
	 *
	 * @hooked woocommerce_loaded
	 */
	public function add_custom_stock_messages_data_tabs() {

		if ( ! is_admin() ) {
			return null;
		}

		$config_array = array(
			'prefix' => '_' . $this->prefix,
			'tabs'   => $this->get_custom_stock_messages_fields_tabs(),
			'fields' => $this->get_custom_stock_messages_fields()
		);

		new \Boo_Woocommerce_Helper( $config_array );

	}

	/**
	 *
	 */
	public function get_custom_stock_messages_fields_tabs() {

		$tabs = array(
			array(
				'id'    => 'settings_custom_stock_messages',
				'label' => __( 'Custom Stock Messages', 'custom-stock-messages-for-woocommerce' ),
				'class' => array( 'show_if_simple' ),
			),
		);

		return apply_filters( 'csamfw_filter_woocommerce_tabs', $tabs );

	}

	/**
	 * Fields in Product Edit section for license related configuration
	 */
	public function get_custom_stock_messages_fields() {
		$fields = array();
		/*
		* License Settings
		*/
		$fields['settings_custom_stock_messages'] = apply_filters( 'csamfw_filter_wc_settings_custom_stock_messages_fields', array(

			array(
				'id'                => 'in_stock_message',
				'label'             => __( 'In Stock Message', 'custom-stock-messages-for-woocommerce' ),
				'type'              => 'textarea',
				'desc'              => esc_html__( 'Shortcodes can be used.', 'custom-stock-messages-for-woocommerce' ),
				'sanitize_callback' => [ $this, 'no_sanitize' ]
			),
			array(
				'id'                => 'out_of_stock_message',
				'label'             => __( 'Out of Stock Message', 'custom-stock-messages-for-woocommerce' ),
				'type'              => 'textarea',
				'desc'              => esc_html__( 'Shortcodes can be used.', 'custom-stock-messages-for-woocommerce' ),
				'sanitize_callback' => [ $this, 'no_sanitize' ]
			),

		) );

		return apply_filters( 'csamfw_filter_wc_fields', $fields );

	}

	/**
	 *
	 */
	public function no_sanitize( $value ) {
		return $value;

	}


}