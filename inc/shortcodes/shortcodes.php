<?php

/**
 * La Saphire Video Modal Wordpress Shortcode
*/

function wpb_load(){
		$return_html = '';
		$return_html .= '
			<section id="wpb_load" />
		';
	return $return_html;
}
add_shortcode( 'wpb_load', 'wpb_load' );

