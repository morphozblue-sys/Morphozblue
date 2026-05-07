<?php include("../attachment/session.php");
$test_name=$_POST['test_name'];
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$student_class=$_POST['student_class'];
$student_class_stream = $_POST['student_class_stream'];
$student_class_group=$_POST['student_class_group'];
$student_class_section=$_POST['student_class_section'];
$test_description=$_POST['test_description'];

$test_indexes=$_POST['test_indexes'];
$test_subjects=$_POST['test_subjects'];
$test_dates=$_POST['test_dates'];
$test_from_times=$_POST['test_from_times'];
$test_to_times=$_POST['test_to_times'];
$hightest_marks=$_POST['hightest_marks'];
$index_count=count($test_indexes);
$col_value="";
$seprator="";
for($i=0;$i<$index_count;$i++){
$index_val=$test_indexes[$i];
$col_value=$col_value.$seprator.$test_subjects[$index_val]."|??|".$test_dates[$index_val]."|??|".$test_from_times[$index_val]."|??|".$test_to_times[$index_val]."|??|".$hightest_marks[$index_val];
$seprator="|?|";
}

$quer="insert into weekly_test_info(test_name,from_date,to_date,student_class,student_class_stream,student_class_group,student_class_section,test_description,test_subjects,session_value,$update_by_insert_sql_column) values('$test_name','$from_date','$to_date','$student_class','$student_class_stream','$student_class_group','$student_class_section','$test_description','$col_value','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>