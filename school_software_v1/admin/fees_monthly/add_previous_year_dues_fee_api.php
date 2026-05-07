<?php include("../attachment/session.php"); ?>
<?php
$index=$_POST['index'];
$student_roll_no=$_POST['student_roll_no'];
$current_total_fee=$_POST['current_total_fee'];
$current_total_fee_bal=$_POST['current_total_fee_bal'];
$previous_dues_fee=$_POST['previous_dues_fee'];

$result=0;
$count=count($index);
for($i=0;$i<$count;$i++){

$index1=$index[$i];
$new_current_total_fee=$current_total_fee[$index1]+$previous_dues_fee[$index1];
$new_current_total_fee_bal=$current_total_fee_bal[$index1]+$previous_dues_fee[$index1];

$que="update common_fees_student_fee set grand_total='$new_current_total_fee',balance_total='$new_current_total_fee_bal',student_previous_year_fee='$previous_dues_fee[$index1]',student_previous_year_fee_balance='$previous_dues_fee[$index1]',student_previous_year_fee_paid_total='0',$update_by_update_sql where student_roll_no='$student_roll_no[$index1]' and session_value='$session1' and fee_status='Active'";
if(mysqli_query($conn73,$que)){
    $result++;
}

}

if($result>0){
echo "|?|success|?|";
}
?>