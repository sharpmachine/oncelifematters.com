<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>    


				<div class="page-links position-top">
					<?php if($post->post_parent): ?>
					<h2><?php $parent_title = get_the_title($post->post_parent);
						echo $parent_title; ?>
					</h2>
					<ul class="children-links">
						<?php
							if (is_page( )) 
							{
								$page = $post->ID;
								if ($post->post_parent) {
								$page = $post->post_parent;
							}
						$children=wp_list_pages( 'echo=0&child_of=' . $page . '&title_li=' );
							if ($children) 
							{
								$output = wp_list_pages ('echo=0&child_of=' . $page . '&title_li=');
							}
						}
						echo $output;
						?>
					</ul>
					<?php else: ?>
						<h1><?php the_title(); ?></h1>
						<?php endif; ?>
				</div><!-- .page-links -->
				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<?php if($post->post_parent): ?>
						<?php if ( is_front_page() ) { ?>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php } else { ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php } ?>
					<?php endif; ?>
					
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
				
				<?php if (get_field('title')): ?>
					
				<div class="page-links">
					<h3><?php the_field('title'); ?></h3>
					<?php if (get_field('internal_link')): ?>
						<a href="<?php the_field('internal_link'); ?>" class="super-link" title="<?php the_field('title'); ?>">
					<?php endif ?>
					
					<?php if (get_field('external_link')): ?>
						<a href="<?php the_field('external_link'); ?>" class="super-link" title="<?php the_field('title'); ?>">
					<?php endif ?>
					
					<?php if (get_field('file')): ?>
						<a href="<?php the_field('file'); ?>" class="super-link" title="<?php the_field('title'); ?>">
					<?php endif ?>
					
						<?php the_field('link_title'); ?>
						
					</a>
				</div><!-- .page-links -->
				<?php endif; ?>

<?php endwhile; // end of the loop. ?>