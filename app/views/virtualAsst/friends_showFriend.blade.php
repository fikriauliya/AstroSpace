	<div class="tab-pane"  id="showFriend">
		<div style="margin: 20px">
			<h3> Friends List </h3>
			<div style="margin: 10px">
			<table class="table table-striped table-bordered">
				<tbody>
					<?php 
						$friends = array("Friend1", "Friend2", "Friend3");
					?>
					@foreach($friends as $key => $value)
					<tr>
						<td>
							<a href="#"> {{{$value}}} </a>
						</td>
						<td>

							<a href=# class="btn btn-danger">Remove</a>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
	
			<h3> Friend Requests </h3>
			<div style="margin: 10px">
			<table class="table table-striped table-bordered">
				<tbody>
					<?php
						$friend_requests = array("FutureFriend1", "FutureFriend2", "FutureFriend3");
					?>
					@foreach($friend_requests as  $value) 
						<tr>
							<td>
								<a href= "#" > {{ $value }}  </a> 
							</td>
							<td>
							<a href=# class="btn btn-success">Accept</a>
							</td>
						</tr>
					@endforeach  
				</tbody>
			</table>
			</div>
	
		</div>
	</div>

