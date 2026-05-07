<?php include("../attachment/session.php");
$discount_type=$_POST['discount_type1'];
$discount_code=$_POST['discount_code_hidden'];
$discount_type_hindi=$_POST['discount_type_hindi'];

$quer12="update school_info_discount_types set discount_type='$discount_type',discount_type_hindi='$discount_type_hindi',$update_by_update_sql  where discount_code='$discount_code'";
  
 if(mysqli_query($conn73,$quer12)){
 echo "|?|success|?|";
 }
?>