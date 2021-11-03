<?php

/**
 * Plugin Name: wp plugin boilerplate
 * Plugin URI: https://www.zsoltbogdan.hu/
 * Author: Shiru
 * Author URI: https://www.zsoltbogdan.hu
 * version: 1.0.0
 * Text Domain: wpb
 * Description: WordPress Plugin Boilerplate.
*/

if ( !defined( 'ABSPATH' ) ){
	exit(); // No direct access allowed
}

/**
 * define plugin constants
*/
define( 'WPB_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'WPB_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );

/**
 * Include admin.php
*/
if ( is_admin() ){
	require_once WPB_PATH . '/admin/admin.php';
}

/**
 * Include public.php
*/
if ( !is_admin() ){
	require_once WPB_PATH . '/public/public.php';
}

/**
* Include Settings
*/
// require_once WPB_PATH . '/inc/settings/settings.php';

/**
 * Include Shortcodes
*/
require_once WPB_PATH . '/inc/shortcodes/shortcodes.php';