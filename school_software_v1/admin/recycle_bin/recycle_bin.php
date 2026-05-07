<?php include("../attachment/session.php")?>
 <script>
window.scrollTo(0, 0);
</script>
    <section class="content-header">
      <h1>
        Recycle Bin
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Recycle Bin</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>">
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		<?php  if(!isset($_SESSION['recycle_bin_sub_panel_student_list'])){ ?>
   <a href="javascript:get_content('recycle_bin/recycle_student_admission_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#E32636;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:2px;color:#fff;"><?php echo $language['Student Admission']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_student_admission_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
		<?php } if(!isset($_SESSION['panel_recycle_fee_list'])){ ?>
 <!--
		 <a href="recycle_fee_list.php">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:5px;color:#fff;"><?php echo $language['Fee List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"><img src="../<?php echo $school_software_path; ?>images/recycle_bin (3).png" style="width:80px;margin-bottom:20px;" alt="Simption Tech Pvt Ltd "  title="School Management System" class="image1"></i>
            </div>
            <a href="recycle_fee_list.php" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		-->
				 	 <?php } if(!isset($_SESSION['recycle_bin_sub_panel_emp_list'])){ ?>
        <a href="javascript:get_content('recycle_bin/recycle_employee_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#9F2B68;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:5px;color:#fff;"><?php echo $language['Employee List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_employee_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 	 <?php } if(!isset($_SESSION['panel_recycle_employee_salary_list'])){ ?>
 		<a href="javascript:get_content('recycle_bin/recycle_employee_salary_list')">
        <div class="col-lg-3 col-xs-6" style="display:none" >
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:5px;color:#fff;"><?php echo $language['Employee Salary']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_employee_salary_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
 		 	 <?php } if(!isset($_SESSION['panel_recycle_income_list'])){ ?>
        <a href="javascript:get_content('recycle_bin/recycle_income_list')">
        <div class="col-lg-3 col-xs-6" style="display:none">
          <div class="small-box" style="background-color:#3B3B6D;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:5px;color:#fff;"><?php echo $language['Income List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_income_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
 		 	 <?php } if(!isset($_SESSION['recycle_bin_sub_panel_expance_list'])){ ?>
        <a href="javascript:get_content('recycle_bin/recycle_expense_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:	#FF7E00;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:5px;color:#fff;"><?php echo $language['Expense List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_expense_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 	 <?php } if(!isset($_SESSION['panel_recycle_bus_staff_list'])){ ?>
 		<a href="javascript:get_content('recycle_bin/recycle_bus_staff_list')">
        <div class="col-lg-3 col-xs-6" style="display:none;">
          <div class="small-box" style="background-color:#804040;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:5px;color:#fff;"><?php echo $language['Bus Staff List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_bus_staff_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
 		 	 <?php } if(!isset($_SESSION['panel_recycle_bus_student_list'])){ ?>
        <a href="javascript:get_content('recycle_bin/recycle_bus_student_list')">
        <div class="col-lg-3 col-xs-6" style="display:none;">
          <div class="small-box" style="background-color:#34B334;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:5px;color:#fff;"><?php echo $language['Student List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_bus_student_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 	 <?php } if(!isset($_SESSION['panel_recycle_library_book_list'])){ ?>
 		<a href="javascript:get_content('recycle_bin/recycle_library_book_list')" >
        <div class="col-lg-3 col-xs-6" style="display:none;">
          <div class="small-box" style="background-color:#551B8C;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:5px;color:#fff;"><?php echo $language['Book List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_library_book_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 	 <?php } if(!isset($_SESSION['recycle_bin_sub_panel_hostal_student_list'])){ ?>
 		<a href="javascript:get_content('recycle_bin/recycle_hostel_student_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#915C83;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:2px;color:#fff;"><?php echo $language['Hostel Student List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_hostel_student_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		 	 <?php } if(!isset($_SESSION['recycle_bin_sub_panel_hostal_account_list'])){ ?>
 		<a href="javascript:get_content('recycle_bin/recycle_hostel_account_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#4B5320;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:2px;color:#fff;"><?php echo $language['Hostel Account List']; ?></h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/recycle_hostel_account_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	 <?php } if(!isset($_SESSION['recycle_bin_sub_panel_registration_list'])){ ?>
		<a href="javascript:get_content('recycle_bin/student_registration_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#b55e35;">
            <div class="inner"><br>
              <h3 style="font-size:17px;margin-left:2px;color:#fff;">Student Registration List</h3>
				<p style="margin-left:10px;color:#fff;"><?php echo $language['Enter']; ?></p>
            </div>
            <div class="icon">
              <i class="ion"></i>
            </div>
            <a href="javascript:get_content('recycle_bin/student_registration_list')" class="small-box-footer"><?php echo $language['More info']; ?><i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<?php }  ?>


		</div>
      </div>
	 
    </section>