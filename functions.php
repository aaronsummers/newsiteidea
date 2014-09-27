<?php
/*
 *  INCLUDE OPTIONS FOT THE THEME CUSTOMIZER
 *************************************************************/
require_once dirname( __FILE__ ) . '/meta/meta.php';

/*
 * WIDGETS
 *************************************************************/
 
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'id' => 'blog-sidebar',
		'description' => 'The sidebar for the blog widget area',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'footer-one',
		'description' => 'Drag a text widget into this box and enter your company details.',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
		));
}

/*
 * REGISTER NAVIATION MENU
 *************************************************************/

function register_my_menu() { //REGISTER NAV MENU
	register_nav_menu('header-menu',__( 'Header Menu' )); 
}
add_action( 'init', 'register_my_menu' );


/*
 * ADD THEME SUPPORT FOR POST-THUMBNAILS
 *************************************************************/

/* TO INCLUDE THE THUMBNAILS ADD THIS...
 * change the "large-thumbnail" to name you desire for your image
 
 *	<?php the_post_thumbnail( 'large-thumbnail' ); ?> */
 
add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 84, 84, true); // ADDING TRUE CROPS THE IMAGE, REMOVE ", TRUE" TO SCALE THE IMAGES.
	add_image_size( 'small-people-thumbnail', 40, 40, true );
	add_image_size( 'people-thumbnail', 250, 250, true );
	add_image_size( 'large-thumbnail', 1000, 480, true );
	add_image_size( 'facebook-og-thumbnail', 600, 480, true ); // CALLING THIS IN OUR HEADER, IN THE FACEBOOK OG TAG. (CORRECT SIZE AS OF 24/05/2014)
	
	add_image_size( 'background-slider-image', 2000, 1200, true );
	add_image_size( 'inner-slider-image', 2000, 560, true );

		
/*
 * SOCIAL MEDIA
 *************************************************************/
 
function add_this() { // ADD THIS SOCIAL SHARING INCLUDED , CALLED IN SINGLE.PHP
	echo '<ul class="addthis_toolbox addthis_default_style" addthis:url="' . $url . '" addthis:title="' . $title . '">
							<li><a class="addthis_counter addthis_bubble_style"></a></li>
							<li><a class="addthis_button_facebook"></a></li>
							<li><a class="addthis_button_twitter"></a></li>
							<li><a class="addthis_button_google_plusone_share"></a></li>
							<li><a class="addthis_button_compact"></a></li>
						</ul>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script>'
; }

/*
 * NEW EXCERPT
 *************************************************************/

function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	  if (count($excerpt)>=$limit) {
		  array_pop($excerpt);
		  $excerpt = implode(" ",$excerpt).'...';
	  } else {
		  $excerpt = implode(" ",$excerpt);
	  }
		  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		  return $excerpt;
	  }
	  
	  function content($limit) {
	$content = explode(' ', get_the_content(), $limit);
	  if (count($content)>=$limit) {
		  array_pop($content);
		  $content = implode(" ",$content).'...';
	  } else {
		  $content = implode(" ",$content);
	  }
		  $content = preg_replace('/[.+]/','', $content);
		  $content = apply_filters('the_content', $content);
		  $content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}
/*
To display the excerpt add this:
	<?php $content = get_the_content(); echo wp_trim_words( $content , '38' ); ?> - Change the '38' to which ever number of words you would like to display
*/

/*
 * READ MORE
 *************************************************************/

function new_excerpt_more($more) {
global $post;
return '… <div class="read-more"><a class="button non-uniform" href="'. get_permalink($post->ID) . '">' . '<b>+</b> Read More' . '</a></div>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*
 * GENERATE META TAGS
 *************************************************************/

function tags4meta() {
$posttags = get_the_tags();
foreach((array)$posttags as $tag) {
$tags4meta .= $tag->name . ',';
}
if (!is_single()) { ?>wordpress theme development, jquery, css, php, <?php } //CHANGE THIS TO YOUR OWN META TAGS
echo "$tags4meta";

} 

/* REORDER MENU ITEMS
http://code.tutsplus.com/articles/customizing-your-wordpress-admin--wp-24941
 */
function custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	 
	return array(
		'index.php', // Dashboard
		'separator1', // First separator
		'edit.php?post_type=background_slider',
		'edit.php?post_type=people',
		'edit.php', // Posts
		'upload.php', // Media
		'link-manager.php', // Links
		'edit.php?post_type=page', // Pages
		'edit-comments.php', // Comments
		'separator2', // Second separator
		'themes.php', // Appearance
		'plugins.php', // Plugins
		'users.php', // Users
		'tools.php', // Tools
		'options-general.php', // Settings
		'separator-last', // Last separator
	);
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');

/* RENAME POSTS */
function edit_admin_menus() {
	global $menu;
	 
	$menu[5][0] = 'News'; // Change Posts to Recipes
}
add_action( 'admin_menu', 'edit_admin_menus' );
/* NEW SLIDER CPT */

/* Register a Custom Post Type (Slide) */
add_action('init', 'background_slider_init');
function background_slider_init() {
	$labels = array(
		'name' => _x('Slides', 'post type general name'),
		'singular_name' => _x('Slide', 'post type singular name'),
		'add_new' => _x('Add New Slide', 'background_slider'), //This is our post_type, we'll display the metaboxes only on this post_type!
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search Slides'),
		'not_found' => __('No slides found'),
		'not_found_in_trash' => __('No slides found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Home Page'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => ' ',
		'menu_position' => 2,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'supports' => array('title', 'thumbnail')
	);
	register_post_type('background_slider', $args);
}
/* Update Slide Admin Messages */
add_filter('post_updated_messages', 'background_slider_updated_messages');
function background_slider_updated_messages($messages) {
	global $post, $post_ID;
	$messages['background_slider'] = array(
		0 => '',
		1 => sprintf(__('Slide updated.'), esc_url(get_permalink($post_ID))),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Slide updated.'),
		5 => isset($_GET['revision']) ? sprintf(__('Slide restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
		6 => sprintf(__('Slide published.'), esc_url(get_permalink($post_ID))),
		7 => __('Slide saved.'),
		8 => sprintf(__('Slide submitted.'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		9 => sprintf(__('Slide scheduled for: <strong>%1$s</strong>. '), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
		10 => sprintf(__('Slide draft updated.'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
	);
	return $messages;
}

/* ABOUT US */
/*
 * ABOUT US POST TYPE
 **************************************************************/
 // Register Custom Post Type
function about_us_post_type() {
 
	$labels = array(
		'name'				=> 'People',
		'singular_name'	   => 'People',
		'menu_name'		   => 'People',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'		   => 'All People',
		'view_item'		   => 'View Item',
		'add_new_item'		=> 'Add New Member',
		'add_new'			 => 'Add New',
		'edit_item'		   => 'Edit Item',
		'update_item'		 => 'Update Item',
		'search_items'		=> 'Search Item',
		'not_found'		   => 'Not found',
		'not_found_in_trash'  => 'Not found in Trash',
	);
	$args = array(
		'label'			   => 'people',
		'description'		 => 'Where you tell people about yourself',
		'labels'			  => $labels,
		'supports' 			  => array('title', 'editor', 'thumbnail'),
		'hierarchical'		=> false,
		'public'			  => true,
		'show_ui'			 => true,
		'show_in_menu'		=> true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'	   => 5,
		'menu_icon'		   => ' ',
		'can_export'		  => true,
		'rewrite' => array( 'slug' => 'about/people' ),
		'has_archive' => 'about/people',
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'	 => 'page',
	);
	 
	register_post_type( 'people', $args );
 
}
// Hook into the 'init' action
add_action( 'init', 'about_us_post_type', 0 );

// WP People Categories
add_action( 'init', 'build_taxonomies', 0 );

function build_taxonomies() {
	register_taxonomy( 'categories', 'people', array( 'hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true ) );
}

// Rename and move the Featured Image
add_action('do_meta_boxes', 'change_image_box');
function change_image_box()
{	// People
	remove_meta_box( 'postimagediv', 'people', 'side' );
	add_meta_box('postimagediv', __('Add Photo'), 'post_thumbnail_meta_box', 'people', 'side', 'high');
	// Slider
	remove_meta_box( 'postimagediv', 'background_slider', 'side' );
	add_meta_box('postimagediv', __('Add A Photo Larger Than 2000px Wide By 1200px High'), 'post_thumbnail_meta_box', 'background_slider', 'normal', 'high');
}
// Give the title a new prompt
function change_default_title( $title ){
	 $screen = get_current_screen();
 
	 if  ( $screen->post_type == 'people' ) {
		  return 'Enter Full Name Here';
	 }
	 if  ( $screen->post_type == 'background_slider' ) {
		  return 'Enter A Title For The Image';
	 }
}
 
add_filter( 'enter_title_here', 'change_default_title' );

function five_posts_on_homepage( $query ) {
    if ( $query->is_home() ) {
        $query->set( 'posts_per_page', 1 );
    }
}
add_action( 'pre_get_posts', 'five_posts_on_homepage' );
?>