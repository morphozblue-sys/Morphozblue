<?php include("../attachment/session.php");

include("../../con73/con37.php");
if(isset($_POST['submit'])){

$installment_number= $_POST['installment_number'];
if($installment_number!='All'){
$condition1=" and student_hostel_fees_paid.installment_no='$installment_number'";
}else{
$condition1="";
}
$verify_unverify= $_POST['verify_unverify'];
if($verify_unverify!='All'){
$condition2=" and student_hostel_fees_paid.verify='$verify_unverify'";
}else{
$condition2="";
}

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
$date_from= $_POST['date_from'];
if($date_from!=''){
$condition3=" and student_hostel_fees_paid.verification_date>='$date_from'";
}else{
$condition3="";
}
$date_to= $_POST['date_to'];
if($date_to!=''){
$condition4=" and student_hostel_fees_paid.verification_date<='$date_to'";
}else{
$condition4="";
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
if($date_from!='' && $date_to!=''){
$heading_val4[]="                                                                                                                                        REPORT NAME (RECEIVED)";
}else{
if($date_from!=''){
$heading_val4[]="                                                                                                                                        REPORT NAME (RECEIVED)";
}elseif($verify_unverify=='Yes'){
$heading_val4[]="                                                                                                                                        REPORT NAME (RECEIVED)";
}elseif($verify_unverify=='No'){
$heading_val4[]="                                                                                                                                        REPORT NAME (NOT RECEIVED)";
}else{
$heading_val4[]="                                                                                                                          REPORT NAME (RECEIVED / NOT RECEIVED)";
}
}
fputcsv($file,$heading_val4);

if($date_from!='' || $date_to!=''){
if($date_from!=''){
$date_from1=explode('-',$date_from);
$date_from=$date_from1[2].'/'.$date_from1[1].'/'.$date_from1[0];
}
if($date_to!=''){
$date_to1=explode('-',$date_to);
$date_to=$date_to1[2].'/'.$date_to1[1].'/'.$date_to1[0];
}
$heading_val3[]="Date : ".$date_from." to ".$date_to;
}else{
$heading_val3[]="Date : ";
}
fputcsv($file,$heading_val3);

$heading_val1[]="";
fputcsv($file,$heading_val1);

// Write column names
$fieldArray=array($heading_array);
fputcsv($file,$heading_array);

    $qur23="select $value_array from student_admission_info join student_hostel_fees_paid on student_admission_info.student_roll_no=student_hostel_fees_paid.student_roll_no where student_admission_info.session_value='$session1'$category_condition$class_condition$condition$condition1$condition2$condition3$condition4$status_condition ORDER BY student_hostel_fees_paid.s_no ASC"; 
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
header("Content-Disposition: attachment;Filename= Challan Report.csv");

// send file to browser
readfile($filename);
unlink($filename);
}

}
?>
