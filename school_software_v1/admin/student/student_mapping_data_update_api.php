<?php include("../attachment/session.php");
$student_index=$_POST['student_index'];
$student_name=$_POST['student_name'];
$student_father_name=$_POST['student_father_name'];
$student_mother_name=$_POST['student_mother_name'];
$student_adhar_number = $_POST['student_adhar_number'];
$student_father_adhar_card_number = $_POST['student_father_adhar_card_number'];
$student_sssmid_number = $_POST['student_sssmid_number'];
$student_family_id = $_POST['student_family_id'];
$student_child_id = $_POST['student_child_id'];
$student_father_bank_name = $_POST['student_father_bank_name'];
$student_father_bank_account_number = $_POST['student_father_bank_account_number'];
$student_father_bank_ifsc_code = $_POST['student_father_bank_ifsc_code'];
$student_bank_name = $_POST['student_bank_name'];
$student_account_number = $_POST['student_account_number'];
$student_bank_ifsc_code = $_POST['student_bank_ifsc_code'];
$student_roll_no=$_POST['student_roll_no'];
$count1=count($student_index);

for($i=0;$i<$count1;$i++){
$index11=$student_index[$i];
$query="update student_admission_info set student_name='$student_name[$index11]',student_father_name='$student_father_name[$index11]',student_mother_name='$student_mother_name[$index11]',student_adhar_number='$student_adhar_number[$index11]',student_father_adhar_card_number='$student_father_adhar_card_number[$index11]',student_sssmid_number='$student_sssmid_number[$index11]',student_family_id='$student_family_id[$index11]',student_child_id='$student_child_id[$index11]',student_father_bank_name='$student_father_bank_name[$index11]',student_father_bank_account_number='$student_father_bank_account_number[$index11]',student_father_bank_ifsc_code='$student_father_bank_ifsc_code[$index11]',student_bank_name='$student_bank_name[$index11]',student_account_number='$student_account_number[$index11]',student_bank_ifsc_code='$student_bank_ifsc_code[$index11]',$update_by_update_sql  where student_roll_no='$student_roll_no[$index11]' and session_value='$session1'";
mysqli_query($conn73,$query);
}
echo "|?|success|?|";

?>
