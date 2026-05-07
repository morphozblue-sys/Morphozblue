<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Familywise Balance Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			<td><center><b>FAMILYWISE BALANCE REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>&nbsp;</b></center></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
                                    <th>S.No.</th>
                                    <th><?php echo $language['Student Name']; ?></th>
                                    <th><?php echo $language['Father Name']; ?></th>
                                    <th><?php echo $language['Class']; ?> ( Sec. )</th>
                                    <th>Contact No.</th>
                                    <th><?php echo $language['Total Fee']; ?></th>
                                    <th><?php echo $language['Total Paid']; ?></th>
                                    <th><?php echo $language['Remaining Fee']; ?></th>
								</tr>
						</thead>
					<tbody>
					<?php
					$que0="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
					$run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73)) ;
					$serial_no11=0;
					while($row0=mysqli_fetch_assoc($run0)){
					$fee_type = $row0['fee_type'];
					$fee_code = $row0['fee_code'];
					if($fee_type!=''){
					$fee_type1[$serial_no11] = $row0['fee_type'];
					$fee_code1[$serial_no11] = $row0['fee_code'];
					$fee_type=strtolower($fee_type);
					$fee[$serial_no11]="student_".$fee_code."_month";
					$fee_discount_type[$serial_no11]="student_".$fee_code."_discount_month";
					$fee_discount_method[$serial_no11]="student_".$fee_code."_discount_method_month";
					$fee_discount_amount[$serial_no11]="student_".$fee_code."_discount_amount_month";
					$total_amount_after_discount[$serial_no11]="student_".$fee_code."_total_amount_after_discount_month";
					$fee_balance[$serial_no11]="student_".$fee_code."_balance_month";
					$fee_paid[$serial_no11]="student_".$fee_code."_paid_total_month";
					$serial_no11++;
					} }
					
                    $student_family=$_POST['student_family'];
                    if($student_family!='All'){
                    	$condition=" and student_family_id='$student_family'";
                    }else{
                    	$condition="";
                    }
                    $order_by=$_POST['order_by'];
                    $select_inst=$_POST['select_inst'];
                    $select_inst_count=$_POST['select_inst_count'];
                    
                    $que2="select student_family_id from student_admission_info where session_value='$session1' and student_status='Active' and student_family_id!=''$condition GROUP BY student_family_id $order_by";
                    $run2=mysqli_query($conn73,$que2);
                    $serial_no=0;
                    
                    $grand_grand_total=0;
                    $grand_paid_total=0;
                    $grand_balance_total=0;
                    while($row2=mysqli_fetch_assoc($run2)){
                    $student_family_id=$row2['student_family_id'];
                    
                    $que3="select * from student_admission_info where session_value='$session1' and student_status='Active' and student_family_id='$student_family_id'";
                    $run3=mysqli_query($conn73,$que3);
                    if(mysqli_num_rows($run3)>=2){
                    $paid_total=0;
                    $balance_total=0;
                    $grand_total=0;
                    while($row3=mysqli_fetch_assoc($run3)){
                    
                    $student_roll_no=$row3['student_roll_no'];
                    $student_name=$row3['student_name'];
                    $student_father_name=$row3['student_father_name'];
                    $student_class=$row3['student_class'];
                    $student_class_section=$row3['student_class_section'];
                    $student_father_contact_number=$row3['student_father_contact_number'];
                    
                    $que1="select * from common_fees_student_fee where session_value='$session1' and fee_status='Active' and student_roll_no='$student_roll_no'";
                    $run1=mysqli_query($conn73,$que1);
                    $paid_total=0;
                    $balance_total=0;
                    $grand_total=0;
                    while($row1=mysqli_fetch_assoc($run1)){
                    $paid_total=$paid_total+$row1['student_transport_fee_paid_total']+$row1['student_previous_year_fee'];
                    $balance_total=$balance_total+$row1['student_transport_fee_balance']+$row1['student_previous_year_fee_balance'];
                    $grand_total=$grand_total+$row1['student_transport_fee']+$row1['student_previous_year_fee'];
                    for($az=0;$az<$serial_no11;$az++){
                    for($az1=0;$az1<$select_inst_count;$az1++){
                    $paid_total=$paid_total+$row1[$fee_paid[$az].$select_inst[$az1]];
                    $balance_total=$balance_total+$row1[$fee_balance[$az].$select_inst[$az1]];
                    $grand_total=$grand_total+$row1[$total_amount_after_discount[$az].$select_inst[$az1]];
                    }
                    }
                    }
                    
                    $grand_grand_total=$grand_grand_total+$grand_total;
                    $grand_paid_total=$grand_paid_total+$paid_total;
                    $grand_balance_total=$grand_balance_total+$balance_total;
                    $serial_no++;
                    ?>
					<tr>
                    <td><?php echo $serial_no; ?></td>
                    <td><?php echo $student_name; ?></td>
                    <td><?php echo $student_father_name; ?></td>
                    <td><?php echo $student_class.' ( '.$student_class_section.' )'; ?></td>
                    <td><?php echo $student_father_contact_number; ?></td>
                    <td><?php echo $grand_total; ?></td>
                    <td><?php echo $paid_total; ?></td>
                    <td><?php echo $balance_total; ?></td>				
					</tr>
					<?php } } } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="5"><span style="float:right;font-weight:bold;">Total Amount = </span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_grand_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_paid_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $grand_balance_total; ?></span></td>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Familywise Balance Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>