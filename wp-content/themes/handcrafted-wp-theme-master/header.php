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
					<?php if(is_front_page()){
						echo '<h2 id="site-description">'; 
						bloginfo( 'description' );
						echo '</h2>';
					}
					?>
				</hgroup>			
				<nav id="utility" role="article" class="clearfix">
					<h3 class="nav-title">Menu</h3>
					<ul id="nav-container">
						<?php
						$frontpage_id = get_option('page_on_front');
						$args = array(
							'exclude'      => $frontpage_id,
							'title_li'     => __(''),
							'sort_column'  => 'menu_order'
						);
						
						$pages = get_pages( $args );
						foreach ($pages as $page){
							if($page->post_title == 'About Us'){
								echo '<ul class="nav-holder about">';
							}else{
								echo '<ul class="nav-holder">';
							}
							echo '<li><a class="nav-link" href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a></li>';
							echo '<li class="nav-content"></li></ul>';
						}
						?>
					</ul>
				</nav><!-- #utility -->
	
		</header><!-- #branding -->
	
	
		<div id="main" data="<?php echo implode(' ' , get_body_class()); ?>">