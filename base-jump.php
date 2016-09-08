<?php
/**
* Plugin Name: Base Jump
* Plugin URI: https://github.com/hamwithglasses/base-jump
* Description: Jump-start your base WordPress theme.
* Version: 0.0.6
* Author: Kegham Bedoyan
* Author URI: http://kegh.am
*/
function base_jump_init() {
	require_once('lib/cleanup/base.php');
	require_once('lib/cleanup/login.php');
	require_once('lib/cleanup/dashboard.php');
	require_once('lib/cleanup/wp-branding.php');


	//Add login styles to customize the wp-login page
	//Defaults the stylesheet to look in assets/wp-login in the theme folder
	function admin_login_styles() {
	?>
	<link rel='stylesheet' href='<?= get_bloginfo('template_directory')?>/assets/wp-login/login.css' type='text/css' media='all' />
	<?php
	}
	add_action('login_head', 'admin_login_styles');


	//Edit the ordering of the core WordPress menu items
	function admin_edit_menu_order( $menu_order ) {

	    return array(
	        'index.php',
	        'edit.php?post_type=page',
	        'upload.php',
	        'edit.php',
	        'edit-comments.php',
	        'admin.php?page=acf-options-options',
	        
	    );
	}
	add_filter( 'custom_menu_order', '__return_true' );
	add_filter( 'menu_order', 'admin_edit_menu_order' );



	require_once('lib/helper/main.php'); //helpful functions and repeated code
	require_once('lib/base/main.php'); //basic defaults for every theme
	require_once('lib/vendor/main.php'); //third-party/plugin specific optimizations
}
add_action( 'plugins_loaded', 'base_jump_init' );