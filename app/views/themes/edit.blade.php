@extends('layouts.master')
@section('content')
	<div class="row">
    {{ Form::model($user,
    	array('route'=> array('themes.update', $user->id), 'method'=> 'PUT', 
    	'class'=>'form-horizontal', 'role'=>'form')) }}
      <h3>Edit theme</h2>

      <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="username">Theme</label>
        <div class="col-sm-10">
          {{ Form::select('theme', array('-amelia'=>'Amelia', '-cerulean'=>'Cerulean', '-cosmo'=>'Cosmo', 
            '-cupid'=>'Cupid', '' =>'Default'), '', array('class'=>'form-control', 'placeholder'=>'Theme')) }}
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