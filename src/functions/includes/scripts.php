<?php

namespace IG\Scripts;

function theme_init() {

  if( ! is_admin()) {

    // jQuery
    wp_enqueue_script('jquery');

    // Scripts
    wp_register_script( 'scripts', get_bloginfo('template_directory') . '/scripts/main.js');
    wp_enqueue_script( 'scripts' );

    // Localize
    wp_localize_script( 'scripts', 'i18n', array(

      'toggleReadMore' => esc_html__('More', 'imagegrid'),
      'homeURL' => get_bloginfo('url')
    ) );
  }
}

add_action('init', __NAMESPACE__ . '\\theme_init');
