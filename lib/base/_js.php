<?php
/***** Base - JS *****/
/*
Problem: WordPress adds random JS as well. That needs to be cleaned up and any JS should ALWAYS load at the bottom. Anything that needs to be higher up needs to be reconsidered or inlined.

Question: How do we clean up extra JS and load JS at the bottom?
*/





//Remove jQuery Migrate
/**
 * 1: Remove jquery
 * 2: Add jquery back w/o jquery-migrate as a dependancy.
 * 3: Update jquery and jquery-core to load in the footer.
 *
 * @filter wp_default_scripts 
 * 
 * @param  WP_Scripts obj $scripts Object containing all the scripts to load.
 * @return WP_Scripts obj $scripts Modified Object containing all the scripts to load.
 */
function base_remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() ) {
		/**
		 * Remove jquery from the default scripts array.
		 */
		$scripts->remove( 'jquery' );

		/**
		 * Add "jquery" back to the defaults scripts array
		 * but exclude "jquery-migrate" as a dependancy.
		 */
		$scripts->add(
			'jquery',
			false,
			array( 'jquery-core' ),
			''
		);

		$scripts->add_data( 'jquery', 'group', 1 );
		$scripts->add_data( 'jquery-core', 'group', 1 );
	}

	return $scripts;
}
add_filter( 'wp_default_scripts', 'base_remove_jquery_migrate' );