<?php

namespace Ig\Shortcodes;


function shortcode_slider( $atts ){

  // Defaults
  extract( shortcode_atts( array(
    'id' => 'id'
  ), $atts ) );

  // Query arguments
  $args = array(
    'id'    => $id,
  );

  return get_slider( $args );
}

add_shortcode( 'slider', __NAMESPACE__ . '\\shortcode_slider' );
