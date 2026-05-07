<?php
include("../../con73/con37.php");

$class=$_GET['class'];



$query="delete from time_table_generate where time_table_student_class='$class'";

if(mysqli_query($conn73,$query)){

	echo "<script>window.open('time_table_list.php','_self')</script>";
}
?>