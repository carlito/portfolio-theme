<?php

namespace Pr\Customization;


function episodes( $wp_customize ) {


  /*
   * Section
   */

  $wp_customize->add_section( 'episodes_section', array(
      'priority' => 10,
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'title' => __( 'Episodes', 'rampensau' ),
      'description' => __( 'Settings for podcast episode pages.', 'rampensau' ),
  ) );


  /*
   * Setting: Episodes Player
   */

  $wp_customize->add_setting( 'audioplayer', array(
      'capability'  => 'edit_theme_options',
      'default'     => 'rampensau',
      'type'        => 'option',
    )
  );

  $wp_customize->add_control( 'audioplayer',
    array(
      'label'     => __( 'Player', 'rampensau' ),
      'section'   => 'episodes_section',
      'settings'  => 'audioplayer',
      'type'      => 'select',
      'choices'   => array(
        'default' => __( 'Simple', 'rampensau' ),
        'podlove' => __( 'Podlove', 'rampensau' ),
        // 'none'    => __( 'None', 'rampensau' ),
      ),
      'description' => __('Choose the audio player.', 'rampensau')
    )
  );


  /*
   * Setting: Show Contributors
   */

  if( has_module('contributors') ) {

    $wp_customize->add_setting( 'show_contributors', array(
        'capability' => 'edit_theme_options',
        'default'    => true,
        'type'       => 'option',
      )
    );

    $wp_customize->add_control( 'show_contributors',
      array(
        'label'       => __( 'Show Contributors', 'rampensau' ),
        'section'     => 'episodes_section',
        'settings'    => 'show_contributors',
        'type'        => 'checkbox',
        'description' => __( 'Display contributors in featured posts and on episode pages.', 'rampensau' )
      )
    );
  }


  /*
   * Setting: Hide Prefix
   */

  $wp_customize->add_setting( 'episodes_title_prefix', array(
      'capability' => 'edit_theme_options',
      'default'    => false,
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'episodes_title_prefix',
    array(
      'label'       => __( 'Hide Title Prefix', 'rampensau' ),
      'section'     => 'episodes_section',
      'settings'    => 'episodes_title_prefix',
      'type'        => 'checkbox',
      'description' => __( 'Check this if you use an episode title prefix (like EP001 or #1) but don\'t want to show it on the website anywhere.', 'rampensau' ),
    )
  );


  /*
   * Setting: Show images in lists
   */

  $wp_customize->add_setting( 'show_list_images', array(
      'capability' => 'edit_theme_options',
      'default'    => true,
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'show_list_images',
    array(
      'label'       => __( 'Show images in list views', 'rampensau' ),
      'section'     => 'episodes_section',
      'settings'    => 'show_list_images',
      'type'        => 'checkbox',
    )
  );


  /*
   * Setting: Show images on episode page
   */

  $wp_customize->add_setting( 'show_page_images', array(
      'capability' => 'edit_theme_options',
      'default'    => true,
      'type'       => 'option',
    )
  );

  $wp_customize->add_control( 'show_page_images',
    array(
      'label'       => __( 'Show image on the episode page', 'rampensau' ),
      'section'     => 'episodes_section',
      'settings'    => 'show_page_images',
      'type'        => 'checkbox',
    )
  );
}

add_action( 'customize_register', __NAMESPACE__ . '\\episodes' );
