<?php include("../attachment/session.php")?>

     <section class="content-header">
      <h1>
       <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
    <ol class="breadcrumb">
	     <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li class="Active"><?php echo $language['Hostel Mess']; ?></li>
	</ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<a href="javascript:get_content('hostel/hostel_mess_menu_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#AF002A;">
            <div class="inner"><br>
              <h3 style="font-size:25px;margin-left:10px;color:#fff;"><?php echo $language['Mess Menu']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"><img src="<?php echo $school_software_path; ?>images/hostel_mess.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('hostel/hostel_mess_menu_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
         <a href="javascript:get_content('hostel/daily_mess_purchase_detail')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:	#C46210;">
            <div class="inner"><br>
              <h3 style="font-size:25px;margin-left:10px;color:#fff;"><?php echo $language['Daily Purchase']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"><img src="<?php echo $school_software_path; ?>images/new_admission.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('hostel/daily_mess_purchase_detail')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>


		</div>
      </div>
    </section>

