<?php
$student_roll_no=$_GET['id'];
if($student_roll_no!=''){
$que15="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1' ";
}else{
$que15="select * from student_admission_info and session_value='$session1' ";
}
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row15=mysqli_fetch_assoc($run15)){

	   $student_name=$row15['student_name'];
	   $student_class_section=$row15['student_class_section'];
	   $student_father_name=$row15['student_father_name'];
	   $student_class=$row15['student_class'];
	   $school_roll_no=$row15['school_roll_no'];
		
	}
	?>
	        <div class="col-md-1">
		    </div>
			
		    <div class="box-body col-md-3">
                <div class="form-group">
                  <label>Fee Submission Date</label>
                  <input type="date"  name="fee_submission_date" placeholder=""  value="<?php echo date('Y-m-d'); ?>" class="form-control">
                </div>
			
				<div class="form-group">
                  <label>Student Name</label>
                  <input type="text"  name="student_name" id="student_name" placeholder="Student Name"  value="<?php echo $student_name; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label>Student Father's Name</label>
                  <input type="text"  name="student_father_name" id="student_father_name" placeholder="Student Father's Name"  value="<?php echo $student_father_name; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label>Student Roll No</label>
                  <input type="hidden"  name="student_roll_no" id="student_roll_no" placeholder="Student Roll No"  value="<?php echo $student_roll_no; ?>" class="form-control" readonly />
				   <input type="text"   id="school_roll_no" placeholder="Student Roll No"  value="<?php echo $school_roll_no; ?>" class="form-control" readonly />
                </div>
			    <div class="form-group">
                  <label>Student Class</label>
                  <input type="text"  name="student_class" id="student_class" placeholder="Student Class"  value="<?php echo $student_class; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label>Student Class Section</label>
                  <input type="text"  name="student_class_section" id="student_class_section" placeholder="Student Class section"  value="<?php echo $student_class_section; ?>" class="form-control" readonly />
                </div>
					<div class="form-group">
                  <label>Payment Mode</label>
                    <select name="student_payment_mode" class="form-control" onchange="payment_mode(this.value);" required >
			          <option value="">Select</option>  
			          <option value="Cash">Cash</option>
					  <option value="Cheque">Cheque</option>
			          <option value="NEFT">NEFT/Net Banking</option>
			        </select>
                </div>
				<div class="form-group" id="for_cheque_name" style="display:none;">
                  <label>Bank Name</label>
                  <input type="text"  name="cheque_bank_name" placeholder="Bank Name"  value="" class="form-control">
                </div>
				<div class="form-group" id="for_cheque_no" style="display:none;">
                  <label>Cheque No.</label>
                  <input type="text"  name="cheque_no" placeholder="Cheque No."  value="" class="form-control">
                </div>
				<div class="form-group" id="for_cheque_date" style="display:none;">
                  <label>Cheque Date</label>
                  <input type="date"  name="cheque_date" placeholder="Cheque Date"  value="<?php echo date('Y-m-d'); ?>" class="form-control">
                </div>
				<div class="form-group" id="for_neft_bank_name" style="display:none;">
                  <label>Bank Name</label>
                  <input type="text"  name="neft_bank_name" placeholder="Bank Name"  value="" class="form-control">
                </div>
				<div class="form-group" id="for_neft_account_no" style="display:none;">
                  <label>Account No.</label>
                  <input type="text"  name="neft_bank_account_no" placeholder="Account No."  value="" class="form-control">
                </div>
				<div class="form-group">
                  <label></label>
                  <input type="hidden"  name="" placeholder=""  value="" class="form-control" readonly >
                </div>
				
			</div>
			<div class="col-md-1">
			</div>
		<div class="box-body col-md-6" style="border:1px solid;">
		<center><h4 style="color:red;">Pay Fee</h4></center>
            <?php				
                $que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
                $run=mysqli_query($conn73,$que);
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){

				$s_no=$row['s_no'];
				$fee_type5 = $row['fee_type'];
				$fee_code = $row['fee_code'];
						if($fee_type5!=''){
				$fee_type1[$serial_no] = $row['fee_type'];
				$fee[$serial_no]="student_".$fee_code."_per_year";
				$fee_already_paid[$serial_no]="student_".$fee_code."_per_year2";
				$fee_balance[$serial_no]="student_".$fee_code."_balance";
				$fee_paid[$serial_no]="student_".$fee_code."_paid_total";
				$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount";
				$serial_no++;
	            }
				}
				$que="select * from common_fees_student_fee where student_roll_no='$student_roll_no'";
                $run=mysqli_query($conn73,$que);
                while($row=mysqli_fetch_assoc($run)){
                $student_admission_fee = $row['student_admission_fee'];
				$student_admission_fee_balance = $row['student_admission_fee_balance'];
				$student_admission_fee_paid = $row['student_admission_fee_paid'];
				$grand_total = $row['grand_total'];
				$balance_total = $row['balance_total'];
			    $paid_total = $row['paid_total'];
			
					for($i=0;$i<$serial_no;$i++)
					{ 
					   
				        $fee1[$i] = $row[$fee[$i]];
				        $fee_balance1[$i] = $row[$fee_balance[$i]];
						if($fee_balance1[$i]==''){
						$fee_balance1[$i]=0;
						}
						$fee_paid1[$i] = $row[$fee_paid[$i]];
						$total_amount_after_discount1[$i] = $row[$total_amount_after_discount[$i]];
						if($total_amount_after_discount1[$i]==''){
						$total_amount_after_discount1[$i]=0;
						}
						?>
				
                <div class="col-md-12">	
                <div class="col-md-4">	
                <input type="hidden"  name="total_fees_paid1"value="<?php echo $paid_total;?>"/>					
                <input type="hidden"  name="student_admission_fee_paid1"value="<?php echo $student_admission_fee_paid;?>"/>					
                <input type="hidden"  name="<?php echo $fee_already_paid[$i]; ?>"value="<?php echo $fee_paid1[$i]; ?>"/>					
				<div class="form-group">
                  <label ><?php echo $fee_type1[$i];?>/ Year</label>
                  <input type="text"  name="<?php echo $fee[$i];?>" placeholder="<?php echo $fee_type1[$i];?>"  value="<?php echo $total_amount_after_discount1[$i];?>" id="" class="form-control fee" oninput="for_total();" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><?php echo $fee_type1[$i];?> Fee Balance/ Year</label>
                  <input type="text"  name="<?php echo $fee_balance[$i];?>" placeholder="0" value="<?php echo $fee_balance1[$i]; ?>" id="" class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><?php echo $fee_type1[$i];?> Fee Paid Amount</label>
                  <input type="number"  name="<?php echo $fee_paid[$i];?>" value="" placeholder="amount" id="" oninput="total_fee();" min="0" step="0.01" max="<?php echo $fee_balance1[$i]; ?>" class="form-control amt" />
                </div>
				</div>
				</div>
						
				<?php	}  } ?>
				
				<div class="col-md-12">				
				<div class="col-md-4">				
				<div class="form-group">
                  <label>Admission Fee</label>
                  <input type="text"  name="student_admission_fee" value="<?php echo $student_admission_fee;?>" placeholder="Admission Fee" id=""  class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label>Admission Fee Balance</label>
                  <input type="text"  name="student_admission_fee_balance" value="<?php echo $student_admission_fee_balance;?>" placeholder="Admission Fee Balance" id=""  class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label>Admission Fee Paid Amount</label>
                  <input type="number"  name="admission_fee_paid" value="" placeholder="amount" id="" min="0" step="0.01" max="<?php echo $student_admission_fee_balance; ?>" oninput="total_fee();"  class="form-control amt" >
                </div>
				</div>
		        </div>
		        </div>
		  
		    <div class="col-md-6">
			 <br/>
			 <div class="col-md-2">	
			 </div>
			 
			  <div class="col-md-3">
			   <div class="form-group">
                  <label>Total Fee / Year</label>
                  <input type="text" name="grand_total" placeholder="0"  value="<?php echo $grand_total; ?> " id="grand_total1" class="form-control" readonly />
				</div>
               </div>			  
             <div class="col-md-4">				
		      <div class="form-group">
                  <label>Total Fee Balance</label>
                  <input type="text" name="balance_total" placeholder="0"  value="<?php echo $balance_total; ?> " id="grand_total1" class="form-control" readonly >
                </div>
             </div>
			 <div class="col-md-3">				
		      <div class="form-group">
                  <label>Total Paid</label>
                  <input type="text" name="total_paid" placeholder="0"  value="" id="total_paid" class="form-control" readonly >
                </div>
             </div>
		    </div>
		
		