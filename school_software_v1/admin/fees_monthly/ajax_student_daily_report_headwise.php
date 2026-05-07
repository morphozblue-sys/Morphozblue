<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Daily Report Headwise')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

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
?>

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
			$from_date=$_GET['from_date'];
			if($from_date!=''){
			$from_date1=explode('-',$from_date);
			$from_date2=$from_date1[2].'-'.$from_date1[1].'-'.$from_date1[0];
			$frm_condition=" and fee_submission_date>='$from_date'";
			}else{
			$from_date2='';
			$frm_condition="";	
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
			$to_date1=explode('-',$to_date);
			$to_date2=$to_date1[2].'-'.$to_date1[1].'-'.$to_date1[0];
			$to_condition=" and fee_submission_date<='$to_date'";
			}else{
			$to_date2='';
			$to_condition="";
			}
			$order_by=$_GET['order_by'];
			if($order_by=="Receipt Number ASC"){
			   $order_by=" ORDER BY  CAST($fee_rec_column_name as SIGNED)  ASC"; 
			}
			if($order_by=="Receipt Number DESC"){
			   $order_by=" ORDER BY  CAST($fee_rec_column_name as SIGNED)   DESC"; 
	  
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
			<td><center><b>STUDENT DAILY REPORT HEADWISE</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td style="float:left"><b>Current Date : <?php echo date('d-m-Y'); ?></b></td>
			<td><center><b>FROM : <?php echo $from_date2; ?> TO : <?php echo $to_date2; ?></b></center></td>
			<td style="float:right"><b>Class (Sec) : <?php echo $class_name.' ( '.$section_name.' )'; ?></b></td>
			</tr>
			</table>
				  
				  <?php
					$que0="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
					$run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73)) ;
					$serial_no=0;
					while($row0=mysqli_fetch_assoc($run0)){
					$s_no=$row0['s_no'];
					$fee_type = $row0['fee_type'];
					$fee_code = $row0['fee_code'];
					if($fee_type!=''){
					$fee_type1[$serial_no] = $row0['fee_type'];
					$fee_code1[$serial_no] = $row0['fee_code'];
					$fee_type=strtolower($fee_type);
					$fee[$serial_no]="student_".$fee_code."_month";
					$fee_discount_type[$serial_no]="student_".$fee_code."_discount_month";
					$fee_discount_method[$serial_no]="student_".$fee_code."_discount_method_month";
					$fee_discount_amount[$serial_no]="student_".$fee_code."_discount_amount_month";
					$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
					$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
					$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
					$serial_no++;
					} }
					
					$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
					$run01=mysqli_query($conn73,$que01);
					while($row01=mysqli_fetch_assoc($run01)){
					$fees_code = $row01['fees_code'];
					$fees_type_name[$fees_code] = $row01['fees_type_name'];
					}
					
				  ?>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Admission No.</th>
								  <th>Student Name</th>
								  <th>Father Name</th>
								  <th>Class (Sec)</th>
								  <th>Contact No</th>
								  <th>Reciept No</th>
								  <th>Months</th>
								  <?php for($i=0;$i<$serial_no;$i++){ $headwise_total_amt[]=0; ?>
								  <th><?php echo $fee_type1[$i]; ?></th>
								  <?php } ?>
								  <th>Transport Amount</th>
								  <th>Other Fee</th>
								  <th>Penalty Amount</th>
								  <th>Total Paid Amount</th>
								</tr>
						</thead>
					<tbody>
					<?php					
								$serial_no1=0;
					$grand_total_amount=0;
					$grand_total_transport=0;
					$grand_total_other=0;
					$grand_total_penalty=0;
					$que1="select * from common_fees_student_fee_add where fee_status='Active' and session_value='$session1' $frm_condition$to_condition $order_by";
					$run1=mysqli_query($conn73,$que1);
					while($row1=mysqli_fetch_assoc($run1)){
					
					$reciept_no=$row1[$fee_rec_column_name];
					$fee_paid_months=$row1['fee_paid_months'];
					$student_transport_fee_paid_total=$row1['student_transport_fee_paid_total'];
					$penalty_amount=$row1['penalty_amount'];
					$other_fee_amount=$row1['other_fee_amount'];
						$student_roll_no=$row1['student_roll_no'];
				
					//$=$row1[''];
					$month_strcount1=substr_count($fee_paid_months,",");
					if($month_strcount1>0){
						$fees_code=explode(",",$fee_paid_months);
						$month_count=count($fees_code);
					}else{
						$fees_code=array();
						$month_count=1;
						$fees_code[]=$fee_paid_months;
					}
					
					
					
					
					$que="select * from student_admission_info where student_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'$condition1$condition2";
					$run=mysqli_query($conn73,$que);
		
					while($row=mysqli_fetch_assoc($run)){ 
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$student_roll_no=$row['student_roll_no'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					$student_admission_number=$row['student_admission_number'];
					
					
					
					$studentwise_total_amount=0;
					for($m=0;$m<$serial_no;$m++){
					$month_name='';
					$comma=', ';
					$student_headwise_amount[$m]=0;
					for($j=0;$j<$month_count;$j++){
					
						$month_name=$month_name.$fees_type_name[$fees_code[$j]].$comma;
						$student_headwise_amount[$m]=$student_headwise_amount[$m]+$row1[$fee_paid[$m].$fees_code[$j]];
						$studentwise_total_amount=$studentwise_total_amount+$row1[$fee_paid[$m].$fees_code[$j]];
						//$student_fee_amount_after_disc=$row1[$total_amount_after_discount[$m].$fees_code[$j]];
						//$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
						//$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
						//$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
					}
					$headwise_total_amt[$m]=$headwise_total_amt[$m]+$student_headwise_amount[$m];
					}
					$studentwise_total_amount=$studentwise_total_amount+$student_transport_fee_paid_total+$penalty_amount+$other_fee_amount;
					$grand_total_amount=$grand_total_amount+$studentwise_total_amount;
					$grand_total_transport=$grand_total_transport+$student_transport_fee_paid_total;
					$grand_total_other=$grand_total_other+$other_fee_amount;
					$grand_total_penalty=$grand_total_penalty+$penalty_amount;
					
					$serial_no1++;
					?>
					<tr>
					<td><?php echo $serial_no1.'.'; ?></td>
					<td><?php echo $student_admission_number;?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_father_name; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td><?php echo $student_father_contact_number; ?></td>
					<td><?php echo $reciept_no; ?></td>
					<td><?php echo $month_name; ?></td>
					<?php for($k=0;$k<$serial_no;$k++){ ?>
					<td><?php echo $student_headwise_amount[$k]; ?></td>
					<?php } ?>
					<td><?php echo $student_transport_fee_paid_total; ?></td>
					<td><?php echo $other_fee_amount; ?></td>
					<td><?php echo $penalty_amount; ?></td>
					<td><span style="font-weight:bold;"><?php echo $studentwise_total_amount; ?></span></td>
					</tr>
					<?php } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="8"><span style="float:right;font-weight:bold;">Total Amount = </span></td>
					<?php for($l=0;$l<$serial_no;$l++){ ?>
					<td><span style="font-weight:bold;"><?php echo $headwise_total_amt[$l]; ?></span></td>
					<?php } ?>
					<td><span style="font-weight:bold;"><?php echo $grand_total_transport; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_other; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_penalty; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_total_amount; ?></span></td>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Daily Report Headwise')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>