<?php include("../attachment/session.php"); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
$from_session=$_POST['from_session'];
$to_session=$_POST['to_session'];
$table_name=$_POST['table_name'];

$sql_01 = "SHOW COLUMNS FROM $table_name";
$result_01 = mysqli_query($conn73,$sql_01) or die(mysqli_error($conn73));
while($row_01 = mysqli_fetch_array($result_01)){
 $table_column[]=$row_01['Field'];
}

$select_column="";
$comma="";
for($i=0;$i<count($table_column);$i++)
{
  if($i>0)
  {
    $select_column=$select_column.$comma.$table_column[$i];  
    $comma=",";
  }
}

$sql_check = "select * FROM $table_name where session_value='$to_session' ";
$result_check = mysqli_query($conn73,$sql_check) or die(mysqli_error($conn73));
if(mysqli_num_rows($result_check)==0){

$sql_02 = "select * FROM $table_name where session_value='$from_session' ";
$result_02 = mysqli_query($conn73,$sql_02) or die(mysqli_error($conn73));
while($row_02 = mysqli_fetch_array($result_02)){
  
  $values_insert="";
  $comma="";
  for($i=0;$i<count($table_column);$i++)
  {
    if($i>0)
    {
     if($table_column[$i]=='session_value')
     $column_values=$to_session;
     else
     $column_values=$row_02[$table_column[$i]];    
     $values_insert=$values_insert.$comma."'".$column_values."'";
     $comma=",";
    }
  }
 $inser_query=" insert into $table_name($select_column) values($values_insert) ";
 echo '<br>'.$inser_query;
 mysqli_query($conn73,$inser_query);
 echo "|?|success|?|";
}

}

?>