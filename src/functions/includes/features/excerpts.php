<?php

/*
 * Excerpts
 */

function add_excerpts() {
	add_post_type_support( 'post', 'excerpt' );
	add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', __NAMESPACE__ . '\\add_excerpts' );
