<?php

namespace Pr\Customization;


/**
 * Custom Welcome Text Color
 */

function welcome_text_color( $wp_customize ) {

	$wp_customize->add_setting( 'welcome_text_color', array(
		'default' => ''
	) );

	$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'welcome_text_color', array(
		'label'    => __('Welcome Text Color', 'rampensau'),
		'section'  => 'colors',
		'settings' => 'welcome_text_color',
	) ) );
}

add_action( 'customize_register', __NAMESPACE__ . '\\welcome_text_color' );



/**
 * CSS Output
 */

function welcome_text_color_css() {

  $welcome_text_color = get_theme_mod( 'welcome_text_color' );

  if( $welcome_text_color != '' ): ?>
  	<style type="text/css">
			.welcome-text,
			.welcome-text a,
			.podcast-services ul > li a:link,
			.podcast-services ul > li a:visited {
				border-color: <?php echo $welcome_text_color; ?>;
				color: <?php echo $welcome_text_color; ?>;
			}
		</style>
  <?php endif;
}

add_action( 'wp_head', __NAMESPACE__ . '\\welcome_text_color_css' );
