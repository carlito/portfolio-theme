<?php

namespace Pr\Customization;


function listpage( $wp_customize ) {


  /*
   * Panel
   */

  // $wp_customize->add_panel( 'listpage_panel', array(
  //     'priority' => 10,
  //     'capability' => 'edit_theme_options',
  //     'theme_supports' => '',
  //     'title' => __( 'Lists', 'rampensau' ),
  //     'description' => __( 'Lists of post and episodes.', 'rampensau' ),
  // ) );


  /*
   * Section
   */

  $wp_customize->add_section( 'listpage_section', array(
      'priority' => 10,
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => __( 'Post Lists', 'rampensau' ),
      'description' => '',
      // 'panel' => 'listpage_panel',
  ) );


  /*
   * Setting: Listpage Style
   */

  $wp_customize->add_setting( 'listpage_style', array(
      'capability'  => 'edit_theme_options',
      'default'     => 'small-images',
      'type'        => 'option',
    )
  );

  $wp_customize->add_control( 'listpage_style',
    array(
      'label'     => __( 'Style', 'rampensau' ),
      'section'   => 'listpage_section',
      'settings'  => 'listpage_style',
      'type'      => 'select',
      'choices'   => array(
        'only-images'  => __( 'Only Images',  'rampensau' ),
        'big-images'   => __( 'Big Images',   'rampensau' ),
        'small-images' => __( 'Small Images', 'rampensau' ),
        'no-images'    => __( 'No Images',    'rampensau' ),
      ),
      'description' => __('The default style for posts lists. Note: Small and large images look the same on small screens.', 'rampensau')
    )
  );


  /*
   * Setting: Listpage Titles
   */

  $wp_customize->add_setting( 'listpage_titles', array(
      'capability' => 'edit_theme_options',
      'default'    => true,
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'listpage_titles',
    array(
      'label'     => __( 'Show Titles', 'rampensau' ),
      'section'   => 'listpage_section',
      'settings'  => 'listpage_titles',
      'type'      => 'checkbox',
    )
  );


  /*
   * Setting: Listpage Titles
   */

  $wp_customize->add_setting( 'listpage_description', array(
      'capability' => 'edit_theme_options',
      'default'    => true,
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'listpage_description',
    array(
      'label'       => __( 'Show Description', 'rampensau' ),
      'section'     => 'listpage_section',
      'settings'    => 'listpage_description',
      'type'        => 'checkbox',
      'description' => __('The description is always only visible for the big image style and on small screens.', 'rampensau')
    )
  );


  /*
   * Setting: Listpage Images
   * Moved to style setting
   */

  // $wp_customize->add_setting( 'listpage_images', array(
  //     'capability' => 'edit_theme_options',
  //     'default'    => '1',
  //     'type'       => 'option',
  //   )
  // );
  //
  // $wp_customize->add_control( 'listpage',
  //   array(
  //     'label'     => __( 'Show Images', 'rampensau' ),
  //     'section'   => 'listpage_section',
  //     'settings'  => 'listpage_images',
  //     'type'      => 'checkbox',
  //   )
  // );


  /*
   * Setting: Listpage Dates
   */

  $wp_customize->add_setting( 'listpage_dates', array(
      'capability' => 'edit_theme_options',
      'default'    => true,
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'listpage_dates',
    array(
      'label'     => __( 'Show Dates', 'rampensau' ),
      'section'   => 'listpage_section',
      'settings'  => 'listpage_dates',
      'type'      => 'checkbox'
    )
  );


  /*
   * Setting: Listpage Date Format
   */

  $wp_customize->add_setting( 'listpage_date_format', array(
      'capability' => 'edit_theme_options',
      'default'    => get_option('date_format'),
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'listpage_date_format',
    array(
      'label'     => __( 'Date Format', 'rampensau' ),
      'section'   => 'listpage_section',
      'settings'  => 'listpage_date_format',
      'type'      => 'text'
    )
  );



  /*
   * Setting: Listpage Offset
   * Output not implemented correctly yet
   */

  // $wp_customize->add_setting( 'listpage_offset', array(
  //     'capability'  => 'edit_theme_options',
  //     'default'     => 0,
  //     'type'        => 'option',
  //     'description' => __('Enter a number to start the post list not at the first post.', 'rampensau')
  //   )
  // );
  //
  // $wp_customize->add_control( 'listpage_offset',
  //   array(
  //     'label'     => __( 'Offset', 'rampensau' ),
  //     'section'   => 'listpage_section',
  //     'settings'  => 'listpage_offset',
  //     'type'      => 'text'
  //   )
  // );
}

add_action( 'customize_register', __NAMESPACE__ . '\\listpage' );
