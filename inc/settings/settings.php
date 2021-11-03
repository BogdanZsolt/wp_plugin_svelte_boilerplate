<?php

/**
 * Create Settings Menu
*/
function lasaphire_videomodal_settings_submenu(){

	$hook = add_submenu_page(
		'options-general.php',
		__( 'Video Modal', 'lasaphire-videomodal' ),
		__( 'Video Modal', 'lasaphire-videomodal' ),
		'manage_options',
		'videomodal-option-link',
		'lasaphire_videomodal_settings_template_callback',
		'',
		null
	);

	add_action( 'admin_head-'.$hook, 'lasaphire_videomodal_video_uploader_assets', 10, 1 );
}
add_action( 'admin_menu', 'lasaphire_videomodal_settings_submenu' );

/**
 * Enqueue Image Uploader Assets
*/
function lasaphire_videomodal_video_uploader_assets(){
	wp_enqueue_media();
	wp_enqueue_style( 'lasaphire-videomodal-video-uploader-style' );
	wp_enqueue_script( 'lasaphire-videomodal-video-uploader-script');
}

/**
 * Settings Template Page
*/
function lasaphire_videomodal_settings_template_callback(){
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<form action="options.php" method="post">
			<?php
				// Security field
				settings_fields( 'lasaphire-videomodal-settings-page' );

				// output settings section here
				do_settings_sections( 'lasaphire-videomodal-settings-page' );

				// Save Settings button
				submit_button( 'Save Settings' );
			?>
		</form>
	</div>
	<?php
}

/**
 * Settings Template
*/
function lasaphire_videomodal_settings_init(){

	// Setup settings section
	add_settings_section(
		'lasaphire_videomodal_settings_section',
		'La Saphire Video Modal Settings Page',
		'',
		'lasaphire-videomodal-settings-page'
	);

	// Register checkbox field
	register_setting(
		'lasaphire-videomodal-settings-page',
		'lasaphire_videomodal_enable',
		array(
			'type'				=> 'string',
			'sanitize_callback'	=> 'sanitize_key',
			'default'			=> 'no'
		)
	);

	// Add checkbox fields
	add_settings_field(
		'lasaphire_videomodal_enable',
		__( 'Enable Video Modal', 'lasaphire-videomodal' ),
		'lasaphire_videomodal_settings_checkbox_field_callback',
		'lasaphire-videomodal-settings-page',
		'lasaphire_videomodal_settings_section',
	);

	// Register checkbox field - video view just for one time
	register_setting(
		'lasaphire-videomodal-settings-page',
		'lasaphire_videomodal_one_time',
		array(
			'type'				=> 'string',
			'sanitize_callback'	=> 'sanitize_key',
			'default'			=> 'yes'
		)
	);

	// Add checkbox fields - video view just for one time
	add_settings_field(
		'lasaphire_videomodal_one_time',
		__( 'Video view just for one time', 'lasaphire-videomodal' ),
		'lasaphire_videomodal_settings_checkbox_field_callback',
		'lasaphire-videomodal-settings-page',
		'lasaphire_videomodal_settings_section',
	);

	// Register number field - video playback pause expiration time
	register_setting(
		'lasaphire-videomodal-settings-page',
		'lasaphire_videomodal_expiration_time',
		array(
			'type'				=> 'integer',
			'sanitize_callback'	=> 'sanitize_number',
			'default'			=> ''
		)
	);

	// Add number fields - video playback pause expiration time
	add_settings_field(
		'lasaphire_videomodal_expiration_time',
		__( 'Pause expiration time in minutes', 'lasaphire-videomodal' ),
		'lasaphire_videomodal_settings_number_field_callback',
		'lasaphire-videomodal-settings-page',
		'lasaphire_videomodal_settings_section',
	);

	// Register media uploader field
	register_setting(
		'lasaphire-videomodal-settings-page',
		'lasaphire_videomodal_video_uploader_field',
		array(
			'type'				=> 'integer',
			'sanitize_callback'	=> 'sanitize_video_uploader',
			'default'			=> ''
		)
	);

	// Add media uploader fields
	add_settings_field(
		'lasaphire_videomodal_video_uploader_field',
		__( 'Video Uploader', 'lasaphire-videomodal' ),
		'lasaphire_videomodal_settings_video_uploader_field_callback',
		'lasaphire-videomodal-settings-page',
		'lasaphire_videomodal_settings_section',
	);

	// Add shortcode info fields
	add_settings_field(
		'lasaphire_videomodal_shorcode_info_field',
		__( 'Shortcode', 'lasaphire-videomodal' ),
		'lasaphire_videomodal_shortcode_info_callback',
		'lasaphire-videomodal-settings-page',
		'lasaphire_videomodal_settings_section',
	);

}
add_action( 'admin_init', 'lasaphire_videomodal_settings_init' );

function lasaphire_videomodal_shortcode_info_callback() {
	?>
    <p>[lasaphire_videomodal_autoload]</p>
	<?php
}

/**
 * Sanitize Video Uploader
*/
function sanitize_video_uploader( $value ){
	if( isset( $value ) ){
		return intval( $value );
	} else {
		return false;
	}
}

/**
 * Sanitize number
*/
function sanitize_number( $value ){
	if( isset( $value ) ){
		return intval( $value );
	} else {
		return false;
	}
}

/**
 * Checkbox template - video Modal enable
*/
function lasaphire_videomodal_settings_checkbox_field_callback(){
	$lasaphire_videomodal_enable = get_option( 'lasaphire_videomodal_enable' );
	?>
	<label for="">
		<input type="checkbox" name="lasaphire_videomodal_enable" value="yes" <?php checked( 'yes', $lasaphire_videomodal_enable ); ?> /> Please check if enable!
	</label>
	<?php
}

/**
 * Checkbox template - video View Just for One Time
*/
function lasaphire_videomodal_one_time_field_callback(){
	$lasaphire_videomodal_one_time = get_option( 'lasaphire_videomodal_one_time' );
	?>
	<label for="">
		<input type="checkbox" name="lasaphire_videomodal_one_time" value="yes" <?php checked( 'yes', $lasaphire_videomodal_one_time ); ?> /> Please check if enable!
	</label>
	<?php
}

/**
 * Number template - Integer, Expiration Time
*/
function lasaphire_videomodal_settings_number_field_callback(){
	$lasaphire_videomodal_expiration_time = get_option( 'lasaphire_videomodal_expiration_time' );
	?>
		<label for="lasaphire_videomodal_expiration_time">
			<input type="number" name="lasaphire_videomodal_expiration_time" min="0" max="60" value="<?php echo esc_attr( isset( $lasaphire_videomodal_expiration_time ) ? (int) $lasaphire_videomodal_expiration_time : 0 ); ?>">
		</label>
	<?php
}

/**
 * Video Uploader template
*/
function lasaphire_videomodal_settings_video_uploader_field_callback(){
	$lasaphire_videomodal_video_id = get_option( 'lasaphire_videomodal_video_uploader_field' );
	?>
	<div class="lasaphire-videomodal-uploader-wrap">
		<video id="video-tag" data-src="" src="<?php echo esc_url( wp_get_attachment_url( $lasaphire_videomodal_video_id ) ); ?>" width="600" autoplay muted></video>
		<div class="lasaphire-videomodal-upload-action">
			<input id="video-hidden-input" type="hidden" name="lasaphire_videomodal_video_uploader_field" value="<?php echo esc_attr( isset( $lasaphire_videomodal_video_id ) ? ( int ) $lasaphire_videomodal_video_id : 0 ); ?>" />
			<button type="button" class="upload-video-button"><span class="dashicons dashicons-plus"></span></button>
			<button type="button" class="remove-video-button"><span class="dashicons dashicons-minus"></span></button>
		</div>
	</div>
	<?php
}
