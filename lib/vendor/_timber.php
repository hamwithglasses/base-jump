<?php
/***** Vendor - Timber *****/




if( class_exists('Timber') ) {

	//Default data passed to context
	function twig_timber_context( $context ) {
		//Useful Variables
		global $template;
		$context['theme_template']      = str_replace( '.php', '', basename( $template ) );
		$context['theme_url']           = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];

		//Bam! Magic!
		return $context;
	}
	add_filter( 'timber_context', 'twig_timber_context' );

}