<?php

/**
 * Custom Background
 */

add_theme_support( 'custom-background', array(
	'default-color'          => '#212829',
	'default-image'          => '',
	'default-repeat'         => 'no-repeat',
	'default-position-x'     => 'center',
	'default-attachment'     => 'fixed',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
) );
