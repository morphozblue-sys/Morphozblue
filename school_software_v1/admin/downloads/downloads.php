<?php include("../attachment/session.php")?>
 <script>
window.scrollTo(0, 0);
</script>
<section class="content-header">
	<h1>
		<b>Download  Management</b>
		<small>Control Panel</small>
	</h1>
	<ol class="breadcrumb">
		 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		 <li class="active">Download</li>
	</ol>
</section>
    <!-- Main content -->
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-header with-border">

		<h3 class="box-title" style="color:teal;"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp;<b>Main Panel</b></h3>
		</div>
		<div class="box-body">

		
		<?php  if(!isset($_SESSION['sub_panel_student_admission_list_download_class_wise'])){ ?>
					<a href="javascript:get_content('downloads/select_student')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#E32636;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Student Info</h3>
								<p style="margin-left:10px;color:#fff;">&nbsp;</p>
							</div>
							<a href="javascript:get_content('downloads/select_student')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					</a>
					
					<a href="javascript:get_content('downloads/select_student_groupwise')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#E32636;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Student Info</h3>
								<p style="margin-left:10px;color:#fff;">Groupwise</p>
							</div>
							<a href="javascript:get_content('downloads/select_student_groupwise')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					</a>
					<?php  } if(!isset($_SESSION['sub_panel_employee_list_download_category_wise'])){ ?>
					<a href="javascript:get_content('downloads/employee_download')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#417df4;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Employee List</h3>
								<p style="margin-left:10px;color:#fff;">&nbsp;</p>
							</div>
							<a href="javascript:get_content('downloads/employee_download')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					</a>
					<?php  } if(!isset($_SESSION['sub_panel_staff_salary_list_download_month_wise'])){ ?>
					<a href="javascript:get_content('downloads/employee_salary')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#e541f4;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Employee Salary </h3>
								<p style="margin-left:10px;color:#fff;">&nbsp;</p>
							</div>
							<a href="javascript:get_content('downloads/employee_salary')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					</a>
					<?php }  if(!isset($_SESSION['sub_panel_enquiry_download_date_wise'])){ ?>
					<a href="javascript:get_content('downloads/enquiry_download_info')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#e20425;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Enquiry List</h3>
								<p style="margin-left:10px;color:#fff;">&nbsp;</p>
							</div>
							<a href="javascript:get_content('downloads/enquiry_download_info')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					</a>
					<?php }  if(!isset($_SESSION['sub_panel_student_fee_list_download_month_wise'])){ ?>
					<a href="javascript:get_content('downloads/student_fees_download_list')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#f22804;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Student Fees List</h3>
								<p style="margin-left:10px;color:#fff;">&nbsp;</p>
							</div>
							<a href="javascript:get_content('downloads/student_fees_download_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
							
						</div>
					</div>
					</a>
					<?php } if(!isset($_SESSION['sub_panel_expense_list_download_month_wise'])){ ?>
					<a href="javascript:get_content('downloads/account_expense_info')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#034cf1;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Account Expense</h3>
								<p style="margin-left:10px;color:#fff;">Info</p>
							</div>
							<a href="javascript:get_content('downloads/account_expense_info')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
							
						</div>
					</div>
					</a>
					<?php }  if(!isset($_SESSION['sub_panel_income_list_download_month_wise'])) { ?>
					<a href="javascript:get_content('downloads/account_info_download')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#75a4ef;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Account Income</h3>
								<p style="margin-left:10px;color:#fff;">Info</p>
							</div>
							<a href="javascript:get_content('downloads/account_info_download')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
							
						</div>
					</div>
					</a>
						<?php }  if(!isset($_SESSION['download_sub_panel_attendance_list'])) { ?>
					<a href="javascript:get_content('downloads/Attendance_download_list')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#206b6f;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">Attendance List</h3>
								<p style="margin-left:10px;color:#fff;">&nbsp;</p>
							</div>
							<a href="javascript:get_content('downloads/Attendance_download_list')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					</a>
					<?php }  if(!isset($_SESSION['download_sub_panel_userid_password'])) { ?>
						<a href="javascript:get_content('downloads/userid_password')">
					<div class="col-md-3 col-md-6">
						<div class="small-box" style="background-color:#F56F9A;">
							<div class="inner"><br>
								 <h3 style="font-size:20px;margin-left:5px;color:#fff;">User Id &</h3>
								<p style="margin-left:10px;color:#fff;">Password</p>
							</div>
							<a href="javascript:get_content('downloads/userid_password')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					</a>
					<?php } ?>
	 <?php if($_SESSION['board_change']=='MP Board' || $_SESSION['board_change']=='State Board' || $_SESSION['board_change']=='Both') { ?>
        <?php if(!isset($_SESSION['download_sub_panel_tc_list'])) { ?>
        <a href="javascript:get_content('downloads/student_tc')">
            <div class="col-md-3 col-md-6">
                <div class="small-box" style="background-color:#f73573;">
                    <div class="inner"><br>
                        <h3 style="font-size:20px;margin-left:5px;color:#fff;">Student TC</h3>
                            <p style="margin-left:10px;color:#fff;">(MP Board)</p>
                                </div>
                                
                    <a href="javascript:get_content('downloads/student_tc')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </a>
        
    <?php } } if($_SESSION['board_change']=='CBSE Board'  || $_SESSION['board_change']=='Both') { ?>
        <?php if(!isset($_SESSION['download_sub_panel_tc_list'])) { ?>
        <a href="javascript:get_content('downloads/student_tc_cbse')">
            <div class="col-md-3 col-md-6">
                <div class="small-box" style="background-color:#A6D9E4;">
                    <div class="inner"><br>
                        <h3 style="font-size:20px;margin-left:5px;color:#fff;">Student TC</h3>
                            <p style="margin-left:10px;color:#fff;">(CBSE Board)</p>
                                </div>
                                
                    <a href="javascript:get_content('downloads/student_tc_cbse')" class="small-box-footer"><?php echo $language['More info']; ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </a>
        <?php } } ?>
        
		</div>
      </div>
	
    </section>