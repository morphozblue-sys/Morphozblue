<?php include("../attachment/session.php"); ?>
<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn default" onclick="exportTableToExcel('printTable', 'Purchase Report')"><i class="fa fa-print" aria-hidden="true"></i>Print In Excel</button></center>
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
			//$sales_type=$_GET['sales_type'];
			
			$order_by=$_GET['order_by'];
			
			$from_date=$_GET['from_date'];
			if($from_date!=''){
				$from_date1=explode('-',$from_date);
				$from_date2=$from_date1[2].'/'.$from_date1[1].'/'.$from_date1[0];
				$condition3=" and purchase_detail.invoice_date>='$from_date'";
			}else{
				$from_date2='';
				$condition3="";
			}
			$to_date=$_GET['to_date'];
			if($to_date!=''){
				$to_date1=explode('-',$to_date);
				$to_date2=$to_date1[2].'/'.$to_date1[1].'/'.$to_date1[0];
				$condition4=" and purchase_detail.invoice_date<='$to_date'";
			}else{
				$to_date2='';
				$condition4="";
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
			<td><center><b>BOOKS PURCHASE REPORT</b></center></td>
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
						  <th>Invoice No.</th>
						  <th>Invoice Date</th>
						  <th>Vendor Name</th>
						  <th>Item Name</th>
						  <th>Item class</th>
						  <th>Total Quantity</th>
						  <th>Payment Mode</th>
						  <th>Total Amount</th>
						  <!--<th>Paid Amount</th>-->
						</tr>
					</thead>
				    <tbody>
					<?php
					$que1="select purchase_detail.*, new_stock_item.item_name, new_stock_item.item_class, vendor_detail.vendor_name from purchase_detail join new_stock_item on purchase_detail.item_s_no=new_stock_item.s_no join vendor_detail on purchase_detail.vendor_s_no=vendor_detail.s_no where purchase_detail.purchase_status='Active'$condition3$condition4$order_by";
					$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
					$serial_no=0;
					$paid_grand_total=0;
					while($row1=mysqli_fetch_assoc($run1)){
					    
					$vendor_name = $row1['vendor_name'];
					$invoice_number=$row1['invoice_number'];    
					$invoice_date=$row1['invoice_date'];
					//$sales_type=$row1['sales_type'];
					$item_name=$row1['item_name'];    
					$item_class=$row1['item_class'];    
					$total_quantity=$row1['total_quantity'];    
					$quantity=$row1['quantity'];    
					$total_amount=$row1['total_amount'];
					$payment_mode=$row1['payment_mode'];
					$paid_grand_total=$paid_grand_total+$total_amount;
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no.'.'; ?></td>
					<td><?php echo $invoice_number; ?></td>
					<td><?php echo date('d-m-Y', strtotime($invoice_date)); ?></td>
					<td><?php echo $vendor_name; ?></td>
					<td><?php echo $item_name; ?></td>
					<td><?php echo $item_class; ?></td>
					<td><?php echo $quantity; ?></td>
					<td><?php echo $payment_mode; ?></td>
					<td><?php echo $total_amount; ?></td>
					<!--<td><?php //echo $paid_total; ?></td>		-->			
					</tr>
					<?php }  ?>
					</tbody>
					<!--<tfoot>
					<tr>
					<td colspan="8"><span style="float:right;font-weight:bold;">Total Amount = </span></td>
					
					<td><span style="font-weight:bold;"><?php echo $paid_grand_total; ?></span></td>
					</tr>
					</tfoot>-->
				 </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-md-12">&nbsp;</div>
			  <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-success" onclick="exportTableToExcel('printTable', 'Purchase Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn btn-primary" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
			  </div>
  </div>
    
  </div>