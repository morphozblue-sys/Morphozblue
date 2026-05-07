<?php 
include("../attachment/session.php");
 $student_class = $_GET['student_class'];
 if($student_class!=''){
     $condition1=" and class='$student_class'";
 }else{
     $condition1="";
 }
 $stream_name = $_GET['stream_name'];
 if($stream_name!=''){
     $condition2=" and stream_name='$stream_name'";
 }else{
     $condition2="";
 }
 $group_name = $_GET['group_name'];
 if($group_name!=''){
     $condition3=" and group_name='$group_name'";
 }else{
     $condition3="";
 }

$query="select * from school_info_subject_info where class!='' and session_value='$session1'$condition1$condition2$condition3";
$result=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
$subject_list='';
$s_num=0;
while($row=mysqli_fetch_assoc($result)){
	$subject_name = $row['subject_name'];
	if($s_num==0){
	$subject_list=$subject_name;
	}else{
	$subject_list=$subject_list.','.$subject_name;
	}
	$s_num++;
 	}
	echo $subject_list;
?>
