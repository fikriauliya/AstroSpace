@extends('layouts.master')

@section('content')
<div class="row">
	<div class="container-fluid" id="stats_1">
		<h3>Statistics1: Most commented post</h3>
		<!-- Put the statistic here -->
		$blogpost = $user->blogposts;
		foreach($blogposts as $blogpost){
			echo $blogspot->title,"",$blogspot->comment_count;
		}

	</div><!-- stats_1 -->

	<div class="container-fluid" id="stats_2">
		<h3>Statistics2: Number of incoming emails</h3>
		<!-- Put the statistic here -->

	</div><!-- stats_2 -->

	<div class="container-fluid" id="stats_3">
		<h3>Statistics3: Visitor's country</h3>
		<!-- Put the statistic here -->

	</div><!-- stats_3 -->

	<div class="container-fluid" id="stats_4">
		<h3>Statistics4: Number of visits</h3>
		<!-- Put the statistic here -->

	</div><!-- stats_4 -->


</div><!-- row -->
@stop


@section('header')
<script>
//Put your javascript here	


</script>
@stop
