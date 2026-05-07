<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Participant List')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			$event_name=$_GET['event_name'];
			if($event_name!=''){
			    $condition1=" and event_name='$event_name'";
			}else{
			    $condition1="";
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
			<td><center><b>PARTICIPANT LIST</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>Event Name :- <?php echo ucwords($event_name); ?></b></center></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
                                    <th>S.No.</th>
                                    <th>Participate Type</th>
                                    <th>House Name</th>
                                    <th>School/Institute Participate</th>
                                    <th>Student Name</th>
                                    <th>Student Class</th>
                                    <th>Student Gender</th>
                                    <th>Student DOB</th>
								</tr>
						</thead>
					<tbody>
					<?php
                    $que="select * from event_participate_table where s_no!=''$condition1 ORDER BY s_no DESC";
                    $run=mysqli_query($conn73,$que);
                    $serial_no=0;
                    while($row=mysqli_fetch_assoc($run)){
                    $s_no = $row['s_no'];
                    $event_name = $row['event_name'];
                    $participate_type = $row['participate_type'];
                    $house_name = $row['house_name'];
                    $school_name = $row['school_name'];
                    $student_name = $row['student_name'];
                    $student_class = $row['student_class'];
                    $student_roll_no = $row['student_roll_no'];
                    $gender = $row['gender'];
                    if($row['dateofbirth']!='' && $row['dateofbirth']!='0000-00-00'){
                        $dateofbirth = date('d-m-Y',strtotime($row['dateofbirth']));
                    }else{
                        $dateofbirth = $row['dateofbirth'];
                    }
                    $serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
                    <td><?php echo $participate_type; ?></td>
                    <td><?php echo $house_name; ?></td>
                    <td><?php echo $school_name; ?></td>
                    <td><?php echo $student_name; ?></td>
                    <td><?php echo $student_class; ?></td>
                    <td><?php echo $gender; ?></td>
                    <td><?php echo $dateofbirth; ?></td>
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
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Participant List')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>