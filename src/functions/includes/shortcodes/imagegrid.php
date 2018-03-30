<?php

namespace Pr\Shortcodes;


function shortcode_posts( $atts ){

  // Defaults
  extract( shortcode_atts( array(
    'parent'       => false,
    'type'         => 'post',
    'category'     => false,
    'order'        => 'date',
    'perpage'      => 4,
    'orderby'      => 'date',
    'order'        => 'DESC',
    'posts'        => [],
    'posts_not'    => false,
    'style'        => 'default',
    'hide_doubles' => false
  ), $atts ) );

  // Query arguments
  $query_args = array(
    'post_parent'    => $parent,
    'post_type'      => $type,
    'cat'            => $category,
    'posts_per_page' => $perpage,
    'sort_column'    => 'menu_order',
    'orderby'        => $orderby,
    'order'          => $order,
    'posts'          => $posts,
    'post__not_in'   => $posts_not,
    'style'          => $style,
  );

  return get_posts_list( $query_args, $hide_doubles );
}

add_shortcode( 'posts', __NAMESPACE__ . '\\shortcode_posts' );
