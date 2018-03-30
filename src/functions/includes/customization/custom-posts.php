<?php

namespace Pr\Customization;


function posts( $wp_customize ) {

  /*
   * Panel
   */

  // $wp_customize->add_panel( 'posts_panel', array(
  //     'priority' => 10,
  //     'capability' => 'edit_theme_options',
  //     'theme_supports' => '',
  //     'title' => __( 'Posts', 'rampensau' ),
  //     'description' => __( 'Settings for posts and episodes.', 'rampensau' ),
  // ) );


  /*
   * Section
   */

  $wp_customize->add_section( 'posts_section', array(
      'priority' => 10,
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => __( 'Posts', 'rampensau' ),
      'description' => '',
      // 'panel' => 'posts_panel',
  ) );


  /*
   * Setting: Show Tags
   */

  $wp_customize->add_setting( 'show_tags', array(
      'capability' => 'edit_theme_options',
      'default'    => true,
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'show_tags',
    array(
      'label'     => __( 'Show Tags', 'rampensau' ),
      'section'   => 'posts_section',
      'settings'  => 'show_tags',
      'type'      => 'checkbox',
      'description' => __( 'Display tags on posts and episodes pages.', 'rampensau' )
    )
  );


  /*
   * Setting: Show Comment Count
   */

  $wp_customize->add_setting( 'show_comment_count', array(
      'capability' => 'edit_theme_options',
      'default'    => false,
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'show_comment_count',
    array(
      'label'       => __( 'Show Comment Count', 'rampensau' ),
      'section'     => 'posts_section',
      'settings'    => 'show_comment_count',
      'type'        => 'checkbox',
      'description' => __( 'Show the comment count on the episode page.', 'rampensau' ),
    )
  );

}

add_action( 'customize_register', __NAMESPACE__ . '\\posts' );
