<?php

function style_field() {
  return array(
    'label' => 'Style',
    'alias' => 'style_field',
    'screens' => array( 'post' ),
    'options' => array(
      array(
        'alias' => 'default',
        'label' => 'Default'
      ),
      array(
        'alias' => 'fullscreen',
        'label' => 'Fullscreen'
      ),
      array(
        'alias' => 'mushrooms',
        'label' => 'Mushrooms'
      ),
    )
  );
}

function style_metabox() {
  return array(
    'label' => 'Theme settings',
    'alias' => 'theme',
    'textdomain' => 'imagegrid'
  );
}




function style_add_meta_box() {

  $field = style_field();
  $metabox = style_metabox();

  foreach ( $field['screens'] as $screen ) {

    add_meta_box(
      $metabox['alias'],
      __( $metabox['label'], $metabox['textdomain'] ),
      'style_meta_box_callback',
      $screen
    );
  }
}
add_action( 'add_meta_boxes', 'style_add_meta_box' );


/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function style_meta_box_callback( $post ) {

  $field = style_field();
  $metabox = style_metabox();

  get_select_field($metabox, $field, $post);
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function example_save_meta_box_data( $post_id ) {

  $field = style_field();
  $metabox = style_metabox();

  if ( ! isset( $_POST[$metabox['alias'] . 'meta_box_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST[$metabox['alias'] . 'meta_box_nonce'], 'example_save_meta_box_data' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  // Check the user's permissions.
  if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) ) {
      return;
    }

  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return;
    }
  }

  if ( ! isset( $_POST[$field['alias']] ) ) {
    return;
  }

  $my_data = sanitize_text_field( $_POST[$field['alias']] );

  update_post_meta( $post_id, $field['alias'], $my_data );
}
add_action( 'save_post', 'example_save_meta_box_data' );
