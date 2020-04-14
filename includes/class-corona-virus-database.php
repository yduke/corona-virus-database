<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.dukeyin.com
 * @since      1.0.0
 *
 * @package    Corona_Virus_Database
 * @subpackage Corona_Virus_Database/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Corona_Virus_Database
 * @subpackage Corona_Virus_Database/includes
 * @author     Duke Yin <yinduke@gmail.com>
 */
class Corona_Virus_Database {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Corona_Virus_Database_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'CORONA_VIRUS_DATABASE_VERSION' ) ) {
			$this->version = CORONA_VIRUS_DATABASE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'corona-virus-database';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Corona_Virus_Database_Loader. Orchestrates the hooks of the plugin.
	 * - Corona_Virus_Database_i18n. Defines internationalization functionality.
	 * - Corona_Virus_Database_Admin. Defines all hooks for the admin area.
	 * - Corona_Virus_Database_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-corona-virus-database-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-corona-virus-database-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-corona-virus-database-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-corona-virus-database-public.php';

		$this->loader = new Corona_Virus_Database_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Corona_Virus_Database_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Corona_Virus_Database_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Corona_Virus_Database_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Corona_Virus_Database_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Corona_Virus_Database_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

function save_cov2019() {
		$request = wp_remote_get( 'https://corona.lmao.ninja/v2/all' );
		if( is_wp_error( $request ) ) {
			return false; 
		}
		$body = wp_remote_retrieve_body( $request );
		$cov2019_data = json_decode( $body );
		if( ! empty( $cov2019_data ) ) {
update_option('cov2019', $cov2019_data);
		}
}

function save_cov2019_all() {
		$request = wp_remote_get( 'https://corona.lmao.ninja/v2/countries' );
		if( is_wp_error( $request ) ) {
			return false; 
		}
		$body = wp_remote_retrieve_body( $request );
		$cov2019all_data = json_decode( $body );
		if( ! empty( $cov2019all_data ) ) {
update_option('cov2019all', $cov2019all_data);
		}
}

function cov_gmt_to_local( $gmt_timestamp ) {
	$local_timestamp = get_date_from_gmt( date( 'Y-m-d H:i:s',$gmt_timestamp /1000 ), get_option('date_format').  get_option('time_format') );
	return $local_timestamp;
}


add_action('wp', 'coronavirus_schedule');
function coronavirus_schedule() {
	if( !wp_next_scheduled( 'coronavirus_check' ) ) {
	wp_schedule_event( time(), 'hourly', 'coronavirus_check' );
	}
}

add_action( 'coronavirus_check', 'coronavirus_check_data' );
function coronavirus_check_data(){
	save_cov2019();
	save_cov2019_all();
}


//shorcode
function cvdb_func($atts, $content = null, $shortcodename = "")
{
	$cov2019 = get_option('cov2019');
	$return = '<div id="ncov2019"><span>' . __('Last update on: ', 'corona-virus-data') . '</span><span id="cov-time">'.sprintf( cov_gmt_to_local($cov2019 -> updated) ).'</span>
	<div class="title text-center">' . __('Global Total', 'corona-virus-data') . '</div>
	<div class="one_fourth text-center"><h5>' . __('Cases', 'corona-virus-data') . '</h5><h3 class="has-text-color has-luminous-vivid-orange-color">'.sprintf( $cov2019 -> cases ).'</h3></div>
	<div class="one_fourth text-center"><h5>' . __('Deaths', 'corona-virus-data') . '</h5><h3>'.sprintf( $cov2019 -> cases ).'</h3></div>
	<div class="one_fourth text-center"><h5>' . __('Recovered', 'corona-virus-data') . '</h5><h3 class="has-text-color has-vivid-green-cyan-color">'.sprintf($cov2019 -> cases ).'</h3></div>
	<div class="one_fourth text-center"><h5>' . __('Active', 'corona-virus-data') . '</h5><h3 class="has-text-color has-luminous-vivid-orange-color">'.sprintf($cov2019 -> cases ).'</h3></div>
	<div class="one_fourth text-center"><h5>' . __('Cases Today', 'corona-virus-data') . '</h5><h3 class="has-text-color has-luminous-vivid-orange-color">'.sprintf($cov2019 -> todayCases ).'</h3></div>
	<div class="one_fourth text-center"><h5>' . __('Deaths Today', 'corona-virus-data') . '</h5><h3>'.sprintf($cov2019 -> cases ).'</h3></div>
	<div class="one_fourth text-center"><h5>' . __('Critical', 'corona-virus-data') . '</h5><h3 class="has-text-color has-vivid-red-color">'.sprintf($cov2019 -> todayDeaths ).'</h3></div>
	<div class="one_fourth text-center"><h5><small>' . __('Cases Per Million', 'corona-virus-data') . '</small></h5><h3 class="has-text-color has-vivid-cyan-blue-color">'.sprintf($cov2019 -> casesPerOneMillion ).'</h3></div>';
	$return .= '</div>';
	if(get_option('show_oc')){
		
	}
	return $return;
}
add_shortcode("cvdb", "cvdb_func");
