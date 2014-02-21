@extends('layouts.master')
<?php /*
<html>

<head>*/ ?>
@section('header')
{{ HTML::script('js/rtcMultiConnection/rtcMultiConnection.min.js') }}

{{ HTML::script('js/rtcMultiConnection/getMediaElement.min.js') }}

{{ HTML::style('css/rtcMultiConnection/getMediaElement.css') }}

{{ HTML::script('js/rtcMultiConnection/firebase.js') }}
<script>
	$(function(){
		console.log("DOM CONTENT LOADED");
		$("a.invite").click( function() {
			var el = this;
			var user_id = el.dataset.userid;
			$.ajax({
				type: "POST",
				url: "{{ URL::to('webrtc/inviteToRoom/') }}",
				data: { 
					'friend_id': user_id,
					'_token': '{{ csrf_token() }}',
				},
				success: function() {
					$(el).replaceWith("<p>Is invited<p>");
				},
				error: function(e) {
					console.log("ERROR: ", e);
				},
			});
		});
	});

</script>

@stop
<?php //</head> ?>

<body>
@section('content')

<button id="open-session" class="btn btn-success"> Start video chat! </button>
<div id="videoContainer">
<table class="table table-bordered" style="border-left: 1px solid black; width:100%;">
	<tbody>
		<tr>
			<td>
				<h2 style="display: block; text-align: center;"></h2>
				<section  id="local-media-stream"> </section>
			</td>
		</tr>
	</tbody>
</table>
</div>

<div id="exitRoom">
	{{ Form::open(array('url' => 'webrtc/exitRoom')) }}
	{{ Form::submit('Quit room', array('class' => 'btn btn-danger')) }}
	{{ Form::close() }}
</div>

<div id="inviteFriend">
<h3>Invite Friend:</h3>
<table class="table table-striped table-bordered">
	<tbody>
		@foreach($user->friends as $key => $value)
		<?php $friend = User::find($value->friend_id);
				$room_id = $user->videoRoom->room_id;
		?>
		<tr>
			<td>
				<a href="{{ URL::to('spaces/'.$friend->id) }}">{{{ $friend->username }}} </a>
			</td>
			<td>
				@if($friend->videoCallRequests()->where('room_id', '=', $room_id)->exists() || ($friend->videoRoom()->exists()&& $friend->videoRoom->room_id == $room_id) )
				<p>Is invited</p>
				@else
				<a href="#" data-userid="{{{$friend->id}}}" class="btn btn-default invite">Invite</a>
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>

<script>
var connection = new RTCMultiConnection("{{$user->videoRoom->room_id}}");

connection.session = {
	audio: true,
	video: true
};

connection.onopen = function(e) {
	var openButton = document.querySelector("button#open-session");
	openButton.disabled = true;
}

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
@stop
<?php /*</body>

</html>*/ ?>
