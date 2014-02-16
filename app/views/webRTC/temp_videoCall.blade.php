<!DOCTYPE html>
<html>
<head>

<meta name='keywords' content='WebRTC, HTML5, JavaScript' />
<meta name='description' content='WebRTC Reference App' />
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1'>

<base target='_blank'>

<title>WebRTC client</title>

<!-- <link rel='stylesheet' href='css/main.css' /> -->

</head>

<body>

<div id='container'>

  <div id='videos'>
    <video id='localVideo' autoplay muted></video>
    <video id='remoteVideo' autoplay></video>
  </div>

</div>

{{ HTML::script('js/jquery.js') }}
{{ HTML::script('js/adapter.js') }}
{{ HTML::script('js/webrtc_main.js') }}

</body>
</html>
