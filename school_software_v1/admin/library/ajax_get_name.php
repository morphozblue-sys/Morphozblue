<?php 
include("../../con73/con37.php");
 $roll=$_GET['roll'];
   
 $sql="select * from student_admission_info where student_roll_no='$roll'";
    $query=mysqli_query($conn73,$sql);
	if(mysqli_num_rows($query)>0){
  while($row=mysqli_fetch_assoc($query)){
    $student_name=$row['student_name'];
	}
	echo $student_name;
	}else{
	echo $student_name='';
	}
?>