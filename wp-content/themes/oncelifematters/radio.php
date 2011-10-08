<?php
/*
	*	Template Name: Radio Broadcasts Page
*/
 get_header(); ?>

		<div id="content-container">
			<section id="content" role="main">
				
			<?php get_template_part( 'loop', 'page' ); ?>
			<?php rewind_posts(); ?>

			<?php query_posts("post_type=radio&posts_per_page=100"); ?>
			
			<?php if (have_posts()) : ?>
			
	<?php while (have_posts()) : the_post(); ?>
		<?php $audio = get_field('audio_file'); ?>
		<?php $custom_link = get_field('custom_link'); ?>
		<div class="radio-container">
			<span class="broadcast-title"><?php the_title(); ?></span>
			<span class="broadcast-details"><?php the_field('station_call_numbers'); ?> <?php the_field('aired_date'); ?></span>
			
			<?php if (get_field('audio_file')): ?>
			<?php if (function_exists("insert_audio_player")) {  
				  insert_audio_player('[audio:' . $audio . '|width=230px]');  } ?> 
				  <?php else: ?>
				  	<?php if (function_exists("insert_audio_player")) {  
				  insert_audio_player('[audio:' . $custom_link . '|width=230px]');  } ?> 
			<?php endif; ?>
			
		</div><!-- .radio-container -->
	<?php endwhile; else: ?>	
			
		<p>Sorry, No radio broadcasts posted at this time.  Check back soon!</p>
			
<?php endif; ?>
			

			</section><!-- #content -->
		</div><!-- #content-container -->

<?php get_footer(); ?>
