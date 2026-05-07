<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
	$classwork_date_1 = $_POST['classwork_date'];
	$classwork_date_2 = explode("-",$classwork_date_1);
	$classwork_date=$classwork_date_2[2]."-".$classwork_date_2[1]."-".$classwork_date_2[0];
	$classwork_class = $_POST['classwork_class'];
	$subject_name = $_POST['subject_name'];
	$student_class_stream = $_POST['student_class_stream'];
	$student_class_group = $_POST['student_class_group'];
	$medium=$_POST['medium'];
	$shift=$_POST['shift'];
	$classwork_section = $_POST['classwork_section'];
	if($classwork_section==''){
	    $classwork_section='ALL';
	}else{
	    $classwork_section=$classwork_section;
	}
	$classwork = $_POST['classwork'];
	$classwork_remark = $_POST['classwork_remark'];
   $qry="INSERT INTO classwork_student(blank_field_2,blank_field_3,blank_field_4,classwork_date,classwork_class,medium,shift,classwork_section,classwork,classwork_remark,session_value,$update_by_insert_sql_column) VALUES ('$subject_name','$student_class_stream','$student_class_group','$classwork_date','$classwork_class','$medium','$shift','$classwork_section','$classwork','$classwork_remark','$session1',$update_by_insert_sql_value)";
       
    if(mysqli_query($conn73,$qry)) {
	    
        echo "|?|success|?|";
    }
?>