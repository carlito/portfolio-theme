<?php

/**
 * Get menu toggle elements
 */

if ( ! function_exists( 'get_menu_toggle' ) ) {
  function get_menu_toggle() {
    return '<label class="menu-toggle-label" for="menu-toggle">' . __('Menu', 'privatradio') . '</label><input type="checkbox" id="menu-toggle" class="menu-toggle">';
  }
}


/**
 * Get the main menu.
 */

if ( ! function_exists( 'get_main_menu' ) ) {

  function get_main_menu( $options = null ) {

    $menu_toggle = get_menu_toggle();

    if ( has_nav_menu( 'main-menu' ) ) {

      $main_menu   = wp_get_nav_menu_object( 'main-menu' );

      $options = array(
        'container_class' => 'main-menu menu-wrap',
        'echo'            => false,
        'fallback_cb'     => false,
        'items_wrap'      => '<h2 class="hide">' . __('Main Menu:', 'privatradio') . '</h2>' . $menu_toggle . '<nav role="navigation" id="%1$s" class="%2$s"><ul class="menu-list">%3$s</ul></nav>',
        'theme_location'  => 'main-menu',
      );

      return wp_nav_menu( $options );
    }
  }
}


/**
 * Display the main menu.
 */

if ( ! function_exists( 'the_main_menu' ) ) {

  function the_main_menu( $options = null ) {
    echo get_main_menu( $options );
  }
}


/**
 * Display the footer menu.
 */

if ( ! function_exists( 'get_footer_menu' ) ) {

  function get_footer_menu() {

    $footer_menu = wp_get_nav_menu_object( 'footer-menu' );

    if( $footer_menu ) {

      $options = array(
        'container_class' => 'footer-menu menu-wrap',
        'echo'            => false,
        'items_wrap'      => '<h2 class="hide">' . __('Footer Menu:', 'privatradio') . '</h2> <nav id="%1$s" class="%2$s" role="navigation"><ul class="menu-list">%3$s</ul></nav>',
        'theme_location'  => 'footer-menu',
      );

      // @todo: Add $options

      echo wp_nav_menu( $options );
    }
  }
}


/**
 * Display the footer menu.
 */

if ( ! function_exists( 'the_footer_menu' ) ) {

  function the_footer_menu() {
    echo get_footer_menu();
  }
}
