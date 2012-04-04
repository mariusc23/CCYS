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
<title><?php wp_title(''); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=Enriqueta:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet/less" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/less/grid.less" />
<link rel="stylesheet/less" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/less/base.less" />
<link rel="stylesheet/less" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/less/main.less" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<![endif]-->


<?php wp_head(); ?>
<?php if(is_home()) {
	wp_register_script( 'jquery_easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), 1.3, false);
	wp_enqueue_script( 'jquery_easing' );
	wp_register_script( 'slides', get_template_directory_uri() . '/js/slides.min.jquery.js', array('jquery'), 1, false);
	wp_enqueue_script( 'slides' );
	echo "<script>
		$(jQuery.fn.gallerySlider = function(){
			$('#slides').slides({
				preload: true,
				preloadImage: '<?php echo get_template_directory_uri(); ?>/images/loading.gif',
				play: 3000,
				pause: 2500,
				hoverPause: true
			});
		});
	</script>";
	};
?>

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
				<p>Our organization has been developing  athletes since 1990. We play and cheer in Pop Warner Division 1, the highest level of competition in the bay. Is your son or daughter between 5-15 years? <a href="/contact/" title="Find out more about CCYS and the registration requirements by sending us a message.">Send us a message</a> right now!</p>
				<a class="button" href="/registration" title="Register for our division 1 football team">Register Now</a>
				<small id="division-showoff">Division 1 - Peninsula Pop Warner</small>
			</div>
			<div id="slides" class="sixcol last">
				<div class="slides_container">
					<img src="http://ccys.com/wp-content/uploads/2012/04/slide-01.jpg" />
					<img src="http://ccys.com/wp-content/uploads/2012/04/0042.jpg" />
					<img src="http://ccys.com/wp-content/uploads/2012/04/slide-02.jpg" />
					<img src="http://ccys.com/wp-content/uploads/2012/04/slide-03.jpg" />
					<img src="http://ccys.com/wp-content/uploads/2012/04/slide-04.jpg" />
				</div>
			</div><?php }; ?>
		</header><!-- #branding -->
		<div id="header-bottom"></div>
	</div><!-- header-wrap -->

	<div id="main" class="container">
	<div class="row">

<?php function secondary_sidebar() {
	echo '<div id="secondary" class="widget-area fivecol" role="complementary">';
	do_action( 'before_sidebar' );
	dynamic_sidebar( 'sidebar-1' );
	echo '</div><!-- #secondary .widget-area -->';
	}; ?>
	
	<?php if ( ! is_page_template( 'page-teams.php' )) {
		secondary_sidebar();
	}; ?>
	
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
	<?php 
	/* Team Page Sidebars */
	if ( is_active_sidebar( 'sidebar-12' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-12' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-13' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-13' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php 
	
	/* Cheer sidebar ---------------------------------- */
	
	if ( is_active_sidebar( 'sidebar-14' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-14' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-15' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-15' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-16' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-16' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-17' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-17' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-18' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-18' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-19' ) ) : ?>
	<div id="tertiary" class="fivecol widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-19' ); ?>
	</div><!-- #tertiary .widget-area -->
	<?php endif; ?>

	
	