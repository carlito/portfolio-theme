<?php

function get_featured_image($format, $array) {
  return get_the_post_thumbnail($format, $array);
}

function the_featured_image($format, $array) {
  echo get_the_post_thumbnail($format, $array);
}


function get_image( $options ) {

  // Vermutlich muss Post ID übergeben werden
  $image = wp_get_attachment_metadata( $options['id'] );

  ?>
  <figure id="<?php echo $options['id'] ?>" class="wp-caption alignnone"><?php echo get_the_post_thumbnail($options['id'], 'fullsize') ?><figcaption class="caption"><?php echo $image['image_meta']['caption'] ?></figcaption></figure>
  <?php
}



function get_slider( $options ) {
  echo load_template_part( 'parts/slider', get_post_type() != 'post' ? get_post_type() : get_post_format() );
}
