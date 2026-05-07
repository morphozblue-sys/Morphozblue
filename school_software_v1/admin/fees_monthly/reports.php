<?php include("../attachment/session.php"); ?>
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        <?php echo $language['Fees Management']; ?>
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
       <?php if($_SESSION['software_link']=="pragyaschoolsasaram"){?>
       <a href="javascript:get_content('fees_monthly/student_fee_daily_collection_report_new')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#402B27;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Daily Collection</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_daily_collection_report_new')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
       <?php }else{ ?>
		<a href="javascript:get_content('fees_monthly/student_fee_daily_collection_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#402B27;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Daily Collection</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_daily_collection_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
		<a href="javascript:get_content('fees_monthly/student_fee_daily_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#15687B;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Daily Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_daily_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
				<a href="javascript:get_content('fees_monthly/student_fee_daily_report_new')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#808080;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Daily Report (NEW)</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_daily_repor_newt')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_fee_monthly_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#7348A4;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Monthly Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_monthly_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_fee_schemewise_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#1EABA6;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Schemewise</h3>
				<p style="margin-left:10px;color:#fff;">Report</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_schemewise_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_fee_classwise_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#A49D05;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Classwise Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_classwise_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_daily_report_headwise')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#BF0766;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Daily Report</h3>
				<p style="margin-left:10px;color:#fff;">Headwise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_daily_report_headwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_balance_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#606E1B;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_balance_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_headwise_balance_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#34023E;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Report</h3>
				<p style="margin-left:10px;color:#fff;">Headwise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_headwise_balance_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_discount_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#C17015;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Discount Report</h3>
				<p style="margin-left:10px;color:#fff;">Monthly</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_discount_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_discount_report_headwise')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#1E5A31;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Discount Report</h3>
				<p style="margin-left:10px;color:#fff;">Headwise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_discount_report_headwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_discount_report_structure')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#B20606;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Discount Report</h3>
				<p style="margin-left:10px;color:#fff;">Structurewise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_discount_report_structure')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_bus_fee_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#374746;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Bus Fee</h3>
				<p style="margin-left:10px;color:#fff;">Report</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_bus_fee_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_fee_structure_download')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#53C88C;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Fee Structure</h3>
				<p style="margin-left:10px;color:#fff;">Download</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_structure_download')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_transport_structure_download')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#73253C;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Transport</h3>
				<p style="margin-left:10px;color:#fff;">Structure</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_transport_structure_download')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_rangewise_balance_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#626567;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Report</h3>
				<p style="margin-left:10px;color:#fff;">Rangewise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_rangewise_balance_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_familywise_balance_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#1C0D39;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Report</h3>
				<p style="margin-left:10px;color:#fff;">Familywise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_familywise_balance_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_overall_report_studentwise')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#86591B;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Overall Report</h3>
				<p style="margin-left:10px;color:#fff;">Studentwise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_overall_report_studentwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_overall_report_classwise')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#7F7C61;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Overall Report</h3>
				<p style="margin-left:10px;color:#fff;">Classwise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_overall_report_classwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/demand_notes')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#353104;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Demand Notes</h3>
				<p style="margin-left:10px;color:#fff;">Classwise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/demand_notes')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
	
     
     <a href="javascript:get_content('fees_monthly/student_fee_daily_paytime_discount_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#402B27;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Daily Paytime</h3>
			<p style="margin-left:10px;color:#fff;">Discount Report</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_daily_paytime_discount_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
     <a href="javascript:get_content('fees_monthly/student_daily_collection_report_dcr')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#800519;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">DCR Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_daily_collection_report_dcr')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
     
     <a href="javascript:get_content('fees_monthly/student_deleted_fee_reciept_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#800519;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Deleted Fee Receipt</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_deleted_fee_reciept_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<a href="javascript:get_content('fees_monthly/student_familywise_balance_report')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#1C0D39;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Report</h3>
				<p style="margin-left:10px;color:#fff;">Familywise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_familywise_balance_report')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
     
        	<?php if($update_change=='rahul@simption.com'){ ?>
		<a href="javascript:get_content('fees_monthly/student_fee_classwise_report_new1')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#A49D05;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Classwise Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_classwise_report_new1')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
			<a href="javascript:get_content('fees_monthly/student_all_fees_classwise_report_new')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#A49D05;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Classwise Report</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_all_fees_classwise_report_new')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
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