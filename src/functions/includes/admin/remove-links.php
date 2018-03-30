<?php

namespace Pr\Admin;


/**
 * Remove links from admin bar
 */

function remove_admin_bar_links() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
  $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
  $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
  $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
  $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
  // $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
  // $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
  // $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
  // $wp_admin_bar->remove_menu('updates');          // Remove the updates link
  // $wp_admin_bar->remove_menu('comments');         // Remove the comments link

  // $wp_admin_bar->remove_menu('new-content');      // Remove the content link

  // $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
  //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
  $wp_admin_bar->remove_menu('customize');
}

add_action( 'wp_before_admin_bar_render', __NAMESPACE__ . '\\remove_admin_bar_links' );
