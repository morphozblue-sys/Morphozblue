<?php include("../attachment/session.php"); ?>
<?php
 $roll=$_GET['roll'];
   
 $sql="select * from student_admission_info where student_roll_no='$roll' and session_value='$session1' ";
    $query=mysqli_query($conn73,$sql);
	if(mysqli_num_rows($query)>0){
  while($row=mysqli_fetch_assoc($query)){
    $student_name=$row['student_name'];
    $student_father_name=$row['student_father_name'];
    $student_date_of_birth=$row['student_date_of_birth'];
    $student_gender=$row['student_gender'];
    $student_handicapped=$row['student_handicapped'];
    $student_religion=$row['student_religion'];
    $student_category=$row['student_category'];
    $student_adhar_number=$row['student_adhar_number'];
    $student_class=$row['student_class'];
    $student_father_contact_number=$row['student_father_contact_number'];
    $student_father_email_id=$row['student_father_email_id'];
    $student_mother_name=$row['student_mother_name'];
    $student_mother_contact_number=$row['student_mother_contact_number'];
    $student_contact_number=$row['student_contact_number'];
    $student_email_id=$row['student_email_id'];
    $student_photo=$row['student_photo_blob'];
    }
	echo $student_name.'|?|'.$student_father_name.'|?|'.$student_photo.'|?|'.$student_date_of_birth.'|?|'.$student_gender.'|?|'.$student_handicapped.'|?|'.$student_religion.'|?|'.$student_category.'|?|'.$student_adhar_number.'|?|'.$student_class.'|?|'.$student_father_contact_number.'|?|'.$student_father_email_id.'|?|'.$student_mother_name.'|?|'.$student_mother_contact_number.'|?|'.$student_contact_number.'|?|'.$student_email_id;
	}else{
	echo '|?||?||?||?||?||?||?||?||?||?||?||?||?||?||?|';
	}
?>