<?php
/***** Dashboard *****/
/*
Problem: Ok seriously... Are any of the defaults on the dashboard necessary? Let's clean the slate.
Question: How do we clean up the WP dashboard and show items that the user actually needs?

- Remove default dashboard widgets & welcome panel
- Remove vendor-specific widgets
*/





//Remove Dashboard
//https://digwp.com/2014/02/disable-default-dashboard-widgets/
function base_dashboard_cleanup() { 
	global $wp_meta_boxes;

	//Defaults
	remove_action('welcome_panel','wp_welcome_panel');
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	
	//Vendor
	unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']); //bbpress
	unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']); //yoast
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' ); //yoast
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']); //gravity form
}
add_action('wp_dashboard_setup', 'base_dashboard_cleanup' );