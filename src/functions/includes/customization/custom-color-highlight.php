<?php

namespace Pr\Customization;


/**
 * Custom Highlight Color
 */

function highlight_color( $wp_customize ) {

  $wp_customize->add_setting( 'highlight_color', array(
  	'default' => '#00c3ff'
  ) );

  $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'highlight_color', array(
  	'label'    => __('Highlight Color', 'rampensau'),
  	'section'  => 'colors',
  	'settings' => 'highlight_color',
  ) ) );
}

add_action( 'customize_register', __NAMESPACE__ . '\\highlight_color' );


/**
 * CSS Output
 */

function highlight_color_css() {

  $highlight_color    = get_theme_mod( 'highlight_color' );

  if( $highlight_color != '' ): ?>
  	<style type="text/css">
      a:link,
      a:visited,
      a:active,
      a:hover,
      a:focus,
      .post-link:hover,
      .post-link:active,
      .post-link:focus,
      ul.posts-list .list-item.clickable:focus .post-link,
      ul.posts-list .list-item.clickable:hover .post-link,
      ul.posts-list .list-item.clickable:active .post-link,
      .page .page-header a:link,
      .page .page-header a:visited,
      .single:not(.single-podcast)
      .page-header a:link,
      .single:not(.single-podcast)
      .page-header a:visited,
      .progressbar.playing .expired-bar-info .left-time,
      .posts-list .list-item.clickable:hover .post-link,
      .page .page-header a:link:not(.button),
      .page .page-header a:visited:not(.button),
      .single:not(.single-podcast) .page-header a:link:not(.button),
      .single:not(.single-podcast) .page-header a:visited:not(.button) {
        color: <?php echo $highlight_color; ?>;
      }
      #commentform #author:focus,
      #commentform #email:focus,
      #commentform #comment:focus,
      #commentform #author:active,
      #commentform #email:active,
      #commentform #comment:active,
      input[type=text]:focus,
      input[type=text]:active,
      input[type=search]:focus,
      input[type=search]:active,
      textarea:focus,
      textarea:active {
        border-color: <?php echo $highlight_color; ?>;
      }
      input[type=submit],
      .playing .player-button-play,
      .progressbar.playing .expired-bar,
      .player-button-play:hover,
      .player-bar__progressbar-expired {
        background-color: <?php echo $highlight_color; ?>;
      }
      .playing .player-button-play:hover {
        background-color: #111;
      }
      /* Network menu */
      #navigation-bar .network-menu .menu-item a:focus,
      #navigation-bar .network-menu .menu-item a:hover,
      #navigation-bar .network-menu .menu-item a:active {
        background-color: <?php echo $highlight_color; ?>;
      }
      /* Subscribe button */
      .subscribe-button:link,
      .subscribe-button:visited,
      #navigation-bar .menu > .menu-list > .menu-item .subscribe-button:link,
      #navigation-bar .menu > .menu-list > .menu-item .subscribe-button:visited {
        background-color: <?php echo $highlight_color ?>;
      }
      /* Subscribe button popup */
      .podlove-subscribe-button,
      #podlove-subscribe-button,
      #podlove-subscribe-popup #podlove-subscribe-panel-clients li:active, #podlove-subscribe-popup #podlove-subscribe-panel-clients li:hover,
      #podlove-subscribe-popup #podlove-subscribe-panel-clients,
      #podlove-subscribe-popup #podlove-subscribe-button-help-panel, .device-cloud-switch button .podlove-subscribe-tab-active {
        background-color: <?php echo $highlight_color ?> !important;
      }
      #podlove-subscribe-popup #podlove-subscribe-popup-close-button, #podlove-subscribe-popup #podlove-subscribe-popup-help-button, #podlove-subscribe-popup .podlove-subscribe-back-button {
        color: <?php echo $highlight_color ?> !important;
      }
      .subscribe-button:hover,
      #navigation-bar .menu > .menu-list > .menu-item .subscribe-button:hover {
        background-color: #111;
      }
      .page-header .title .primary a:hover,
      .posts-list .post-link:hover {
        color: <?php echo $highlight_color; ?>;
      }
      /* Comments */
      .comment.bypostauthor {
        background-color: <?php echo $highlight_color; ?>;
      }
      .comment.bypostauthor:after {
        border-color: transparent <?php echo $highlight_color; ?>;
      }
    </style>
  <?php endif;
}

add_action( 'wp_head', __NAMESPACE__ . '\\highlight_color_css' );
