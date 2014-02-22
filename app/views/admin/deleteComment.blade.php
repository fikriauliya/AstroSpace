@extends('layouts.master')

@section('content')
<div class="row">
	<h3> Comment by {{{ $user->username }}} </h3>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<td>Blog_id</td>
				<td>Comment</td>	
				<td></td>
			</tr>
		</thead>
		<tbody>
		@foreach($user->comments() as $key => $value)
			<tr>
				<td>{{{ $value->blog_post_id }}}</td>
				<td>{{{ $value->content }}}</td>
				<td>
					{{ Form::open(array('url' => 'admin/deleteComment')) }}
					{{ Form::hidden('comment_id', $value->id) }}
					{{ Form::submit('Delete', array('class'=>'btn btn-danger') ) }}
					{{ Form::close() }}
				</td>
		@endforeach
		</tbody>
	</table>
</div> <!-- row -->
@stop
