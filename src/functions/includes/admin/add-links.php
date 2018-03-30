<?php

namespace Pr\Admin;


/**
 * Add links to admin bar
 */


// Theme Dropdown

function toolbar_links_theme($wp_admin_bar) {

  // Theme Link
  $args = array(
    'id' => 'theme',
    'title' => __('Theme', 'imagegrid'),
    'href' => get_home_url() . '/wp-admin/admin.php?page=theme-options',
    'meta' => array(
      'class' => 'theme-options',
      'title' => __('Theme', 'imagegrid')
    )
  );
  $wp_admin_bar->add_node($args);

  // Customize Link
  $args = array(
    'id' => 'theme-customize',
    'title' => __('Customize', 'imagegrid'),
    'href' => get_home_url() . '/wp-admin/customize.php',
    'parent' => 'theme',
    'meta' => array(
      'class' => 'theme-customize',
      'title' => __('Customize', 'imagegrid')
    )
  );
  $wp_admin_bar->add_node($args);

  // Menus Link
  $args = array(
    'id' => 'theme-menus',
    'title' => __('Menus', 'imagegrid'),
    'href' => get_home_url() . '/wp-admin/nav-menus.php',
    'parent' => 'theme',
    'meta' => array(
      'class' => 'theme-menus',
      'title' => __('Menus', 'imagegrid')
    )
  );
  $wp_admin_bar->add_node($args);

  // Widgets Link
  $args = array(
    'id' => 'theme-widgets',
    'title' => __('Widgets', 'imagegrid'),
    'href' => get_home_url() . '/wp-admin/widgets.php',
    'parent' => 'theme',
    'meta' => array(
      'class' => 'theme-widgets',
      'title' => __('Widgets', 'imagegrid')
    )
  );
  $wp_admin_bar->add_node($args);

  // Options Link
  $args = array(
    'id' => 'theme-options',
    'title' => __('Options', 'imagegrid'),
    'href' => get_home_url() . '/wp-admin/admin.php?page=theme-options',
    'parent' => 'theme',
    'meta' => array(
      'class' => 'theme-options',
      'title' => __('Options', 'imagegrid')
    )
  );
  $wp_admin_bar->add_node($args);
}

add_action('admin_bar_menu', __NAMESPACE__ . '\\toolbar_links_theme', 999);
