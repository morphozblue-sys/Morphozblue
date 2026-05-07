<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Transport Balance Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
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
			$student_bus_fee_category=$_GET['student_bus_fee_category'];
			if($student_bus_fee_category!='All'){
				$condition_bus_category=" and student_bus_fee_category='$student_bus_fee_category'";
			}else{
				$condition_bus_category="";
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
			<td><center><b>STUDENT TRANSPORT BALANCE REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td style="float:left">Current Date : <?php echo date('d-m-Y'); ?></td>
			<td><center><b>Classwise</b></center></td>
			<td style="float:right">Class (Sec) : <?php echo $class_name.' ( '.$section_name.' )'; ?></td>
			</tr>
			</table>
				  
				  <?php
										
					$month_code=$_GET['month_code'];
					if($month_code!='All'){
					$month_condition = " and fees_code='$month_code'";
					}else{
					$month_condition = "";
					}
					
				    $que01="select * from school_info_monthly_transport_fees where fees_type_name!=''$month_condition and session_value='$session1'$filter37 ORDER BY s_no";
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
								  <th>Stop Name</th>
								  <th>Class (Sec)</th>
								  <th>Contact No</th>
								  <?php 
								  $no=1;
								  for($i=0; $i<$fees_count; $i++){ ?>
								   <th><?php echo $fees_type_name[$i]; ?></th>   
								  <?php $no++; }
								  ?>
								  <th>Total Balance Amount</th>
								</tr>
						</thead>
					<tbody>
					<?php					
					$que="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition1$condition2 $condition_bus_category $order_by";
					$run=mysqli_query($conn73,$que);
					$serial_no1=1;
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$student_roll_no=$row['student_roll_no'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					
	$student_bus_fee_category_code = $row['student_bus_fee_category_code'];
	$student_bus_fee_category = $row['student_bus_fee_category'];
					$que1="select * from common_fees_student_transport_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
					$run1=mysqli_query($conn73,$que1);
					while($row1=mysqli_fetch_assoc($run1)){
					    ?>
			      <tr>
					<td><?php echo $serial_no1.'.'; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_father_name; ?></td>
					<td><?php echo $student_bus_fee_category; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td><?php echo $student_father_contact_number; ?></td>  
					<?php for($j=0;$j<$fees_count;$j++){
						$headwise_balance=$row1['transport_fee_balance_month'.$fees_code[$j]];
						$balance_total=$row1['balance_total']; ?>
					<td><?php echo $headwise_balance; ?></td>
					<?php } ?>
					<td><?php echo $balance_total; ?></td>
					<?php $serial_no1++; } ?>
				</tr>
        			<?php }   ?>
					</tbody>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Balance Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>