<?php
/***** Admin - Menu *****/





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