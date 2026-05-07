<?php include("../attachment/session.php");
  $student_name=$_POST['student_name'];
  $student_class=$_POST['student_class'];
  $student_section=$_POST['student_section'];
  $student_roll_no=$_POST['student_roll_no'];
  $penalty_amount=$_POST['penalty_amount'];
  $penalty_reason=$_POST['penalty_reason'];
  $penalty_remark=$_POST['penalty_remark'];   
  
  
  echo  $query="insert into student_penality(student_roll_no,student_name,student_class,student_class_section,penalty,penalty_reason,penalty_remark,session_value) values ('$student_roll_no','$student_name','$student_class','$student_section','$penalty_amount','$penalty_reason','$penalty_remark','$session1')";
  mysqli_query($conn73,$query);
echo "|?|success|?|";
	
