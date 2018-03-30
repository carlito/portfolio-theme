<?php

namespace Pr\Shortcodes;


function shortcode_image( $atts ){

  // Defaults
  extract( shortcode_atts( array(
    'id' => 'id'
  ), $atts ) );

  // Query arguments
  $args = array(
    'id'    => $id,
  );

  return get_image( $args );
}

add_shortcode( 'image', __NAMESPACE__ . '\\shortcode_image' );
