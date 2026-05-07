<?php include("../attachment/session.php");

$que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
$run1=mysqli_query($conn73,$que1);
while($row1=mysqli_fetch_assoc($run1)){
$fees_type_name[] = $row1['fees_type_name'];	
$fees_code[] = $row1['fees_code'];
$fees_count = $row1['fees_count'];
}

$que="select * from school_info_discount_types";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
$discount_type = $row['discount_type'];
$discount_code = $row['discount_code'];
if($discount_type!=''){
$discount_method[$serial_no]=$discount_type." Discount Method";
$discount_amount[$serial_no]=$discount_type." Discount Amount";
$discount_method1[$serial_no]=$discount_code."_method_month";
$discount_amount1[$serial_no]=$discount_code."_amount_month";
$serial_no++;
}
}

$s_no=$_POST['s_no'];
$class=$_POST['class'];
$column_name="";
for($m=0;$m<$fees_count;$m++){
for($n=0;$n<$serial_no;$n++){
$discount_amount3[$n] = $_POST[$discount_amount1[$n].$fees_code[$m]];
$discount_method3[$n] = $_POST[$discount_method1[$n].$fees_code[$m]];

$column_name=$column_name.$discount_amount1[$n].$fees_code[$m]."="."'".$discount_amount3[$n]."',".$discount_method1[$n].$fees_code[$m]."="."'".$discount_method3[$n]."',";
}
}
$quer="update common_fees_discount_types_structure set $column_name class_name='$class' where s_no='$s_no'";

if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}

?>