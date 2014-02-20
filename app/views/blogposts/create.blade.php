@extends('layouts.master')

@section('header')
  {{ HTML::script('js/bloodhound.js')}}
  {{ HTML::script('js/bootstrap3-typeahead.js')}}
@stop

@section('content')
  <div class="row">
    <h3>New blog post</h2>
    {{ Form::open(array('url'=>'blogposts', 'class'=>'form-horizontal', 'role'=>'form')) }}
      <div class="col-sm-9">

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
          <h4>Privacy settings</b>
        </div>
        <div class="form-group">
          <label for="visible_to">Visible to</label>
          {{ Form::text('visible_to', null, array('data-provide'=>"typeahead", 'autocomplete'=>'off', 'class'=>'form-control typeahead')) }}
        </div>
      </div>
    {{ Form::close() }}
  </div>

  <script type="text/javascript">
    $(function() {
      // instantiate the bloodhound suggestion engine
      var numbers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local:  ["(A)labama","Alaska","Arizona","Arkansas","Arkansas2","Barkansas"]
      });

      // initialize the bloodhound suggestion engine
      numbers.initialize();

      $('.typeahead').typeahead(
      {
        items: 4,
        source:numbers.ttAdapter()  
      }); 
    });
  </script>
@stop