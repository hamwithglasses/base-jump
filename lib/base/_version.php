<?php
/***** Base - Version *****/
/*
Problem: In the past, some clients have had great trouble with cached resources. They either aren't clearing their cache properly or refuse to.

Question: How do we help browsers that have static resources (eg. CSS, JS) cached force get the latest version?
*/





//Edit Query String (Version) On Resources
function base_remove_version( $src ){
	//Gets the theme version for version control
	$theme = wp_get_theme();
	$version = $theme->get('Version');

	//Appends our custom theme version to all static resources
    $parts = explode( '?', $src );
    return $parts[0].'?v='.$version;
}
add_filter( 'script_loader_src', 'base_remove_version', 15, 1 );
add_filter( 'style_loader_src', 'base_remove_version', 15, 1 );