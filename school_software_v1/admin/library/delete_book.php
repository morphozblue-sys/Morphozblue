<?php
include("../attachment/session.php");
$delete_record=$_GET['id'];
$date=date('Y/m/d');
$query="update school_library_book set school_library_book_status='Deleted',book_status_change_date='$date',$update_by_update_sql  where id='$delete_record'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>