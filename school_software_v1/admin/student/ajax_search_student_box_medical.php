<?php include("../attachment/session.php"); ?>  
<?php
$roll=$_GET['id'];

$que15="select * from student_admission_info where student_roll_no='$roll' and session_value='$session1'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row=mysqli_fetch_assoc($run15)){

		                         $student_roll_no=$row['student_roll_no'];
						         $student_name=$row['student_name'];
						         $student_class=$row['student_class'];
						         $student_class_section=$row['student_class_section'];
						         $student_father_name=$row['student_father_name'];
						         $student_mother_name=$row['student_mother_name'];
						         $student_date_of_birth=$row['student_date_of_birth'];
						         $student_date_of_birth_in_word=$row['student_date_of_birth_in_word'];
						         $student_religion=$row['student_religion'];
						         $student_category=$row['student_category'];
						         $student_sssmid_number=$row['student_sssmid_number'];
						         $student_date_of_admission=$row['student_date_of_admission'];
						         $student_admission_number=$row['student_admission_number'];
						         $student_religion=$row['student_religion'];
						         $student_adhar_number=$row['student_adhar_number'];
						         $school_roll_no=$row['school_roll_no'];
						         $student_admission_class=$row['student_previous_class'];
								 $student_cwsn=$row['student_cwsn'];
								 $student_cwsn_description=$row['student_cwsn_description'];
								 }
	
    if(mysqli_num_rows($run15)>0){
    $num=1;	
	echo $student_name."|?|".$student_class."|?|".$student_class_section."|?|".$student_father_name."|?|".$student_mother_name."|?|".$student_date_of_birth."|?|".$student_date_of_birth_in_word."|?|".$student_sssmid_number."|?|".$student_date_of_admission."|?|".$student_admission_number."|?|".$school_roll_no."|?|".$student_admission_class."|?|".$student_class."|?|".$student_adhar_number."|?|".$student_cwsn."|?|".$student_cwsn_description."|?|".$num;
	}
?>