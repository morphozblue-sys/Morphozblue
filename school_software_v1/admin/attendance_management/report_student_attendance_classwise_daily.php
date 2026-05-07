<?php include("../attachment/session.php"); 

?>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("printTable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>
	<script>

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
					           <option  value="">All</option>
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
				    
		<div class="box <?php echo $box_head_color; ?> " id="attendance_list">
              
                            </div>   
 <script>
 function for_list(){
       var student_class=$("#student_class").val();
       var student_class_stream=$("#student_class_stream").val();
       var student_class_group=$("#student_class_group").val();
       var student_class_section=$("#student_class_section").val();
       var date_from=$("#date_from").val();
       var date_to=$("#date_to").val();
       	 $("#attendance_list").html(loader_div_google);
       $.ajax({
	  type: "POST",
	  url: access_link+"attendance_management/report_student_attendance_classwise_daily_ajax.php?student_class="+student_class+"&student_class_stream="+student_class_stream+"&student_class_group="+student_class_group+"&student_class_section="+student_class_section+"&date_from="+date_from+"&date_to="+date_to,
	  cache: false,
	  success: function(detail){
		 $("#attendance_list").html(detail);
	  }
   });
  
    }

function exportTableToExcel(tableID, filename = ''){
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
    
    //for_list();
</script>