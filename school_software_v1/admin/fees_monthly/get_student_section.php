<option value="All">All</option>
<?php 
include("../attachment/session.php"); 
$class_name=$_GET['class_name'];
$sql=mysqli_query($conn73,"select student_class_section from student_admission_info where student_class='$class_name' group by student_class_section");
while($res=mysqli_fetch_assoc($sql)){
    $student_section=$res['student_class_section']; ?>
    <option value="<?php echo $student_section; ?>"><?php echo $student_section; ?></option>
<?php } ?> 