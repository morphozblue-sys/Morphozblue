<?php include("../attachment/session.php"); ?>
<script type="text/javascript">
function month_list(value){
	    $('#staff_attendance_month').html("<option value='' >Loading....</option>"); 
          
       $.ajax({
			  type: "POST",
              url: access_link+"attendance_management/month_list_ajax.php?year="+value+"",
              cache: false,
              success: function($detail){
                var str =$detail;                
                $("#staff_attendance_month").html(str);
               
              }
           });
}

function staff_attendance_list(){
var emp_department=document.getElementById('emp_department').value;
var staff_attendance_year=document.getElementById('staff_attendance_year').value;
var staff_attendance_month=document.getElementById('staff_attendance_month').value;
$("#attendance_detail").html(loader_div_google);
$.ajax({
type: "POST",
url: access_link+"attendance_management/emp_attendance_list_ajax.php?emp_department="+emp_department+"&staff_attendance_year="+staff_attendance_year+"&staff_attendance_month="+staff_attendance_month,
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
	  <li class="active"> Staff Attendance View</li>
      </ol>
    </section>
  <div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance Panels</h5>
              </div>
			   <div class="box-body">
                <div class="col-md-12">
		<div class="col-md-4 ">				
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
			  <label>Year : </label>
			  <select name="staff_attendance_year" id="staff_attendance_year" onchange="month_list(this.value);" class="form-control">
			      <?php $current_year=date('Y'); 
			      for($n=$current_year;$n>=2020;$n--){
			      
			      ?>
			  <option <?php if($n==$year){ echo "selected"; } ?> value="<?php echo $n; ?>"><?php echo $n; ?></option>
<?php } ?>
			  </select>
			  </div>
			  </div>
            <div class="col-md-2">
                	<div class="form-group">
			  <label>Month : </label>
			  <select name="staff_attendance_month" id="staff_attendance_month" class="form-control">
			      
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
			  
		<div class="col-md-2">
		    <br>
		    <button  onclick="staff_attendance_list();" class="btn btn-success my_background_color">Get List</button>
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
