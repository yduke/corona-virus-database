<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.dukeyin.com
 * @since      1.0.0
 *
 * @package    Corona_Virus_Database
 * @subpackage Corona_Virus_Database/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Corona_Virus_Database
 * @subpackage Corona_Virus_Database/includes
 * @author     Duke Yin <yinduke@gmail.com>
 */
class Corona_Virus_Database_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'corona-virus-database',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
