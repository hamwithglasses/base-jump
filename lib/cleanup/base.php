<?php
/***** Cleanup *****/
/*
Problem: WordPress adds a lot of unecessary links & resources that are rarely used outside of the generic/simple blog.
Question: How do we make sure only what the website really needs is loaded in the head?

- Removes WP version number from the site
- Removes RSS feed links
- Removes relational post/page links
- Removes embed handling
- Removes emojis
- Miscuellanous cleanup
- Removes version query string on resources
*/





//Head cleanup
function base_head_cleanup() {
	//WP Version
	remove_action( 'wp_head', 'wp_generator' ); //WP version
	add_filter('the_generator', '__return_false'); //WP version in RSS feeds

	//RSS
	remove_action( 'wp_head', 'feed_links', 2 ); //rss feed links
	remove_action( 'wp_head', 'feed_links_extra', 3 ); //extra rss feed links

	//Page/Post
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); //WP short link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); //relational links for the posts adjacent to the current post
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10); //relational links posts adjacent to the current post for single post pages
	remove_action( 'wp_head', 'index_rel_link' ); //index link deprecated 3.3.0
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //prev link deprecated 3.3.0
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); //start link deprecated 3.3.0

	//Embed
	wp_deregister_script( 'wp-embed' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 ); //oEmbed discovery links
	remove_action('wp_head', 'wp_oembed_add_host_js'); //oEmbed JavaScript

	//Emojis
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	add_filter('emoji_svg_url', '__return_false');
	add_filter( 'tiny_mce_plugins', 'base_disable_emojis_tinymce' );

	//Misc.
	remove_action( 'wp_head', 'rsd_link' ); //Really Simple Discovery link
	remove_action( 'wp_head', 'wlwmanifest_link' ); //Windows Live Writer link
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); //REST API link
	remove_action( 'wp_head', 'wp_resource_hints', 2 ); //pre-fetching, pre-rendering and pre-connecting to web sites
}
add_action( 'init', 'base_head_cleanup' );


//Remove version on CSS & JS
function base_remove_version( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', 'base_remove_version', 15, 1 );
add_filter( 'style_loader_src', 'base_remove_version', 15, 1 );