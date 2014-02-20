<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
	Launch virtual assistant
</button>

<script> 
$(function(){
	$("#myModal").modal({
		show: true,
		backdrop: 'static'
	});
});
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">	
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"> Modal Title </h4>
			</div> <!-- modal-header -->
			
			<div class="modal-body">
				<p> JUST WANT TO TEST MODAL! &hellip; </p>
			</div> <!-- modal-body -->
	
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary"> Save changes </button>
			</div> <!-- modal-footer -->

		</div> <!-- modal-content-->
	</div> <!-- modal-dialog-->
</div> <!-- modal fade -->


<div>
	<h3> Hello world! </h3>
	<h4> This is your first login ! </h4>
</div>
