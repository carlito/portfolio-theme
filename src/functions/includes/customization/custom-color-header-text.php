<?php

namespace Pr\Customization;


/**
 * Custom Header Text Color
 */

function header_text_color( $wp_customize ) {

	$wp_customize->add_setting( 'header_text_color', array(
  	'default' => ''
  ) );

  $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
  	'label'    => __('Header Text Color', 'rampensau'),
  	'section'  => 'colors',
  	'settings' => 'header_text_color',
  ) ) );
}

add_action( 'customize_register', __NAMESPACE__ . '\\header_text_color' );


/**
 * CSS Output
 */

function header_text_color_css() {

  $header_text_color    = get_theme_mod( 'header_text_color' );

  if ($header_text_color != ''): ?>
		<style type="text/css">
			#episode-header,
			.title .primary,
			.title .primary a:link,
			.title .primary a:visited,
			.title .secondary,
			#navigation-bar .menu > .menu-item a:link,
			#navigation-bar .menu > .menu-item a:visited,
			#episode-header .episode-subtitle,
			.introduction,
			#episode-nav,
			#tabs-list,
			/*.shownotes-box,*/
			.tabs-list-link,
			.tabs-list-link.active,
			.tabs-list-link:hover,
			.tabs-list-link:link,
			.tabs-list-link:visited,
			.tabs-list-link.active:hover,
			.podcast-services ul > li a:link,
			.podcast-services ul > li a:visited {
				color: <?php echo $header_text_color; ?>;
			}
			.podcast-services ul > li a:link,
			.podcast-services ul > li a:visited {
		    border: 2px solid rgba(<?php echo $header_text_color; ?>);
			}
		</style>
	<?php endif;
}

add_action( 'wp_head', __NAMESPACE__ . '\\header_text_color_css' );
