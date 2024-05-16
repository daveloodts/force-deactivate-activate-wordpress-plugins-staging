<?php
/**
 * Deactivate Plugins
 *
 * Define the array for deactivate plugins within the included file
 *
 * @package WOPS - Deactivated Other Plugins
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Define the deactivate plugins array
 * 
 * @since 1.0.0
 */
function wpos_wde_deactivate_plugins() {

	return  array(
	    'jetpack/jetpack.php',
	    'redis-cache/redis-cache.php',
	    'wp-redis/wp-redis.php',
	    'wp-mail-smtp/wp_mail_smtp.php',
	    'facebook-for-woocommerce/facebook-for-woocommerce.php',
	    'mailchimp-for-woocommerce/mailchimp-woocommerce.php',
	    'klaviyo/klaviyo.php',
	    'official-facebook-pixel/facebook-for-wordpress.php',
	    'google-site-kit/google-site-kit.php',
	);
}