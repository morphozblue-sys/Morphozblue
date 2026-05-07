<?php
include("../attachment/session.php");

$period_name       = $_POST['period_name']       ?? [];
$period_start_time = $_POST['period_start_time'] ?? [];
$period_end_time   = $_POST['period_end_time']   ?? [];

$count = count($period_name);
if ($count === 0) { echo "|?|error|?|"; exit; }

$added = 0;
for ($i = 0; $i < $count; $i++) {
    $nm    = strtolower(trim(mysqli_real_escape_string($conn73, $period_name[$i])));
    $start = mysqli_real_escape_string($conn73, $period_start_time[$i]);
    $end   = mysqli_real_escape_string($conn73, $period_end_time[$i]);
    if ($nm === '') continue;

    try {
        $ins = "INSERT INTO school_info_class_period(period_name,period_start_time,period_end_time,$update_by_insert_sql_column)
                VALUES('$nm','$start','$end',$update_by_insert_sql_value)";
        mysqli_query($conn73, $ins);

        $cols = "`{$nm}_subject_monday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_teacher_monday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_subject_tuesday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_teacher_tuesday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_subject_wednesday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_teacher_wednesday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_subject_thursday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_teacher_thursday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_subject_friday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_teacher_friday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_subject_saturday` VARCHAR(50) NOT NULL DEFAULT '',
                 `{$nm}_teacher_saturday` VARCHAR(50) NOT NULL DEFAULT ''";
        mysqli_query($conn73, "ALTER TABLE class_time_table ADD ($cols)");
        $added++;
    } catch (Exception $e) { /* column may already exist */ }
}

echo $added > 0 ? "|?|success|?|" : "|?|error|?|";
?>
