<?php include("../attachment/session.php");
	
    $student_roll_no = $_POST['student_roll_no'];
    $month_count = $_POST['month_count'];
    $month_code = $_POST['month_code'];
    
$query="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1' and student_bus='Yes' and student_bus_fee_category_code!=''";
$result=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
if(mysqli_num_rows($result)>0){
    
    $query1="select * from common_fees_student_transport_fee where student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active'";
    $run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
    if(mysqli_num_rows($run1)>0){
    while($row1=mysqli_fetch_assoc($run1)){
    // $fee_status = $row1['fee_status'];
    // $penalty_amount = $row1['penalty_amount'];
    // $other_fee_amount1 = $row1['other_fee_amount'];
    
    // $student_previous_year_fee = $row1['student_previous_year_fee'];
    // $student_previous_year_fee_balance = $row1['student_previous_year_fee_balance'];
    // $student_previous_year_fee_paid_total = $row1['student_previous_year_fee_paid_total'];
    
    for($abc=0;$abc<$month_count;$abc++){
        ?>
        <div class="col-md-6">
            <div class="col-md-4">						
			<div class="form-group">
              <label>New Transport Fee</label>
              <input type="text" name="<?php echo 'new_transport_fee_month'.$month_code[$abc]; ?>" value="<?php echo $row1['transport_fee_amount_after_discount_month'.$month_code[$abc]]; ?>" id="" class="form-control" oninput="" readonly />
            </div>
			</div>
			
			<div class="col-md-4">				
			<div class="form-group">
              <label><small>New Transport Fee Balance</small></label>
              <input type="text" name="<?php echo 'new_transport_fee_balance_month'.$month_code[$abc]; ?>" placeholder="0" value="<?php echo $row1['transport_fee_balance_month'.$month_code[$abc]]; ?>" id="" class="form-control" readonly />
            </div>
			</div>
			
			<div class="col-md-4">				
			<div class="form-group">
              <label><small>New Transport Fee Paid</small></label>
              <input type="number" name="<?php echo 'new_transport_fee_paid_month'.$month_code[$abc]; ?>" value="<?php echo $row1['transport_fee_balance_month'.$month_code[$abc]]; ?>" id="" oninput="" step="1" max="<?php echo $row1['transport_fee_balance_month'.$month_code[$abc]]; ?>" class="form-control" />
            </div>
			</div>
        </div>
        <?php
    }
    
    }
    }else{
        echo "not_set";
    }
    
}else{
    echo "no";
}
?>