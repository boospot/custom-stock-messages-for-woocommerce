<?php

namespace CustomStockMessagesForWoocommerce;
// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// if class already defined, bail out
if ( class_exists( 'CustomStockMessagesForWoocommerce\Taxonomy' ) ) {
	return;
}


/**
 * This class will create meta boxes for Taxonomies
 *
 * @package    CustomStockMessagesForWoocommerce
 * @subpackage CustomStockMessagesForWoocommerce/includes
 * @author     Rao <raoabid491@gmail.com>
 */
class Taxonomy {



	/**
	 * Initialize the class and set its properties.
	 *
	 *
	 * @since    1.0.0
	 */
	public function __construct() {



	}


}