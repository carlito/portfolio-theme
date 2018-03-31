<?php

/**
 * This file contains customized WP elements
 */


 /**
  * Remove empty paragraphs from content
  */

//
// add_filter('the_content', 'removeEmptyParagraphs', 99999);


 /**
  * Pagination
  */

add_filter('next_posts_link_attributes'     , 'next_posts_link_attributes');
add_filter('previous_posts_link_attributes' , 'previous_posts_link_attributes');

function previous_posts_link_attributes() {
    return 'class="pagination__link pagination__link-previous"';
}

function next_posts_link_attributes() {
    return 'class="pagination__link pagination__link-next"';
}
