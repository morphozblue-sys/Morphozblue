<?php include("../attachment/session.php")?> 
<?php
$roll=$_GET['id'];
$checkup=$_GET['checkup'];

$que15="select * from student_medical_info where student_roll_no='$roll' and session_value='$session1'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
if(mysqli_num_rows($run15)<1){
$que123="insert into student_medical_info (student_roll_no,session_value,$update_by_insert_sql_column) values('$roll','$session1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que123);
$que15="select * from student_medical_info where student_roll_no='$roll' and session_value='$session1'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73)); 
}
$num=0;
while($row=mysqli_fetch_assoc($run15)){

		                         $student_medical_history=$row['student_medical_history'];
								 $student_major_illness=$row['student_major_illness'];
								 $student_height=$row['student_height'];
								 $student_weight=$row['student_weight'];
								 
								 $checkup_date=$row[$checkup.'_date'];
								 $checkup_hospital_name=$row[$checkup.'_hospital_name'];
								 $checkup_doctor_name=$row[$checkup.'_doctor_name'];
								 $checkup_bp=$row[$checkup.'_bp'];
								 $checkup_hb=$row[$checkup.'_hb'];
								 $checkup_suger=$row[$checkup.'_suger'];
								 $checkup_hiv=$row[$checkup.'_hiv'];
								 $checkup_tb=$row[$checkup.'_tb'];
								 $checkup_eye_problem=$row[$checkup.'_eye_problem'];
								 $checkup_specs=$row[$checkup.'_specs'];
								 $checkup_left_specs_no=$row[$checkup.'_left_specs_no'];
								 $checkup_right_specs_no=$row[$checkup.'_right_specs_no'];
								 $checkup_remark=$row[$checkup.'_remark'];
								 $checkup_discription=$row[$checkup.'_discription'];
								 $checkup_marks=$row[$checkup.'_marks'];

								 }
	


while($row1=mysqli_fetch_assoc($run151)){

		                         $checkup_report1=$_SESSION['amazon_file_path']."student_health/".$row1[$checkup.'_report_name'];
	
	}
    $num=1;	
	echo $student_medical_history."|?|".$student_major_illness."|?|".$student_height."|?|".$student_weight."|?|".$checkup_date."|?|".$checkup_hospital_name."|?|".$checkup_doctor_name."|?|".$checkup_bp."|?|".$checkup_hb."|?|".$checkup_suger."|?|".$checkup_hiv."|?|".$checkup_tb."|?|".$checkup_eye_problem."|?|".$checkup_specs."|?|".$checkup_left_specs_no."|?|".$checkup_right_specs_no."|?|".$checkup_remark."|?|".$checkup_discription."|?|".$checkup_marks."|?|".$checkup_report1."|?|".$student_medical_history."|?|".$num;
	
?>