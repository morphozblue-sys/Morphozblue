<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Enquiry Daily Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			
			$enquiry_type=$_GET['enquiry_type'];
			if($enquiry_type!='All'){
				$condition1=" and enquiry_type='$enquiry_type'";
			}else{
				$condition1="";
			}
			
			$enquiry_medium=$_GET['enquiry_medium'];
			if($enquiry_medium!='All'){
				$condition2=" and student_medium='$enquiry_medium'";
			}else{
				$condition2="";
			}
			
			$enquiry_from_date=$_GET['enquiry_from_date'];
			if($enquiry_from_date!=''){
				$from_date1=explode('-',$enquiry_from_date);
				$from_date2=$from_date1[2].'/'.$from_date1[1].'/'.$from_date1[0];
				$condition3=" and enquiry_date>='$enquiry_from_date'";
			}else{
				$from_date2='';
				$condition3="";
			}
			
			$enquiry_to_date=$_GET['enquiry_to_date'];
			if($enquiry_to_date!=''){
				$to_date1=explode('-',$enquiry_to_date);
				$to_date2=$to_date1[2].'/'.$to_date1[1].'/'.$to_date1[0];
				$condition4=" and enquiry_date<='$enquiry_to_date'";
			}else{
				$to_date2='';
				$condition4="";
			}
			
			$enquiry_order_by=$_GET['enquiry_order_by'];
			
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
			<td><center><b>ENQUIRY DAILY REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>From <?php echo $from_date2; ?> To <?php echo $to_date2; ?></b></center></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.No.</th>
								  <th>Enquiry Type</th>
								  <th>Enquiry Date</th>
								  <th>Next Follow Up Date</th>
								  <th>Enquiry Name</th>
								  <th>Enquiry Father Name</th>
								  <th>Contact No.</th>
								  <th>Address</th>
								  <th>Medium</th>
								  <th>Remark 1</th>
								  <th>Remark 2</th>
								</tr>
						</thead>
					<tbody>
					<?php
					
					$que1="select * from enquiry_info where session_value='$session1'$condition1$condition2$condition3$condition4$enquiry_order_by";
					$run1=mysqli_query($conn73,$que1);
					$serial_no=0;
					while($row1=mysqli_fetch_assoc($run1)){
					$enquiry_type=$row1['enquiry_type'];
					
					$enquiry_date=$row1['enquiry_date'];
					if($row1['enquiry_date']!='' && $row1['enquiry_date']!='0000-00-00'){
					$enquiry_date=date('d-m-Y',strtotime($row1['enquiry_date']));
					}
					
					$enquiry_next_follow_up_date=$row1['enquiry_next_follow_up_date'];
				// 	if($row1['enquiry_next_follow_up_date']!='' && $row1['enquiry_next_follow_up_date']!='0000-00-00'){
				// 	$enquiry_next_follow_up_date=date('d-m-Y',strtotime($row1['enquiry_next_follow_up_date']));
				// 	}
					
					$enquiry_name=$row1['enquiry_name'];
					$enquiry_father_name=$row1['enquiry_father_name'];
					
					$enquiry_contact_no_1=$row1['enquiry_contact_no_1'];
					$enquiry_contact_no_2=$row1['enquiry_contact_no_2'];
					
					$enquiry_contact_no=$enquiry_contact_no_1;
					if($enquiry_contact_no_2!=''){
					$enquiry_contact_no=$enquiry_contact_no_1.', '.$enquiry_contact_no_2;
					}
					
					$enquiry_address=$row1['enquiry_address'];
					$student_medium=$row1['student_medium'];
					$enquiry_remark_1=$row1['enquiry_remark_1'];
					$enquiry_remark_2=$row1['enquiry_remark_2'];
					
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $enquiry_type; ?></td>
					<td><?php echo $enquiry_date; ?></td>
					<td><?php echo $enquiry_next_follow_up_date; ?></td>
					<td><?php echo $enquiry_name; ?></td>
					<td><?php echo $enquiry_father_name; ?></td>
					<td><?php echo $enquiry_contact_no; ?></td>
					<td><?php echo $enquiry_address; ?></td>
					<td><?php echo $student_medium; ?></td>
					<td><?php echo $enquiry_remark_1; ?></td>
					<td><?php echo $enquiry_remark_2; ?></td>
					</tr>
					<?php } ?>
					</tbody>
					
				 </table>
				
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Enquiry Daily Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>