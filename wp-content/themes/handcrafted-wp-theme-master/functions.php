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
 * Add jQuery
 */
function add_jquery_script() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
add_action('wp_enqueue_scripts', 'add_jquery_script');


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
				
		'tg_projects' => array(
			'name' => 'tg_project',
			'label' => 'Projects',
			'sing' => 'Project' ,
			'edit' => 'Project',
			'edits' => 'Projects',
			'menu_pos' => 5,
			'supports' => array( 'title', 'editor', 'thumbnail')
		),
		'tg_people' => array(
			'name' => 'tg_people',
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
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => $cpt['menu_pos'],
			'supports' => $cpt['supports']
		);
		register_post_type($cpt['name'], $args);
	}
	
// Add Pages on Theme Activation

if (isset($_GET['activated']) && is_admin()){
	
	$pforp_pages = array(
				array(
					'page_title' => 'Home',
					'page_template' => 'page-home.php',
					'menu_order' => 0,
				),
				array(
					'page_title' => 'Projects',
					'page_template' => 'page-projects.php',
					'menu_order' => 1,
				),
				array(
					'page_title' => 'Contact',
					'page_template' => 'page-contact.php',
					'menu_order' => 2,
				),
				array(
					'page_title' => 'News',
					'page_template' => 'page-contact.php',
					'menu_order' => 3,
				),
				array(
					'page_title' => 'About',
					'page_template' => 'page-about.php',
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
	'types' => array('tg_people'),
	'template' => get_stylesheet_directory() . '/metaboxes/person-meta.php',
));

$project_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_project_meta',
	'title' => 'Project Location',
	'types' => array('tg_project'),
	'template' => get_stylesheet_directory() . '/metaboxes/projects-meta.php',
));

?>
