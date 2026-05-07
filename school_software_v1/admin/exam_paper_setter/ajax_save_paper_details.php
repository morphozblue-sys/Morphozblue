<?php

$paper_unique_id=$_GET['p_id'];

$question_class=$_GET['q_class'];
$question_subject=$_GET['question_subject'];
$question_exam_type=$_GET['question_exam_type'];
$question_type=$_GET['question_type'];
$total_question=$_GET['total_question'];
$total_question_marks=$_GET['total_question_marks'];
$total_count=$_GET['total_count'];
for($i=0;$i<$total_count;$i++){

$total_question1=explode(",",$total_question);
$question_marks1=explode(",",$total_question_marks);

$query="insert into question_paper_set(paper_unique_id,question_s_no,question_marks,question_type,exam_type,question_class,question_subject,total_question,session_value,$update_by_insert_sql_column) values('$paper_unique_id','$total_question1[$i]','$question_marks1[$i]','$question_type','$question_exam_type','$question_class','$question_subject','$total_count','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query)){
echo "<script>window.open('set_paper.php','_self');</script>";
}
}
?>