<?php include("../attachment/session.php")?>
<?php
$student_old_new=$_GET['old_new'];
$student_class=$_GET['student_class'];

$que15="select * from common_fees_fee_structure where student_class='$student_class' and session_value='$session1'$filter37";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$serial_no=0;
while($row15=mysqli_fetch_assoc($run15)){
$admission_fee_for_new_student=$row15['admission_fee_for_new_student'];
$admission_fee_for_old_student=$row15['admission_fee_for_old_student'];
$serial_no++;
}

if($student_old_new=='New'){
$student_admission_fee=$admission_fee_for_new_student;
}elseif($student_old_new=='Old'){
$student_admission_fee=$admission_fee_for_old_student;
}

echo $student_admission_fee;
?>