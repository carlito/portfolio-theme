<?php get_template_part( 'parts/header' ); ?>

<div class="single-post">

  <?php if ( ! is_front_page() ): ?>
  <a class="home-button" href="<?php echo site_url() ?>">
    <?php the_svg('icon-home') ?>
    <span class="text">Home</span>
  </a>
  <?php endif; ?>


  <?php while(have_posts()) : the_post(); ?>
    <div class="featured-image">
      <?php the_post_thumbnail( 'fullsize', array('class' => '') ); ?>
      <?php if (get_post(get_post_thumbnail_id())->post_excerpt) { ?>
          <div class="featured-image__caption">
              <?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); // displays the image caption ?>
          </div>
      <?php } ?>
    </div>

    <div class="single-post__text">
      <h1 class="single-post__title"><?php the_title(); ?></h1>

      <?php the_old_post_notice(); ?>

      <div class="single-post__content">
        <?php the_content(); ?>
      </div>

      <?php if (get_post_type() != 'page'): ?>
      <div class="single-post__meta">
        <!-- Publishing Date -->
        <p class="publishing-date">
          <?php printf( __( 'Published on %s', 'imagegrid' ), get_the_date() ); ?>
        </p>
        <!-- Categories -->
        <?php if(has_category()) { the_category(', '); } ?>
        <!-- Tags -->
        <?php the_tags('<div class="tags"><span class="label">Tags</span> ', '', '</div>'); ?>
      </div>
      <?php endif; ?>

    </div>

  <?php endwhile; ?>
</div>

<div class="single-post__bottom">
  <a class="button large" href="<?php echo site_url() ?>">More</a>
</div>

<?php get_template_part( 'parts/footer' ); ?>
