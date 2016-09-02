<?php
/***** Helper - Phone *****/





//Telephone Href Link
//@param string $tel - accepts a string that is a phone number
//Defaults USA country code (1)
//Helpful if all you want is the tel link but not the html formatting
function helper_tel_href( $tel, $country = 1 ) {
	return 'tel:+' . $country . preg_replace("/[^0-9]/", "", $tel);
}


//Telephone HTML
function helper_tel( $tel, $country = 1 ) {
	$href = helper_tel_href( $tel, $country );
	return'<a class="js-tel" href="' . $href . '">' . $tel . '</a>';
}