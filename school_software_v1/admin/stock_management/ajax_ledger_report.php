<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Stock Ledger Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>">
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			<?php
			
			$debit_credit_type=$_GET['debit_credit_type'];
			if($debit_credit_type!='All'){
				$condition1=" and ledger_account_type='$debit_credit_type'";
			}else{
				$condition1="";
			}
			
			$from_date=$_GET['from_date'];
			if($from_date!=''){
				$from_date1=explode('-',$from_date);
				$from_date2=$from_date1[2].'/'.$from_date1[1].'/'.$from_date1[0];
				$condition2=" and ledger_invoice_date>='$from_date'";
			}else{
				$from_date2='';
				$condition2="";
			}
			
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=explode('-',$to_date);
				$to_date2=$to_date1[2].'/'.$to_date1[1].'/'.$to_date1[0];
				$condition3=" and ledger_invoice_date<='$to_date'";
			}else{
				$to_date2='';
				$condition3="";
			}
			
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			}
			?>
			<table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			<tr>
			<td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			</tr>
			<tr>
			<td style="float:left"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			<td><center><b>STOCK LEDGER REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>From <?php echo $from_date2; ?> To <?php echo $to_date2; ?></b></center></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead >
								<tr>
								  <th>S.No.</th>
								  <th>Invoice No.</th>
								  <th>Student / Customer / Vendor Name</th>
								  <th>Invoice Date</th>
								  <th>Income From</th>
								  <th>Expense</th>
								  <th>Credit Amount</th>
								  <th>Debit Amount</th>
								  <th>Bal Amount</th>
								  <th>Remark</th>
								</tr>
						</thead>
					<tbody>
					<?php
				
					
					$que1="select * from new_stock_ledger where ledger_status='Active' and session_value='$session1'$condition1$condition2$condition3";
					$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
					$serial_no=0;
					$total_balance=0;
					$grand_total_credit=0;
					$grand_total_debit=0;
					$grand_total_balance=0;
					while($row1=mysqli_fetch_assoc($run1)){
					$ledger_account_type=$row1['ledger_account_type'];
					$ledger_type=$row1['ledger_type'];
					$ledger_invoice_no=$row1['ledger_invoice_no'];
					$ledger_student_customer_id=$row1['ledger_student_customer_id'];
					$ledger_invoice_date=$row1['ledger_invoice_date'];
					$ledger_item_s_no=$row1['ledger_item_s_no'];
					$ledger_payable_amount=$row1['ledger_payable_amount'];
					$ledger_payment_mode=$row1['ledger_payment_mode'];
					$ledger_cheque_date=$row1['ledger_cheque_date'];
					//$ledger_remark=$row1['ledger_remark'];
					
					if($ledger_payment_mode=='NEFT'){
					$ledger_common_bank_name=$row1['ledger_neft_bank_name'];
					$ledger_common_bank_acount_number=$row1['ledger_neft_bank_acount_number'];
					}else{
					$ledger_common_bank_name=$row1['ledger_cheque_bank_name'];
					$ledger_common_bank_acount_number=$row1['ledger_cheque_number'];
					}
					
					if($ledger_invoice_date!='' && $ledger_invoice_date!='0000-00-00'){
						$ledger_invoice_date=date('d-m-Y',strtotime($ledger_invoice_date));
					}
					
					$student_customer_vendor_name='';
					if($ledger_type=='Student'){
					$que="select * from student_admission_info where student_status='Active' and student_roll_no='$ledger_student_customer_id' and session_value='$session1'";
					$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					while($row=mysqli_fetch_assoc($run)){
					$student_customer_vendor_name=$row['student_name']." (".$row['student_class'].")";
					//$student_father_name=$row['student_father_name'];
					//$student_class=$row['student_class'];
					//$student_class_section=$row['student_class_section'];
					}
					}elseif($ledger_type=='Customer'){
					$que2="select * from customer_detail where customer_status='Active' and s_no='$ledger_student_customer_id'";
					$run2=mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
					while($row2=mysqli_fetch_assoc($run2)){
					$student_customer_vendor_name=$row2['customer_name'].' ('.$row2['customer_contact'].')';
					}
					}elseif($ledger_type=='Vendor'){
					$que3="select * from vendor_detail where vendor_status='Active' and s_no='$ledger_student_customer_id'";
					$run3=mysqli_query($conn73,$que3) or die(mysqli_error($conn73));
					while($row3=mysqli_fetch_assoc($run3)){
					$student_customer_vendor_name=$row3['vendor_name'].' ('.$row3['vendor_contact'].')';
					}
					}
					
					if($ledger_type=='' && $ledger_invoice_no==0){
					    $student_customer_vendor_name='Opening Balance';
					}
					
					if($ledger_account_type=="Credit"){
					$income=$ledger_type;
					$expense='-----';
					$credit_amount=$ledger_payable_amount;
					$debit_amount='-----';
					$total_balance=$total_balance+$ledger_payable_amount;
					$grand_total_credit=$grand_total_credit+$ledger_payable_amount;
					}elseif($ledger_account_type=="Debit"){
					$income='-----';
					$expense=$ledger_type;
					$credit_amount='-----';
					$debit_amount=$ledger_payable_amount;
					$total_balance=$total_balance-$ledger_payable_amount;
					$grand_total_debit=$grand_total_debit+$ledger_payable_amount;
					}
					$grand_total_balance=$grand_total_balance+$total_balance;
					
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $ledger_invoice_no; ?></td>
					<td><?php echo $student_customer_vendor_name; ?></td>
					<td><?php echo $ledger_invoice_date; ?></td>
					<td><?php echo $income; ?></td>
					<td><?php echo $expense; ?></td>
					<td><?php echo $credit_amount; ?></td>
					<td><?php echo $debit_amount; ?></td>
					<td><?php echo $total_balance; ?></td>
					<td><?php echo ''; ?></td>
					
					</tr>
					<?php } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="6"><span style="float:right;font-weight:bold;">Grand Total = </span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_credit; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_debit; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $total_balance; ?></span></td>
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
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Stock Ledger Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>