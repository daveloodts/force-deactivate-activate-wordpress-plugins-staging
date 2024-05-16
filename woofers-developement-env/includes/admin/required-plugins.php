<?php
/**
 * Required Plugins
 *
 * Define the array for required plugins within the included file
 *
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Define the required plugins array
 * 
 * @since 1.0.0
 */
function wpos_wde_required_plugins() {
    return array(
        'disable-emails' => array(
            'file_path' => 'disable-emails/disable-emails.php',
            'name'      => __( 'Disable Emails', 'woofers-development-env' ),
            'slug'      => 'disable-emails',
            'url' 		=> 'https://wordpress.org/plugins/disable-emails',
        ),
        'password-protected' => array(
            'file_path' => 'password-protected/password-protected.php',
            'name'      => __( 'Password Protected', 'woofers-development-env' ),
            'slug'      => 'password-protected',
            'url' 		=> 'https://wordpress.org/plugins/password-protected',
        ),
    );
}