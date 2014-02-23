@extends('layouts.master')
@section('content')
  <div class="row">
		{{ HTML::link("messages/create", "Compose message", array('class'=>'btn btn-primary pull-right')) }}	  

		<h4>Inbox</h4>
	  <table class="table table-condensed table-striped table-hover">
	  	<thead>
	  		<tr>
	  			<td>From</td>
	  			<td>Content</td>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		@foreach($received_messages as $message)
		  		<tr>
		  			<td>{{{$message->sender->username}}}</td>
		  			<td>{{{$message->content}}}</td>
					</tr>
				@endforeach
	  	</tbody>
	  </table>

	  <h4>Sent items</h4>
	  <table class="table table-condensed table-striped table-hover">
	  	<thead>
	  		<tr>
	  			<td>To</td>
	  			<td>Content</td>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		@foreach($sent_messages as $message)
		  		<tr>
		  			<td>{{{$message->sender->username}}}</td>
		  			<td>{{{$message->content}}}</td>
					</tr>
				@endforeach
	  	</tbody>
	  </table>
	</div>
@stop
