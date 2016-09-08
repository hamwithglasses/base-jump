<?php
/***** Admin - Cleanup *****/
/*
Problem: WP branding when logged in is unecessary.
Question: How do we remove WordPress branding on the dashboard?

- Remove howdy message
- Remove admin menu WP logo
- Remove footer message
- Remove help tabs
*/





//Remove 'Howdy' from WP Dashboard
//https://wordpress.org/support/topic/remove-howdy
function base_remove_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy,', '', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'base_remove_howdy',25 );


//Remove top left WordPress logo from WP Dashboard
//https://wordpress.org/support/topic/filter-to-remove-wordpress-logopages-from-admin-bar
function base_remove_wp_logo_menu() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'base_remove_wp_logo_menu', 0);


//Remove footer 'Thank you for creating with WordPress' from WP Dashboard
//http://code.tutsplus.com/articles/customizing-the-wordpress-dashboard-for-your-clients--wp-21513
function base_remove_footer_colophon () 
{
    echo '';
}
add_filter('admin_footer_text', 'base_remove_footer_colophon');


//Remove Help Tabs
//http://wordpress.stackexchange.com/questions/50723/how-to-remove-help-tabs
function base_remove_help() {
    $screen = get_current_screen();
    $screen->remove_help_tabs();
}
add_action('admin_head', 'base_remove_help');