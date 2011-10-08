<?php
include 'shortcodes.php';
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 820;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
		'footer' => __( 'Footer Navigation'),
	) );


	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 * @since Twenty Ten 1.0
 */
function twentyten_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <p class="read-more"><a href="'. get_permalink() . '" class="super-link no-ml">' . __( 'Continue reading', 'twentyten' ) . '</a></p>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Twenty Ten 1.0
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'twentyten' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<div class="entry-meta posted-on-date"><span class="%1$s">Posted on</span> %2$s</div><div class="entry-meta posted-on-author"><span class="meta-sep">by</span> %3$s</div>', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

// Custom Functions
function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
  unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

function modify_footer_admin () {
  echo 'Created by <a href="http://sharpmachinemedia.com">Sharp Machine Media</a>.';
  echo '  Powered by <a href="http://WordPress.org">WordPress</a>.';
}

add_filter('admin_footer_text', 'modify_footer_admin');

//Custom logo should be 16 x16
function custom_logo() {
  echo '<style type="text/css">
    #header-logo  { 
    	background-image: url('.get_bloginfo('template_directory').'/images/admin-logo.png) !important; 
	}
	#cpt_info_box {
		display: none !important; /* Hides Custom Post Type info box */
	}
    </style>';
}

add_action('admin_head', 'custom_logo');

function custom_login_logo() {
  echo '<style type="text/css">
    h1 a { 
    	background-image:url('.get_bloginfo('template_directory').'/images/login-logo.png) !important;
	 }
	 
	 .login #nav a, .login #backtoblog a
	 {
		 color: #993333 !important;
	 }
		 
	input.button-primary, button.button-primary, a.button-primary 
	{
		border: none !important;
		font-weight: bold;
		color: #FFFF00 !important;
		background: #000 !important;
		text-shadow: none !important;
	}

    </style>';
}

add_action('login_head', 'custom_login_logo');

// Create the function to output the contents of our Dashboard Widget
function help_dashboard_widget_function() {
	// Display whatever it is you want to show
	echo '
		<ul style=width:40%;float:left;margin-right:55px;min-width:153px;>
			<li style=color:#666;font-size:14px;border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#DFDFDF;padding-bottom:5px;margin-bottom:10px;>WordPress 101 Videos:</li>
			<li><a href="http://wp.tutsplus.com/tutorials/wp101-video-training-part-1-the-dashboard/" target=_blank>Part 1: The Dashboard</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-2-creating-a-new-post/ target=_blank>Part 2: Creating A New Post</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-3-edit-existing-post/ target=_blank>Part 3: Edit Existing Post</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-4-using-categories-and-tags/ target=_blank>Part 4: Using Categories and Tags</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-5-creating-and-editing-pages/ target=_blank>Part 5: Creating and Editing Pages</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-6-adding-images/ target=_blank>Part 6: Adding Images &amp; Photos</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-7-embedding-video/ target=_blank>Part 7: Embedding Video</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-8-media-library/ target=_blank>Part 8: Media Library</a></li>
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-9-managing-comments/ target=_blank>Part 9: Managing Comments</a></li> 
			<li><a href=http://wp.tutsplus.com/tutorials/wp-101-video-training-part-10-creating-links/ target=_blank>Part 10: Creating Links</a></li>
		</ul>
		
		<ul style=width:40%;float:left;min-width:153px;>
			<li style=color:#666;font-size:14px;border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#DFDFDF;padding-bottom:5px;margin-bottom:10px;>Videos Specific To Your Site:</li>
			<li><a href=http://www.youtube.com/watch?v=qPtHdn9b7Ug target=_blank>OLM Site Overview</a></li>
			<li><a href=http://www.youtube.com/watch?v=uDuGmwjVJH4 target=_blank>OLM Using the Unique Features</a></li>
			<li><a href=http://www.youtube.com/watch?v=Ihgc5QQ90z8 target=_blank>Creating &amp; Adding Paypal Buttons</a></li>
			<li><a href=http://www.youtube.com/watch?v=QiWbTzPOTb8 target=_blank>Adding Videos &amp; Radio Broadcasts</a></li>
			<li><a href=http://www.youtube.com/watch?v=IE_10_nwe0c target=_blank>SEO Ultimate Tutorial</a></li>
			<li><a href=http://www.youtube.com/watch?v=AOjNLxhrgsg target=_blank>Managing Events</a></li>
			<li><a href=http://www.youtube.com/watch?v=9KEvKm7J4A8 target=_blank>Managing the Store</a></li>
			<li><a href=http://www.youtube.com/watch?v=YV-_TbfBzGo target=_blank>Managing Menus</a></li>
			<li><a href=http://www.youtube.com/watch?v=eeSeXrn3cJ0 target=_blank>Managing Users</a></li>
		</ul>
		
		<p style=clear:both;padding-top:5px;margin-bottom:0.5em;color:#666;font-size:14px;>Helpful Quick Links:</p>
		
		<a href=http://login.mailchimp.com target=_blank>Mailchimp Login</a> | 
		<a href=http://mailchimp.com/support/online-training target=_blank>Mailchimp Training</a> |
		<a href=http://docs.disqus.com/kb target=_blank>Disqus Training</a> |
		<a href=http://google.com/analytics target=_blank>Analytics Login</a> |
		<a href=http://oncelifematters.com/shortcodes/ target=_blank>Using Shortcodes</a>
		
		<p>Still stuck?  Give us a call at <strong>(480) 648-8229</strong> or email us at <a href=mailto:info@sharpmachinemedia.com?subject=Help!><strong>info@sharpmachinemedia.com</strong></a>.
	';
} 

// Create the function use in the action hook
function help_add_dashboard_widgets() {
	wp_add_dashboard_widget('help_dashboard_widget', 'Need Help?', 'help_dashboard_widget_function');	
} 

// Hook into the 'wp_dashboard_setup' action to register our other functions
add_action('wp_dashboard_setup', 'help_add_dashboard_widgets' );

// Remove items from admin menu
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('themes');
	$wp_admin_bar->remove_menu('new-theme');
	$wp_admin_bar->remove_menu('new-plugin');
	$wp_admin_bar->remove_menu('new-acf');
	$wp_admin_bar->remove_menu('widgets');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

// Add items to admin menu
function mytheme_admin_bar_render() {
	global $wp_admin_bar;
        $wp_admin_bar->add_menu( array(
        'parent' => 'comments',
        'id' => 'disqus',
        'title' => __('Disqus'),
        'href' => admin_url( 'edit-comments.php?page=disqus')
    ) );
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

function get_short_title(){
$tit = the_title('','',FALSE);
echo substr($tit, 0, 50);
if (strlen($tit) > 50) echo " ...";	
}


