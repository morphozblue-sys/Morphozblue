<?php include("session.php")?>
<?php 
    $image_type=$_GET['image_type'];
    $data=$_GET['data'];
    $match_field=$_GET['match_field'];
    $database_table=$_GET['table_name'];
	$database_name1=$_SESSION['database_name'];
if($database_table=='school_document'){
    $database_table1="school_info_general";
}elseif($database_table=='gallery'){
    $database_table1="gallery";
}elseif($database_table=='student_health'){
    $database_table1="student_medical_info";
}elseif($database_table=='homework_document'){
    $database_table1="homework_student";
}elseif($database_table=='time_table_document'){
    $database_table1="time_table";
}elseif($database_table=='tc_document'){
    $database_table1="tc_upload";
}elseif($database_table=='slider_document'){
    $database_table1="slider";
}elseif($database_table=='library_exam_stuff_document'){
    $database_table1="library_exam_stuff";
}elseif($database_table=='leave_document'){
    $database_table1="student_leave_management";
}elseif($database_table=='hostel_staff'){
    $database_table1="hostel_staff_info";
}elseif($database_table=='bus_staff_document'){
    $database_table1="bus_staff_info";
}elseif($database_table=='govt_official_other_document'){
    $database_table1="govt_official_other_info";
}elseif($database_table=='govt_official_document'){
    $database_table1="govt_official_info";
}elseif($database_table=='student_documents'){
    $database_table1="student_admission_info";
}elseif($database_table=='bus_document'){
    $database_table1="bus_details";
}elseif($database_table=='employee_document'){
    $database_table1="employee_info";
}else{
    $database_table1=$database_table;
}
			$que1="select * from $database_table1 where $match_field='$data'";
    $run1=mysqli_query($conn73,$que1);
    while($row1=mysqli_fetch_array($run1)){
$image=$row1[$image_type."_name"];
	}
	if($image!=''){
	$image_path=$_SESSION['amazon_file_path'].$database_table."/".$image;
	}else{
	  $image_path=$school_software_path."images/student_blank.png";  
	}
?>
<script>
$('#myModal').modal('show'); 
</script>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" width="150%" style="margin-right:400px;">    
      <!-- Modal content-->
      <div class="modal-content" >
	   <div class="modal-header">
	       
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
		<img  src="<?php echo $image_path; ?>"  height="400" width="100%" style="margin-top:10px;">
					
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
