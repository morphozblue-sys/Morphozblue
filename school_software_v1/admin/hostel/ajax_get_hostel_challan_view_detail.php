<?php
include("../attachment/session.php");
error_reporting(E_ALL & ~E_NOTICE);
include("../../con73/con37.php");

$class_code1=$_POST['class_and_code'];
if($class_code1!='All'){
$class_code2=explode('|?|',$class_code1);
$class_name=$class_code2[1];
$class_code=$class_code2[0];
$condition=" and student_class='$class_name'";
}else{
$condition="";
}
$student_class_section=$_POST['section'];
if($student_class_section!='All'){
$condition1=" and student_class_section='$student_class_section'";
}else{
$condition1="";
}
$category_code1=$_POST['category_and_code'];
if($category_code1!='All'){
$category_code2=explode('|?|',$category_code1);
$category_name=$category_code2[1];
$category_code=$category_code2[0];
$condition2=" and student_fee_category_code='$category_code'";
}else{
$condition2="";
}
$installment_number=$_POST['installment_no'];
if($installment_number=='installment1'){
$start_month=4;
$end_month=6;
}elseif($installment_number=='installment2'){
$start_month=7;
$end_month=9;
}elseif($installment_number=='installment3'){
$start_month=10;
$end_month=12;
}elseif($installment_number=='installment4'){
$start_month=1;
$end_month=3;
}
$show_all_penalty11=$_POST['show_all_penalty11'];
$remaining_amount11=$_POST['remaining_amount11'];

$query211="select * from school_info_hostel_head where fee_head_name!=''";
$result211=mysqli_query($conn73,$query211)or die(mysqli_error($conn73));
$fee_head_name='';
$fee_head_code='';
$fee_sno=0;
while($row211=mysqli_fetch_assoc($result211)){
$fee_head_name[$fee_sno]=$row211['fee_head_name'];
$fee_head_code[$fee_sno]=$row211['fee_head_code'];
$fee_sno++;
}
?>
<table id="" class="table table-bordered table-striped">
	<thead >
	<tr>
	  <td>#</td>
	  <td>Student Name</td>
	  <td>Father Name</td>
	  <td>Class</td>
	  <td>Section</td>
	  <td>Category</td>
	  <td>Challan Amount</td>
	  <td><input type="checkbox" id="all_check" onclick="for_check(this.id);" checked> All</td>
	  <td><input type="checkbox" id="all_check1" onclick="for_check(this.id);for_penalty_all(this.id);" <?php if($show_all_penalty11=='Yes'){ echo 'checked'; } ?> > Penalty</td>
	<tr>
	</thead>
	<tbody>
	<?php
	$query213="select * from student_admission_info where student_status='Active' and registration_final='yes' and student_hostel='Yes' and session_value='$session1'$condition$condition1$condition2";
	$res213=mysqli_query($conn73,$query213);
	$student_sr_no=0;
	$not_found=0;
	while($row213=mysqli_fetch_assoc($res213)){
	$student_roll_no=$row213['student_roll_no'];
	$student_name=$row213['student_name'];
	$class_name=$row213['student_class'];
	$student_father_name=$row213['student_father_name'];
	$student_class_section=$row213['student_class_section'];
	$student_hostel=$row213['student_hostel'];
	$student_fee_category=$row213['student_fee_category'];
	$student_fee_category_code=$row213['student_fee_category_code'];
	$student_sr_no++;
	
	$chk1_quer="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no' and session_value='$session1' and all_fee='Yes'";
	$all_fee_chk12='';
	$chk1_res=mysqli_query($conn73,$chk1_quer);
	while($chk1_row=mysqli_fetch_assoc($chk1_res)){
	$all_fee_chk12=$chk1_row['all_fee'];
	}
	$chk_quer="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no' and session_value='$session1' and installment_no='$installment_number'";
	$chk_res=mysqli_query($conn73,$chk_quer);
	if((mysqli_num_rows($chk_res)>0) && ($remaining_amount11=='No')){
	
	$total_amount_chk1=0;
	$penalty_amount_chk1=0;
	while($chk_row=mysqli_fetch_assoc($chk_res)){
	$total_amount_chk=$chk_row['total_amount'];
	$total_amount_chk1=$total_amount_chk1+$total_amount_chk;
	$penalty_amount_chk=$chk_row['penalty_amount'];
	$penalty_amount_chk1=$penalty_amount_chk1+$penalty_amount_chk;
	$all_fee_chk1=$chk_row['all_fee'];
	}
	$not_found++;
	?>
	<tr>
	  <td><?php echo $student_sr_no.'.'; ?></td>
	  <td><?php echo $student_name; ?></td>
	  <td><?php echo $student_father_name; ?></td>
	  <td><?php echo $class_name; ?></td>
	  <td><?php echo $student_class_section; ?></td>
	  <td><?php echo $student_fee_category; ?></td>
	  <td><?php echo $total_amount_chk1+$penalty_amount_chk1; ?>  <span style="color:#900C3F;"><b><?php if($all_fee_chk1=='Yes'){ echo 'Full Pay'; } ?></b></span></td>
	  <td><input type="checkbox" name="" class="" value="" disabled ></td>
	  <td><input type="checkbox" name="" class="" value="" disabled ></td>
	<tr>
	<?php
	
	}elseif((mysqli_num_rows($chk_res)<1) && ($remaining_amount11=='No')){

$query215="select * from student_hostel_fees_discount where student_roll_no='$student_roll_no' and session_value='$session1'";
$result215=mysqli_query($conn73,$query215)or die(mysqli_error($conn73));
$fee_discount_percentage='';
$dis_sno=0;
if(mysqli_num_rows($result215)>0){
while($row215=mysqli_fetch_assoc($result215)){
for($c=0;$c<$fee_sno;$c++){
$fee_discount_percentage[$dis_sno]=$row215[$fee_head_code[$c].'_discount_amount'];
$dis_sno++;
}
}
}else{
for($c=0;$c<$fee_sno;$c++){
$fee_discount_percentage[$dis_sno]=0;
$dis_sno++;
}
}

$query212="select * from student_hostel_fees_structure_monthly where class_name='$class_name' and category_code='$student_fee_category_code'";
$result212=mysqli_query($conn73,$query212)or die(mysqli_error($conn73));
$final_fee_installment_amount=0;
$fee_installment_amount=0;
while($row212=mysqli_fetch_assoc($result212)){
for($a=0;$a<$fee_sno;$a++){
$fee_installment_amount=0;
for($b=$start_month;$b<=$end_month;$b++){
$fee_minthly_amount=$row212[$fee_head_code[$a].'_month'.$b];
$fee_installment_amount=$fee_installment_amount+$fee_minthly_amount;
}
$fee_discount_percentage1=$fee_discount_percentage[$a];
$final_fee_installment_amount=($final_fee_installment_amount+$fee_installment_amount)-(($fee_installment_amount*$fee_discount_percentage1)/100);
}
}

$query214="select * from expense_monthly where student_roll_no='$student_roll_no' and session_value='$session1' and add_in_installment='$installment_number'";
$result214=mysqli_query($conn73,$query214)or die(mysqli_error($conn73));
$expense_total_amount=0;
while($row214=mysqli_fetch_assoc($result214)){
$total_amount=$row214['total_amount'];
$expense_total_amount=$expense_total_amount+$total_amount;
}

// This Code Is Use For Penalty Start
if($show_all_penalty11=='Yes'){
$que23="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no' and session_value='$session1'";
$run23=mysqli_query($conn73,$que23)or die(mysqli_error($conn73));
if(mysqli_num_rows($run23)>0){
while($row23=mysqli_fetch_assoc($run23)){
$installment_no23=$row23['installment_no'];
$verification_date1=$row23['verification_date'];
$verification_date=date_create($row23['verification_date']);
}
if($verification_date1=='0000-00-00'){
$verification_date2=date('Y-m-d');
$verification_date=date_create($verification_date2);
}
$que22="select * from hostel_due_date_schedule where student_due_installment='$installment_no23' and student_due_class='$class_name' and session_value='$session1'";
$run22=mysqli_query($conn73,$que22)or die(mysqli_error($conn73));
if(mysqli_num_rows($run22)>0){
while($row22=mysqli_fetch_assoc($run22)){
$student_due_date=$row22['student_due_date'];
$student_due_date1=date_create($row22['student_due_date']);
}
if($verification_date>$student_due_date1){
$diff=date_diff($verification_date,$student_due_date1);
$clear_difference=$diff->format("%a");
$due_date_month1=explode('-',$student_due_date);
$due_date_next_month=$due_date_month1[1]+1;
$day=cal_days_in_month(CAL_GREGORIAN,$due_date_next_month,$due_date_month1[0]);
if($clear_difference<=$day){
$penalty_amount22=250;
}else{
$penalty_amount22=500;
}
}else{
$penalty_amount22=0;
}
}else{
$penalty_amount22=0;
}
}else{
$penalty_amount22=0;
}
}else{
$penalty_amount22=0;
}
// This Code Is Use For Penalty End
$not_found++;
	?>
	<tr>
	  <td><?php echo $student_sr_no.'.'; ?></td>
	  <td><?php echo $student_name; ?></td>
	  <td><?php echo $student_father_name; ?></td>
	  <td><?php echo $class_name; ?></td>
	  <td><?php echo $student_class_section; ?></td>
	  <td><?php echo $student_fee_category; ?></td>
	  <td><?php echo $final_fee_installment_amount+$expense_total_amount+$penalty_amount22; ?>  <span style="color:#900C3F;"><b><?php if($all_fee_chk12=='Yes'){ echo 'Full Pay'; } ?></b></span></td>
	  <td><input type="checkbox" name="student_roll_no[]" id="<?php echo 'student_rollno_'.$student_sr_no; ?>" value="<?php echo $student_roll_no.'|?|'.$show_all_penalty11; ?>" <?php if($all_fee_chk12=='Yes'){ echo "class='' disabled"; }else{ echo "class='all_check' checked"; } ?> /></td>
	  <td><input type="checkbox" name="" id="<?php echo 'student_penalty_'.$student_sr_no; ?>" value="" onclick="for_penalty('<?php echo $student_sr_no; ?>','<?php echo $student_roll_no; ?>');" <?php if($all_fee_chk12=='Yes'){ echo "class='' disabled"; }else{ if($show_all_penalty11=='Yes'){ echo "class='all_check1' checked"; }else{ echo "class='all_check1'"; } } ?> /></td>
	<tr>
<?php
}elseif($remaining_amount11=='Yes'){
$query0215="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no' and session_value='$session1' and installment_no='$installment_number'";
$result0215=mysqli_query($conn73,$query0215)or die(mysqli_error($conn73));
$total_fee_paid_amount=0;
if(mysqli_num_rows($result0215)>0){
while($row0215=mysqli_fetch_assoc($result0215)){
$fee_paid_amount=$row0215['total_amount'];
$total_fee_paid_amount=$total_fee_paid_amount+$fee_paid_amount;
}

$query215="select * from student_hostel_fees_discount where student_roll_no='$student_roll_no' and session_value='$session1'";
$result215=mysqli_query($conn73,$query215)or die(mysqli_error($conn73));
$fee_discount_percentage='';
$dis_sno=0;
if(mysqli_num_rows($result215)>0){
while($row215=mysqli_fetch_assoc($result215)){
for($c=0;$c<$fee_sno;$c++){
$fee_discount_percentage[$dis_sno]=$row215[$fee_head_code[$c].'_discount_amount'];
$dis_sno++;
}
}
}else{
for($c=0;$c<$fee_sno;$c++){
$fee_discount_percentage[$dis_sno]=0;
$dis_sno++;
}
}

$query212="select * from student_hostel_fees_structure_monthly where class_name='$class_name' and category_code='$student_fee_category_code'";
$result212=mysqli_query($conn73,$query212)or die(mysqli_error($conn73));
$final_fee_installment_amount=0;
$fee_installment_amount=0;
while($row212=mysqli_fetch_assoc($result212)){
for($a=0;$a<$fee_sno;$a++){
$fee_installment_amount=0;
for($b=$start_month;$b<=$end_month;$b++){
$fee_minthly_amount=$row212[$fee_head_code[$a].'_month'.$b];
$fee_installment_amount=$fee_installment_amount+$fee_minthly_amount;
}
$fee_discount_percentage1=$fee_discount_percentage[$a];
$final_fee_installment_amount=($final_fee_installment_amount+$fee_installment_amount)-(($fee_installment_amount*$fee_discount_percentage1)/100);
}
}

$query214="select * from expense_monthly where student_roll_no='$student_roll_no' and session_value='$session1' and add_in_installment='$installment_number'";
$result214=mysqli_query($conn73,$query214)or die(mysqli_error($conn73));
$expense_total_amount=0;
while($row214=mysqli_fetch_assoc($result214)){
$total_amount=$row214['total_amount'];
$expense_total_amount=$expense_total_amount+$total_amount;
}

// This Code Is Use For Penalty Start
if($show_all_penalty11=='Yes'){
$que23="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no' and session_value='$session1'";
$run23=mysqli_query($conn73,$que23)or die(mysqli_error($conn73));
if(mysqli_num_rows($run23)>0){
while($row23=mysqli_fetch_assoc($run23)){
$installment_no23=$row23['installment_no'];
$verification_date1=$row23['verification_date'];
$verification_date=date_create($row23['verification_date']);
}
if($verification_date1=='0000-00-00'){
$verification_date2=date('Y-m-d');
$verification_date=date_create($verification_date2);
}
$que22="select * from hostel_due_date_schedule where student_due_installment='$installment_no23' and student_due_class='$class_name' and session_value='$session1'";
$run22=mysqli_query($conn73,$que22)or die(mysqli_error($conn73));
if(mysqli_num_rows($run22)>0){
while($row22=mysqli_fetch_assoc($run22)){
$student_due_date=$row22['student_due_date'];
$student_due_date1=date_create($row22['student_due_date']);
}
if($verification_date>$student_due_date1){
$diff=date_diff($verification_date,$student_due_date1);
$clear_difference=$diff->format("%a");
$due_date_month1=explode('-',$student_due_date);
$due_date_next_month=$due_date_month1[1]+1;
$day=cal_days_in_month(CAL_GREGORIAN,$due_date_next_month,$due_date_month1[0]);
if($clear_difference<=$day){
$penalty_amount22=250;
}else{
$penalty_amount22=500;
}
}else{
$penalty_amount22=0;
}
}else{
$penalty_amount22=0;
}
}else{
$penalty_amount22=0;
}
}else{
$penalty_amount22=0;
}
// This Code Is Use For Penalty End
$not_found++;
	?>
	<tr>
	  <td><?php echo $student_sr_no.'.'; ?></td>
	  <td><?php echo $student_name; ?></td>
	  <td><?php echo $student_father_name; ?></td>
	  <td><?php echo $class_name; ?></td>
	  <td><?php echo $student_class_section; ?></td>
	  <td><?php echo $student_fee_category; ?></td>
	  <td><?php echo $final_fee_installment_amount+$expense_total_amount+$penalty_amount22-$total_fee_paid_amount; ?>  <span style="color:#900C3F;"><b><?php if($all_fee_chk12=='Yes'){ echo 'Full Pay'; } ?></b></span></td>
	  <td><input type="checkbox" name="student_roll_no[]" id="<?php echo 'student_rollno_'.$student_sr_no; ?>" value="<?php echo $student_roll_no.'|?|'.$show_all_penalty11; ?>" <?php if($all_fee_chk12=='Yes'){ echo "class='' disabled"; }else{ echo "class='all_check' checked"; } ?> /></td>
	  <td><input type="checkbox" name="" id="<?php echo 'student_penalty_'.$student_sr_no; ?>" value="" onclick="for_penalty('<?php echo $student_sr_no; ?>','<?php echo $student_roll_no; ?>');" <?php if($all_fee_chk12=='Yes'){ echo "class='' disabled"; }else{ if($show_all_penalty11=='Yes'){ echo "class='all_check1' checked"; }else{ echo "class='all_check1'"; } } ?> /></td>
	<tr>
	<?php
	}
	}
	}
	if($not_found<1){
	?>
	<tr>
	<td colspan="9">
	<center><h3>This Installment Main Challan is Not Fouund !!!</h3></center>
	</td>
	</tr>
	<?php
	}
	?>
	</tbody>
</table>