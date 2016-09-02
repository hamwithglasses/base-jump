<?php
/***** Vendor - WP Super Cache *****/





if( function_exists('wp_super_cache_enable') ) {
	
	//Resets cache on ACF options page save
	//http://wordpress.stackexchange.com/questions/98526/empty-super-cache-programmatically-with-acf-action
	//Additional Function to prune the Cache if $post_id is '0' or 'options'
	if( class_exists('acf') ) {
		function vendor_clear_options_cache($post_id) {

		    // just execute if the $post_id has either of these Values. Skip on Autosave
		    if ( ( $post_id == 0 || $post_id == 'options' ) && !defined( 'DOING_AUTOSAVE' ) ) {

		        // Some Super Cache Stuff
		        global $blog_cache_dir;

		        // Execute the Super Cache clearing, taken from original wp_cache_post_edit.php
		        if ( $wp_cache_object_cache ) {
		            reset_oc_version();
		        } else {
		            // Clear the cache. Problem: Due to the combination of different Posts used for the Slider, we have to clear the global Cache. Could result in Performance Issues due to high Server Load while deleting and creating the cache again.
		            prune_super_cache( $blog_cache_dir, true );
		            prune_super_cache( get_supercache_dir(), true );
		        }
		    }

		    return $post_id;
		}
		//Add the new Function to the 'acf/save_post' Hook. I Use Priority 1 in this case, to be sure to execute the Function
		add_action('acf/save_post', 'vendor_clear_options_cache', 1);
	}
	
}