<div class="navbar">
  <div class="navbar__title">
    <a href="<?php echo site_url() ?>" title="Home" class="navbar__title-link ">
      <strong><?php bloginfo('name', 'display') ?></strong>
      <span class="description"><?php bloginfo('description', 'display') ?></span>
    </a>
  </div>

  <div class="right">
    <?php the_main_menu() ?>
    <?php #wp_dropdown_categories( array('show_option_all'=>'All', 'exclude'=>1) ); ?>
  </div>
</div>
