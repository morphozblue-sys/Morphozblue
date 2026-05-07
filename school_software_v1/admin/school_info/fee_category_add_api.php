<?php include("../attachment/session.php");

$fee_type       = $_POST['fee_type1']        ?? '';
$fee_code       = $_POST['fee_code_hidden']  ?? '';
$fee_type_hindi = $_POST['fee_type_hindi']   ?? '';

$quer = "UPDATE school_info_fee_category
         SET category_name='$fee_type',
             category_name_hindi='$fee_type_hindi',
             $update_by_update_sql
         WHERE category_code='$fee_code'";

if (mysqli_query($conn73, $quer)) {
    echo "|?|success|?|";
} else {
    echo "|?|error|?|" . mysqli_error($conn73);
}
?>
