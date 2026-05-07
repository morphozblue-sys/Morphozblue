<?php include("../attachment/session.php"); ?>
   <section class="content-header">
      <h1>
        <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
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

		<?php
		$qry="select * from school_info_general";
		$rest=mysqli_query($conn73,$qry);
		while($row22=mysqli_fetch_assoc($rest)){
		$fees_type=$row22['fees_type'];
		}
		if($fees_type=='installmentwise'){
			$show_var='Reset Installments';
		}elseif($fees_type=='monthly'){
			$show_var='Reset Months';
		}else{
			$show_var='';
		}
		?>
		<?php  if(!isset($_SESSION['fees_sub_panel_reset_months_or_installment'])){ ?>
		<a href="javascript:get_content('fees_monthly/reset_fee_structure')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#6E666C;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $show_var; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_structure.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/reset_fee_structure')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['fees_sub_panel_set_dues_detail'])){ ?>
		<a href="javascript:get_content('fees_monthly/set_dues_detail')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#7CA4AB;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Set Dues Detail</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_structure.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/set_dues_detail')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
	   <?php } if(!isset($_SESSION['sub_panel_fee_structure_list'])){ ?>

	  <a href="javascript:get_content('fees_monthly/fee_structure_list')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Fees Structure']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_structure.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/fee_structure_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		  <?php } if(!isset($_SESSION['sub_panel_discount_types_list'])){ ?>

		 <a href="javascript:get_content('fees_monthly/discount_types_list')">
        <div class="col-lg-3 col-md-6" style="display:none;">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
              <h3 style="font-size:20px;margin-left:7px;color:#fff;"><?php echo $language['Discount Structure']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/discount_structure.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/discount_types_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['fees_sub_panel_set_fee'])){  ?>
		
		<a href="javascript:get_content('fees_monthly/student_admission_fee_list')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#013220;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Set Fee']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_admission_fee_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['fees_sub_panel_set_fees_classwise'])){  ?>
		<a href="javascript:get_content('fees_monthly/set_classwise_fee_details')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#775CD3;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Set Fee</h3>
				<p style="margin-left:10px;color:#fff;">Classwise</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/set_classwise_fee_details')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['fees_sub_panel_set_transport_fee_classwise'])){  ?>
		<a href="javascript:get_content('fees_monthly/set_classwise_monthly_transport_fee_details')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#1D2C3D;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Set Transport Fee</h3>
				<p style="margin-left:10px;color:#fff;">Classwise Monthly</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/set_classwise_monthly_transport_fee_details')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<?php } if(!isset($_SESSION['fees_sub_panel_previous_dues'])){  ?>
		<a href="javascript:get_content('fees_monthly/add_previous_year_dues_fee')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#FFA500;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Previous Dues</h3>
				<p style="margin-left:10px;color:#fff;">Add in Current Fee</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/add_previous_year_dues_fee')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['fees_sub_panel_add_classwise_transport'])){  ?>
		<a href="javascript:get_content('fees_monthly/add_transport_fee')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#675C44;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Add Classwise</h3>
				<p style="margin-left:10px;color:#fff;">Transport Fee</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/add_transport_fee')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<?php  } if(!isset($_SESSION['sub_panel_student_fee_add_form'])){ ?>
		<a href="javascript:get_content('fees_monthly/student_fee_add_form')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Pay Fees']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/pay_fee.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_add_form')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
  <?php } if(!isset($_SESSION['sub_panel_student_fee_list'])){ ?>
		 <a href="javascript:get_content('fees_monthly/student_fee_list')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Fees Details']; ?></h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
  <?php } if(!isset($_SESSION['fees_sub_panel_fees_detail_by_rfid'])){ if(false){ ?>
  
        <a href="javascript:get_content('fees_monthly/student_fee_list_by_rfid')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#634951;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Fees Details']; ?></h3>
				<p style="margin-left:10px;color:#fff;">By RFID</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_list_by_rfid')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
  <?php }} if(!isset($_SESSION['fees_sub_panel_dues_list_sms_print'])){ ?>
		<a href="javascript:get_content('fees_monthly/student_fee_dues_list')">
        <div class="col-lg-3 col-md-6" style="display:none;">
          <div class="small-box" style="background-color:#8F9D32;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Dues List</h3>
				<p style="margin-left:10px;color:#fff;">SMS & Print</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_dues_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php } if(!isset($_SESSION['fees_sub_panel_dues_list_sms_print'])){ ?>	
		<a href="javascript:get_content('fees_monthly/student_fee_dues_list_statuswise')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#8F9D32;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Dues List</h3>
				<p style="margin-left:10px;color:#fff;">SMS & Print</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_dues_list_statuswise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<?php } if(!isset($_SESSION['fees_sub_panel_demand_bill'])){ ?>
		<a href="javascript:get_content('fees_monthly/student_fee_demand_bill_list')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#A9919D;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Demand Bill</h3>
				<p style="margin-left:10px;color:#fff;">Print</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_demand_bill_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		
		
		
		<?php } if(!isset($_SESSION['fees_sub_panel_demand_bill'])){ ?>
		<a href="javascript:get_content('fees_monthly/student_fee_demand_bill_list_new')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#A9919D;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Demand Bill New</h3>
				<p style="margin-left:10px;color:#fff;">Print</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_demand_bill_list_new')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		
		
		<?php } if(!isset($_SESSION['fees_sub_panel_report_panel '])){ ?>
		<a href="javascript:get_content('fees_monthly/student_fee_balance_details')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#184AA0;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Details</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_balance_details')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['fees_sub_panel_report_panel '])){ ?>
	
		<?php
		
		if($_SESSION['database_name']=="simptczo_alfiyaschoolkannauj"){?>
		<a href="javascript:get_content('fees_monthly/student_fee_balance_details_from_to_to_new')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#177C76;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Details</h3>
				<p style="margin-left:10px;color:#fff;">From - To</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_balance_details_from_to_to_new')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php }else{?>
		<a href="javascript:get_content('fees_monthly/student_fee_balance_details_from_to_to')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#177C76;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Details</h3>
				<p style="margin-left:10px;color:#fff;">From - To</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_balance_details_from_to_to')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
		<?php } if(!isset($_SESSION['fees_sub_panel_report_panel '])){ ?>
		<a href="javascript:get_content('fees_monthly/student_only_fee_balance_details')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#581845;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Only Balance</h3>
				<p style="margin-left:10px;color:#fff;">Report Monthly</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_only_fee_balance_details')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
        <?php } ?>
        <?php  if(!isset($_SESSION['fees_sub_panel_report_panel '])){ ?>
		<a href="javascript:get_content('fees_monthly/student_fee_balance_details_random')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#1E2E08;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Balance Details</h3>
				<p style="margin-left:10px;color:#fff;">With Prev. & Trans. Fee</p>
            </div>
            <a href="javascript:get_content('fees_monthly/student_fee_balance_details_random')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
        
		</div>
		
		<div class="box-header">
		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Transpoart Main Panel</b></h3>
		</div>
		<div class="box-body">
		    <?php if(!isset($_SESSION['fees_sub_panel_transport_reset_month'])){ ?>
		    <a href="javascript:get_content('fees_monthly/reset_transport_fee_structure')">
            <div class="col-lg-3 col-md-6">
              <div class="small-box" style="background-color:#B72506;">
                <div class="inner"><br>
                   <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $show_var; ?></h3>
    				<p style="margin-left:10px;color:#fff;">Transport Fee</p>
                </div>
                <div class="icon">
                  <i class="ion"><img src="../school_software_v1/images/fee_structure.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
                </div>
                <a href="javascript:get_content('fees_monthly/reset_transport_fee_structure')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
    		</a>
    		<?php } if(!isset($_SESSION['fees_sub_panel_transport_set_dues_detail'])){ ?>
    		<a href="javascript:get_content('fees_monthly/set_transport_dues_detail')">
            <div class="col-lg-3 col-md-6">
              <div class="small-box" style="background-color:#7CA4AB;">
                <div class="inner"><br>
                   <h3 style="font-size:20px;margin-left:5px;color:#fff;">Set Dues Detail</h3>
    				<p style="margin-left:10px;color:#fff;">Transport Dues</p>
                </div>
                <div class="icon">
                  <i class="ion"><img src="../school_software_v1/images/fee_structure.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
                </div>
                <a href="javascript:get_content('fees_monthly/set_transport_dues_detail')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
    		</a>
    		<?php } if(!isset($_SESSION['fees_sub_panel_transport_fees_structure'])){ ?>
    		<a href="javascript:get_content('fees_monthly/add_bus_fee_category_monthly_installmentwise')">
            <div class="col-lg-3 col-md-6">
              <div class="small-box" style="background-color:#E32636;">
                <div class="inner"><br>
                   <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Fees Structure']; ?></h3>
    				<p style="margin-left:10px;color:#fff;">Transport Fee</p>
                </div>
                <div class="icon">
                  <i class="ion"><img src="../school_software_v1/images/fee_structure.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
                </div>
                <a href="javascript:get_content('fees_monthly/add_bus_fee_category_monthly_installmentwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
    		</a>
    		<?php } if(!isset($_SESSION['fees_sub_panel_transport_set_fee_classwise'])){ ?>
    		<a href="javascript:get_content('fees_monthly/set_classwise_transport_fee_details')">
            <div class="col-lg-3 col-md-6">
              <div class="small-box" style="background-color:#775CD3;">
                <div class="inner"><br>
                   <h3 style="font-size:20px;margin-left:5px;color:#fff;">Set Fee Classwise</h3>
    				<p style="margin-left:10px;color:#fff;">Transport Fee</p>
                </div>
                <div class="icon">
                  <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
                </div>
                <a href="javascript:get_content('fees_monthly/set_classwise_transport_fee_details')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
    		</a>
    		<?php } if(!isset($_SESSION['fees_sub_panel_print_chalan'])){ ?>
    		<a href="javascript:get_content('fees_monthly/print_challan_list')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#433652;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Print Challan</h3>
				<p style="margin-left:10px;color:#fff;">For Challan</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/print_challan_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
    		
    		<?php } if(!isset($_SESSION['fees_sub_panel_transport_pay_fee'])){ ?>
    		<a href="javascript:get_content('fees_monthly/student_transport_fee_add_form')">
            <div class="col-lg-3 col-md-6">
              <div class="small-box" style="background-color:#9F2B68;">
                <div class="inner"><br>
                   <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Pay Fees']; ?></h3>
    				<p style="margin-left:10px;color:#fff;">Transport Fee</p>
                </div>
                <div class="icon">
                  <i class="ion"><img src="../school_software_v1/images/pay_fee.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
                </div>
                <a href="javascript:get_content('fees_monthly/student_transport_fee_add_form')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
    		</a>
    		<?php } if(!isset($_SESSION['fees_sub_panel_transport_fee_details'])){ ?>
    		<a href="javascript:get_content('fees_monthly/student_transport_fee_list')">
            <div class="col-lg-3 col-md-6">
              <div class="small-box" style="background-color:#C46210;">
                <div class="inner"><br>
                   <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo $language['Fees Details']; ?></h3>
    				<p style="margin-left:10px;color:#fff;">Transport Fee</p>
                </div>
                <div class="icon">
                  <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
                </div>
                <a href="javascript:get_content('fees_monthly/student_transport_fee_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
    		</a>
		    <?php }  ?>
		    
		    <a href="javascript:get_content('fees_monthly/transport_fees_student_list')">
            <div class="col-lg-3 col-md-6">
              <div class="small-box" style="background-color:#808080;">
                <div class="inner"><br>
                   <h3 style="font-size:20px;margin-left:5px;color:#fff;">Transport Fees Edit</h3>
    				<p style="margin-left:10px;color:#fff;">Enter</p>
                </div>
                <div class="icon">
                  <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
                </div>
                <a href="javascript:get_content('fees_monthly/transport_fees_student_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
    		</a>
		      <a href="javascript:get_content('fees_monthly/student_transport_fee_dues_list_statuswise')">
            <div class="col-lg-3 col-md-6">
              <div class="small-box" style="background-color:#8F9D32;">
                <div class="inner"><br>
                   <h3 style="font-size:20px;margin-left:5px;color:#fff;">Dues List</h3>
    				<p style="margin-left:10px;color:#fff;">Transport SMS & Print</p>
                </div>
                <div class="icon">
                  <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
                </div>
                <a href="javascript:get_content('fees_monthly/student_transport_fee_dues_list_statuswise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
    		</a>
		    
		</div>
		
      </div>
	  <div class="box">
		<div class="box-header">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;&nbsp;<b>Reports</b></h3>
		</div>
		<div class="box-body">
     <?php if(!isset($_SESSION['fees_sub_panel_report_panel '])){ ?>
		<a href="javascript:get_content('fees_monthly/reports')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#594518;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Reports Panel</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/reports')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } if(!isset($_SESSION['fees_sub_panel_transport_reports_panel '])){ ?>
		<a href="javascript:get_content('fees_monthly/reports_transport')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#bf1605;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;">Transport Reports</h3>
				<p style="margin-left:10px;color:#fff;">&nbsp;</p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/fee_details.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/reports_transport')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
			<?php } if(!isset($_SESSION['fees_sub_panel_bus_id_card '])){ ?>
		<a href="javascript:get_content('fees_monthly/student_list_bus_wise')">
        <div class="col-lg-3 col-md-6">
          <div class="small-box" style="background-color:#5A5554;">
            <div class="inner"><br>
               <h3 style="font-size:20px;margin-left:5px;color:#fff;"><?php echo "Bus Id Card"//$language['Daily Expence']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo "Buswise Report"//$language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../school_software_v1/images/bus_staff.png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="javascript:get_content('fees_monthly/student_list_bus_wise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<?php } ?>
		</div>
	  </div>
	  
    </section>