<?php include("../attachment/session.php"); ?>
<?php
$student_roll_no=$_GET['student_rollno'];
if($student_roll_no!=''){
$que1="select * from common_fees_student_transport_fee where student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
if(mysqli_num_rows($run1)>0){
$fee_balance2='';
while($row1=mysqli_fetch_assoc($run1)){
for($a=1;$a<=12;$a++){
        if($a<10){
                $d='0'.$a;
        }else{
                $d=$a;
        }
$fee_balance1 =$row1['transport_fee_balance_month'.$d];
$fee_balance2=$fee_balance2.'|?|'.$fee_balance1.'|??|'.$d;
}
}
echo $fee_balance2;
}else{
echo '|?|0|??|01|?|0|??|02|?|0|??|03|?|0|??|04|?|0|??|05|?|0|??|06|?|0|??|07|?|0|??|08|?|0|??|09|?|0|??|10|?|0|??|11|?|0|??|12';
}
}else{
echo '|?|0|??|01|?|0|??|02|?|0|??|03|?|0|??|04|?|0|??|05|?|0|??|06|?|0|??|07|?|0|??|08|?|0|??|09|?|0|??|10|?|0|??|11|?|0|??|12';
}
?>