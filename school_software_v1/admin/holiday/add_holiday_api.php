<?php include("../attachment/session.php");

$holiday_name=$_POST['holiday_name'];
$date_1 = $_POST['date'];
$date_2 = explode("-",$date_1);
$date=$date_2[2]."-".$date_2[1]."-".$date_2[0];
$description=$_POST['description'];

 $day=date("l",strtotime($date));
 $year=date("Y",strtotime($date));
  
 $path_to_fcm = "https://fcm.googleapis.com/fcm/send";
    


$query="insert into holiday_manage (holiday_name,holiday_date,holiday_date_new,holiday_day,holiday_month,holiday_year,holiday_description,session_value,$update_by_insert_sql_column) values ('$holiday_name','$date','$date_1','$day','$date_2[1]','$year','$description','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>
