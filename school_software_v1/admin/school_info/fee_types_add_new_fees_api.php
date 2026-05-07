<?php include("../attachment/session.php");
$fee_type=$_POST['fee_type1'];
$fee_code=$_POST['fee_code_hidden'];

$quer12="update new_fees_fee_head set fee_head_name='$fee_type',$update_by_update_sql  where fee_head_code='$fee_code'";
 if(mysqli_query($conn73,$quer12)){
 echo "|?|success|?|";
 }
?>