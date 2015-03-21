<?php
// Genesis
include_once( get_template_directory() . '/lib/init.php' );

// Theme
define( 'CHILD_THEME_NAME', 'Tadpole Starter Theme' );
define( 'CHILD_THEME_URL', 'https://tadpole.cc/' );
define( 'CHILD_THEME_VERSION', '99.1' );

// Scripts and Styles
add_action( 'wp_enqueue_scripts', 'tc_scripts' );
function tc_scripts() {
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
}

// HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

// Viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );
