<?php include("../attachment/session.php");
$id=$_GET['value'];
$que="select * from question_paper_set where paper_unique_id='$id'";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$exam_type=$row['exam_type'];
	$question_class=$row['question_class'];
	$question_subject=$row['question_subject'];
	$language=$row['language'];
}
echo " |?|".$exam_type."|?|".$question_class."|?|".$question_subject."|?|".$language;
}
?>