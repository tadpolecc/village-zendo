<?php
// Genesis
include_once( get_template_directory() . '/lib/init.php' );

// Theme
define( 'CHILD_THEME_NAME', 'Village Zendo' );
define( 'CHILD_THEME_URL', 'https://tadpole.cc/' );
define( 'CHILD_THEME_VERSION', '1.0' );

// Scripts and Styles
add_action( 'wp_enqueue_scripts', 'tc_scripts' );
function tc_scripts() {
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
}

// HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

// Force sidebar-content-sidebar layout setting
add_filter( 'genesis_site_layout', '__genesis_return_sidebar_content_sidebar' );

// Unregister layout settings
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'full-width-content' );

// Unregister and remove markup for sidebar-primary
unregister_sidebar( 'sidebar' );
remove_action( 'genesis_after_content', 'genesis_get_sidebar' );

// Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array( 'nav', 'subnav', 'site-inner' ) );

// Custom Header
add_theme_support( 'custom-header', array(
	'width' => '960',
	'height' => '180')
);

//Remove the header from normal location
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Move header into into content-sidebar-wrap
add_action( 'genesis_before_content', 'genesis_header_markup_open', 5 );
add_action( 'genesis_before_content', 'genesis_do_header' );
add_action( 'genesis_before_content', 'genesis_header_markup_close', 15 );

//Remove the footer from normal location
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Move footer into content-sidebar-wrap
add_action( 'genesis_after_content', 'genesis_footer_markup_open', 5 );
add_action( 'genesis_after_content', 'genesis_do_footer' );
add_action( 'genesis_after_content', 'genesis_footer_markup_close', 15 );

// Move footer widget into content-sidebar-wrap above new footer
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_after_content', 'genesis_footer_widget_areas', 4 );

// Viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Unregister primary/secondary navigation menus
remove_theme_support( 'genesis-menus' );

// Widgets
unregister_sidebar( 'header-right' );
register_sidebar ( array(
	'name'          => 'Call to Action',
	'id'            => 'main-cta',
	'description'   => '',
    'class'         => '',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
	)
);

// Footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

function tc_hidden_theme_2015( $r, $url ) {
    if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
        return $r; // Not a theme update request. Bail immediately.
    $themes = unserialize( $r['body']['themes'] );
    unset( $themes[ get_option( 'template' ) ] );
    unset( $themes[ get_option( 'stylesheet' ) ] );
    $r['body']['themes'] = serialize( $themes );
    return $r;
}
 
add_filter( 'http_request_args', 'tc_hidden_theme_2015', 5, 2 );
