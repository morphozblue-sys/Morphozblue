<?php
include("../attachment/session.php"); 

    $query1="SHOW COLUMNS from 	school_info_installmentwise_transport_fees";
$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($res)){
$column_name[]=$row['Field'];
}
 
  $query1="select * from 	school_info_installmentwise_transport_fees where session_value='2021_22'";
$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($res)){
     $insert_column="";
    $insert_value="";
  for($c=1;$c<count($column_name);$c++){
      $column_name1=$column_name[$c];
$column_value=my_validation($row1[$column_name1]);
if($column_name1=='session_value'){
  $column_value= "2022_23"; 
}
if($c==1){
$insert_column=$insert_column."$column_name1";
$insert_value=$insert_value."'$column_value'";
}else{
$insert_column=$insert_column.",$column_name1";
$insert_value=$insert_value.",'$column_value'";    
}
}



echo $queuu="insert into 	school_info_installmentwise_transport_fees($insert_column)values($insert_value)";
 mysqli_query($conn73,$queuu);
 }
 
  