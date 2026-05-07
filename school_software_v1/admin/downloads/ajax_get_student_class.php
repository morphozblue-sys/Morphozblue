<?php
$data2=$_GET['student_data'];
include("../attachment/session.php");
	$select_student_section="SELECT * FROM school_info_class_info WHERE class_name='$data2'";
	$run=mysqli_query($conn73,$select_student_section);
	while($result=mysqli_fetch_assoc($run))
	{
	$section=$result['section'];
	if($section=='1')
	{
		echo "<option value='A'>A</option>";
	}
	else if($section=='2')
	{
		echo "<option value='A'>A</option>";
		echo "<option value='B'>B</option>";
	}
	else if($section=='3')
	{
		echo "<option value='A'>A</option>";
		echo "<option value='B'>B</option>";
		echo "<option value='C'>C</option>";
	}
	else if($section=='4')
	{
		echo "<option value='A'>A</option>";
		echo "<option value='B'>B</option>";
		echo "<option value='C'>C</option>";
		echo "<option value='D'>C</option>";
	}
	}
?>