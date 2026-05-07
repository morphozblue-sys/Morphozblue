<?php include("../attachment/session.php")?>
<?php
$roll=$_GET['id'];
$que15="select * from student_admission_info where student_roll_no='$roll'  and session_value='$session1' ";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
while($row15=mysqli_fetch_assoc($run15)){
	   $student_name=$row15['student_name'];
	   $student_class=$row15['student_class'];
	   $student_class_section=$row15['student_class_section'];
	   $student_admission_number=$row15['student_admission_number'];
	   $student_sms_contact_number=$row15['student_sms_contact_number'];
	}
    if(mysqli_num_rows($run15)>0){
	echo $student_name."|?|".$student_class."|?|".$student_class_section."|?|".$student_admission_number."|?|".$student_sms_contact_number;
	}
?>