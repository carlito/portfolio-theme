<?php

/*
 * Post images
 */

add_theme_support( 'post-thumbnails' );
add_theme_support( 'align-wide' );

add_image_size( 'grid-large', 800, 800, true, array( 'center', 'center' ) );
add_image_size( 'fullsize', 2400, false, true );
