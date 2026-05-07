       <table id="" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S.No.</th>
                  <th>Student Name</th>
				  <th>Verification Date</th>
                  <th><input type="checkbox" id="top_checkbox" onclick="for_check();" > All</th>
                  <th>Change Date</th>
                  <th>Challan No</th>
                  <th>Amount</th>
                  <th><input type="checkbox" id="top_checkbox1" onclick="for_check1();" > Unverify</th>
                </tr>
                </thead>
				
				<tbody>

<?php
include("../attachment/session.php");
$from_date=$_GET['from_date'];
$to_date=$_GET['to_date'];
include("../../con73/con37.php");

if($from_date!=""){
$condition1=" and verification_date>='$from_date'";
}
else{
$condition1="";
}

if($to_date!=""){
$condition2=" and verification_date<='$to_date'";
}
else{
$condition2="";
}

$que2="select * from student_hostel_fees_paid where session_value='$session1'$condition1$condition2 ORDER BY s_no ASC";
$res2=mysqli_query($conn73,$que2);
$serial_no=0;
$serial_no1=0;
while($row2=mysqli_fetch_assoc($res2)){
$student_challan_no=$row2['challan_no'];
$student_roll_no=$row2['student_roll_no'];
$verification_date1=$row2['verification_date'];
$verification_date2=explode('-',$verification_date1);
$verification_date=$verification_date2[2].'-'.$verification_date2[1].'-'.$verification_date2[0];
$installment_no=$row2['installment_no'];
$total_amount=$row2['total_amount'];
$penalty_amount=$row2['penalty_amount'];

$query1="select * from student_admission_info where session_value='$session1' and student_roll_no='$student_roll_no'";
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$student_name=$row1['student_name'];
}

$que3="select * from student_hostel_fees_paid where session_value='$session1' and student_roll_no='$student_roll_no' and verify='Yes' and parent_challan_no='$student_challan_no'";
$res3=mysqli_query($conn73,$que3);
if(mysqli_num_rows($res3)>0){
while($row3=mysqli_fetch_assoc($res3)){
$for_disable="disabled";
}
}else{
$for_disable="";
}
$serial_no++;
?>

  
<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $verification_date; ?></td>
<td><input type="checkbox" name="student_count[]" id="<?php echo 'verification_'.$serial_no1; ?>" value="<?php echo $serial_no1; ?>" class="check_student" onclick="check_both('<?php echo $serial_no1; ?>','verification');" ></td>
<td><input type="hidden" name="student_challan_no[]" value="<?php echo $student_challan_no; ?>" class="form-control" /><input type="hidden" name="student_roll_no[]" value="<?php echo $student_roll_no; ?>" class="form-control" /><input type="hidden" name="installment_no[]" value="<?php echo $installment_no; ?>" class="form-control" /><input type="date" name="new_verification_date[]" value="<?php echo date('Y-m-d'); ?>" class="form-control" /></td>
<td><label><?php echo $student_challan_no; ?></label></td>
<td><label><?php echo $total_amount; ?></label></td>
<td><input type="checkbox" name="student_count1[]" id="<?php echo 'unverify_'.$serial_no1; ?>" value="<?php echo $serial_no1; ?>" class="<?php if($for_disable==''){ echo 'check_student1'; } ?>" onclick="check_both('<?php echo $serial_no1; ?>','unverify');" <?php echo $for_disable; ?> ></td>
</tr>
<?php $serial_no1++; } ?>
 	
		        </tbody>
				<tfoot>
				<tr>
				<td colspan="8"><center><input type="submit" name="submit" value="Submit" class="btn btn-success" /></center></td>
				</tr>
				</tfoot>
                </table>