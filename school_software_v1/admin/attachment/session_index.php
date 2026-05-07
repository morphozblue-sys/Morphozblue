<?php
if(!isset($_SESSION)){
session_start();
}
$box_head_color="box-success";
$con371="../school_software_v1/con73/con37.php";
$con372="../con73/con37.php";
if(file_exists($con371)){
	include($con371);
}else if(file_exists($con372)){
	include($con372);
}else{
	echo "no database";
}

date_default_timezone_set("Asia/Calcutta"); 
	$SERVER_NAME1=$_SERVER['SERVER_NAME'];
    $SERVER_NAME12=explode('.',$SERVER_NAME1);
    $count123=count($SERVER_NAME12);
    if($count123>2){
        $path23="https://".$SERVER_NAME12[1].".com/".$SERVER_NAME12[0];
         header('Location:'.$path23); 
    }
        if(isset($_GET['session_id'])){
    $session_id1=$_GET['session_id'];
if($_SESSION['session_id']!=$session_id1){
echo "<script>window.open('index.php','_self')</script>";
}
    }  
if(!isset($_SESSION['session37'])){
echo "<script>window.open('index.php','_self')</script>";
}
if(!isset($_SESSION['user_id'])){
echo "<script>window.open('index.php','_self')</script>";
	
}
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

$session1=$_SESSION['session37'];

$language=$_SESSION["lang"];
$session12=$_SESSION["session37"];


if($language=='Hindi'){
include("language_hindi.php");
}else{
include("language_english.php");
}

$school_software_path="../school_software_v1/";
$update_change=$_SESSION['school_info_username5'];
$last_updated_date=date("Y-m-d H:i:s");

$database_file_name=$_SESSION['database_name1'];
/*
$file1123 = "attachment/user_access_data/".$database_file_name.'.txt';
if(!is_file($file1123)){
    $contents = 'File Created';          
    file_put_contents($file1123, $contents);    
}else{
$fp = fopen($file1123, 'a');//opens file in append mode 
    $new_conenet=$access_control2[3];
$file_content=$last_updated_date."--:".$update_change."--".$new_conenet. "\n";
fwrite($fp, $file_content);  
 
fclose($fp);  
}*/
?>