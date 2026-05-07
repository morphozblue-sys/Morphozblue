<?php include("../attachment/session.php")?>
<?php
$question_type=$_POST['question_type2'];
$question_class=$_POST['question_class'];
$question_subject=$_POST['question_subject'];
$question_chapter=$_POST['question_chapter'];
$book_type_hidden=$_POST['book_type_hidden'];
if($book_type_hidden=='Add New'){
$question_book=$_POST['question_book_dropdown'];
}else{
	
		$question_book=$_POST['question_book_input'];
	$qret="insert into question_book (`class_name`,`subject_name`,`book_name`,$update_by_insert_sql_column) values ('$question_class','$question_subject','$question_book',$update_by_insert_sql_value)";
	mysqli_query($conn73,$qret);
}
$paper_language1=$_POST['paper_language2'];
if($question_type=='Objective'){

$question=$_POST['question'];
$marks=$_POST['marks'];
$option_1=$_POST['option_1'];
$option_2=$_POST['option_2'];
$option_3=$_POST['option_3'];
$option_4=$_POST['option_4'];
$option_5=$_POST['option_5'];
$options=$_POST['options6'];
$correct_answer=$_POST['correct_answer'];



$count1=count($question);
for($i=0; $i<$count1; $i++){
 $que1="insert into question_objective(question,option_1,option_2,option_3,option_4,option_5,marks,correct_answer,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question[$i]','$option_1[$i]','$option_2[$i]','$option_3[$i]','$option_4[$i]','$option_5[$i]','$marks[$i]','$correct_answer[$i]','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que1);
}
echo "|?|success|?|";
}


if($question_type=='True_False'){


$question=$_POST['question'];
$marks=$_POST['marks'];
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

$options=$_POST['options6'];


$count2=count($question);
for($i=0; $i<$count2; $i++){
$que2="insert into question_true_false(question,option_1,option_2,option_3,option_4,option_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question[$i]','$option_1[$i]','$option_2[$i]','$option_3[$i]','$option_4[$i]','$option_5[$i]','$marks[$i]','$answer_1[$i]','$answer_2[$i]','$answer_3[$i]','$answer_4[$i]','$answer_5[$i]','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que2);
}
echo "|?|success|?|";
}

if($question_type=='Fill_in_the_blank'){

$question=$_POST['question'];
$marks=$_POST['marks'];
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

$options=$_POST['options6'];


$count3=count($question);
for($i=0; $i<$count3; $i++){
$que3="insert into question_fill_in_the_blank(question,option_1,option_2,option_3,option_4,option_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question[$i]','$option_1[$i]','$option_2[$i]','$option_3[$i]','$option_4[$i]','$option_5[$i]','$marks[$i]','$answer_1[$i]','$answer_2[$i]','$answer_3[$i]','$answer_4[$i]','$answer_5[$i]','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que3);
}
echo "|?|success|?|";
}

if($question_type=='Short_Question'){


$long_question=$_POST['long_question'];
$long_marks=$_POST['long_marks'];
$long_correct_answer=$_POST['long_correct_answer'];


$count4=count($long_question);
for($i=0; $i<$count4; $i++){
$que4="insert into question_short(long_question,long_marks,long_correct_answer,long_question_class,long_question_subject,long_question_chapter,long_question_book,paper_language,$update_by_insert_sql_column) values('$long_question[$i]','$long_marks[$i]','$long_correct_answer[$i]','$question_class','$question_subject','$question_chapter','$question_book','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que4);
}
echo "|?|success|?|";
}

if($question_type=='Long_Question'){
$long_question=$_POST['long_question'];
$long_marks=$_POST['long_marks'];
$long_correct_answer=$_POST['long_correct_answer'];


$count5=count($long_question);
for($i=0; $i<$count5; $i++){
$que5="insert into question_long(long_question,long_marks,long_correct_answer,long_question_class,long_question_subject,long_question_chapter,long_question_book,paper_language,$update_by_insert_sql_column) values('$long_question[$i]','$long_marks[$i]','$long_correct_answer[$i]','$question_class','$question_subject','$question_chapter','$question_book','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que5);
}
echo "|?|success|?|";
}
if($question_type=='Unseen_Passage'){

$question=$_POST['question'];
$marks=$_POST['marks'];
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

$options=$_POST['options6'];


$count6=count($question);
for($i=0; $i<$count6; $i++){
$que6="insert into question_unseen_passage(question,option_1,option_2,option_3,option_4,option_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question[$i]','$option_1[$i]','$option_2[$i]','$option_3[$i]','$option_4[$i]','$option_5[$i]','$marks[$i]','$answer_1[$i]','$answer_2[$i]','$answer_3[$i]','$answer_4[$i]','$answer_5[$i]','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";

mysqli_query($conn73,$que6);
}
echo "|?|success|?|";
}

if($question_type=='One_word'){
$question=$_POST['question'];
$marks=$_POST['marks'];
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

$options=$_POST['options6'];


$count7=count($question);
for($i=0; $i<$count7; $i++){
$que7="insert into question_one_word(question,option_1,option_2,option_3,option_4,option_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question[$i]','$option_1[$i]','$option_2[$i]','$option_3[$i]','$option_4[$i]','$option_5[$i]','$marks[$i]','$answer_1[$i]','$answer_2[$i]','$answer_3[$i]','$answer_4[$i]','$answer_5[$i]','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que7);
}
echo "|?|success|?|";
}

if($question_type=='Matching'){

$question=$_POST['question'];
$marks=$_POST['marks'];
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

$options=$_POST['options6'];


$count8=count($question);
for($i=0; $i<$count8; $i++){
  $que8="insert into question_matching(question,option_1,option_2,option_3,option_4,option_5,option2_1,option2_2,option2_3,option2_4,option2_5,marks,answer_1,answer_2,answer_3,answer_4,answer_5,question_class,question_subject,question_chapter,question_book,options,paper_language,$update_by_insert_sql_column) values('$question[$i]','$option_1[$i]','$option_2[$i]','$option_3[$i]','$option_4[$i]','$option_5[$i]','$option2_1[$i]','$option2_2[$i]','$option2_3[$i]','$option2_4[$i]','$option2_5[$i]','$marks[$i]','$answer_1[$i]','$answer_2[$i]','$answer_3[$i]','$answer_4[$i]','$answer_5[$i]','$question_class','$question_subject','$question_chapter','$question_book','$options','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que8);
}
echo "|?|success|?|";
}

if($question_type=='Other'){
$long_question=$_POST['long_question'];
$long_marks=$_POST['long_marks'];
$long_correct_answer=$_POST['long_correct_answer'];


$count9=count($long_question);
for($i=0; $i<$count9; $i++){
$que9="insert into question_other(long_question,long_marks,long_correct_answer,long_question_class,long_question_subject,long_question_chapter,long_question_book,paper_language,$update_by_insert_sql_column) values('$long_question[$i]','$long_marks[$i]','$long_correct_answer[$i]','$question_class','$question_subject','$question_chapter','$question_book','$paper_language1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que9);
}
echo "|?|success|?|";
}

?>
