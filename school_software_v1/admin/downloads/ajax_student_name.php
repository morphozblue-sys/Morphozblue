<?php include("../attachment/session.php");


	$section2=$_GET['student_data'];
	if($section2!='All'){
	     $condition1=" and student_class_section='$section2'";
	}else{
	     $condition1="";
	}
	$class_type=$_GET['class2'];
	if($class_type!='All'){
	    $condition2=" and student_class='$class_type'";
	}else{
	    $condition2="";
	}
	$sql_section="select student_name from student_admission_info where student_status='Tc_issued'$condition1$condition2$filter37";
	$run2=mysqli_query($conn73,$sql_section);
	if(mysqli_num_rows($run2)>0){
	while($result2=mysqli_fetch_assoc($run2)){
		$student_name=$result2['student_name'];
		echo "<option value='$student_name'>$student_name</option>";
	
}
}else{
		echo "<option value=''>No Data</option>";
	}
?>