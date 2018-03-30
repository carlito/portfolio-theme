<?php
/**
 * Register Sidebar
 */

namespace IG\Sections;


function frontpage_top() {

	register_sidebar( array(
		'name'          => __( 'Frontpage Top', 'imagegrid' ),
		'id'            => 'frontpage_top',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', __NAMESPACE__ . '\\frontpage_top' );
