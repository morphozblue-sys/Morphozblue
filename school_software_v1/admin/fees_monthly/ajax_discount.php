<?php include("../attachment/session.php"); ?>  
<?php
$discount_type = $_GET['id'];
$student_class_code = $_GET['student_class_code'];
$fees_code = $_GET['fees_code'];

$que2="select * from school_info_discount_types where discount_type='$discount_type'";
$run2=mysqli_query($conn73,$que2);
while($row2=mysqli_fetch_assoc($run2)){
$discount_code = $row2['discount_code'];
}

$discount_method=$discount_code."_method_month";
$discount_amount=$discount_code."_amount_month";
if($discount_type=='None')
{
echo '|?|0|?|Rs';
}
else{
$query="select * from common_fees_discount_types_structure where class_code='$student_class_code'";
$result=mysqli_query($conn73,$query);
$num=0;
while($row=mysqli_fetch_assoc($result)){
$discount_method1 = $row[$discount_method.$fees_code];
$discount_amount1 = $row[$discount_amount.$fees_code];
$num=1;
}
if($num==1)	{	
echo "|?|".$discount_amount1."|?|".$discount_method1;
}else
{
echo '|?|0|?|Rs';
}
}
?>