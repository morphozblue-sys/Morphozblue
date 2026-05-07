<?php include("../attachment/session.php");

$id=$_POST['id123'];
$holiday_name=$_POST['holiday_name'];
$date_1 = $_POST['date'];
$date_2 = explode("-",$date_1);
$date=$date_2[2]."-".$date_2[1]."-".$date_2[0];
$holiday_description=$_POST['holiday_description'];
 
$day=date("l",strtotime($date));
$year=date("Y",strtotime($date));

$query="update holiday_manage set holiday_name='$holiday_name',holiday_date='$date',holiday_date_new='$date_1',holiday_day='$day',holiday_month='$date_2[1]',holiday_year='$year',holiday_description='$holiday_description',$update_by_update_sql where s_no='$id'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>
