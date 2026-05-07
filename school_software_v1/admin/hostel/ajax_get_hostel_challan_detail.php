<?php include("../attachment/session.php"); ?>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
?>
<?php
include("../../con73/con37.php");
$quer12="select * from school_info_hostel_head where fee_head_name!=''";
$rest12=mysqli_query($conn73,$quer12)or die(mysqli_error($conn73));
$head_sno=0;
while($row12=mysqli_fetch_assoc($rest12)){
$fee_head_name[$head_sno] = $row12['fee_head_name'];
$fee_head_code[$head_sno] = $row12['fee_head_code'];
$head_sno++;
}

$challan_no=$_GET['challan_no'];
$verify_date1=$_GET['verify_date'];
$payment_mode1=$_GET['payment_mode'];
$quer11="select * from student_hostel_fees_paid where challan_no='$challan_no' and session_value='$session1'";
$rest=mysqli_query($conn73,$quer11)or die(mysqli_error($conn73));
while($row11=mysqli_fetch_assoc($rest)){
$installment_no1 = $row11['installment_no'];
$student_roll_no23 = $row11['student_roll_no'];
$verify = $row11['verify'];
$payment_mode = $row11['payment_mode'];
$cheque_dd_no = $row11['cheque_dd_no'];
$remark = $row11['remark'];
$verification_date = $row11['verification_date'];
$penalty_amount = $row11['penalty_amount'];
for($m=0;$m<$head_sno;$m++){
$hostel_fees_paid[$m] = $row11[$fee_head_code[$m]];
}
}
if($installment_no1=='installment1'){
$start_month=4;
$end_month=6;
$month_name4="April";
$month_name5="May";
$month_name6="June";
}elseif($installment_no1=='installment2'){
$start_month=7;
$end_month=9;
$month_name7="July";
$month_name8="August";
$month_name9="September";
}elseif($installment_no1=='installment3'){
$start_month=10;
$end_month=12;
$month_name10="October";
$month_name11="November";
$month_name12="December";
}elseif($installment_no1=='installment4'){
$start_month=1;
$end_month=3;
$month_name1="January";
$month_name2="Fabruary";
$month_name3="March";
}




$que10="select * from student_hostel_fees_discount where student_roll_no='$student_roll_no23'";
$run10=mysqli_query($conn73,$que10)or die(mysqli_error($conn73));
$fee_sno1=0;
if(mysqli_num_rows($run10)>0){
while($row10=mysqli_fetch_assoc($run10)){
for($n=0;$n<$head_sno;$n++){
$discount_amount[$fee_sno1] = $row10[$fee_head_code[$n]."_discount_amount"];
$fee_sno1++;
}
}
}else{
for($n=0;$n<$head_sno;$n++){
$discount_amount[$fee_sno1] = 0;
$fee_sno1++;
}
}

$que0019="select * from student_admission_info where student_roll_no='$student_roll_no23' and session_value='$session1'";
$run0019=mysqli_query($conn73,$que0019) or die(mysqli_error($conn73));
while($row0019=mysqli_fetch_assoc($run0019)){
$student_class=$row0019['student_class'];
$student_fee_category=$row0019['student_fee_category'];
$student_fee_category_code=$row0019['student_fee_category_code'];
}

$que019="select * from school_info_class_info where class_name='$student_class'";
$run019=mysqli_query($conn73,$que019) or die(mysqli_error($conn73));
while($row019=mysqli_fetch_assoc($run019)){
$class_code=$row019['class_code'];
}

$que19="select * from student_hostel_fees_structure_monthly where class_code='$class_code' and category_code='$student_fee_category_code'";
$run19=mysqli_query($conn73,$que19) or die(mysqli_error($conn73));
$hostel_monthly_amount='';
$hostel_month_total_amount='';
$hostel_month_total_amount13='';
$hos_sno=0;
while($row19=mysqli_fetch_assoc($run19)){
for($o=$start_month;$o<=$end_month;$o++){
for($p=0;$p<$head_sno;$p++){
$month_amount_total1=$row19[$fee_head_code[$p].'_month'.$o];
$hostel_monthly_amount[$p][$o]=(($month_amount_total1)-($month_amount_total1*$discount_amount[$p])/100);
if($hos_sno==0){
$hostel_month_total_amount[$p]=0;
$hostel_month_total_amount13[$p]=0;
}
$hostel_month_total_amount[$p]=$hostel_month_total_amount[$p]+$row19[$fee_head_code[$p].'_month'.$o];
$hostel_month_total_amount13[$p]=$hostel_month_total_amount13[$p]+(($row19[$fee_head_code[$p].'_month'.$o])-($row19[$fee_head_code[$p].'_month'.$o]*$discount_amount[$p])/100);
}
$hos_sno++;
}
}

$que20="select * from expense_monthly where student_roll_no='$student_roll_no23' and add_in_installment='$installment_no1'";
$run20=mysqli_query($conn73,$que20) or die(mysqli_error($conn73));
$exp_sno=0;
if(mysqli_num_rows($run20)>0){
while($row20=mysqli_fetch_assoc($run20)){
for($q=0;$q<$head_sno;$q++){
if($exp_sno==0){
$expense_fee_amount1[$q]=0;
$expense_fee_amount[$q]=0;
}
$expense_fee_amt12=$row20[$fee_head_code[$q]];
$expense_fee_amount1[$q]=$expense_fee_amount1[$q]+$expense_fee_amt12;
$expense_fee_amount[$q]=$expense_fee_amount[$q]+(($expense_fee_amt12)-($expense_fee_amt12*$discount_amount[$q])/100);
}
$exp_sno++;
}
}else{
for($q=0;$q<$head_sno;$q++){
$expense_fee_amount[$q]=0;
$expense_fee_amount1[$q]=0;
}
}
?>
		
              <div class="col-sm-12" id="get_details">
			  
			  <div class="col-md-12">
					
					<div class="col-md-2">
					<label>Payment Mode</label>
					<select name="payment_mode" id="payment_mode" class="form-control" onchange="for_banking(this.value);" required>
					<option <?php if($payment_mode=='Cash' || $payment_mode1=='Cash'){ echo 'selected'; } ?> value="Cash">Cash</option>
					<option <?php if($payment_mode=='Swep' || $payment_mode1=='Swep'){ echo 'selected'; } ?> value="Swep">Swep</option>
					<option <?php if($payment_mode=='Cheque' || $payment_mode1=='Cheque'){ echo 'selected'; } ?> value="Cheque">Cheque</option>
					<option <?php if($payment_mode=='Online' || $payment_mode1=='Online'){ echo 'selected'; } ?> value="Online">Online</option>
					</select>
					</div>
					<div class="col-md-2">
					<label>Verify Date</label>
					<input type="date" name="verify_date" id="verify_date" value="<?php if($verify_date1!=''){ echo $verify_date1; }else{ if($verification_date!='0000-00-00'){ echo $verification_date; }else{ echo date('Y-m-d'); } } ?>" class="form-control" />
					</div>
					<div class="col-md-4">
					<label>Remark</label>
					<input type="text" name="remark" id="remark" placeholder="Remark" value="<?php if($remark!=''){ echo $remark; } ?>" class="form-control" />
					</div>
					<div class="col-md-2 banking" style="<?php if(($payment_mode=='Cash' && $payment_mode1=='') || ($payment_mode=='Cash' && $payment_mode1=='Cash') || ($payment_mode=='' && $payment_mode1=='') || ($payment_mode=='' && $payment_mode1=='Cash')){ echo 'display:none'; } ?>" >
					<label>Cheque/Trans. Id</label>
					<input type="text" name="cheque_dd_no" id="cheque_dd_no" placeholder="Cheque/Trans. Id" value="<?php if($cheque_dd_no!=''){ echo $cheque_dd_no; } ?>" class="form-control" />
					</div>
					<div class="col-md-2">
					<label>Verify</label>
					<input type="hidden" name="student_roll_no23" id="student_roll_no23" value="<?php echo $student_roll_no23;  ?>" class="form-control" />
					<select name="verify_unverify" id="verify_unverify" class="form-control" required>
					<option value="Yes">Verify</option>
					</select>
					</div>
					
			  </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
					<div class="col-md-2">
					<a href="student_hostel_fee_add_form.php?student_roll_no=<?php echo $student_roll_no23; ?>&class_code=<?php echo $class_code; ?>&category_code=<?php echo $student_fee_category_code; ?>&installment_number=<?php echo $installment_no1; ?>&student_class=<?php echo $student_class; ?>&student_category=<?php echo $student_fee_category; ?>&challan_no=<?php echo $challan_no; ?>"><button type="button" class="btn btn-info" <?php if($verify=='Yes'){ echo 'disabled'; } ?> >Edit Challan</button></a>
					</div>
					<div class="col-md-10">
					<center><input type="submit" name="submit" value="Submit" class="btn btn-success" <?php if($verify=='Yes'){ echo 'disabled'; } ?> /></center>
				    </div>
			  </div>
			  <div class="col-md-12">&nbsp;</div>
			  
			  <table id="" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <td rowspan="2">Main Head</td>
				  <?php for($j=$start_month;$j<=$end_month;$j++){
				  $month_name11="month_name".$j;
				  ?>
				  <td colspan="2" style="width:120px"><?php echo $$month_name11; ?></td>
				  <?php } ?>
				  <td rowspan="2">Total</td>
				  <td rowspan="2"  style="width:120px">Paid</td>
				  <td rowspan="2"  style="width:120px">Pay</td>
                </tr>
				<tr>
				<?php for($k=$start_month;$k<=$end_month;$k++){ ?>
				  <td>Amount</td>
				  <td>Paid</td>
				<?php } ?>
                </tr>
                </thead>
                <tbody id="set_value">
				<?php
				for($i=0;$i<$head_sno;$i++){
				?>
				 <tr>
				    <td rowspan="" ><h5 style="color:#900C3F;"><b><?php echo $fee_head_name[$i]; ?></h5></td>
					<?php for($l=$start_month;$l<=$end_month;$l++){ 
					if($l==$end_month){
					$hostel_expense_amt11=$hostel_monthly_amount[$i][$l]+$expense_fee_amount[$i];
					}else{
					$hostel_expense_amt11=$hostel_monthly_amount[$i][$l];
					}
					?>
					<td><?php echo $hostel_expense_amt11; ?></td>
					<td><input type="number" value ="<?php echo $hostel_expense_amt11; ?>" style="width:60px;" readonly ></td>
					<?php } ?>
					<td style="color:#FF0000;"><?php echo $hostel_fees_paid[$i]; ?></td>
					<td ><input type="number" class="form-control" placeholder="" value="<?php echo $hostel_fees_paid[$i]; ?>" style="color:#0000FF;" readonly ></td>
					<td ><input type="text" class="form-control pay" placeholder="" value="<?php echo $hostel_fees_paid[$i]; ?>" style="color:#0000FF;" readonly ></td>
				  </tr>
				<?php
				}
				?>
				  <tr>
					<td colspan="7">Penalty Amount</td>
					<td style="color:#FF0000;"><?php echo $penalty_amount; ?></td>
					<td style="color:#0000FF;"><input type="text" class="form-control" value="<?php echo $penalty_amount; ?>" style="color:#0000FF;" readonly /></td>
					<td style="color:#0000FF;" id="total_penalty"><input type="text" name="penalty_amount" id="" class="form-control pay" value="<?php echo $penalty_amount; ?>" style="color:#0000FF;" readonly /></td>
				  </tr>
					
				  <tr>
					<td colspan="7">Total</td>
					<td style="color:#FF0000;" id="total_payble_final" ></td>
					<td style="color:#0000FF;" id="total_paid_final"></td>
					<td style="color:#0000FF;" id="total_pay_final"></td>
				  </tr>
                </tbody>
				
              </table>
              </div>
              </div>
			</div>
            <!-- /.box-body -->
          </div>