<!DOCTYPE html>
<html>
	<head>
		<title>The Artball</title>
		
		<script src="/Functions/jquery-1.11.3.min.js"></script>
		
		<script>
			$(window).load(function() {
				var userAgentString = navigator.userAgent;
				
				if (userAgentString.indexOf("iPhone") > -1 || userAgentString.indexOf("iPod") > -1 || userAgentString.indexOf("iPad") > -1) {
				    window.location.replace("https://itunes.apple.com/app/the-artball/id1031037548?mt=8");
				} else if (/Android/.test(userAgentString)) {
				    window.location.replace("https://play.google.com/store/apps/details?id=com.theartball.theartball");
				}
			});
		</script>
	</head>
	<body>
		<div style="position: absolute; top: 50%; left: 50%; margin: -30px 0px 0px -220px;">
			<a href="http://apple.co/1E9kL3l" style="float: left;">
				<img alt="Download on the App Store" src="http://assets.gcstatic.com/u/apps/asset_manager/uploaded/2012/33/available-on-the-app-store-1345130940.jpg" style="width: 200px; margin: 0px 10px;">
			</a>
			<a href="https://play.google.com/store/apps/details?id=com.theartball.theartball" style="float: left;">
			  <img alt="Get it on Google Play" src="https://developer.android.com/images/brand/en_generic_rgb_wo_45.png" style="width: 200px; margin: 0px 10px;" />
			</a>
		</div>
	</body>
</html>