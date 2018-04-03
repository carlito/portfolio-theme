<?php

function member_add_meta_box() {
//this will add the metabox for the member post type
$screens = array( 'post' );

foreach ( $screens as $screen ) {

    add_meta_box(
        'member_sectionid',
        __( 'Member Details', 'member_textdomain' ),
        'member_meta_box_callback',
        $screen
    );
 }
}
add_action( 'add_meta_boxes', 'member_add_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function member_meta_box_callback( $post ) {

// Add a nonce field so we can check for it later.
wp_nonce_field( 'member_save_meta_box_data', 'member_meta_box_nonce' );

/*
 * Use get_post_meta() to retrieve an existing value
 * from the database and use the value for the form.
 */
$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

echo '<label for="member_new_field">';
_e( 'Phone Number', 'member_textdomain' );
echo '</label> ';
echo '<input type="text" id="member_new_field" name="member_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
 function member_save_meta_box_data( $post_id ) {

 if ( ! isset( $_POST['member_meta_box_nonce'] ) ) {
    return;
 }

 if ( ! wp_verify_nonce( $_POST['member_meta_box_nonce'], 'member_save_meta_box_data' ) ) {
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

 if ( ! isset( $_POST['member_new_field'] ) ) {
    return;
 }

 $my_data = sanitize_text_field( $_POST['member_new_field'] );

 update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}
add_action( 'save_post', 'member_save_meta_box_data' );
