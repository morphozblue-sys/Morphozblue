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
            
            	$std_month=$_GET['std_month'];
			if($std_month!=''){
				$std_fees_count=1;
			}else{
				$std_fees_count=0;
			}
            
            
            
            $payment_mode=$_GET['Payment_mode'];
            if($payment_mode=='All')
            {
              $condition6="";
            }
            elseif($payment_mode=='Online')
            {
                $condition6=" and student_payment_mode !='Cash'"; 
            }
            else
            {
              $condition6=" and student_payment_mode='$payment_mode'"; 
            }
            
            $que0="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
            $run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73)) ;
            $serial_no0=0;
            while($row0=mysqli_fetch_assoc($run0)){
            $s_no=$row0['s_no'];
            $fee_type = $row0['fee_type'];
            $fee_code = $row0['fee_code'];
            if($fee_type!=''){
            $fee_type1[$serial_no0] = $row0['fee_type'];
            $fee_code1[$serial_no0] = $row0['fee_code'];
            $fee_type=strtolower($fee_type);
            $fee[$serial_no0]="student_".$fee_code."_month";
            $fee_discount_type[$serial_no0]="student_".$fee_code."_discount_month";
            $fee_discount_method[$serial_no0]="student_".$fee_code."_discount_method_month";
            $fee_discount_amount[$serial_no0]="student_".$fee_code."_discount_amount_month";
            $total_amount_after_discount[$serial_no0]="student_".$fee_code."_total_amount_after_discount_month";
            $fee_balance[$serial_no0]="student_".$fee_code."_balance_month";
            $fee_paid[$serial_no0]="student_".$fee_code."_paid_total_month";
            
            $fee_paid="student_".$fee_code."_paid_total_month";
            
            
            $serial_no0++;
            } 
                
            }
			
			
			$std_month=$_GET['std_month'];
			if($std_month!=''){
				$std_fees_count=1;
			}else{
				$std_fees_count=0;
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
			
			$fee_status=$_GET['fee_status'];
			if($fee_status=='All'){
				$condition05=" ";
			}elseif($fee_status=='Deactive'){
				$condition05=" and fee_status='$fee_status'";
			}else{
				$condition05="and fee_status='$fee_status'";
			}
			$order_by=$_GET['order_by'];
			if($order_by)
			{
			  if($use_editable_or_not=="Yes")
			  $order_by="order by editable_receipt_no";    
			}
		    
			$user_detail=$_GET['user_detail'];
			if($user_detail!='All'){
			    $user_detail1=explode('|?|',$user_detail);
				$condition5=" and (update_change='$user_detail1[0]' or update_change='$user_detail1[1]')";
			}else{
				$condition5="";
			}
			
			$total_str_span=6;
			$total_num_span=4;
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
								  <th>Adm No.</th>
								  <?php if($_SESSION['software_link']=='cambridgeschoolpatna'){ ?>
								  <th>Roll No</th>
								  <?php } ?>
								  <th>Receipt No</th>
								  <th>Date</th>
								  <th>Student Name</th>
								  <?php if($_SESSION['software_link']!='pragyaschoolsasaram'){ ?>
								  <th>Father Name</th>
								  <?php } ?>
								  <?php $inc_no=0; if($_SESSION['software_link']=='pragyaschoolsasaram'){ $inc_no=1; ?>
								  <th>Roll No</th>
								  <?php } ?>
								  <th>Class (Sec)</th>
								  <?php if($transport_checked=='No'){ ?>
								  <th>Receive</th>
								  <?php }else{ ?>
								  <th>Route & Bus No.</th>
								  <th>Transport Receive</th>
								  <?php } ?>
								  <th>Through</th>
								   <?php if($_SESSION['software_link']=='sanskarschoolnarsinghpur'){ ?>
								  <th>Trans. ID</th>
								  <?php } ?>
								  <th>ch. / DD No.</th>
								  <th>Bank Name</th>
								  <?php if($_SESSION['software_link']!='pragyaschoolsasaram'){ ?>
								  <th>Monthly </th>
								  <?php } ?>
								  <th>Updated By</th>
								  <?php if($_SESSION['software_link']=='pragyaschoolsasaram'){ ?>
								  <th>Balance</th>
								  <th>Discount</th>
								  <?php } ?>
								</tr>
						</thead>
					<tbody>
					<?php
					
			    	$que1="select * from common_fees_student_fee_add where session_value='$session1'$condition1$condition2$condition3$condition4$condition05$condition6$condition5$order_by";
					
					$run1=mysqli_query($conn73,$que1);
					$serial_no=0;
					$paid_grand_total=0;
					$all_grand_total=0;
					$all_balance_total=0;
					$trans_paid_grand_total=0;
					$grand_total_discount=0;
					while($row1=mysqli_fetch_assoc($run1)){
					$grand_total=$row1['grand_total'];
					$paid_total=$row1['paid_total'];
					$balance_total=$row1['balance_total'];
					$blank_field_2=$row1['blank_field_2'];
					$update_change=$row1['update_change'];
					$blank_field_3=$row1['blank_field_3'];
					$blank_field_5=$row1[$fee_rec_column_name];
					$fee_submission_date=$row1['fee_submission_date'];
					$student_roll_no=$row1['student_roll_no'];
					$fee_paid_months=$row1['fee_paid_months'];
					$monthly_balance_amount=0;
					
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
					$month_exp[1]=$fee_paid_months;
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
						for($qe=0; $qe<$serial_no0; $qe++){
						$monthly_balance_amount=$monthly_balance_amount+$row1[$fee_balance[$qe].$month_exp[$w]];
						}
					}
							$month_strcount1=substr_count($fee_paid_months);
				// 	if($month_strcount1>0){
			
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
					$student_roll_no=$row['student_roll_no'];
					if($student_admission_number==''){$student_admission_number=$student_scholar_number;}
					$student_bus_route=$row['student_bus_route'];
					$student_bus_no=$row['student_bus_no'];
					
					$paid_grand_total=$paid_grand_total+$paid_total;
					$all_grand_total=$all_grand_total+$grand_total;
					$all_balance_total=$all_balance_total+$balance_total;
					$grand_total_discount=$grand_total_discount+$blank_field_2;
					
					$trans_paid_grand_total=$trans_paid_grand_total+$monthly_tran_amt;
					
					
				$monthly_amount=0;
					$monthly_paid_amount=0;
					for($u=0;$u<$std_fees_count;$u++){
					for($v=0;$v<$serial_no11;$v++){
						$monthly_amount=$monthly_amount+$row1[$total_amount_after_discount[$v].$std_month];
						$monthly_paid_amount=$monthly_paid_amount+$row1[$fee_paid[$v].$std_month];
					}
					}
					
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $student_admission_number; ?></td>
					<?php if($_SESSION['software_link']=='cambridgeschoolpatna'){ ?>
				    <td><?php echo $school_roll_no; ?></td>
					<?php } ?>
					<td><?php echo $blank_field_5; ?></td>
					<td><?php echo $fee_submission_date; ?></td>
					<td><?php echo $student_name; ?></td>
					<?php if($_SESSION['software_link']!='pragyaschoolsasaram'){ ?>
					<td><?php echo $student_father_name; ?></td>
					<?php } ?>
                    <?php if($_SESSION['software_link']=='pragyaschoolsasaram'){ ?>
                    <td><?php echo $school_roll_no; ?></td>
                    <?php } ?>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<?php if($transport_checked=='No'){ ?>
					<td><?php echo $paid_total; ?></td>
                    <?php }else{ ?>
                    <td><?php echo $student_bus_route.' ('.$student_bus_no.')'; ?></td>
                    <td><?php echo $monthly_tran_amt; ?></td>
                    <?php } ?>
					<td><?php echo $student_payment_mode; ?></td>
					<?php if($_SESSION['software_link']=='sanskarschoolnarsinghpur'){ ?>
					<td><?php echo $blank_field_3; ?></td>
					 <?php } ?>
					<td><?php echo $cheque_no; ?></td>
					<td><?php echo $cheque_bank_name; ?></td>
					<?php if($_SESSION['software_link']!='pragyaschoolsasaram'){ ?>
					<td><?php echo $fee_paid_months; ?></td>
					<?php } ?>
					<!--<td><?php echo $fees_type_name[$std_month].' / '.$monthly_paid_amount; ?></td>-->
					<td><?php echo $update_change; ?></td>
					<?php if($_SESSION['software_link']=='pragyaschoolsasaram'){ ?>
                    <td><?php echo $monthly_balance_amount; ?></td>
                    <td><?php echo $blank_field_2; ?></td>
                    <?php } ?>
					
					</tr>
					<?php } } }?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="<?php echo $total_str_span+$inc_no; ?>"><span style="float:right;font-weight:bold;">Total = </span></td>
					<?php if($transport_checked=='No'){ ?>
					<td colspan="<?php echo $total_num_span; ?>"><span style="font-weight:bold;"><?php echo $paid_grand_total; ?></span></td>
					<?php }else{ ?>
					<td colspan="<?php echo $total_num_span; ?>"><span style="font-weight:bold;"><?php echo $trans_paid_grand_total; ?></span></td>
					<?php } ?>
					<?php if($_SESSION['software_link']=='pragyaschoolsasaram'){ ?>
                    <td><span style="font-weight:bold;">&nbsp;</span></td>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_discount; ?></span></td>
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
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Fee Daily Collection Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>