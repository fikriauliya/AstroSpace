@extends('layouts.master')
@section('content')
  <div class="row">
		<h3>Members</h2>
	  
	  <table class="table">
	  	<thead>
	  		<tr>
	  			<td>Username</td>
	  			<td>Email</td>
	  			<td>AIM</td>
	  			<td>MSN</td>
	  			<td>IRC</td>
	  			<td>ICQ</td>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		@foreach($users as $key => $value)
		  		<tr>
		  			<td>{{$value->username}}</td>
		  			<td>{{$value->email}}</td>
		  			<td>{{$value->aim}}</td>
						<td>{{$value->msn}}</td>
						<td>{{$value->irc}}</td>
						<td>{{$value->icq}}</td>
					</tr>
				@endforeach
	  	</tbody>
	  </table>
	</h3>
@stop