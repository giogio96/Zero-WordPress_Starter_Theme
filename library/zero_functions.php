<?php
/*

  - head cleanup (remove rsd, uri links, junk css, ect)
  - enqueueing scripts & styles
  - theme support functions
  - custom menu output & fallbacks
  - related post function
  - page-navi function
  - removing <p> from around images
  - customizing the post excerpt

*/

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// A better title
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {

      $template = basename( get_page_template() );
      $template = explode('.', $template);
      $template_name = $template[count($template)-2];
      $template_url = '/library/css/templates/'.$template_name.'.css';
      $scrit_url = '/library/js/min/templates/'.$template_name.'.min.js';
      
      // register main stylesheet
      wp_register_style( 'main', get_stylesheet_directory_uri() . '/library/css/main.css', array(), '', 'all' );
      
      //Add To Home CSS
      wp_register_style( 'addtohome-css', get_stylesheet_directory_uri() . '/library/js/plugin/add-to-homescreen/style/addtohomescreen.css', array(), '', 'all' );
      
      //Custom ScrollBar CSS
      wp_register_style( 'custom-scrollbar-css', get_stylesheet_directory_uri() . '/library/js/plugin/custom-scrollbar/jquery.mCustomScrollbar.css', array(), '', 'all' );
      
      //SVG Css
      wp_register_style( 'svg', get_stylesheet_directory_uri() . '/library/svg/svg.css', array(), '', 'all' );
      
      if(is_archive()) {
          
          wp_register_style( 'archive-css', get_stylesheet_directory_uri() .'/library/css/templates/archive.css', array(), '', 'all' );
      } elseif(is_single()) {
          
          wp_register_style( 'single-css', get_stylesheet_directory_uri() .'/library/css/templates/single.css', array(), '', 'all' );
      } elseif(file_exists(get_template_directory() . $template_url)) {
          
          wp_register_style( $template_name.'-css', get_stylesheet_directory_uri() . $template_url, array(), '', 'all' );
      }

      // Font
      wp_register_style( 'Raleway', get_stylesheet_directory_uri() . '/library/fonts/Raleway/stylesheet.css', array(), '', 'all' );

      // comment reply script for threaded comments
      if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
          wp_enqueue_script( 'comment-reply' );
      }

      //adding scripts file in the footer
      
      //Add To Home CSS
      wp_register_script( 'addtohome-js', get_stylesheet_directory_uri() . '/library/js/plugin/add-to-homescreen/src/addtohomescreen.js', array( 'jquery' ), '', true );
      
      //Custom ScrollBar Plugin
      wp_register_script( 'custom-scrollbar-js', get_stylesheet_directory_uri() . '/library/js/plugin/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), '', true );
      
      wp_register_script( 'main-js', get_stylesheet_directory_uri() . '/library/js/min/global.min.js', array( 'jquery', 'addtohome-js', 'custom-scrollbar-js' ), '', true );
      
      if(is_archive()) {
    
          wp_register_script( 'archive-js', get_stylesheet_directory_uri() .'/library/js/min/templates/archive.min.js', array( 'jquery' ), '', true );
      } elseif(is_single()) {
      
          wp_register_script( 'single-js', get_stylesheet_directory_uri() .'/library/js/min/templates/single.min.js', array( 'jquery' ), '', true );
      } elseif(file_exists(get_template_directory() . $template_url)) {
      
          wp_register_script( $template_name.'-js', get_stylesheet_directory_uri() . $script_url, array( 'jquery' ), '', true );
      }

      // enqueue styles
      wp_enqueue_style( 'main' );
      wp_enqueue_style( 'addtohome-css' );
      wp_enqueue_style( 'custom-scrollbar-css' );
      if(is_archive()) {
        
          wp_enqueue_style( 'archive-css' );
      } elseif(is_single()) {
          
          wp_enqueue_style( 'single-css' );
      } elseif(file_exists(get_template_directory() . $template_url)) {
          
          wp_enqueue_style( $template_name.'-css' );
      }
      wp_enqueue_style( 'Raleway' );
      wp_enqueue_style( 'svg' );

      // enqueue script
      wp_enqueue_script( 'jquery' );
      wp_enqueue_script( 'addtohome-js' );
      wp_enqueue_script( 'custom-scrollbar-js' );
      if(is_archive()) {

          wp_enqueue_script( 'archive-js' );
      } elseif(is_single()) {

          wp_enqueue_script( 'single-js' );
      } elseif(file_exists(get_template_directory() . $template_url)) {
          
          wp_enqueue_script( $template_name.'-js' );
      }
      wp_enqueue_script( 'main-js' );
	}
}

function load_custom_wp_admin_style() {
        wp_register_style( 'wp_admin-css', get_template_directory_uri() . '/library/css/wp_admin.css', false, '1.0.0' );
        wp_enqueue_style( 'wp_admin-css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => '',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'Menu Principale', 'bonestheme' ),   // main nav in header
            'secondary-nav' => __( 'Menu Secondario', 'bonestheme' ),   // main nav in header
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

} /* end bones theme support */


/*********************
RANDOM CLEANUP ITEMS
*********************/

// This removes the annoying […] to a Read More link
function custom_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'bonestheme' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'bonestheme' ) .'</a>';
}

/*******************
CUSTOM EXERPT LENGTH
*******************/

// custom excerpt length
function custom_exerpt( $length ) {
   return 13;
}
add_filter( 'excerpt_length', 'custom_exerpt', 999 );


?>