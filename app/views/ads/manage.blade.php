@if(Auth::check()  && Auth::user()->id == $user->id)
<div class="tab-pane" id="manageAds">
	<div style="margin:20px">
		<h3>Published ads:</h3>
		<div style="margin: 10px">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<td>Title</td>
					<td>Description</td>
					<td>URL</td>
					<td>Remaining budget</td>
				</tr>
			</thead>
			<tbody>
			@foreach($user->ads as $key => $value)
				<tr>
					<td>{{{ $value->title }}} </td>
					<td>{{{ $value->description }}} </td>
					<td>{{{ $value->url }}} </td>
					<td>{{{ $value->budget }}} </td>
				</tr>
			@endforeach
			</tbody>
		</table>
		</div><!-- margin 10px -->
		
		<a href="{{ URL::to('ads/create/') }}" class="btn btn-primary">Publish new ads</a>

	</div><!-- margin 20px -->
</div> <!--tab pange -->


@endif
