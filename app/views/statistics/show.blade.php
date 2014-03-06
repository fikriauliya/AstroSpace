@extends('layouts.master')

@section('content')
<div class="row">
	<div class="container-fluid" id="stats_1">
		<h3>Statistics 1: Most commented post</h3>
		<!-- Put the statistic here -->
		<?php
		$blogposts = $user->blogposts;
		foreach($blogposts as $blogpost){
			echo "The number of comments of post '".htmlentities($blogpost->title)."', "." number of comments: ".$blogpost->comment_count;
		}?>

	</div><!-- stats_1 -->

	<div class="container-fluid" id="stats_2">
		<h3>Statistics 2: Number of incoming emails</h3>
		<!-- Put the statistic here -->
		<?php
			echo "number of user's email: ".Message::where('recipient_id', '=', $user->id)->count();
		?>
	</div><!-- stats_2 -->

	<div class="container-fluid" id="stats_3">
		<h3>Statistics 3: Visitor's country</h3>
		<!-- Put the statistic here -->
		<?php
			echo "VISITOR COUNTRY: ";
		?>

	</div><!-- stats_3 -->

	<div class="container-fluid" id="stats_4">
		<h3>Statistics 4: Number of visits</h3>
		<!-- Put the statistic here -->
		<?php
			echo "Number of visits: ";
		?>
	</div><!-- stats_4 -->


</div><!-- row -->
@stop


@section('header')
<script>
//Put your javascript here	


</script>
@stop
