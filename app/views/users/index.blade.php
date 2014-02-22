@extends('layouts.master')
@section('content')
  <div class="row">
		<h3>Members</h2>
	  
	  <table class="table">
	  	<thead>
	  		<tr>
	  			<td>Username</td>
	  			<td>Email</td>
	  			<td>AIM</td>
	  			<td>MSN</td>
	  			<td>IRC</td>
	  			<td>ICQ</td>
				@if(Auth::check())
				<td></td>
				@endif
	  		</tr>
	  	</thead>
	  	<tbody>
	  		@foreach($users as $key => $value)
		  		<tr>
		  			<td>{{ HTML::link('spaces/' . $value->id, $value->username) }}</td>
		  			<td>{{{$value->email}}}</td>
		  			<td>{{{$value->aim}}}</td>
						<td>{{{$value->msn}}}</td>
						<td>{{{$value->irc}}}</td>
						<td>{{{$value->icq}}}</td>
						@if(Auth::check())
						<td>
						<?php 
							$auth_user = Auth::user();
							$user = $value;
							$is_friend = $user->friends()->where('friend_id', '=',$auth_user->id)->count();
						 	$is_request_friend = $user->friendRequests()->where('friend_id', '=', $auth_user->id)->count();
							$is_request_friend += $auth_user->friendRequests()->where('friend_id','=',$user->id)->count()*10;
							$show_add_friend = 0;
							if ($auth_user->id != $user->id && $is_friend==0 && $is_request_friend==0) {
								$show_add_friend = 1;
							}   
	 
						?>
						@if($show_add_friend)
							{{ Form::open(array('url'=>'addFriend/')) }}
							{{ Form::hidden('friend_id', $user->id) }}
							{{ Form::submit('Add as friend', array('class' => 'btn btn-primary')) }}
							{{ Form::close() }}
						@elseif($is_request_friend >= 10)
							{{ Form::open(array('url' => 'acceptFriend/')) }}
							{{ Form::hidden('friend_id', $user->id) }}
							{{ Form::submit('Accept friend request', array('class' => 'btn btn-success')) }} 
							{{ Form::close() }}
						@endif
						@endif
						</td>
					</tr>
				@endforeach
	  	</tbody>
	  </table>
	</h3>
@stop
