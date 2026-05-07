<?php include("../attachment/session.php");

$query1="SHOW COLUMNS from student_admission_info";
$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($res)){
$column_name[]=$row['Field'];
}
$student_id_generate=1452;
 $query1="SELECT * FROM `student_admission_info1` WHERE student_admission_type!='' and student_status!='Deleted'";
$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($res)){
    $s_no_hidden=$row1['s_no'];
    $student_id_generate=$student_id_generate+1;
     $insert_column="";
    $insert_value="";
    $query11="select * from student_admission_info1 where s_no=$s_no_hidden";
$res1=mysqli_query($conn73,$query11) or die(mysqli_error($conn73));
while($row11=mysqli_fetch_assoc($res1)){
  for($c=1;$c<count($column_name);$c++){
      $column_name1=$column_name[$c];
      if($column_name1!='student_bus_route'){
$column_value=my_validation($row11[$column_name1]);
if($column_name1=='student_id_generate'){
  $column_value= $student_id_generate; 
}
if($column_name1=='student_roll_no'){
  $column_value= "220".$student_id_generate; 
}



if($c==1){
$insert_column=$insert_column."$column_name1";
$insert_value=$insert_value."'$column_value'";
}else{
$insert_column=$insert_column.",$column_name1";
$insert_value=$insert_value.",'$column_value'";    
}
}
}
}
echo $queuu="insert into student_admission_info($insert_column)values($insert_value)";
 mysqli_query($conn73,$queuu);



}