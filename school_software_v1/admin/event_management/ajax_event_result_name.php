<?php
$participate_type=$_GET['id'];
include("../../con73/con37.php");
 $que15="select * from event_participate_table where s_no='$participate_type'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row15=mysqli_fetch_assoc($run15)){
          $s_no=$row15['s_no'];
		$student_name=$row15['student_name'];
	    $school_name=$row15['school_name'];
	    $house_name=$row15['house_name'];
	    $gender=$row15['gender'];
	    $student_class=$row15['student_class'];
	    $dateofbirth=$row15['dateofbirth'];
	    $category=$row15['category'];
	    $session_value=$row15['session_value'];
	    $event_name=$row15['event_name'];
	 }
    if(mysqli_num_rows($run15)>0){
    $num=1;	
	echo $student_name."|?|".$school_name."|?|".$house_name."|?|".$gender."|?|".$student_class."|?|".$dateofbirth."|?|".$category."|?|".$session_value."|?|".$event_name."|?|".$s_no."|?|".$num;
	}
?>