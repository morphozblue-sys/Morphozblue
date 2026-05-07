<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Fee Structure')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			<td><center><b>STUDENT FEE STRUCTURE</b></center></td>
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
					  <td>Class Name</td>
					<?php
					
					$que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
					$run1=mysqli_query($conn73,$que1);
					while($row1=mysqli_fetch_assoc($run1)){
					$fees_code[] = $row1['fees_code'];
					$fees_count = $row1['fees_count'];
					}

					$que="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					while($row=mysqli_fetch_assoc($run)){
					$fee_type = $row['fee_type'];
					$fee_code = $row['fee_code'];
					$fee[$serial_no]="student_".$fee_code."_month";
					$serial_no++;
					?>
					  <td><?php echo $fee_type; ?></td>
					  <?php } ?>
					  <td><?php echo $language['Total Fee']; ?></td>
					</tr>
					</thead>
					<tbody>
				  
					<?php
					$condition="";
					if($_POST['category_name']!=''){
					$category_name=$_POST['category_name'];
					$count01=count($category_name);
					for($ab=0; $ab<$count01; $ab++){
					if($ab==0){
					$condition=$condition." and category_code='$category_name[$ab]'";
					}else{
					$condition=$condition."or session_value='$session1' and category_code='$category_name[$ab]'";
					}
					}
					}
					
					$que="select * from common_fees_fee_structure where session_value='$session1'$condition $filter37 ORDER BY s_no ASC";
					$run=mysqli_query($conn73,$que);
					$serial_no1=0;
					$grand_total_fee=0;
					while($row=mysqli_fetch_assoc($run)){
					$s_no=$row['s_no'];
					$class_code = $row['class_code'];
					$serial_no1++;
					
					$que3="select * from school_info_class_info where class_code='$class_code'";
					$run3=mysqli_query($conn73,$que3);
					while($row3=mysqli_fetch_assoc($run3)){
					$student_class=$row3['class_name'];
					}
					?>
					 <tr>
					 <td><?php echo $serial_no1; ?></td>
					 <td><?php echo $student_class; ?></td>
					 <?php
					 //$headwise_fee[]=0;
					 $total_fee=0;
					 for($i=0;$i<$serial_no;$i++){
					 
					 $fee1[$i] = 0;
					 for($u=0;$u<$fees_count;$u++){
					 $fee1[$i] = $fee1[$i]+$row[$fee[$i].$fees_code[$u]];
					 }
					 $total_fee= $total_fee+$fee1[$i];
					 $grand_total_fee= $grand_total_fee+$fee1[$i];
					 //$headwise_fee[$i]= $headwise_fee[$i]+$fee1[$i];
					 ?>
					<td><?php echo $fee1[$i]; ?></td>
					<?php } ?>
					<td><span style="font-weight:bold;color:blue;"><?php echo $total_fee; ?></span></td>
					</tr>
					<?php } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="2"><span style="font-weight:bold;color:red;">Total Amount </span></td>
					<?php for($j=0;$j<$serial_no;$j++){ ?>
					<td><span style="font-weight:bold;color:red;"><?php echo ''; ?></span></td>
					<?php } ?>
					<td><span style="font-weight:bold;color:red;"><?php echo $grand_total_fee; ?></span></td>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printTable', 'Fee Structure')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>