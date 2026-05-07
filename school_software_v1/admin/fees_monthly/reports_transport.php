<?php include("../attachment/session.php"); ?>
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        <?php echo $language['Transport Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active"><?php echo $language['Fees']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box">
		<div class="box-header">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<a href="javascript:get_content('fees_monthly/student_transport_daily_collection_report')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#402B27;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Daily Collection</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_transport_daily_collection_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_transport_fee_daily_report')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#15687B;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Daily Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_transport_fee_daily_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_transport_fee_monthly_report')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#7348A4;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Monthly Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_transport_fee_monthly_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		
		<a href="javascript:get_content('fees_monthly/student_transport_fee_classwise_report')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#A49D05;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Classwise Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_transport_fee_classwise_report)" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		
		<a href="javascript:get_content('fees_monthly/student_transport_balance_report')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#606E1B;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_transport_balance_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		</div>
      </div>
	  <div class="box" style="display:none;">
		<div class="box-header">
		<h3 class="box-title" style="color:teal;"><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;<b>Reports</b></h3>
		</div>
		<div class="box-body">
		</div>
	  </div>
	  <div class="box" style="display:none;">
		<div class="box-header">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;<b>User Help</b></h3>
		</div>
		<div class="box-body">

		
		
		</div>
	  </div>
    </section>