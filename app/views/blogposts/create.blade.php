@extends('layouts.master')
@section('content')
  <div class="row">
    {{ Form::open(array('url'=>'blogposts', 'class'=>'form-horizontal', 'role'=>'form')) }}
      <h3>New blog post</h2>

      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="title">Title</label>
        <div class="col-sm-10">
          {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Title')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="content">Content</label>
        <div class="col-sm-10">
          {{ Form::text('content', null, array('class'=>'form-control', 'placeholder'=>'Content')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="mood">Mood</label>
        <div class="col-sm-10">
          {{ Form::text('mood', null, array('class'=>'form-control', 'placeholder'=>'mood')) }}
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          {{ Form::submit('Post', array('class'=>'btn btn-primary'))}}          
        </div>
      </div>
    {{ Form::close() }}
  </div>
@stop