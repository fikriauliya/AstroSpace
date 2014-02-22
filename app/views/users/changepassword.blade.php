@extends('layouts.master')
@section('content')
  <div class="row">
    {{ Form::open(array('url'=>'users/changepassword', 'class'=>'form-horizontal', 'role'=>'form')) }}
      <h3>Change password</h2>

      <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="current_password">Current password</label>
        <div class="col-sm-10">
          {{ Form::password('current_password', array('class'=>'form-control', 'placeholder'=>'Current password')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="password">New password</label>
        <div class="col-sm-10">
          {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="username">New password confirmation</label>
        <div class="col-sm-10">
          {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Password confirmation')) }}
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