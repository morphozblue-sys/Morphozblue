<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Bus Fee Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			$student_bus=$_POST['student_bus'];
			if($student_bus!='All'){
				$condition3=" and student_bus_no='$student_bus'";
			}else{
				$condition3="";
			}
			$student_fee_head=$_POST['student_fee_head'];
			$order_by=$_POST['order_by'];
			$fees_code=$_POST['months'];
			$fees_count = count($fees_code);
			
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
			<td><center><b>STUDENT BUS FEE REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>Classwise</b></center></td>
			</tr>
			</table>
				  <?php if($student_fee_head!=''){ $student_fee_head1=explode('|?|',$student_fee_head); $student_fee_head_code=$student_fee_head1[0]; $student_fee_head_name=$student_fee_head1[1]; ?>
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Student Name</th>
								  <th>Father Name</th>
								  <th>Class (Sec)</th>
								  <th>Contact No</th>
								  <th>Bus No</th>
								  <th>Pickup Point</th>
								  <th>Total <?php echo $student_fee_head_name; ?> Amount</th>
								  <th>Balance <?php echo $student_fee_head_name; ?> Amount</th>
								  <th>Paid <?php echo $student_fee_head_name; ?> Amount</th>
								</tr>
						</thead>
					<tbody>
					<?php
                    $que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
                    $run01=mysqli_query($conn73,$que01);
                    while($row01=mysqli_fetch_assoc($run01)){
                    $fees_type_name[] = $row01['fees_type_name'];	
                    //$fees_code[] = $row01['fees_code'];
                    //$fees_count = $row01['fees_count'];
                    }
					
					$que="select * from student_admission_info where student_status='Active' and session_value='$session1' and student_bus='Yes'$condition1$condition2$condition3$filter37$order_by";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					$transport_fee_total=0;
					$transport_fee_balance=0;
					$transport_fee_paid=0;
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$student_roll_no=$row['student_roll_no'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					$student_bus_no=$row['student_bus_no'];
					$pickup_point=$row['pickup_point'];
					
					$que1="select * from common_fees_student_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
					$run1=mysqli_query($conn73,$que1);
					$transport_fee_tot=0;
					$transport_fee_bal=0;
					$transport_fee_pa=0;
					while($row1=mysqli_fetch_assoc($run1)){
					for($ab=0;$ab<$fees_count;$ab++){
					$transport_fee_tot1=$row1["student_".$student_fee_head_code."_total_amount_after_discount_month".$fees_code[$ab]];
					$transport_fee_bal1=$row1["student_".$student_fee_head_code."_balance_month".$fees_code[$ab]];
					$transport_fee_pa1=$row1["student_".$student_fee_head_code."_paid_total_month".$fees_code[$ab]];
					
					$transport_fee_tot=$transport_fee_tot+$transport_fee_tot1;
					$transport_fee_bal=$transport_fee_bal+$transport_fee_bal1;
					$transport_fee_pa=$transport_fee_pa+$transport_fee_pa1;
					
					$transport_fee_total=$transport_fee_total+$transport_fee_tot1;
					$transport_fee_balance=$transport_fee_balance+$transport_fee_bal1;
					$transport_fee_paid=$transport_fee_paid+$transport_fee_pa1;
					}
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_father_name; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td><?php echo $student_father_contact_number; ?></td>
					<td><?php echo $student_bus_no; ?></td>
					<td><?php echo $pickup_point; ?></td>
					<td><?php echo $transport_fee_tot; ?></td>
					<td><?php echo $transport_fee_bal; ?></td>
					<td><?php echo $transport_fee_pa; ?></td>					
					</tr>
					<?php } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="7"><span style="float:right;font-weight:bold;">Total Amount = </span></td>
					<td><span style="font-weight:bold;"><?php echo $transport_fee_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $transport_fee_balance; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $transport_fee_paid; ?></span></td>
					</tr>
					</tfoot>
				 </table>
				  <?php }else{ ?>
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Scholar No.</th>
								  <th>Student Name</th>
								  <th>Father Name</th>
								  <th>Class (Sec)</th>
								  <th>Contact No</th>
								  <th>Bus No</th>
								  <th>Pickup Point</th>
								  <th>Total Bus Amount</th>
								  <th>Balance Bus Amount</th>
								  <th>Paid Bus Amount</th>
								</tr>
						</thead>
					<tbody>
					<?php
					$que="select * from student_admission_info where student_status='Active' and session_value='$session1' and student_bus='Yes'$condition1$condition2$condition3$filter37$order_by";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					$transport_fee_total=0;
					$transport_fee_balance=0;
					$transport_fee_paid=0;
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$student_roll_no=$row['student_roll_no'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					$student_bus_no=$row['student_bus_no'];
					$student_admission_number=$row['student_admission_number'];
					$student_scholar_number=$row['student_scholar_number'];
					if($student_admission_number==''){$student_admission_number=$student_scholar_number;}
					$bus_fee_category=$row['student_bus_fee_category'];
					$pickup_point=$row['pickup_point'];
					
					$que1="select * from common_fees_student_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
					$run1=mysqli_query($conn73,$que1);
					while($row1=mysqli_fetch_assoc($run1)){
					$student_transport_fee=$row1['student_transport_fee'];
					$student_transport_fee_balance=$row1['student_transport_fee_balance'];
					$student_transport_fee_paid_total=$row1['student_transport_fee_paid_total'];
					
					$transport_fee_total=$transport_fee_total+$student_transport_fee;
					$transport_fee_balance=$transport_fee_balance+$student_transport_fee_balance;
					$transport_fee_paid=$transport_fee_paid+$student_transport_fee_paid_total;
					
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $student_admission_number; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_father_name; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td><?php echo $student_father_contact_number; ?></td>
					<td><?php echo $student_bus_no; ?></td>
                    <td><?php echo $bus_fee_category; ?></td>
					<td><?php echo $student_transport_fee; ?></td>
					<td><?php echo $student_transport_fee_balance; ?></td>
					<td><?php echo $student_transport_fee_paid_total; ?></td>					
					</tr>
					<?php } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="7"><span style="float:right;font-weight:bold;">Total Amount = </span></td>
					<td><span style="font-weight:bold;"><?php echo $transport_fee_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $transport_fee_balance; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $transport_fee_paid; ?></span></td>
					</tr>
					</tfoot>
				 </table>
			     <?php } ?>
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Bus Fee Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>