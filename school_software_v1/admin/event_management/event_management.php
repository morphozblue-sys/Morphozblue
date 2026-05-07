<?php include("../attachment/session.php")?>
<script>
window.scrollTo(0, 0);
</script>
     <section class="content-header">
      <h1>
        Event Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
		   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	   <li class="active"><i class="fa fa-calendar-check-o"></i>  Event Management</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">
        <?php if(!isset($_SESSION['event_sub_panel_add_house'])) { ?>
		<a href="javascript:get_content('event_management/add_house')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#FE6A0F;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;">Add House</h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
              <a href="javascript:get_content('event_management/add_house')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a> 
		<?php }if(!isset($_SESSION['event_sub_panel_assigned_house'])) { ?>
		<a href="javascript:get_content('event_management/student_assingned_house')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#768085;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;">Assigned House</h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
             <a href="javascript:get_content('event_management/student_assingned_house')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a> 
		 <?php } 	if(!isset($_SESSION['sub_panel_add_event'])) { ?>
		<a href="javascript:get_content('event_management/add_event')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;"><?php echo $language['Add Event']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
              <a href="javascript:get_content('event_management/add_event')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
	
		<?php if(!isset($_SESSION['sub_panel_event_add_participate'])) { ?>
		<a href="javascript:get_content('event_management/add_participate')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;"><?php echo $language['Add Participate']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
             <a href="javascript:get_content('event_management/add_participate')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['sub_panel_event_participate_list'])) { ?>
		<a href="javascript:get_content('event_management/participate_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;"><?php echo $language['Participation List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
             <a href="javascript:get_content('event_management/participate_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['event_sub_panel_activity_plan'])) { ?>
      <a href="javascript:get_content('event_management/activity_plane')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#5EF3D3;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;">Activity Plan</h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
             <a href="javascript:get_content('event_management/activity_plane')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['event_sub_panel_activity_plan_list'])) { ?>
		<a href="javascript:get_content('event_management/activity_plane_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#92AF04;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;">Activity Plan List</h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <a href="javascript:get_content('event_management/activity_plane_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['event_sub_panel_event_result'])) { ?>
		<a href="javascript:get_content('event_management/event_result')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#5EDAF3;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;">Event Result</h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <a href="javascript:get_content('event_management/event_result')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['event_sub_panel_event_result_list'])) { ?>
		<a href="javascript:get_content('event_management/event_result_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C8AC2A;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;">Event Result List</h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <a href="javascript:get_content('event_management/event_result_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['event_sub_panel_team_creation'])) { ?>
		<a href="javascript:get_content('event_management/team_creation')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#20B5F7;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;">Team Creation</h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
              <a href="javascript:get_content('event_management/team_creation')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['event_sub_panel_team_creation_list'])) { ?>
		<a href="javascript:get_content('event_management/team_creation_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#BC85F7;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;">Team Creation List</h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
              <a href="javascript:get_content('event_management/team_creation_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
        <?php } ?>

		</div>
      </div>
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;<b>Reports</b></h3>
		</div>
		<div class="box-body">

		<?php  if(!isset($_SESSION['event_sub_panel_participant_list'])) { ?>
		<a href="javascript:get_content('event_management/participate_list_report')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
              <h3 style="font-size:18px;margin-left:10px;color:#fff;"><?php echo $language['Participation List']; ?></h3>
				<p style="margin-left:10px;color:#fff;">Report</p>
            </div>
            <a href="javascript:get_content('event_management/participate_list_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<?php } ?>
		</div>
	  </div>
	 
    </section>

