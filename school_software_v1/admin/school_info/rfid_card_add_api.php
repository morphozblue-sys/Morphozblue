<?php include("../attachment/session.php");
$rfid_no=$_POST['rfid_no'];
 $que1="insert into school_info_rfid_card(rfid_no) values('$rfid_no')";
mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
echo "|?|success|?|";
?>

