@extends('layouts.master')
@section('header')
  <style>
    .typeahead,
    .tt-query,
    .tt-hint {
      width: 396px;
      height: 30px;
      padding: 8px 12px;
      font-size: 24px;
      line-height: 30px;
      border: 2px solid #ccc;
      -webkit-border-radius: 8px;
         -moz-border-radius: 8px;
              border-radius: 8px;
      outline: none;
    }

    .typeahead {
      background-color: #fff;
    }

    .typeahead:focus {
      border: 2px solid #0097cf;
    }

    .tt-query {
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
         -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
              box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    .tt-hint {
      color: #999
    }

    .tt-dropdown-menu {
      width: 422px;
      margin-top: 12px;
      padding: 8px 0;
      background-color: #fff;
      border: 1px solid #ccc;
      border: 1px solid rgba(0, 0, 0, 0.2);
      -webkit-border-radius: 8px;
         -moz-border-radius: 8px;
              border-radius: 8px;
      -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
         -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
              box-shadow: 0 5px 10px rgba(0,0,0,.2);
    }

    .tt-suggestion {
      padding: 3px 20px;
      font-size: 18px;
      line-height: 24px;
    }

    .tt-suggestion.tt-cursor {
      color: #fff;
      background-color: #0097cf;

    }

    .tt-suggestion p {
      margin: 0;
    }

  </style>

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
          {{ Form::text('visible_to', null, array('dir'=>'auto', 'class'=>'typeahead tt-input', 'placeholder'=>'visible_to')) }}
        </div>
      </div>
    {{ Form::close() }}
  </div>


  {{ HTML::script('js/typeahead.bundle.min.js')}}

  <script type="text/javascript">
    $(function() {
      var numbers = new Bloodhound({
        datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.num); },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: [
          { num: 'one' },
          { num: 'two' },
          { num: 'three' },
          { num: 'four' },
          { num: 'five' },
          { num: 'six' },
          { num: 'seven' },
          { num: 'eight' },
          { num: 'nine' },
          { num: 'ten' }
          ]
      });     
      // initialize the bloodhound suggestion engine
      numbers.initialize();
       
      // instantiate the typeahead UI
      $('.typeahead').typeahead(null, {
        displayKey: 'num',
        source: numbers.ttAdapter()
      });
    });
  </script>
@stop