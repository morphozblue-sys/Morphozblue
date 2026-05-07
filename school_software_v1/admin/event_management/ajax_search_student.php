<?php
$roll=$_GET['id'];

include("../../con73/con37.php");
$que15="select * from student_admission_info where student_roll_no='$roll'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row15=mysqli_fetch_assoc($run15)){

		$student_name=$row15['student_name'];
	   $student_gender=$row15['student_gender'];
	   $student_class=$row15['student_class'];
	   $student_father_name=$row15['student_father_name'];
	   $student_father_contact_number=$row15['student_father_contact_number'];
		
	}
    if(mysqli_num_rows($run15)>0){
    $num=1;
	echo $student_gender."|?|".$student_class."|?|".$student_name."|?|".$student_father_name."|?|".$student_father_contact_number."|?|".$num;
	}else{
	$num=2;
	echo "0|?|0|?|0|?|0|?|0|?|".$num;
	}
?>