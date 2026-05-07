<?php include("../attachment/session.php"); ?>
  <section class="content-header">
      <h1>
      Attendance Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  Home</a></li>
	  <li class="active"> Attendance</li>
      </ol>
    </section>
    <section class="content">
	  <div class="box <?php echo $box_head_color; ?> ">
		<div class="box-header with-border">
		<h3 class="box-title" style="color:teal;"><b>Main Panel</b></h3>
		</div>
		<div class="box-body">
	    <a href="javascript:get_content('attendance_management/student_attendance_fill')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#800080;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Student Attendance Fill</h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
            <a href="javascript:get_content('attendance_management/student_attendance_fill')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
	    <a href="javascript:get_content('attendance_management/student_attendance_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#808000;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Student Attendance List</h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
            <a href="javascript:get_content('attendance_management/student_attendance_list')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	
	 <a href="javascript:get_content('attendance_management/emp_attendance_fill')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#008080;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Staff Attendance Fill</h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
            <a href="javascript:get_content('attendance_management/emp_attendance_fill')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		
	    <a href="javascript:get_content('attendance_management/emp_attendance_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#808080;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Staff Attendance List</h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
            <a href="javascript:get_content('attendance_management/emp_attendance_list')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	
	

			<!--
	<a href="javascript:get_content('attendance_management/student_rfid_machine_attendance_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#800000;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Student Rfid Machine</h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
            <a href="javascript:get_content('attendance_management/student_rfid_machine_attendance_list')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	<a href="javascript:get_content('attendance_management/emp_rfid_machine_attendance_list')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#C46210;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Staff Rfid Machine</h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
            <a href="javascript:get_content('attendance_management/emp_rfid_machine_attendance_list')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	
	<a href="javascript:get_content('attendance_management/attendance_graphical_report')">
        <div class="col-lg-3 col-xs-6" style="display:none">
          <div class="small-box" style="background-color:#3B7A57;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Attendance Graphs</h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
            <a href="javascript:get_content('attendance_management/attendance_graphical_report')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
        
       
		
		-->
      </div>
      </div>	 
      <div class="box <?php echo $box_head_color; ?> ">
		<div class="box-header with-border">
		<h3 class="box-title" style="color:teal;"><b>Student Attendance Report</b></h3>
		</div>
		<div class="box-body">
		<a href="javascript:get_content('attendance_management/report_student_attendance_classwise_daily')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#524644;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Student Report <small style="color:#fff;">Daily Classwise</small></h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
            <a href="javascript:get_content('attendance_management/report_student_attendance_classwise_daily')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	
	     <a href="javascript:get_content('attendance_management/report_student_attendance_studentwise')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#A2720D;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Attendance Report <small style="color:#fff;">Studentwise</small></h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
            <a href="javascript:get_content('attendance_management/report_student_attendance_studentwise')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<a href="javascript:get_content('attendance_management/report_student_attendance_annually')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#800080;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Student Attendance Yearly <small style="color:#fff;"></small></h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
           <a href="javascript:get_content('attendance_management/report_student_attendance_annually')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	
		<a href="javascript:get_content('attendance_management/report_student_attendance_monthly')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#254E85;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Student Attendance Monthly <small style="color:#fff;">Daywise</small></h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
           <a href="javascript:get_content('attendance_management/report_student_attendance_monthly')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	
		
		</div>
	  </div>
	  </div>
  <div class="box <?php echo $box_head_color; ?> ">
		<div class="box-header with-border">
		<h3 class="box-title" style="color:teal;"><b>Employee Attendance Report</b></h3>
		</div>
		<div class="box-body">
	
		
		<a href="javascript:get_content('attendance_management/report_staff_attendance_classwise_daily')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#147475;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Emp Report <small style="color:#fff;">Daily Categorywise</small></h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
           <a href="javascript:get_content('attendance_management/report_staff_attendance_classwise_daily')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
		<a href="javascript:get_content('attendance_management/report_staff_attendance_staffwise')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#7C2A19;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Emp Report <small style="color:#fff;">Employeewise</small></h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
             <a href="javascript:get_content('attendance_management/report_staff_attendance_staffwise')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	
		<a href="javascript:get_content('attendance_management/report_staff_attendance_monthly')">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box" style="background-color:#254E85;">
            <div class="inner"><br>
               <h3 style="font-size:18px;margin-left:5px;color:#fff;">Emp Attendance Monthly <small style="color:#fff;">Daywise</small></h3>
				<p style="margin-left:10px;color:#fff;">Enter</p>
            </div>
           <a href="javascript:get_content('attendance_management/report_staff_attendance_monthly')" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</a>
	
	
	
		
		</div>
	  </div>
	  </section>
	 