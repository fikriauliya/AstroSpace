@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-sm-2">
			<img src="..." alt="..." style="width:100%; height: 200px" class="img-thumbnail"/>
		</div>
		<div class="col-sm-10">
			<ul id="myTab" class="nav nav-tabs">
			  <li class="active" ><a href="#blog" data-toggle="tab">Blog</a></li>
			  <li><a href="#profile" data-toggle="tab">Profile</a></li>
			  @if (Auth::check() && Auth::user()->id == $user->id)
			  <li><a href="#showFriend" data-toggle="tab">ShowFriend</a></li>
			  @endif
			</ul>
			<!-- just for testing add friends-->
			<div style="margin: 20px">	
				@if (Auth::check() && $show_add_friend==1)
				{{ Form::open(array('url'=>'addFriend/')) }}
				{{ Form::hidden('friend_id', $user->id) }}
				{{ Form::submit('Add as friend') }}
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
			  				<h3>{{ $value->title }}</h3>
			  				<p>{{ $value->content }}</p>
			  				<small>{{ $value->mood }}</small>
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
						@if (Auth::check() && Auth::user()->id == $user->id)
				  		{{ HTML::link("profiles/".$user->id."/edit", 'Edit', array('class' => 'btn btn-warning')) }}
				  	@endif
					</div>
			  </div> <!-- for tab-pane profile -->
				@if (Auth::check() && Auth::user()->id == $user->id)
				<?php echo $showFriend; ?>
				@endif		

			</div>
		</div>
	</div>
@stop
