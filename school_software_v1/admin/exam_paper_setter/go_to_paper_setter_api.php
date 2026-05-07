<?php include("../attachment/session.php");
$paper_type=$_POST['paper_type'];
if($paper_type=='new'){
$paper_unique_id2=$_POST['paper_unique_id1'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_exam_type=$_POST['question_exam_type'];
$question_exam_language=$_POST['question_exam_language'];
}
else{
$paper_unique_id2=$_POST['paper_unique_id'];
$question_class=$_POST['question_class1'];
$question_subject=$_POST['question_subject1'];
$question_exam_type=$_POST['question_exam_type1'];
$question_exam_language=$_POST['question_exam_language1'];
}

	echo "|?|success|?|u_id=".$paper_unique_id2."&class=".$question_class."&subject=".$question_subject."&e_type=".$question_exam_type."&language=".$question_exam_language."&p_type=".$paper_type;




?>
