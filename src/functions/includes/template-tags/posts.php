<?php

function post_older_than($days = 5) {
	$days = (int) $days;
	$offset = $days*60*60*24;

	if ( get_post_time() < date('U') - $offset ) {
		return true;
  }

	return false;
}


function the_old_post_notice( $text = 'This post is more than 2 years old.', $days = 730 ) {
	if ( post_older_than($days) ) {
		?>
		<strong class="old-post-notice"><?php echo $text ?></strong>
		<?php
	}
}
