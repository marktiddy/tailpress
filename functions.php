<?php

/**
 * Theme setup.
 */

function tailpress_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tailpress' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

    add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/editor-style.css' );
}

add_action( 'after_setup_theme', 'tailpress_setup' );

/**
 * Enqueue theme assets.
 */
function tailpress_enqueue_scripts() {
	$theme = wp_get_theme();
	wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_script('jquery');
	wp_enqueue_style( 'tailpress', tailpress_asset( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', tailpress_asset( 'js/app.js' ), array(), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'tailpress_enqueue_scripts' );

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function tailpress_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/' . $path );
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4 );

/*******************************************
 *Add custom classes to wordpress body_class
 ******************************************/
add_filter( 'body_class','custom_body_classes' );
function custom_body_classes( $classes ) { 
	global $post;
	if(isset($post)) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
    $classes[] = '';
    return $classes;     
}

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'tailpress_nav_menu_add_submenu_class', 10, 3 );



/*****************************************************
 *ADVANCED CUSTOM FIELDS  
 *****************************************************/
/**
 * Create Option Page
 *
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'Global Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position' => 30
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Settings',
		'menu_title'	=> 'Header Settings',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer Settings',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

/*****************************************************
*HELPER FUNCTION FOR CREATING CUSTOM POST TYPES
*****************************************************/
/**/

    function generateLabels($s,$p) {
    //S is singular, P is plural
    $labels = array(
    'name' => _x( $p, 'post type general name' ),
    'singular_name' => _x( $p, 'post type singular name' ),
    'add_new' => _x( 'Add New ' . $s, $p ),
    'add_new_item' => __( 'Add New '.$s ),
    'edit_item' => __( 'Edit '.$p ),
    'new_item' => __( 'New '.$s ),
    'all_items' => __( 'All '.$p ),
    'view_item' => __( 'View '.$p ),
    'search_items' => __( 'Search '.$p ),
    'not_found' => __( 'No '.$p.' found' ),
    'not_found_in_trash' => __( 'No '.$p.' found in the Trash' ),
    'parent_item_colon' => __( 'Parent '.$p ),
    'menu_name' => $p
    );
    return $labels;
    }

	//FILTERS TO DEFAULT PLUGINS TO NOT AUTO UPDATE
	add_filter( 'auto_update_plugin', '__return_false' );
	add_filter( 'auto_update_theme', '__return_false' );

	
/**
* Enables the HTTP Strict Transport Security (HSTS) header in WordPress.
*/
function tg_enable_strict_transport_security_hsts_header_wordpress() {
header( 'Strict-Transport-Security: max-age=10886400' );
}
add_action( 'send_headers', 'tg_enable_strict_transport_security_hsts_header_wordpress' );

//HELPER FUNCTIONS
function format_telephone($tel) {
    $formatTel = str_replace(' ','',$tel);
    $formatTel[0] = '+';
    $formatTel = str_replace('+','+44',$formatTel);
    return $formatTel;
}

// Function to get the alt tag of an image ID
function get_alt_tag($id) {
	return get_post_meta($id,'_wp_attachment_image_alt',TRUE);
}

// Enqueue Carbon Fields
 require_once(__DIR__.'/resources/inc/carbon-fields.php');
