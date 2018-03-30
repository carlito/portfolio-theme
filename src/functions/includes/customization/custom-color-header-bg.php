<?php

namespace Pr\Customization;


/**
 * Custom Header Background Color
 */

function header_bg_color( $wp_customize ) {

	$wp_customize->add_setting( 'header_bg_color', array(
  	'default' => ''
  ) );

  $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
  	'label'    => __('Header Background Color', 'rampensau'),
  	'section'  => 'colors',
  	'settings' => 'header_bg_color',
  ) ) );
}

add_action( 'customize_register', __NAMESPACE__ . '\\header_bg_color' );


/**
 * CSS Output
 */

function header_bg_color_css() {

  $header_bg_color    = get_theme_mod( 'header_bg_color' );

  if ($header_bg_color != ''): ?>
		<style type="text/css">
			.home .page-header,
			.blog .page-header {
				background-color: <?php echo $header_bg_color; ?>;
			}
		</style>
	<?php endif;
}

add_action( 'wp_head', __NAMESPACE__ . '\\header_bg_color_css' );
