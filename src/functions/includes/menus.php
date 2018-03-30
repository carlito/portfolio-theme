<?php

namespace IG;


/*
 * Enable menus
 */

add_theme_support( 'menus' );


/*
 * Register menus
 */

function register_menus() {
	register_nav_menu('main-menu'    , __( 'Main Menu' ));
	register_nav_menu('footer-menu'  , __( 'Footer Menu' ));
}

add_action( 'init', __NAMESPACE__ . '\\register_menus' );
