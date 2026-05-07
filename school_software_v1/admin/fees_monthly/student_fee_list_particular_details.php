<?php include("../attachment/session.php"); ?>

<script>
function total_fee(){
var add = 0;
$('.amt').each(function() {
add += Number($(this).val());
});
document.getElementById('total_paid').value = add;
}
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fees Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/student_fee_list')"><i class="fa fa-money"></i> Student Fees List</a></li>
	  <li class="active">Student Fees List Particular Details</li>
      </ol>
    </section>
	
<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	<?php
	$s_no=$_GET['s_no'];
	$que="select * from common_fees_student_fee_add where s_no='$s_no' and session_value='$session1'";
    $run=mysqli_query($conn73,$que);
    while($row=mysqli_fetch_assoc($run)){
    $student_name=$row['student_name'];
	$student_father_name=$row['student_father_name'];
	$student_class=$row['student_class'];
	$student_class_section=$row['student_class_section'];
	$student_roll_no=$row['student_roll_no'];
    $fee_submission_date=$row['fee_submission_date'];
	}
	?>
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->			
        <div class="box-body">
		<br>
    <form method="post" enctype="multipart/form-data">
			
		    <div class="box-body col-md-12">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-2">
                <div class="form-group">
                  <label>Fee Submission Date</label>
                  <input type="text" name="fee_submission_date" placeholder=""  value="<?php echo $fee_submission_date; ?>" class="form-control" readonly >
                </div>
                </div>
				<div class="col-md-2">
				<div class="form-group">
                  <label>Student Name</label>
                  <input type="text"  name="student_name" placeholder="Student Name"  value="<?php echo $student_name; ?>" class="form-control" readonly />
                </div>
                </div>
				<div class="col-md-2">
				<div class="form-group">
                  <label>Student Father's Name</label>
                  <input type="text"  name="student_father_name" placeholder="Student Father's Name"  value="<?php echo $student_father_name; ?>" class="form-control" readonly />
                </div>
                </div>
				<div class="col-md-2">
			    <div class="form-group">
                  <label>Student Class</label>
                  <input type="text"  name="student_class" placeholder="Student Class"  value="<?php echo $student_class; ?>" class="form-control" readonly />
                </div>
                </div>
				<div class="col-md-2">
				<div class="form-group">
                  <label>Student Class Section</label>
                  <input type="text"  name="student_class_section" placeholder="Student Class section"  value="<?php echo $student_class_section; ?>" class="form-control" readonly />
                </div>
                </div>
				<div class="col-md-1">
				<div class="form-group">
                  <label></label>
                  <input type="hidden"  name="" placeholder=""  value="" class="form-control" readonly >
                </div>
                </div>
				
			</div>
			
		<div class="box-body col-md-12" style="border:1px solid;">
		<center><h2 style="color:teal;">Paid Fee Details</h2></center>
            <?php				
                $que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
                $run01=mysqli_query($conn73,$que01);
                while($row01=mysqli_fetch_assoc($run01)){
				$fees_code = $row01['fees_code'];
				$fees_type_name[$fees_code] = $row01['fees_type_name'];
				}
				
				$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
                $run=mysqli_query($conn73,$que);
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$fee_type5 = $row['fee_type'];
				$fee_code = $row['fee_code'];
				if($fee_type5!=''){
				$fee_type1[$serial_no] = $row['fee_type'];
				$fee[$serial_no]="student_".$fee_code."_month";
				$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
				$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
				$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
				$serial_no++;
	            } }
			    $s_no=$_GET['s_no'];
				$que="select * from common_fees_student_fee_add where s_no='$s_no' and session_value='$session1'";
                $run=mysqli_query($conn73,$que);
                while($row=mysqli_fetch_assoc($run)){
				$penalty_amount = $row['penalty_amount'];
				$grand_total = $row['grand_total'];
				$balance_total = $row['balance_total'];
				$paid_total = $row['paid_total'];
				
                $student_previous_year_fee_paid_total = $row['student_previous_year_fee_paid_total'];
				
				$student_transport_fee_paid_total = $row['student_transport_fee_paid_total'];
				$other_fee_remark = $row['other_fee_remark'];
				$other_fee_amount = $row['other_fee_amount'];
				$fee_paid_months = $row['fee_paid_months'];
				
				$blank_field_1 = $row['blank_field_1'];
				$blank_field_2 = $row['blank_field_2'];
				
				$fee_paid_months_count=substr_count($fee_paid_months,',');
				
				if($fee_paid_months_count>0){
				$fee_paid_months_exp=explode(',',$fee_paid_months);
				}else{
				$fee_paid_months_exp[]=$fee_paid_months;
				}
				$fee_paid_months1_count = count($fee_paid_months_exp);
				
				for($a=0;$a<$fee_paid_months1_count;$a++){
				?>
				<div class="col-md-6" style="border:1px solid;border-radius:10px;">
				<div class="col-md-6">
				<h4 style="color:green;"><?php echo $fees_type_name[$fee_paid_months_exp[$a]]; ?> Fee Details</h4>
				</div>
				<?php
				for($i=0;$i<$serial_no;$i++){
				
				$fee_balance1[$i] = $row[$fee_balance[$i].$fee_paid_months_exp[$a]];
				$fee_paid1[$i] = $row[$fee_paid[$i].$fee_paid_months_exp[$a]];
				$total_amount_after_discount1[$i] = $row[$total_amount_after_discount[$i].$fee_paid_months_exp[$a]];
				?>
				<div class="col-md-6">				
				<div class="form-group">
                  <label><?php echo $fee_type1[$i];?> Fee Paid Amount</label>
                  <input type="text" name="<?php echo $fee_paid[$i].$fee_paid_months_exp[$a];?>" value="<?php echo $fee_paid1[$i];?>" placeholder="amount" class="form-control" readonly />
                </div>
				</div>					
				<?php } ?>
				</div>
				<?php } } ?>
		</div>
				<?php if($blank_field_2>0){ ?>
				<div class="col-md-12">
                    
                    <div class="col-md-4">
                    <div class="form-group">
                    <label>Discount Remark</label>
                    <input type="text" name="discount_remark" placeholder="Discount Remark" value="<?php echo $blank_field_1; ?>" id="discount_remark" class="form-control" readonly />
                    </div>
                    </div>
                    
                    <div class="col-md-2">
                    <div class="form-group">
                    <label>Discount Amount <small>( In Rs )</small></label>
                    <input type="text" name="discount_amount" placeholder="Discount Amount" value="<?php echo $blank_field_2; ?>" id="discount_amount" class="form-control" readonly />
                    </div>
                    </div>
                    
				</div>
				<?php } ?>
				<div class="col-md-12">
			   
				 <div class="col-md-3">				
				  <div class="form-group" style="<?php if($other_fee_amount=='0' || $other_fee_amount==''){ echo 'display:none;'; } ?>">
					  <label>Other Fee Remark</label>
					  <input type="text" name="other_fee_remark" placeholder="Other Fee Remark" value="<?php echo $other_fee_remark; ?>" class="form-control" readonly />
					</div>
				 </div>
				 <div class="col-md-1">				
				  <div class="form-group" style="<?php if($other_fee_amount=='0' || $other_fee_amount==''){ echo 'display:none;'; } ?>">
					  <label>Other Fee</label>
					  <input type="text" name="other_fee_amount" placeholder="0" value="<?php echo $other_fee_amount; ?>" class="form-control amt" readonly />
					</div>
				 </div>
				
				<div class="col-md-2">
				<div class="form-group" style="<?php if($penalty_amount=='0' || $penalty_amount==''){ echo 'display:none;'; } ?>">
                  <label>Penalty</label>
                  <input type="text" name="penalty_amount" value="<?php echo $penalty_amount;?>" placeholder="amount" id="" class="form-control amt" readonly />
                </div>
				</div>
				
				<div class="col-md-2">				
				  <div class="form-group" style="<?php if($student_previous_year_fee_paid_total=='0' || $student_previous_year_fee_paid_total==''){ echo 'display:none;'; } ?>">
					  <label>Previous Year Fee</label>
					  <input type="text" name="student_previous_year_fee_paid_total" placeholder="0" value="<?php echo $student_previous_year_fee_paid_total; ?>" class="form-control amt" readonly />
					</div>
				 </div>
				
				<div class="col-md-2">				
				  <div class="form-group" style="<?php if($student_transport_fee_paid_total=='0' || $student_transport_fee_paid_total==''){ echo 'display:none;'; } ?>">
					  <label>Transport Amount</label>
					  <input type="text" name="transport_amount" placeholder="0" value="<?php echo $student_transport_fee_paid_total; ?>" class="form-control amt" readonly />
					</div>
				 </div>
				
				<div class="col-md-2">				
				<div class="form-group">
                  <label>Total Paid</label>
                  <input type="text" name="paid_total" value="<?php echo $paid_total;?>" placeholder="amount" id="" class="form-control amt" readonly />
                </div>
				</div>
				</div>
				
		</div>
		
	</form>			
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>