<?php
/**
 * Init Styles & scripts
 *
 * @return void
*/
function wpb_admin_styles_scripts(){
	wp_enqueue_style( 'wpb-admin-style', WPB_URL . 'admin/css/admin.css', '', '' );
	wp_enqueue_script( 'wpb-admin-script', WPB_URL . 'admin/js/admin.js', array(), '', true );
}
add_action( 'admin_enqueue_scripts', 'wpb_admin_styles_scripts' );