<?php include("../attachment/session.php"); ?>
<?php
$student_class=$_GET['student_class'];

$que125="select * from school_info_class_info where class_name='$student_class'";
$run125=mysqli_query($conn73,$que125) or die(mysqli_error($conn73));
while($row125=mysqli_fetch_assoc($run125)){
$class_code=$row125['class_code'];
}

$category_code=$_GET['category_code'];

$que3="select * from bus_fee_category where bus_fee_category_code='$category_code'";
$run3=mysqli_query($conn73,$que3) or die(mysqli_error($conn73));
$bus_fee_amount=0;
while($row3=mysqli_fetch_assoc($run3)){
$bus_fee_amount = $row3[$class_code.'_amount'];
}
echo $bus_fee_amount;
?>