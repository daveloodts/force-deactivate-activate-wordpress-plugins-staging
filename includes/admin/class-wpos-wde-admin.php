<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WPOS_Wde_Admin {

	/**
	 * Function to call Construct
	 * 
	 * @since 1.0.0
	 */
	function __construct() {

		// Action to add admin notice
		add_action( 'admin_notices', array( $this, 'wpos_wde_check_required_plugins' ) );

		// Action to deactivate disallowed plugins
		add_action( 'admin_init', array( $this, 'wpos_wde_check_deactivate_plugins' ) );
	}

	/**
	 * Function to check required plugins are activated
	 * 
	 * @since 1.0.0
	 */
	public function wpos_wde_check_required_plugins() {

		$wpos_wde_missing_plugins 	= array();
		$wpos_wde_required_plugins 	= wpos_wde_required_plugins();

		if ( ! empty( $wpos_wde_required_plugins ) ) {
			
			foreach ( $wpos_wde_required_plugins as $wpos_wde_plugin_path => $wpos_wde_plugin_name ) {

				if ( ! is_plugin_active( $wpos_wde_plugin_name['file_path'] ) ) {
					$wpos_wde_missing_plugins[] = '<a href="'.esc_url( $wpos_wde_plugin_name['url'] ).'" target="_blank">'.$wpos_wde_plugin_name['name'].'</a>';
				}
			}
		}

		// Required Plugin Notice
		if ( ! empty( $wpos_wde_missing_plugins ) ) {
			echo '<div class="notice notice-warning"><p>'.sprintf( __( 'For development environment, Kindly activate the required plugins %s.', 'woofers-development-env' ), implode( ', ', $wpos_wde_missing_plugins ) ).'</p></div>';
		}

		if ( ! empty( $_GET['message'] ) && 'wpos_wde_dp' == $_GET['message'] && ! empty( $_GET['wpos_wde_deactivated_plugins'] ) ) {

			echo '<div class="notice notice-error">
				<p>
					'. sprintf( __('The plugin(s) has been deactivated because of development environment : %s', 'woofers-development-env' ), $_GET['wpos_wde_deactivated_plugins'] ) .'
				</p>
			</div>';
		}
	}

	/**
	 * Function to check deactivate disallowed plugins
	 * 
	 * @since 1.0.0
	 */
	public function wpos_wde_check_deactivate_plugins() {

		$wpos_wde_deactivated_plugin_notice		= array();
		$wpos_wde_deactivate_plugins 			= wpos_wde_deactivate_plugins();

		if ( !empty( $wpos_wde_deactivate_plugins ) ) {

			foreach ( $wpos_wde_deactivate_plugins as $wpos_wde_required_plugin_key => $wpos_wde_required_plugin_value ) {

				if ( is_plugin_active( $wpos_wde_required_plugin_value ) ) {

					deactivate_plugins( $wpos_wde_required_plugin_value );

					// To add notice for deactivated plugin
					$wpos_wde_deactivated_plugin_notice[] = get_plugin_data( WP_PLUGIN_DIR . '/' . $wpos_wde_required_plugin_value )['Name'];
				}
			}
		}

		// Construct array of deactivated plugin names
		if ( ! empty( $wpos_wde_deactivated_plugin_notice ) ) {
	        
	        $wpos_wde_deactivated_plugins_list 	= implode( ',', $wpos_wde_deactivated_plugin_notice );
	        $wpos_wde_redirect_url 				= add_query_arg( array( 'message' => 'wpos_wde_dp', 'wpos_wde_deactivated_plugins' => $wpos_wde_deactivated_plugins_list ) );
	        
	        wp_redirect( $wpos_wde_redirect_url ); // Redirect to the new URL
	        exit;
	    }
	}
}

$wpos_wde_admin = new WPOS_Wde_Admin();