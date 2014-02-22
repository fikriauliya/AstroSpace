@extends('layouts.master')

@section('content')
  <div class="row">
    <h3>New message</h2>
    {{ Form::open(array('url'=>'messages', 'class'=>'form-horizontal', 'role'=>'form')) }}
      <div class="col-sm-9">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>

        <div class="form-group">
          <label class="col-sm-2 control-label" for="title">Recipient</label>
          <div class="col-sm-10">
            {{ Form::select('recipient', $friends, '', array('class'=>'form-control')) }}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="content">Content</label>
          <div class="col-sm-10">
            {{ Form::textarea('content', null, array('class'=>'form-control', 'placeholder'=>'Content', 'style'=>'height::400px')) }}
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            {{ Form::submit('Send', array('class'=>'btn btn-primary'))}}          
          </div>
        </div>
      </div>
    {{ Form::close() }}
  </div>
@stop