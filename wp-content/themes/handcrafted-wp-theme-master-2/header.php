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
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/js/modernizr.custom.43351.js"></script>
	<script type="text/javascript" src="http://fast.fonts.com/jsapi/1abaa99c-ef54-4ae8-83b7-dcb11503cf62.js"></script>
	<script src="https://www.gstatic.com/swiffy/v5.1/runtime.js"></script>
	<script>
		swiffyobject = {"tags":[{"bounds":[{"ymin":-440,"ymax":440,"xmin":-1060,"xmax":1060}],"id":1,"fillstyles":[{"color":[2130706687],"type":1}],"paths":[{"fill":0,"data":[":60J40Da:80ha20u:a:80Hc"]}],"flat":true,"type":1},{"bounds":[{"ymin":-438,"ymax":443,"xmin":-1060,"xmax":1060}],"id":2,"fillstyles":[{"color":[-1635830],"type":1}],"paths":[{"fill":0,"data":[":40c8Ya3F74ca8l:a3F74Cc:02N0Ra:5sa0q:a:86fa0w:a:86Fa3q:a:86fa9v:a:62Ca1n:a:62ca3j:a7l28Ea:53Ca0W:a:23ca1N:a:23Cc:07e27gaW4oa0w:aX4Oc:5e27Ga:da6d1sa4l:a:08ea4d8qa6r:a:86Fa3q:a:5Sc"]}],"flat":true,"type":1},{"bounds":[{"ymin":0,"ymax":881,"xmin":0,"xmax":715}],"id":3,"fillstyles":[{"color":[-1635830],"type":1}],"paths":[{"fill":0,"data":[":57c0ra3f74ca9L:a3f74Cc:3N0Ra1U81ha1x:aw4Oa3r:aw4oa5x:a5U81Hc"]}],"flat":true,"type":1},{"tags":[{"id":3,"matrix":0,"type":3,"depth":1},{"type":2}],"id":4,"frameCount":1,"type":7},{"tags":[{"clip":7,"id":1,"matrix":":::::b","type":3,"depth":5},{"id":2,"matrix":0,"type":3,"depth":6},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"clip":4,"id":1,"matrix":":::::80H","type":3,"depth":1},{"id":4,"ratio":10,"matrix":"::::N38D","colortransform":"::::::2Q:","type":3,"depth":2},{"type":2},{"replace":true,"matrix":":::::31H","type":3,"depth":1},{"replace":true,"colortransform":"::::::3P:","type":3,"depth":2},{"replace":true,"matrix":":::::1e","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::84F","type":3,"depth":1},{"replace":true,"colortransform":"::::::5O:","type":3,"depth":2},{"replace":true,"matrix":":::::8s","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::39D","type":3,"depth":1},{"replace":true,"colortransform":"::::::6N:","type":3,"depth":2},{"replace":true,"matrix":":::::43d","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::4S","type":3,"depth":1},{"replace":true,"colortransform":"::::::7M:","type":3,"depth":2},{"replace":true,"matrix":":::::88f","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::7D","type":3,"depth":1},{"replace":true,"colortransform":"::::::9L:","type":3,"depth":2},{"replace":true,"matrix":":::::35h","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::b","type":3,"depth":1},{"replace":true,"colortransform":"::::::0L:","type":3,"depth":2},{"replace":true,"matrix":":::::84h","type":3,"depth":5},{"type":2},{"type":4,"depth":1},{"type":4,"depth":2},{"id":4,"ratio":17,"matrix":"362c::362c3C60D","colortransform":"::::::8J:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"370f::370f8D81D","colortransform":"::::::8I:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"024i::024i3F98D","colortransform":"::::::9H:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"324k::324k5G14E","colortransform":"::::::1H:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"271m::271m6H27E","colortransform":"::::::4G:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"863n::863n5I37E","colortransform":"::::::9F:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"102p::102p1J46E","colortransform":"::::::4F:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"986p::986p7J53E","colortransform":"::::::1F:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"517q::517q0K56E","colortransform":"::::::0F:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"694q::694q0K58E","colortransform":"::::::9E:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"517q::517q9J58E","colortransform":"::::::8E:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"987p::987p6J54E","colortransform":"::::::7E:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"103p::103p1J47E","colortransform":"::::::4E:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"863n::863n4I39E","colortransform":"::::::0E:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"272m::272m6H28E","colortransform":"::::::4D:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"325k::325k6G15E","colortransform":"::::::8C:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"025i::025i3F00E","colortransform":"::::::0C:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"371f::371f8D82D","colortransform":"::::::U:","type":3,"depth":1},{"type":2},{"replace":true,"matrix":"362c::362c2C62D","colortransform":"::::::K:","type":3,"depth":1},{"type":2},{"type":4,"depth":1},{"clip":4,"id":1,"matrix":":::::b","type":3,"depth":1},{"id":4,"ratio":36,"matrix":"::::N38D","type":3,"depth":2},{"replace":true,"matrix":":::::80H","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::1e","type":3,"depth":1},{"replace":true,"colortransform":"::::::9B:","type":3,"depth":2},{"replace":true,"matrix":":::::31H","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::8s","type":3,"depth":1},{"replace":true,"colortransform":"::::::7E:","type":3,"depth":2},{"replace":true,"matrix":":::::84F","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::43d","type":3,"depth":1},{"replace":true,"colortransform":"::::::6H:","type":3,"depth":2},{"replace":true,"matrix":":::::39D","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::88f","type":3,"depth":1},{"replace":true,"colortransform":"::::::5K:","type":3,"depth":2},{"replace":true,"matrix":":::::4S","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::35h","type":3,"depth":1},{"replace":true,"colortransform":"::::::3N:","type":3,"depth":2},{"replace":true,"matrix":":::::7D","type":3,"depth":5},{"type":2},{"replace":true,"matrix":":::::84h","type":3,"depth":1},{"replace":true,"colortransform":"::::::2Q:","type":3,"depth":2},{"replace":true,"matrix":":::::b","type":3,"depth":5},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2},{"type":2}],"id":5,"frameCount":56,"type":7},{"id":5,"matrix":"281v::281v00o98g","type":3,"depth":1},{"type":2}],"fileSize":1337,"v":"5.1.1","frameSize":{"ymin":0,"ymax":1600,"xmin":0,"xmax":3000},"frameCount":1,"frameRate":25,"version":17};
	</script>	
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
									<a class="nav-link" href="<?php echo $item['link']; ?>">
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