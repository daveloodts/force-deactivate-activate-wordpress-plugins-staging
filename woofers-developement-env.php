<?php
/**
 * Plugin Name: Woofers Development ENV
 * Plugin URI: https://www.essentialplugin.com/
 * Text Domain: woofers-development-env
 * Description: Deactivated Other Plugins for staging site
 * Domain Path: /languages/
 * Version: 1.0.0
 * Author: Essential Plugin
 * Author URI: https://www.essentialplugin.com/
 *
 * @package WOPS - Deactivated Other Plugins
*/

if( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! defined( 'WPOS_WDE_VERSION' ) ) {
	define( 'WPOS_WDE_VERSION', '1.0.0' ); // Version of plugin
}

if( ! defined( 'WPOS_WDE_DIR' ) ) {
	define( 'WPOS_WDE_DIR', dirname( __FILE__ ) ); // Plugin dir
}

if( ! defined( 'WPOS_WDE_URL' ) ) {
	define( 'WPOS_WDE_URL', plugin_dir_url( __FILE__ )); // Plugin url
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpos_wde_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpos_wde_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */
function wpos_wde_install() {
}

/**
 * Plugin Functinality (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */
function wpos_wde_uninstall() {
}

/**
 * Check if the current site is a staging site.
 * 
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */
function wpos_wde_is_staging_site() {

	// Get domain endpoint
	$is_staging_site		= false;
	$wpos_wde_parsed_url 	= parse_url( site_url() );
	$wpos_wde_host 			= isset( $wpos_wde_parsed_url['host'] ) ? $wpos_wde_parsed_url['host'] : '';
	$dev_env_parts			= array( '.dev', '.local' );

	foreach ($dev_env_parts as $dev_env_part_key => $dev_env_part_val) {

		if( strpos( $wpos_wde_host, $dev_env_part_val ) !== false ) {
			$is_staging_site = true;
			break;
		}
	}

    return $is_staging_site;
}


/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */
function wpos_wde_load_textdomain() {

	// Set filter for plugin's languages directory
	$wpos_wde_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wpos_wde_lang_dir = apply_filters( 'wpos_wde_languages_directory', $wpos_wde_lang_dir );

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale', get_user_locale(), 'woofers-development-env' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'woofers-development-env', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPOS_WDE_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'woofers-development-env', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'woofers-development-env', false, $wpos_wde_lang_dir );
	}
}

/**
 * Load the plugin after the main plugin is loaded.
 * 
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */
function wpos_wde_load_plugin() {

	// Action to load plugin text domain
	wpos_wde_load_textdomain();

	// Check main plugin is active or not
	if ( wpos_wde_is_staging_site() ) {

		// Load Admin Files
		if( is_admin() ) {

			// Admin Class File
			require_once( WPOS_WDE_DIR . '/includes/admin/class-wpos-wde-admin.php' );

			// Required Plugins File
			require_once( WPOS_WDE_DIR . '/includes/admin/required-plugins.php' );

			// Deactivate Plugins File
			require_once( WPOS_WDE_DIR . '/includes/admin/deactivate-plugins.php' );
		}
	}
}

// Action to load plugin after the main plugin is loaded
add_action( 'plugins_loaded', 'wpos_wde_load_plugin' );