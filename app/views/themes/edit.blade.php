@extends('layouts.master')
@section('header')
  <script type="text/javascript">
    var base_url = "{{$base_url}}";
    $(function() {
      $('#theme').change(function() {
        $('#theme_css').attr('href', base_url + '/css/bootstrap-' + $(this).val() + '.min.css')
      });
    });
  </script>
@stop
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
          {{ Form::select('theme', array('amelia'=>'Amelia', 'cerulean'=>'Cerulean', 'cosmo'=>'Cosmo', 
            'cupid'=>'Cupid', 'default' =>'Default'), $user->theme, array('id'=>'theme', 'class'=>'form-control', 'placeholder'=>'Theme')) }}
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