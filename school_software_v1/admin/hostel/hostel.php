<?php include("../attachment/session.php")?>
 <script>
window.scrollTo(0, 0);
</script>
<section class="content-header">
      <h1>
                <?php echo $language['Hostel Management']; ?>
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="Active">Hostel</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<?php if(!isset($_SESSION['sub_panel_hostel_list'])){ ?>
   <a href="javascript:get_content('hostel/hostel_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Hostel Details']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/hostel_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 		 	 	 <?php } if(!isset($_SESSION['sub_panel_room_list'])){ ?>
 		<a href="javascript:get_content('hostel/room_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Room Details']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/room_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 		 	 	 <?php } if(!isset($_SESSION['sub_panel_hostel_seat_avail'])){ ?>
 		 <a href="javascript:get_content('hostel/hostel_seat_avail')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Seat Availablity']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/hostel_seat_avail')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
	
	 		 	 	 <?php } if(!isset($_SESSION['sub_panel_hostel_employee_add'])){ ?>
 		<a href="javascript:get_content('hostel/staff')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#FF7E00;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Hostel Staff']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/staff')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 		 	 	 <?php } if(!isset($_SESSION['sub_panel_hostel_student_list'])){ ?>
 		<a href="javascript:get_content('hostel/hostel_student_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:1px;color:#fff;"><?php echo $language['Hostel Student List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/hostel_student_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
 	 		 	 	 <?php } if(!isset($_SESSION['sub_panel_hostel_mess_menu_list'])){ ?>
       <a href="javascript:get_content('hostel/hostel_mess')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#3B3B6D;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Mess']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/hostel_mess')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 		 	 	 <?php } if(!isset($_SESSION['sub_panel_leave_student'])){ ?>
 		<a href="javascript:get_content('hostel/leave_student')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#804040;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Old Hostellers']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/leave_student')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
 	 		 	 	 <?php } if(!isset($_SESSION['sub_panel_hostel_daily_entry'])){ ?>
        <a href="javascript:get_content('hostel/hostel_daily_entry')">
        <div class="col-lg-3 col-xs-6" style="display:none;">
          <div class="small-box" style="background-color:#34B334;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Daily Entry']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/hostel_daily_entry')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
	 		 	 	 <?php } if(!isset($_SESSION['panel_stock'])){ ?>
 		<a href="javascript:get_content('hostel/stock')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#915C83;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Stock']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/stock')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 		 	 	 <?php } if(!isset($_SESSION['panel_hostel_account'])){ ?>
 		<a href="javascript:get_content('hostel/hostel_account')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#551B8C;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Account']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('hostel/hostel_account')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 		 	 	 <?php }  ?>


		</div>
      </div>
    </section>