<?php include("../attachment/session.php"); ?>
<?php

$period_name=$_POST['emp_name'];
$subject_preffered=$_POST['subject_preffered'];
$class_preffered=$_POST['class_preffered'];
$emp_code_hidden=$_POST['emp_code_hidden'];
$subject_preffered1="";
$class_preffered1="";
for($k=0;$k<count($subject_preffered);$k++){
    if($k==0){
        $subject_preffered1=$subject_preffered[$k];
    }else{
    $subject_preffered1=$subject_preffered1.",".$subject_preffered[$k];
    }
}
for($k=0;$k<count($class_preffered);$k++){
    if($k==0){
        $class_preffered1=$class_preffered[$k];
    }else{
    $class_preffered1=$class_preffered1.",".$class_preffered[$k];
    }
}
echo employee_info;
 $quer12="update employee_info set emp_class_preferred='$class_preffered1',emp_subject_preferred='$subject_preffered1' where s_no='$emp_code_hidden'";
if(mysqli_query($conn73,$quer12)){
echo "|?|success|?|";
}
?>