<?php
include("../attachment/session.php");
$delete_record=$_GET['id'];
$query="update category_detail set category_status='Deleted',$update_by_update_sql where s_no='$delete_record'";
if(mysqli_query($conn73,$query)){
        echo "|?|success|?|";
}
?>