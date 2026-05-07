<?php
include("../attachment/session.php");

$paper_unique_id=$_POST['paper_unique_id1'];


$exam_date=$_POST['exam_date'];
$exam_date1=explode("-",$exam_date);
$exam_date2=$exam_date1[2]."-".$exam_date1[1]."-".$exam_date1[0];
$exam_time_from=$_POST['exam_time_from'];
$exam_time_to=$_POST['exam_time_to'];



$query1="update question_paper_set set exam_date='$exam_date2',exam_time_from='$exam_time_from',exam_time_to='$exam_time_to',$update_by_update_sql where  paper_unique_id='$paper_unique_id'";
if(mysqli_query($conn73,$query1)){
echo "|?|success|?|";
}


