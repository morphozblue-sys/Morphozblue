<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Paytime Discount Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
            $qry0001="select * from login";
            $rest0001=mysqli_query($conn73,$qry0001);
            $use_editable_or_not='';
            while($row0001=mysqli_fetch_assoc($rest0001)){
            $use_editable_or_not=$row0001['use_editable_or_not'];
            }
            if($use_editable_or_not=='Yes'){
            $fee_rec_column_name='editable_receipt_no';
            }else{
            $fee_rec_column_name='blank_field_5';
            }
			
			$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
			$run01=mysqli_query($conn73,$que01);
			while($row01=mysqli_fetch_assoc($run01)){
			$fees_code1 = $row01['fees_code'];
			$fees_type = $row01['fees_type'];
			$fees_type_name[$fees_code1] = $row01['fees_type_name'];
			$fees_code[$fees_code1] = $row01['fees_code'];
			}
			
			$class_name=$_GET['class_name'];
			if($class_name!='All'){
				$condition1=" and student_class='$class_name'";
			}else{
				$condition1="";
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
			$order_by=$_GET['order_by'];
			$condition11='';
			if($order_by!=''){
					if($order_by=='student_name'){
					    $condition11 =" ORDER BY $order_by ASC";
					}elseif($order_by=='editable_receipt_no'){
					    $condition11 =" ORDER BY CAST($order_by AS UNSIGNED) ASC";
					}
					elseif($order_by=='blank_field_5'){
					    $condition11 =" ORDER BY CAST($order_by AS UNSIGNED) ASC";
					}elseif($order_by=='fee_submission_date'){
					    $condition11 =" ORDER BY $order_by ASC";
					}
					}else{
					$condition11="";
					}
			
			
			$total_str_span=6;
			$total_num_span=2;
			$transport_condition="";
			$transport_checked=$_GET['transport_checked'];
			if($transport_checked!='No'){
			$transport_condition=" and student_bus='Yes'";
			$total_str_span=7;
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
			<td><center><b>DAILY PAYTIME DISCOUNT REPORT</b></center></td>
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
								  <th>Adm No.</th>
								  <th>Receipt No</th>
								  <th>Date</th>
								  <th>Student Name</th>
								  <th>Class (Sec)</th>
								  <?php if($transport_checked=='No'){ ?>
								  <th>Discount Amount</th>
								  <th>Discount Remark</th>
								  <?php }else{ ?>
								  <th>Route & Bus No.</th>
								  <th>Transport Receive</th>
								  <?php } ?>
								</tr>
						</thead>
					<tbody>
					<?php
				
					
					$que1="select * from common_fees_student_fee_add where fee_status='Active' and blank_field_2>0 and session_value='$session1'$condition1$condition2$condition3$condition4$condition11";
					$run1=mysqli_query($conn73,$que1);
					$serial_no=0;
					$paid_grand_total=0;
					$all_grand_total=0;
					$all_balance_total=0;
					$trans_paid_grand_total=0;
					$blank_field_2_grand_total=0;
					while($row1=mysqli_fetch_assoc($run1)){
					$grand_total=$row1['grand_total'];
					$paid_total=$row1['paid_total'];
					$balance_total=$row1['balance_total'];
					$blank_field_5=$row1[$fee_rec_column_name];
					$fee_submission_date=$row1['fee_submission_date'];
					$student_roll_no=$row1['student_roll_no'];
					$fee_paid_months=$row1['fee_paid_months'];
					$blank_field_2=$row1['blank_field_2'];
					$blank_field_1=$row1['blank_field_1'];
					
					$student_payment_mode=$row1['student_payment_mode'];
					if($student_payment_mode=='NEFT'){
					$cheque_no=$row1['neft_bank_account_no'];
					$cheque_bank_name=$row1['neft_bank_name'];
					}else{
					$cheque_no=$row1['cheque_no'];
					$cheque_bank_name=$row1['cheque_bank_name'];
					}
					
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
					$monthly_tran_amt=0;
					$comma='';
					for($w=0;$w<$month_count;$w++){
						if($w!=0){
							$comma=', ';
						}
						$show_month_name=$show_month_name.$comma.$fees_type_name[$month_exp[$w]];
						if($transport_checked!='No'){
						$monthly_tran_amt=$monthly_tran_amt+$row1['student_'.$transport_checked.'_paid_total_month'.$month_exp[$w]];
						}
					}
					
					if(($transport_checked!='No' && $monthly_tran_amt>0) || ($transport_checked=='No')){
					$que="select * from student_admission_info where student_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1'$condition1$condition2$transport_condition";
					$run=mysqli_query($conn73,$que);
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					$student_admission_number=$row['student_admission_number'];
					$student_scholar_number=$row['student_scholar_number'];
					if($student_admission_number==''){$student_admission_number=$student_scholar_number;}
					$student_bus_route=$row['student_bus_route'];
					$student_bus_no=$row['student_bus_no'];
					
					$paid_grand_total=$paid_grand_total+$paid_total;
					$all_grand_total=$all_grand_total+$grand_total;
					$all_balance_total=$all_balance_total+$balance_total;
					
					$trans_paid_grand_total=$trans_paid_grand_total+$monthly_tran_amt;
					$blank_field_2_grand_total=$blank_field_2_grand_total+$blank_field_2;
					
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $student_admission_number; ?></td>
					<td><?php echo $blank_field_5; ?></td>
					<td><?php echo $fee_submission_date; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<?php if($transport_checked=='No'){ ?>
					<td><?php echo $blank_field_2; ?></td>
					<td><?php echo $blank_field_1; ?></td>
                    <?php }else{ ?>
                    <td><?php echo $student_bus_route.' ('.$student_bus_no.')'; ?></td>
                    <td><?php echo $monthly_tran_amt; ?></td>
                    <?php } ?>
					</tr>
					<?php } } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="<?php echo $total_str_span; ?>"><span style="float:right;font-weight:bold;">Total = </span></td>
					<?php if($transport_checked=='No'){ ?>
					<td colspan="<?php echo $total_num_span; ?>"><span style="font-weight:bold;"><?php echo $blank_field_2_grand_total; ?></span></td>
					<?php }else{ ?>
					<td colspan="<?php echo $total_num_span; ?>"><span style="font-weight:bold;"><?php echo $trans_paid_grand_total; ?></span></td>
					<?php } ?>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Paytime Discount Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>