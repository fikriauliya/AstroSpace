@extends('layouts.master')
@section('header')
  <script type="text/javascript">
    $(function() {
      $('#privacy').change(function() {
        if ($(this).val() == 'private') {
          $('#visible_for_group').show();
        } else {
          $('#visible_for_group').hide();
        }
      });
      $('#privacy').change();
    });
  </script>
@stop

@section('content')
  <div class="row">
    <h3>Edit blog post</h3>
    {{ Form::model($blogpost, array('route'=>array('blogposts.update', $blogpost->id), 
      'class'=>'form-horizontal', 'role'=>'form', 'method' => 'PUT')) }}
      <div class="col-sm-9">
        <ul style="color:red">
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
            {{ Form::textarea('content', null, array('class'=>'form-control', 'placeholder'=>'Content', 'style'=>'height::400px')) }}
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
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <h4>Privacy settings</h4>
        </div>
        <div class="form-group">
          <label for="privacy">Visibility</label>
          {{ Form::select('privacy', array('private' => 'Private', 'public' => 'Public'), $privacy, array('id'=>'privacy', 'class'=>'form-control')) }}
        </div>
        <div class="form-group" id="visible_for_group">
          <label for="visible_to">Visible to</label>
          @foreach($friends as $friend)
            <div>
              <input type="checkbox" name="visible_tos[]" value="{{$friend['id']}}" {{$friend['is_checked']}}/>
              {{$friend['username']}}
            </div>
          @endforeach
        </div>
      </div>
    {{ Form::close() }}
  </div>
@stop