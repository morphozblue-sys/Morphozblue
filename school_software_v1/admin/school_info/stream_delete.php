<?php include("../attachment/session.php");
$stream_code = $_GET['stream_code'];
$quer = "update school_info_stream_info set stream_name='',stream_name_hindi='',$update_by_update_sql where stream_code='$stream_code'";
if (mysqli_query($conn73, $quer)) {
    echo "|?|success|?|";
} else {
    echo "|?|error|?|";
}
?>
