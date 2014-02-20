@extends('layouts.master')
@section('content')
  <div class="row">
    <div class="col-sm-12">
        <h3>{{{ $blogpost->title }}}</h3>
        <p>{{{ $blogpost->content }}}</p>
        <small>Mood: {{{ $blogpost->mood }}}</small>
        <hr/>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-8">
      @foreach($comments as $comment)
        <div style="background-color: rgb(247, 247, 249); padding:20px; margin-bottom: 10px">
          <p style="font-size:small">{{{$comment->content}}}</p>
          <small>By 
            {{ HTML::link('spaces/'.$comment->postedBy->id, $comment->postedBy->username) }}</small>
        </div>
      @endforeach
    </div>
    <div class="col-sm-4">
      {{ Form::open(array('url'=>'comments', 'class'=>'form-horizontal', 'role'=>'form')) }}
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
          {{ Form::submit('Add comment', array('class'=>'btn btn-primary'))}}          
        </div>
      {{ Form::close() }}
    </div>
  </div>
@stop