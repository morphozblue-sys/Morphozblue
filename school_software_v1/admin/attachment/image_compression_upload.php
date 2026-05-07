<?php
include('../attachment/session.php');
include("../../con73/con37.php");
error_reporting(-1);
function camera_code($size,$imagename,$uploadedfile,$data_id,$column_name2,$database_table,$data_match){
    global $conn73;
$milliseconds = 1375010774123;
$datetimewithmilisecond = date("YmdHisu");
$imagename=rand(1000000,100000000)."_".$datetimewithmilisecond."_".$imagename;
if($database_table=='school_document'){
    $database_table1="school_info_general";
}elseif($database_table=='gallery'){
    $database_table1="gallery";
}elseif($database_table=='student_health'){
    $database_table1="student_medical_info";
}elseif($database_table=='homework_document'){
    $database_table1="homework_student";
}elseif($database_table=='time_table_document'){
    $database_table1="time_table";
}elseif($database_table=='tc_document'){
    $database_table1="tc_upload";
}elseif($database_table=='slider_document'){
    $database_table1="slider";
}elseif($database_table=='library_exam_stuff_document'){
    $database_table1="library_exam_stuff";
}elseif($database_table=='leave_document'){
    $database_table1="student_leave_management";
}elseif($database_table=='hostel_staff'){
    $database_table1="hostel_staff_info";
}elseif($database_table=='bus_staff_document'){
    $database_table1="bus_staff_info";
}elseif($database_table=='govt_official_other_document'){
    $database_table1="govt_official_other_info";
}elseif($database_table=='govt_official_document'){
    $database_table1="govt_official_info";
}elseif($database_table=='student_documents'){
    $database_table1="student_admission_info";
}elseif($database_table=='bus_document'){
    $database_table1="bus_details";
}elseif($database_table=='employee_document'){
    $database_table1="employee_info";
}elseif($database_table=='account_document'){
    $database_table1="account_expence_info";
}else{
    $database_table1=$database_table;
}
/*
if($database_table=='student_admission_info')
$database_table_new='student_documents';
elseif($database_table=='employee_info')
$database_table_new='employee_document';
else
$database_table_new=$database_table;
*/
$filename=$uploadedfile;
$file_path1=$_SESSION['image_file_path'].$database_table;
echo !is_dir($file_path1);
if(!is_dir($file_path1))
mkdir($file_path1,0777,true);
echo $file_path=$_SESSION['image_file_path'].$database_table."/".$imagename;
move_uploaded_file($uploadedfile,$file_path);
$column_name2=$column_name2.'_name';

$query11="update $database_table1 set `$column_name2`='$imagename' where $data_match='$data_id'";
mysqli_query($conn73,$query11) or die(mysqli_error($conn73));

}
/*
function camera_code($size,$imagename,$uploadedfile,$data_id,$column_name2,$database_table,$data_match){
    global $conn73;
    $imagename=rand(1000000,100000000)."_".$imagename;
$filename=$uploadedfile;

//$column_name2=$column_name2."_name";
//$column_name2=$column_name2;
if($database_table=='school_document'){
    $database_table1="school_info_general";
}elseif($database_table=='gallery'){
    $database_table1="gallery";
}elseif($database_table=='student_health'){
    $database_table1="student_medical_info";
}elseif($database_table=='homework_document'){
    $database_table1="homework_student";
}elseif($database_table=='time_table_document'){
    $database_table1="time_table";
}elseif($database_table=='tc_document'){
    $database_table1="tc_upload";
}elseif($database_table=='slider_document'){
    $database_table1="slider";
}elseif($database_table=='library_exam_stuff_document'){
    $database_table1="library_exam_stuff";
}elseif($database_table=='leave_document'){
    $database_table1="student_leave_management";
}elseif($database_table=='hostel_staff'){
    $database_table1="hostel_staff_info";
}elseif($database_table=='bus_staff_document'){
    $database_table1="bus_staff_info";
}elseif($database_table=='govt_official_other_document'){
    $database_table1="govt_official_other_info";
}elseif($database_table=='govt_official_document'){
    $database_table1="govt_official_info";
}elseif($database_table=='student_documents'){
    $database_table1="student_admission_info";
}elseif($database_table=='bus_document'){
    $database_table1="bus_details";
}elseif($database_table=='employee_document'){
    $database_table1="employee_info";
}elseif($database_table=='account_document'){
    $database_table1="account_expence_info";
}else{
    $database_table1=$database_table;
}


$filename=$uploadedfile;
echo $file_path1=$_SESSION['image_file_path'].$database_table_new;
if(!is_dir($file_path1))
echo mkdir($file_path1, 0777, true);
$file_path=$_SESSION['image_file_path'].$database_table_new."/".$imagename;
move_uploaded_file($uploadedfile,$file_path);
$column_name2=$column_name2.'_name';
//$column_name2=$column_name2;

echo $query11="update $database_table1 set `$column_name2`='$imagename' where $data_match='$data_id'";
mysqli_query($conn73,$query11);
} */
function getExtension($str)
{
$i = strrpos($str,".");
if (!$i)
{
return "";
}
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}


function compressImage($uploadedfile,$imagename,$widthArray)
{
$path11 = "../my_image/";
if(!is_dir($path11)){
mkdir($path11, 0777, true);
}
$ext = strtolower(getExtension($imagename));
foreach($widthArray as $newwidth)
{
if($ext=="jpg" || $ext=="jpeg" )
{
$src = imagecreatefromjpeg($uploadedfile);
}
else if($ext=="png")
{
$src = imagecreatefrompng($uploadedfile);
}
else if($ext=="gif")
{
$src = imagecreatefromgif($uploadedfile);
}
else
{
$src = imagecreatefrombmp($uploadedfile);
}

list($width,$height)=getimagesize($uploadedfile);
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename = $path11.$newwidth.'_'.$imagename;
imagejpeg($tmp,$filename,100);
imagedestroy($tmp);
return $filename;
}
}
function encrypt_url($string) {
  $key = "MAL_979805"; //key to encrypt and decrypts.
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }
   return urlencode(base64_encode($result));
}

?>