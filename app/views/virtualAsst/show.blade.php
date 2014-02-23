<div class="container-fluid">
<h3> THIS IS YOUR FIRST LOGIN</h3>
<h4> WELCOME TO ASTROSPACE! </h4>

<button id="asst_launch" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
	Launch tutorial for video call
</button>

</div>


<script> 
$(function(){
	$("#myModal").modal({
		show: 	 false,
		backdrop: "static"
	});

	$("#asst_launch").popover({
		trigger:"hover focus click",
		content: "Click here to launch video call tutorial",
		placement: "right",
	});

	setTimeout(function(){ $("#asst_launch").popover("show"); }, 100);

	$("#asst_home").popover({
		trigger:"hover focus",
		content: "Your home page",
		placement: "auto",
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

	$("#asst_message").popover({
		trigger:"hover focus",
		content: "To send or see message from / to other user",
		placement: "auto top",
	});

	$("#asst_notification").popover({
		trigger:"hover focus",
		content: "You will get notification if others tag you in their blog",
		placement: "auto top",
	});

	$("#asst_usersearch").popover({
		trigger:"hover focus",
		content: "To search other user base on username",
		placement: "auto top",
	});
	
	$("#asst_editthemes").popover({
		trigger:"hover focus",
		content: "Edit your personal themes",
		placement: "bottom",
	});

	$("#asst_changepassword").popover({
		trigger:"hover focus",
		content: "Change your password",
		placement: "auto top",
	});
	
	$("#asst_webstatistic").popover({
		trigger:"hover focus",
		content: "See various statistic about your space",
		placement: "auto",
	});



	$("#webRTC_videocall").hide();
	$("#asst_finish").hide();

	$("#asst_webRTC_approve2").click(function(){
		$("#spaces_show").hide();
		$("#webRTC_videocall").show();
	});

	$("#asst_videocall_exit").click(function(){
		//Go to finish page
		$("#asst_progress").css("width","100%");
		$("#asst_modaltitle").html("Finished!");
		$("#asst_stepdescription").html("");

		$("#webRTC_videocall").hide();
		$("#asst_finish").show();
		$("#spaces_show").hide();
	});	
	
	$("#asst_finish_restart,#asst_launch").each(function(){
		$(this).click(function(){

			setTimeout(function(){ $("#asst_space_videocallinfo").popover("show");  },300);
			//Back to the first step
			$("#asst_progress").css("width","0%");
			$("#asst_modaltitle").html("Step 1:");
			$("#asst_stepdescription").html("See information on video call on video call info tab");
			$("#webRTC_videocall").hide();
			$("#asst_finish").hide();
			$("#spaces_show").show();
			$("#asst_space_blog").tab("show");
		});
	});



});


</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:75%;">
		<div class="modal-content">	
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="asst_modaltitle"> Step 1: </h4>
				<p id="asst_stepdescription">See information on video call on video call info tab</p>
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
          	<li>{{ HTML::link('#', 'Messages', array('id' => 'asst_message')) }}</li>
            <li>{{ HTML::link('#', 'Notifications', array('id' => 'asst_notification')) }}
				<li>{{ HTML::link('#', 'Memberlist', array('id'=>'asst_memberlist')) }}</li>
				<li>{{ HTML::link('#', 'User search', array('id' => 'asst_usersearch')) }}</li>
			 
			 </ul>

          <ul class="nav navbar-nav navbar-right" style="">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" id='asst_settings' data-toggle="dropdown">Settings <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>{{ HTML::link('#', "Edit themes", array('id'=>'asst_editthemes')) }}</li>
						<li>{{ HTML::link('#', 'Show web statistic', array('id' => 'asst_webstatistic')) }} </li>
						<li>{{ HTML::link('#', 'Change password', array('id' => 'asst_changepassword')) }}</li>

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
				<div class="container-fluid">
					<div class="progress progress-striped active">
						<div id="asst_progress" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
						</div>
					</div>
				</div>
				<div class="container-fluid">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div> <!-- modal-footer -->

		</div> <!-- modal-content-->
	</div> <!-- modal-dialog-->
</div> <!-- modal fade -->


