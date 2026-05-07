<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
function view_attendance(){
var emp_department=document.getElementById('emp_department').value;
var staff_attendance_date=document.getElementById('attendance_date').value;

$("#attendance_detail").html(loader_div_google);
$.ajax({
type: "POST",
url: access_link+"attendance_management/emp_rfid_machine_attendance_list_ajax.php?emp_department="+emp_department+"&attendance_staff_date="+attendance_staff_date,
cache: false,
success: function(detail){
$("#attendance_detail").html(detail);
  }
});
}
view_attendance();

</script>
<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">RFID Machine Filled Attendance</h5>
              </div>
			   <div class="box-body">
                <div class="row">
			<div class="col-md-4 ">				
				<div class="form-group">
                   <label>Department</label>
				      <select name="emp_department" id="emp_department" class="form-control">
			          <option value="All">All</option> 
			          <option value="Teaching">Teaching</option>  
			          <option value="Management">Management</option>  
			          <option value="Account">Account</option>  
			          <option value="Transport">Transport</option>  
			          <option value="Library">Library</option>  
			          <option value="Hostel">Hostel</option>  
			          <option value="Sports">Sports</option>  
			          <option value="Maintanance">Maintanance</option>
			          <option value="Security">Security</option>
			          <option value="Other">Other</option>
               </select>
                </div>
			</div>
	
		<div class="col-md-2">
			  <div class="form-group">
					<label>Date  :</label>
					<?php $today_date= date('Y-m-d');
					$date_diff=  date('Y-m-d', strtotime($today_date. '-1000day'));
					?>
					<input  type="date" class="form-control " name="attendance_date" id='attendance_date' max="<?php echo date('Y-m-d'); ?>" min="<?php echo $date_diff; ?>" value="<?php echo date('Y-m-d'); ?>" >
			  </div>
			  </div>
	<div class="col-md-3">
	<div class="form-group">
					<label>&nbsp;</label>
					<br>
		   <button   onclick="view_attendance();" class="btn btn-success ">View Attendance</button>
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
