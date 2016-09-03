<?php
/***** Vendor - Yoast *****/





//No one needs to see Yoast up so high.
if( defined('WPSEO_FILE') ) {

	function vendor_yoast_bottom() {
		return 'low';
	}
	add_filter( 'wpseo_metabox_prio', 'vendor_yoast_bottom');
	
}