@extends('layouts.master')
@section('content')

  <h4>New notifications</h4>
  <hr/>
  @if (count($notifications) == 0)
    <div class="row">
      <div class="col-sm-12">
        No new notifications
      </div>
    </div>
  @else
    @foreach($notifications as $notification)
      <div class="row" style="margin-top:10px">
        <div class="col-sm-6">
          {{HTML::link($notification->url, $notification->content)}}
          <div style="font-size:9px">{{date("D, d M H:i:s", strtotime($notification->created_at))}}</div>
        </div>
      </div>
    @endforeach
  @endif
@stop
