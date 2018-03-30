<?php

function imagegrid_add_body_classes( $classes ) {

  global $post;

  if ( ! is_single() and ! is_page() ) {
    return $classes;
  }

  if ( isset($post->ID) && get_the_post_thumbnail($post->ID) ) {
    $classes[] = 'has-featured-image';
  }
  return $classes;
}

add_filter( 'body_class', 'imagegrid_add_body_classes' );
