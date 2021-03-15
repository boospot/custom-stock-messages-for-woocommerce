<?php
namespace CustomStockMessagesForWoocommerce;
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://booskills.com/rao
 * @since      1.0.0
 *
 * @package    CustomStockMessagesForWoocommerce
 * @subpackage CustomStockMessagesForWoocommerce/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    CustomStockMessagesForWoocommerce
 * @subpackage CustomStockMessagesForWoocommerce/includes
 * @author     Rao <rao@booskills.com>
 */
class i18N {
	/** @noinspection SpellCheckingInspection */


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'custom-stock-messages-for-woocommerce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}


}
