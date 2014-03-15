@if(Auth::check() && Auth::user()->id == $user->id)
	<div class="tab-pane"  id="showFriend">
		<div style="margin: 20px">
			<h3> Friends List </h3>
			<div style="margin:10px">
			<table class="table table-striped table-bordered">
				<tbody>
					@foreach($user->friends2 as $key => $friend)
					<tr>
						<td>
							<a href=" {{ URL::to('spaces/'.$friend->id)}}"> {{{ $friend->username }}} </a>
						</td>
						<td>

							{{ Form::open(array('url' => 'removeFriend/')) }}
							{{ Form::hidden('friend_id', $friend->id) }}
							{{ Form::submit('Remove', array('class' => 'btn btn-danger') ) }}
							{{ Form::close() }}

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div> <!-- margin:10px -->
		
			<h3> Friend Requests </h3>
			<div style="margin:10px">
			<table class="table table-striped table-bordered">
				<tbody>
					@foreach($user->friend_requests2 as $key => $friend) 
						<tr>
							<td>
								<a href= "{{ URL::to('spaces/'.$friend->id) }}" > {{$friend->username }}  </a>
							</td>
							<td>
							{{ Form::open(array('url'=>'acceptFriend')) }}
							{{ Form::hidden('friend_id', $friend->id) }}
							{{ Form::submit('Accept', array('class' => 'btn btn-success')) }}
							{{ Form::close() }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			</div><!-- margin:10px-->
		
		</div>
	</div>

{{--	
	<script>
		$(function(){
			$("a.accept").click(function(){
				var el = this;
				var user_id = el.dataset.userid;
				$.ajax({
					type:"POST",
					url:"{{ URL::to('acceptFriend/') }}",
					data:{
						"friend_id" : user_id,
						"_token" : "{{ csrf_token() }}",
					},
					success: function() {
						$(el).parent().parent().remove();
					},
					error: function(e) {
						console.log("Error accept", e);
					},
				});
			});

			$("a.remove").click(function(){
				var el = this;
				var user_id = el.dataset.userid;
				$.ajax({
					type:"POST",
					url:"{{ URL::to('removeFriend/') }}",
					data:{
						"friend_id" : user_id,
						"_token" : "{{ csrf_token() }}",
					},
					success: function() {
						$(el).parent().parent().remove();
					},
					error: function(e) {
						console.log("Error remove", e);
					},
				});
			});
		});

	</script>
	--}}
@endif			

