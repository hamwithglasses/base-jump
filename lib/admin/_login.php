<?php
/***** Admin - Login *****/
/*
Problem: The login page works just fine, but the branding makes the website end product look cookie-cutter instead of custom. Additionally, what minimial things can we do within WordPress without plugins that keeps the login page more secure.

Question: How do we create a more custom login page and keep it secure?
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


//Add login styles to customize the wp-login page
function admin_login_styles() {
?>
<link rel='stylesheet' href='<?= get_bloginfo('template_directory')?>/assets/wp-login/login.css' type='text/css' media='all' />
<?php
}
add_action('login_head', 'admin_login_styles');