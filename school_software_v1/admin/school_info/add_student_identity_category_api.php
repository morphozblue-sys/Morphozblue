<?php include("../attachment/session.php");

$identity_category_name = $_POST['identity_category_name'] ?? '';

$sno_r   = mysqli_query($conn73, "SELECT MAX(s_no) AS m FROM school_info_identity_category");
$sno_row = mysqli_fetch_assoc($sno_r);
$new_sno = (int)($sno_row['m'] ?? 0) + 1;

$quer = "INSERT INTO school_info_identity_category
         (s_no, identity_category_name, $update_by_insert_sql_column)
         VALUES ('$new_sno', '$identity_category_name', $update_by_insert_sql_value)";

if (mysqli_query($conn73, $quer)) {
    echo "|?|success|?|";
} else {
    echo "|?|error|?|" . mysqli_error($conn73);
}
?>
