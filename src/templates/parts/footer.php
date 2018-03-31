
	</div><!-- .page-main -->

	<footer class="page-footer" role="contentinfo">

		<?php if (get_post_type() == 'post'): ?>
    <div class="single-post__bottom">
      <a class="button large" href="<?php echo site_url() ?>">More</a>
    </div>
    <?php endif; ?>

		<?php #get_sidebar( 'footer' ); ?>

		<div class="imprint">
			Impressum: Carlos Stockhausen · Ritterstr. 95 · 10969 Berlin
		</div>

	</footer><!-- #colophon -->

	<?php wp_footer(); ?>

</body>
</html>
