<?php if (is_category() ||is_archive()||is_single()) : ?>
<div id="categories" class="frontpage-top widget-area" role="complementary">
  <?php
   $category = get_the_category();
   if (in_category($category[0]->slug) || is_category($category[0]->slug)){
        dynamic_sidebar( $category[0]->slug.'-widget-area' );
    };
   ?>
</div><!-- #categories .widget-area -->
<?php endif; ?>

<ul class="imagegrid">
<?php while(have_posts()) : the_post(); ?>
  <li class="imagegrid__item<?php if(is_sticky()){ echo ' is-sticky'; } ?>">
    <?php get_template_part( 'parts/post' ); ?>
  </li>
<?php endwhile; ?>
</ul>

<?php if ( is_404() ): ?>
<div class="wrap">
  <?php get_template_part( 'parts/404' ); ?>
</div>
<?php endif; ?>
