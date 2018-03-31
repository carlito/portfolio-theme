<?php if (has_pagination()): ?>
<div class="pagination">
	<?php next_posts_link( '<span class="icon icon-arrow-left"></span> <span class="text">' . __('Older Posts', 'privatradio') . '</span>' ); ?>
	<?php previous_posts_link( '<span class="text">' . __('Newer Posts', 'privatradio') . '</span> <span class="icon icon-arrow-right"></span>' ); ?>
</div>
<?php endif; ?>
