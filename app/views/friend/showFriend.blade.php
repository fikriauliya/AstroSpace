	<div class="tab-pane active"  id="showFriend">
		<div style="margin: 20px">
			@if(Auth::check() &&  Auth::user()->id == $user->id)
				@foreach($friend as $key => $value)
					<div class="row">
						<a href=" {{ URL::to('spaces/'.$value->friend_id)}}"> {{ User::find($value->friend_id)->username }} </a>
					</div>
				@endforeach
			@endif
		</div>
	</div>
			
