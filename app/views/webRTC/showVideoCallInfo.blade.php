@if (Auth::check() && Auth::user()->id == $user->id)
<div class="tab-pane" id="showVideoCallInfo">
	<div style="margin:20px">
	<div id="activeRoom">
		@if($user->videoRoom()->exists())
		<h3> You have active video chat room.</h3>
		<?php
			$room_id = $user->videoRoom->room_id; 
			$participants = VideoRoom::where('room_id', '=', $room_id);
		?>
		{{ Form::open(array('url' => 'webrtc/', 'method'=>'GET')) }}
		{{ Form::submit('Go to video chat room', array('class' => 'btn btn-success')) }}
		{{ Form::close() }}

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
			<h3> You do not have active video chat room. </h3>
			{{ Form::open(array('url' => 'webrtc/createRoom')) }}
			{{ Form::submit('Create new room', array('class' => 'btn btn-info')) }}
			{{ Form::close() }}
		@endif
	</div>
	<h3> Invitation to video chat: </h3>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<td>Host</td>
				@if(!$user->videoRoom()->exists())
				<td>Approve</td>
				@endif
			</tr>
		</thead>
		<tbody>
		@foreach($user->videoCallRequests as $key => $value)
			<tr>
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
