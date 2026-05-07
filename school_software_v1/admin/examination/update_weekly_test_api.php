<?php include("../attachment/session.php");
$test_name=$_POST['test_name'];
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$s_no_hidden=$_POST['s_no_hidden'];
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

$quer="update weekly_test_info set test_name='$test_name',from_date='$from_date',to_date='$to_date',test_description='$test_description',test_subjects='$col_value' where s_no='$s_no_hidden'";
if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>