<?php
include("../attachment/session.php");
	 $student_data=$_POST['student_data'];
	 $head_count=count($student_data);
 if(mysqli_query($conn73,"DESCRIBE `student_csv`")) {
  $sql1 = "TRUNCATE TABLE student_csv";
 mysqli_query($conn73,$sql1);
     for($j=0;$j<$head_count;$j++){ 
 $query="insert into student_csv (column_name) values('$student_data[$j]')";
  mysqli_query($conn73,$query);
  }
}else{
 $sql = "CREATE TABLE student_csv(id INT(6) AUTO_INCREMENT PRIMARY KEY,column_name VARCHAR(50) NOT NULL)";
 mysqli_query($conn73,$sql);
  for($j=0;$j<$head_count;$j++){ 
 $query="insert into student_csv (column_name) values('$student_data[$j]')";
  mysqli_query($conn73,$query);
  }
}
    $filename = "student_csv_format.csv";
    $f = fopen('php://memory', 'w');
    fputcsv($f, $student_data);
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
	exit;

?>