<option value="All">All Class</option>
<?php include("../attachment/session.php"); ?>
<?php
$student_company=$_GET['student_company'];
if($student_company=='All'){
$student_company="company_b";
}
include("../../con73/con37.php");
$que15="select * from school_info_class_info_$student_company where class_name!=''";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
while($row15=mysqli_fetch_assoc($run15)){
$class_name=$row15['class_name'];
$class_code=$row15['class_code'];
?>
<option value="<?php echo $class_code.'|?|'.$class_name; ?>"><?php echo $class_name; ?></option>
<?php
}
?>