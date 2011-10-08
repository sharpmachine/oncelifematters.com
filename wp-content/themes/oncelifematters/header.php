<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]>
<html class="no-js ie6" <?php language_attributes(); ?>> 
<![endif]-->
<!--[if IE 7 ]>    
<html class="no-js ie7" <?php language_attributes(); ?>> 
<![endif]-->
<!--[if IE 8 ]>    
<html class="no-js ie8" <?php language_attributes(); ?>>
 <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> 
<html class="no-js" <?php language_attributes(); ?>> 
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
	
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/icons/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/icons/apple-touch-icon.png">
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
	<link rel="image_src" href="http://oncelifematters.com/wp-content/themes/oncelifematters/images/fb-thumb.png" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print">
    <!--<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/wp-style.css">-->
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css">
	<!--[if lt IE 8]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen, projection"><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie8.css" type="text/css" media="screen, projection"><![endif]-->

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.7.min.js"></script>
	<!--[if lte IE 8]>
		<script src="<?php bloginfo('template_directory'); ?>/js/selectivizr-min.js"></script>
	<![endif]--> 

<?php

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="header">
	<header role="banner">
			
			<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"  title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> Homepage" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/logo4.png" alt="Logo" title="OLM Logo"></a></h1>

			<nav role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			</nav><!-- nav -->
	
	</header>
</div><!-- #header -->
<div class="container"> <!-- some layouts will require this to moved down just above the #main tag -->
	<section id="page">
