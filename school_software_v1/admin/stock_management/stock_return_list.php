<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock_management/stock_management')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active">Stock Return List</li>
        </ol>
    </section>

<script>
function valid(s_no){   
    var myval=confirm("Are you sure want to delete this record !!!!");
    if(myval==true){
        delete_record(s_no);       
    }            
    else  {      
        return false;
    }
}

function delete_record(s_no){
$.ajax({
type: "POST",
url: access_link+"stock_management/sale_item_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
    var res=detail.split("|?|");
	    if(res[1]=='success'){
            alert_new('Successfully Deleted','green');
            get_content('stock_management/sale_item_list');
        }else{
            //alert_new(detail); 
	    }
    }
});
}

function valid1(s_no){   
    var myval=confirm("Are you sure want to Cancel this Invoice !!!!");
    if(myval==true){
        cancel_record(s_no);       
    }            
    else  {      
        return false;
    }
}

function cancel_record(s_no){
$.ajax({
type: "POST",
url: access_link+"stock_management/sale_item_cancel.php?id="+s_no+"",
cache: false,
success: function(detail){
    var res=detail.split("|?|");
	    if(res[1]=='success'){
            alert_new('Successfully Cancelled');
            get_content('stock_management/sale_item_list');
        }else{
            //alert_new(detail); 
	    }
    }
});
}
</script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-md-12">
          <!-- /.box -->
		  
		<div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
			  <div class="col-md-6"><h4>Books Stock Return List</h4></div>
			  <div class="col-md-6"><a href="javascript:get_content('stock_management/stock_return')"> <button style="float:right;" type="button" class="btn btn-primary">+ Stock Return</button></a></div>
			</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
					<th>S.No.</th>
					<th>Vendor Name</th>
					<th>Invoice Number</th>
					<th>Invoice Date</th>
					<th>Total Quantity</th>
					<th>Total Amount</th>
					<th>Payment Mode</th>
                    <th>Update By</th>
                    <th>Date</th>
					<th style="display:none;"><center><?php echo $language['Action']; ?></center></th>
					<th style="display:none;">Cancellation</th>
					<th>Return Invoice</th>
                </tr>
                </thead>
				<tbody id="search_table">
<?php
$que="select rd.*, vd.vendor_name from return_detail as rd left join vendor_detail as vd on rd.vendor_id=vd.s_no where rd.return_status='Active' and rd.session_value='$session1' group by rd.invoice_number ORDER BY rd.invoice_number DESC";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
		$s_no=$row['s_no'];
		$return_type=$row['return_type'];
		$vendor_name=$row['vendor_name'];
		$vendor_id=$row['vendor_id'];
		$invoice_number=$row['invoice_number'];
		$invoice_date=$row['invoice_date'];
		$total_quantity=$row['total_quantity'];
		$payable_amount=$row['payable_amount'];
		$payment_mode=$row['payment_mode'];
		$update_change=$row['update_change'];
		$last_updated_date=$row['last_updated_date'];
		if($last_updated_date!='' && $last_updated_date!='0000-00-00 00:00:00'){
		   $last_updated_date=date('d-m-Y h:i:s',strtotime($last_updated_date));
		}
		
	$serial_no++;
?>

<tr>

	<td><?php echo $serial_no; ?></td>
	<td><?php echo $vendor_name; ?></td>
	<td><?php echo $invoice_number; ?></td>
	<td><?php echo date('d-m-Y', strtotime($invoice_date)); ?></td>
	<td><?php echo $total_quantity; ?></td>
	<td><?php echo $payable_amount; ?></td>
	<td><?php echo $payment_mode; ?></td>
	<td><?php echo $update_change; ?></td>
	<td><?php echo $last_updated_date; ?></td>
	
    <td style="display:none;">
    <center>
    <span style="display:none;"><a href="javascript:post_content('stock_management/sale_item_edit','id=<?php echo $invoice_number; ?>')" style="color:#fff;"><input type="button" value="Edit" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a></span>
    <button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $invoice_number; ?>');" ><?php echo $language['Delete']; ?></button>
    </center>
    </td>
    <td style="display:none;">
    <button type="button"  class="btn btn-warning" onclick="return valid1('<?php echo $invoice_number; ?>');" >Cancel</button>
    </td>
   <td>
    <a href='<?php echo $pdf_path; ?>stock_invoice_reciept/stock_return_invoice_reciept.php?id=<?php echo $invoice_number; ?>&vid=<?php echo $vendor_id;?>' target="_blank"><button type="button" class="btn btn-success" >
    <?php echo $language['Print']; ?></button></a>
   </td>

</tr>

<?php } ?>
		</tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
        <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>