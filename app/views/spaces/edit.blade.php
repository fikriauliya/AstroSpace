@extends('layouts.master')
@section('content')
	<div class="row">
    {{ Form::model($user,
    	array('route'=> array('spaces.update', $user->id), 'method'=> 'PUT', 
    	'class'=>'form-horizontal', 'role'=>'form')) }}
      <h3>Edit space</h2>

      <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="header">Header</label>
        <div class="col-sm-10">
          {{ Form::text('header', null, array('class'=>'form-control', 'placeholder'=>'Header')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="right_content">Right content</label>
        <div class="col-sm-10">
          {{ Form::text('right_content', null, array('class'=>'form-control', 'placeholder'=>'Right content')) }}
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          {{ Form::submit('Update', array('class'=>'btn btn-primary'))}}          
        </div>
      </div>
    {{ Form::close() }}
  </div>
@stop