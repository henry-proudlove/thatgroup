<?php
/**
 * @package WordPress
 * @subpackage themename
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'themename', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/**
 * Load jQuery from Google CDN, fallback to local
 */
/*if( !is_admin()){
	$url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'; // the URL to check against
	$test_url = @fopen($url,'r'); // test parameters
	if($test_url !== false) { // test if the URL exists
	    function load_external_jQuery() { // load external file
	        wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery
	        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'); // register the external file
	        wp_enqueue_script('jquery'); // enqueue the external file
	    }
		add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function
	} else {
	    function load_local_jQuery() {
	        wp_deregister_script('jquery'); // deregisters the default WordPress jQuery
	        wp_register_script('jquery', get_bloginfo('template_url').'/js/jquery-1.7.2.min.js', __FILE__, false, '1.7.2', true); // register the local file
	        wp_enqueue_script('jquery'); // enqueue the local file
	    }
	add_action('wp_enqueue_scripts', 'load_local_jQuery'); // initiate the function
	}
}*/


/**
 * This theme uses wp_nav_menus() for the header menu, utility menu and footer menu.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'themename' )
) );

/** 
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * This theme uses post thumbnails
 */
add_theme_support( 'post-thumbnails' );

/**
 *	This theme supports editor styles
 */

add_editor_style("/css/layout-style.css");


$option_name = 'posts_per_page' ;
$new_value = '-1' ;

if ( get_option( $option_name ) != $new_value ) {
    update_option( $option_name, $new_value );
} else {
    $deprecated = ' ';
    $autoload = 'no';
    add_option( $option_name, $new_value, $deprecated, $autoload );
}

/**
 *	Replace the default welcome 'Howdy' in the admin bar with something more professional.
 */
function admin_bar_replace_howdy($wp_admin_bar) {
    $account = $wp_admin_bar->get_node('my-account');
    $replace = str_replace('Howdy,', 'Welcome,', $account->title);            
    $wp_admin_bar->add_node(array('id' => 'my-account', 'title' => $replace));
}
add_filter('admin_bar_menu', 'admin_bar_replace_howdy', 25);

// Custom Post Types

$cpts_args	= array(
				
		'project' => array(
			'name' => 'project',
			'label' => 'Projects',
			'sing' => 'Project' ,
			'edit' => 'Project',
			'edits' => 'Projects',
			'menu_pos' => 5,
			'supports' => array( 'title', 'editor', 'thumbnail')
		),
		'people' => array(
			'name' => 'people',
			'label' => 'People',
			'sing' => 'Person' ,
			'edit' => 'Person',
			'edits' => 'People',
			'menu_pos' => 6,
			'supports' => array( 'title', 'editor', 'thumbnail')
		)
	);

foreach($cpts_args as $cpt){
	
		//EDIT, ADD AND SEARCH TERMS
		$add = 'Add ' . $cpt['edit'];
		$edit = 'Edit ' . $cpt['edit'];
		$new = 'New ' . $cpt['edit'];
		$view = 'View ' . $cpt['edit'];
		$search = 'Search ' . $cpt['edits'];
		$none = 'No ' . $cpt['edits'] . ' Found';
		$trash = 'No ' . $cpt['edits'] . ' Found In Trash';
		
		$labels = array(
			'name' => _x($cpt['label'], 'post type general name'),
			'singular_name' => _x($cpt['sing'], 'post type singular name'),
			'add_new' => _x('Add New', 'handcraftedwptemplate_robot'),
			'add_new_item' => __($add),
			'edit_item' => __($edit),
			'new_item' => __($new),
			'view_item' => __($view),
			'search_items' => __($search),
			'not_found' =>  __($none),
			'not_found_in_trash' => __($trash), 
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'has_archive' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => $cpt['menu_pos'],
			'supports' => $cpt['supports']
		);
		register_post_type($cpt['name'], $args);
	}
	
/* Add Pages on Theme Activation

if (isset($_GET['activated']) && is_admin()){
	
	$pforp_pages = array(
				array(
					'page_title' => 'Home',
					'page_template' => 'page-home.php',
					'menu_order' => 0,
				),
				array(
					'page_title' => 'About us',
					'page_template' => 'page-about.php',
					'menu_order' => 1,
				),
				array(
					'page_title' => 'Projects',
					'page_template' => 'page-projects.php',
					'menu_order' => 2,
				),
				array(
					'page_title' => 'News',
					'page_template' => 'page-contact.php',
					'menu_order' => 3,
				),
				array(
					'page_title' => 'Contact',
					'page_template' => 'page-contact.php',
					'menu_order' => 4,
				)
		);
	$page_count = count($pforp_pages);
	
	foreach($pforp_pages as $page)
	{
		$new_page = array(
			'ID' => $page['page_id'],
			'post_type' => 'page',
			'post_title' => $page['page_title'],
			'post_content' => '',
			'post_status' => 'publish',
			'post_author' => 1,
			'menu_order' => $page['menu_order']
		);
		
		$new_page_id = wp_insert_post($new_page);
		update_post_meta($new_page_id, '_wp_page_template', $page['page_template']);
		
		switch ($page['page_title']){
			case 'Home':
				update_option( 'page_on_front', $new_page_id );
				update_option( 'show_on_front', 'page' );
				break;
			case 'News':
				update_option( 'page_for_posts', $new_page_id );
				break;
		}
	}
}

add_action( 'init', 'tg_pages_excerpt' );
function tg_pages_excerpt	() {
     add_post_type_support( 'page', 'excerpt' );
}*/

// Add Image Sizes

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'tg-projectthumb', 320, 240, true );
	add_image_size( 'tg-leadimg', 800, 345, true );
	add_image_size( 'tg-carouselimg', 1280, 440, true );
}

// Metaboxes

include_once WP_CONTENT_DIR . '/wpalchemy/MetaBox.php';

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style() {
	wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css');
}

$people_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_person_meta',
	'title' => 'Person Details',
	'types' => array('people'),
	'template' => get_stylesheet_directory() . '/metaboxes/person-meta.php',
));

$project_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_project_meta',
	'title' => 'Project Location',
	'types' => array('project'),
	'template' => get_stylesheet_directory() . '/metaboxes/projects-meta.php',
));


// Create category on project publish

function create_project_cat($post_ID) {
	$this_post = get_post($post_ID); 
	$title = $this_post->post_title;
	$project_cat = wp_insert_term($title, 'category');
	add_post_meta($post_ID, '_project_cat' , $project_cat['term_id'] , true);
}

add_action('publish_project', 'create_project_cat');

function post_extender($post){
	switch ($post->post_type){
		case 'project':
			$meta = get_post_meta($post->ID, '_project_meta' , true);
			foreach ($meta as $key=>$value){
				$post->$key = $value;
			}
			$meta = get_post_meta($post->ID, '_project_cat' , true);
			$post->project_cat = $meta;
			break;
		case 'people':
			$meta = get_post_meta($post->ID, '_person_meta', true);
			foreach ($meta as $key=>$value){
				$post->$key = $value;
			}
		default:
			break;
	}
}

add_action( 'the_post', 'post_extender' );

function clean_quali($quali){
	$quali_arr = array();
	foreach ($quali as $qual){
		array_push($quali_arr, $qual['quali']);
	}
	return $quali_arr;
}

function img_fecther($size='tg-carouselimg', $limit='-1', $post_id = null, $bg = false) {

	global $post;
	
	if(!isset($post_id)){
		$post_id = $post->ID;
	}
	
	//echo '<div class="images">';
	
	if ($images = get_children(array(

		'post_parent' => $post_id,
		'post_type' => 'attachment',
		'order' => 'menu_order',
		'numberposts' => $limit,
		'post_mime_type' => 'image'))):
		
		$length = count($images);
		
		echo '<div id="carousel-holder"><div class="gradient"></div><div id="carousel-images">';
				
		foreach($images as $image) {
			$attachment=wp_get_attachment_image_src($image->ID, $size); ?>
			<div style="z-index: <?php echo $length ?>; background-image: url('<?php echo $attachment[0]; ?>');"></div><?php
			$length--;
		}
		
		echo '</div><!--#carousel-images--></div><!--#carousel-->';
	endif;
	//echo '</div><!--.images-->';
	
}

function tg_excerpt_length($length) {
	return 25;
}

add_filter('excerpt_length', 'tg_excerpt_length');

function tg_excerpt_more($more) {
	global $post;
	return '...';
}
add_filter('excerpt_more', 'tg_excerpt_more');

function tg_nav_below(){ ?>
	<nav id="nav-below" role="article">
		<div class="nav-previous clearfix"><?php previous_post_link( '%link', page_chevron('previous') . '<span class="nav-text">' . _x( '', 'Previous post link', 'themename' ) . '%title</span>' ); ?></div>
		<div class="nav-next clearfix"><?php next_post_link( '%link', '<span class="nav-text"> %title ' . _x( '', 'Next post link', 'themename' ) . '</span>' . page_chevron('next') ); ?></div>
	</nav><!--#nav-below -->
<?php }

function page_chevron($direction){
	$image = get_template_directory_uri() . '/images/post-' . $direction . '.svg';
	$arrow = file_get_contents($image);
	$span = '<span class="meta-nav">' . $arrow . '</span>';
	return $span;
}

function tg_rel_posts($tax, $title, $post_ID = ''){
	$args = array(
		'posts_per_page' => '4',
		'category__in' => $tax,
		'post__not_in' => array($post_ID)
	);
	$wp_query = new WP_query($args);
	if ( $wp_query->have_posts() ):
		$i = 0;
		echo '<aside id="related"><div id="related-holder" class="clearfix">';
		echo '<h2 class="widget-title">' . $title . '</h2>';
		//echo '<div id="related-articles" class="clearfix">';
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			if($i < 1){
				$class = 'first';	
			}elseif($i > 2){
				$class = 'last';
			}else{
				$class= 'middle';
			}?>
			<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?> role="article">
				<a class="thumb-box" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<div class="thumb-content">
						<header class="entry-header">
							<time class="entry-date"><?php the_date('d.m.y'); ?></time>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->	
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
					</div><!--.thumb-content-->
				</a>
			</article><!-- #post-<?php the_ID(); ?> --> <?php 
			$i++;
		endwhile; wp_reset_query();
		//echo'</div><!--#related-articles-->';
		echo '</div><!--#related-holder--></aside><!--#related-->';
		endif;
	
}


function the_excerpt_short($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}

?>
