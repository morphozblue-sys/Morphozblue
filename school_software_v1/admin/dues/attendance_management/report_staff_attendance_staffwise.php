<?php include("../attachment/session.php");

?>
<script type="text/javascript">
function month_list(value){
	    $('#attendance_staff_month').html("<option value='' >Loading....</option>"); 
          
       $.ajax({
			  type: "POST",
              url: access_link+"attendance_management/month_list_ajax.php?year="+value+"",
              cache: false,
              success: function($detail){
                var str =$detail;                
                $("#attendance_staff_month").html(str);
               
              }
           });
}
function attendance_report_type(value){
    $("#date_div").hide();
    $("#month_div").hide();
    $("#year_div").hide();
    if(value=='Daily'){
       $("#date_div").show();  
    }else if(value=='Monthly'){
      $("#month_div").show();
    $("#year_div").show();   
    }else if(value=='Yearly'){
        
    $("#year_div").show(); 
    }
    
}
function staff_attendance_list(){
var emp_department=document.getElementById('emp_department').value;

var attendance_staff_year=document.getElementById('attendance_staff_year').value;
var attendance_staff_month=document.getElementById('attendance_staff_month').value;
var emp_attendance_register=document.getElementById('emp_attendance_register').value;
var attendance_report_type=document.getElementById('attendance_report_type').value;
var attendance_date=document.getElementById('attendance_date').value;
if(emp_department!=''){
$("#attendance_detail").html(loader_div_google);
$.ajax({
type: "POST",
url: access_link+"attendance_management/report_staff_attendance_staffwise_ajax.php?attendance_emp_department="+emp_department+"&attendance_staff_year="+attendance_staff_year+"&attendance_staff_month="+attendance_staff_month+"&emp_attendance_register="+emp_attendance_register+"&attendance_report_type="+attendance_report_type+"&attendance_date="+attendance_date,
cache: false,
success: function(detail){
$("#attendance_detail").html(detail);
  }
});
}else{
     alert_new("Please Select Department!!","red");
$("#attendance_detail").html('');
}
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
	  <li class="active"> Staff Attendance Report</li>
      </ol>
    </section>
<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance Report</h5>
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
				<label>Report Type<font style="color:red"><b>*</b></font></label>
				<select name="attendance_report_type" id="attendance_report_type" class="form-control" required onchange="attendance_report_type(this.value)">
				     <option  value="Daily">Daily</option>
				     <option  value="Monthly">Monthly</option>
				</select>
			  </div>
			  </div>
			  	<div class="col-md-2" id="date_div">
			  <div class="form-group">
				<label>Select Date<font style="color:red"><b>*</b></font></label>
				<input type='date' name="attendance_date" id="attendance_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
				    
			  </div>
			  </div>
			  
			  
		<div class="col-md-2" id="year_div"  style="display:none">
		      <div class="form-group">
			  <label>Year : </label>
			  <select name="attendance_staff_year" id="attendance_staff_year" onchange="month_list(this.value);" class="form-control">
			      <?php $current_year=date('Y'); 
			      for($n=$current_year;$n>=2020;$n--){
			      
			      ?>
			  <option <?php if($n==$year){ echo "selected"; } ?> value="<?php echo $n; ?>"><?php echo $n; ?></option>
<?php } ?>
			  </select>
			    </div>
			  </div>
			  <div class="col-md-2" id="month_div" style="display:none">
		      <div class="form-group">
			  <label>Month : </label>
			  <select name="attendance_staff_month" id="attendance_staff_month" class="form-control">
			      
			      <?php
			        $month_array=array("January","February","March","April","May","June","July","August","September","October","November","December");
$current_month1=date('m');
     for($k=intval($current_month1)-1;$k>=0;$k--){
         $y=$k+1;
         if($y<10){
             $y='0'.$y;
             
         } ?>
          <option <?php if($y==$month){ echo "selected"; } ?> value="<?php echo $y; ?>"><?php echo $month_array[$k]; ?></option>
         <?php
     }
 ?>
			  </select>
			 
			  </div>
			  </div>
			  
		<div class="col-md-1">
		    <br>
		    <button  onclick="staff_attendance_list();" class="btn btn-success my_background_color">Get List</button>
		  		  </div>	  
	
			 
			  
            </div>
            </div>
            </div>
         
	<div class="box box-primary" id="attendance_detail">
             
            </div>
   
