<?php include("../attachment/session.php");
include('../attachment/functions.php');
?>
<script type="text/javascript">


function student_attendance_list(){
var class_name=document.getElementById('student_class').value;
var class_section=document.getElementById('student_class_section').value;
var student_class_stream=document.getElementById('student_class_stream').value;
var student_class_group=document.getElementById('student_class_group').value;



var month_info=[];
var add=0;
$(".month_info").each(function() {
if($(this).prop("checked") == true){
month_info.push($(this).val());
add=add+1;
}
});

if(class_name!=''){
    
if(add>0){
$("#attendance_detail").html(loader_div_google);
$.ajax({
type: "POST",
url: access_link+"attendance_management/report_student_attendance_annually_ajax.php?attendance_student_class="+class_name+"&month_info="+month_info+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&section="+class_section,
cache: false,
success: function(detail){
$("#attendance_detail").html(detail);
  }
});
}else{
     alert_new("Please Select At Leaset One Month!!","red");
$("#attendance_detail").html('');
}
}else{
     alert_new("Please Select Class!!","red");
$("#attendance_detail").html('');
}
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

function for_check(id){
if($('#'+id).prop("checked") == true){
	$('.'+id).prop('checked',true);
}else{
	$('.'+id).prop('checked',false);
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
                <h5 class="box-title" style="color:teal;">Student Attendance Report</h5>
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
		
			  

			  
			  <div class="col-md-12">
			      <div class="row">
                	    <div class="col-md-2">				
					<div class="form-group">
					    <input type="checkbox" checked id="month_info" onclick="for_check('month_info')" >&nbsp;&nbsp;&nbsp;<b style="color:red">All</b>
					    </div>
				</div>	
				</div>	
			  <div class="row">
			   <?php
 $month_array=array("January","February","March","April","May","June","July","August","September","October","November","December");
 $month_code_array=array("01","02","03","04","05","06","07","08","09","10","11","12");

    $current_month=date('m');
 $session_start_month = 04;
 if($_SESSION['database_name1']=='vidyasagarschoolnaxalbari')
 $session_start_month='01';
$session_value_explode=explode("_",$session1);
for($rr=intval($session_start_month)-1;$rr<12;$rr++){
    $year=$session_value_explode[0];
    $checked="";
    if($rr<=$current_month){
        $checked="checked";
    }
     if($current_month<=$session_start_month){
        $checked="checked";
    }
    
 ?>
  <div class="col-md-2">
			  <input class="month_info" type="checkbox" name="month_list" id="month_list" <?php echo $checked; ?> value="<?php echo $month_code_array[$rr]."|?|".$year; ?>">&nbsp;&nbsp;&nbsp;<?php echo $month_array[$rr]."-".$year; ?>

			 
			  </div>
 <?php
}
for($rr=0;$rr<intval($session_start_month)-1;$rr++){
     $year="20".$session_value_explode[1];
      $checked="";
    if($rr<=$current_month){
        $checked="checked";
    }
    ?>
  <div class="col-md-2">
			  <input  class="month_info"  type="checkbox" name="month_list" id="month_list"  value="<?php echo $month_code_array[$rr]."|?|".$year; ?>">&nbsp;&nbsp;&nbsp;<?php echo $month_array[$rr]."-".$year; ?>
			  </div>
 <?php
}
?>
			 
			  </div>
			  </div>
			  
		<div class="col-md-1">
		    <br>
		    <button  onclick="student_attendance_list();" class="btn btn-success my_background_color">Get List</button>
		  		  </div>	  
	
			 
			  
            </div>
            </div>
            </div>

         
	<div class="box box-primary" id="attendance_detail">
             
            </div>
   
<script>
       function exportTableToExcel_function(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        
        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';
        
        // Create download link element
        downloadLink = document.createElement("a");
        
        document.body.appendChild(downloadLink);
        
        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        
                // Setting the file name
                downloadLink.download = filename;
                
                //triggering the function
                downloadLink.click();
            }
        }
        function for_print_function()
         {
         var divToPrint=document.getElementById("printTable");
         newWin= window.open("");
         newWin.document.write(divToPrint.outerHTML);
         newWin.print();
         newWin.close();
         }
    </script>  