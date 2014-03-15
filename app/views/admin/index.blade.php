@extends('layouts.master')

@section('content')
  <div class="row">
      <h3>Users</h2>
     
     <table class="table">
      <thead>
         <tr>
            <td>Username</td>
            <td>Edit info</td>
            <td>Edit space</td>
            <td>Delete comment</td>
            <td>Delete user</td>
         </tr>
      </thead>
		<tbody>
		@foreach(User::all() as $key => $value)
			<tr>
				<td>{{ HTML::link('spaces/'.$value->id, e($value->username)) }}</td>
				<td>{{ HTML::link('admin/edit-info/?user_id='.$value->id, 'Edit info', array('class' => 'btn btn-primary')) }}
				<td>{{ HTML::link('admin/edit-space/?user_id='.$value->id, 'Edit space', array('class' => 'btn btn-primary')) }}
				<td>{{ HTML::link('admin/delete-comment/?user_id='.$value->id, 'Delete comment', array('class' => 'btn btn-primary')) }}
				<td>
					{{ Form::open(array('url' => 'admin/delete-user')) }}
					{{ Form::hidden('user_id', $value->id) }}
					{{ Form::submit('Delete user', array('class' => 'btn btn-danger')) }}
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
		</tbody>
		</table>
	</div> <!-- row -->
@stop
