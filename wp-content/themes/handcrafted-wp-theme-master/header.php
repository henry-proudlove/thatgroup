<?php
/**
 * @package WordPress
 * @subpackage themename
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="chrome=1">

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'na	me' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'themename' ), max( $paged, $page ) );

	?></title>
	<meta name="description" content="">
	<meta name="author" content="">
	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="screen, projection" />

	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<script src="<?php echo get_template_directory_uri();?>/js/modernizr.custom.43351.js"></script>
	<script type="text/javascript" src="http://fast.fonts.com/jsapi/1abaa99c-ef54-4ae8-83b7-dcb11503cf62.js"></script>
	<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
	<div id="page" class="hfeed">
		<header id="branding" role="banner">
				<hgroup>
					<h1 id="site-title"><span><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
					<div id="site-description">
						<h2><?php echo bloginfo( 'description' ) ?></h2>
					</div>
				</hgroup>			
				<nav id="utility" role="article" class="clearfix">
						<?php 
						$chevron_icon = file_get_contents(get_template_directory_uri() . '/images/chevron.svg');
						?>
					<h3 class="nav-title"><span class="nav-title-icon"><?php echo $chevron_icon ?> </span>Menu</h3>
					<ul id="nav-container">
						<?php
						
						$frontpage_id = get_option('page_on_front');
						$args = array(
							'exclude'      => $frontpage_id,
							'title_li'     => __(''),
							'sort_column'  => 'menu_order'
						);
						
						$plus_icon = file_get_contents(get_template_directory_uri() . '/images/plus.svg');
												
						$pages = get_pages( $args );
						foreach ($pages as $page){ ?>
							<ul class="nav-holder <?php echo $page->post_name; ?>">
							<li>
								<a class="nav-link" href="<?php echo get_permalink($page->ID);?>">
									<span class="nav-icon"><?php echo $plus_icon; ?></span>
									<?php echo $page->post_title; ?>
								</a>
							</li>
							<li class="nav-content"></li></ul>
							<?php
						}
						?>
					</ul>
				</nav><!-- #utility -->
	
		</header><!-- #branding -->
	
	
		<div id="main" data="<?php echo implode(' ' , get_body_class()); ?>">