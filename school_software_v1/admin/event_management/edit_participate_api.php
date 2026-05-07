<?php include("../attachment/session.php"); ?>
<?php
    $s_no11 = $_POST['s_no11'];
    $participate_type = $_POST['participate_type'];
	$event_name = $_POST['event_name'];
	$house_name = $_POST['house_name'];
	$school_name = $_POST['school_name'];
	$student_name = $_POST['student_name'];
	$gender = $_POST['gender'];
	$student_class = $_POST['student_class'];
	$dateofbirth = $_POST['dateofbirth'];
	$category = $_POST['category'];
	$student_roll_no = $_POST['student_roll_no'];
	$student_father_name = $_POST['student_father_name'];
	$student_mother_name = $_POST['student_mother_name'];

	
  $quer="update event_participate_table set participate_type='$participate_type',event_name='$event_name',house_name='$house_name',school_name='$school_name',student_name='$student_name',gender='$gender',student_class='$student_class',dateofbirth='$dateofbirth',student_roll_no='$student_roll_no',category='$category',student_mother_name='$student_mother_name',student_father_name='$student_father_name',$update_by_update_sql   where s_no='$s_no11'";
 
 if(mysqli_query($conn73,$quer)){
	echo "|?|success|?|";
}
 
 ?>