<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Bus Expense Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>Print In Pdf</button></center>
</div>
</div>

        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?> ">
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			<?php			
			$from_date=$_GET['from_date'];
			if($from_date!=''){
				$from_date1=date('d-m-Y',strtotime($from_date));
				$condition1=" and date>='$from_date'";
			}else{
				$from_date1="";
				$condition1="";
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=date('d-m-Y',strtotime($to_date));
				$condition2=" and date<='$to_date'";
			}else{
				$to_date1="";
				$condition2="";
			}
			$bus_id=$_GET['bus_id'];
			if($bus_id!='All'){
				$condition3=" and bus_id='$bus_id'";
			}else{
				$condition3="";
			}
			
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
			<td><center><b>BUS EXPENSE REPORT</b></center></td>
			<td style="float:right;"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td style="float:left;">Current Date : <?php echo date('d-m-Y'); ?></td>
			<td><center><b>&nbsp;</b></center></td>
			<td style="float:right;">From : <?php echo $from_date1; ?> To : <?php echo $to_date1; ?></td>
			</tr>
			</table>
				  
				  <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="5px" cellspacing="0" width="100%">
						<thead >
								<tr>
								  <th>S.No.</th>
								  <th>Bus No.</th>
								  <th>Bus Name</th>
								  <th>Bus model No.</th>
								  <th>Expense Type</th>
								  <th>Expense Remark</th>
								  <th>date</th>
								  <th>Expense Amount</th>
								</tr>
						</thead>
					<tbody>
					<?php					
					$que="select * from bus_expense where expense_amount!=''$condition1$condition2$condition3";
					$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
					$serial_no1=0;
					$expense_grand_total=0;
					while($row=mysqli_fetch_assoc($run)){
					$expense_remark=$row['expense_remark'];
					$total_amount=$row['expense_amount'];
					$expense_grand_total=$expense_grand_total+$total_amount;
					
					$date=date('d-m-Y',strtotime($row['date']));
					$bus_id=$row['bus_id'];
					
					$query1="select * from bus_details where bus_id='$bus_id'";
					$run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
                    $bus_name = '';
                    $bus_company = '';
                    $bus_model_no = '';
                    $bus_no = '';
					while($row1=mysqli_fetch_assoc($run1)){
                        $bus_name = $row1['bus_name'];
                        $bus_company = $row1['bus_company'];
                        $bus_model_no = $row1['bus_model_no'];
                        $bus_no = $row1['bus_no'];
					}
					
					$serial_no1++;
					?>
					<tr>
					<td><?php echo $serial_no1.'.'; ?></td>
					<td><?php echo $bus_no; ?></td>
					<td><?php echo $bus_name; ?></td>
					<td><?php echo $bus_model_no; ?></td>
					<td><?php echo 'Bus Expense'; ?></td>
					<td><?php echo $expense_remark; ?></td>
					<td><?php echo $date; ?></td>
					<td><?php echo $total_amount; ?></td>
					</tr>
					<?php } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="6"><span style="float:right;font-weight:bold;">Grand Total = </span></td>
					<td><span style="font-weight:bold;"><?php echo $expense_grand_total; ?></span></td>
					</tr>
					</tfoot>
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Bus Expense Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>