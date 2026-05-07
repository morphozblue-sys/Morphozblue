<?php
include("../attachment/session.php");
$current_date=$_GET['current_date'];
if($current_date!=''){
$current_date1=explode('-',$current_date);
$current_year=$current_date1[0];
$current_month=$current_date1[1];
$current_date1=$current_date1[2];
}else{
$current_year=date('Y');
$current_month=date('m');
$current_date1=date('d');
}
$query="select class_name,section from school_info_class_info where status='Active'";
$result=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
$three_in_one='';
$three_in_one_ser=0;
while($row=mysqli_fetch_assoc($result)){
$class_name=$row['class_name'];
$class_name111=$row['class_name'];
if(substr_count($class_name111, ' ')>0){
    $class_name111=str_replace(' ','',$class_name111);
}
$total_present='total_present_'.$class_name;
$total_absent='total_absent_'.$class_name;
$total_leave='total_leave_'.$class_name;
$not_mark='not_mark_'.$class_name;

$$total_present=0;
$$total_absent=0;
$$total_leave=0;
$$not_mark=0;

$query1="select student_id from  student_admission_info where student_class='$class_name' and student_status='Active' and session_value='$session_value'";
$result1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
$classwise_strength=0;
while($row1=mysqli_fetch_assoc($result1)){
$student_id=$row1['student_id'];
$classwise_strength++;

$query2="select * from student_attendance where month='$current_month' and year='$current_year'  and student_class='$class_name' and student_id='$student_id'";
$result2=mysqli_query($conn73,$query2)or die(mysqli_error($conn73));
if(mysqli_num_rows($result2)>0){
while($row2=mysqli_fetch_assoc($result2)){

for($i=$current_date1;$i<=$current_date1;$i++){
$attendance_column='attendance_'.$i;    
$a=$row2[$attendance_column];
if($a=='P'){
$$total_present=$$total_present+1;
}elseif($a=='P/2'){
$$total_present=$$total_present+0.5;
$$total_absent=$$total_absent+0.5;
}elseif($a=='A'){
$$total_absent=$$total_absent+1;
}elseif($a=='L'){
$$total_leave=$$total_leave+1;
}elseif($a==''){
$$not_mark=$$not_mark+1;
}
}

}
}else{
$$not_mark=$$not_mark+1;
}
}
if($three_in_one_ser==0){
$three_in_one='|??|'.$class_name111.'|?|'.$classwise_strength.'|?|'.$$total_present.'|?|'.$$total_absent.'|?|'.$$total_leave.'|?|'.$$not_mark;
}else{
$three_in_one=$three_in_one.'|??|'.$class_name111.'|?|'.$classwise_strength.'|?|'.$$total_present.'|?|'.$$total_absent.'|?|'.$$total_leave.'|?|'.$$not_mark;
}
$three_in_one_ser++;
}
echo $three_in_one;
?>