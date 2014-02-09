@extends('layouts.master')
@section('content')
  <div class="row">
    {{ Form::open(array('url'=>'users/create', 'class'=>'form-horizontal', 'role'=>'form')) }}
      <h3>Registration</h2>

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
        <label class="col-sm-2 control-label" for="username">Password confirmation</label>
        <div class="col-sm-10">
          {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Password confirmation')) }}
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
          {{ Form::submit('Register', array('class'=>'btn btn-primary'))}}          
        </div>
      </div>
    {{ Form::close() }}
  </div>
@stop