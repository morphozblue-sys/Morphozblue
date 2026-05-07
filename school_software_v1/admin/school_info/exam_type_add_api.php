<?php include("../attachment/session.php");

$exam_type       = $_POST['exam_type1']        ?? '';
$exam_code       = $_POST['exam_code_hidden']  ?? '';
$exam_type_hindi = $_POST['exam_type_hindi']   ?? '';
$class_code1     = $_POST['class_code_hidden'] ?? '';

$quer = "UPDATE school_info_exam_types
         SET exam_type='$exam_type',
             exam_type_hindi='$exam_type_hindi',
             $update_by_update_sql
         WHERE exam_code='$exam_code'
           AND class_code='$class_code1'
           $filter37
           AND (session_value='$session1' OR session_value='')";

if (mysqli_query($conn73, $quer)) {
    echo "|?|success|?|";
} else {
    echo "|?|error|?|" . mysqli_error($conn73);
}
?>
