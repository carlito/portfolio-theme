<?php

require_once 'widget-areas/frontpage-top.php';



// Generate widget areas for every category

add_action( 'widgets_init', 'generate_widget_areas' );

function generate_widget_areas() {

  $terms = get_categories('exclude=1&hide_empty=0');

  foreach ($terms as $term) {
    register_sidebar( array(
      'name' => 'Category '.$term->name,
      'id' => $term->slug.'-widget-area',
      'description' => 'Widget area for category and posts in '.$term->name,
      'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>'
    ) );
  }
}
