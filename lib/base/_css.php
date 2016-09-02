<?php
/***** Base - CSS *****/
/*
Problem: The old way of loading CSS is no more. Non-critical above-the-fold CSS should be loaded asynchronously. This can be handled in template in the head, but we don't get async treatment of plugin-based CSS, plus this is not in line with how WordPress works.

Question: How can we load CSS asynchronously within WordPress?

Resources:
https://github.com/filamentgroup/loadCSS - Filament's Group solution to async loading of CSS and polyfill for older browsers

Updates:
- Handles conditional stylesheets

Pitfalls:
- CSS that needs to bre present before the page renders (eg. mostly JS related) will fail with the async loading of CSS.
*/





//Async CSS Enqueueing With Preload
if ( ! is_admin() ) { //only do async css on theme display, not theme
	//Add CSS calls with preload
	function base_css_preload( $link, $handle, $href ) {
		$html      = '';
		$dom       = new DOMDocument();
		$dom->loadHTML( $link );
		$css       = $dom->getElementById( $handle . '-css' );
		$href      = $css->getAttribute( 'href' );
		$wp_styles = wp_styles();

		/**
		 * Get style object from global styles so we can 
		 * check for things like conditionals for ie.
		 * @var _WP_Dependency Object
		 */
		$style_object = $wp_styles->registered[ $handle ];


		/**
		 * Check for style conditionals (ie style sheets)
		 */
		if ( isset( $style_object->extra['conditional'] ) && ! empty( $style_object->extra['conditional'] ) ) {
			$html .= $link;
		}else {
			$html = '';
			$html .= '<link rel="preload" href="'. $href .'" as="style" onload="this.rel=\'stylesheet\'">';
			$html .= "\n";
			$html .= '<noscript>'. $link .'</noscript>';
			$html .= "\n";
		}

		/**
		 * Using return allows conditional stylesheets to
		 * be wrapped in there html contional tags by WP.
		 */
		return $html;
	}
	add_filter( 'style_loader_tag', 'base_css_preload', 1000, 3 );


	//LoadCSS polyfill in case browser doesn't support async/preload
	function base_css_polyfill(){ 
	?>
	<script>
		!function(a){"use strict";var b=function(b,c,d){function j(a){return e.body?a():void setTimeout(function(){j(a)})}function l(){f.addEventListener&&f.removeEventListener("load",l),f.media=d||"all"}var g,e=a.document,f=e.createElement("link");if(c)g=c;else{var h=(e.body||e.getElementsByTagName("head")[0]).childNodes;g=h[h.length-1]}var i=e.styleSheets;f.rel="stylesheet",f.href=b,f.media="only x",j(function(){g.parentNode.insertBefore(f,c?g:g.nextSibling)});var k=function(a){for(var b=f.href,c=i.length;c--;)if(i[c].href===b)return a();setTimeout(function(){k(a)})};return f.addEventListener&&f.addEventListener("load",l),f.onloadcssdefined=k,k(l),f};"undefined"!=typeof exports?exports.loadCSS=b:a.loadCSS=b}("undefined"!=typeof global?global:this);
		!function(a){if(a.loadCSS){var b=loadCSS.relpreload={};if(b.support=function(){try{return a.document.createElement("link").relList.supports("preload")}catch(a){return!1}},b.poly=function(){for(var b=a.document.getElementsByTagName("link"),c=0;c<b.length;c++){var d=b[c];"preload"===d.rel&&"style"===d.getAttribute("as")&&(a.loadCSS(d.href,d),d.rel=null)}},!b.support()){b.poly();var c=a.setInterval(b.poly,300);a.addEventListener&&a.addEventListener("load",function(){a.clearInterval(c)}),a.attachEvent&&a.attachEvent("onload",function(){a.clearInterval(c)})}}}(this);
		
		!function(a){var b=function(b,c,d){if(void 0===c){var e="; "+a.document.cookie,f=e.split("; "+b+"=");return 2===f.length?f.pop().split(";").shift():null}c===!1&&(d=-1);var g="";if(d){var h=new Date;h.setTime(h.getTime()+24*d*60*60*1e3),g="; expires="+h.toGMTString()}a.document.cookie=b+"="+c+g+"; path=/"};"undefined"!=typeof module?module.exports=b:a.cookie=b}("undefined"!=typeof global?global:this);
		if( ! cookie( "critical-css" ) ) {
			cookie("critical-css", true, 7);
		}
	</script>
	<?php
	}
	add_action('wp_head','base_css_polyfill',1001);
}