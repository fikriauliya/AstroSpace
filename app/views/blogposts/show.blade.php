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
@stop