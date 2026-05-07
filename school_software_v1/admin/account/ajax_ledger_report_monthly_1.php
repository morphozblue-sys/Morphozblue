<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Ledger monthly Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?> ">
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			<?php			
			$from_date=$_GET['from_date'];
			if($from_date!=''){
				$from_date1=date('d-m-Y',strtotime($from_date));
				$condition1=" and date>='$from_date'";
			}else{
				$from_date1="";
				$condition1="";
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=date('d-m-Y',strtotime($to_date));
				$condition2=" and date<='$to_date'";
			}else{
				$to_date1="";
				$condition2="";
			}
			
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code,fees_category from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			$fees_category=$schl_row['fees_category'];
			}
			
			if($fees_category=='installmentwise' || $fees_category=='monthly' || $fees_category=='yearly'){
			    $table_name="common_fees_student_fee_add";
			}else{
			    $table_name="fees_student_fee_add";
			}
			
			?>
			<table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			<tr>
			<td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			</tr>
			<tr>
			<td style="float:left;"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			<td><center><b>STUDENT LEDGER REPORT</b></center></td>
			<td style="float:right;"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td style="float:left;">Current Date : <?php echo date('d-m-Y'); ?></td>
			<td><center><b>Monthly Report</b></center></td>
			<td style="float:right;">From : <?php echo $from_date1; ?> To : <?php echo $to_date1; ?></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead >
								<tr>
								  <th>S.No.</th>
								  <th>Bill No.</th>
								  <th>Student Name</th>
								  <th>Admission No.</th>
								  <th>Income From</th>
								  <th>Expense</th>
								  <th>Credit Amount</th>
								  <th>Debit Amount</th>
								  <th>Balance Amount</th>
								  <th>Remark</th>
								</tr>
						</thead>
					<tbody>
					<?php					
					$que="select * from ledger_info where ledger_status='Active' and session_value='$session1'$condition1$condition2";
					$run=mysqli_query($conn73,$que);
					$serial_no1=0;
					$credit_grand_total=0;
					$debit_grand_total=0;
					$balance_amount=0;
					while($row=mysqli_fetch_assoc($run)){
					$emp_id_or_student_roll_no=$row['emp_id_or_student_roll_no'];
					$emp_or_student_name=strtolower($row['emp_or_student_name']);
					$account_serial_no=$row['account_serial_no'];
					$date=date('d-m-Y',strtotime($row['date']));
					$date11=$row['date'];
					$credit_or_debit_from=$row['credit_or_debit_from'];
					$amount_type=$row['amount_type'];
					$total_amount=$row['total_amount'];
					
					
					$que1="select student_admission_number from student_admission_info where student_roll_no='$emp_id_or_student_roll_no' and student_status='Active' and session_value='$session1'$filter37";
					$run1=mysqli_query($conn73,$que1);
					$student_admission_number='';
					
					if(mysqli_num_rows($run1)){
					    
					    if($amount_type=='Credit'){
						$credit_amount=$total_amount;
						$debit_amount='-----';
						$credit_grand_total=$credit_grand_total+$total_amount;
						$balance_amount=$balance_amount+$total_amount;
						$credit_from1=$credit_or_debit_from;
						$debit_from1='';
					}elseif($amount_type=='Debit'){
						$credit_amount='-----';
						$debit_amount=$total_amount;
						$debit_grand_total=$debit_grand_total+$total_amount;
						$balance_amount=$balance_amount-$total_amount;
						$credit_from1='';
						$debit_from1=$credit_or_debit_from;
					}
					    
					    
					while($row1=mysqli_fetch_assoc($run1)){
					$student_admission_number=$row1['student_admission_number'];
					}
					
					$que2="select account_customer_remark from account_expence_info where s_no='$account_serial_no' and account_status='Active' and session_value='$session1'";
					$run2=mysqli_query($conn73,$que2);
					$account_customer_remark='';
					while($row2=mysqli_fetch_assoc($run2)){
					$account_customer_remark=$row2['account_customer_remark'];
					}
					
					$que3="select blank_field_5 from ".$table_name." where student_roll_no='$emp_id_or_student_roll_no' and fee_submission_date='$date11' and paid_total='$total_amount' and fee_status='Active' and session_value='$session1'";
					$run3=mysqli_query($conn73,$que3);
					$blank_field_5='';
					while($row3=mysqli_fetch_assoc($run3)){
					$blank_field_5=$row3['blank_field_5'];
					}
					
					$serial_no1++;
					?>
					<tr>
					<td><?php echo $serial_no1.'.'; ?></td>
					<td><?php echo $blank_field_5; ?></td>
					<td><?php echo ucwords($emp_or_student_name); ?></td>
					<td><?php echo $student_admission_number; ?></td>
					<td><?php echo $credit_from1; ?></td>
					<td><?php echo $debit_from1; ?></td>
					<td><span style="font-weight:bold;"><?php echo $credit_amount; ?></span></td>					
					<td><span style="font-weight:bold;"><?php echo $debit_amount; ?></span></td>					
					<td><span style="font-weight:bold;"><?php echo $balance_amount; ?></span></td>
					<td><?php echo $account_customer_remark; ?></td>
					</tr>
					<?php }  } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="6"><span style="float:right;font-weight:bold;">Grand Total = </span></td>
					<td><span style="font-weight:bold;"><?php echo $credit_grand_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $debit_grand_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $balance_amount; ?></span></td>
					<td><span style="font-weight:bold;">Cash in Hand</span></td>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Ledger monthly Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>