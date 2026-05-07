<?php include("../attachment/session.php");

$sales_type = $_GET['sales_type'];
if(isset($_GET['student_customer_id1'])){
    $student_customer_id1 = $_GET['student_customer_id1'];
}else{
    $student_customer_id1 = '';
}

if($sales_type=='Student'){
?>
<option value="">Select <?php echo $sales_type; ?></option>
<?php
$qry="select * from student_admission_info where student_status='Active' and session_value='$session1'";
$rest=mysqli_query($conn73,$qry);
while($row22=mysqli_fetch_assoc($rest)){
$student_roll_no3=$row22['student_roll_no'];
$school_roll_no3=$row22['school_roll_no'];
$student_name3=$row22['student_name'];
$student_class3=$row22['student_class'];
$student_section3=$row22['student_class_section'];
$student_father_name3=$row22['student_father_name'];
$student_father_contact_number3=$row22['student_father_contact_number'];
$student_admission_number=$row22['student_admission_number'];
?>
<option <?php if($student_customer_id1==$student_roll_no3){ echo 'selected'; } ?> value="<?php echo $student_roll_no3; ?>"><?php echo $student_name3."[".$student_admission_number."]-[".$school_roll_no3."]-[".$student_class3."-".$student_section3."]-[".$student_father_name3."-".$student_father_contact_number3."]"; ?></option>
<?php
}
}elseif($sales_type=='Customer'){
?>
<option value="">Select <?php echo $sales_type; ?></option>
<?php
$que="select * from customer_detail where customer_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){
$s_no=$row['s_no'];
$customer_name=$row['customer_name'];
$customer_contact=$row['customer_contact'];
$customer_email=$row['customer_email'];
$customer_address=$row['customer_address'];
$customer_status=$row['customer_status'];
?>
<option <?php if($student_customer_id1==$s_no){ echo 'selected'; } ?> value="<?php echo $s_no; ?>"><?php echo $customer_name."[".$customer_contact."]-[".$customer_email."]"; ?></option>
<?php
}
}
?>