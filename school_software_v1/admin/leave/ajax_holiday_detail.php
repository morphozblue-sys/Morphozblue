<?php include("../attachment/session.php"); ?>
<?php 
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$leave_from_date_2 = explode("-",$from_date);
$leave_to_date_2 = explode("-",$to_date);
 $from_date=$leave_from_date_2[2];
  $from_month=$leave_from_date_2[1];
  $from_year=$leave_from_date_2[0];
  $to_date=$leave_to_date_2[2];
  $to_month=$leave_to_date_2[1];
  $to_year=$leave_to_date_2[0];
  $total_days=0;
  $total_leave=0;
  $total_sunday=0;
  $total_holiday=0;
 
if($from_month==$to_month){  
$date21=$from_year.'-'.$from_month.'-01';
$number = date(' t ', strtotime($date21) );
for($x=(int)$from_date; $x<=(int)$to_date; $x++){
$real_leave=0;
 $total_days++;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
 $total_sunday++;
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$total_holiday++;
$real_leave=1;
     }
}
if($real_leave==0){
$total_leave++;
}
}
}else{  
$date21=$from_year.'-'.$from_month.'-01';
$number = date(' t ', strtotime($date21) );
for($x=(int)$from_date; $x<=(int)$number; $x++){
$real_leave=0;
 $total_days++;
$date3=$x.'-'.$from_month .'-'.$from_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
 $total_sunday++;
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$total_holiday++;
$real_leave=1;
     }
}
if($real_leave==0){
$total_leave++;
}
}
for($x=1; $x<=(int)$to_date; $x++){
$real_leave=0;
 $total_days++;
$date3=$x.'-'.$to_date .'-'.$to_year;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
 $total_sunday++;
$real_leave=1;
}else{
$que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
$total_holiday++;
$real_leave=1;
     }
}
if($real_leave==0){
$total_leave++;
}
}
}
echo $total_leave."|?|".$total_sunday."|?|".$total_holiday;
			
?>