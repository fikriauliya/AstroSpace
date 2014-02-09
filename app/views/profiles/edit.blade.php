@extends('layouts.master')
@section('content')
	<div class="row">
    {{ Form::model($user,
    	array('route'=> array('profiles.update', $user->id), 'method'=> 'PUT', 
    	'class'=>'form-horizontal', 'role'=>'form')) }}
      <h3>Edit profile</h2>

      <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="username">Username</label>
        <div class="col-sm-10">
          {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'User Name')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="aim">AIM</label>
        <div class="col-sm-10">
          {{ Form::text('aim', null, array('class'=>'form-control', 'placeholder'=>'AIM')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="msn">MSN</label>
        <div class="col-sm-10">
          {{ Form::text('msn', null, array('class'=>'form-control', 'placeholder'=>'MSN')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="irc">IRC</label>
        <div class="col-sm-10">
          {{ Form::text('irc', null, array('class'=>'form-control', 'placeholder'=>'IRC')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="icq">ICQ</label>
        <div class="col-sm-10">
          {{ Form::text('icq', null, array('class'=>'form-control', 'placeholder'=>'ICQ')) }}
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