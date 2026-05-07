<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Advance Salary Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
				$condition1=" and account_customer_date>='$from_date'";
			}else{
				$from_date1="";
				$condition1="";
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=date('d-m-Y',strtotime($to_date));
				$condition2=" and account_customer_date<='$to_date'";
			}else{
				$to_date1="";
				$condition2="";
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
			<td><center><b>ADVANCE SALARY REPORT</b></center></td>
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
								  <th>Name</th>
								  <th>Contact No</th>
								  <th>Designation</th>
								  <th>Date</th>
								  <th>Advance Amount</th>
								  <th>Advance Amount Balance</th>
								  <th>Remark</th>
								  <th>Payment Mode</th>
								</tr>
						</thead>
					<tbody>
					<?php
					$que="select * from account_expence_info where account_status='Active' and other_or_advance='Advance' and advance_amount_balance>0 and session_value='$session1'$condition1$condition2 ORDER BY s_no";
					$run=mysqli_query($conn73,$que);
					$serial_no1=0;
					$advance_grand_total=0;
					$advance_balance_grand_total=0;
					while($row=mysqli_fetch_assoc($run)){
					$account_customer_name=$row['account_customer_name'];
					$account_customer_contact_no=$row['account_customer_contact_no'];
					$account_customer_designation=$row['account_customer_designation'];
					$account_customer_date=$row['account_customer_date'];
					if($account_customer_date!='' && $account_customer_date!='0000-00-00'){
					$account_customer_date=date('d-m-Y',strtotime($account_customer_date));
					}
					$advance_amount=$row['advance_amount'];
					$advance_amount_balance=$row['advance_amount_balance'];
					$account_customer_remark=$row['account_customer_remark'];
					$account_payment_mode=$row['account_payment_mode'];
					
					$advance_grand_total=$advance_grand_total+$advance_amount;
					$advance_balance_grand_total=$advance_balance_grand_total+$advance_amount_balance;
					
					$serial_no1++;
					?>
					<tr>
					<td><?php echo $serial_no1.'.'; ?></td>
					<td><?php echo $account_customer_name; ?></td>
					<td><?php echo $account_customer_contact_no; ?></td>
					<td><?php echo $account_customer_designation; ?></td>
					<td><?php echo $account_customer_date; ?></td>
					<td><span style="font-weight:bold;"><?php echo $advance_amount; ?></span></td>					
					<td><span style="font-weight:bold;"><?php echo $advance_amount_balance; ?></span></td>					
					<td><?php echo $account_customer_remark; ?></td>					
					<td><?php echo $account_payment_mode; ?></td>
					</tr>
					<?php } ?>
					</tbody>
					<tfoot>
					<tr>
					<td colspan="5"><span style="float:right;font-weight:bold;">Grand Total = </span></td>
					<td><span style="font-weight:bold;"><?php echo $advance_grand_total; ?></span></td>
					<td><span style="font-weight:bold;"><?php echo $advance_balance_grand_total; ?></span></td>
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
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Advance Salary Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>