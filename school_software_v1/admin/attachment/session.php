<?php 
error_reporting(0);
if(!isset($_SESSION)){
session_start();
}
$box_head_color="box-success";
$con371="../../con73/con37.php";
$con372="../../../con73/con37.php";
if(file_exists($con371)){
	include($con371);
}else if(file_exists($con372)){
	include($con372);
}else{
	echo "no database";
}
$_SESSION['panel_important_ajax']='yes';
$_SESSION['panel_website_management_new']='yes';
$_SESSION['panel_stock_management_new']='yes';
$_SESSION['panel_attendance_management']='yes';

$SERVER_NAME1=$_SERVER['SERVER_NAME'];
    $SERVER_NAME12=explode('.',$SERVER_NAME1);
    $count123=count($SERVER_NAME12);
    if($count123>2){
       $path23="https://".$SERVER_NAME12[1].".com/".$SERVER_NAME12[0];       
    }
if(!isset($_SESSION['database_name1'])){
echo "<script>window.open('index.php','_self')</script>";
}
    if(isset($_GET['session_id'])){
    $session_id1=$_GET['session_id'];
if($_SESSION['session_id']!=$session_id1){
echo "<script>window.open('index.php','_self')</script>";
}
    }  
$_SESSION['panel_password_update']='yes';
$_SESSION['panel_gate_pass']='yes';	
$access_control1=$_SERVER['SCRIPT_NAME'];
$access_control2=explode('/',$access_control1);
$x=count($access_control2);
if(count($access_control2)>4){
$access_control=$access_control2[3];
$panel_name1='panel_'.$access_control;
if(isset($_SESSION[$panel_name1])){
}
else{
echo "<script>get_content('index_content')</script>";
}

}
 
if(count($access_control2)>4){
$access_control=$access_control2[4];
$access_control231=explode('.',$access_control);
$panel_name12='sub_panel_'.$access_control231[0];
if($panel_name12!=$panel_name1){
if(isset($_SESSION[$panel_name12])){
echo "<script>get_content('index_content')</script>";
}
else{

}
}

}

if(!isset($_SESSION['session37'])){
echo "<script>window.open('index.php','_self')</script>";
}

$class_fliter37='';
$session1=$_SESSION['session37'];

$school_info_school_board=$_SESSION['school_info_school_board'];
$school_info_medium=$_SESSION['school_info_medium'];
$shift=$_SESSION['shift'];


$filter37='';


$board_change=$_SESSION['board_change'];
if($board_change=='CBSE Board'){
$filter37=$filter37."and ( board='' || board='$board_change' )";
}else{
    $_SESSION['board_change']="State Board";
$filter37=$filter37."and ( board='' || board='$board_change' || board='State Board' || board='UP Board' || board='MP Board' || board='CG Board' || board='Bihar Board' || board='Rajsthan Board')";    
}

$shift_change=$_SESSION['shift_change'];
$filter37=$filter37."and ( shift='$shift_change' || shift='')";

$medium_change=$_SESSION['medium_change'];
$filter37=$filter37."and ( student_medium='$medium_change' ||  student_medium='' )";


date_default_timezone_set("Asia/Calcutta");  

$language=$_SESSION["lang"];
$session12=$_SESSION["session37"];


if($language=='Hindi'){
include("language_hindi.php");
}else{
include("language_english.php");
}
$school_software_path="../school_software_v1/";


$pdf_path="../school_software_v1/pdf/pdf/";
$pdf_database_name='';
$blob_control='';
$document_path='';
$SERVER_NAME1=$_SERVER['SERVER_NAME'];

$path2343="https://".$SERVER_NAME1."/". $_SESSION['database_name1'];
global $update_by_insert_sql_column;
global $update_by_insert_sql_value;
global $update_by_update_sql;
$update_change=$_SESSION['school_info_username5'];
$last_updated_date=date("Y-m-d H:i:s");
$update_by_insert_sql_column="update_change,last_updated_date";
$update_by_insert_sql_value="'$update_change','$last_updated_date'";
$update_by_update_sql="update_change='$update_change',last_updated_date='$last_updated_date'";
$database_file_name=$_SESSION['database_name1'];
//$file1123 = "../attachment/user_access_data/".$database_file_name.'.txt';
if(!function_exists("my_validation")) {
 function my_validation($data){
  global $conn73;
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($conn73,$data);
  return $data;  
}
}


/*
if(!is_file($file1123)){
    $contents = 'File Created';          
    file_put_contents($file1123, $contents);    
}else{
    $fp = fopen($file1123, 'a');//opens file in append mode  
    $new_conenet=$access_control2[3]."/".$access_control2[4];
$file_content=$last_updated_date."--:".$update_change."--".$new_conenet. "\n";
fwrite($fp, $file_content);  
 
fclose($fp);  
}
 if($_SESSION['password_change']!='success'){
     echo "<script>get_content('password_update/password_otp')</script>";
 }*/
 
 
 
?>