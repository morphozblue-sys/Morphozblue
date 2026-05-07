<?php include("../attachment/session.php")?>
<?php
$submit_type=$_POST['submit_type'];
if($submit_type=='submit'){ 

$paper_type=$_POST['paper_type'];
$paper_unique_id=$_POST['paper_unique_id'];

$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_exam_type=$_POST['question_exam_type'];
$question_type=$_POST['question_type'];
$language=$_POST['language'];
$total_question=$_POST['total_question'];
$total_question_marks=$_POST['total_question_marks'];
$total_count=$_POST['total_count'];
for($i=0;$i<$total_count;$i++){

$total_question1=explode(",",$total_question);
$question_marks1=explode(",",$total_question_marks);

$query="insert into question_paper_set(language,paper_unique_id,question_s_no,question_marks,question_type,exam_type,question_class,question_subject,total_question,session_value,$update_by_insert_sql_column) values('$language','$paper_unique_id','$total_question1[$i]','$question_marks1[$i]','$question_type','$question_exam_type','$question_class','$question_subject','$total_count','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
}

}



if($submit_type=='submit2'){

$paper_type=$_POST['paper_type'];
$paper_unique_id=$_POST['paper_unique_id'];

$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_exam_type=$_POST['question_exam_type'];
$language=$_POST['language'];
$question_type=$_POST['question_type'];
$total_question=$_POST['total_question'];
$total_question_marks=$_POST['total_question_marks'];
$total_count=$_POST['total_count'];

$que11="select * from question_paper_set where question_class='$question_class' and question_subject='$question_subject' and exam_type='$question_exam_type' and paper_unique_id='$paper_unique_id'";
$res11=mysqli_query($conn73,$que11);
if($total_count>0){
while($row11=mysqli_fetch_assoc($res11)){
$for_or_sno=$row11['s_no'];
$question_type11=$row11['question_type'];
}

for($i=0;$i<$total_count;$i++){

$total_question1=explode(",",$total_question);
$question_marks1=explode(",",$total_question_marks);
if($question_type11==$question_type){
$query="update question_paper_set set or_question_s_no='$total_question1[$i]', or_question_type='$question_type'$update_by_update_sql where question_class='$question_class' and question_subject='$question_subject' and exam_type='$question_exam_type' and paper_unique_id='$paper_unique_id' and s_no='$for_or_sno'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
}else{
echo "<script>alert_new('Please Select Same Question !!!');</script>";
echo "|?|success|?|";
}
}
}else{
echo "<script>alert_new('Please Check Question !!!');</script>";
echo "|?|success|?|";
}

}
?>
