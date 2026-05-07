<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Registration Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>">
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			<?php
			$from_date=$_GET['from_date'];
			if($from_date!=''){
				$from_date1=explode('-',$from_date);
				$from_date2=$from_date1[2].'/'.$from_date1[1].'/'.$from_date1[0];
				$from_date0=date('Y-m-d h:i:s', strtotime($from_date));
				$condition3=" and student_date_of_admission>='$from_date'";
			}else{
				$from_date2='';
				$condition3="";
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=explode('-',$to_date);
				$to_date2=$to_date1[2].'/'.$to_date1[1].'/'.$to_date1[0];
				$to_date0=date('Y-m-d h:i:s', strtotime($to_date));
				$condition4=" and student_date_of_admission<='$to_date'";
			}else{
				$to_date2='';
				$condition4="";
			}
			//$order_by=$_GET['order_by'];
			
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
			<td><center><b>STUDENT REGISTRATION REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>From <?php echo $from_date2; ?> To <?php echo $to_date2; ?></b></center></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead >
								<tr>
								  <th>S.No.</th>
								  <th>Rg.No.</th>
								  <th>Student Name</th>
								  <th>Gender</th>
								  <th>Class (Sec)</th>
								  <th>Faher Name</th>
								  <th>Contact No</th>
								  <th>Mother Name</th>
								  <th>Fee Category</th>
								  <th>Bus</th>
								  <th>Registration Fees</th>
								  <th>Registration Date</th>
								  <th>Address</th>
								</tr>
						</thead>
					<tbody>
					<?php
					
					$que="select * from student_admission_info where student_status!='Deleted' and session_value='$session1'$condition3$condition4 ORDER BY s_no ASC";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					$student_registration_fee_grand_total=0;
					while($row=mysqli_fetch_assoc($run)){
					$student_name=$row['student_name'];
					$student_registration_number=$row['student_registration_number'];
					$student_gender=$row['student_gender'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$school_roll_no=$row['school_roll_no'];
					$student_father_contact_number=$row['student_father_contact_number'];
					$student_admission_number=$row['student_admission_number'];
					$student_scholar_number=$row['student_scholar_number'];
					if($student_admission_number==''){$student_admission_number=$student_scholar_number;}
					$student_mother_name=$row['student_mother_name'];
					$student_fee_category=$row['student_fee_category'];
					$student_bus=$row['student_bus'];
					$student_registration_fee=$row['student_registration_fee'];
					if($row['student_date_of_admission']!='' && $row['student_date_of_admission']!='0000-00-00'){
					$student_date_of_admission=date('d-m-Y',strtotime($row['student_date_of_admission']));
					}else{
					$student_date_of_admission=$row['student_date_of_admission'];
					}
					$student_adress=$row['student_adress'];
					
					$student_registration_fee_grand_total=$student_registration_fee_grand_total+$student_registration_fee;
					
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $student_registration_number; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_gender; ?></td>
					<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
					<td><?php echo $student_father_name; ?></td>
					<td><?php echo $student_father_contact_number; ?></td>
					<td><?php echo $student_mother_name; ?></td>
					<td><?php echo $student_fee_category; ?></td>
					<td><?php echo $student_bus; ?></td>
					<td><?php echo $student_registration_fee; ?></td>
					<td><?php echo $student_date_of_admission; ?></td>
					<td><?php echo $student_adress; ?></td>
					</tr>
					<?php } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="9"><span style="float:right;font-weight:bold;">Total = </span></td>
					<td><span style="font-weight:bold;"><?php echo $student_registration_fee_grand_total; ?></span></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Registration Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>