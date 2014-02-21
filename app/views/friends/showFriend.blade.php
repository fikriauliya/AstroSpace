@if(Auth::check() && Auth::user()->id == $user->id)
	<div class="tab-pane"  id="showFriend">
		<div style="margin: 20px">
			<h3> Friends List </h3>
			<div style="margin:10px">
			<table class="table table-striped table-bordered">
				<tbody>
					@foreach($user->friends as $key => $value)
					<tr>
						<td>
							<a href=" {{ URL::to('spaces/'.$value->friend_id)}}"> {{ User::find($value->friend_id)->username }} </a>
						</td>
						<td>

							<a href=# class="remove btn btn-danger" data-userid="{{$value->friend_id}}">Remove</a>

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
					@foreach($user->friend_requests as $key => $value) 
						<tr>
							<td>
								<a href= "{{ URL::to('spaces/'.$value->friend_id) }}" > {{User::find($value->friend_id)->username }}  </a>
							</td>
							<td>
							<a href=# class="accept btn btn-success" data-userid="{{$value->friend_id}}">Accept</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			</div><!-- margin:10px-->
		
		</div>
	</div>
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
@endif			

