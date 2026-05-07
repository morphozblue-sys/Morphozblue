<?php include("../attachment/session.php");

$question_type=$_POST['question_type'];
$submit_type=$_POST['submit_type'];
$question_button=$_POST['book_button'];
$total_count=$_POST['total_question'];
if($submit_type=='submit' || $submit_type=='submit2'){
if($question_type=='Objective'){

$question=$_POST['question'];
$marks=$_POST['marks'];
$question_marks1=$_POST['marks'];
$option_1=$_POST['option_1'];
$option_2=$_POST['option_2'];
$option_3=$_POST['option_3'];
$option_4=$_POST['option_4'];
$option_5=$_POST['option_5'];
$correct_answer=$_POST['correct_answer'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_chapter=$_POST['question_chapter'];

if($question_button=="Add New"){
$question_book=$_POST['question_book_dropdown']; 
}
else
{
$question_book=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$question_book',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$options=$_POST['options6'];
$paper_language1=$_POST['language'];

 $que1="insert into question_objective(question,option_1,option_2,option_3,option_4,option_5,marks,correct_answer,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question','$option_1','$option_2','$option_3','$option_4','$option_5','$marks','$correct_answer','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que1);
$last_id=mysqli_insert_id($conn73);
echo "|?|success|?|";
}

if($question_type=='True_False'){


$question=$_POST['question'];
$marks=$_POST['marks'];
$question_marks1=$_POST['marks'];
$option_1=$_POST['option_1'];
$option_2=$_POST['option_2'];
$option_3=$_POST['option_3'];
$option_4=$_POST['option_4'];
$option_5=$_POST['option_5'];
$answer_1=$_POST['answer_1'];
$answer_2=$_POST['answer_2'];
$answer_3=$_POST['answer_3'];
$answer_4=$_POST['answer_4'];
$answer_5=$_POST['answer_5'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_chapter=$_POST['question_chapter'];
if($question_button=="Add New"){
$question_book=$_POST['question_book_dropdown']; 
}
else
{
$question_book=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$question_book',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$options=$_POST['options6'];
$paper_language1=$_POST['language'];


$que2="insert into question_true_false(question,option_1,option_2,option_3,option_4,option_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question','$option_1','$option_2','$option_3','$option_4','$option_5','$marks','$answer_1','$answer_2','$answer_3','$answer_4','$answer_5','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que2);
$last_id=mysqli_insert_id($conn73);
echo "|?|success|?|";
}

if($question_type=='Fill_in_the_blank'){

$question=$_POST['question'];
$marks=$_POST['marks'];
$question_marks1=$_POST['marks'];
$option_1=$_POST['option_1'];
$option_2=$_POST['option_2'];
$option_3=$_POST['option_3'];
$option_4=$_POST['option_4'];
$option_5=$_POST['option_5'];
$answer_1=$_POST['answer_1'];
$answer_2=$_POST['answer_2'];
$answer_3=$_POST['answer_3'];
$answer_4=$_POST['answer_4'];
$answer_5=$_POST['answer_5'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_chapter=$_POST['question_chapter'];
if($question_button=="Add New"){
$question_book=$_POST['question_book_dropdown']; 
}
else
{
$question_book=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$question_book',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$options=$_POST['options6'];
$paper_language1=$_POST['language'];


$que3="insert into question_fill_in_the_blank(question,option_1,option_2,option_3,option_4,option_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question','$option_1','$option_2','$option_3','$option_4','$option_5','$marks','$answer_1','$answer_2','$answer_3','$answer_4','$answer_5','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que3);
$last_id=mysqli_insert_id($conn73);
echo "|?|success|?|";
}

if($question_type=='Short_Question'){


$long_question=$_POST['long_question'];
$long_marks=$_POST['long_marks'];
$question_marks1=$_POST['long_marks'];
$long_correct_answer=$_POST['long_correct_answer'];
$long_question_class=$_POST['question_class'];
$long_question_subject=$_POST['question_subject'];
$long_question_chapter=$_POST['question_chapter'];
if($question_button=="Add New"){
$long_question_book=$_POST['question_book_dropdown']; 
}
else
{
$long_question_book=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$long_question_book',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$paper_language1=$_POST['language'];


$que4="insert into question_short(long_question,long_marks,long_correct_answer,long_question_class,long_question_subject,long_question_chapter,long_question_book,paper_language,$update_by_insert_sql_column) values('$long_question','$long_marks','$long_correct_answer','$long_question_class','$long_question_subject','$long_question_chapter','$long_question_book','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que4);
$last_id=mysqli_insert_id($conn73);
echo "|?|success|?|";
}

if($question_type=='Long_Question'){


$long_question=$_POST['long_question'];
$long_marks=$_POST['long_marks'];
$question_marks1=$_POST['long_marks'];
$long_correct_answer=$_POST['long_correct_answer'];
$long_question_class=$_POST['question_class'];
$long_question_subject=$_POST['question_subject'];
$long_question_chapter=$_POST['question_chapter'];
if($question_button=="Add New"){
$long_question_book=$_POST['question_book_dropdown']; 
}
else
{
$long_question_book=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$long_question_book',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$paper_language1=$_POST['language'];


$que5="insert into question_long(long_question,long_marks,long_correct_answer,long_question_class,long_question_subject,long_question_chapter,long_question_book,paper_language,$update_by_insert_sql_column) values('$long_question','$long_marks','$long_correct_answer','$long_question_class','$long_question_subject','$long_question_chapter','$long_question_book','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que5);
$last_id=mysqli_insert_id($conn73);
echo "|?|success|?|";
}

if($question_type=='Unseen_Passage'){

$question=$_POST['question'];
$marks=$_POST['marks'];
$question_marks1=$_POST['marks'];
$option_1=$_POST['option_1'];
$option_2=$_POST['option_2'];
$option_3=$_POST['option_3'];
$option_4=$_POST['option_4'];
$option_5=$_POST['option_5'];
$answer_1=$_POST['answer_1'];
$answer_2=$_POST['answer_2'];
$answer_3=$_POST['answer_3'];
$answer_4=$_POST['answer_4'];
$answer_5=$_POST['answer_5'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_chapter=$_POST['question_chapter'];
if($question_button=="Add New"){
$question_book=$_POST['question_book_dropdown']; 
}
else
{
$question_book=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$question_book',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$options=$_POST['options6'];
$paper_language1=$_POST['language'];


$que6="insert into question_unseen_passage(question,option_1,option_2,option_3,option_4,option_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question','$option_1','$option_2','$option_3','$option_4','$option_5','$marks','$answer_1','$answer_2','$answer_3','$answer_4','$answer_5','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";

mysqli_query($conn73,$que6);
$last_id=mysqli_insert_id($conn73);
echo "|?|success|?|";
}

if($question_type=='One_Word'){


$question=$_POST['question'];
$marks=$_POST['marks'];
$question_marks1=$_POST['marks'];
$option_1=$_POST['option_1'];
$option_2=$_POST['option_2'];
$option_3=$_POST['option_3'];
$option_4=$_POST['option_4'];
$option_5=$_POST['option_5'];
$answer_1=$_POST['answer_1'];
$answer_2=$_POST['answer_2'];
$answer_3=$_POST['answer_3'];
$answer_4=$_POST['answer_4'];
$answer_5=$_POST['answer_5'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_chapter=$_POST['question_chapter'];
if($question_button=="Add New"){
$question_book=$_POST['question_book_dropdown']; 
}
else
{
$question_book=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$question_book',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$options=$_POST['options6'];
$paper_language1=$_POST['language'];


$que7="insert into question_one_word(question,option_1,option_2,option_3,option_4,option_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question','$option_1','$option_2','$option_3','$option_4','$option_5','$marks','$answer_1','$answer_2','$answer_3','$answer_4','$answer_5','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
$last_id=mysqli_insert_id($conn73);
echo "|?|success|?|";
}

if($question_type=='Matching'){

$question=$_POST['question'];
$marks=$_POST['marks'];
$question_marks1=$_POST['marks'];
$option_1=$_POST['option_1'];
$option_2=$_POST['option_2'];
$option_3=$_POST['option_3'];
$option_4=$_POST['option_4'];
$option_5=$_POST['option_5'];
$option2_1=$_POST['option2_1'];
$option2_2=$_POST['option2_2'];
$option2_3=$_POST['option2_3'];
$option2_4=$_POST['option2_4'];
$option2_5=$_POST['option2_5'];
$answer_1=$_POST['answer_1'];
$answer_2=$_POST['answer_2'];
$answer_3=$_POST['answer_3'];
$answer_4=$_POST['answer_4'];
$answer_5=$_POST['answer_5'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_chapter=$_POST['question_chapter'];
if($question_button=="Add New"){
$question_book=$_POST['question_book_dropdown']; 
}
else
{
$question_book=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$question_book',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$options=$_POST['options6'];
$paper_language1=$_POST['language'];


  $que8="insert into question_matching(question,option_1,option_2,option_3,option_4,option_5,option2_1,option2_2,option2_3,option2_4,option2_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question','$option_1','$option_2','$option_3','$option_4','$option_5','$option2_1','$option2_2','$option2_3','$option2_4','$option2_5','$marks','$answer_1','$answer_2','$answer_3','$answer_4','$answer_5','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que8);
$last_id=mysqli_insert_id($conn73);
echo "|?|success|?|";
}

if($question_type=='Other'){


$long_question=$_POST['long_question'];
$long_marks=$_POST['long_marks'];
$question_marks1=$_POST['long_marks'];
$long_correct_answer=$_POST['long_correct_answer'];
$long_question_class=$_POST['question_class'];
$long_question_subject=$_POST['question_subject'];
$long_question_chapter=$_POST['question_chapter'];
if($question_button=="Add New"){
$long_question_book=$_POST['question_book_dropdown']; 
}
else
{
$long_question_book=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$long_question_book',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$paper_language1=$_POST['language'];


$que9="insert into question_other(long_question,long_marks,long_correct_answer,long_question_class,long_question_subject,long_question_chapter,long_question_book,paper_language,$update_by_insert_sql_column) values('$long_question','$long_marks','$long_correct_answer','$long_question_class','$long_question_subject','$long_question_chapter','$long_question_book','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que9);
echo "|?|success|?|";
}







if($submit_type=='submit'){

$paper_unique_id=$_POST['paper_unique_id'];
$question_class=$_POST['question_class'];
if($question_button=="Add New"){
$book_name=$_POST['question_book_dropdown']; 
}
else
{
$book_name=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$book_name',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
$question_subject=$_POST['question_subject'];
$question_exam_type=$_POST['question_exam_type'];
$language=$_POST['language'];

 $query="insert into question_paper_set(language,paper_unique_id,question_s_no,question_marks,question_type,exam_type,question_class,question_subject,total_question,session_value,$update_by_insert_sql_column) values('$language','$paper_unique_id','$last_id','$question_marks1','$question_type','$question_exam_type','$question_class','$question_subject','$total_count','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
}
if($submit_type=='submit2'){
$paper_unique_id=$_POST['paper_unique_id'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_exam_type=$_POST['question_exam_type'];
$language=$_POST['language'];
$question_type=$_POST['question_type'];
if($question_button=="Add New"){
$book_name=$_POST['question_book_dropdown']; 
}
else
{
$book_name=$_POST['question_book_input']; 
$que7="insert into question_book(class_name,subject_name,book_name,$update_by_insert_sql_column) values('$question_class','$question_subject','$book_name',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}



$que11="select * from question_paper_set where paper_unique_id='$paper_unique_id'";
$res11=mysqli_query($conn73,$que11);

while($row11=mysqli_fetch_assoc($res11)){
$for_or_sno=$row11['s_no'];
$question_type11=$row11['question_type'];
}

if($question_type11==$question_type){
$query="update question_paper_set set or_question_s_no='$last_id', or_question_type='$question_type',$update_by_update_sql where paper_unique_id='$paper_unique_id' and s_no='$for_or_sno'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
}else{
echo "<script>alert_new('Please Select Same Question !!!');</script>";
echo "|?|success|?|";


}
}
}




?>
