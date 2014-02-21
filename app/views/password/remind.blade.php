@extends('layouts.master')
@section('content')
<h3>Password reset</h3>
<form action="{{ action('RemindersController@postRemind') }}" method="POST" class="form-horizontal">
    <div class="form-group">
      <label class="col-sm-2 control-label" for="email">Email</label>
      <div class="col-sm-10">
        <input type="email" name="email" placeholder="email" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <input type="submit" value="Send Reminder" class="btn btn-primary">
      </div>
    </div>
</form>
@stop