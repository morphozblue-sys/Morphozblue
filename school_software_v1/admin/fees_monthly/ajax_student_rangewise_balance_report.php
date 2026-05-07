<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Rangewise Balance Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			<td><center><b>RANGEWISE BALANCE REPORT</b></center></td>
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
                    $student_class=$_GET['student_class'];
                    if($student_class!='All'){
                    	$condition=" and student_class='$student_class'";
                    	$condition1=" and student_class='$student_class'";
                    }else{
                    	$condition="";
                    	$condition1="";
                    }
                    $student_section=$_GET['student_section'];
                    if($student_section!='All'){
                    	$condition2=" and student_class_section='$student_section'";
                    }else{
                    	$condition2="";
                    }
                    $bus_fee_category_code=$_GET['bus_fee_category_code'];
                    if($bus_fee_category_code!='All'){
                    	$condition3=" and student_bus_fee_category_code='$bus_fee_category_code'";
                    }else{
                    	$condition3="";
                    }
                    $for_paid_balance=$_GET['for_paid_balance'];
                    $for_less_greater=$_GET['for_less_greater'];
                    $myRange=$_GET['myRange'];
                    if($myRange!=''){
                    	$condition4=" and ".$for_paid_balance.$for_less_greater.$myRange;
                    }else{
                    	$condition4="";
                    }
                    $order_by=$_GET['order_by'];
                    
                    $que1="select * from common_fees_student_fee where session_value='$session1' and fee_status='Active'$condition1$condition4$order_by";
                    $run1=mysqli_query($conn73,$que1);
                    $serial_no=0;
                    $grand_grand_total=0;
                    $grand_paid_total=0;
                    $grand_balance_total=0;
                    while($row1=mysqli_fetch_assoc($run1)){
                    $student_roll_no=$row1['student_roll_no'];
                    $paid_total=$row1['paid_total'];
                    $balance_total=$row1['balance_total'];
                    $grand_total=$row1['grand_total'];
                    
                    $que2="select * from student_admission_info where session_value='$session1' and student_status='Active' and student_roll_no='$student_roll_no'$condition$condition2$condition3";
                    $run2=mysqli_query($conn73,$que2);
                    while($row2=mysqli_fetch_assoc($run2)){
                    $student_name=$row2['student_name'];
                    $student_father_name=$row2['student_father_name'];
                    $student_class=$row2['student_class'];
                    $student_class_section=$row2['student_class_section'];
                    $student_father_contact_number=$row2['student_father_contact_number'];
                    
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
					<?php } } ?>
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
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Rangewise Balance Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>