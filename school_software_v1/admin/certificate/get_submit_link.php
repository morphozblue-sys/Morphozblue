<?php 
include("../attachment/session.php");
if($sql3=mysqli_query($conn73,"select birth_certificate_pdf from school_info_pdf_info")){
$row3=mysqli_fetch_assoc($sql3);
$other_certificate=$row3['birth_certificate_pdf'];
if($other_certificate=='' || $other_certificate==null){
  $other_certificate="birth_certificate_pdf.php";   
}else{
  $other_certificate;  
}
}else{
 $other_certificate="birth_certificate_pdf.php";   
}

$student_roll_no=$_POST['school_roll_no']; 
echo "<br/><center><a href='".$pdf_path."certificate_page/".$other_certificate."?student_roll_no=".$student_roll_no."'  target='_blank'  class='btn my_background_color'>Submit</a>";
?>