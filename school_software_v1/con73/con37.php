<?php
if(!isset($_SESSION)){
session_start();
}
//$_SESSION['amazon_file_path']="https://localhost/bluemorphoss/data-content/localhost/eps/";
//$_SESSION['image_file_path']="https://localhost/bluemorphoss/data-content/localhost/eps/";



$_SESSION['amazon_file_path']="../../../../bluemorphoz/data-content/localhost/".$_SESSION['software_link']."/";
$_SESSION['amazon_file_path1']="../../../bluemorphoz/data-content/localhost/".$_SESSION['software_link']."/";

$_SESSION['image_file_path']="../../../bluemorphoz/data-content/localhost/".$_SESSION['software_link']."/";


$_SESSION['database_name1']=$_SESSION['software_link'];
$database=$_SESSION['software_link'];
$_SESSION['database_name']=$database;


$_SESSION['database_name1']=$_SESSION['software_link'];
 $database=$_SESSION['software_link'];


$servername = "localhost";
$username = "root";
$password = "";
$database = "u851190831_eps";
// $_SESSION['database_name']=$database;


$conn73=mysqli_connect($servername, $username, $password, $database);
$conn73->set_charset('latin1');

mysqli_select_db($conn73,$database);
if (!$conn73) {
    die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set("Asia/Calcutta");

?>