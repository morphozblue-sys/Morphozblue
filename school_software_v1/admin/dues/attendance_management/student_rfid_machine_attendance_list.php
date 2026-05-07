<?php include("../attachment/session.php"); 
die();
?>
<script type="text/javascript">
function view_attendance(){
var class_name=document.getElementById('student_class').value;
var student_attendance_date=document.getElementById('attendance_date').value;

$("#attendance_detail").html(loader_div_google);
$.ajax({
type: "POST",
url: access_link+"attendance_management/student_rfid_machine_attendance_list_ajax.php?attendance_student_class="+class_name+"&attendance_student_date="+attendance_student_date,
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
	<div class="col-md-2 ">				
					<div class="form-group">
					  <label >Class<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class" id="student_class"  required>
					           <option  value="">All</option>
						       <?php 
							   $class37=$_SESSION['class_info'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					           <?php } ?>
					    </select>
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
