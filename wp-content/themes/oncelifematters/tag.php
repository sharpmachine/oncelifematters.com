<?php get_header(); ?>

		<div id="content-container">
			<section id="content" role="main">
				<div class="page-links position-top">
					<h1 class="page-title"><?php
						printf( __( 'Tag Archives: %s', 'twentyten' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					?></h1>
				</div>

<?php get_template_part( 'loop', 'tag' ); ?>
			</section><!-- #content -->
		</div><!-- #content-container -->

<?php get_footer(); ?>
