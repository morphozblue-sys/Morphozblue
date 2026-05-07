<?php include("../attachment/session.php");
$id           = $_GET['id'];
$stream_group = (int)$_GET['stream_group'];
$stream_code  = $_GET['stream_code'];

if ($stream_group <= 0) {
    echo "|?|error|?|";
    exit;
}

$grp_letters = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U'];
$section_value = 'Group-' . ($grp_letters[$stream_group - 1] ?? '');

$new_group = $stream_group - 1;
$query1 = "delete from school_info_stream_group where group_name='$section_value' and stream_code='$stream_code'";
mysqli_query($conn73, $query1);

$query = "update school_info_stream_info set stream_group='$new_group',$update_by_update_sql where s_no='$id'";
if (mysqli_query($conn73, $query)) {
    echo "|?|success|?|";
} else {
    echo "|?|error|?|";
}
?>
