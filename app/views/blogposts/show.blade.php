@extends('layouts.master')
@section('content')
  <div class="row">
    <div class="col-sm-12">
        <h3>{{ $blogpost->title }}</h3>
        <p>{{ $blogpost->content }}</p>
        <small>Mood: {{ $blogpost->mood }}</small>
        <hr/>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-8" style="background-color: rgb(247, 247, 249); padding:20px">
      @foreach($comments as $comment)
        <div>
          <p style="font-size:small">{{$comment->content}}</p>
          <small>By {{$comment->postedBy->username}}</small>
        </div>
      @endforeach
    </div>
    <div class="col-sm-3 col-sm-offset-1">
      {{ Form::open(array('url'=>'comments', 'class'=>'form-horizontal', 'role'=>'form')) }}
        <h3>Leave comment</h3>

        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>

        <div class="form-group">
          {{ Form::textarea('content', null, array('class'=>'form-control', 'placeholder'=>'Your comment', 'style'=>'height:100px')) }}
          {{ Form::hidden('blog_post_id', $blogpost->id)}}
        </div>
        
        <div class="form-group">
          {{ Form::submit('Post', array('class'=>'btn btn-primary'))}}          
        </div>
      {{ Form::close() }}
    </div>
  </div>
@stop