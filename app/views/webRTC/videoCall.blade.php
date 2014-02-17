<html>

<head>
{{ HTML::script('js/rtcMultiConnection/rtcMultiConnection.min.js') }}

{{ HTML::script('js/rtcMultiConnection/getMediaElement.min.js') }}

{{ HTML::style('css/rtcMultiConnection/getMediaElement.css') }}

{{ HTML::script('js/rtcMultiConnection/firebase.js') }}
</head>

<body>
<button id="open-session"> Open Session </button>
<table style="border-left: 1px solid black; width:100%;">
	<tbody>
		<tr>
			<td>
				<h2 style="display: block; text-align: center;"></h2>
				<section  id="local-media-stream"> </section>
			</td>
		</tr>
	</tbody>
</table>


<script>
var connection = new RTCMultiConnection();

connection.session = {
	audio: true,
	video: true
};

var videosContainer = document.getElementById("local-media-stream");

connection.onstream = function(e) {
	var buttons = ['mute-audio', 'mute-video', 'full-screen', 'volume-slider', 'stop'];
	if (connection.session.audio && !connection.session.video) {
		buttons = ['mute-audio', 'record-audio', 'full-screen', 'stop'];
	}
	var mediaElement = getMediaElement(e.mediaElement, {
		width: e.type == (videosContainer.clientWidth / 2) - 50,
		buttons: buttons,
		onMuted: function(type) {
			connection.streams[e.streamid].mute({
				audio: type == 'audio',
				video: type == 'video'
			});
		},
		onUnMuted: function(type) {
			connection.streams[e.streamid].unmute({
				audio: type == 'audio',
				video: type == 'video'
			});
		},
		onStopped: function() {
			connection.drop();
		}
	});
	videosContainer.insertBefore(mediaElement, videosContainer.firstChild);
};

connection.onstreamended = function(e) {
	if (e.mediaElement.parentNode && e.mediaElement.parentNode.parentNode && e.mediaElement.parentNode.parentNode.parentNode) {
		e.mediaElement.parentNode.parentNode.parentNode.removeChild(e.mediaElement.parentNode.parentNode);
	}
};

document.querySelector("button#open-session").onclick = function() {
	connection.open();
	this.disabled = true;
};


connection.connect();


</script>

<!-- <script src="//www.webrtc-experiment.com/common.js"></script> -->

</body>

</html>
