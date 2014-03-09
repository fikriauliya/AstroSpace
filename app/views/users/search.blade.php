@extends('layouts.master')
@section('content')
	<div class ="row">
		<h3>User Search</h3>
			
			{{Form::open(array('url'=>'users/search','class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET'))}}
			<div class = "form-group">
				<label class = "col-sm-2 control-label" for="search">Search for user</label>
				<div class ="col-sm-10">
					{{ Form::text('search', null, array('class'=>'form-control', 'placeholder'=>'search'))}}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Search', array('class'=>'btn btn-primary'))}}
				</div>
			</div>
			{{ Form::close() }}
	</div>
	<div>
	<h3> Search Result</h3>
		<div id=searchresult>
		@if(isset($user_result) && $user_result != "")
			@foreach($user_result as $value) 
				{{ HTML::link('spaces/'.$value->id, $value->username) }}
				<br/>
			@endforeach
		@endif		
		</div>
	</div>
@stop


@section('header')
<script>
function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		     var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			          results = regex.exec(location.search);
						     return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function strip_tags(e,t){t=(((t||"")+"").toLowerCase().match(/<[a-z][a-z0-9]*>/g)||[]).join("");var n=/<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,r=/<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;return e.replace(r,"").replace(n,function(e,n){return t.indexOf("<"+n.toLowerCase()+">")>-1?e:""})}

$(function(){
	var searchresult = $("div#searchresult");
	@if ($error == 0)
		searchresult.html("
			@if(isset($user_result) && $user_result != "")
				@foreach($user_result as $value) 
					{{ HTML::link('spaces/'.$value->id, $value->username) }}
					<br/>
				@endforeach
			@endif		
			");
	@else
		var a = getParameterByName("search");
		a = strip_tags(a, "<br>"); 
		var s = "Cannot find " + a + "!";
		searchresult.html(s);
	@endif


});
</script>
@stop
