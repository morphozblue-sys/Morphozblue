<?php
session_start();
$set_param=$_GET['set_param'];
$set_value=$_GET['set_value'];
$_SESSION[$set_param]=$set_value;
?>