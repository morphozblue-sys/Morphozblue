<?php include("../attachment/session.php");

$s_no         = $_GET['s_no']         ?? '';
$subject_code = $_GET['subject_code'] ?? '';
$class_code   = $_GET['class_code']   ?? '';
$class_name   = $_GET['class_name']   ?? '';
$subject_type = $_GET['subject_type'] ?? '';
$group_name   = $_GET['group_name']   ?? '';
$stream_name  = $_GET['stream_name']  ?? '';

if ($s_no !== '') {
    $query = "DELETE FROM school_info_subject_info WHERE s_no='$s_no'";
} else {
    $query = "DELETE FROM school_info_subject_info WHERE class_code='$class_code'
              AND subject_code='$subject_code' AND stream_name='$stream_name'
              AND group_name='$group_name'
              AND (session_value='$session1' || session_value='') $filter37";
}

if (mysqli_query($conn73, $query)) {
    echo "|?|success|?|class_name=" . $class_name . "&subject_type=" . $subject_type . "&group_name=" . $group_name . "&stream_name=" . $stream_name;
} else {
    echo "|?|error|?|";
}
?>
