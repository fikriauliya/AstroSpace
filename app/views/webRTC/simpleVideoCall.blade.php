<!DOCTYPE html>
<html>
<head>
{{ HTML::script('js/adapter.js') }} 
{{ HTML::script('js/simplewebrtc2.js') }}
</head>

<body>

<div id="localVideo" muted></div>
<div id="remoteVideo"></div>


<script>
var webrtc = new SimpleWebRTC({
   localVideoEl: 'localVideo',
   remoteVideosEl: 'remoteVideo',
   autoRequestMedia: true,
	debug: true
});

webrtc.on('readyToCall', function () {
   webrtc.joinRoom("r"+<?php echo json_encode(Input::get('r'))?>);
});
</script>

</body>

</html>

