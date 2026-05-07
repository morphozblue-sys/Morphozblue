<?php
include("../attachment/session.php");
$class=$_GET['s_class'];
$subject=$_GET['subject'];

$que="select * from question_book where class_name='$class' and subject_name='$subject'";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
?>
 <option value="">Select</option>
<?php 
while($row=mysqli_fetch_assoc($run)){

	$question_book=$row['book_name'];
	?>
	<option value="<?php echo $question_book; ?>"><?php echo $question_book; ?></option>
	<?php
}
}	
?>