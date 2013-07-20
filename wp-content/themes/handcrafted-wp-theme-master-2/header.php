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
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="keywords" content="
		THAT Group,
		THAT Property Company,
		Steven Brown,
		Ray Kelvin Property,
		Peter Tisdale,
		Michael Flaxman Hotels,
		Hilton Bournemouth,
		Terrace Mount Development,
		Torwood Street Development,
		Torquay Hilton,
		New Riviera Estates Ltd,
		New Riviera Estates Limited,
		THAT Bournemouth Company Ltd,
		THAT Bournemouth Company Limited" />
	<meta name="author" content="">
	
	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="screen, projection" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/js/modernizr.custom.43351.js"></script>
	<script type="text/javascript" src="http://fast.fonts.com/jsapi/1abaa99c-ef54-4ae8-83b7-dcb11503cf62.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.address-1.5.min.js?strict=false"></script>
	<?php wp_head(); ?>
	</head>
	<?php
		$page = get_page_by_path('home');
		if(has_post_thumbnail()){
			$img = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'full');
		}
	?>
	<body <?php body_class(); ?>>
	<div id="page" class="hfeed" style="background-image: url('<?php echo $img[0]; ?>'); background-size: cover;">
		<header id="branding" role="banner">
				<hgroup>
					<h1 id="site-title"><span><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" <?php address_rel(home_url( '/' )); ?>><?php bloginfo( 'name' ); ?></a></span></h1>
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
							'sort_column'  => 'menu_order'
						);					
						$pages = get_pages( $args );
						$menu = array();
						foreach ($pages as $page){
							$menu[] = array(
										'post_name' => $page->post_name,
										'link' => get_permalink($page->ID),
										'post_title' => $page->post_title
									);
						}
						$project_item = array(array(
										'post_name' => 'projects',
										'link' => get_post_type_archive_link('project'),
										'post_title' => 'Projects' 
									));
						array_splice($menu , 1 , 0 , $project_item);
						foreach ($menu as $item){ ?>
							<ul class="nav-holder <?php echo $item['post_name']; ?>">
								<li>
									<a class="nav-link" href="<?php echo $item['link']; ?>" <?php address_rel($item['link']) ?> >
										<span class="nav-icon" id="<?php echo $item['post_name'] . '-ico'; ?>"><span class="vert"></span><span class="horiz"></span></span>
										<?php echo $item['post_title']; ?>
									</a>
								</li>
								<li class="nav-content"><a href="#" class="nav-pag prev hide">Prev</a><a href="#" class="nav-pag next hide">Next</a><div class="loader-holder" style="display:none;"></div></li>
							</ul>
							<?php
						}
						?>
					</ul>
				</nav><!-- #utility -->
	
		</header><!-- #branding -->
	
	
		<div id="main" data="<?php echo implode(' ' , get_body_class()); ?>">