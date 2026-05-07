<?php include("../attachment/session.php");
$student_index=$_POST['student_index'];
$student_name=$_POST['student_name'];
$student_father_name=$_POST['student_father_name'];
$student_mother_name=$_POST['student_mother_name'];
$student_date_of_admission=$_POST['student_date_of_admission'];
$student_date_of_birth=$_POST['student_date_of_birth'];
$student_admission_number=$_POST['student_admission_number'];
$student_scholar_number=$_POST['student_scholar_number'];
$student_admission_class=$_POST['student_admission_class'];
$student_roll_no=$_POST['student_roll_no'];
$student_category=$_POST['student_category'];
$blank_field_4=$_POST['blank_field_4'];
$student_gender=$_POST['student_gender'];
$student_bus=$_POST['student_bus'];
$student_address=$_POST['student_address'];
$school_roll_no=$_POST['school_roll_no'];
$student_blood_group=$_POST['student_blood_group'];
$student_class_stream=$_POST['student_class_stream'];
$student_class_group=$_POST['student_class_group'];
$student_caste=$_POST['student_caste'];

$student_bus_route=$_POST['student_bus_route'];
$student_bus_no=$_POST['student_bus_no'];
$student_admission_scheme=$_POST['student_admission_scheme'];
$student_religion=$_POST['student_religion'];
$student_medium=$_POST['student_medium'];

$student_fee_category=$_POST['student_fee_category'];
$bus_fee_category_name=$_POST['bus_fee_category_name'];
$student_father_contact_number=$_POST['student_father_contact_number'];
$student_identity_category=$_POST['student_identity_category'];
$student_class_section=$_POST['student_class_section'];
$bpl_card_no=$_POST['bpl_card_no'];
$income_certificate_no=$_POST['income_certificate_no'];
$caste_certificate_no=$_POST['caste_certificate_no'];
$count1=count($student_index);

for($i=0;$i<$count1;$i++){
$index11=$student_index[$i];
if($student_fee_category[$index11]!=''){
$student_fee_category1=explode('|?|',$student_fee_category[$index11]);
$student_fee_category_name=$student_fee_category1[0];
$student_fee_category_code=$student_fee_category1[1];
}else{
$student_fee_category_name='';
$student_fee_category_code='';
}
if($bus_fee_category_name[$index11]!=''){
$bus_fee_category1=explode('|?|',$bus_fee_category_name[$index11]);
$student_bus_fee_category=$bus_fee_category1[0];
$student_bus_fee_category_code=$bus_fee_category1[1];
}else{
$student_bus_fee_category='';
$student_bus_fee_category_code='';
}


$query="update student_admission_info set student_medium='$student_medium[$index11]',student_name='$student_name[$index11]',student_father_name='$student_father_name[$index11]',student_mother_name='$student_mother_name[$index11]',student_date_of_admission='$student_date_of_admission[$index11]',student_date_of_birth='$student_date_of_birth[$index11]',student_admission_number='$student_admission_number[$index11]',student_scholar_number='$student_scholar_number[$index11]',student_admission_scheme='$student_admission_scheme[$index11]',student_admission_class='$student_admission_class[$index11]',student_category='$student_category[$index11]',blank_field_4='$blank_field_4[$index11]',student_gender='$student_gender[$index11]',student_fee_category='$student_fee_category_name',student_fee_category_code='$student_fee_category_code',student_bus_fee_category='$student_bus_fee_category',student_bus_fee_category_code='$student_bus_fee_category_code',student_bus='$student_bus[$index11]',student_bus_no='$student_bus_no[$index11]',student_bus_route='$student_bus_route[$index11]',student_father_contact_number='$student_father_contact_number[$index11]',student_identity_category='$student_identity_category[$index11]',house_name='$student_identity_category[$index11]',student_class_section='$student_class_section[$index11]',$update_by_update_sql,bpl_card_no='$bpl_card_no[$index11]',income_certificate_no='$income_certificate_no[$index11]',caste_certificate_no='$caste_certificate_no[$index11]',student_adress='$student_address[$index11]',school_roll_no='$school_roll_no[$index11]',student_blood_group='$student_blood_group[$index11]',student_class_stream='$student_class_stream[$index11]',student_class_group='$student_class_group[$index11]',student_caste='$student_caste[$index11]' ,student_religion='$student_religion[$index11]' where student_roll_no='$student_roll_no[$index11]' and session_value='$session1'";
mysqli_query($conn73,$query);
$query11="update student_attendance set attendance_name='$student_name[$index11]' where attendance_roll_no='$student_roll_no[$index11]' and session_value='$session1'";
mysqli_query($conn73,$query11);
}
echo "|?|success|?|";
?>