<?php include("../attachment/session.php");

$roll=$_GET['id'];


$que15="select * from student_admission_info where student_roll_no='$roll' and session_value='$session1'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row15=mysqli_fetch_assoc($run15)){

		$student_name=$row15['student_name'];
	   $student_class_section=$row15['student_class_section'];
	   $student_class=$row15['student_class'];
	   $school_roll_no=$row15['school_roll_no'];
	   $student_class_group=$row15['student_class_group'];
	   $student_class_stream=$row15['student_class_stream'];
	   $student_medium=$row15['student_medium'];
	   $student_scholar_number=$row15['student_scholar_number'];
		
	}
    if(mysqli_num_rows($run15)>0){
    $num=1;	
	echo $student_name."|?|".$student_class."|?|".$student_class_section."|?|".$student_scholar_number."|?|".$school_roll_no."|?|".$num."|?|".$student_class_group."|?|".$student_class_stream."|?|".$student_medium."|?|";
	}
?>