<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Expense Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
				$condition1=" and account_customer_date>='$from_date'";
				$condition01=" and date>='$from_date'";
			}else{
				$from_date1="";
				$condition1="";
				$condition01="";
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=date('d-m-Y',strtotime($to_date));
				$condition2=" and account_customer_date<='$to_date'";
				$condition02=" and date<='$to_date'";
			}else{
				$to_date1="";
				$condition2="";
				$condition02="";
			}
			$income_expense=$_GET['income_expense'];
			if($income_expense!=''){
				$condition3=" and account_amount_type='$income_expense'";
				$condition03=" and amount_type='$income_expense'";
			}else{
				$condition3="";
				$condition03="";
			}
			$income_expense_heads=$_GET['income_expense_heads'];
			if($income_expense_heads!='All'){
				$condition4=" and emp_or_student_name='$income_expense_heads'";
				$condition04=" and account_customer_name='$income_expense_heads'";
			}else{
				$condition4="";
				$condition04="";
			}
			
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code,fees_category from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			$fees_category=$schl_row['fees_category'];
			}
			
			?>
			<table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			<tr>
			<td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			</tr>
			<tr>
			<td style="float:left;"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			<td><center><b><?php if($income_expense=='Credit'){ echo 'Income'; }elseif($income_expense=='Debit'){ echo 'Expense'; }else{ echo 'Income/Expense'; } ?> Report</b></center></td>
			<td style="float:right;"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td style="float:left;">&nbsp;</td>
			<td><center><b>&nbsp;</b></center></td>
			<td style="float:right;">From : <?php echo $from_date1; ?> To : <?php echo $to_date1; ?></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead >
								<tr>
								  <th>#</th>
								  <th>Date</th>
								  <th><?php if($income_expense=='Credit'){ echo 'Income'; }elseif($income_expense=='Debit'){ echo 'Expense'; }else{ echo 'Income/Expense'; } ?> Details</th>
								  <th><?php if($income_expense=='Credit'){ echo 'Income'; }elseif($income_expense=='Debit'){ echo 'Expense'; }else{ echo 'Income/Expense'; } ?> Amount</th>
								  <th>Payment Mode</th>
								</tr>
						</thead>
					<tbody>
					<?php
					$que1="select * from ledger_info where ledger_status='Active' and blank_field_3!='Refund' and session_value='$session1'$condition01$condition02$condition03$condition4";
					$run1=mysqli_query($conn73,$que1);
					$serial_no1=0;
					$grand_total_amount=0;
					while($row1=mysqli_fetch_assoc($run1)){
					$emp_id_or_student_roll_no=$row1['emp_id_or_student_roll_no'];
					$credit_or_debit_from=$row1['credit_or_debit_from'];
					$account_serial_no=$row1['account_serial_no'];
					$total_amount=$row1['total_amount'];
					$payment_mode=$row1['payment_mode'];
							$date=$row1['date'];
					if($date!=''){
					    $date=date('d-m-Y', strtotime($date));
					}
					$income_exp_detail='';
					if($credit_or_debit_from=='account'){
					$que="select * from account_expence_info where account_status='Active' and session_value='$session1' and s_no='$account_serial_no'$condition1$condition2$condition3$condition04";
					$run=mysqli_query($conn73,$que);
					while($row=mysqli_fetch_assoc($run)){
					$account_customer_date=$row['account_customer_date'];    
					$account_customer_name=$row['account_customer_name'];
					$account_customer_remark=$row['account_customer_remark'];
					$account_customer_contact_no=$row['account_customer_contact_no'];
					$income_exp_detail=$account_customer_remark.' ( '.$account_customer_name.' - '.$account_customer_contact_no.' )';
					}
					}elseif($credit_or_debit_from=='salary'){
					$emp_or_student_name=$row1['emp_or_student_name'];
					$income_exp_detail='Salary ( '.$emp_or_student_name.' )';
					}
					$grand_total_amount=$grand_total_amount+$total_amount;
					
					$serial_no1++;
					?>
					<tr>
					<td><?php echo $serial_no1.'.'; ?></td>
					<td><?php echo $date; ?></td>
					<td><?php echo $income_exp_detail; ?></td>
					<td><?php echo $total_amount; ?></td>
					<td><?php echo $payment_mode; ?></td>
					</tr>
					<?php } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="3"><span style="float:right;font-weight:bold;">Grand Total = </span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_amount; ?></span></td>
					<td><span style="font-weight:bold;">&nbsp;</span></td>
					</tr>
					<tr>
					<td colspan="5" style="height:100px;"><span style="float:right;">Signature........................................</span></td>
					</tr>
					</tfoot>
				 </table>
			
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Expense Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>