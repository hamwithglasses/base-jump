<?php
/***** Admin - Login *****/
/*
Problem: The login error message makes it too obvious if a user exists. Also, why is the login page linking to WordPress.com?
Question: How do we clean up the login page?
*/





//Changes logo on the login page to link out to the website
function admin_login_link() {
	return get_site_url();
}
add_filter('login_headerurl','admin_login_link');


//Generic login error
//This prevents people knowing if the username even exists
function admin_login_errors(){
  return 'Sorry, the login you entered is incorrect.';
}
add_filter( 'login_errors', 'admin_login_errors' );