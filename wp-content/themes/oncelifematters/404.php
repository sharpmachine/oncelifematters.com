<?php get_header(); ?>

	<div id="content-container">
		<section id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<div class="page-links position-top">
					<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
				</div>
				
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
					<?php get_search_form(); ?>
					<h3>Try these links too!</h3>
					<?php wp_list_pages(); ?>
					<?php wp_list_categories(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</section><!-- #content -->
	</div><!-- #content-container -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>