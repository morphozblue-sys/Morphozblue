<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Student Buswise Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			$bus_stop_details=$_POST['bus_stop_details'];
			if($bus_stop_details!='All'){
				$condition1=" and student_bus_route ='$bus_stop_details'";
			}else{
				$condition1="";
			}
			$student_class=$_POST['student_class'];
			if($student_class!='All'){
				$condition2=" and student_class ='$student_class'";
			}else{
				$condition2="";
			}
			$bus_no=$_POST['bus_no'];
			if($bus_no!='All'){
				$condition3=" and student_bus_no='$bus_no'";
			}else{
				$condition3="";
			}
			
			//$no_of_installment=$_POST['no_of_installment'];
			$fee_head=$_POST['fee_head'];
			
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code,fees_category from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			$fees_category=$schl_row['fees_category'];
			}
			
			?>
			<table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			<tr>
			<td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			</tr>
			<tr>
			<td style="float:left;"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			<td><center><b>Student List Bus Wise</b></center></td>
			<td style="float:right;"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td style="float:left;">Current Date : <?php echo date('d-m-Y'); ?></td>
			<td><center><b>&nbsp;</b></center></td>
			</tr>
			</table>
			
		
				  <form method='post' action="<?php echo $pdf_path; ?>id_card_page/bus_id_card_monthly.php" target='_blank'>
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="5px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Student Name</th>
								  <th>Father Name</th>
								  <th>Class(Section)</th>
								  <th>Student route</th>
								  <th>All <input type='checkbox' name='check_bus_card' id="info1" checked onclick="for_check(this.id);" /></th>
								</tr>
						</thead>
					<tbody>
					  
					    <input type='submit' name='print_bus' onclick="return validate();" class="btn btn-primary" value='Print Bus Card' style="float:right" >
					    <!-- <input type="hidden" name="no_of_installment" class="form-control" value="" /> -->
					    <input type="hidden" name="fee_head" class="form-control" value="<?php echo $fee_head[0]; ?>" />
					<?php					
					$que="select * from student_admission_info where student_bus='Yes' and student_status='Active' and session_value='$session1'$condition1$condition2$condition3$filter37";
					$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					$serial_no1=0;
					$expense_grand_total=0;
					while($row=mysqli_fetch_assoc($run)){
					$student_roll_no=$row['student_roll_no'];
					$student_name=$row['student_name'];
					$student_father_name=$row['student_father_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$student_bus_route=$row['student_bus_route'];
				
					
					/*$query1="select * from bus_details where bus_id='$bus_id'";
					$run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
                    $bus_name = '';
                    $bus_company = '';
                    $bus_model_no = '';
                    $bus_no = '';
					while($row1=mysqli_fetch_assoc($run1)){
                        $bus_name = $row1['bus_name'];
                        $bus_company = $row1['bus_company'];
                        $bus_model_no = $row1['bus_model_no'];
                        $bus_no = $row1['bus_no'];*/
					
					
					$serial_no1++;
					?>
					<tr>
					<td><?php echo $serial_no1.'.'; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $student_father_name; ?></td>
					<td><?php echo $student_class.'('.$student_class_section.')'; ?></td>
					<td><?php echo $student_bus_route; ?></td>
					<td><input type='checkbox' name='bus_card[]' value='<?php echo $student_roll_no; ?>' class="info1" checked /></td>
			        </tr>
					<?php } ?>

				 </table>
				 </form>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Student Buswise Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>