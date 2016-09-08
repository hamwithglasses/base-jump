<?php
/***** Base - Head *****/





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