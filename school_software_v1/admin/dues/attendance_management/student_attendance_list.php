<?php include("../attachment/session.php"); 


?>
<script type="text/javascript">
function month_list(value){
	    $('#student_attendance_month').html("<option value='' >Loading....</option>"); 
          
       $.ajax({
			  type: "POST",
              url: access_link+"attendance_management/month_list_ajax.php?year="+value+"",
              cache: false,
              success: function($detail){
                var str =$detail;                
                $("#student_attendance_month").html(str);
               
              }
           });
}
function student_attendance_list(){
var class_name=document.getElementById('student_class').value;

var student_attendance_year=document.getElementById('student_attendance_year').value;
var student_attendance_month=document.getElementById('student_attendance_month').value;
var class_section=document.getElementById('student_class_section').value;
var student_class_stream=document.getElementById('student_class_stream').value;
var student_class_group=document.getElementById('student_class_group').value;
if(class_name!=''){
$("#attendance_detail").html(loader_div_google);
$.ajax({
type: "POST",
url: access_link+"attendance_management/student_attendance_list_ajax.php?student_attendance_class="+class_name+"&student_attendance_year="+student_attendance_year+"&student_attendance_month="+student_attendance_month+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&section="+class_section,
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
	  <li class="active"> Student Attendance View</li>
      </ol>
    </section>
<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Attendance Panels</h5>
              </div>
			   <div class="box-body">
                <div class="col-md-12">
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
			  <label>Year : </label>
			  <select name="student_attendance_year" id="student_attendance_year" onchange="month_list(this.value);" class="form-control">
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
			  <select name="student_attendance_month" id="student_attendance_month" class="form-control">
			      
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
		    <button  onclick="student_attendance_list();" class="btn btn-success my_background_color">Get List</button>
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
