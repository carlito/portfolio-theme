<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <a class="imagegrid__link chocolat-image" href="<?php the_permalink(); ?>">
    <?php the_featured_image_thumb(); ?>
    <div class="overlay">
      <h2 class="title"><?php the_title(); ?></h2>
    </div>
  </a>
</article>
