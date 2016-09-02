<?php
/***** Base - Defaults *****/
/*
Problem: There are things that are used all the time on WordPress themes that should probably just be added all the time regardless of the scope of use because they end up being helpful more often than not.

Question: What basic helpful WordPress defaults should be included with every theme?
*/





//Enable Menus for Theme
add_theme_support( 'menus' );


//Add featured image to everything
add_theme_support( 'post-thumbnails' );


//Adds helpful classes to the body to identify templates etc.
function base_body_classes( $classes ) {
	return $classes;
}
add_filter( 'body_class', 'base_body_classes');


//Allow WordPress (aka Yoast) to handle the title
function base_theme_setup() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'base_theme_setup' );