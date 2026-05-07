<?php include("../attachment/session.php"); 

?>
  <section class="content-header">
      <h1>
      Attendance Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  Home</a></li>
	 <li><a href="javascript:get_content('attendance_management/attendance_management')"><i class="fa fa-dashboard"></i>  Attendance</a></li>
	  <li class="active"> Staff Attendance Report</li>
      </ol>
    </section>
	<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Staff Attendance Report</h5>
              </div>
			   <div class="box-body">
			        <div class="col-md-12">
				<div class="col-md-2">				
				<div class="form-group">
                   <label>Department</label>
				      <select name="emp_department" id="emp_department" class="form-control">
			          <option value="All">All</option> 
			          <option value="Teaching">Teaching</option>  
			          <option value="Non Teaching">Non Teaching</option>  
               </select>
                </div>
			</div>
		<div class="col-md-2">				
				<div class="form-group">
                   <label>Attendance Register</label>
				      <select name="emp_attendance_register" id="emp_attendance_register" class="form-control">
			          <option value="All">All</option> 
			              <option  value="Register1">Register1</option>
			        			        <option   value="Register2">Register2</option>
			        			        <option   value="Register3">Register3</option>
			        			        <option   value="Register4">Register4</option>
			        			        <option   value="Register5">Register5</option>
			        			        <option   value="Register6">Register6</option>
			        			        <option   value="Register7">Register7</option>
			        			        <option   value="Register8">Register8</option>
			        			        <option   value="Register9">Register9</option>
			        			        <option   value="Register10">Register10</option>
               </select>
                </div>
			</div>
			  
				 <div class="col-md-2">
			  <div class="form-group">
				<label>From date</label>
			<input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="date_from">
			  </div>
			  </div>	
				 <div class="col-md-2">
			  <div class="form-group">
				<label>To Date</label>
			<input type="date" class="form-control"  value="<?php echo date('Y-m-d'); ?>" id="date_to">
			  </div>
			  </div>
			  
				<div class="col-md-2">
			  <div class="form-group">
				<label>&nbsp;</label>
			<center><input type="button" class="form-control btn-success" value="Get List" onclick="for_list()"></center>
			  </div>
			  </div>	
				</div>	
				</div>	
				</div>	
				
      			<div class="box box-primary" id="attendance_list">
              
                            </div>   
 <script>
 function for_list(){
       var emp_department=$("#emp_department").val();
       var emp_attendance_register=$("#emp_attendance_register").val();
       var date_from=$("#date_from").val();
       var date_to=$("#date_to").val();
       	 $("#attendance_list").html(loader_div_google);
       $.ajax({
	  type: "POST",
	  url: access_link+"attendance_management/report_staff_attendance_classwise_daily_ajax.php?emp_department="+emp_department+"&emp_attendance_register="+emp_attendance_register+"&date_from="+date_from+"&date_to="+date_to,
	  cache: false,
	  success: function(detail){
		 $("#attendance_list").html(detail);
	  }
   });
  
    }
    for_list();
</script>