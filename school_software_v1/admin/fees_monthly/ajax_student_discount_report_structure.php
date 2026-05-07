<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Discount Report Structurewise')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			<td><center><b>STUDENT DISCOUNT STRUCTUREWISE REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>Classwise</b></center></td>
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
					
					$month_code=$_GET['month_code'];
					if($month_code!='All'){
					$month_condition = " and fees_code='$month_code'";
					}else{
					$month_condition = "";
					}
					
					$que01="select * from school_info_monthly_fees where fees_type_name!=''$month_condition and session_value='$session1'$filter37 ORDER BY s_no";
					$run01=mysqli_query($conn73,$que01);
					$fees_count = 0;
					while($row01=mysqli_fetch_assoc($run01)){
					$fees_type_name[] = $row01['fees_type_name'];	
					$fees_code[] = $row01['fees_code'];
					$fees_count++;
					}
					
				  ?>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th rowspan="3">S.No.</th>
								  <th rowspan="3">Student Name</th>
								  <th rowspan="3">Father Name</th>
								  <th rowspan="3">Class (Sec)</th>
								  <th rowspan="3">Contact No</th>
								  <th rowspan="3">Months</th>
								  <?php for($i=0;$i<$serial_no;$i++){ $grand_headwise_discount[$i]=0; ?>
								  <th><?php echo $fee_type1[$i]; ?></th>
								  <?php } ?>
								  <th rowspan="3">Total Discount Amount</th>
								</tr>
								<tr>
								  <th colspan="<?php echo $serial_no; ?>">T = Type, M = Method, A = Amount</th>
								</tr>
								<tr>
								  <?php for($i=0;$i<$serial_no;$i++){ ?>
								  <th>( T / M / A )</th>
								  <?php } ?>
								</tr>
						</thead>
					<tbody>
					<?php					
					$que="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition1$condition2$order_by";
					$run=mysqli_query($conn73,$que);
					$serial_no1=0;
					$grand_total_discount_amount=0;
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$student_roll_no=$row['student_roll_no'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					
					$que1="select * from common_fees_student_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
					$run1=mysqli_query($conn73,$que1);
					while($row1=mysqli_fetch_assoc($run1)){
					
					$total_discount_amount=0;
					for($m=0;$m<$serial_no;$m++){
					//$headwise_discount[$m]=0;
					for($j=0;$j<$fees_count;$j++){
					if($m==0){
						$total_discount_monthwise[$j]=0;
					}
						$student_fee_amount=$row1[$fee[$m].$fees_code[$j]];
						$student_fee_amount_after_disc=$row1[$total_amount_after_discount[$m].$fees_code[$j]];
						$headwise_discount_type[$m][$j]=$row1[$fee_discount_type[$m].$fees_code[$j]];
						$headwise_discount_method[$m][$j]=$row1[$fee_discount_method[$m].$fees_code[$j]];
						$headwise_discount[$m][$j]=($student_fee_amount-$student_fee_amount_after_disc);
						$total_discount_amount=$total_discount_amount+($student_fee_amount-$student_fee_amount_after_disc);
						
						$total_discount_monthwise[$j]=$total_discount_monthwise[$j]+($student_fee_amount-$student_fee_amount_after_disc);
						
						$grand_headwise_discount[$m]=$grand_headwise_discount[$m]+($student_fee_amount-$student_fee_amount_after_disc);
					}
					}
					$grand_total_discount_amount=$grand_total_discount_amount+$total_discount_amount;
					
					if($total_discount_amount>0){
					$serial_no1++;
					for($o=0;$o<$fees_count;$o++){
					$month_ser=$o+1;
					if($o==0){
					?>
					<tr>
					<td rowspan="<?php echo $fees_count; ?>"><?php echo $serial_no1.'.'; ?></td>
					<td rowspan="<?php echo $fees_count; ?>"><?php echo $student_name; ?></td>
					<td rowspan="<?php echo $fees_count; ?>"><?php echo $student_father_name; ?></td>
					<td rowspan="<?php echo $fees_count; ?>"><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td rowspan="<?php echo $fees_count; ?>"><?php echo $student_father_contact_number; ?></td>
					<td><?php echo $month_ser.'. '.$fees_type_name[$o]; ?></td>
					<?php for($k=0;$k<$serial_no;$k++){ ?>
					<td><?php echo $headwise_discount_type[$k][$o].' / '.$headwise_discount_method[$k][$o].' / '.$headwise_discount[$k][$o]; ?></td>
					<?php } ?>
					<td><span style="font-weight:bold;"><?php echo $total_discount_monthwise[$o]; ?></span></td>
					</tr>
					<?php }else{ ?>
					<tr>
					<td><?php echo $month_ser.'. '.$fees_type_name[$o]; ?></td>
					<?php for($k=0;$k<$serial_no;$k++){ ?>
					<td><?php echo $headwise_discount_type[$k][$o].' / '.$headwise_discount_method[$k][$o].' / '.$headwise_discount[$k][$o]; ?></td>
					<?php } ?>
					<td><span style="font-weight:bold;"><?php echo $total_discount_monthwise[$o]; ?></span></td>
					</tr>
					<?php } } } } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="6"><span style="float:right;font-weight:bold;">Total Amount = </span></td>
					<?php for($l=0;$l<$serial_no;$l++){ ?>
					<td><span style="font-weight:bold;"><?php echo $grand_headwise_discount[$l]; ?></span></td>
					<?php } ?>
					<td><span style="font-weight:bold;"><?php echo $grand_total_discount_amount; ?></span></td>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Discount Report Structurewise')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>