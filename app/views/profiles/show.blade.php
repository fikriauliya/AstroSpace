@extends('layouts.master')
@section('content')
	<div class="row">
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
			  <li class="active" ><a href="#profile" data-toggle="tab">Profile</a></li>
			  <li><a href="#messages" data-toggle="tab">Messages</a></li>
			  <li><a href="#settings" data-toggle="tab">Settings</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			  <div class="tab-pane active" id="profile">
			  	<div class="col-sm-5" style="margin-top:20px">
						<table class="table table-hover table-condensed">
							<tbody>
							  <tr>
									<td>Username</td>
									<td>{{{ $user->username }}}</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>{{{ $user->email }}}</td>
								</tr>
								<tr>
									<td>AIM</td>
									<td>{{{ $user->aim }}}</td>
								</tr>
								<tr>
									<td>MSN</td>
									<td>{{{ $user->msn }}}</td>
								</tr>
								<tr>
									<td>IRC</td>
									<td>{{{ $user->irc }}}</td>
								</tr>
								<tr>
									<td>ICQ</td>
									<td>{{{ $user->icq }}}</td>
								</tr>
							</tbody>
						</table> 
			  		{{ HTML::link("profiles/".$user->id."/edit", 'Edit', array('class' => 'btn btn-warning')) }}
					</div>
			  </div>
			  <div class="tab-pane" id="messages">...</div>
			  <div class="tab-pane" id="settings">...</div>
			</div>

		</div>
	</div>
@stop