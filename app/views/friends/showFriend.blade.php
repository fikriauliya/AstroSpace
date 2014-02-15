	<div class="tab-pane"  id="showFriend">
		<div style="margin: 20px">
			<h3> Friends List </h3>
			<table class="table table-striped table-bordered">
				<tbody>
				@if(Auth::check() &&  Auth::user()->id == $user->id)
					@foreach($user->friends as $key => $value)
					<tr>
						<td>
							<a href=" {{ URL::to('spaces/'.$value->friend_id)}}"> {{ User::find($value->friend_id)->username }} </a>
						</td>
						<td>
							{{ Form::open(array('url' => 'removeFriend/')) }}
							{{ Form::hidden('friend_id', $value->friend_id) }}
							{{ Form::submit('Remove ?', array('class' => 'btn btn-danger')) }}
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				@endif
				</tbody>
			</table>
		
			<h3> Friend Requests </h3>
			<div style="margin: 20px">
			<table class="table table-striped table-bordered">
				<tbody>
				@if (Auth::check() && Auth::user()->id == $user->id)
					@foreach($user->friend_requests as $key => $value) 
						<tr>
							<td>
								<a href= "{{ URL::to('spaces/'.$value->friend_id) }}" > {{User::find($value->friend_id)->username }}  </a>
							</td>
							<td>
							{{ Form::open(array('url' => 'acceptFriend/')) }}
							{{ Form::hidden('friend_id', $value->friend_id) }}
							{{ Form::submit('Accept ?', array('class' => 'btn btn-info')) }}
							{{ Form::close() }}
							</td>
						</tr>
					@endforeach
				@endif
				</tbody>
			</table>
			</div>

	

		</div>
	</div>
			
