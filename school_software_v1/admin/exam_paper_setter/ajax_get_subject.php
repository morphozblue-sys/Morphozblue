<?php include("../attachment/session.php"); ?>
<option value="">Select Subject</option>
<?php
$class_name=$_GET['class_name'];
$que="select * from school_info_subject_info where class='$class_name' group by subject_name";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
$subject_name=$row['subject_name']; ?>
<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
<?php } ?>