<?php
include("../attachment/session.php");

$class_code   = $_POST['class_code_hidden'] ?? '';
$class_name   = trim($_POST['class_name1'] ?? '');
$class_hindi  = trim($_POST['class_name_hindi'] ?? '');

if ($class_code === '' || $class_name === '') {
    echo "|?|error|?|";
    exit;
}

$class_name  = mysqli_real_escape_string($conn73, $class_name);
$class_hindi = mysqli_real_escape_string($conn73, $class_hindi);
$class_code  = mysqli_real_escape_string($conn73, $class_code);

$tables = [
    "school_info_class_info"        => "class_name='$class_name',class_name_hindi='$class_hindi',$update_by_update_sql",
    "class_time_table"              => "class='$class_name',class_name_hindi='$class_hindi',$update_by_update_sql",
    "fees_discount_types_structure" => "class_name='$class_name',class_name_hindi='$class_hindi',$update_by_update_sql",
    "fees_fee_structure"            => "class_name='$class_name',class_name_hindi='$class_hindi',$update_by_update_sql",
    "exam_time_table"               => "class_name='$class_name',class_name_hindi='$class_hindi',$update_by_update_sql",
];

foreach ($tables as $tbl => $set) {
    try {
        mysqli_query($conn73, "UPDATE $tbl SET $set WHERE class_code='$class_code'");
    } catch (Exception $e) { /* non-critical */ }
}

echo "|?|success|?|";
?>
