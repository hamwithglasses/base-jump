<?php
/***** Helper - Tracking *****/





//Analytics
//@param array $id - array of string ids of analytics ids
function helper_google_analytics($id) {
	if(sizeof($id) > 0) {
		$script = "<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');";
		$count = 0;
		foreach($id as $i) {
			if(is_array($i)){
				$i = array_values($i)[0];
			}
			if($count == 0) {
				$script .= "ga('create', '" . $i . "', 'auto');";
			}else{
				$script .= "ga('create', '" . $i . "', 'auto', {'name': 'additionalTracker" . $count . "'});";
			}

			$count++;
		}
		//handles multiple ids properly
		//http://stackoverflow.com/questions/18997966/how-to-track-multiple-accounts-using-new-analytics-js
		for($i = 0; $i < $count; $i++) {
			if($i == 0) {
				$script .= "ga('send', 'pageview');";
			}else{
				$script .= "ga('additionalTracker" . $i . ".send', 'pageview');";
			}
		}
		$script .= '</script>';

		return $script;
	}
}


//Google Remarketing
//@param array $id - accepts an of string remarketing code ids
function helper_google_remarketing($id) {
	if(sizeof($id) > 0) {
		$script .= '';
		foreach($id as $i) {
			if(is_array($i)){
				$i = array_values($i)[0];
			}
			$script .= '
				<div style="display: none;">
				<!-- Remarketing Tag -->
				<script type="text/javascript">
				/* <![CDATA[ */
				var google_conversion_id = ' . $i . ';
				var google_custom_params = window.google_tag_params;
				var google_remarketing_only = true;
				/* ]]> */
				</script>
				<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
				<noscript>
				<div style="display:inline;">
				<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/' . $i . '/?value=0&amp;guid=ON&amp;script=0"/>
				</div>
				</noscript>
				</div>
				';
		}

		return $script;
	}
}