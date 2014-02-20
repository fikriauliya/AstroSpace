<script>
$(function(){
   
   $("#asst_videocall_exit").popover({
      trigger:"hover focus",
      title: "CLICK HERE!",
      content: "Exit from / deactivate video call room. (you need to do this before creating or approving another video call room!)",
      placement: "auto right",
   });
   
   $("#asst_videocall_start").popover({
      trigger:"hover focus",
      content: "Start the video call session!",
      placement: "auto right",
   });

   $("#asst_videocall_invite3").popover({
      trigger:"hover focus click",
      content: "Invite your friend, Friend3, to this video call room",
      placement: "auto right",
   });

   $("#asst_webRTC_approve2").click(function(){
      setTimeout( function(){$("#asst_videocall_exit").popover("show")}, 300);
   });

});

</script>


<button  class="btn btn-success" id="asst_videocall_start"> Start video chat! </button>
<div id="videoContainer">
<table class="table table-bordered" style="border-left: 1px solid black; width:100%;">
	<tbody>
		<tr>
			<td>
				<h2 style="display: block; text-align: center;"></h2>
				<div  id="local-media-stream" class="row" style="margin:20px"> </div>
					<div class="media-container col-sm-6 col-md-4" style="margin:20px">
						{{ HTML::image('images/cat_1.jpeg', 'alt-text') }}
					</div>
					<div class="media-container col-sm-6 col-md-4" style="margin:20px">
						{{ HTML::image('images/dog_1.jpeg', 'alt-text') }}	
					</div>
			</td>
		</tr>
	</tbody>
</table>
</div>

<div id="exitRoom">
	<button class="btn btn-danger" id="asst_videocall_exit">Quit room</button>
</div>

<div id="inviteFriend">
<h3>Invite Friend:</h3>
<table class="table table-striped table-bordered">
	<tbody>
		<?php 
			$friends = array("Friend1","Friend2","Friend3"); 
			$count = 1;
		?>
		@foreach($friends as $value)
		<tr>
			<td>
				<a href="#">{{{ $value }}}</a>
			</td>
			<td>
				@if($count <= 2)
				<p>Is invited</p>
				@else
				<a href="#" data-userid="{{{$count}}}" class="invite btn btn-primary" id="{{{ 'asst_videocall_invite'.$count }}}">Invite</a>
				@endif
			</td>
		</tr>
		<?php $count = $count + 1; ?>
		@endforeach
	</tbody>
</table>
</div>

