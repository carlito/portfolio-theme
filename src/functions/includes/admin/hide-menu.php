<?php

namespace Pr\Admin;

/**
 * Custom Option: Hide admin bar
 */

if ( theme_option('hide_admin_menu') == 'on' ) {
  add_filter( 'show_admin_bar', '__return_false' );
}
