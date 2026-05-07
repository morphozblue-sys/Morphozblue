<?php include("../attachment/session.php");
include("../attachment/image_compression_upload.php");
	$homework_date_1 = $_POST['homework_date'];
	$homework_date_2 = explode("-",$homework_date_1);
	$homework_date=$homework_date_2[2]."-".$homework_date_2[1]."-".$homework_date_2[0];
	$homework_class = $_POST['homework_class'];
	$subject_name = $_POST['subject_name'];
	$student_class_stream = $_POST['student_class_stream'];
	$student_class_group = $_POST['student_class_group'];
	$medium=$_POST['medium'];
	$shift=$_POST['shift'];
		$student_image=$_FILES['student_photo']['name'];
	$homework_section = $_POST['homework_section'];
	if($homework_section==''){
	    $homework_section='ALL';
	}else{
	    $homework_section=$homework_section;
	}
	$homework = $_POST['homework'];
	$homework_remark = $_POST['homework_remark'];
   $qry="INSERT INTO homework_student(blank_field_1,blank_field_2,blank_field_3,blank_field_4,homework_date,homework_class,medium,shift,homework_section,homework,homework_remark,session_value,$update_by_insert_sql_column) VALUES ('$student_image','$subject_name','$student_class_stream','$student_class_group','$homework_date','$homework_class','$medium','$shift','$homework_section','$homework','$homework_remark','$session1',$update_by_insert_sql_value)";
    if(mysqli_query($conn73,$qry))
    {				
        $last_id=mysqli_insert_id($conn73);						
        $que="select * from login";
        $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
    	while($row=mysqli_fetch_assoc($run)){
	        $server_key=$row['blank_field_4'];
		}
        
    	$student_image=$_FILES['student_photo']['name'];
    	if($student_image!=''){
	$imagename = $_FILES['student_photo']['name'];
	$size = $_FILES['student_photo']['size'];
    $uploadedfile = $_FILES['student_photo']['tmp_name'];
	
	camera_code($size,$imagename,$uploadedfile,$last_id,"homework_file","homework_document","s_no");
	}
	    
        echo "|?|success|?|";
    }
?>