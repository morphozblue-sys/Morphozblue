<?php include("../attachment/session.php");
 $sport_student_name=$_POST['sport_student_name'];
 $sport_type=$_POST['sport_type'];
 $sport_organized_date1=$_POST['sport_organized_date'];
 $sport_organized_date2=explode("-",$sport_organized_date1);
 $sport_organized_date=$sport_organized_date2[2]."-".$sport_organized_date2[1]."-".$sport_organized_date2[0];
 $sport_rank=$_POST['sport_rank'];
 $sport_student_roll_no=$_POST['sport_student_roll_no'];
 
ECHO $query="insert into sport_certificate(sport_student_name,sport_type,sport_organized_date,sport_rank,sport_student_roll_no,session_value,$update_by_insert_sql_column) values('$sport_student_name','$sport_type','$sport_organized_date','$sport_rank','$sport_student_roll_no','$session1',$update_by_insert_sql_value)";
 
  

    if(mysqli_query($conn73,$query)){
		
echo "|?|success|?|";
	}
