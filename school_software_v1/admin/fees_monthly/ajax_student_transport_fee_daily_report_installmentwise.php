<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Transport Fee Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			$order_by=$_GET['order_by'];
			$user_detail=$_GET['user_detail'];
			if($user_detail!='All'){
				$condition5=" and update_change='$user_detail'";
			}else{
				$condition5="";
			}
			
			$que01="select * from school_info_monthly_transport_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
			$run01=mysqli_query($conn73,$que01);
			while($row01=mysqli_fetch_assoc($run01)){
			$fees_code1 = $row01['fees_code'];
			$fees_type = $row01['fees_type'];
			$fees_type_name[$fees_code1] = $row01['fees_type_name'];
			$fees_code[$fees_code1] = $row01['fees_code'];
			}
			
// 			$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
// 			$run=mysqli_query($conn73,$que);
// 			$serial_no11=0;
// 			while($row=mysqli_fetch_assoc($run)){
// 			$fee_type5 = $row['fee_type'];
// 			$fee_code = $row['fee_code'];
// 			if($fee_type5!=''){
// 			$fee_type = preg_replace('/\s+/', '_', $fee_type5);
// 			$fee_type1[$serial_no11] = $row['fee_type'];
// 			$fee_type=strtolower($fee_type);
// 			$fee_paid[$serial_no11]="student_".$fee_code."_paid_total_month";
// 			$total_amount_after_discount[$serial_no11]="student_".$fee_code."_total_amount_after_discount_month";
// 			$serial_no11++;
// 			}
// 			}
			
			$std_installment=$_GET['std_installment'];
			if($std_installment!=''){
				$std_fees_count=1;
			}else{
				$std_fees_count=0;
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
			<td><center><b>STUDENT TRANSPORT FEE REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b><?php echo ucfirst($fees_type); ?></b></center></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Student Name</th>
								  <th>Father Name</th>
								  <th>Class (Sec)</th>
								  <th>Contact No</th>
								  <th>Receipt No</th>
								  <th>Submission Date</th>
								  <th>Month / Amount</th>
								  <th>Month Paid / Amount</th>
								  <th>Total Amount</th>
								  <th>Balance Amount</th>
								  <th>Paid Amount</th>								  
								</tr>
						</thead>
					<tbody>
					<?php
					
					$que1="select * from common_fees_student_transport_fee_add where fee_status='Active' and session_value='$session1'$condition1$condition2$condition5$order_by";
					$run1=mysqli_query($conn73,$que1);
					$serial_no=0;
					$paid_grand_total=0;
					$all_grand_total=0;
					$all_balance_total=0;
					while($row1=mysqli_fetch_assoc($run1)){
					$grand_total=$row1['grand_total'];
					$paid_total=$row1['paid_total'];
					$balance_total=$row1['balance_total'];
					$blank_field_5=$row1['blank_field_5'];
					$fee_submission_date=$row1['fee_submission_date'];
					$student_roll_no=$row1['student_roll_no'];
					$fee_paid_months=$row1['fee_paid_months'];
					
					if($fee_submission_date!=''){
						$fee_submission_date1=explode('-',$fee_submission_date);
						$fee_submission_date=$fee_submission_date1[2].'-'.$fee_submission_date1[1].'-'.$fee_submission_date1[0];
					}
					
					$month_strcount1=substr_count($fee_paid_months,$std_installment);
					if($month_strcount1>0){
					$que="select * from student_admission_info where student_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1'$condition1$condition2";
					$run=mysqli_query($conn73,$que);
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					
					$installment_amount=0;
					$installment_paid_amount=0;
					for($u=0;$u<$std_fees_count;$u++){
					for($v=0;$v<$serial_no11;$v++){
						$installment_amount=$installment_amount+$row1[$total_amount_after_discount[$v].$std_installment];
						$installment_paid_amount=$installment_paid_amount+$row1[$fee_paid[$v].$std_installment];
					}
					}
					$paid_grand_total=$paid_grand_total+$paid_total;
					$all_grand_total=$all_grand_total+$grand_total;
					$all_balance_total=$all_balance_total+$balance_total;
					
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_father_name; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td><?php echo $student_father_contact_number; ?></td>
					<td><?php echo $blank_field_5; ?></td>
					<td><?php echo $fee_submission_date; ?></td>
					<td><?php echo $fees_type_name[$std_installment].' / '.$installment_amount; ?></td>
					<td><?php echo $fees_type_name[$std_installment].' / '.$installment_paid_amount; ?></td>
					<td><?php echo $grand_total; ?></td>
					<td><?php echo $balance_total; ?></td>
					<td><?php echo $paid_total; ?></td>					
					</tr>
					<?php } } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="11"><span style="float:right;font-weight:bold;">Total Contribution = </span></td>
					<!-- <td><span style="font-weight:bold;"><?php echo $all_grand_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $all_balance_total; ?></span></td> -->
					<td><span style="font-weight:bold;"><?php echo $paid_grand_total; ?></span></td>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Transport Fee Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>