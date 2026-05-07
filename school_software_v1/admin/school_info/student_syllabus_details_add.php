<?php include("../attachment/session.php");
	
	$model_student_class=$_POST['model_student_class'];
	$model_student_class_section=$_POST['model_student_class_section'];
	$model_subject_name=$_POST['model_subject_name'];
	$model_subject_teacher=$_POST['model_subject_teacher'];
	
	$model_syllabus_topic=$_POST['model_syllabus_topic'];
	$model_syllabus_book_name=$_POST['model_syllabus_book_name'];
	$model_syllabus_chapter_book_name=$_POST['model_syllabus_chapter_book_name'];
	$model_syllabus_student_feedback=$_POST['model_syllabus_student_feedback'];
	$model_syllabus_remark=$_POST['model_syllabus_remark'];
	$model_syllabus_estimated_completion_date=$_POST['model_syllabus_estimated_completion_date'];
	
	
	$query2="insert into school_info_syllabus_info(class,section,subject_name,syllabus_subject_teacher,syllabus_topic,syllabus_book_name,syllabus_chapter_book_name,syllabus_student_feedback,syllabus_remark,syllabus_estimated_completion_date,session_value) values('$model_student_class','$model_student_class_section','$model_subject_name','$model_subject_teacher','$model_syllabus_topic','$model_syllabus_book_name','$model_syllabus_chapter_book_name','$model_syllabus_student_feedback','$model_syllabus_remark','$model_syllabus_estimated_completion_date','$session1')";
	
	if(mysqli_query($conn73,$query2)){
    echo "|?|success|?|";
    }
?>