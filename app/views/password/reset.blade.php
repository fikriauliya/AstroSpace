@extends('layouts.master')
@section('content')
<div class="row">
  <h3>Password reset</h3>
  <form action="{{ action('RemindersController@postReset') }}" method="POST" class="form-horizontal">
    <input type="hidden" name="token" value="{{ $token }}"/>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="email">Email</label>
      <div class="col-sm-10">
        <input type="email" name="email" placeholder="Email" class="form-control"/>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="password">Password</label>
      <div class="col-sm-10">
        <input type="password" name="password" placeholder="Password" class="form-control"/>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="password_cofirmation">Password confirmation</label>
      <div class="col-sm-10">
        <input type="password" name="password_confirmation" placeholder="Password confirmation" class="form-control"/>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <input type="submit" value="Reset Password" class="btn btn-primary">
      </div>
    </div>
  </form>
</div>
@stop