<?php

namespace Pr\Customization;


function navigation_bar( $wp_customize ) {

  /*
   * Panel
   */

  // $wp_customize->add_panel( 'navbar_panel', array(
  //     'priority' => 10,
  //     'capability' => 'edit_theme_options',
  //     'theme_supports' => '',
  //     'title' => __( 'Navigation Bar', 'rampensau' ),
  //     'description' => __( 'Settings for the navigation bar.', 'rampensau' ),
  // ) );

  /*
   * Section
   */

  $wp_customize->add_section( 'navbar_section',
    array(
      'priority' => 10,
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => __( 'Navigation Bar', 'rampensau' ),
      'description' => '',
      // 'panel' => 'navbar_panel',
  ) );


  /*
   * Setting: Background color
   */

  $wp_customize->add_setting( 'navbar_bg_color',
    array(
      'capability' => 'edit_theme_options',
      'default'    => 'transparent',
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'navbar_bg_color',
    array(
      'label'     => __( 'Background Color', 'rampensau' ),
      'section'   => 'navbar_section',
      'settings'  => 'navbar_bg_color',
      'type'      => 'color'
    )
  );


  /*
   * Setting: Text color
   */

  // $wp_customize->add_setting( 'navbar_text_color', array(
  //     'capability' => 'edit_theme_options',
  //     'default'    => '#111111',
  //     'type'       => 'option',
  //   )
  // );
  //
  // $wp_customize->add_control( 'navbar_text_color', array(
  //     'label'     => __( 'Text Color', 'rampensau' ),
  //     'section'   => 'navbar_section',
  //     'settings'  => 'navbar_text_color',
  //     'type'      => 'color'
  //   )
  // );


  /*
   * Setting: Opacity
   */

  $wp_customize->add_setting( 'navbar_opacity',
    array(
      'capability' => 'edit_theme_options',
      'default'    => '.8',
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'navbar_opacity',
    array(
      'label'       => __( 'Opacity', 'rampensau' ),
      'section'     => 'navbar_section',
      'settings'    => 'navbar_opacity',
      'type'        => 'text',
      'description' => __( 'Value must be a floating point value between 0 and 1. Examples: 0.5 or 0.75', 'rampensau' )
    )
  );


  /*
   * Setting: Show Subscribe Button
   */

  if( has_module('subscribe_button') && has_feeds() ) {

    $wp_customize->add_setting( 'show_subscribe_button',
      array(
        'capability' => 'edit_theme_options',
        'default'    => true,
        'type'       => 'option'
      )
    );

    $wp_customize->add_control( 'show_subscribe_button',
      array(
        'label'       => __( 'Show Subscribe Button', 'rampensau' ),
        'section'     => 'navbar_section',
        'settings'    => 'show_subscribe_button',
        'type'        => 'checkbox',
        'description' => __( 'Display the subscribe button.', 'rampensau' )
      )
    );
  }

}

add_action( 'customize_register', __NAMESPACE__ . '\\navigation_bar' );
