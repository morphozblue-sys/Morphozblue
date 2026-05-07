<option value="all_book">All Book</option>
<?php
$class=$_GET['s_class'];
$subject=$_GET['subject'];
$chapter=$_GET['chapter'];
$q_type=$_GET['q_type'];
$language=$_GET['language'];

if($chapter=='select_all'){
$chap= "";
$chap1= "";
$chap2= "";
$chap3= "";
$chap4= "";
$chap5= "";
$chap6= "";
$chap7= "";
$chap8= "";
}else{
$chap= " and question_chapter='$chapter'";
$chap1= " and question_chapter='$chapter'";
$chap2= " and question_chapter='$chapter'";
$chap3= " and short_question_chapter='$chapter'";
$chap4= " and long_question_chapter='$chapter'";
$chap5= " and question_chapter='$chapter'";
$chap6= " and question_chapter='$chapter'";
$chap7= " and question_chapter='$chapter'";
$chap8= " and other_question_chapter='$chapter'";
}

include("../../con73/con37.php");
if($q_type=='Objective'){
$que="select * from question_objective where question_class='$class' and paper_language='$language' and question_subject='$subject'$chap GROUP BY question_book";

$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$question_book=$row['question_book'];
	?>
	<option value="<?php echo $question_book; ?>"><?php echo $question_book; ?></option>
	<?php
}
}	
}elseif($q_type=='True_False'){
$que="select * from question_true_false where question_class='$class' and paper_language='$language' and question_subject='$subject'$chap1 GROUP BY question_book";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$question_book=$row['question_book'];
	?>
	<option value="<?php echo $question_book; ?>"><?php echo $question_book; ?></option>
	<?php
}
}
}elseif($q_type=='Fill_in_the_blank'){
$que="select * from question_fill_in_the_blank where question_class='$class' and paper_language='$language' and question_subject='$subject'$chap2 GROUP BY question_book";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$question_book=$row['question_book'];
	?>
	<option value="<?php echo $question_book; ?>"><?php echo $question_book; ?></option>
	<?php
}
}
}elseif($q_type=='Short_Question'){
$que="select * from question_short where long_question_class='$class' and paper_language='$language' and long_question_subject='$subject'$chap4 GROUP BY long_question_book";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$long_question_book=$row['long_question_book'];
	?>
	<option value="<?php echo $long_question_book; ?>"><?php echo $long_question_book; ?></option>
	<?php
}
}
}elseif($q_type=='Long_Question'){
$que="select * from question_long where long_question_class='$class' and paper_language='$language' and long_question_subject='$subject'$chap4 GROUP BY long_question_book";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$long_question_book=$row['long_question_book'];
	?>
	<option value="<?php echo $long_question_book; ?>"><?php echo $long_question_book; ?></option>
	<?php
}
}
}elseif($q_type=='Unseen_Passage'){
$que="select * from question_unseen_passage where question_class='$class' and paper_language='$language' and question_subject='$subject'$chap5 GROUP BY question_book";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$question_book=$row['question_book'];
	?>
	<option value="<?php echo $question_book; ?>"><?php echo $question_book; ?></option>
	<?php
}
}
}elseif($q_type=='One_Word'){
$que="select * from question_one_word where question_class='$class' and paper_language='$language' and question_subject='$subject'$chap6 GROUP BY question_book";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$question_book=$row['question_book'];
	?>
	<option value="<?php echo $question_book; ?>"><?php echo $question_book; ?></option>
	<?php
}
}
}elseif($q_type=='Matching'){
$que="select * from question_matching where question_class='$class' and paper_language='$language' and question_subject='$subject'$chap7 GROUP BY question_book";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$question_book=$row['question_book'];
	?>
	<option value="<?php echo $question_book; ?>"><?php echo $question_book; ?></option>
	<?php
}
}
}elseif($q_type=='Other'){
$que="select * from question_other where long_question_class='$class' and paper_language='$language' and long_question_subject='$subject'$chap4 GROUP BY long_question_book";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$long_question_book=$row['long_question_book'];
	?>
	<option value="<?php echo $long_question_book; ?>"><?php echo $long_question_book; ?></option>
	<?php
}
}
}


?>	