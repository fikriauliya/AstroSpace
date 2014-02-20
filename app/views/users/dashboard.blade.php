@extends('layouts.master')
@section('content')
	@if($hasLogin == 0)
	<?php echo View::make('virtualAsst.show') ?>
	@endif
  <div class="row">
		<h3>User dashboard</h3>
@stop
