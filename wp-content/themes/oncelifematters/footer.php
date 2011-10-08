
	</section><!-- #page -->
</div><!-- .container -->

<div id="footer">
	<footer role="contentinfo">
		<section id="get-connected">
			<h2>Get Connected!</h2>
			<div class="connection"><a href="http://www.facebook.com/pages/Once-Life-Matters-Ministries-Inc/150766154998483?skip_nax_wizard=true"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" width="100" height="100" alt="Facebook" title="Facebook"></a></div>
			<div class="connection"><a href="http://twitter.com/oncelifematters" title="Twitter"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" width="100" height="100" alt="Twitter"></a></div>
			<div class="connection"><a href="<?php bloginfo('url'); ?>/blog" title="Blog"><img src="<?php bloginfo('template_directory'); ?>/images/blog.png" width="100" height="100" alt="Blog"></a></div>
			<div class="connection"><a href="<?php bloginfo('url'); ?>/contact-us" title="Contact Us"><img src="<?php bloginfo('template_directory'); ?>/images/contact.png" width="100" height="100" alt="Contact"></a></div>
		</section>
		
		<?php wp_nav_menu( array( 'container_class' => 'footer-navigation', 'theme_location' => 'footer' ) ); ?>
			
			<section id="site-info">
				 &copy; <?php echo date ('Y'); ?> - <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?> Ministries Inc </a>is a 501(c)(3) non-profit organization, gifts to which may be deductible as charitable contributions for federal income tax purposes.
					<span class="legal"><a href="<?php bloginfo('url'); ?>/terms-of-service">Terms of Service</a> | <a href="<?php bloginfo('url'); ?>/privacy-policy">Privacy Policy</a></span>
			</section><!-- #site-info -->

	</footer>
</div><!-- #footer -->

  <!-- scripts concatenated and minified via ant build script-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="<?php bloginfo ('template_directory'); ?>/js/script.js"></script>

<?php wp_footer(); ?>
</body>
</html>
