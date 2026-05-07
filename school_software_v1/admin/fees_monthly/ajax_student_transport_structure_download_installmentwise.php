<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Transport Fee Structure')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			<td><center><b>STUDENT TRANSPORT STRUCTURE</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td colspan="3"><center><b>Classwise</b></center></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
					<thead class="my_background_color">
					<tr>
					  <td>S.No.</td>
					  <td>Root Name</td>
					  <?php
					  $que3="select * from school_info_class_info where class_name!=''";
					  $run3=mysqli_query($conn73,$que3);
					  $serial_no=0;
					  while($row3=mysqli_fetch_assoc($run3)){
					  $student_class=$row3['class_name'];
					  $class_code[$serial_no]=$row3['class_code'];
					  $serial_no++;
					  ?>
					  <td><?php echo $student_class; ?></td>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
					$que="select * from bus_fee_category where bus_fee_category_name!=''";
					$run=mysqli_query($conn73,$que);
					$serial_no1=0;
					while($row=mysqli_fetch_assoc($run)){
					$bus_fee_category_name=$row['bus_fee_category_name'];
					
					$serial_no1++;
					?>
					 <tr>
					 <td><?php echo $serial_no1; ?></td>
					 <td><?php echo $bus_fee_category_name; ?></td>
					 <?php for($i=0;$i<$serial_no;$i++){ ?>
					 <td><?php echo $row[$class_code[$i].'_amount']; ?></td>
					 <?php } ?>
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
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Transport Fee Structure')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
</div>