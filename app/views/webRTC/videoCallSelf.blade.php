<!DOCTYPE html>
<html>

<head>
<title> WebRTC </title>

{{ HTML::script('js/adapter.js') }}

</head>

<body>

	<video id="localVideo" autoplay muted></video>
	<video id="remoteVideo" autoplay muted></video>

	<div>
		<button id="startBtn">Start</button>
		<button id="callBtn">Call</button>
		<button id="hangupBtn">Hang up</button>
	</div>

	<script>
	var localStream, localPeerConnection, remotePeerConnection;
	var localVideo = document.querySelector("video#localVideo");
	var remoteVideo = document.querySelector("video#remoteVideo");
	var startButton = document.querySelector("button#startBtn");
	var callButton = document.querySelector("button#callBtn");
	var hangupButton = document.querySelector("button#hangupBtn");

	startButton.disabled = false;
	callButton.disabled = true;
	hangupButton.disabled = true;

	startButton.onclick = start;
	callButton.onclick = call;
	hangupButton.onclick = hangup;

	var constraint = {"video":true, "audio":true}


	function trace(text) {
		console.log( (performance.now() / 1000).toFixed(3) + ": " + text);
	}

	function gotStream(stream) {
		trace("Received local stream");
		localVideo.src = URL.createObjectURL(stream);
		localStream = stream;
		localVideo.onloadedmetadata = function(e) {
			trace("Got the local stream!");
		};
		callButton.disabled = false;
	}

	function errorCallback(e) {
		trace("getUserMedia error: ", error);
	}

	function start() {
		trace("Requesting local stream");
		startButton.disabled = true;
		getUserMedia(constraint, gotStream, errorCallback);
	}

	function call() {
		callButton.disabled = true;
		hangupButton.disabled = false;
		trace("Starting call");

		if (localStream.getVideoTracks().length > 0) {
			trace("Using video device: " + localStream.getVideoTracks()[0].label);
		}
		if (localStream.getAudioTracks().length > 0) {
			trace("Using audio device: " + localStream.getAudioTracks()[0].label);
		}

		var servers = null;
		localPeerConnection = new RTCPeerConnection(servers);
		trace("Created local peer connection object localPeerConnection");
		localPeerConnection.onicecandidate = gotLocalIceCandidate;

		remotePeerConnection = new RTCPeerConnection(servers);
		trace("Created remote peer connection object remotePeerConnection");
		remotePeerConnection.onicecandidate = gotRemoteIceCandidate;
		remotePeerConnection.onaddstream = gotRemoteStream;

		localPeerConnection.addStream(localStream);
		trace("Added localstream to localPeerConnection");
		localPeerConnection.createOffer(gotLocalDescription, handleError);
	}

	function gotLocalDescription(description) {
		localPeerConnection.setLocalDescription(description);
		trace("Offer from localPeerConnection: \n" + description.sdp);
		remotePeerConnection.setRemoteDescription(description);
		trace("After setRemoteDescription and before gotRemoteDescription");
		remotePeerConnection.createAnswer(gotRemoteDescription, handleError);
	}

	function gotRemoteDescription(description) {
		remotePeerConnection.setLocalDescription(description);
		trace("Answer from remotePeerConnection: \n" + description.sdp);
		localPeerConnection.setRemoteDescription(description);
	}

	function hangup() {
		trace("Ending call");
		localPeerConnection.close();
		remotePeerConnection.close();
		localPeerConnection = null;
		remotePeerConnection = null;
		hangupButton.disabled = true;
		callButton.disabled = false;
	}

	function gotRemoteStream(event) {
		remoteVideo.src = URL.createObjectURL(event.stream);
		trace("Received remote stream");
	}

	function gotLocalIceCandidate(event) {
		if (event.candidate) {
			remotePeerConnection.addIceCandidate(new RTCIceCandidate(event.candidate));
			trace("Local ICE candidate: \n" + event.candidate.candidate);
		}
	}

	function gotRemoteIceCandidate(event) {
		if (event.candidate) {
			localPeerConnection.addIceCandidate(new RTCIceCandidate(event.candidate));
			trace("Remote ICE candidate: \n" + event.candidate.candidate);
		}
	}

	function handleError(){}

</script>

</body>

</html>
