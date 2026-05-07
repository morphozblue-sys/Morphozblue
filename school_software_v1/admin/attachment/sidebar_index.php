<?php
$fees_category=$_SESSION['fees_category'];
if($fees_category == 'monthly' || $fees_category == 'installmentwise' || $fees_category == 'yearly'){
    $folder_name = '_'.$fees_category;
}else{
     $folder_name = '';
}
?>
<style>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #555; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000;
}
</style>
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" >
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           <img src="<?php echo $_SESSION['school_info_logo_name']; ?>" height="25" width="25" class="img-circle">
        </div>
        <div class="pull-left info">
          <p></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" style="height:calc(100vh - 160px);overflow-y:auto !important;overflow-x:hidden !important;" >
        <li class="header">MAIN NAVIGATION</li>
        <li ><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
	<?php if(isset($_SESSION['panel_attendance'])){ ?>	 
	<li ><a href="javascript:get_content('attendance_management/attendance_management')"><i class="fa fa-address-card-o"></i> <span><?php echo $language['Attendance']; ?></span></a></li>	
	<?php }if(isset($_SESSION['panel_enquiry'])){ ?>
	<li ><a href="javascript:get_content('enquiry/enquiry')"><i class="fa fa-phone"></i> <span><?php echo $language['Enquiry']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_staff'])){ ?>
	<li ><a href="javascript:get_content('staff/staff')"><i class="fa fa-users"></i> <span><?php echo $language['Staff']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_student'])){ ?>
	<li ><a href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <span><?php echo $language['Student']; ?></span></a></li>		
	<?php }if(isset($_SESSION['panel_account'])){ ?>
	<li ><a href="javascript:get_content('account/account')"><i class="fa fa-money"></i> <span><?php echo $language['Account']; ?></span></a></li>		
	<?php }if(isset($_SESSION['panel_dues'])){ ?>
	<li><a href="javascript:get_content('dues/dues')"><i class="fa fa-rupee"></i> <span><?php echo$language['Dues'] ; ?></span></a></li>      
	<?php }if(isset($_SESSION['panel_fees'])){ ?>
	<li><a href="javascript:get_content('<?php echo 'fees'.$folder_name; ?>/fees')"><i class="fa fa-rupee"></i> <span><?php echo$language['Fees'] ; ?></span></a></li>      
	<?php }if(isset($_SESSION['panel_penalty'])){ ?>
	<li><a href="javascript:get_content('penalty/penalty')"><i class="fa fa-rupee"></i> <span><?php echo$language['Penalty'] ; ?></span></a></li>
    <?php }if(isset($_SESSION['panel_certificate'])){ ?>
	<li><a href="javascript:get_content('certificate/certificate')"><i class="fa fa-certificate"></i> <span><?php echo$language['Certificate'] ; ?></span></a></li>
    <?php }if(isset($_SESSION['panel_examination'])){ ?>
	<li><a href="javascript:get_content('examination/examination')"><i class="fa fa-edit"></i> <span><?php echo$language['Examination'] ; ?></span></a></li>
    <?php }if(isset($_SESSION['panel_homework'])){ ?>
	<li><a href="javascript:get_content('homework/homework')"><i class="fa fa-book"></i> <span><?php echo$language['Homework'] ; ?></span></a></li>
    <?php }if(isset($_SESSION['panel_exam_paper_setter'])){ ?>
	<li><a href="javascript:get_content('exam_paper_setter/exam_paper_setter')"><i class="fa fa-paper-plane-o"></i> <span><?php echo$language['Set Paper'] ; ?></span></a></li>
    <?php }if(isset($_SESSION['panel_complaint']) && false){ ?>
	<li><a href="javascript:get_content('complaint/complaint')"><i class="fa fa-minus-square"></i> <span><?php echo$language['Complaints'] ; ?></span></a></li>
    <?php }if(isset($_SESSION['panel_gallery'])  && false ){ ?>
	<li><a href="javascript:get_content('gallery/gallery')"><i class="fa fa-picture-o"></i> <span><?php echo $language['Gallery']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_sms'])  && false ){ ?>
	<li><a href="javascript:get_content('sms/sms_panel')"><i class="fa fa-envelope"></i> <span><?php echo $language['Sms Services']; ?></span></a></li>		
	<?php }if(isset($_SESSION['panel_time_table'])){ ?>
	<li><a href="javascript:get_content('time_table/time_table')"><i class="fa fa-table"></i> <span><?php echo $language['Time Table']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_event_management'])){ ?>
	<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i> <span><?php echo $language['Event']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_holiday'])){ ?>
	<li><a href="javascript:get_content('holiday/holiday')"><i class="fa fa-external-link"></i> <span><?php echo $language['Holiday']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_leave'])){ ?>
	<li><a href="javascript:get_content('leave/leave')"><i class="fa fa-pagelines"></i> <span><?php echo $language['Leave']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_sports'])){ ?>
	<li><a href="javascript:get_content('sports/sports')"><i class="fa fa-futbol-o"></i> <span><?php echo $language['Sports']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_downloads'])){ ?>
	<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-download"></i> <span><?php echo $language['Downloads']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_recycle_bin'])){ ?>
	<li><a href="javascript:get_content('recycle_bin/recycle_bin')"><i class="fa fa-bell-o"></i> <span><?php echo $language['Recycle Bin']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_session'])){ ?>
	<li><a href="javascript:get_content('session/session')"><i class="fa fa-building-o"></i> <span><?php echo $language['Session']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_reminder'])){ ?>
	<li><a href="javascript:get_content('reminder/reminder')"><i class="fa fa-bell-o"></i> <span><?php echo $language['Reminder']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_govt_requirement'])){ ?>
	<li><a href="javascript:get_content('govt_requirement/govt_requirement')"><i class="fa fa-circle-o"></i> <span><?php echo $language['Govt. Requir.']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_school_info'])){ ?>
	<li><a href="javascript:get_content('school_info/school_info')"><i class="fa fa-user"></i> <span><?php echo $language['School Info']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_utility'])){ ?>
	<li><a href="javascript:get_content('utility/utilities')"><i class="fa fa-bell-o"></i> <span><?php echo $language['Typing Tool']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_bus'])  && false ){ ?>
	<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-bus"></i> <span><?php echo $language['Bus']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_hostel'])){ ?>
	<li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-hotel"></i> <span><?php echo $language['Hostel']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_library'])){ ?>
	<li><a href="javascript:get_content('library/library')"><i class="fa fa-book"></i> <span><?php echo $language['Library']; ?></span></a></li>
	<?php }if(isset($_SESSION['panel_stock'])){ ?>
	<li><a href="javascript:get_content('stock/stock')"><i class="fa fa-area-chart"></i> <span><?php echo $language['Stock']; ?></span></a></li>		
	<?php }if(isset($_SESSION['panel_live_bus'])  && false ){ ?>
	<li><a href="javascript:get_content('live_bus/bus_tracking')"><i class="fa fa-bus"></i> <span>Live Bus</span></a></li>			
	<?php }if(isset($_SESSION['panel_android_app'])  && false ){ ?>
	<li><a href="javascript:get_content('android_app/android_app')"><i class="fa fa-hotel"></i> <span>Android App</span></a></li>			
	<?php }if(isset($_SESSION['panel_user_right'])){ ?>
	<li><a href="javascript:get_content('user_right/user_right')"><i class="fa fa-book"></i> <span>User Rights</span></a></li>
	<?php }if(isset($_SESSION['panel_software_complaint'])){ ?>
	<li><a href="javascript:get_content('software_complaint/software_complaint')"><i class="fa fa-area-chart"></i> <span>Software Complaints</span></a></li>
	<?php } ?>     
	<li><a href="javascript:get_content('school_info/change_password')"><i class="fa fa-unlock-alt"></i> <span>Change Password</span></a></li>
	<li><a href="javascript:get_content('attachment/logout')"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
	<?php if(false){ ?>
    <li><a href="javascript:get_content('gps_tracker/gps_tracker')"><i class="fa fa-sign-out"></i> <span>gps_tracker</span></a></li>         
	<?php } ?>
    </ul>     
    </section>
    <!-- /.sidebar -->
  </aside>