<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Headwise Balance Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			$class_name=$_POST['class_name'];
			if($class_name!='All'){
				$condition1=" and student_class='$class_name'";
			}else{
				$condition1="";
			}
			$section_name=$_POST['section_name'];
			if($section_name!='All'){
				$condition2=" and student_class_section='$section_name'";
			}else{
				$condition2="";
			}
			$order_by=$_POST['order_by'];
			
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
			<td><center><b>STUDENT BALANCE REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td style="float:left">Current Date : <?php echo date('d-m-Y'); ?></td>
			<td><center><b>Headwise</b></center></td>
			<td style="float:right">Class (Sec) : <?php echo $class_name.' ( '.$section_name.' )'; ?></td>
			</tr>
			</table>
				  
				  <?php
				  $bus_fee_category=$_POST['bus_fee_category'];
				  $increment_colspan=5;
				  if(!empty($_POST['head_code'])){
				  $head_code=$_POST['head_code'];
				  $head_name=$_POST['head_name'];
				  $code_count=count($head_code);
				  }else{
				  $code_count=0;
				  }
				  
				  $previous_head_dues=$_POST['previous_head_dues'];
				  $transport_head_dues=$_POST['transport_head_dues'];
					
					$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
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
								  <th>S.No.</th>
								  <th>Student Name</th>
								  <th>Father Name</th>
								  <th>Class (Sec)</th>
								  <?php if($bus_fee_category!=''){ $increment_colspan=6; ?>
								  <th>Bus Category</th>
								  <?php } ?>
								  <th>Contact No</th>
								  <?php for($i=0;$i<$code_count;$i++){ ?>
								  <th><?php echo 'Total '.$head_name[$i]; ?></th>
								  <th><?php echo 'Paid '.$head_name[$i]; ?></th>
								  <th><?php echo 'Balance '.$head_name[$i]; ?></th>
								  <?php } ?>
								  <?php if($previous_head_dues!=''){ ?>
								  <th>Total Previous Dues</th>
								  <th>Paid Previous Dues</th>
								  <th>Balance Previous Dues</th>
								  <?php } ?>
								  <?php if($transport_head_dues!=''){ ?>
								  <th>Total Transport Fee</th>
								  <th>Paid Transport Fee</th>
								  <th>Balance Transport Fee</th>
								  <?php } ?>
								</tr>
						</thead>
					<tbody>
					<?php					
					$que="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition1$condition2$order_by";
					$run=mysqli_query($conn73,$que);
					$serial_no1=0;
					$grand_total_previous_year_fee=0;
					$grand_total_previous_year_fee_paid_total=0;
					$grand_total_previous_year_fee_balance=0;
					$grand_total_transport_fee=0;
					$grand_total_transport_fee_paid_total=0;
					$grand_total_transport_fee_balance=0;
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$student_roll_no=$row['student_roll_no'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					$student_bus_fee_category=$row['student_bus_fee_category'];
					
					
					$que1="select * from common_fees_student_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
					$run1=mysqli_query($conn73,$que1);
					while($row1=mysqli_fetch_assoc($run1)){
					
					$student_previous_year_fee=$row1['student_previous_year_fee'];
					$student_previous_year_fee_paid_total=$row1['student_previous_year_fee_paid_total'];
					$student_previous_year_fee_balance=$row1['student_previous_year_fee_balance'];
					$student_transport_fee=$row1['student_transport_fee'];
					$student_transport_fee_paid_total=$row1['student_transport_fee_paid_total'];
					$student_transport_fee_balance=$row1['student_transport_fee_balance'];
					
					$grand_total_previous_year_fee=$grand_total_previous_year_fee+$student_previous_year_fee;
					$grand_total_previous_year_fee_paid_total=$grand_total_previous_year_fee_paid_total+$student_previous_year_fee_paid_total;
					$grand_total_previous_year_fee_balance=$grand_total_previous_year_fee_balance+$student_previous_year_fee_balance;
					$grand_total_transport_fee=$grand_total_transport_fee+$student_transport_fee;
					$grand_total_transport_fee_paid_total=$grand_total_transport_fee_paid_total+$student_transport_fee_paid_total;
					$grand_total_transport_fee_balance=$grand_total_transport_fee_balance+$student_transport_fee_balance;
					
					for($l=0;$l<$code_count;$l++){
					    if($serial_no1==0){
                        $grand_total_fees[$l]=0;
                        $grand_total_fees_paid[$l]=0;
                        $grand_total_fees_balance[$l]=0;
					    }
					    $total_fees[$l]=0;
					    $total_fees_paid[$l]=0;
					    $total_fees_balance[$l]=0;
					
					for($m=0;$m<$fees_count;$m++){
						$total_fees[$l]=$total_fees[$l]+$row1["student_".$head_code[$l]."_total_amount_after_discount_month".$fees_code[$m]];
						$total_fees_paid[$l]=$total_fees_paid[$l]+$row1["student_".$head_code[$l]."_paid_total_month".$fees_code[$m]];
						$total_fees_balance[$l]=$total_fees_balance[$l]+$row1["student_".$head_code[$l]."_balance_month".$fees_code[$m]];
					}
					
                    $grand_total_fees[$l]=$grand_total_fees[$l]+$total_fees[$l];
                    $grand_total_fees_paid[$l]=$grand_total_fees_paid[$l]+$total_fees_paid[$l];
                    $grand_total_fees_balance[$l]=$grand_total_fees_balance[$l]+$total_fees_balance[$l];
					
					}
					
					$serial_no1++;
					?>
					<tr>
					<td><?php echo $serial_no1.'.'; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_father_name; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<?php if($bus_fee_category!=''){ ?>
                    <td><?php echo $student_bus_fee_category; ?></td>
                    <?php } ?>
					<td><?php echo $student_father_contact_number; ?></td>
                    <?php for($j=0;$j<$code_count;$j++){ ?>
                    <td><?php echo $total_fees[$j]; ?></td>
                    <td><?php echo $total_fees_paid[$j]; ?></td>
                    <td><?php echo $total_fees_balance[$j]; ?></td>
                    <?php } ?>
                    <?php if($previous_head_dues!=''){ ?>
                    <td><?php echo $student_previous_year_fee; ?></td>
                    <td><?php echo $student_previous_year_fee_paid_total; ?></td>
                    <td><?php echo $student_previous_year_fee_balance; ?></td>
                    <?php } ?>
                    <?php if($transport_head_dues!=''){ ?>
                    <td><?php echo $student_transport_fee; ?></td>
                    <td><?php echo $student_transport_fee_paid_total; ?></td>
                    <td><?php echo $student_transport_fee_balance; ?></td>
                    <?php } ?>
					</tr>
					<?php } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="<?php echo $increment_colspan; ?>"><span style="float:right;font-weight:bold;">Total Amount = </span></td>
					<?php for($k=0;$k<$code_count;$k++){ ?>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_fees[$k]; ?></span></td>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_fees_paid[$k]; ?></span></td>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_fees_balance[$k]; ?></span></td>
                    <?php } ?>
                    <?php if($previous_head_dues!=''){ ?>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_previous_year_fee; ?></span></td>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_previous_year_fee_paid_total; ?></span></td>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_previous_year_fee_balance; ?></span></td>
                    <?php } ?>
                    <?php if($transport_head_dues!=''){ ?>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_transport_fee; ?></span></td>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_transport_fee_paid_total; ?></span></td>
                    <td><span style="font-weight:bold;"><?php echo $grand_total_transport_fee_balance; ?></span></td>
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
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Headwise Balance Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>