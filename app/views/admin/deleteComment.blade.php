@extends('layouts.master')

@section('content')
<div class="row">
	<h3> Comment by {{{ $user->username }}} </h3>
	<table class="table table-bordered table-condensed table-striped">
		<thead>
			<tr>
				<th>Blog post title</th>
				<th>Comment</th>	
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($user->comments as $key => $value)
			<tr>
				<td>{{{ $value->blogPost->title }}}</td>
				<td>{{{ $value->content }}}</td>
				<td>
					{{ Form::open(array('url' => 'admin/delete-comment')) }}
					{{ Form::hidden('comment_id', $value->id) }}
					{{ Form::submit('Delete', array('class'=>'btn btn-danger') ) }}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div> <!-- row -->
@stop
