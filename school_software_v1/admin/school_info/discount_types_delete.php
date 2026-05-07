
<?php
include("../../con73/con37.php");

$delete_record=$_GET['id'];
$que="select * from school_info_discount_types where s_no='$delete_record'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$row=mysqli_fetch_assoc($run);
$discount_type = $row['discount_type'];
 $discount_type=strtolower($discount_type);
   $discount_type = preg_replace('/\s+/', '_', $discount_type);
			 $discount_method=$discount_type."_discount_method";
			 $discount_amount=$discount_type."_discount_amount";
$query1="ALTER TABLE fees_discount_types_structure DROP `$discount_amount`,DROP `$discount_method`";
 mysqli_query($conn73,$query1); 

$query="delete from school_info_discount_types where s_no='$delete_record'";
if(mysqli_query($conn73,$query)){

	echo "<script>window.open('discount_types_add.php','_self')</script>";
}
?>