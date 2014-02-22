@extends('layouts.master')

@section('content')
<div class="row">
    {{ Form::open(array('url'=>'ads/publish', 'class'=>'form-horizontal', 'role'=>'form', 'onsubmit' => 'return ValidateAds()' )) }}
      <h3>Publish new ads</h2>

      <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>

      <div class="form-group">
        <label class="col-sm-2 control-label" for="title">Title</label>
        <div class="col-sm-10">
          {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Title', 'id' => 'ads_title')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="url">Url</label>
        <div class="col-sm-10">
          {{ Form::text('url', null, array('class'=>'form-control', 'placeholder'=>'Url', 'id' => 'ads_url')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="budget">Budget</label>
        <div class="col-sm-10">
          {{ Form::text('budget', null,  array('class'=>'form-control', 'placeholder'=>'Budget', 'id'=>'ads_budget')) }}
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="description">Description</label>
        <div class="col-sm-10">
          {{ Form::text('description', null, array('class'=>'form-control', 'placeholder'=>'Description', 'id'=> 'ads_description')) }}
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          {{ Form::submit('Publish', array('class'=>'btn btn-primary'  )) }}          
        </div>
      </div>
    {{ Form::close() }}
  </div>

	<div id="review_container" style="margin:20px">
	<button id="review_ads_button">Review add</button>
		<div class="container" style="width:600px; height:200px">
			<iframe width="600" height="200" scrolling="no" frameborder="0" style="overflow:hidden;" src="{{ URL::to('ads/review').'?url=' }}" id="review_ads_iframe"></iframe>
		
		</div><!-- container -->	
	</div><!--To review add-->
@stop

@section("header")
<script>
	$(function(){
		$("#review_ads_button").click(function(){
			var url = $("#ads_url").val();
			var safe_url = url.replace(/[^-A-Za-z0-9+&@#\/%?=~_|!:,.;\(\)]/, '');
			if (url != safe_url || (safe_url.search("http://") != 0 && safe_url.search("https://") != 0)) {
				alert("Please input correct full url path. Example: http://nus.edu.sg or https://www.google.com");
			}
			else {
			$("#review_ads_iframe").attr("src",safe_url);
			}
		});
	});

	function ValidateAds(){
		var title = $("#ads_title").val();
		var url = $("#ads_url").val();
		var budget = $("#ads_budget").val();
		var description = $("#ads_description").val()
		
		var safe_url = url.replace(/[^-A-Za-z0-9+&@#\/%?=~_|!:,.;\(\)]/, '');
		var warning = "";
		if (url != safe_url || (safe_url.search("http://") != 0 && safe_url.search("https://") != 0)) {
			warning = warning.concat("url : Please input correct full url path. Example: http://nus.edu.sg or https://www.google.com\n");
		}
		if (budget == "" || isNaN(budget) || parseInt(budget) <= 0){
			warning = warning.concat("budget : Please input positive number");
		}

		if (warning != "") {
			alert(warning);
			return false;
		}
		else return true;
	}

</script>

@stop

