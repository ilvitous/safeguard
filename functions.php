<?
define("THEME_DIR", get_template_directory_uri());
define("IMAGES_DIR", get_template_directory_uri().'/img');
define("BLOG_URL", get_site_url());




/*--- REMOVE GENERATOR META TAG ---*/
remove_action('wp_head', 'wp_generator');
// ENQUEUE STYLES



function theme_load_styles() {
	if (!is_admin()) {
		wp_enqueue_style('main', get_template_directory_uri() . '/style.css');

    // fonts
    wp_enqueue_style('fonts', get_template_directory_uri() . '/css/fonts/stylesheet.css');

		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
	  wp_enqueue_style('screen', get_template_directory_uri() . '/css/layout/stylesheets/screen.css');
	}
}
add_action('get_header', 'theme_load_styles');






// LOAD JQUERY
function add_google_jquery() {
   if ( !is_admin() ) {
      wp_deregister_script('jquery');
      wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"), false);
      wp_enqueue_script('jquery');
   }
}
add_action('wp_print_scripts ', 'add_google_jquery');


// ENQUEUE SCRIPTS
function enqueue_scripts() {
	wp_register_script( 'custom-script', THEME_DIR . '/js/theme.js', array( 'jquery' ), '1', false );
    wp_enqueue_script( 'custom-script' );

}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );


function pw_load_scripts() {
	wp_localize_script('custom-script', 'custom_vars', array(
			'templateUrl' => get_template_directory_uri(),
			'blogUrl' => get_site_url(),
			'admin_url' => admin_url(),
		)
	);
}
add_action('wp_enqueue_scripts', 'pw_load_scripts');





//THEME SUPPORT
add_theme_support( 'post-thumbnails' );

function register_my_menus() {
register_nav_menus(
array(
'main-home' => __( 'Main Menu Home' ),
)
);
}
add_action( 'init', 'register_my_menus' );

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}




// IMAGE
add_action( 'after_setup_theme', 'baw_theme_setup' );
function baw_theme_setup() {
	  add_image_size( 'square-thumb', 500, 500, true );

}

/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}
