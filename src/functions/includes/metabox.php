<?php


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



function create_metabox($metabox) {
  $field = $metabox['fields'][0];

  add_action( 'add_meta_boxes', function($metabox, $field) {
    foreach ( $field['screens'] as $screen ) {
      add_meta_box(
        $metabox['alias'],
        __( $metabox['label'], $metabox['textdomain'] ),
        function( $post ) {
          get_select_field($metabox, $field, $post);
        },
        $screen
      );
    }
  });


  add_action( 'save_post', function($metabox, $field) {
    if ( ! isset( $_POST[$metabox['alias'] . 'meta_box_nonce'] ) ) {
      return;
    }
    if ( ! wp_verify_nonce( $_POST[$metabox['alias'] . 'meta_box_nonce'], 'example_save_meta_box_data' ) ) {
      return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
    }
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
  });

}


create_metabox(array(
  'label' => 'Theme settings',
  'alias' => 'theme',
  'textdomain' => 'imagegrid',
  'fields' => array(
    array(
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
    )
  )
));
