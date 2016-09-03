<?php
/***** Base - Head *****/
/*
Problem: With each new update of WordPress, new shit gets added that is often not useful or not used (eg. emoji).

Question: How do we make sure only what the website really needs is loaded in the head?

Pitfalls: Some of these resources might be necessary in some situations.
*/





/***** Head Cleanup *****/
function base_head_cleanup() {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); // remove json api links
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'wp_head', 'rsd_link'); // remove really simple discovery link
	remove_action( 'wp_head', 'wp_generator'); // remove wordpress version
	remove_action( 'wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
	remove_action( 'wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
	remove_action( 'wp_head', 'index_rel_link'); // remove link to index page
	remove_action( 'wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0); // remove random post link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_resource_hints', 2 ); //removes dns-prefetch

	//remove embed js
	wp_deregister_script( 'wp-embed' );
}
add_action( 'init', 'base_head_cleanup' );





/***** Remove Emojis *****/
function base_disable_emojis() {
	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'base_disable_emojis_tinymce' );
}

//Disable plugins from using emojis
function base_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
add_action( 'init', 'base_disable_emojis' );





/***** Base Meta Tags Needed In Head *****/
/*
Question: What meta tags do we need? What's essential and what should be standard and future-proot?

Pitfalls: I used to be a big fan of disallowing zooming, but there are a lot of articles stating to do otherwise for usability reasons. Unless you're creating a web app that NEEDS to look a certain way (https://davidwalsh.name/zoom-mobile-browsers). Otherwise, there's a pretty good consensus that it should be left alone (http://ux.stackexchange.com/questions/37511/should-users-be-able-to-zoom-in-a-responsive-webdesign)
*/
function base_meta() {
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
}
add_action('wp_head', 'base_meta');





/***** Other *****/
//Allow WordPress to handle the title
function base_theme_setup() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'base_theme_setup' );