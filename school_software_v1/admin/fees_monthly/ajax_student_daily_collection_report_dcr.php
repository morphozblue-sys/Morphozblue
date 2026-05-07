<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'DCR Download')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			
			$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
			$run01=mysqli_query($conn73,$que01);
			while($row01=mysqli_fetch_assoc($run01)){
			$fees_code1 = $row01['fees_code'];
			$fees_type = $row01['fees_type'];
			$fees_type_name[$fees_code1] = $row01['fees_type_name'];
			$fees_code[$fees_code1] = $row01['fees_code'];
			}
			
            $que0="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
            $run0=mysqli_query($conn73,$que0);
            $head_s_no=0;
            while($row0=mysqli_fetch_assoc($run0)){
            $s_no=$row0['s_no'];
            $fee_type5 = $row0['fee_type'];
            $fee_code = $row0['fee_code'];
            if($fee_type5!=''){
            $fee_type = preg_replace('/\s+/', '_', $fee_type5);
            $fee_type1[$head_s_no] = $row0['fee_type'];
            $fee_type=strtolower($fee_type);
            $fee[$head_s_no]="student_".$fee_code."_month";
            $fee_balance[$head_s_no]="student_".$fee_code."_balance_month";
            $fee_paid[$head_s_no]="student_".$fee_code."_paid_total_month";
            $total_amount_after_discount[$head_s_no]="student_".$fee_code."_total_amount_after_discount_month";
            $headwise_grand_total[$head_s_no]=0;
            $headwise_balance_grand_total[$head_s_no]=0;
            $head_s_no++;
            }
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
				$from_date2=$from_date1[2].'-'.$from_date1[1].'-'.$from_date1[0];
				$condition3=" and fee_submission_date='$from_date'";
				$condition03=" and fee_submission_date<'$from_date'";
			}else{
				$from_date2='';
				$condition3="";
				$condition03="";
			}
			$order_by=$_GET['order_by'];
			
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
			<td><center><b>DAILY COLLECTION REPORT ( DCR )</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td style="float:left"><b>Date : <?php echo $from_date2; ?></b></td>
			<td><center><b>&nbsp;</b></center></td>
			<td style="float:right"><b>&nbsp;</b></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Adm. No</th>
								  <th>School Roll No</th>
								  <th>Name</th>
								  <th>Class</th>
								  <th>Receipt No. / For Month</th>
								  <?php for($ab=0;$ab<$head_s_no;$ab++){ ?>
								  <th><?php echo $fee_type1[$ab]; ?></th>
								  <th><?php echo $fee_type1[$ab].' Balance'; ?></th>
								  <?php } ?>
								  <th>Previous Dues Fee</th>
								  <th>Previous Dues Fee Balance</th>
								  <th>Conc. Fee</th>
								  <th>Total Paid</th>
								  <th>Total Balance</th>
								</tr>
						</thead>
					<tbody>
					<?php
				    $fees_type_name11=array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"May","06"=>"Jun","07"=>"Jul","08"=>"Aug","09"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec");
					
					$que1="select * from common_fees_student_fee_add where fee_status='Active' and session_value='$session1'$condition1$condition2$condition3$order_by";
					$run1=mysqli_query($conn73,$que1);
					$serial_no=0;
					$paid_grand_total=0;
					$all_grand_total=0;
					$all_balance_total=0;
					$all_discount_total=0;
					$all_previous_year_fee_paid_total=0;
					$all_previous_year_fee_balance=0;
					$all_balance_total11=0;
					while($row1=mysqli_fetch_assoc($run1)){
					$grand_total=$row1['grand_total'];
					$paid_total=$row1['paid_total'];
					$balance_total=$row1['balance_total'];
					$blank_field_5=$row1[$fee_rec_column_name];
					$fee_submission_date=$row1['fee_submission_date'];
					$student_roll_no=$row1['student_roll_no'];
					$fee_paid_months=$row1['fee_paid_months'];
					$blank_field_2=$row1['blank_field_2'];
					$student_previous_year_fee_paid_total=$row1['student_previous_year_fee_paid_total'];
					$student_previous_year_fee_balance=$row1['student_previous_year_fee_balance'];
					
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
					$comma='';
					for($w=0;$w<$month_count;$w++){
						if($w!=0){
							$comma=', ';
						}
						$show_month_name=$show_month_name.$comma.$fees_type_name11[$month_exp[$w]];
					}
					
					$que="select * from student_admission_info where student_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1'$condition1$condition2";
					$run=mysqli_query($conn73,$que);
					$balance_total11=0;
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					$student_admission_number=$row['student_admission_number'];
					$student_scholar_number=$row['student_scholar_number'];
					if($student_admission_number==''){
					    $student_admission_number=$student_scholar_number;
					}
					
					$paid_grand_total=$paid_grand_total+$paid_total;
					$all_grand_total=$all_grand_total+$grand_total;
					$all_balance_total=$all_balance_total+$balance_total;
					$all_discount_total=$all_discount_total+$blank_field_2;
					$all_previous_year_fee_paid_total=$all_previous_year_fee_paid_total+$student_previous_year_fee_paid_total;
					$all_previous_year_fee_balance=$all_previous_year_fee_balance+$student_previous_year_fee_balance;
					$balance_total11=$balance_total11+$student_previous_year_fee_balance;
					$all_balance_total11=$all_balance_total11+$student_previous_year_fee_balance;
					
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $student_admission_number; ?></td>
					<td><?php echo $school_roll_no; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td><?php echo $blank_field_5.' / '.$show_month_name; ?></td>
					<?php
					for($ac=0;$ac<$head_s_no;$ac++){
					$fee_head_amount_monthly=0;
					$fee_head_balance_amount_monthly=0;
					for($w1=0;$w1<$month_count;$w1++){
					    $fee_head_amount_monthly=$fee_head_amount_monthly+$row1[$fee_paid[$ac].$month_exp[$w1]];
					    $fee_head_balance_amount_monthly=$fee_head_balance_amount_monthly+$row1[$fee_balance[$ac].$month_exp[$w1]];
					}
					$headwise_grand_total[$ac]=$headwise_grand_total[$ac]+$fee_head_amount_monthly;
					$headwise_balance_grand_total[$ac]=$headwise_balance_grand_total[$ac]+$fee_head_balance_amount_monthly;
					$balance_total11=$balance_total11+$fee_head_balance_amount_monthly;
					$all_balance_total11=$all_balance_total11+$fee_head_balance_amount_monthly;
					?>
					<td><?php echo $fee_head_amount_monthly; ?></td>
					<td><?php echo $fee_head_balance_amount_monthly; ?></td>
					<?php } ?>
					<td><?php echo $student_previous_year_fee_paid_total; ?></td>
					<td><?php echo $student_previous_year_fee_balance; ?></td>
					<td><?php echo $blank_field_2; ?></td>
					<td><?php echo $paid_total; ?></td>
					
					<td><?php echo $balance_total11; ?></td>
					
					</tr>
					<?php } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="3"><span style="font-weight:bold;">Total Receipt : <?php echo $serial_no; ?></span></td>
					<td colspan="3"><span style="float:right;font-weight:bold;">Grand Total : </span></td>
					<?php for($ad=0;$ad<$head_s_no;$ad++){ ?>
					<td><span style="font-weight:bold;"><?php echo $headwise_grand_total[$ad]; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $headwise_balance_grand_total[$ad]; ?></span></td>
					<?php } ?>
					<td><span style="font-weight:bold;"><?php echo $all_previous_year_fee_paid_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $all_previous_year_fee_balance; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $all_discount_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $paid_grand_total; ?></span></td>
					
					<td><span style="font-weight:bold;"><?php echo $all_balance_total11; ?></span></td>
					</tr>
					</tfoot>
				 </table>
				<?php
                $que_01="select paid_total from common_fees_student_fee_add where fee_status='Active' and session_value='$session1'$condition1$condition2$condition03$order_by";
                $run_01=mysqli_query($conn73,$que_01);
                $paid_total_01=0;
                while($row_01=mysqli_fetch_assoc($run_01)){
                $paid_total_01=$paid_total_01+$row_01['paid_total'];
                }
				?>
                <table cellspacing="0" cellpadding="10px;" class="" style="width:100%">
                <tr>
                <td>Previous Closing : </td>
                <td><?php echo $paid_total_01; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td>Total Collection : </td>
                <td><?php echo $paid_total_01+$paid_grand_total; ?></td>
                <td><center>Principal / Director Sign.</center></td>
                <td><center>Accountant Sign.</center></td>
                <td><center>Cashier Sign.</center></td>
                </tr>
                <tr style="display:none;">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><center>Principal / Director Sign.</center></td>
                <td><center>Accountant Sign.</center></td>
                <td><center>Cashier Sign.</center></td>
                </tr>
                </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'DCR Download')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>