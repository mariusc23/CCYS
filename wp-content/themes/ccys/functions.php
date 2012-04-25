<?php
/**
 * Toolbox functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
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
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'toolbox_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override toolbox_setup() in a child theme, add your own toolbox_setup to your child theme's
 * functions.php file.
 */
function toolbox_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on toolbox, use a find and replace
	 * to change 'toolbox' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'toolbox', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'toolbox' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );
}
endif; // toolbox_setup

/**
 * Tell WordPress to run toolbox_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'toolbox_setup' );

/**
 * Set a default theme color array for WP.com.
 */
$themecolors = array(
	'bg' => 'ffffff',
	'border' => 'eeeeee',
	'text' => '444444',
);

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function toolbox_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'toolbox_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function toolbox_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar 1', 'toolbox' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Sidebar 2', 'toolbox' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'toolbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Above Article', 'toolbox' ),
		'id' => 'sidebar-3',
		'description' => __( 'Area above main content', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	/* Football Sidebar */
	register_sidebar( array(
		'name' => __( 'Tiny Mites Football', 'toolbox' ),
		'id' => 'sidebar-4',
		'description' => __( 'Remember to set widget logic to is_page(16)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Mighty Mites Football', 'toolbox' ),
		'id' => 'sidebar-5',
		'description' => __( 'Remember to set widget logic to is_page(10)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Jr Pee Wee Football', 'toolbox' ),
		'id' => 'sidebar-6',
		'description' => __( 'Remember to set widget logic to is_page(12)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Pee Wee Football', 'toolbox' ),
		'id' => 'sidebar-7',
		'description' => __( 'Remember to set widget logic to is_page(14)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Jr Midget Football', 'toolbox' ),
		'id' => 'sidebar-8',
		'description' => __( 'Remember to set widget logic to is_page(157)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Midget Football', 'toolbox' ),
		'id' => 'sidebar-9',
		'description' => __( 'Remember to set widget logic to is_page(18)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	/* Cheer Sidebar */
	register_sidebar( array(
		'name' => __( 'Tiny Mites Cheer', 'toolbox' ),
		'id' => 'sidebar-14',
		'description' => __( 'Remember to set widget logic to is_page(69)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Mighty Mites Cheer', 'toolbox' ),
		'id' => 'sidebar-15',
		'description' => __( 'Remember to set widget logic to is_page(72)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Jr Pee Wee Cheer', 'toolbox' ),
		'id' => 'sidebar-16',
		'description' => __( 'Remember to set widget logic to is_page(74)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Pee Wee Cheer', 'toolbox' ),
		'id' => 'sidebar-17',
		'description' => __( 'Remember to set widget logic to is_page(76)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Jr Midget Cheer', 'toolbox' ),
		'id' => 'sidebar-18',
		'description' => __( 'Remember to set widget logic to is_page(78)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Midget Cheer', 'toolbox' ),
		'id' => 'sidebar-19',
		'description' => __( 'Remember to set widget logic to is_page(80)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	/* Other */
	register_sidebar( array(
		'name' => __( 'Above Football', 'toolbox' ),
		'id' => 'sidebar-10',
		'description' => __( 'Reg info above team pages. Remember to set widget logic to is_page(6)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Above Cheer', 'toolbox' ),
		'id' => 'sidebar-11',
		'description' => __( 'Reg info above team pages. Remember to set widget logic to is_page(67)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Football Page Sidebar', 'toolbox' ),
		'id' => 'sidebar-12',
		'description' => __( 'Reg info above team pages. Remember to set widget logic to is_page(6)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Cheer Page Sidebar', 'toolbox' ),
		'id' => 'sidebar-13',
		'description' => __( 'Reg info above team pages. Remember to set widget logic to is_page(67)', 'toolbox' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => "</section>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'init', 'toolbox_widgets_init' );

if ( ! function_exists( 'toolbox_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Toolbox 1.2
 */
function toolbox_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>">
		<h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'toolbox' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'toolbox' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'toolbox' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'toolbox' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'toolbox' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // toolbox_content_nav


if ( ! function_exists( 'toolbox_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own toolbox_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Toolbox 0.4
 */
function toolbox_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'toolbox' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'toolbox' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'toolbox' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'toolbox' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'toolbox' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'toolbox' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for toolbox_comment()

if ( ! function_exists( 'toolbox_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own toolbox_posted_on to override in a child theme
 *
 * @since Toolbox 1.2
 */
function toolbox_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'toolbox' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'toolbox' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Toolbox 1.2
 */
function toolbox_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'toolbox_body_classes' );

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Toolbox 1.2
 */
function toolbox_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so toolbox_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so toolbox_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in toolbox_categorized_blog
 *
 * @since Toolbox 1.2
 */
function toolbox_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'toolbox_category_transient_flusher' );
add_action( 'save_post', 'toolbox_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function toolbox_enhanced_image_navigation( $url ) {
	global $post, $wp_rewrite;

	$id = (int) $post->ID;
	$object = get_post( $id );
	if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'toolbox_enhanced_image_navigation' );

// Add Shortcodes
function scores_shortcode($atts) {
	extract(shortcode_atts(array(
	  'home' => 'not',
	  'o' => 'TBA',
	  's' => '',
	), $atts));
 
 	$is_it_home = '<div class="scores-img-ph"></div>';
	if ($home != 'not') {
		$is_it_home = '<img src="/ccys/wp-content/themes/ccys/images/home.png" alt="Home game" />';
	};

	return '<span class="home">' . $is_it_home . '</span><span class="opponent">' . $o . '</span><span class="score">' . $s . '</span>';
}
add_shortcode('sc', 'scores_shortcode');



// Disable wpautop on certain pages
function get_rid_of_wpautop(){
  if(is_page(105)){
    remove_filter ('the_content', 'wpautop');
    remove_filter ('the_excerpt', 'wpautop');
  }
}

add_action( 'template_redirect', 'get_rid_of_wpautop' );

// Use Custom jQuery URL
function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
    
    wp_register_script( 
    	'less',
    	get_template_directory_uri() . '/js/less-1.2.2.min.js',
    	array(),
    	1.22,
    	false
    );
    wp_enqueue_script( 'less' );
    
    wp_register_script( 
    	'html5',
    	get_template_directory_uri() . '/js/html5.js',
    	array('modernizr'),
    	1,
    	true
    );
    wp_enqueue_script( 'html5' );

	wp_register_script( 
		'ccys',
		get_template_directory_uri() . '/js/ccys.js',
		array(),
		1,
		true
	);
	wp_enqueue_script( 'ccys' );    
    
    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.20866.js', array('jquery'), 0.1, true);
    wp_enqueue_script( 'modernizr' );
}; 
add_action('wp_enqueue_scripts', 'my_scripts_method');

// Disable Contact Form 7 AJAX
define ('WPCF7_LOAD_JS', false );

// MailChimp Integration
function wpcf7_send_to_mailchimp($cfdata) {

$formtitle = $cfdata->title;
$formdata = $cfdata->posted_data;
$send_this_email = $formdata['email'];
$reg_cu_name = '';
$reg_cu_name = $formdata['cu_child_name'];
	if ($reg_cu_name == '') {
		$reg_cu_name = $formdata['ch_first_name'] . ' ' . $formdata['ch_last_name'];
	};
$mergeVars = array(
'PNAME'=>$formdata['con_guardian'],
'PNUMBER'=>$formdata['con_phone'],
'CNAME'=>$reg_cu_name,
'CAGE'=>$formdata['cu_child_age'],
'CWEIGHT'=>$formdata['cu_child_weight'],
'MSG'=>$formdata['cu_msg'],
'GROUPINGS'=>array( array('name'=>'Form Used', 'groups'=>$formtitle),
));

// MCAPI.class.php needs to be in theme folder
require_once('MCAPI.class.php');

// grab an API Key from http://admin.mailchimp.com/account/api/
$api = new MCAPI('c6ee37bdabb9ae8ab1fb36a93e752f3e-us4');
$api_key = 'c6ee37bdabb9ae8ab1fb36a93e752f3e-us4';

// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
// Click the "settings" link for the list - the Unique Id is at the bottom of that page.
$list_id = "bc67aa5f97";

// Send the form content to MailChimp List without double opt-in
$retval = $api->listSubscribe($list_id, $send_this_email, $mergeVars, 'html', false);
	
	// Debug (uncomment)
	//if ($api->errorCode){
	//	echo "Unable to load listSubscribe()!\n";
	//	echo "\tCode=".$api->errorCode."\n";
	//	echo "\tMsg=".$api->errorMessage."\n";
	//} else {
	//    echo "Subscribed!\n";
	//}

}
add_action('wpcf7_mail_sent', 'wpcf7_send_to_mailchimp', 1);


// Print PDF after form is submitted
//add_action( 'wpcf7_mail_sent', 'wpcf7_email_pdf', 8 );
//
//function wpcf7_email_pdf($contact_form) {
//		
//}

// Attach pdf file
add_action( 'wpcf7_before_send_mail', 'wpcf7_attach_regform', 9 );

function wpcf7_attach_regform( $contact_form ) {
	//check if this is the right form
	if ($contact_form->id==123){
		$uploads = wp_upload_dir();
		
		if ($contact_form->mail['use_html']==true)
			$nl="<br/>";
		else
			$nl="\n";
		$title = $contact_form->title;
		$posted_data = $contact_form->posted_data;
	
	
		// Your Child
		$ch_first_name = $posted_data['ch_first_name'];
		$ch_last_name = $posted_data['ch_last_name'];
		$ch_middle_name = $posted_data['ch_middle_name'];
		$ch_birthday = $posted_data['ch_birthday'];
		$ch_birthmonth = $posted_data['ch_birthmonth'];
		$ch_birthyear = $posted_data['ch_birthyear'];
		$ch_gender = $posted_data['ch_gender'];
		$ch_sport = $posted_data['ch_sport'];
		
		// Your School
		$s_school = $posted_data['s_school'];
		$s_grade = $posted_data['s_grade'];
		$s_gpa = $posted_data['s_gpa'];
		
		// Your Contact Info
		$con_guardian = $posted_data['con_guardian'];
		$con_relationship = $posted_data['con_relationship'];
		$con_phone = $posted_data['con_phone'];
		$email = $posted_data['email'];
		
		// Your Address
		$con_street = $posted_data['con_street'];
		$con_city = $posted_data['con_city'];
		$con_state = $posted_data['con_state'];
		$con_zip = $posted_data['con_zip'];
		
		// Emergency Contact Info
		$er_name = $posted_data['er_name'];
		$er_relationship = $posted_data['er_relationship'];
		$er_phone = $posted_data['er_phone'];
		$er_cellphone = $posted_data['er_cellphone'];
		
		/**
		 * Creates an example PDF TEST document using TCPDF
		 * @package com.tecnick.tcpdf
		 * @abstract TCPDF - Example: Default Header and Footer
		 * @author Nicola Asuni
		 * @since 2008-03-04
		 */
		
		require_once('tcpdf/config/lang/eng.php');
		require_once('tcpdf/tcpdf.php');
		
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('TCPDF Example 001');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		// Disable header and footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		//set some language-dependent strings
		$pdf->setLanguageArray($l);
		
		// ---------------------------------------------------------
		
		// set default font subsetting mode
		$pdf->setFontSubsetting(true);
		
		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('times', '', 9.8, '', true);
		
		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();
		
		// Define some variables
		// Gender
		$gender_male = '';
		$gender_female = '';
		
		if ($ch_gender == 'male') {
			$gender_male = "X";
		} elseif ($ch_gender == 'female') {
			$gender_female = "X";
		};
		// Sport
		$sport_football = "";
		$sport_cheer = "";
		$sport_dance = "";
		
		if ($ch_sport == "football") {
			$sport_football = "X";
		} elseif ($ch_sport == "cheer") {
			$sport_cheer = "X";
		} else {
			$sport_dance = "X";
		}
		// Non-required
		$ch_middle_name = "";
		$er_cellphone = "";
		
		
		// Set some content to print
		$html = '
			<style>
				.red {
					color: #ff0000;
				}
				.underline {
					text-decoration: underline;
				}
			</style>
			<h1>Pop Warner Little Scholars, Inc.</h1>
			<p style="font-weight: bold;">2012 PARTICIPANT CONTRACT AND PARENTAL CONSENT FORM</p>
			<u>Special Note</u>: <span class="red">This form must be dated after January 1, 2012 and is <u>APPLICABLE ONLY FOR THE 2012 SEASON.</u></span>
			<p>This form must be submitted to your LOCAL organization prior to the athlete participating in Pop Warner.  No other forms are acceptable.<br />  
			Every Pop Warner Association must have a fully completed and signed original of this form prior to allowing the athlete to participate.</p>
		
			<!-- Begin Form -->
		
			<p>Legal Name of Participant (must match birth certificate</p>
			<p>Last <span class="underline"> &nbsp;&nbsp;&nbsp; ' . $ch_last_name . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; First <span class="underline"> &nbsp;&nbsp;&nbsp; ' . $ch_first_name . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; Middle <span class="underline"> &nbsp;&nbsp;&nbsp; ' . $ch_middle_name . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; Also known as____________________</p>
		
			<!-- Address -->
		
			<p>Address <span class="underline"> &nbsp;&nbsp;&nbsp; ' . $con_street . ' &nbsp;&nbsp;&nbsp; </span></p>
			<p>City <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_city . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
			State <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_state . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
			Zip <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_city . ' &nbsp;&nbsp;&nbsp; </span></p>
			
			<!-- Phone, Birthday, Gender -->
			
			<p>Phone No <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_phone . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
			Birthdate <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $ch_birthday . ' ' . $ch_birthmonth . ' ' . $ch_birthyear . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
			Gender <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $gender_male . ' &nbsp;&nbsp;&nbsp; </span> Male &nbsp;&nbsp;&nbsp; <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $gender_female . ' &nbsp;&nbsp;&nbsp; </span>Female</p>
			
			<!-- Sport -->
			
			<p>Gender  &nbsp;&nbsp;&nbsp; <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $sport_football . ' &nbsp;&nbsp;&nbsp; </span> Football &nbsp;&nbsp;&nbsp; <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $sport_cheer . ' &nbsp;&nbsp;&nbsp; </span>Cheer &nbsp;&nbsp;&nbsp; <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $sport_dance . ' &nbsp;&nbsp;&nbsp; </span>Dance</p>
			
			<!-- School -->
			
			<p>School <span class="underline"> &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; ' . $s_school . ' &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; </span>
			  Grade Level <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $s_grade . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</p>
			<span>Grade Point Average <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $s_gpa . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; 
			Alternative Form Participant <span class="underline">  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </span></span><br/>
			<span>(must meet Scholastic Fitness Requirement of 2.0/70% or else fill out the Scholastic Eligibility Form or Home School Eligibility Form).</span>
			
			<!-- Parent Info -->
			
			<p>Mailing Address if different from above: _____________________________________________________________________________</p>
			<p>Name of Parent/Guardian <span class="underline"> &nbsp;&nbsp;&nbsp;' . $con_guardian . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; 
			  Relationship to Athlete <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $con_relationship . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</p>
			<p>Address (if different from above): __________________________________________________________________________________</p>
			<p>
			City_____________________________________________ State _________________ Zip ____________________________________</p>
			<p>Telephone No <span class="underline"> &nbsp;&nbsp;&nbsp;' . $con_phone . '&nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
			  Email Address <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $email . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</p>
		
			<!-- Emergency Contact -->
			
			<span>Emergency Contact Information (if the parent/guardian can not be reached):</span><br />
			<span>Name<span class="underline"> &nbsp;&nbsp;&nbsp;' . $er_name . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; 
			  Relationship to Athlete <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $er_relationship . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</span><br />
		    <span>Home Telephone No <span class="underline"> &nbsp;&nbsp;&nbsp;' . $er_phone . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; 
		      Cell or Work No <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $er_cellphone . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</span><br /><br />
		      
		    <!-- PPWLS Office Use -->
		    <table style="border: 1px solid #000;" width="2050" cellspacing="0" cellpadding="0">
		    <tr>
		        <td width="6">&nbsp;</td>
		        <td>&nbsp;</td>
		        <td width="6">&nbsp;</td>
		    </tr>
		    <tr>
		        <td>&nbsp;</td>
		        <td><span class="underline"><strong>Pop Warner Official Use Only</strong></span><br />
		            <span>Registration Number: _______________________ &nbsp;&nbsp;&nbsp; 
		              Witnessed By: <span class="underline">  &nbsp;&nbsp;&nbsp; ' . $er_relationship . ' &nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp;</span><br /><br />
		            <span class="underline">Participant Fees</span><br />
		            <span>Amount Paid $______________</span>
		            <p>Type of Transaction: ______ Cash &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;
		            	______ Check &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; ______ Credit Card &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; ______ Other (please explain)</p>
		            <p>Proof of age verified?  &nbsp;&nbsp;&nbsp; Yes  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  No</p>
		            <p>Birth Certificate &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; Other (please explain)</p>
		            <p>Division of Play (circle one): &nbsp; Flag &nbsp; / &nbsp; Tiny Mite &nbsp; / &nbsp; Mitey Mite &nbsp; / &nbsp; Jr. Pee Wee &nbsp; / &nbsp; Pee Wee &nbsp; / &nbsp; Jr .Midget &nbsp; / &nbsp; Midget &nbsp; / &nbsp; U/L</p>
		            <p>Weight at Time of Registration  (Football Only): ___________</p>
		            <p>Proof of Scholastic Fitness verified? &nbsp;&nbsp;&nbsp; Yes &nbsp;&nbsp;&nbsp; No</p>
		        </td>
		        <td>&nbsp;</td>
		    </tr>
		    <tr>
		        <td width="6">&nbsp;</td>
		        <td>&nbsp;</td>
		        <td width="6">&nbsp;</td>
		    </tr>
		    </table>
		  ';
		
		
		// Print text using writeHTMLCell()
		$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
			
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$fileatt = $pdf->Output('ccys-registration-form.pdf', 'F');
		
		$pdf_filename = "ccys-registration-form.pdf";

		$contact_form->uploaded_files = array ( 'coupon' => 'ccys-registration-form.pdf');
	}
};
// Custom Login Design
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/login.css" />';
};
add_action('login_head', 'custom_login');

// Change Login Page Logo Link
function put_my_url(){
	return get_site_url();
};
add_filter('login_headerurl', 'put_my_url');
