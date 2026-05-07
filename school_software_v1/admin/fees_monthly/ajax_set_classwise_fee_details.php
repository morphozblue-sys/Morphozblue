<?php include("../attachment/session.php"); ?>
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR);
$student_class=$_GET['class_name'];
$student_transport=$_GET['student_transport'];
$que125="select * from school_info_class_info where class_name='$student_class'";
$run125=mysqli_query($conn73,$que125);
while($row125=mysqli_fetch_assoc($run125)){
$class_code=$row125['class_code'];
}

$bus_fee_category_code=$_GET['bus_fee_category_code'];
$transport_amount=0;
if($student_transport=='Yes' && $bus_fee_category_code!='All'){
$select_tran_column=$class_code."_amount";
$que0125="select $select_tran_column from bus_fee_category where bus_fee_category_code='$bus_fee_category_code'";
$run0125=mysqli_query($conn73,$que0125);
while($row0125=mysqli_fetch_assoc($run0125)){
$transport_amount=$row0125[$select_tran_column];
}
}
$student_fee_category_code=$_GET['student_fee_category_code'];
?>
<div class="col-md-6"><h4 style="color:#d9534f;">Fees Details:</h4></div>
<div class="col-md-3"><center><span style="color:red;"><input type="checkbox" name="" id="check_same" value="" />&nbsp;&nbsp;&nbsp;<b>Check For Same <small>(Amount)</small></b></span></center></div>
<div class="col-md-3"><center><span style="color:red;"><input type="checkbox" name="" id="check_for_same" value="" />&nbsp;&nbsp;&nbsp;<b>Check For Same <small>(Discount)</small></b></span></center></div>
<?php				
	
	$que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
	$run1=mysqli_query($conn73,$que1);
	while($row1=mysqli_fetch_assoc($run1)){
	$fees_type_name[] = $row1['fees_type_name'];	
	$fees_code[] = $row1['fees_code'];
	$fees_count = $row1['fees_count'];
	}
	
	$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
	$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73)) ;
	$serial_no=0;
	while($row=mysqli_fetch_assoc($run)){
	$s_no=$row['s_no'];
	$fee_type = $row['fee_type'];
	$fee_code = $row['fee_code'];
	if($fee_type!=''){
	$fee_type1[$serial_no] = $row['fee_type'];
	$fee_code1[$serial_no] = $row['fee_code'];
	$fee_type=strtolower($fee_type);
	$fee[$serial_no]="student_".$fee_code."_month";
	$fee_discount_type[$serial_no]="student_".$fee_code."_discount_month";
	$fee_discount_method[$serial_no]="student_".$fee_code."_discount_method_month";
	$fee_discount_amount[$serial_no]="student_".$fee_code."_discount_amount_month";
	$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
	$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
	$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
	$serial_no++;
	} }
	
	$que="select * from common_fees_fee_structure where session_value='$session1' and class_code='$class_code' and category_code='$student_fee_category_code'$filter37";
	$run=mysqli_query($conn73,$que);
	while($row=mysqli_fetch_assoc($run)){
	$total_fee=0;
	$grand_total = 0;
	$coun=0;
	$d=0;
	for($a=0;$a<$fees_count;$a++){
	?>
	<div class="col-md-12">
	<div class="col-md-12">
	<h4 style="color:green;"><?php echo $fees_type_name[$a]; ?> Fee Set</h4>
	</div>
	<?php
	$show_total_fee=0;
	$show_paid_fee=0;
	$show_balance_fee=0;
	for($i=0;$i<$serial_no;$i++){

	$coun++;
	$d=$d+1;
	$fee1[$i] = $row[$fee[$i].$fees_code[$a]];			
	$show_total_fee=$show_total_fee+$fee1[$i];
	$grand_total = $grand_total+$fee1[$i];
	?>
	<div class="col-md-3">
	<div class="form-group">
	  <label ><?php echo $fee_type1[$i];?></label>
	  <input type="text" name="<?php echo $fee[$i].$fees_code[$a];?>" placeholder="<?php echo $fee_type1[$i];?>" value="<?php echo $fee1[$i];?>" id="<?php echo "fee_type_".$d;?>" class="<?php echo 'form-control '.$fee_code1[$i]; ?>" oninput="same_amount(this.value,'<?php echo $fee_code1[$i]; ?>');"/>
	</div>
	</div>
	
	
	
	<div class="col-md-3">				
	<div class="form-group">
	  <label>Discount Type</label>
	   <select name="<?php echo $fee_discount_type[$i].$fees_code[$a];?>" id="<?php echo "disc_type_".$d;?>" onchange="for_same(this.id,'<?php echo 'disc_type_'.$fee_code1[$i]; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>');" class="form-control <?php echo 'disc_type_'.$fee_code1[$i]; ?>" required>
		<option value="None">None</option>
	<?php
	$que2="select discount_type from school_info_discount_types where discount_type!=''";
	$run2=mysqli_query($conn73,$que2);
	while($row2=mysqli_fetch_assoc($run2)){
	$discount_type = $row2['discount_type'];
	?>
	<option value="<?php echo $discount_type; ?>"><?php echo $discount_type; ?></option>
	<?php } ?>
	</select>			 
	</div>
	</div>

	<div class="col-md-3">				
	<label>Discount Amount</label>
	<div class="input-group">
		<input type="hidden" id="<?php echo "click_".$d; ?>" class="<?php echo 'clk_btn_'.$fee_code1[$i]; ?>" onclick="for_total('<?php echo $d; ?>');month_total('<?php echo $fees_code[$a]; ?>');">
		<input type="text" name="<?php echo $fee_discount_amount[$i].$fees_code[$a];?>" id="<?php echo "discount_amount_".$d; ?>" class="form-control <?php echo 'disc_amt_'.$fee_code1[$i]; ?>" oninput="for_same(this.id,'<?php echo 'disc_amt_'.$fee_code1[$i]; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>');" value="0" />
		<span class="input-group-addon" style="padding:0px;">
		<select name="<?php echo $fee_discount_method[$i].$fees_code[$a];?>" id="<?php echo "discount_method_".$d;?>" style="border:none;" class="<?php echo 'disc_mtd_'.$fee_code1[$i]; ?>" onchange="for_same(this.id,'<?php echo 'disc_mtd_'.$fee_code1[$i]; ?>','<?php echo 'clk_btn_'.$fee_code1[$i]; ?>','<?php echo "click_".$d; ?>');">
		<option value="%">%</option>
		<option value="Rs">Rs</option>
		</select>
		</span>
	</div>
	</div>

	<div class="col-md-3">				
	<div class="form-group">
	  <label><small>Total Amount After Discount</small></label>
	  <input type="text"  name="<?php echo $total_amount_after_discount[$i].$fees_code[$a];?>" placeholder="0"  value="<?php echo $fee1[$i];?>" id="<?php echo "after_discount_amount_".$d; ?>" class="form-control amt <?php echo "fee_amount_".$fees_code[$a]; ?>" readonly />
	</div>
	</div>
	
	
	
	<?php } ?>
	<div class="col-md-12" style="border:1px solid;border-radius:20px;">
	<center><h4 style="color:blue;"><?php echo $fees_type_name[$a]; ?> Total Fee : <span id="<?php echo 'total_month_'.$fees_code[$a]; ?>"><?php echo $show_total_fee; ?></span></h4></center>
	</div>
	</div>
	<?php } } ?>
	<div class="col-md-6">				
	<div class="form-group">
	  &nbsp;
	</div>
	</div>
	
	<?php if($student_transport=='Yes' && !in_array('Transport Amount', $fee_type1) && !in_array('Transport Fee', $fee_type1) && !in_array('Bus Amount', $fee_type1) && !in_array('Bus Fee', $fee_type1)){ ?>
	<div class="col-md-3">				
	<div class="form-group">
	  <label>Transport Amount</label>
	  <input type="text" name="transport_amount" placeholder="0" id="transport_amount" oninput="for_total('No');" value="<?php echo $transport_amount; ?>" class="form-control amt" />
	</div>
	</div>
	<?php }else{ ?>
	<div class="col-md-3">				
	<div class="form-group">
	  <input type="hidden" name="transport_amount" placeholder="0" value="<?php echo $transport_amount; ?>" id="transport_amount" class="form-control" />
	</div>
	</div>
	<?php } ?>
	
	<div class="col-md-3">				
	<div class="form-group">
	  <label>Grand Total</label>
	  <input type="text" name="grand_total" placeholder="0" value="<?php echo $grand_total+$transport_amount; ?>" id="grand_total1" class="form-control" readonly />
	</div>
	</div>