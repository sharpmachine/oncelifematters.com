<?php 
/*
	*	Template Name: Home Page
*/
get_header(); ?>

		<div id="content-container">
			<section id="content" role="main">
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
				<section class="frontpage-links">
					<h3>Getting To Know OLM</h3>
					<div class="take-me-there">
						<a href="<?php bloginfo('url'); ?>/events"><img src="<?php bloginfo('template_directory'); ?>/images/events.png" width="130" height="95" alt="Events"></a>
						<a href="<?php bloginfo('url'); ?>/events" class="lets-go">Events</a>
					</div>
					<div class="take-me-there"><a href="#">
						<a href="<?php bloginfo('url'); ?>/testimonies"><img src="<?php bloginfo('template_directory'); ?>/images/testimonies.png" width="130" height="95" alt="Testimonies"></a>
						<a href="<?php bloginfo('url'); ?>/testimonies" class="lets-go">Testimonies</a>
					</div>
					<div class="take-me-there">
						<a href="<?php bloginfo('url'); ?>/about/the-ministry"><img src="<?php bloginfo('template_directory'); ?>/images/about-ministry.png" width="130" height="95" alt="About Ministry"></a>
						<a href="<?php bloginfo('url'); ?>/about/the-ministry" class="lets-go">The Ministry</a>
					</div>
				</section>
				
				<section class="featured-video">
					<h3>Featured Video</h3>
					<a href="media" class="super-link">See All Media</a>
					
					<?php query_posts('post_type=videos&posts_per_page=1') ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<iframe width="350" height="226" src="http://www.youtube.com/embed/<?php the_field('youtube_video_id'); ?>" frameborder="0" allowfullscreen></iframe>
								
				<?php endwhile; ?>
								
				<?php else : ?>
								
					<p>No videos yet...check back soon</p>
								
						<?php endif; ?>
						
				</section>
				
				<div class="clear">&nbsp;</div>
				<div class="page-links">
					<h3>The Once Life Matters Blog</h3>
					
					<?php query_posts(array("post__not_in" =>get_option("sticky_posts"), "posts_per_page" => 1)); ?>
					<?php get_template_part( 'loop', 'index' ); ?>
					<a href="blog" class="super-link">See All Posts</a>
				</div>
			
			
			</section><!-- #content -->
		</div><!-- #content-container -->


<?php get_footer(); ?>
