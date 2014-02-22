@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-sm-2">
			<img src="{{$photo_path}}" alt="..." style="width:100%; height: 120px" class="img-thumbnail"/>
			@if (Auth::check() && Auth::user()->id == $user->id)
	  		{{ HTML::link("profiles/".$user->id."/edit", 'Edit my profile', array('class' => 'btn btn-info', 'style' => 'margin-top:20px')) }}
	  		{{ HTML::link("spaces/".$user->id."/edit", 'Edit my space', array('class' => 'btn btn-danger', 'style' => 'margin-top:10px')) }}
	  	@endif
		</div>
		<div class="col-sm-8">
			@if ($user->header)
				<h4>{{{ $user->header }}}</h4>
			@endif
			<ul id="myTab" class="nav nav-tabs">
			  <li class="active" ><a href="#blog" data-toggle="tab">Blog</a></li>
			  <li><a href="#profile" data-toggle="tab">Profile</a></li>
			  @if (Auth::check() && Auth::user()->id == $user->id)
			  <li><a href="#showFriend" data-toggle="tab">Show Friend</a></li>
			  <li><a href="#showVideoCallInfo" data-toggle="tab">Video Call Info </a></li>
			  <li><a href="#manageAds" data-toggle="tab">Manage Ads</a></li>
			  @endif
			</ul>
			<!-- just for testing add friends-->
			<div style="margin: 20px">	
				@if (Auth::check() && $show_add_friend==1)
				{{ Form::open(array('url'=>'addFriend/')) }}
				{{ Form::hidden('friend_id', $user->id) }}
				{{ Form::submit('Add as friend', array('class' => 'btn btn-primary')) }}
				{{ Form::close() }}
				@endif
			</div>

			<!-- Tab panes -->
			<div id="myTabContent" class="tab-content">
			  <div class="tab-pane active" id="blog">
			  	<div style="margin:20px">
			  		@if(Auth::check() && Auth::user()->id == $user->id)
				  		<div class="row">
				  			{{ HTML::link("blogposts/create", "Create new post", array('class'=>'btn btn-primary')) }}
				  		</div>
				  	@endif

			  		@foreach($blog_posts as $key => $value)
			  			<div class="row">
			  				<h3>{{ HTML::link("blogposts/".$value->id, $value->title)}}</h3>
			  				<p>{{ $value->content }}</p>
			  				<p style="font-size:small">Mood: {{ $value->mood }}</p>
			  				<small>{{ HTML::link("blogposts/".$value->id, count($value->comments)." comment(s)") }}</small>
				  			<hr/>
			  			</div>
			  		@endforeach
			  	</div>
			  </div>
			  <div class="tab-pane" id="profile">
			  	<div class="col-sm-5" style="margin:20px">
						<table class="table table-hover table-condensed">
							<tbody>
							  <tr>
									<td>Username</td>
									<td>{{ $user->username }}</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>{{ $user->email }}</td>
								</tr>
								<tr>
									<td>AIM</td>
									<td>{{ $user->aim }}</td>
								</tr>
								<tr>
									<td>MSN</td>
									<td>{{ $user->msn }}</td>
								</tr>
								<tr>
									<td>IRC</td>
									<td>{{ $user->irc }}</td>
								</tr>
								<tr>
									<td>ICQ</td>
									<td>{{ $user->icq }}</td>
								</tr>
							</tbody>
						</table> 
					</div>
			  </div> <!-- for tab-pane profile -->
				@if (Auth::check() && Auth::user()->id == $user->id)
				<?php echo $showFriend; ?>
				<?php echo $showVideoCallInfo; ?>
				<?php echo $manageAds ; ?>
				@endif		


			</div>
		</div>
		@if ($user->right_content)
			<div class="col-sm-2 panel panel-default" style="margin-top:20px">
				<div class="panel-body">
					{{{$user->right_content}}}
				</div>
			</div>
		@endif
	</div>
@stop
