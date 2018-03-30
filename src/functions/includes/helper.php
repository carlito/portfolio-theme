<?php

// namespace Pr\Helper;


/*
 * Check for Podlove plugin
 */

function has_podlove() {

  // Attempt to check for the plugin without knowing the folder name
  if( class_exists('Podlove\Model\Podcast') ) {
    return true;
  } else {
    return false;
  }

  // Old way
  // include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  // if (is_plugin_active('podlove-podcasting-plugin-for-wordpress/podlove.php') ) {
  //   return true;
  // } return false;
}


/*
 * Check for modules
 */

function has_module( $id ) {
  if ( ! has_podlove() ) {
    return false;
  }

  else if (\Podlove\Modules\Base::is_active( $id )) {
    return true;
  }
}


/**
 * Check for podcast feeds
 */

function has_feeds() {

  if ( ! has_podlove() ) return false;

  $feeds = \Pr\get_podcast_feeds();
  if( count($feeds) > 0 ) {
    return true;
  } return false;
}


/*
 * Load template part
 */

function load_template_part($template_name, $part_name=null) {
  ob_start();
  get_template_part($template_name, $part_name);
  $var = ob_get_contents();
  ob_end_clean();
  return $var;
}


/*
 * Check for current user role
 */

function get_user_role() {
  global $current_user;

  $user_roles = $current_user->roles;
  $user_role = array_shift($user_roles);

  return $user_role;
}


/*
 * Get current URL
 */

function get_current_url() {

  $custom_permalink = get_post_meta(get_the_ID(), 'custom_permalink');

  if($custom_permalink) {
    return bloginfo('url') . '/' . $custom_permalink[0];
  } else {
    global $wp;
    return home_url(add_query_arg(array(),$wp->request));
    // or:
    // get_permalink();
  }
}


/*
 * Get custom permalink
 */

function get_custom_permalink($post_id) {
  return get_post_meta($post_id, 'custom_permalink', true);
}


/*
 * Get custom field
 */

function get_custom_field($post_id, $field_id) {
  return get_post_meta($post_id, $field_id, true);
}



/*
 * Format bytes number to a readable string
 */

function format_bytes( $size, $unit="" ) {
  if( (!$unit && $size >= 1<<30) || $unit == " GB")
    return number_format($size/(1<<30),2)." GB";
  if( (!$unit && $size >= 1<<20) || $unit == " MB")
    return number_format($size/(1<<20),2)." MB";
  if( (!$unit && $size >= 1<<10) || $unit == " KB")
    return number_format($size/(1<<10),2)." KB";
  return number_format($size)." Bytes";
}


/*
 * Format time
 */

function format_time($string) {
	return substr($string, 0, strpos($string, '.'));
}

// function remove_leading_zeros($string) {
// 	return ltrim($string, '0');
// }



function pagination_class() {
  $prev_link = get_previous_posts_link();
  $next_link = get_next_posts_link();
  if ($prev_link && $next_link) {
    return 'two-links';
  } else {
    return 'one-link';
  }
}


/*
 * Timecode to number
 */

function timecode_to_int($timecode) {
  $timecode = str_replace(':', '', $timecode);
  $timecode = str_replace('.', '', $timecode);
  return $timecode;
}


/*
 * Make alias
 */

function make_alias( $string ) {

  if( is_string($string) ) {
    // Remove white space
    $string = preg_replace('/\s+/', '', $string);
    $string = strtolower($string);
    return $string;
  }
}


/*
 * Check for login page
 */

function is_login_page() {
    return in_array( $GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php') );
}


/*
 * Check for posts page
 */

function is_listpage() {
	return is_home();
}
