<?php
include("../../con73/con37.php");
if(isset($_POST['submit'])){

  $category = $_POST['category']; 
 $gender = $_POST['gender'];
  $class = $_POST['std_class'];
$section = $_POST['student_class_section']; 
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
$filename = tempnam(sys_get_temp_dir(), "csv");
$file = fopen($filename,"w");

// Write column names
$fieldArray=array($heading_array);
fputcsv($file,$heading_array);
if($category!=''){
$condition1 =" and student_category='$category'";
}else{
$condition1="";
}
if($gender!=''){
$condition2 =" and student_gender='$gender'";
}else{
$condition2="";
}
if($class!=''){
$condition3 =" and student_class='$class'";
}else{
$condition3="";
}
if($section!=''){
$condition4 =" and student_class_section='$section'";
}else{
$condition4="";
}
$qur23="select $value_array from student_admission_info where student_status='Active' $condition1$condition2$condition3$condition4 "; 
 
 $result = mysqli_query($conn73,$qur23);
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $dataArray[$i] = mysqli_fetch_assoc($result);
}
if(empty($dataArray)){
//header('location:student_admission_list.php');
echo "Data not Found In this Choosen Class please choose other Class. ";
	}else{
foreach ($dataArray as $line) {
    fputcsv($file,$line);
}

fclose($file);

header("Content-Type: application/csv");
header("Content-Disposition: attachment;Filename=Total Student List.csv");

// send file to browser
readfile($filename);
unlink($filename);
}
}
?>
