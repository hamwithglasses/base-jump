<?php
/***** Vendor - ACF *****/





if( class_exists('acf') ) { 
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page([
			'page_title' => 'Options',
			'menu_title' => 'Options',
			'icon_url'   => 'dashicons-layout',
		]);
	}
}