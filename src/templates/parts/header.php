<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

    <!--=== META TAGS ===-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="description" content="Keywords">
    <meta name="author" content="Name">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!--=== LINK TAGS ===-->
    <link rel="shortcut icon" href="<?php echo THEME_DIR; ?>/path/favicon.ico" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!--=== TITLE ===-->
    <title><?php wp_title(); ?> - <?php bloginfo( 'name' ); ?></title>

    <!--=== WP_HEAD() ===-->
    <?php wp_head(); ?>

    <link rel='stylesheet' id='imagegrid' href='<?php echo get_template_directory_uri(); ?>/style.css' type='text/css' media='all' />
</head>

<body <?php body_class(); ?>>

  <?php if ( is_front_page() || is_category() || is_archive() ): ?>
  <?php get_template_part( 'parts/navbar' ); ?>
  <?php endif; ?>


  <header class="page-header">

    <!-- Custom Logo -->
    <?php if( is_home() ) { the_logo(); } ?>

    <!-- Header Image -->
    <?php the_header_image(); ?>

  </header>


  <div class="page-main">

    <?php if ( is_front_page() && is_active_sidebar( 'frontpage_top' ) ) : ?>
    <div class="frontpage-top">
      <?php dynamic_sidebar( 'frontpage_top' ) ?>
    </div>
    <?php endif; ?>
