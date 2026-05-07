<?php  
//include("../attachment/session.php");
$count=1;
$query="select * from student_admission_info_medium";
$res=mysqli_query($conn73,$query);
while($row=mysqli_fetch_assoc($res)){
$student_roll_no=$row['student_roll_no'];
$student_medium=$row['student_medium'];

$sql1="update student_admission_info set student_medium='$student_medium'where student_roll_no='$student_roll_no'";
if(mysqli_query($conn73,$sql1)){
echo $count."-Data imported";
} else {
echo "Data not imported ";
}
$count++;
}
?>