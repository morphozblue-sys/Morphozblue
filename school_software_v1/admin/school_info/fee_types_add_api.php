<?php include("../attachment/session.php");

$fee_type       = $_POST['fee_type1']        ?? '';
$fee_code       = $_POST['fee_code_hidden']  ?? '';
$fee_type_hindi = $_POST['fee_type_hindi']   ?? '';

$quer = "UPDATE school_info_fee_types
         SET fee_type='$fee_type',
             fee_type_hindi='$fee_type_hindi',
             $update_by_update_sql
         WHERE fee_code='$fee_code'
           AND session_value='$session1'
           $filter37";

if (mysqli_query($conn73, $quer)) {
    echo "|?|success|?|";
} else {
    echo "|?|error|?|" . mysqli_error($conn73);
}
?>
