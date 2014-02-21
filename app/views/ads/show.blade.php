<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body {
			background-color: black;
			margin: 0;
			padding: 0;
		}
	</style>
</head>

<body>
	<?php 
		//Sanitize the url from the user with white listing character:
		$pattern = '/[^-A-Za-z0-9+&@#\/%?=~_|!:,.;\(\)]/'; 
		$safe_url = preg_replace($pattern, '', $url);
	?>
	<iframe width="600" height="200" scrolling="no" frameborder="0" style="overflow: hidden" src= "{{ $safe_url }}"></iframe>

</body>
</html>
