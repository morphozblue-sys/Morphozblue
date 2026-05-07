<?php
$hostel_name=$_GET['value'];
include("../attachment/session.php");

$qry="select * from hostel_student_info where hostel_hostel_name='$hostel_name' and hostel_student_status='Active' GROUP BY hostel_room";

$result=mysqli_query($conn73,$qry) or die(mysqli_error($conn73));
echo "<option value=''>Select</option>";
while($row=mysqli_fetch_assoc($result)){
$s_no=$row['s_no'];
$hostel_room=$row['hostel_room'];

echo "<option value='$hostel_room'>".$hostel_room."</option>";
}
?>