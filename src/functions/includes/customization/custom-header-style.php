<?php

namespace Pr\Customization;


/**
 * Custom Header Style
 */

function custom_header_style( $wp_customize ) {

  $wp_customize->add_setting( 'header_style', array(
      'capability' => 'edit_theme_options',
    	'default'    => 'regular',
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'header_style',
    array(
    	'label'     => 'Header Style',
    	'section'   => 'header_image',
    	'settings'  => 'header_style',
      'transport' => 'refresh',
      'type'      => 'select',
      'choices'   => array(
        'regular'    => __('Regular'),
        'fullscreen' => __('Fullscreen')
      )
    )
  );
}

add_action( 'customize_register', __NAMESPACE__ . '\\custom_header_style' );
