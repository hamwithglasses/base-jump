<?php
/***** Helper - Fonts *****/





//Typekit Advanced (async)
//@param string $id - TypeKit id
//deprecated: Use wf_loader instead, but if you're just going to use Typekit, this works too...
function helper_typekit($id) {
	return '<script>(function(d) {var config = {kitId: "' . $id . '",scriptTimeout: 3000},h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src="//use.typekit.net/"+config.kitId+".js";tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)})(document);</script>';
}