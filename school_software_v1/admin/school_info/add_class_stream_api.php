<?php include("../attachment/session.php");
$stream_code_hidden=$_POST['stream_code_hidden'];
$stream_name=$_POST['stream_name1'];
$stream_name_hindi=$_POST['stream_name_hindi'];

$quer12="update school_info_stream_info set stream_name='$stream_name',stream_name_hindi='$stream_name_hindi',$update_by_update_sql  where stream_code='$stream_code_hidden'";
 if(mysqli_query($conn73,$quer12)){
 echo "|?|success|?|";
 }

?>