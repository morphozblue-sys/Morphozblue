<?php include("../attachment/session.php");
$class=$_GET['value'];

$query="select * from school_info_subject_info where class='$class' and (session_value='$session1' || session_value='') $filter37";
$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($res)){
$subject_name=$row['subject_name'];
$subject_code=$row['subject_code'];
?>
<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
<?php	}  ?>