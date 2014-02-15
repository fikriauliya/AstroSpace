<!DOCTYPE html>
<html>
<head>
<title> Testing WebRTC </title>
</head>

<body>
Hello world!
<script>
function hasGetUserMedia() {
  return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia || navigator.msGetUserMedia);
}

if (hasGetUserMedia()) {
  // Good to go!
	alert("Hello again world!");
} else {
  alert('getUserMedia() is not supported in your browser');
}
</script>


</body>


</html>
