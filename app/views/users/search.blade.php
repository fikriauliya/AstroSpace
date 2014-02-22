@extends('layouts.master')
@section('content')
	<div class ="row">
		<h3>User Search</h3>
			
			{{Form::open(array('url'=>'users/search','class' => 'form-horizontal', 'role' => 'form'))}}
			<div class = "form-group">
				<label class = "col-sm-2 control-label" for="search">Search for user</label>
				<div class ="col-sm-10">
					{{ Form::text('search', null, array('class'=>'form-control', 'placeholder'=>'search'))}}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2-offset-2 col-sm-10">
				{{ Form::submit('Search', array('class'=>'btn btn-primary'))}}
				</div>
			</div>
			{{ Form::close() }}
	</div>
	<div>
	<h3> Search Result</h3>
		@if(isset($user_result) && $user_result != "")
			@foreach($user_result as $value) 
				{{ HTML::link('spaces/'.$value->id, $value->username) }}
				<br/>
			@endforeach
		@endif		
	</div>
@stop

