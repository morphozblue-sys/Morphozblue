<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Fee Daily Collection Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

        <div class="col-md-12">
          <!-- /.box -->
          <div class="box">
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			<?php
			
			$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
			$run01=mysqli_query($conn73,$que01);
			while($row01=mysqli_fetch_assoc($run01)){//echo "<pre>" ; print_r($row01);
			$fees_code1 = $row01['fees_code'];
			$fees_type = $row01['fees_type'];
			$fees_type_name[$fees_code1] = $row01['fees_type_name'];
			$fees_code[$fees_code1] = $row01['fees_code'];
			}
// 			$office_account_sno=$_GET['office_account_sno'];
			$bus_fee_category=$_GET['student_bus_fee_category'];
			$student_bus_route1=$_GET['student_bus_route'];
			$increment_colspan=6;
			
			$class_name=$_GET['class_name'];
			if($class_name!='All'){
				$condition1=" and student_class='$class_name'";
			}else{
				$condition1="";
			}
			
			$student_bus=$_GET['student_bus'];
			if($student_bus!='All'){
				$condition_bus=" and student_bus='$student_bus'";
			}else{
				$condition_bus="";
			}
			
			$section_name=$_GET['section_name'];
			if($section_name!='All'){
				$condition2=" and student_class_section='$section_name'";
			}else{
				$condition2="";
			}
			$from_date=$_GET['from_date'];
			if($from_date!=''){
				$from_date1=explode('-',$from_date);
				$from_date2=$from_date1[2].'/'.$from_date1[1].'/'.$from_date1[0];
				$condition3=" and fee_submission_date>='$from_date'";
			}else{
				$from_date2='';
				$condition3="";
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=explode('-',$to_date);
				$to_date2=$to_date1[2].'/'.$to_date1[1].'/'.$to_date1[0];
				$condition4=" and fee_submission_date<='$to_date'";
			}else{
				$to_date2='';
				$condition4="";
			}
			
			$fee_status=$_GET['fee_status'];
			if($fee_status!='All'){
				$condition21=" and student_status='$fee_status'";
			}else{
				$condition21="";
			}
			
			$receipt_status=$_GET['receipt_status'];
			if($receipt_status!='All'){
				$receipt_status_condition=" and fee_status='$receipt_status'";
			}else{
				$receipt_status_condition="";
			}
			
			$order_by=$_GET['order_by'];
			$user_detail=$_GET['user_detail'];
			if($user_detail!='All'){
				$condition5=" and update_change='$user_detail'";
			}else{
				$condition5="";
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
			<td><center><b>STUDENT FEE DAILY COLLECTION REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>From <?php echo $from_date2; ?> To <?php echo $to_date2; ?></b></center></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Receipt No</th>
								  <th>Date</th>
								  <th>Student Name</th>
								  <th>Student SR No</th>
								  <?php if($bus_fee_category!=''){ $increment_colspan=6; ?>
								  <th>Bus Category</th>
								  <?php } ?>
								  <?php if($student_bus_route1!=''){ $increment_colspan=6+1; ?>
								  <th>Bus Route</th>
								  <?php } ?>
								  <th>Class (Sec)</th>
								  <th>Receive</th>
								  <th>Through</th>
								  <th>ch. / DD No.</th>
								   <th>Transection id</th>
								  <th>Bank Name</th>
								  <th>Monthly </th>
								  <th>User Name</th>
								  <th>Date & Time</th>
								  <th>Discount Remark</th>
								</tr>
						</thead>
					<tbody>
					<?php
				
				    $quer = "select use_editable_or_not from login"; 
				    $res=mysqli_query($conn73,$quer) or die(mysqli_error($conn73));
				    while($row111=mysqli_fetch_assoc($res)){//echo "<pre>" ; print_r($row111);
                    $use_editable_or_not=$row111['use_editable_or_not'];
				    }
				    
				    
				    $que1="select * from common_fees_student_fee_add where session_value='$session1'$condition1$condition2$condition3$condition4$condition5$receipt_status_condition$order_by";
					$run1=mysqli_query($conn73,$que1);
					$serial_no=0;
					$cash_transaction=0;
					$cheque_transaction=0;
					$neft_transaction=0;
					$challan_transaction=0;
					$paid_grand_total=0;
					$all_grand_total=0;
					$all_balance_total=0;
					while($row1=mysqli_fetch_assoc($run1)){ 
					$grand_total=$row1['grand_total'];
					$paid_total=$row1['paid_total'];
					$balance_total=$row1['balance_total'];
					$transaction_no=$row1['blank_field_3'];
					$blank_field_5=$row1['blank_field_5'];
					$editable_receipt_no=$row1['editable_receipt_no'];
					$fee_submission_date=$row1['fee_submission_date'];
					$student_roll_no=$row1['student_roll_no'];
					$fee_paid_months=$row1['fee_paid_months'];
			        $office_account_sno=$row1['office_account_sno'];
			        $discount_remark=$row1['blank_field_1'];
			        if($office_account_sno==""){
			            $office_account_sno1="other";
			        }else{
			            $office_account_sno1=$office_account_sno;
			        }
					if(isset($accountwise_amount[$office_account_sno1])){
					    $accountwise_amount[$office_account_sno1]=$accountwise_amount[$office_account_sno1]+$paid_total;
					    $accountwise_transcation[$office_account_sno1]=$accountwise_transcation[$office_account_sno1]+1;
					}else{
					    $accountwise_amount[$office_account_sno1]=$paid_total;
					    $accountwise_transcation[$office_account_sno1]=1;
					}
					$update_change=$row1['update_change'];
					if($row1['last_updated_date']!='' && $row1['last_updated_date']!='0000-00-00'){
					$last_updated_date=date('d-m-Y h:i:s',strtotime($row1['last_updated_date']));
					}else{
					$last_updated_date=$row1['last_updated_date'];
					}
					
				    $student_payment_mode=$row1['student_payment_mode'];
					if(!isset($student_payment_mode_array[$student_payment_mode])){
					    $student_payment_mode_array[$student_payment_mode]=0;
					    $student_payment_mode_name_array[]=$student_payment_mode;
					}
					$student_payment_mode_array[$student_payment_mode]=$student_payment_mode_array[$student_payment_mode]+1;
					if($student_payment_mode=='NEFT'){
					$cheque_no=$row1['neft_bank_account_no'];
					$cheque_bank_name=$row1['neft_bank_name'];
					}else{
					$cheque_no=$row1['cheque_no'];
					$cheque_bank_name=$row1['cheque_bank_name'];
					}
					if(isset($paymentmodewise_amount[$student_payment_mode])){
					    $paymentmodewise_amount[$student_payment_mode]=$paymentmodewise_amount[$student_payment_mode]+$paid_total;
					}else{
					    $paymentmodewise_amount[$student_payment_mode]=$paid_total;
					}
				
				
				//     $office_account_sno=$row1['office_account_sno'];
				// 	if(!isset($office_account_sno_array[$office_account_sno])){
				// 	    $office_account_sno_array[$office_account_sno]=0;
				// 	    $office_account_sno_name_array[]=$office_account_sno;
				// 	}
				//     $office_account_sno_array[$office_account_sno]=$office_account_sno_array[$office_account_sno]+1;
				// 	if($office_account_sno=='bank_account_no'){
				// 	$bank_account_no=$row1['bank_account_no'];
				// 	}else{
				// 	$bank_account_no=$row1['bank_account_no'];
				// 	}
					
					
					
					
					if($fee_submission_date!=''){
						$fee_submission_date1=explode('-',$fee_submission_date);
						$fee_submission_date=$fee_submission_date1[2].'-'.$fee_submission_date1[1].'-'.$fee_submission_date1[0];
					}
					
					$month_strcount1=substr_count($fee_paid_months,',');
					if($month_strcount1>0){
					$month_exp=explode(',',$fee_paid_months);
					$month_count=count($month_exp);
					}else{
					$month_exp[0]=$fee_paid_months;
					$month_count=1;
					}
					$show_month_name='';
					$comma='';
					for($w=0;$w<$month_count;$w++){
						if($w!=0){
							$comma=', ';
						}
						$show_month_name=$show_month_name.$comma.$fees_type_name[$month_exp[$w]];
					}
					
					$que="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'$condition1$condition2$condition_bus$condition21";
					$run=mysqli_query($conn73,$que);
					while($row=mysqli_fetch_assoc($run)){ 
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$school_roll_no=$row['school_roll_no'];
					$student_admission_number=$row['student_admission_number'];
					$student_scholar_number=$row['student_scholar_number'];
					$student_bus_fee_category=$row['student_bus_fee_category'];
					$student_bus_route=$row['student_bus_route'];
					
					if($student_admission_number==''){ $student_admission_number=$student_scholar_number; }
					$student_father_contact_number=$row['student_father_contact_number'];
					$paid_grand_total=$paid_grand_total+$paid_total;
					$all_grand_total=$all_grand_total+$grand_total;
					$all_balance_total=$all_balance_total+$balance_total;
					
					if($student_payment_mode=='Cash'){
                        $cash_transaction++;
					}elseif($student_payment_mode=='Cheque'){
                        $cheque_transaction++;
					}elseif($student_payment_mode=='NEFT'){
                        $neft_transaction++;
					}elseif($student_payment_mode=='Challan'){
                        $challan_transaction++;
					}elseif($student_payment_mode=='Challan'){
                        $challan_transaction++;
					}elseif($student_payment_mode=='Challan'){
                        $challan_transaction++;
					}
					
					if($office_account_sno=='office_account_sno'){
                        $office_account_sno++;
					}elseif($office_account_sno=='office_account_sno'){
                        $office_account_sno++;
					}
					
					$serial_no++;
					$colspan_row=0;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<?php if($use_editable_or_not!='Yes'){ ?>
					<td><?php echo $blank_field_5; ?></td>
					<?php }else{ ?> 
					<td><?php echo $editable_receipt_no; ?></td>
					<?php } ?>
					<td><?php echo $fee_submission_date; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_admission_number; ?></td>
					<?php if($bus_fee_category!=''){ $colspan_row++; ?>
                    <td><?php echo $student_bus_fee_category; ?></td>
                    <?php } ?>
                    <?php if($student_bus_route1!=''){ $colspan_row++; ?>
                    <td><?php echo $student_bus_route; ?></td>
                    <?php } ?>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td><?php echo $paid_total; ?></td>
					<td><?php echo $student_payment_mode; ?></td>
					<td><?php echo $cheque_no; ?></td>
					<td><?php echo $transaction_no; ?></td>
					<td><?php echo $cheque_bank_name; ?></td>
					<td><?php echo $fee_paid_months; ?></td>
                    <td><?php echo $update_change; ?></td>
                    <td><?php echo $last_updated_date; ?></td>
                    <td><?php echo "$discount_remark"; ?></td>
					
					</tr>
					<?php } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="<?php echo $colspan_row+6; ?>"><span style="float:right;font-weight:bold;">Total Contribution = </span></td>
					<td colspan="6"><span style="font-weight:bold;"><?php echo $paid_grand_total; ?></span></td>
					</tr>
					</tfoot>
				 </table>
				<div class="col-md-12">&nbsp;</div>
				<div class="col-md-12"><center><h2>Transaction Details</h2></center></div>
				<div class="col-md-8 col-md-offset-2">
				    
                <table class="table table-bordered table-striped" border="1px" cellpadding="10px" align="center" cellspacing="0" width="50%">
                	<thead>
                	<tr>
                	  <th>S.No.</th>
                	  <th>Transaction Type</th>
                	  <th>Total Transaction</th>
                	  <th>Total Amount</th>
                	</tr>
                	</thead>
                	
                	<tbody>
                	    <?php 
                	    $total_paymentmodewise_trannscation=0;
                	    for($ss=0;$ss<count($student_payment_mode_name_array);$ss++){
                	    
                	    $total_paymentmodewise_trannscation=$total_paymentmodewise_trannscation+$paymentmodewise_amount[$student_payment_mode_name_array[$ss]];
                	    ?>
                	    
                	<tr>
                	  <td><?php echo $ss+1; ?></td>
                	  <td><?php echo $student_payment_mode_name_array[$ss]; ?></td>
                	  <td><?php echo $student_payment_mode_array[$student_payment_mode_name_array[$ss]]; ?></td>
                	  <td><?php echo $paymentmodewise_amount[$student_payment_mode_name_array[$ss]]; ?></td>
                	 
                	  
                	</tr>
                	<?php } ?>
                	<tr>
                	    <th colspan="3">Total</th>
                	     <th><?php echo $total_paymentmodewise_trannscation; ?></th>
                	</tr>
                	</tbody>
                </table>
                </div>
                	<div class="col-md-8 col-md-offset-2">
				    
                <table class="table table-bordered table-striped" border="1px" cellpadding="10px" align="center" cellspacing="0" width="50%">
                	<thead>
                	<tr>
                	  <th>S.No.</th>
                	  <th>Account Number</th>
                	   <th>Account Holder</th>
                	   <th>Account Bank </th>
                	  <th>Total Transaction</th>
                	  <th>Total Amount</th>
                	</tr>
                	</thead>
                	
                	<tbody>
                	   	  
                	  <?php  
                	  $total_amountwise_trannscation=0;
                	  
                	  $que="select * from account_office_bank_account";
                        $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                        while($row=mysqli_fetch_assoc($run)){
                        $s_no=$row['s_no'];
                        $bank_account_holder_name =$row['bank_account_holder_name'];
                        $bank_account_no=$row['bank_account_no'];
                        $bank_name=$row['bank_name'];
                        $total_amountwise_trannscation=$total_amountwise_trannscation+$accountwise_amount[$s_no];
			
			   $sss++; 
			    ?> 
                	<tr>
                	  <td><?php echo $sss; ?></td>
                	  
			     <td><?php echo $bank_account_no; ?></td>
			     <td><?php echo $bank_account_holder_name; ?></td>
			      <td><?php echo $bank_name; ?></td>
			      <td><?php echo $accountwise_transcation[$s_no]; ?></td>
			      <td><?php echo $accountwise_amount[$s_no]; ?></td>
			     
                	</tr>
                	<?php } ?>
                 
                	<tr>
                	  <td><?php echo $sss+1; ?></td>
                	  
			     <td>Other</td>
			     <td></td>
			      <td></td>
			      <td><?php echo $accountwise_amount['other']; ?></td>
			      <td></td>
			      <td></td>
                	</tr>
                	<tr>
                	    <th colspan="4">Total</th>
                	     <th><?php echo $total_amountwise_trannscation+$accountwise_amount['other']; ?></th>
                	</tr>
                	</tbody>
                </table>
                </div>
			  
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Fee Daily Collection Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>