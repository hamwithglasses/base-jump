<?php
/**
* Plugin Name: Base Jump
* Plugin URI: https://github.com/hamwithglasses/base-jump
* Description: Jump-start your base WordPress theme.
* Version: 0.0.4
* Author: Kegham Bedoyan
* Author URI: http://kegh.am
*/
function base_jump_init() {
	require_once('lib/helper/main.php'); //helpful functions and repeated code
	require_once('lib/admin/main.php'); //changes to the admin visually or functionally
	require_once('lib/base/main.php'); //basic defaults for every theme
	require_once('lib/vendor/main.php'); //third-party/plugin specific optimizations
}
add_action( 'plugins_loaded', 'base_jump_init' );