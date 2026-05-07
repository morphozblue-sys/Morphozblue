<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Fee Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			$student_roll_no_get=$_GET['student_roll_no'];
			if($student_roll_no_get!='')
			{
			$student_condtion=" and student_roll_no='$student_roll_no_get' ";    
			}
			else{
			  $student_condtion='';  
			}
			
			$payment_mode=$_GET['payment_mode'];
			if($payment_mode!='All'){
				$condition3=" and student_payment_mode='$payment_mode'";
			}else{
				$condition3="";
			}
			
			
			
			$order_by=$_GET['order_by'];
			if($order_by==" ORDER BY student_name ASC"){
			    $order_by1=$order_by;
			}else{
			    $order_by1='';
			}
			
			
			$que_fee_type="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37";
            $run=mysqli_query($conn73,$que_fee_type);
            $serial_no_fee_type=0;
            while($row=mysqli_fetch_assoc($run)){
            $s_no_fee_type=$row['s_no'];
            $fee_type5_fee_type = $row['fee_type'];
            $fee_code_fee_type = $row['fee_code'];
            if($fee_type5_fee_type!=''){
            $fee_type_fee_type = preg_replace('/\s+/', '_', $fee_type5_fee_type);
            $fee_type1_fee_type[$serial_no_fee_type] = $row['fee_type'];
            $fee_type_fee_type=strtolower($fee_type);
            $fee_balance_fee_after_dis[$serial_no_fee_type]="student_".$fee_code_fee_type."_after_discount_month";
            $fee_balance_fee_type[$serial_no_fee_type]="student_".$fee_code_fee_type."_balance_month";
            $fee_balance_fee_type_paid[$serial_no_fee_type]="student_".$fee_code_fee_type."_paid_total_month";
            $serial_no_fee_type++;
            }
            }
			
			 $que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
			 $run01=mysqli_query($conn73,$que01);
			 $sno=0;
			 while($row01=mysqli_fetch_assoc($run01)){
			 $fees_type_name[$sno] = $row01['fees_type_name'];
			 $fees_type = $row01['fees_type'];
			 $fees_code[$sno] = $row01['fees_code'];
			 $fees_count = $row01['fees_count'];
			 $var_condition="month".$fees_code[$sno];
			 $sno++;
			 }
			$update_column_name='';
			$value_after_discount=array();
			$value_balance=array();
			$value_paid=array();
			for($j=0;$j<$serial_no_fee_type;$j++){
			    $fee_name11=$fee_type1_fee_type[$j];
			    
	             for($k=0;$k<$fees_count;$k++){
	                $col_name_af_dis=$fee_balance_fee_after_dis[$j].$fees_code[$k]; 
		            $col_name_bal=$fee_balance_fee_type[$j].$fees_code[$k];
                    $col_name_paid=$fee_balance_fee_type_paid[$j].$fees_code[$k];
                    $col_name_af_dis.','.$col_name_bal.','.$col_name_paid;
	             }
	             
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
			<td><center><b>STUDENT FEE REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>Classwise</b></center></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Student Name</th>
								  <th>Class (Sec)</th>
								  <th>Total Amount</th>
								  <th>Balance Amount</th>
								  <th>Paid Amount</th>
								  <th>Balance Headwise</th>
								  <th>Paid Headwise</th>
								  <tH>&nbsp;</tH>
								  <th>Balance Headwise</th>
								  <th>Paid Headwise</th>
								  <th>Discount</th>
								</tr>
						</thead>
					<tbody>
					<?php
					
					$que="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition1$condition2$student_condtion$order_by1";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					$paid_grand_total=0;
					$all_grand_total=0;
					$all_balance_total=0;
					
					$all_headwise_paid=0;
					$all_headwise_balance=0;
					
					$all_paid_headwise_paid=0;
					$all_paid_headwise_balance=0;
					$all_paid_discount=0;
					$generate_query='';
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$student_roll_no=$row['student_roll_no'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					$student_admission_number=$row['student_admission_number'];
				  	$que1="select * from common_fees_student_fee where fee_status='Active' and student_roll_no='$student_roll_no'  and session_value='$session1'";
					$run1=mysqli_query($conn73,$que1);
					$serial_no2=0;
					$paid_total1=0;
					$paid_discount=0;
					$reciept_no='';
					$comma='';
					$set_fees_af_dis=0;
					if(mysqli_num_rows($run1)>0){
					while($row1=mysqli_fetch_assoc($run1)){
					$s_no=$row1['s_no'];    
					$grand_total=$row1['grand_total'];
					$student_payment_mode=$row1['student_payment_mode'];
					$paid_total=$row1['paid_total'];
					$balance_total=$row1['balance_total'];
					$blank_field_5=$row1[$fee_rec_column_name];
					$fee_paid_months=$row1['fee_paid_months'];
					$paid_total1=$paid_total1+$paid_total;
					$paid_grand_total=$paid_grand_total+$paid_total;
					$all_grand_total=$all_grand_total+$grand_total;
					$all_balance_total=$all_balance_total+$balance_total;
					if($serial_no2!=0){
						$comma=', ';
					}
					$reciept_no=$reciept_no.$comma.$blank_field_5;
					
					$head_wise_paid=0;
					$head_wise_balance=0;
					$head_wise_balance1='';
                    $head_wise_paid1='';
					for($j=0;$j<$serial_no_fee_type;$j++){
	                for($k=0;$k<$fees_count;$k++){
	                 $head_wise_balance1=$fee_balance_fee_type[$j].$fees_code[$k];
	                 $head_wise_paid1=$fee_balance_fee_type_paid[$j].$fees_code[$k];
	                 $set_fees_af_dis1=$fee_balance_fee_after_dis[$j].$fees_code[$k];
                     $set_fees_af_dis+=$row1[$set_fees_af_dis1];
	                 $head_wise_balance+=$row1[$head_wise_balance1];
	                 $head_wise_paid+=$row1[$head_wise_paid1];
	                }
					}
					
					$serial_no2++;
					}
					
					$que1_paid="select * from common_fees_student_fee_add where fee_status='Active' and student_roll_no='$student_roll_no' and session_value='$session1' order by s_no asc";
					$run_paid=mysqli_query($conn73,$que1_paid);
					$paid_head_wise_paid=0;
    				
    				$paid_head_wise_balance1='';
                    $paid_head_wise_paid1='';
					while($row_paid=mysqli_fetch_assoc($run_paid))
					{
					  
					    $paid_discount=$row_paid['blank_field_2'];
					    $all_paid_discount+=$paid_discount;
					    $paid_head_wise_balance=0;
    					for($j=0;$j<$serial_no_fee_type;$j++){
    	                for($k=0;$k<$fees_count;$k++){
    	                 
    	                 $paid_head_wise_balance1=$fee_balance_fee_type[$j].$fees_code[$k];
    	                 $paid_head_wise_paid1=$fee_balance_fee_type_paid[$j].$fees_code[$k];
    	                 
    	                 
    	                 $paid_head_wise_balance+=$row_paid[$paid_head_wise_balance1];
    	                 $paid_head_wise_paid+=$row_paid[$paid_head_wise_paid1];
    	                }
    					}  
					}
					
					$all_headwise_paid+=$head_wise_paid;
                    $all_headwise_balance+=$head_wise_balance;
                    $all_paid_headwise_paid+=$paid_head_wise_paid;
                    $all_paid_headwise_balance+=$paid_head_wise_balance;
                    
                    // UPDATE `common_fees_student_fee` SET `balance_total` = '500' WHERE `common_fees_student_fee`.`s_no` = 3;
                    if($balance_total!=$head_wise_balance || $grand_total!=$set_fees_af_dis)
                    {
					//$generate_query=$generate_query."UPDATE `common_fees_student_fee` SET `grand_total` = '$set_fees_af_dis',`balance_total` = '$head_wise_balance' WHERE `common_fees_student_fee`.`s_no` =$s_no; /* $student_name $student_class $student_roll_no */";
					//$generate_query=$generate_query."<br>";
                    }
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'./'.$s_no; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td><?php echo $grand_total; ?></td>
					<td><?php echo $balance_total; ?></td>
					<td><?php echo $paid_total1; ?></td>	
					<td><?php echo $head_wise_balance; ?></td>
					<td><?php echo $head_wise_paid; ?></td>	
					<tH>&nbsp;</tH>
					<td><?php echo $paid_head_wise_balance; ?></td>
					<td><?php echo $paid_head_wise_paid; ?></td>	
					<td><?php echo $paid_discount; ?></td>	
					</tr>
					<?php } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="3"><span style="float:right;font-weight:bold;">Total Amount = </span></td>
					<td><span style="font-weight:bold;"><?php echo $all_grand_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $all_balance_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $paid_grand_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $all_headwise_balance; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $all_headwise_paid; ?></span></td>
					<td><span style="font-weight:bold;">&nbsp;</span></td>
					<td><span style="font-weight:bold;"><?php echo $all_paid_headwise_balance; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $all_paid_headwise_paid; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $all_paid_discount; ?></span></td>
					</tr>
					</tfoot>
					<?=$generate_query?>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Fee Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>