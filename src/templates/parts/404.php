<h1 class="title">
  <div class="primary"><?php the_svg('icon-error'); ?> <?php _e('Page not found'); ?></div>
</h1>
<p><?php _e('This page doesn\'t exist or something went wrong.', 'privatradio'); ?>

<p>
  <a href="<?php echo home_url(); ?>" title="Home"><?php _e('Go to the home page', 'privatradio'); ?></a> <?php _e('or use the search:', 'privatradio'); ?>
</p>

<form role="search" method="get" class="searchform searchform--big" action="<?php echo home_url( '/' ); ?>">
  <label class="searchform-label"><?php echo _x( 'Search for:', 'label', 'privatradio' ) ?></label>
  <input
    type="search"
    class="searchform-input"
    placeholder="<?php echo esc_attr_x( 'Type…', 'placeholder', 'privatradio' ) ?>"
    value="<?php echo get_search_query() ?>"
    name="s"
    title="<?php echo esc_attr_x( 'Search for:', 'label', 'privatradio' ) ?>"
  />
  <input type="submit" class="searchform-submit" value="<?php _e('Search', 'privatradio') ?>">
</form>
