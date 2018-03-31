<?php

/*
 * Check for a taxonomy page
 */

function is_taxonomy_page() {
  if (
    is_category() ||
    is_tag() ||
    is_tax()
  ) {
    return true;
  }
}


/*
 * Check for subscribe button
 */

function has_subscribe_button() {
  if ( get_option('show_subscribe_button')
    && has_module('subscribe_button')
    && has_feeds() ) {
      return true;
    }
}


/*
 * Check for main post content
 */

function has_post_main() {
  if (
     ( get_option('listpage_titles')  ) or
     ( get_option('listpage_dates')   ) or
     ( get_option('listpage_excerpt') )
  ) {
    return true;
  }
}


/*
 * Get header classes
 */

function get_header_classes( $classes = '', $before = '', $after = '' ) {

  $classes_array[] = $classes;

  // Fullscreen Header
  if( get_option('header_style') == 'fullscreen') {
    $classes_array[] = 'fullscreen';
  }

  // Hide Title
  if( ! display_header_text()) {
    $classes_array[] = 'hide-title';
  }

  // Has BG & Cover Image
  if( is_single() && get_post_type() == 'podcast') {
    // Has BG image
    // if( has_header_image() ) {
    //   $classes_array[] = 'has-image';
    // }
    // Has Cover Image
    if( get_option('show_page_images') ) {
      $classes_array[] = 'has-cover';
    }
  } else if ( has_header_image() ) {
    if ( is_listpage() || is_front_page() ) {
      $classes_array[] = 'has-image';
    }
  }

  return $before . implode(' ', $classes_array);
}


/*
 * Display header classes
 */

function the_header_classes( $classes = '', $before = '', $after = '' ) {
  echo get_header_classes($classes, $before, $after);
}


/**
 * Display the podcast header image.
 */

function the_header_image() {

  if( has_header_image() ) {
    echo '<img class="page-header__image" src="' . get_custom_header()->url . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="" />';
  }
}


/**
 * Display the attributes for #page-main.
 */

function page_main_attributes() {

  if( is_listpage() ) {
    if ( is_active_sidebar( 'listpage_sidebar' ) ) {
      echo ' class="has-sidebar"';
    }
  }
}


/**
 * Get the custom logo.
 */

function get_logo() {

  $custom_logo_id = get_theme_mod( 'custom_logo' );
  $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
  return $image[0];
}


/**
 * Display the custom logo.
 */

function the_logo() {

  if( get_logo() ) {
    echo '<a class="site-logo__link" href="' . get_bloginfo('url') . '" title="' . __('To the home page', 'privatradio') . '"><img class="site-logo__image" src="' . get_logo() . '" alt="' . get_bloginfo('name') . '"></a>';
  }
}


/**
 * Get the image path.
 */

function get_image_path() {

  return get_template_directory_uri() . '/dist/images/';
}


/**
 * Get a Podlove template.
 */

function podlove_template( $template_id ) {

  return do_shortcode( '[podlove-template id="' . $template_id . '"]' );
}


/**
 * Get data from a theme options field.
 */

function theme_option( $id ) {
	$theme_options = get_option( 'theme-options' );

  if ( ! is_array( $theme_options ) ) {
    return false;
  }

	if ( array_key_exists( $id, $theme_options )) {
		return $theme_options[$id];
	} return false;
}


/**
 * Get comment meta.
 */

if ( ! function_exists( 'the_comment_meta' ) ) {

  function the_comment_meta( $string ) {
    $posted_on = sprintf( $string, get_comment_date( get_option('date_format') ), get_comment_time( get_option('time_format') ) );

    return printf( '<a href="%1$s" class="permalink">%2$s</a>', esc_url( get_comment_link() ), $posted_on );
  }
}


/**
 * Get the welcome text.
 */

function get_welcome_text() {


  // if( theme_option( 'show_welcome_text' ) !== 'on' ) {
  //   return false;
  // }
  //
  // // If welcome text is defined in theme options
  // $theme_option = theme_option( 'welcome_text' );
  // if ( trim( $theme_option ) != '' ) {
  //   return $theme_option;
  // }


  if ( ! has_podlove() ) {
    return false;
  }

  // Fallback to default podcast summary
  else if ( trim( \Rampensau\get_podcast_summary() ) != '' ) {
    return \Rampensau\get_podcast_summary();
  }
}


/**
 * Display the introduction.
 */

function the_introduction($before = '<div class="introduction-text">', $after = '</div>') {

  if( is_active_sidebar( 'introduction' ) ) {
    dynamic_sidebar( 'introduction' );
  }

  else if ( $welcome_text = get_welcome_text() ) {
    echo $before . $welcome_text . $after;
  }
}


/**
 * Get file title.
 */

function get_file_title( $file ) {
  return $file->asset()->title();
}


/**
 * Get file type.
 */

function get_file_type( $file ) {
  return $file->asset()->fileType()->type();
}


/*
 * Display credits
 */

function the_credits($before = '<p>', $after = '</p>') {

  $credits = [];
  $customized_note = '';
  $parent_theme = wp_get_theme(get_template());

  if(has_podlove()) {
    $credits[] = '<a href="http://podlove.org/" title="Podlove">Podlove</a>';

    if(has_module('auphonic')){
      $credits[] = '<a href="http://auphonic.com" title="Auphonic">Auphonic</a>';
    }

    if(has_module('bitlove')){
      $credits[] = '<a href="https://bitlove.org/" title="Bitlove">Bitlove</a>';
    }
  }

  if( count($credits) > 0 ) {
    // Implode array to string with commas and ampersand
    $credits_string = join(' &amp; ', array_filter(array_merge(array(join(', ', array_slice($credits, 0, -1))), array_slice($credits, -1)), 'strlen'));
    echo $before . __('Made with ', 'privatradio') . $credits_string . '<br>';
  }

  if( is_child_theme() ) {
    $child_theme = wp_get_theme();
    $customized_note = ' ' . __( '(customized)', 'privatradio' );
  }

  // Output
  echo sprintf(
    wp_kses(
      __( 'Theme: <a href="%1$s" title="%2$s">%2$s</a>%3$s', 'privatradio' ),
      array(
        'a' => array(
          'href'  => array(),
          'title' => array()
        )
      )
    ),
    esc_url( $parent_theme->get( 'ThemeURI' ) ),
    $parent_theme->get( 'Name' ),
    $customized_note
  );
}


/*
 * Get an edit link
 */

function get_edit_link($target, $role = 'administrator') {
  if ( get_user_role() == $role ) {
    #return '<a class="edit-link" href="' . get_site_url() . '/wp-admin/' . $target . '">Edit</a>';
  }
}


/*
 * Get a customize button
 */

function customize_button( $control_id, $style_class = 'regular' ) {
  if ( current_user_can( 'customize' ) ) {
    echo '<a class="button customize-button style-' . $style_class . '" href="' . admin_url( 'customize.php?autofocus[control]=' . $control_id ) . '" title="' . __('Customize') . '">' . __('Customize') . '</a>';
  }
}


/*
 * Get posts
 */

function get_posts_list( $args = array(), $show_doubles = true ) {

  $output = '';

  // Init $displayed_posts
  global $displayed_posts;
  if ( ! isset( $displayed_posts ) ) {
    $displayed_posts = array();
  }

  // Handle post__not_in
  // @todo doesn't work?
  if ( array_key_exists( 'post__not_in', $args ) ) {
    if ( ! is_array( $args['post__not_in'] ) ) {
      $args['post__not_in'] = explode( ',', $args['post__not_in'] );
    }
  }

  // Handle post__in
  if ( array_key_exists( 'posts', $args ) ) {
    if ( is_string( $args['posts'] ) ) {
      $post_ids = explode( ',', $args['posts'] );
      $args['post__in'] = $post_ids;
    }
  }

  // Handle post_type
  if ( array_key_exists( 'type', $args ) ) {
    if ( is_string( $args['type'] ) ) {
      $post_types = explode( ',', $args['type'] );
      $args['post_type'] = $post_types;
    }
  }

  // Hide doubles
  if ( ! $show_doubles ) {
    if ( ! array_key_exists( 'post__not_in', $args ) ) {
      $args['post__not_in'] = $displayed_posts;
    } else {
      $args['post__not_in'] = array_merge( $args['post__not_in'], $displayed_posts );
    }
  }

  // @todo Problem on taxonomy pages
  // $args['tax'] = null;
  // $args['tax_query'] = null;

  // Style
  if ( ! array_key_exists( 'style', $args ) ) {
    // $args['style'] = 'style-' . get_list_classes();
    $args['style'] = 'style-medium-images';
  }

  // Query
  $query = new \WP_Query( $args );

  // Loop
  if ( $query->have_posts() ) {
    $output .= '<ul class="imagegrid style-' . $args['style'] . '">';
    while ( $query->have_posts() ) : $query->the_post();
      if ( $show_doubles || ! in_array( get_the_ID(), $displayed_posts )) {
        $output .= '<li class="imagegrid__item">';
        $output .= load_template_part( 'parts/post', get_post_type() != 'post' ? get_post_type() : get_post_format() );
        $output .= '</li>';
        $displayed_posts[] = get_the_ID();
      }
    endwhile;
    $output .= '</ul>';
  } else {
    // No posts found
  }

  wp_reset_query();

  return $output;
}



// http://wordpress.stackexchange.com/questions/149099/only-show-content-before-more-tag

function get_content_before_more( $content = null ) {
  // Fetch post content
  if( $content == null ) {
    $content = get_post_field( 'post_content', get_the_ID() );
  }
  // Apply filter to get the paragraphs
  // http://stackoverflow.com/questions/27781798/wordpress-retain-formatting-when-calling-extended-content
  $content = apply_filters('the_content', $content);
  // Get content parts
  $content_parts = get_extended( $content );
  // Output part before <!--more--> tag
  return $content_parts['main'];
}

function get_content_after_more( $content = null ) {
  // Fetch post content
  if( $content == null ) {
    $content = get_post_field( 'post_content', get_the_ID() );
  }
  // Apply filter to get the paragraphs
  $content = apply_filters('the_content', $content);
  // Get content parts
  $content_parts = get_extended( $content );
  // Output part after <!--more--> tag
  return $content_parts['extended'];
}


/*
 * Will return true if there is a next page
 */
function has_next_page() {
  if ( get_next_posts_link() ) {
    return true;
  }
}

/*
 * Will return true if there is a previous page
 */
function has_previous_page() {
  if ( get_previous_posts_link() ) {
    return true;
  }
}

/*
 * Will return true if there is more than one page (either before or after).
 */
function has_pagination() {
  return has_next_page() or has_previous_page();
}
