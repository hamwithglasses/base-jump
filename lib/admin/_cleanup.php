<?php
/***** Admin - Cleanup *****/
/*
Problem: As nice as it is to see WordPress branding everywhere, it's really unecessary, especially for all the work that goes into a custom WordPress site.

Question: How do we remove WordPress branding on the dashboard and offer a personalized login experience?
*/





//Remove 'Howdy' from WP Dashboard
//https://wordpress.org/support/topic/remove-howdy
function admin_remove_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy,', '', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'admin_remove_howdy',25 );


//Remove top left WordPress logo from WP Dashboard
//https://wordpress.org/support/topic/filter-to-remove-wordpress-logopages-from-admin-bar
function admin_remove_wp_logo() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'admin_remove_wp_logo', 0);


//Remove footer 'Thank you for creating with WordPress' from WP Dashboard
//http://code.tutsplus.com/articles/customizing-the-wordpress-dashboard-for-your-clients--wp-21513
function admin_remove_wp_footer () 
{
    echo '';
}
add_filter('admin_footer_text', 'admin_remove_wp_footer');