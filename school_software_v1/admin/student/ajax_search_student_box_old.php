  <?php include("../attachment/session.php")?>  
<?php
$roll=$_GET['id'];

$que15="select * from student_admission_info_old where student_roll_no='$roll'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row15=mysqli_fetch_assoc($run15)){

	   $student_name=$row15['student_name'];
	   $student_class=$row15['student_class'];
	   $student_father_name=$row15['student_father_name'];
	   $student_father_contact_no_1=$row15['student_father_contact_no_1'];
	   $student_father_contact_no_2=$row15['student_father_contact_no_2'];
	   $student_gender=$row15['student_gender'];
	   $student_date_of_birth=$row15['student_date_of_birth'];
	   $student_image=$row15['student_image'];
	   $student_id_generate=$row15['student_id_generate'];
	   
       $path="../../documents/student_old/".$student_id_generate;
	}
    if(mysqli_num_rows($run15)>0){
    $num=1;	
	echo $student_name."|?|".$student_class."|?|".$student_father_name."|?|".$student_father_contact_no_1."|?|".$student_father_contact_no_2."|?|".$student_gender."|?|".$student_date_of_birth."|?|".$num."|?|".$student_image."|?|".$path;
	}
?>