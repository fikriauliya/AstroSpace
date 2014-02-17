@if (Auth::check() && Auth::user()->id == $user->id)
<div class="tab-pane" id="showVideoCallInfo">
	<div style="margin:20px">
	<div id="activeRoom">
		@if($user->videoRoom()->exists())
		<h3> You have active video chat room with room_id: {{{ $user->videoRoom->room_id }}}</h3>
		<?php
			$room_id = $user->videoRoom->room_id; 
			$participants = VideoRoom::where('room_id', '=', $room_id);
		?>
		{{ Form::open(array('url' => 'webrtc/', 'method'=>'GET')) }}
		{{ Form::hidden('r', $room_id) }}
		{{ Form::submit('Go to video chat room') }}
		{{ Form::close() }}

		<a href="{{ URL::to('webrtc/') }}?r={{{$room_id}}}">Go to active room</a>

		<h4> Participants: </h4>
		<table>
			<tbody>
				@foreach($participants as $key => $value)
				<tr>
					<td> {{{ User::find($value->friend_id)->username }}} </td>
				</tr>
				@endforeach
			</tbody>
		</table>
		
			
		@else
			<h3> You don't have active video chat room. </h3>
			{{ Form::open(array('url' => 'webrtc/createRoom')) }}
			{{ Form::submit('Create new room', array('class' => 'btn btn-info')) }}
			{{ Form::close() }}
		@endif
	</div>
	<h3> Invitation to video chat: </h3>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<td>Room_ID</td>
				<td>Host</td>
				@if(!$user->videoRoom()->exists())
				<td>Approve</td>
				@endif
			</tr>
		</thead>
		<tbody>
		@foreach($user->videoCallRequests as $key => $value)
			<tr>
				<td>{{{ $value->room_id }}}</td>
				<td>{{{ User::find($value->host_id)->username }}}</td>
				@if (!$user->videoRoom()->exists())
				<td>
					{{ Form::open(array('url' => 'webrtc/approveRoom')) }}
					{{ Form::hidden('room_id', $value->room_id) }}
					{{ Form::submit('Approve', array('class' => 'btn btn-info') ) }}
					{{ Form::close() }}
				</td>	
				@endif
			</tr>
		@endforeach
		</tbody>
	</table>


	</div>
</div>

@endif
