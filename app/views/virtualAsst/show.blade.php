<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
	Launch virtual assistant
</button>

<script> 
$(function(){
	$("#myModal").modal({
		show: true,
		backdrop: 'static'
	});

	$("#asst_home").popover({
		trigger:"hover focus",
		content: "Your home page",
		placement: "auto top",
	});
	
	$("#asst_memberlist").popover({
		trigger:"hover focus",
		content: "List all the members",
		placement: "auto top",
	});

	$("#asst_settings").popover({
		trigger:"hover focus",
		content: "Change your personal configuration",
		placement: "auto top",
	});

	$("#asst_editthemes").popover({
		trigger:"hover focus",
		content: "Edit your personal themes",
		placement: "bottom",
	});

	$("#webRTC_videocall").hide();
	$("#asst_finish").hide();

	$("#asst_webRTC_approve2").click(function(){
		$("#spaces_show").hide();
		$("#webRTC_videocall").show();
	});

	$("#asst_videocall_exit").click(function(){
		$("#webRTC_videocall").hide();
		$("#asst_finish").show();
		$("#spaces_show").hide();
	});	
	
	$("#asst_finish_restart").click(function(){
		setTimeout(function(){ $("#asst_space_videocallinfo").popover("show");  },300);
		$("#webRTC_videocall").hide();
		$("#asst_finish").hide();
		$("#spaces_show").show();
	});



});


</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:75%;">
		<div class="modal-content">	
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"> Modal Title </h4>
			</div> <!-- modal-header -->
			
			<div class="modal-body" >

				<div id="VirtualAsstContainer" class="container-fluid" >

	<!-- layouts.master -->
	<div class="navbar navbar-inverse navbar-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          {{ HTML::link('#', 'AstroSpaces', array('class' => 'navbar-brand')) }}
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li>{{ HTML::link('#', 'Home', array('id'=>'asst_home')) }}</li>
            <li>{{ HTML::link('#', 'Memberlist', array('id'=>'asst_memberlist')) }}</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right" style="">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" id='asst_settings' data-toggle="dropdown">Settings <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>{{ HTML::link('#', "Edit themes", array('id'=>'asst_editthemes')) }}</li>
                </ul>
              </li>
              <li>{{ HTML::link('#', 'Log out',array('id'=>'asst_logout')) }}</li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<!-- content is here -->
	<div id="content" class="container-fluid">
	
	<div id="spaces_show" class="container-fluid">	
		<?php echo View::make('virtualAsst.spaces_show'); ?>	
	</div>
	
	<div id="webRTC_videocall" class="container-fluid">
		<?php echo View::make('virtualAsst.webRTC_videoCall'); ?>
	</div>
	
	<div id="asst_finish" class="container-fluid">
		<?php echo View::make('virtualAsst.finish'); ?>
	</div>
	


   </div><!-- /.container -->


				</div> <!-- VirtualAsstContainer -->


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
