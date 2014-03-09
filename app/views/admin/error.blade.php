@extends('layouts.master')

@section('content')
@if(isset($warning))
<div id="Warning">
	<h4> {{{$warning}}}</h4>
</div>
@endif

@stop
