@extends('layouts.master')
@section('content')
  <div class="row">
		<h3>Sign in</h2>
	  
	  {{ Form::open(array('url'=>'users/signin', 'class'=>'form-horizontal', 'role'=>'form')) }}
	  	<div class="form-group">
	      <label class="col-sm-2 control-label" for="email">Email</label>
	      <div class="col-sm-10">
	        {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email')) }}
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="col-sm-2 control-label" for="password">Password</label>
	      <div class="col-sm-10">
	        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
	      </div>
	    </div>
			<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          {{ Form::submit('Login', array('class'=>'btn btn-primary'))}}          
        </div>
      </div>
		{{ Form::close() }}
	</h3>
@stop