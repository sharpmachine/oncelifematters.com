<?php 
/*
	*	Template Name: Store Pages
*/
get_header(); ?>

		<div id="content-container">
			<section id="content" role="main">
				
			<?php get_template_part( 'loop', 'store' ); ?>

			</section><!-- #content -->
		</div><!-- #content-container -->

<?php get_footer(); ?>
