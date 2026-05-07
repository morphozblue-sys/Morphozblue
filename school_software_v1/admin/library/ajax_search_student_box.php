<?php
$roll=$_GET['id'];
$book_id=$_GET['book_id'];
include("../../con73/con37.php");
$chk_qry="select * from issue_book where book_id_no='$book_id' and student_roll_no='$roll' and status='Active'";
$chk_res=mysqli_query($conn73,$chk_qry)or die(mysqli_error($conn73));
if(mysqli_num_rows($chk_res)<1){
$que15="select * from student_admission_info where student_roll_no='$roll'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row15=mysqli_fetch_assoc($run15)){
$student_name=$row15['student_name'];
$student_class_section=$row15['student_class_section'];
$student_class=$row15['student_class'];
$student_class_and_section=$student_class."(".$student_class_section.")";
$student_father_name=$row15['student_father_name'];
$student_father_contact_number=$row15['student_father_contact_number'];
}
if(mysqli_num_rows($run15)>0){
$num=1;	
echo $student_name."|?|".$student_class_and_section."|?|".$student_class_section."|?|".$student_father_name."|?|".$student_father_contact_number."|?|".$num;
}
}else{
echo 0;
}
?>