<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.dukeyin.com
 * @since      1.0.0
 *
 * @package    Corona_Virus_Database
 * @subpackage Corona_Virus_Database/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Corona_Virus_Database
 * @subpackage Corona_Virus_Database/includes
 * @author     Duke Yin <yinduke@gmail.com>
 */
class Corona_Virus_Database_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		if( wp_next_scheduled( 'coronavirus_check' ) ){
			wp_clear_scheduled_hook('coronavirus_check');
		}
	}

}
