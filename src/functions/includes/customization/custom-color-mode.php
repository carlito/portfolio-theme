<?php

namespace Pr\Customization;


/**
 * Custom Highlight Color
 */

function color_mode( $wp_customize ) {

  /*
   * Setting: Listpage Style
   */

  $wp_customize->add_setting( 'color_mode', array(
      'capability'  => 'edit_theme_options',
      'default'     => 'Light',
      'type'        => 'option',
    )
  );

  $wp_customize->add_control( 'color_mode',
    array(
      'label'     => __( 'Color Mode', 'privatradio' ),
      'section'   => 'colors',
      'settings'  => 'color_mode',
      'type'      => 'select',
      'priority'  => 1,
      'choices'   => array(
        'light'  => __( 'Light', 'privatradio' ),
        'dark'   => __( 'Dark',  'privatradio' ),
      ),
      'description' => __('Choose a color mode', 'privatradio')
    )
  );
}

add_action( 'customize_register', __NAMESPACE__ . '\\color_mode' );


/**
 * CSS Output
 */

function color_mode_processing() {

}

add_action( 'wp_head', __NAMESPACE__ . '\\color_mode_processing' );






function color_mode_body_class($classes) {

    $color_mode = get_option( 'color_mode' );
    $classes[] = 'color-mode--' . $color_mode;
    return $classes;
}

add_filter('body_class', __NAMESPACE__ . '\\color_mode_body_class');
