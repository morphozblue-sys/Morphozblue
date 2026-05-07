<?php include("../attachment/session.php");

if(isset($_SESSION)){

$s_no = $_GET['s_no'];

$query="update weekly_test_info set test_status='Deactive',$update_by_update_sql where s_no='$s_no' and session_value='$session1'";

if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}

}else{
echo "|?|session_not_set|?|";
}
?>