<?php include("../attachment/session.php");

include("../../con73/con37.php");
if(isset($_GET['student_class'])){

$student_class1= $_GET['student_class'];
if($student_class1!='All'){
$student_class2=explode('|?|',$student_class1);
$student_class=$student_class2[1];
$class_code=$student_class2[0];
$class_condition=" and student_admission_info.student_class='$student_class'";
}else{
$class_condition="";
}

$student_section= $_GET['student_section'];
if($student_section!='All'){
$section_condition=" and student_admission_info.student_class_section='$student_section'";
}else{
$section_condition="";
}
$student_category1= $_GET['category'];
if($student_category1!='All'){
$student_category2=explode('|?|',$student_category1);
$student_category=$student_category2[1];
$category_code=$student_category2[0];
$category_condition=" and student_admission_info.student_fee_category_code='$category_code'";
}else{
$category_condition="";
}
$student_status= $_GET['student_status'];
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
$installment_no= $_GET['installment'];
if($installment_no!='All'){
$installment_condition=" and student_hostel_fees_paid.installment_no='$installment_no'";
}else{
$installment_condition="";
}
$verify= $_GET['verify'];
if($verify!='All'){
$verify_condition=" and student_hostel_fees_paid.verify='$verify'";
}else{
$verify_condition="";
}
$from_date= $_GET['from_date'];
if($from_date!=''){
$condition=" and student_hostel_fees_paid.verification_date>='$from_date'";
}else{
$condition="";
}
$to_date= $_GET['to_date'];
if($to_date!=''){
$condition1=" and student_hostel_fees_paid.verification_date<='$to_date'";
}else{
$condition1="";
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
$heading_val[]="                                                          ".$school_info_school_name;
fputcsv($file,$heading_val);
$session11=explode('_',$session1);
$heading_val2[]="                                                                                  Session ".$session11[0].' - '.$session11[1];
fputcsv($file,$heading_val2);
if($from_date!='' && $to_date!=''){
$heading_val4[]="                                                                          REPORT NAME (RECEIVED)";
}else{
if($from_date!=''){
$heading_val4[]="                                                                          REPORT NAME (RECEIVED)";
}elseif($verify=='Yes'){
$heading_val4[]="                                                                          REPORT NAME (RECEIVED)";
}elseif($verify=='No'){
$heading_val4[]="                                                                        REPORT NAME (NOT RECEIVED)";
}else{
$heading_val4[]="                                                              REPORT NAME (RECEIVED / NOT RECEIVED)";
}
}
fputcsv($file,$heading_val4);
if($from_date!='' || $to_date!=''){
if($from_date!=''){
$date_from1=explode('-',$from_date);
$from_date=$date_from1[2].'/'.$date_from1[1].'/'.$date_from1[0];
}
if($to_date!=''){
$date_to1=explode('-',$to_date);
$to_date=$date_to1[2].'/'.$date_to1[1].'/'.$date_to1[0];
}
$heading_val3[]="Date : ".$from_date." to ".$to_date;
}else{
$heading_val3[]="Date : ";
}
fputcsv($file,$heading_val3);

$heading_val5=array("Student Status: $student_status");
fputcsv($file,$heading_val5);

$heading_val1[]="";
fputcsv($file,$heading_val1);

// Write column names
$fieldArray=array("Admission No","Student Name","Class","Section","Receipt No","Bus No","Amount","Contact No","Remark");
fputcsv($file,$fieldArray);

    $qur23="select student_admission_info.student_admission_number,student_admission_info.student_name,student_admission_info.student_class,student_admission_info.student_class_section,student_hostel_fees_paid.challan_no,student_admission_info.student_bus_no,student_hostel_fees_paid.penalty_amount,student_hostel_fees_paid.total_amount,student_admission_info.student_father_contact_number,student_admission_info.student_remark_4 from student_admission_info join student_hostel_fees_paid on student_admission_info.student_roll_no=student_hostel_fees_paid.student_roll_no where student_admission_info.session_value='$session1'$class_condition$section_condition$category_condition$status_condition and student_hostel_fees_paid.session_value='$session1'$installment_condition$verify_condition$condition$condition1 ORDER BY student_hostel_fees_paid.s_no ASC";
 $result = mysqli_query($conn73,$qur23);
 $arr_sno=0;
 while($row=mysqli_fetch_assoc($result)){
	$student_admission_number=$row['student_admission_number'];
	$student_name=$row['student_name'];
	$student_class=$row['student_class'];
	$student_class_section=$row['student_class_section'];
	$challan_no=$row['challan_no'];
	$student_bus_no=$row['student_bus_no'];
	$penalty_amount=$row['penalty_amount'];
	$total_amount=$row['total_amount'];
	$student_father_contact_number=$row['student_father_contact_number'];
	$student_remark_4=$row['student_remark_4'];
	$total_amount=$total_amount;
    $dataArray[$arr_sno] = array($student_admission_number,$student_name,$student_class,$student_class_section,$challan_no,$student_bus_no,$total_amount,$student_father_contact_number,$student_remark_4);
	$arr_sno++;
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
header("Content-Disposition: attachment;Filename= Summary Report.csv");

// send file to browser
readfile($filename);
unlink($filename);
}

}
?>
