<?php include("../attachment/session.php");

$student_class_code  = $_GET['class_name']          ?? '';
$group_name          = $_GET['group_name']           ?? '';
$stream_name         = $_GET['stream_name']          ?? '';
$subject_name        = $_GET['subject_name']         ?? '';
$subject_name_hindi  = $_GET['subject_name_hindi']   ?? '';
$subject_code        = $_GET['subject_code']         ?? '';
$subject_type        = $_GET['subject_type']         ?? '';

$parts           = explode('_', $student_class_code);
$class_name      = $parts[0] ?? '';
$class_name_hindi = $parts[1] ?? '';
$class_code      = $parts[2] ?? '';

if ($stream_name === '') {
    $stream_code = '';
} else {
    $stream_code = '';
    $que1 = "SELECT stream_code FROM school_info_stream_info WHERE stream_name='$stream_name'";
    $run1 = mysqli_query($conn73, $que1);
    if ($run1 && $row1 = mysqli_fetch_assoc($run1)) {
        $stream_code = $row1['stream_code'];
    }
}

$student_medium = $_SESSION['medium_change'] ?? '';
$student_board  = $_SESSION['board_change']  ?? '';

$sno_r   = mysqli_query($conn73, "SELECT MAX(s_no) AS m FROM school_info_subject_info");
$sno_row = mysqli_fetch_assoc($sno_r);
$new_sno = (int)($sno_row['m'] ?? 0) + 1;

$quer = "INSERT INTO school_info_subject_info
         (s_no,class,class_name_hindi,class_code,subject_name,subject_name_hindi,
          subject_code,subject_type,stream_name,group_name,stream_code,
          session_value,student_medium,medium,board,$update_by_insert_sql_column)
         VALUES
         ('$new_sno','$class_name','$class_name_hindi','$class_code',
          '$subject_name','$subject_name_hindi','$subject_code','$subject_type',
          '$stream_name','$group_name','$stream_code',
          '$session1','$student_medium','$student_medium','$student_board',
          $update_by_insert_sql_value)";

if (mysqli_query($conn73, $quer)) {
    echo "|?|success|?|stream_name=" . $stream_name . "&subject_type=" . $subject_type . "&group_name=" . $group_name . "&class_name=" . $student_class_code . "|?|";
} else {
    echo "|?|error|?|" . mysqli_error($conn73);
}
?>
