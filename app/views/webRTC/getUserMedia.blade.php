<!DOCTYPE html>
<html>
<head>
<title> Testing WebRTC </title>
</head>

<body>
Hello world!

<video autoplay></video>
<div class='select'>
	<label for='audioSource'>Audio source:</label>
	<select id='audioSource'></select>
	<label for='videoSource'>Video source:</label>
	<select id='videoSource'></select>
	<label for='constraintSource'>Constraint: </label>
	<select id='constraintSource'></select>
</div>
<button id='start'> Start Video</button>
<button id='stop'>Stop Video</button>


<script>
navigator.getUserMedia = 	navigator.getUserMedia ||
									navigator.webkitGetUserMedia ||
									navigator.mozGetUserMedia || 
									navigator.msGetUserMedia;


var hdConstraints = {
	video: {
		mandatory: {
			minWidth : 1280,
			minHeight: 720,
		}
	},
	audio: true
};

var vgaConstraints = {
	video: {
		mandatory: {
			minWidth : 640,
			minHeight: 360,
		}
	},
	audio: true
};

var allConstraints = {'hdConstraints':hdConstraints, 'vgaConstraints':vgaConstraints};

var video = 				document.querySelector('video');
var audioSelect = 		document.querySelector('select#audioSource');
var videoSelect = 		document.querySelector('select#videoSource');
var constraintSelect = 	document.querySelector('select#constraintSource');
var startButton = 		document.querySelector('button#start');
var stopButton = 			document.querySelector('button#stop');

audioSelect.onchange = start;
videoSelect.onchange = start;
constraintSelect.onchange = start;
startButton.onclick = start;
stopButton.onclick = stop;


function gotSources(sourceInfos) {
	for (var i=0; i!= sourceInfos.length;++i) {
		var sourceInfo = sourceInfos[i];
		var option = document.createElement('option');
		option.value = sourceInfo.id;
		if (sourceInfo.kind === 'audio') {
			option.text = sourceInfo.label || 'microphone ' + (audioSelect.length + 1);
			audioSelect.appendChild(option);
		}
		else if (sourceInfo.kind === 'video') {
			option.text = sourceInfo.label || 'camera ' + (videoSelect.length + 1);
			videoSelect.appendChild(option);
		}
		else {
			console.log('Some other kind of source: ', sourceInfo);
		}
	}
}

function populateConstraintSelect() {
	for (var constraint in allConstraints) {
		var option = document.createElement('option');
		option.value = constraint;
		option.text = constraint;
		constraintSelect.appendChild(option);
	}
}
populateConstraintSelect();

if (typeof MediaStreamTrack === 'undefined') {
	alert('This browser does not support MediaStreamTrack.\n Try Chrome Canary.');
}
else {
	MediaStreamTrack.getSources(gotSources);
}

function fallback(e) {
	video.src = 'fallbackvideo.webm';
}

function successCallback(stream) {
	window.stream = stream; //make stream available to console
	video.src = window.URL.createObjectURL(stream);
	video.onloadedmetadata = function(e) {
		//Ready to go. Do some stuff here!
		console.log("Video is ready!");
	}
	video.play();
}

function errorCallback(error){
	console.log('navigator.getUserMedia error: ', error);
}

function start() {
	if (!!window.stream) {
		video.src = null;
		window.stream.stop();
	}
	if (navigator.getUserMedia) {
	  // Good to go!	
		var audioSource = audioSelect.value;
		var videoSource = videoSelect.value;
		var constraints = allConstraints[constraintSelect.value];
		constraints.audio.optional = [{sourceId: audioSource}];
		constraints.video.optional = [{sourceId: videoSource}];
	  	navigator.getUserMedia(constraints, successCallback, errorCallback);
	} else {
	  console.log('getUserMedia() is not supported in your browser');
		fallback();
	}
}

function stop() {
	video.src = null;
	window.stream.stop();
}

</script>


</body>


</html>
