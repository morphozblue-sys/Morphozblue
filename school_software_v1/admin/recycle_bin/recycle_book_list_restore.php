<?php
include("../../con73/con37.php");
include("../attachment/session.php");

$delete_record=$_GET['id'];
$date=date('Y/m/d');
$query="update school_library_book set school_library_book_status='Active',$update_by_update_sql  where id='$delete_record' AND session_value='$session1'";

if(mysqli_query($conn73,$query)){

	echo "<script>window.open('recycle_library_book_list.php','_self')</script>";
}
?>
