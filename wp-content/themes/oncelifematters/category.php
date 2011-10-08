<?php get_header(); ?>

		<div id="content-container">
			<section id="content" role="main">
				<div class="page-links position-top">
					<h1 class="page-title"><?php
						printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>
				</div>
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				get_template_part( 'loop', 'category' );
				?>

			</section><!-- #content -->
		</div><!-- #content-container -->

<?php get_footer(); ?>
