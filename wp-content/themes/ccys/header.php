<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
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
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=Enriqueta:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet/less" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/less/grid.less" />
<link rel="stylesheet/less" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/less/base.less" />
<link rel="stylesheet/less" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/less/main.less" />
<script src="<?php echo get_template_directory_uri(); ?>/js/less-1.2.2.min.js" type="text/javascript"></script>
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->


<?php wp_head(); ?>
<?php if(is_home()) {
	echo '<script src="' . get_template_directory_uri() . '/js/jquery.easing.1.3.js"></script>';
	echo '<script src="' . get_template_directory_uri() . '/js/slides.min.jquery.js"></script>';
};
?>
<script>
	$(function(){
		$('#slides').slides({
			preload: true,
			preloadImage: '<?php echo get_template_directory_uri(); ?>/images/loading.gif',
			play: 3000,
			pause: 2500,
			hoverPause: true
		});
	});
</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
<?php do_action( 'before' ); ?>
	<div id="header-wrap" class="container">
		<header id="branding" class="cf row" role="banner">
			<hgroup id="logo" class="twocol">
				<h1 id="site-title"><a id="site-title-link" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
	
			<nav id="access" class="tencol last" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'toolbox' ); ?></h1>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'toolbox' ); ?>"><?php _e( 'Skip to content', 'toolbox' ); ?></a></div>
	
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #access -->
			<?php if(is_home()) { ?>
			<div id="welcome-notice" class="sixcol">
				<h1>Coyote Creek Youth Sports</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non urna nulla, ut hendrerit massa. Aenean lobortis orci eget risus ultrices nec pulvinar dolor. Ut rutrum ante in enim tempus sed consequat.</p>
				<a class="button" href="#" title="Register for division 1 football team">Register Now</a>
				<small id="division-showoff">Division 1 - Peninsula Pop Warner</small>
			</div>
			<div id="slides" class="sixcol last">
				<div class="slides_container">
					<img src="http://www.ccys.com/wp-content/uploads/2010/02/0010.jpg" />
					<img src="http://www.ccys.com/wp-content/uploads/2010/02/0042.jpg" />
					<img src="http://www.ccys.com/wp-content/uploads/2010/02/0082.jpg" />
					<img src="http://www.ccys.com/wp-content/uploads/2010/02/0098.jpg" />
					<img src="http://www.ccys.com/wp-content/uploads/2010/02/0001.jpg" />
				</div>
			</div><?php }; ?>
		</header><!-- #branding -->
		<div id="header-bottom"></div>
	</div><!-- header-wrap -->

	<div id="main" class="container">
	<div class="row">

	<?php if ( ! is_dynamic_sidebar( 'sidebar-4' ) ) : ?>
	<div id="secondary" class="widget-area fivecol" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
	
			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>
	
			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'toolbox' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>
	
			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'toolbox' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<aside><?php wp_loginout(); ?></aside>
					<?php wp_meta(); ?>
				</ul>
			</aside>
	
		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary .widget-area -->
	<? endif; ?>
	
	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-6' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-7' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-8' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-8' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-9' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-9' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	