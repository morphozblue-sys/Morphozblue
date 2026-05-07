<?php
 include("../attachment/session.php");
$fromdate1=$_GET['fromdate'];
$date1=explode("-",$fromdate1);
$fromdate=$date1[2];
$frommonth=$date1[1];
$fromyear=$date1[0];

$start_date=$date1[0].'-'.$date1[1].'-01';
$number = date(' t ',strtotime($start_date) );

$todate1=$_GET['todate'];
$date2=explode("-",$todate1);
$todate=$date2[2];
$tomonth=$date2[1];
$toyear=$date2[0];

$end_date=$date2[0].'-'.$date2[1].'-01';
$number1 = date('t',strtotime($end_date) );

$staff_id=$_GET['staff_id'];

$month_total_days=$number;

$total_persent=0;
$total_absent=0;
$total_leave=0;
$total_holiday=0;
$total_holiday_days=0;
$holiday_days=array();
$holiday_date=array();
$total_sunday=0;
$total_working_days=0;
$total_days=0;
if($frommonth!=$tomonth){
 $query2="select * from staff_attendance where staff_id='$staff_id' and month='$frommonth' and year='$fromyear'";

$res2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($res2)){
$y=(int)$number;
for($i=(int)$fromdate; $i<=$y; $i++){
if($i<10){
 $a=$row[$i];

if($a=='P'){
$total_persent=$total_persent+1;
}elseif($a=='P/2'){
$total_absent=$total_absent+0.5;
}elseif($a=='A'){
$total_absent=$total_absent+1;
}elseif($a=='L'){
$total_leave=$total_leave+1;
}

}else{
$a=$row[$i];

if($a=='P'){
$total_persent=$total_persent+1;
}elseif($a=='P/2'){
$total_absent=$total_absent+0.5;
}elseif($a=='A'){
$total_absent=$total_absent+1;
}elseif($a=='L'){
$total_leave=$total_leave+1;
}

}
$date3=$i.'-'.$frommonth .'-'.$fromyear;
$sunday1 = date('l',strtotime($date3));
if($sunday1=="Sunday"){
$total_sunday++;
$total_holiday_days++;
$holiday_days[$total_holiday_days]="Sunday";
$holiday_date[$total_holiday_days]=$date3;
}
 $que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
         $total_holiday++;
  		 $total_holiday_days++;
$holiday_days[$total_holiday_days]= $row5['holiday_name'];
$holiday_date[$total_holiday_days]=$date3;
             }
			 $total_days++;
}

}
$query1="select * from staff_attendance where staff_id='$staff_id' and month='$tomonth' and year='$toyear'";

$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){

for($i=1;$i<=(int)$todate;$i++){


if($i<10){
$a=$row1['0'.$i];

if($a=='P'){
$total_persent=$total_persent+1;
}elseif($a=='P/2'){
$total_absent=$total_absent+0.5;
}elseif($a=='A'){
$total_absent=$total_absent+1;
}elseif($a=='L'){
$total_leave=$total_leave+1;
}

}else{
$a=$row1[$i];

if($a=='P'){
$total_persent=$total_persent+1;
}elseif($a=='P/2'){
$total_absent=$total_absent+0.5;
}elseif($a=='A'){
$total_absent=$total_absent+1;
}elseif($a=='L'){
$total_leave=$total_leave+1;
}

}
$date3=$i.'-'.$tomonth .'-'.$toyear;
$sunday1 = date('l',strtotime($date3) );
if($sunday1=="Sunday"){
$total_sunday++;
$total_holiday_days++;
$holiday_days[$total_holiday_days]="Sunday";
$holiday_date[$total_holiday_days]=$date3;
}
 $que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
         $total_holiday++;
   		 $total_holiday_days++;
$holiday_days[$total_holiday_days]= $row5['holiday_name'];
$holiday_date[$total_holiday_days]=$date3;
             }
			  $total_days++;
}

}
}elseif($frommonth==$tomonth){
 $query="select * from staff_attendance where staff_id='$staff_id' and month='$frommonth' and year='$fromyear'";

$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
$total_row=mysqli_num_rows($res);
if($total_row>0){
while($row1=mysqli_fetch_assoc($res)){

for($i=(int)$fromdate;$i<=(int)$todate;$i++){




if($i<10){
 $w='0'.$i;
 $a=$row1[$w];

if($a=='P'){
$total_persent=$total_persent+1;
}elseif($a=='P/2'){
$total_absent=$total_absent+0.5;
}elseif($a=='A'){
$total_absent=$total_absent+1;
}elseif($a=='L'){
$total_leave=$total_leave+1;
}

}else{
$w=$i;
$a=$row1[$w];

if($a=='P'){
$total_persent=$total_persent+1;
}elseif($a=='P/2'){
$total_absent=$total_absent+0.5;
}elseif($a=='A'){
$total_absent=$total_absent+1;
}elseif($a=='L'){
$total_leave=$total_leave+1;
}

}
$date3=$w.'-'.$frommonth .'-'.$fromyear;
$sunday1 = date('l',strtotime($date3) );
if($sunday1=="Sunday"){
$total_sunday++;
$total_holiday_days++;
$holiday_days[$total_holiday_days]="Sunday";
$holiday_date[$total_holiday_days]=$date3;
}
 $que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
         $total_holiday++;
		 $total_holiday_days++;
$holiday_days[$total_holiday_days]= $row5['holiday_name'];
$holiday_date[$total_holiday_days]=$date3;
    
             }
 $total_days++;
}


}
}else{
    for($i=(int)$fromdate;$i<=(int)$todate;$i++){




if($i<10){
 $w='0'.$i;
 $a='';

if($a=='P'){
$total_persent=$total_persent+1;
}elseif($a=='P/2'){
$total_absent=$total_absent+0.5;
}elseif($a=='A'){
$total_absent=$total_absent+1;
}elseif($a=='L'){
$total_leave=$total_leave+1;
}

}else{
$w=$i;
$a='';

if($a=='P'){
$total_persent=$total_persent+1;
}elseif($a=='P/2'){
$total_absent=$total_absent+0.5;
}elseif($a=='A'){
$total_absent=$total_absent+1;
}elseif($a=='L'){
$total_leave=$total_leave+1;
}

}
$date3=$w.'-'.$frommonth .'-'.$fromyear;
$sunday1 = date('l',strtotime($date3) );
if($sunday1=="Sunday"){
$total_sunday++;
$total_holiday_days++;
$holiday_days[$total_holiday_days]="Sunday";
$holiday_date[$total_holiday_days]=$date3;
}
 $que6="select * from holiday_manage where holiday_date='$date3'";
$result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
while($row5=mysqli_fetch_assoc($result)){
         $total_holiday++;
		 $total_holiday_days++;
$holiday_days[$total_holiday_days]= $row5['holiday_name'];
$holiday_date[$total_holiday_days]=$date3;
    
             }
 $total_days++;
}
    
}
}
$total_working_days=$total_days-$total_holiday-$total_sunday;
$salary_days=$total_days-$total_absent;
$total_advance=0;
echo "|?|".$total_persent."|?|".$total_absent."|?|".$total_leave."|?|".$total_holiday."|?|".$total_sunday."|?|".$total_days."|?|".$total_working_days."|?|".$holiday_days."|?|".$holiday_date."|?|".$salary_days."|?|".$month_total_days."|?|".$total_advance."|?|".$total_holiday_days;

for($x=1; $x<=$total_holiday_days; $x++){
echo "|?|".$holiday_date[$x]."|?|".$holiday_days[$x];
}

?>