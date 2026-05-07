<?php include("../attachment/session.php");
	
	$s_no=$_POST['s_no'];
	$syllabus_topic=$_POST['syllabus_topic'];
	$syllabus_book_name=$_POST['syllabus_book_name'];
	$syllabus_chapter_book_name=$_POST['syllabus_chapter_book_name'];
	$syllabus_student_feedback=$_POST['syllabus_student_feedback'];
	$syllabus_remark=$_POST['syllabus_remark'];
	$syllabus_estimated_completion_date=$_POST['syllabus_estimated_completion_date'];
	

	$query2="update school_info_syllabus_info set syllabus_topic='$syllabus_topic',syllabus_book_name='$syllabus_book_name',syllabus_chapter_book_name='$syllabus_chapter_book_name',syllabus_student_feedback='$syllabus_student_feedback',syllabus_remark='$syllabus_remark',syllabus_estimated_completion_date='$syllabus_estimated_completion_date' where s_no='$s_no' and session_value='$session1'";
	
	if(mysqli_query($conn73,$query2)){
    echo "|?|success|?|";
    }
?>