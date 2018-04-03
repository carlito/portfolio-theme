<?php

// https://wordpress.stackexchange.com/questions/67065/add-upload-media-button-in-meta-box-field

// add necessary scripts
add_action('plugins_loaded', function(){
  if($GLOBALS['pagenow']=='post.php'){
    add_action('admin_print_scripts', 'my_admin_scripts');
    add_action('admin_print_styles',  'my_admin_styles');
  }
});

function my_admin_scripts(){
  wp_enqueue_script('jquery');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
}

// Proper way to enqueue
// wp_register_script(
//   'my-upload',
//   WP_PLUGIN_URL.'/my-script.js',
//   array('jquery','media-upload','thickbox') /* dependencies */
// );
//
// wp_enqueue_script('my-upload');

function my_admin_styles(){
  wp_enqueue_style('thickbox');
}









add_action(
  'add_meta_boxes',
  function(){
    add_meta_box(
      'my-metaboxx1', // ID
      'Custom Thumbnail Image', // Title
      'func99999', // Callback (Construct function)
      get_post_types(), //screen (This adds metabox to all post types)
      'normal' // Context
    );
 },
 9
);
function func99999($post){
  $url = get_post_meta($post->ID, 'my-image-for-post', true); ?>
  <input id="my_image_URL" name="my_image_URL" type="text"
         value="<?php echo $url;?>" style="width:400px;" />
  <input id="my_upl_button" type="button" value="Upload Image" /><br/>
  <img src="<?php echo $url;?>" style="width:200px;" id="picsrc" />
  <script>
  jQuery(document).ready( function($) {
    jQuery('#my_upl_button').click(function() {
      window.send_to_editor = function(html) {
        imgurl = jQuery(html).attr('src')
        jQuery('#my_image_URL').val(imgurl);
        jQuery('#picsrc').attr("src", imgurl);
        tb_remove();
      }

      formfield = jQuery('#my_image_URL').attr('name');
      tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true' );
      return false;
    }); // End on click
  });
  </script>
<?php
}

add_action('save_post', function ($post_id) {
  if (isset($_POST['my_image_URL'])){
    update_post_meta($post_id, 'my-image-for-post', $_POST['my_image_URL']);
  }
});
