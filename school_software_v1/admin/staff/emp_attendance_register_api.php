<?php include("../attachment/session.php"); ?>
<?php

$emp_id=$_POST['emp_id'];
$emp_name=$_POST['emp_name'];
$emp_attendance_register=$_POST['emp_attendance_register'];
$emp_index=$_POST['emp_index'];
$count1=count($emp_index);
$res=0;
for($i=0;$i<$count1;$i++){
$index11=$emp_index[$i];
$query1="update employee_info set emp_attendance_register='$emp_attendance_register[$index11]' where emp_id='$emp_id[$index11]'";
if(mysqli_query($conn73,$query1)){
    $res++;
}
}
if($res>0){
echo "|?|success|?|";
}
?>