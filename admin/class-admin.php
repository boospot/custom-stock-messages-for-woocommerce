<?php

namespace CustomStockMessagesForWoocommerce;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://booskills.com/rao
 * @since      1.0.0
 *
 * @package    CustomStockMessagesForWoocommerce
 * @subpackage CustomStockMessagesForWoocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CustomStockMessagesForWoocommerce
 * @subpackage CustomStockMessagesForWoocommerce/admin
 * @author     Rao <rao@booskills.com>
 */
class Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * The prefix of this plugin.
	 */

	private $prefix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->prefix      = Globals::get_meta_prefix();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CustomStockMessagesForWoocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CustomStockMessagesForWoocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CustomStockMessagesForWoocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CustomStockMessagesForWoocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 *
	 */
	public function admin_menu_simple() {

		$config_array = array(
			'options_id' => 'csmfw-options',
			'tabs'       => true,
			'prefix'     => $this->prefix,
			'menu'       => $this->get_settings_menu(),
			'links'      => $this->get_settings_links(),
			'sections'   => $this->get_settings_sections(),
			'fields'     => $this->get_settings_fields()
		);


		$this->settings_api = new \Boo_Settings_Helper( $config_array );
		$this->settings_api->admin_init();

	}

	function get_settings_menu() {
		$config_menu = array(
			//The name of this page
			'page_title'      => __( 'CSMFW Settings', 'custom-stock-messages-for-woocommerce' ),
			// //The Menu Title in Wp Admin
			'menu_title'      => __( 'Custom Stock Messages', 'custom-stock-messages-for-woocommerce' ),
			// The capability needed to view the page
			'capability'      => 'manage_options',
			// Slug for the Menu page
			'slug'            => 'csmfw-settings',
			// dashicons id or url to icon
			// https://developer.wordpress.org/resource/dashicons/
			'icon'            => 'dashicons-performance',
			// Required for submenu
			'submenu'         => true,
			// position
//			'position'   => 10,
			// For sub menu, we can define parent menu slug (Defaults to Options Page)
			'parent'          => 'options-general.php',
			// plugin_basename required to add plugin action links
			'plugin_basename' => plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' ),
		);

		return $config_menu;
	}

	function get_settings_links() {
		$links = array(
			'plugin_basename' => plugin_basename( plugin_dir_path( __FILE__ ) . $this->plugin_name . '.php' ),

		);

		return $links;
	}

	function get_settings_sections() {
		return array(
			array(
				'id'    => 'general_section',
				'title' => __( 'CSMFW Settings', 'custom-stock-messages-for-woocommerce' ),
			)
		);
	}

	function get_settings_fields() {
		return array(
			'general_section' => array(
				array(
					'id'                => 'in_stock_message',
					'label'             => __( 'In Stock Message', 'custom-stock-messages-for-woocommerce' ),
					'type'              => 'textarea',
					'desc'              => esc_html__( 'Shortcodes can be used.', 'custom-stock-messages-for-woocommerce' ),
					'sanitize_callback' => [ $this, 'no_sanitize' ]
				),
				array(
					'id'    => 'out_of_stock_message',
					'label' => __( 'Out of Stock Message', 'custom-stock-messages-for-woocommerce' ),
					'type'  => 'textarea',
					'desc'  => esc_html__( 'Shortcodes can be used.', 'custom-stock-messages-for-woocommerce' ),
					'sanitize_callback' => [ $this, 'no_sanitize' ]
				)
			)
		);
	}

	/**
	 *
	 */
	public function no_sanitize( $value ) {
		return $value;

	}

	/*
	 * Adding Function for Plugin Menu and options page
	 */

	public function get_default_options( $key ) {

		return Globals::get_default_options( $key );

	}

}
