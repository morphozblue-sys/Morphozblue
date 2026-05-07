<?php include("../attachment/session.php")?>

<script>
function total_fee(){
var add = 0;
$('.amt').each(function() {
add += Number($(this).val());
});
document.getElementById('total_paid').value = add;
}
</script>
  
      <section class="content-header">
      <h1>
        	Account Management
					<small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i><?php echo $language['Account']; ?></a></li>
		<li><a href="javascript:get_content('account/ledger')"><i class="fa fa-list"></i>Ledger</a></li>
	  <li class="active">Ledger Income Details</li>
      </ol>
    </section>

	
	
	
	
	<?php
	$emp_id_or_student_roll_no=$_GET['id'];
	$date=$_GET['date'];
	$total_amount=$_GET['total_amount'];
	$que="select * from fees_student_fee_add where student_roll_no='$emp_id_or_student_roll_no' and fee_submission_date='$date' and paid_total='$total_amount'";
    $run=mysqli_query($conn73,$que);
    while($row=mysqli_fetch_assoc($run)){
    $student_name=$row['student_name'];
	$student_father_name=$row['student_father_name'];
	$student_class=$row['student_class'];
	$student_class_section=$row['student_class_section'];
	$student_roll_no=$row['student_roll_no'];
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
  	   
		    <div class="col-md-1">
		    </div>
			
		    <div class="box-body col-md-3">
                <div class="form-group">
                  <label>Fee Submission Date</label>
                  <input type="date"  name="fee_submission_date" placeholder=""  value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly >
                </div>
			
				<div class="form-group">
                  <label>Student Name</label>
                  <input type="text"  name="student_name" placeholder="Student Name"  value="<?php echo $student_name; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label>Student Father's Name</label>
                  <input type="text"  name="student_father_name" placeholder="Student Father's Name"  value="<?php echo $student_father_name; ?>" class="form-control" readonly />
                </div>
			    <div class="form-group">
                  <label>Student Class</label>
                  <input type="text"  name="student_class" placeholder="Student Class"  value="<?php echo $student_class; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label>Student Class Section</label>
                  <input type="text"  name="student_class_section" placeholder="Student Class section"  value="<?php echo $student_class_section; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label></label>
                  <input type="hidden"  name="" placeholder=""  value="" class="form-control" readonly >
                </div>
				
			</div>
			<div class="col-md-1">
			
			</div>
			
		<div class="box-body col-md-6" style="border:1px solid;">
		<center><h2 style="color:teal;">Paid Fee Details</h2></center>
            <?php				
                $que="select * from school_info_fee_types";
                $run=mysqli_query($conn73,$que);
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$fee_type5 = $row['fee_type'];
				$fee_code = $row['fee_code'];
				$fee_type1[$serial_no] = $row['fee_type'];
				$fee[$serial_no]="student_".$fee_code."_per_year";
				$fee_balance[$serial_no]="student_".$fee_code."_balance";
				$fee_paid[$serial_no]="student_".$fee_code."_paid_total";
				$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount";
				$serial_no++;
	            }
			    $emp_id_or_student_roll_no=$_GET['id'];
				$date=$_GET['date'];
				$total_amount=$_GET['total_amount'];
				$que="select * from fees_student_fee_add where student_roll_no='$emp_id_or_student_roll_no' and fee_submission_date='$date' and paid_total='$total_amount'";
                $run=mysqli_query($conn73,$que);
                while($row=mysqli_fetch_assoc($run)){
                $student_admission_fee = $row['student_admission_fee'];
				$student_admission_fee_balance = $row['student_admission_fee_balance'];
				$student_admission_fee_paid = $row['student_admission_fee_paid'];
				$grand_total = $row['grand_total'];
				$balance_total = $row['balance_total'];
				$paid_total = $row['paid_total'];
				$student_admission_fee_paid = $row['student_admission_fee_paid'];
			
					for($i=0;$i<$serial_no;$i++)
					{ 
				        $fee_balance1[$i] = $row[$fee_balance[$i]];
						$fee_paid1[$i] = $row[$fee_paid[$i]];
						$total_amount_after_discount1[$i] = $row[$total_amount_after_discount[$i]];
						?>

				<div class="col-md-6" <?php if($fee_paid1[$i]<=0) { ?> style="display:none;" <?php } ?>>				
				<div class="form-group">
                  <label><?php echo $fee_type1[$i];?> Fee Paid Amount</label>
                  <input type="text"  name="<?php echo $fee_paid[$i];?>" value="<?php echo $fee_paid1[$i];?>" placeholder="amount" class="form-control" readonly />
                </div>
				</div>					
				<?php	}  } ?>
	
				<div class="col-md-6" <?php if($student_admission_fee_paid<=0) { ?> style="display:none;" <?php } ?>>
				<div class="form-group">
                  <label>Penalty</label>
                  <input type="text"  name="admission_fee_paid" value="<?php echo $student_admission_fee_paid;?>" placeholder="amount" id="" class="form-control amt" readonly >
                </div>
				</div>
				
				<div class="col-md-6">				
				<div class="form-group">
                  <label>Total Paid</label>
                  <input type="text"  name="paid_total" value="<?php echo $paid_total;?>" placeholder="amount" id="" class="form-control amt" readonly >
                </div>
				</div>
		</div>
		  
		</div>
		
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>
 
