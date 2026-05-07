<?php include("../attachment/session.php");

include("../../con73/con37.php");
if(isset($_POST['submit'])){

$student_class1= $_POST['student_class'];
if($student_class1!='All'){
$student_class2=explode('|?|',$student_class1);
$student_class=$student_class2[1];
$class_code=$student_class2[0];
$class_condition=" and student_admission_info.student_class='$student_class'";
}else{
$class_condition="";
}
$student_section= $_POST['student_section'];
if($student_section!='All'){
$condition=" and student_admission_info.student_class_section='$student_section'";
}else{
$condition="";
}
$student_category1= $_POST['student_category'];
if($student_category1!='All'){
$student_category2=explode('|?|',$student_category1);
$student_category=$student_category2[1];
$category_code=$student_category2[0];
$category_condition=" and student_admission_info.student_fee_category_code='$category_code'";
}else{
$category_condition="";
}
$student_status= $_POST['student_status'];
if($student_status!='All'){
if($student_status=='Normal'){
$status_condition=" and student_admission_info.student_status='Active' and student_admission_info.registration_final='yes'";
}elseif($student_status=='Left'){
$status_condition=" and student_admission_info.student_status='Deleted' and student_admission_info.registration_final='yes'";
}elseif($student_status=='TC'){
$status_condition=" and student_admission_info.student_status='Tc_issued' and student_admission_info.registration_final='yes'";
}
}else{
$status_condition="";
}

$student_data= $_POST['student_data'];
$count= count($student_data);
$heading_array=array();
$value_array='';
for($i=0;$i<$count;$i++){
$student_data1=explode(',',$student_data[$i]);
$student_data[$i];
$student_data_value=$student_data1[0];
$student_data_heading=$student_data1[1];
if($i==0){
$heading_array[$i]=$student_data_heading;
$value_array=$value_array."$student_data_value";
}else{
$heading_array[$i]=$student_data_heading;
$value_array=$value_array.",$student_data_value";
}
}


$school_query1="select * from school_info_general";
$school_result1=mysqli_query($conn73,$school_query1)or die(mysqli_error($conn73));
if(mysqli_num_rows($school_result1)>0){
while($school_row1=mysqli_fetch_assoc($school_result1)){
$school_info_school_name=$school_row1['school_info_school_name'];
$school_info_school_district=$school_row1['school_info_school_district'];
}
}else{
$school_info_school_name="";
$school_info_school_district="";
}

$filename = tempnam(sys_get_temp_dir(), "csv");
$file = fopen($filename,"w");
$heading_val[]="                                                                                                                               ".$school_info_school_name;
fputcsv($file,$heading_val);
$session11=explode('_',$session1);
$heading_val2[]="                                                                                                                                                   Session ".$session11[0].' - '.$session11[1];
fputcsv($file,$heading_val2);
$heading_val3[]="                                                                                                                                REPORT NAME (FEE CONCESSION REPORT)";
fputcsv($file,$heading_val3);
$current_date=date('d/m/Y');
$heading_val4[]="Date : ".$current_date;
fputcsv($file,$heading_val4);

$heading_val1[]="";
fputcsv($file,$heading_val1);

// Write column names
$fieldArray=array($heading_array);
fputcsv($file,$heading_array);

  $qur23="select $value_array from student_admission_info join student_hostel_fees_discount on student_admission_info.student_roll_no=student_hostel_fees_discount.student_roll_no where student_admission_info.session_value='$session1'$category_condition$class_condition$condition$status_condition and student_hostel_fees_discount.session_value='$session1'";
 $result = mysqli_query($conn73,$qur23);
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
//while($row=mysqli_fetch_assoc($result)){
//print_r($row);die;
    $dataArray[$i] = mysql_fetch_assoc($result);
	
	
	//}
}
if(empty($dataArray)){
//header('location:student_admission_list.php');
//echo "<script>alert_new('date not found in choosen class')</script>";
//echo "<script>window.open('account_expense_info.php','_self')</script>";
	}else{
foreach ($dataArray as $line) {
    fputcsv($file,$line);
}

fclose($file);

header("Content-Type: application/csv");
header("Content-Disposition: attachment;Filename= Fee Concession Report.csv");

// send file to browser
readfile($filename);
unlink($filename);
}

}
?>
