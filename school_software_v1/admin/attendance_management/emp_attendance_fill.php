<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
function fill_attendance(){
var emp_department=document.getElementById('emp_department').value;
var emp_attendance_register=document.getElementById('emp_attendance_register').value;
var staff_attendance_date=document.getElementById('attendance_date').value;

var default_attendance=document.getElementById('default_attendance').value;
$("#attendance_detail").html(loader_div_google);
$.ajax({
type: "POST",
url: access_link+"attendance_management/emp_attendance_fill_ajax.php?emp_department="+emp_department+"&staff_attendance_date="+staff_attendance_date+"&default_attendance="+default_attendance+"&emp_attendance_register="+emp_attendance_register,
cache: false,
success: function(detail){
$("#attendance_detail").html(detail);
  }
});

}function view_attendance(){
var emp_department=document.getElementById('emp_department').value;
var staff_attendance_date=document.getElementById('attendance_date').value;
var emp_attendance_register=document.getElementById('emp_attendance_register').value;
$("#attendance_detail").html(loader_div_google);
$.ajax({
type: "POST",
url: access_link+"attendance_management/emp_attendance_view_ajax.php?emp_department="+emp_department+"&staff_attendance_date="+staff_attendance_date+"&emp_attendance_register="+emp_attendance_register,
cache: false,
success: function(detail){
$("#attendance_detail").html(detail);
  }
});

}

</script>
  <section class="content-header">
      <h1>
      Attendance Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  Home</a></li>
	 <li><a href="javascript:get_content('attendance_management/attendance_management')"><i class="fa fa-dashboard"></i>  Attendance</a></li>
	  <li class="active"> Staff Attendance Fill</li>
      </ol>
    </section>
<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance Panels</h5>
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
					<label >Date  :</label>
					<?php $today_date= date('Y-m-d');
					$date_diff=  date('Y-m-d', strtotime($today_date. '-1000day'));
					?>
					<input  type="date" class="form-control " name="attendance_date" id='attendance_date' max="<?php echo date('Y-m-d'); ?>" min="<?php echo $date_diff; ?>" value="<?php echo date('Y-m-d'); ?>" >
			  </div>
			  </div>
			  	<div class="col-md-2">
			  <div class="form-group">
					<label>Default Attendance  :</label>
				 <select name="default_attendance" id="default_attendance"  class="form-control">
				  <option value="P">P</option>
				  <option value="P/2">P/2</option>
				  <option value="A">A</option>
				  <option value="L">L</option>
				  <option  value="">None</option>
				  </select>
			  </div>
			  </div>
		<div class="col-md-3">
	<div class="form-group">
					<label>&nbsp;</label>
					<br>
		    <button  onclick="fill_attendance();" class="btn btn-success ">Fill Attendance</button> <button   onclick="view_attendance();" class="btn btn-success ">View Attendance</button>
		  		  </div>	  
		  		  </div>	  
            </div>
            </div>
            </div>
         
	<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance Detail</h5>
              </div>
			   <div class="box-body" id="attendance_detail">
               
            </div>
            </div>
   
<script>
  $(function () {
    $('#example1').DataTable();
    
  })
</script>
