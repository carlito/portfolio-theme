<?php

require_once 'custom-fields/field-header-image.php';

require_once 'custom-fields/field-style.php';


function get_select_field($metabox, $field, $post) {

  // Add a nonce field so we can check for it later.
  wp_nonce_field( 'example_save_meta_box_data', $metabox['alias'] . 'meta_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, $field['alias'], true );


  echo '<label for="' . $field['alias'] . '">';
  _e( $field['label'], 'member_textdomain' );
  echo '</label> ';
  echo '<select type="text" id="' . $field['alias'] . '" name="' . $field['alias'] . '" value="' . esc_attr( $value ) . '">';

  foreach($field['options'] as $option) {
    if($option['alias'] == $value) {
      $selected = ' selected';
    } else {
      $selected = '';
    }
    echo '<option value="' . $option['alias'] . '"' . $selected . '>' . $option['label'] . '</option>';
  }

  echo '</select>';
}
