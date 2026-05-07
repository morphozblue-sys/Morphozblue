<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        <?php echo $language['Bus Management']; ?>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bus Management</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?> ">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<?php  if(!isset($_SESSION['sub_panel_add_bus'])){ ?>
	  <a href="javascript:get_content('bus/add_bus')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Add Bus']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
             <a href="javascript:get_content('bus/add_bus')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php } if(!isset($_SESSION['sub_panel_bus_list'])){ ?>
		<a href="javascript:get_content('bus/bus_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Bus Details']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
              <a href="javascript:get_content('bus/bus_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php } if(!isset($_SESSION['sub_panel_route_add'])){ ?>
		 <a href="javascript:get_content('bus/route_add')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Add Routes']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <a href="javascript:get_content('bus/route_add')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php } if(!isset($_SESSION['sub_panel_bus_route_add'])){ ?>
		<a href="javascript:get_content('bus/bus_route_add')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Add Stop']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
             <a href="javascript:get_content('bus/bus_route_add')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php } if(!isset($_SESSION['sub_panel_bus_route_list'])){ ?>
		<a href="javascript:get_content('bus/bus_route_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#3B3B6D;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Route List']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
              <a href="javascript:get_content('bus/bus_route_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php } if(!isset($_SESSION['sub_panel_asigned_bus_route'])){ ?>
		<a href="javascript:get_content('bus/asigned_bus_route')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#FF7E00;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Assigned Routes']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <a href="javascript:get_content('bus/asigned_bus_route')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php } if(!isset($_SESSION['bus_sub_panel_student_list'])){ ?>
		<a href="javascript:get_content('bus/bus_student_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#804040;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Student List']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
              <a href="javascript:get_content('bus/bus_student_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
    <?php } if(!isset($_SESSION['sub_panel_bus_employee_add'])){ ?>
	    <a href="javascript:get_content('bus/bus_staff')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#34B334;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Bus Staff']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
              <a href="javascript:get_content('bus/bus_staff')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
    <?php } if(!isset($_SESSION['sub_panel_bus_purchase_list'])){ ?>
	    <a href="javascript:get_content('bus/purchase_list')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:	#551B8C;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Daily Expence']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
             <a href="javascript:get_content('bus/purchase_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
    
    <?php } if(!isset($_SESSION['bus_sub_panel_add_bus_expance'])) { ?>

       <a href="javascript:get_content('bus/add_bus_expance')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#551B8C;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo "Add Bus Expense"//$language['Daily Expence']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <a href="javascript:get_content('bus/add_bus_expance')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
     <?php } ?> 
          
		</div>
      </div>
	  <div class="box <?php echo $box_head_color; ?> ">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;<b>Reports</b></h3>
		</div>
		<div class="box-body">

	<?php if(!isset($SESSION['bus_sub_panel_bus_expance_report']))  { ?> 	
		<a href="javascript:get_content('bus/bus_expense_report')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#5A5554;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo "Bus Expense"//$language['Daily Expence']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo "Report"//$language['Enter']; ?></p>
            </div>
              <a href="javascript:get_content('bus/bus_expense_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php }  if(!isset($_SESSION['bus_sub_panel_student_list_bus_wise_rprt']))  { ?>		
		<a href="javascript:get_content('bus/student_list_bus_wise')">
        <div class="col-md-3 col-md-6">
          <div class="small-box" style="background-color:#5A5554;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo "student_list"//$language['Daily Expence']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo "Bus wise Report"//$language['Enter']; ?></p>
            </div>
              <a href="javascript:get_content('bus/student_list_bus_wise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
		
		
		
		</div>
	  </div>
	 
    </section>