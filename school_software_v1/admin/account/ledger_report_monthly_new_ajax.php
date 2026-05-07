<?php include("../attachment/session.php"); ?>
<div class="col-sm-12">
<div class="col-sm-6">
<center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Ledger Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-sm-6">
<center><button type="button" class="btn btn-info" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

        <div class="col-md-12">
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
			<div class="col-md-12">
            <div class="box-body table-responsive" id="printTable">
			<?php			
			$from_date=$_GET['from_date'];
			$income_expense=$_GET['income_expense'];
			
			$debit_show=0;
			$credit_show=0;
			if($income_expense=="All"){
			    
			$debit_show=1;
			$credit_show=1;
			}elseif($income_expense=="DEBIT"){
			    
			$debit_show=1;
			$credit_show=0;
			}elseif($income_expense=="CREDIT"){
			    
			$debit_show=0;
			$credit_show=1;
			}
			
			
			if($from_date!=''){
				$from_date1=date('d-m-Y',strtotime($from_date));
				$condition1=" and fee_submission_date>='$from_date'";
				$condition11=" and employee_salary_generate_date>='$from_date'";
				$condition113=" and account_customer_date>='$from_date'";
				$condition0=" and fee_submission_date<'$from_date'";
			}else{
				$from_date1="";
				$condition1="";
				$condition0="";
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=date('d-m-Y',strtotime($to_date));
				$condition2=" and fee_submission_date<='$to_date'";
				$condition22=" and employee_salary_generate_date<='$to_date'";
				$condition223=" and account_customer_date<='$to_date'";
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
			
			
		        	$que121="select use_editable_or_not from login";
					$run121=mysqli_query($conn73,$que121);
					$row121=mysqli_fetch_assoc($run121);
					$use_editable_or_not=$row121['use_editable_or_not'];
					
					if($use_editable_or_not=='Yes')
					$fee_reciept_column='editable_blank_field_5';
					else
					$fee_reciept_column='blank_field_5';
			
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
			<td><center><b>Ledger Report</b></center></td>
			<td style="float:right;">From : <?php echo $from_date1; ?> To : <?php echo $to_date1; ?></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Date</th>
								  <th>Student/EMP Status</th>
								  <th>Student/EMP Name</th>
								  <th>Student/EMP Info</th>
								  <th>Debit/Credit Source</th>
								  <th>Debit/Credit</th>
								  
								  <?php if($credit_show==1){ ?>
								  <th>Amount(CREDIT)</th>
								  <?php }if($debit_show==1){ ?>
								  <th>Amount(DEBIT)</th>
								  <?php } ?>
								  <th>Payment Mode</th>
								  <th>Bill No.</th>
								  <th>Remark</th>
								  <th>Session</th>
								  
								</tr>
						</thead>
					<tbody>
					    
					    
			
					
				
					
				<?php
$qry0001="select * from login";
$rest0001=mysqli_query($conn73,$qry0001);
$use_editable_or_not='';
while($row0001=mysqli_fetch_assoc($rest0001)){
$use_editable_or_not=$row0001['use_editable_or_not'];
}
  if($use_editable_or_not=='Yes' || $use_editable_or_not=='yes'){
    $fee_rec_column_name='editable_receipt_no';
}else{
    $fee_rec_column_name='blank_field_5';
}
						
					$que3="select * from account_expence_info where  account_status='Active' $condition113$condition223 order by account_customer_date ASC";
					$run3=mysqli_query($conn73,$que3);
					
					while($row3=mysqli_fetch_assoc($run3)){
					$fee_submission_date = str_replace("-","",$row3['account_customer_date']);
					if(!isset($date_array[$fee_submission_date])){
					    $total_entry_array[]=$fee_submission_date;
					    $date_array[$fee_submission_date]=1;
					   
					}else{
					    $date_array[$fee_submission_date]=$date_array[$fee_submission_date]+1;
					  
					}
						
					$bill_sno[$fee_submission_date][]=$row3['s_no'];
					$student_name[$fee_submission_date][] = $row3['account_customer_name'];
					$student_emp_info[$fee_submission_date][] = $row3['account_student_or_emp_id'];
					$paid_total[$fee_submission_date][] = $row3['account_customer_total_amount'];
					$fee_submission_date1[$fee_submission_date][] = $row3['account_customer_date'];
					$payment_mode[$fee_submission_date][] = $row3['account_payment_mode'];
					$session_info[$fee_submission_date][] = $row3['session_value'];
					$remark[$fee_submission_date][] = $row3['account_customer_remark'];
					$debit_credit[$fee_submission_date][] = strtoupper($row3['account_amount_type']);
						$debit_credit_type[$fee_submission_date][] = "ACCOUNT";
				
						$student_emp_status[$fee_submission_date][] = "";

					
					}
					
					
					$que3="select * from employee_salary_generate where  employee_salary_status='Active' $condition11$condition22 order by employee_salary_generate_date ASC";
					$run3=mysqli_query($conn73,$que3);
					
					while($row3=mysqli_fetch_assoc($run3)){
					$fee_submission_date = str_replace("-","",$row3['employee_salary_generate_date']);
					if(!isset($date_array[$fee_submission_date])){
					    $total_entry_array[]=$fee_submission_date;
					    $date_array[$fee_submission_date]=1;
					   
					}else{
					    $date_array[$fee_submission_date]=$date_array[$fee_submission_date]+1;
					  
					}
							$session_info[$fee_submission_date][] = $row3['session_value'];
					$bill_sno[$fee_submission_date][]=$row3['s_no'];
					$student_name[$fee_submission_date][] = $row3['employee_name'];
					$student_emp_info[$fee_submission_date][] = $row3['emp_id'];
					$paid_total[$fee_submission_date][] = $row3['final_salary'];
					$fee_submission_date1[$fee_submission_date][] = $row3['employee_salary_generate_date'];
						$debit_credit[$fee_submission_date][] = "DEBIT";
						$debit_credit_type[$fee_submission_date][] = "SALARY";
				
						$payment_mode[$fee_submission_date][] = $row3['salary_payment_mode'];
					$remark[$fee_submission_date][] = $row3['employee_salary_date_from']."/".$row3['employee_salary_date_to'];
				
						$emp_id= $row3['emp_id'];
					
				
					$que1="select emp_status from employee_info where emp_id='$emp_id'";
					$run1=mysqli_query($conn73,$que1);
					
					while($row1=mysqli_fetch_assoc($run1)){
					$student_emp_status[$fee_submission_date][] = $row1['emp_status'];

					}
					}
					
						$que3="select * from ".$table_name." where  fee_status='Active' $condition1$condition2 order by fee_submission_date ASC";
					$run3=mysqli_query($conn73,$que3);
				
					while($row3=mysqli_fetch_assoc($run3)){
					$fee_submission_date = str_replace("-","",$row3['fee_submission_date']);
					if(!isset($date_array[$fee_submission_date])){
					    $total_entry_array[]=$fee_submission_date;
					    $date_array[$fee_submission_date]=1;
					   
					}else{
					    $date_array[$fee_submission_date]=$date_array[$fee_submission_date]+1;
					  
					}
							$session_info[$fee_submission_date][] = $row3['session_value'];
							$session2 = $row3['session_value'];
					$bill_sno[$fee_submission_date][]=$row3[$fee_rec_column_name];
					$student_name[$fee_submission_date][] = $row3['student_name'];
					$student_emp_info[$fee_submission_date][] = $row3['student_father_name']."/".$row3['student_class'];
					$paid_total[$fee_submission_date][] = $row3['paid_total'];
					$fee_submission_date1[$fee_submission_date][] = $row3['fee_submission_date'];
						$debit_credit[$fee_submission_date][] = "CREDIT";
				$debit_credit_type[$fee_submission_date][]="FEES";
						$payment_mode[$fee_submission_date][] = $row3['student_payment_mode'];
					$remark[$fee_submission_date][] = $row3['other_fee_remark'];
					
				$student_id= $row3['student_roll_no'];
					
				
					$que1="select student_status from student_admission_info where student_roll_no='$student_id' and  session_value='$session2'";
					$run1=mysqli_query($conn73,$que1);
					
					while($row1=mysqli_fetch_assoc($run1)){
					$student_emp_status[$fee_submission_date][] = $row1['student_status'];

					}
				
					
					}
					
					
					
					
					
							$que3="select * from common_fees_student_transport_fee_add where  fee_status='Active' $condition1$condition2 order by fee_submission_date ASC";
					$run3=mysqli_query($conn73,$que3);
				
					while($row3=mysqli_fetch_assoc($run3)){
					$fee_submission_date = str_replace("-","",$row3['fee_submission_date']);
					if(!isset($date_array[$fee_submission_date])){
					    $total_entry_array[]=$fee_submission_date;
					    $date_array[$fee_submission_date]=1;
					   
					}else{
					    $date_array[$fee_submission_date]=$date_array[$fee_submission_date]+1;
					  
					}
							$session_info[$fee_submission_date][] = $row3['session_value'];
							$session2 = $row3['session_value'];
					$bill_sno[$fee_submission_date][]=$row3['blank_field_5'];
					$student_name[$fee_submission_date][] = $row3['student_name'];
					$student_emp_info[$fee_submission_date][] = $row3['student_father_name']."/".$row3['student_class'];
					$paid_total[$fee_submission_date][] = $row3['paid_total'];
					$fee_submission_date1[$fee_submission_date][] = $row3['fee_submission_date'];
						$debit_credit[$fee_submission_date][] = "CREDIT";
				$debit_credit_type[$fee_submission_date][]="TRANSPORT FEES";
						$payment_mode[$fee_submission_date][] = $row3['student_payment_mode'];
					$remark[$fee_submission_date][] = $row3['other_fee_remark'];
					
				$student_id= $row3['student_roll_no'];
					
				
					$que1="select student_status from student_admission_info where student_roll_no='$student_id' and  session_value='$session2'";
					$run1=mysqli_query($conn73,$que1);
					
					while($row1=mysqli_fetch_assoc($run1)){
					$student_emp_status[$fee_submission_date][] = $row1['student_status'];

					}
				
					
					}
					
					
					$s_num=0;
					sort($total_entry_array,2);
					for($xx=0;$xx<count($total_entry_array);$xx++){
					    $fee_date=$total_entry_array[$xx];
					for($yy=0;$yy<$date_array[$fee_date];$yy++){
					    
					 
					    
					    if(($debit_credit[$fee_date][$yy]=="CREDIT" && $credit_show==1) || ($debit_credit[$fee_date][$yy]=="DEBIT" && $debit_show==1)){
					     $s_num++;  
					    
					    
					?>
					<tr>
					<td><?php echo $s_num; ?></td>
					
					<td><?php echo $fee_submission_date1[$fee_date][$yy]; ?></td>
					<td><?php echo $student_emp_status[$fee_date][$yy]; ?></td>
					<td><?php echo ucwords($student_name[$fee_date][$yy]); ?></td>
					<td><?php echo ucwords($student_emp_info[$fee_date][$yy]); ?></td>
				     <td><?php echo $debit_credit_type[$fee_date][$yy]; ?></td>
				     <td><?php echo $debit_credit[$fee_date][$yy]; ?></td>
				     <?php if($debit_credit[$fee_date][$yy]=="CREDIT"){
				     
				     $credit_grand_total=$credit_grand_total+$paid_total[$fee_date][$yy];
				     ?>
				     
								  <?php if($credit_show==1){ ?>
					<td><?php echo $paid_total[$fee_date][$yy]; ?></td>
					
								  <?php }if($debit_show==1){ ?>
					<td></td>
					
								  <?php }?>
					<?php }else{
					 $debit_grand_total=$debit_grand_total+$paid_total[$fee_date][$yy];
				    
					?>
					  <?php if($credit_show==1){ ?>
						<td></td>
								  <?php }if($debit_show==1){ ?>
				
						<td><?php echo $paid_total[$fee_date][$yy]; ?></td>
				
					
								  <?php }?>
					<?php } ?>
					<td><?php echo $payment_mode[$fee_date][$yy]; ?></td>
					
					<td><?php echo $bill_sno[$fee_date][$yy]; ?></td>
					<td><?php echo $remark[$fee_date][$yy]; ?></td>
					<td><?php echo $session_info[$fee_date][$yy]; ?></td>
					
					
					</tr>
					<?php } } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="7"><span style="float:right;font-weight:bold;">Grand Total = </span></td>
					
								  <?php if($credit_show==1){ ?>
					<td><span style="font-weight:bold;"><?php echo $credit_grand_total; ?></span></td>
					
								  <?php }if($debit_show==1){ ?>
					<td><span style="font-weight:bold;"><?php echo $debit_grand_total; ?></span></td>
					
								  <?php }?>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-sm-12">&nbsp;</div>
			  <div class="col-sm-12">
			  <div class="col-sm-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Ledger monthly Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-sm-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>