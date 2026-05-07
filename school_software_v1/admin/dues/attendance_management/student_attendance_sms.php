<?php include("../attachment/session.php"); 

?>
<script type="text/javascript">
function get_list(){
var class_name=document.getElementById('student_class').value;
var class_section=document.getElementById('student_class_section').value;
var student_class_stream=document.getElementById('student_class_stream').value;
var student_class_group=document.getElementById('student_class_group').value;
var student_attendance_date=document.getElementById('attendance_date').value;

var attendance_type=document.getElementById('attendance_type').value;
if(class_name!=''){
$("#attendance_detail").html(loader_div_google);
$.ajax({
type: "POST",
url: access_link+"attendance_management/student_attendance_sms_ajax.php?student_attendance_class="+class_name+"&student_attendance_date="+student_attendance_date+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&section="+class_section+"&attendance_type="+attendance_type,
cache: false,
success: function(detail){
$("#attendance_detail").html(detail);
  }
});
}else{
    alert_new("Please Select Class!!","red");
$("#attendance_detail").html('');
}
}


function get_section(){
		 $('#student_class_section').html("<option value='' >Loading....</option>");
         	var student_class= document.getElementById('student_class').value;
       $.ajax({
			  type: "POST",
              url: access_link+"important_ajax/get_section_all.php?class_name="+student_class+"",
              cache: false,
              success: function(detail){
 
                  $("#student_class_section").html(detail);

              }
           });
    }
  function for_stream(value2){
		   if(value2=="11TH" || value2=="12TH"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
$("#student_class_stream").attr('required',true);
$("#student_class_group").attr('required',true);
$("#student_class_stream").val('All');
$("#student_class_group").val('All');
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
$("#student_class_stream").attr('required',false);
$("#student_class_group").attr('required',false);
$("#student_class_stream").val('');
$("#student_class_group").val('');
}
}  

   function get_group(value1){
       $("#student_class_group").html("<option value=''>Loading....</option>");
       $.ajax({
			  type: "POST",
              url:  access_link+"important_ajax/get_group_all.php?stream_name="+value1+"",
              cache: false,
              success: function(detail){                
        
                  $("#student_class_group").html(detail);
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
	  <li class="active"> Student Attendance Fill</li>
      </ol>
    </section>
<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance Panels</h5>
              </div>
			   <div class="box-body">
	<div class="col-md-2 ">				
					<div class="form-group">
					  <label >Class<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class" id="student_class" onchange="for_stream(this.value);get_section();" required>
					           <option  value="">Select Class</option>
						       <?php 
						   $class37=$_SESSION['class_name37'];
					   $class371=explode('|?|',$class37);
					   $total_class=$_SESSION['class_total37'];
					   for($q=0;$q<$total_class;$q++){
					   $class_name=$class371[$q];  ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					           <?php } ?>
					    </select>
					  </select>
					</div>
				</div>	
					<div class="col-md-2 " id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label >Stream<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);" >
					           <option  value="All">All</option>
						       <?php  $que="select * from school_info_stream_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name'];
                               if($stream_name!=''){
							   ?>
						       <option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
					           <?php } } ?>
					    </select>
					
					</div>
				</div>
				<div class="col-md-2 " id="student_class_group_div" style="display:none;">				
					<div class="form-group">
					  <label >Group<font style="color:red"><b>*</b></font></label>
					      <select class="form-control" name="student_class_group" id="student_class_group"  >
					           <option  value="All">All</option>
					    </select>
					  </select>
					</div>
				</div>
					<div class="col-md-1">
			  <div class="form-group">
				<label>Section<font style="color:red"><b>*</b></font></label>
				<select name="student_class_section" id="student_class_section" class="form-control" required>
				     <option  value="All">All</option>
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
		<div class="col-md-2">
			  <div class="form-group">
					<label>Attendance Type</label>
				 <select name="attendance_type" id="attendance_type"  class="form-control">
				     
				  <option value="A">A</option>
				  <option value="P">P</option>
				  <option value="P/2">P/2</option>
				  <option value="L">L</option>
				  <option  value="">None</option>
				  </select>
			  </div>
			  </div>
			  
		<div class="col-md-3">
	<div class="form-group">
					<label>&nbsp;</label>
					<br>
		   <button   onclick="get_list();" class="btn btn-success ">Get List</button>
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
