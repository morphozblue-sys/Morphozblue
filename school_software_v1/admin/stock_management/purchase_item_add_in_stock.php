<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock_management/stock_management')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active">Add In Stock</li>
        </ol>
    </section>

<script>
function valid(s_no,item_s_no,quantity){   
    var myval=confirm("Are you sure want to add this record in stock !!!!");
    if(myval==true){
        add_record(s_no,item_s_no,quantity);       
    }            
    else  {      
        return false;
    }
}

function add_record(s_no,item_s_no,quantity){
$.ajax({
type: "POST",
url: access_link+"stock_management/purchase_item_add_in_stock_api.php?item_s_no="+item_s_no+"&quantity="+quantity+"&s_no="+s_no+"",
cache: false,
success: function(detail){
    var res=detail.split("|?|");
	    if(res[1]=='success'){
            alert_new('Successfully Completed');
            get_content('stock_management/purchase_item_add_in_stock');
        }else{
            //alert_new(detail); 
	    }
    }
});
}

function for_alert_new(item_s_no,item_name){
$.ajax({
type: "POST",
url: access_link+"stock_management/ajax_get_minimum_alert_detail.php?item_s_no="+item_s_no+"",
cache: false,
success: function(detail){
$('#prod_name').html(item_name);
$('#alert_details').html(detail);
}
});
}

$("#my_form").submit(function(e){
e.preventDefault();

var formdata = new FormData(this);
$("#myModal_close").click();
$.ajax({
    url: access_link+"stock_management/stock_item_minimum_alert_api.php",
    type: "POST",
    data: formdata,
    mimeTypes:"multipart/form-data",
    contentType: false,
    cache: false,
    processData: false,
    success: function(detail){
       var res=detail.split("|?|");
	   if(res[1]=='success'){
		   $('#myModal').modal('hide');
		   get_content('stock_management/purchase_item_add_in_stock');
    }
	}
 });
});
</script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-md-12">
          <!-- /.box -->
		  
		<div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
			  <div class="col-md-12"><h3>Purchase Books Add In Stock</h3></div>
			</div>
			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
            <div class="col-md-12">
            <div class="col-md-12"><h4>Books Purchase List</h4></div>
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
					<th>S.No.</th>
					<th>Vendor Name</th>
					<th>Inv No</th>
					<th>Inv Date</th>
					<th>Item Name</th>
					<th>Category</th>
					<th>Item Class</th>
					<th>Quantity</th>
					<th>Rate</th>
					<th>Total</th>
    				<th><center><?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody id="search_table">

<?php
$que="select pd.*, vd.vendor_name, nsi.item_name, nsi.item_class from purchase_detail as pd left join vendor_detail as vd on pd.vendor_s_no=vd.s_no join new_stock_item as nsi on pd.item_s_no=nsi.s_no  where pd.add_in_stock='No' and pd.purchase_status='Active' and pd.session_value='$session1' ORDER BY pd.invoice_number ASC";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
		$s_no=$row['s_no'];
		$vendor_name=$row['vendor_name'];
		$invoice_number=$row['invoice_number'];
		$invoice_date=$row['invoice_date'];
		$item_s_no=$row['item_s_no'];
		$quantity=$row['quantity'];
		$item_name=$row['item_name'];
		$item_class=$row['item_class'];
		$item_category=$row['item_category'];
		$rate=$row['rate'];
		$total_amount=$row['total_amount'];
		$update_change=$row['update_change'];
		$last_updated_date=$row['last_updated_date'];
		if($last_updated_date!='' && $last_updated_date!='0000-00-00 00:00:00'){
		    $last_updated_date=date('d-m-Y h:i:s',strtotime($last_updated_date));
		}
		
        $querr="select category_name from category_detail where category_status='Active' and s_no='$item_category'";
        $runn=mysqli_query($conn73,$querr) or die(mysqli_error($conn73));
        $category_name='';
        while($roww=mysqli_fetch_assoc($runn)){
            $category_name=$roww['category_name'];
        }
		
	$serial_no++;
?>

<tr>

	<td><?php echo $serial_no; ?></td>
	<td><?php echo $vendor_name; ?></td>
	<td><?php echo $invoice_number; ?></td>
	<td><?php echo date('d-m-Y', strtotime($invoice_date)); ?></td>
	<td><?php echo $item_name; ?></td>
	<td><?php echo $category_name; ?></td>
	<td><?php echo $item_class; ?></td>
	<td><?php echo $quantity; ?></td>
	<td><?php echo $rate; ?></td>
	<td><?php echo $total_amount; ?></td>
    <td>
    <center>
    <button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>','<?php echo $item_s_no; ?>','<?php echo $quantity; ?>');" >Add In Stock</button>
    </center>
    </td>
    </tr>

<?php } ?>
		</tbody>
             </table>
            </div>
            
    <div class="col-md-12">
    <div class="col-md-12"><h4>Books Stock List</h4></div>
        <table id="example2" class="table table-bordered table-striped">
                <thead >
                <tr>
					<th>S.No.</th>
					<th>Item Name</th>
					<th>Item Description</th>
					<th>Category</th>
					<th>Item Class</th>
					<th>Opening Stock</th>
					<th>Available Stock</th>
					<th>Update By</th>
					<th>Date</th>
					<th>Action</th>
                </tr>
                </thead>
				<tbody id="search_table">

<?php
$que1="select ns.*, nsi.item_name, nsi.item_description, nsi.item_class, nsi.item_category from new_stock as ns join new_stock_item as nsi on ns.item_s_no=nsi.s_no where nsi.stock_item_status='Active' order by ns.s_no ASC";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
$serial_no1=0;
$minimum_alert_stock=0;
while($row1=mysqli_fetch_assoc($run1)){
	$s_no=$row1['s_no'];
	$item_name=$row1['item_name'];
	$item_s_no=$row1['item_s_no'];
	$item_description=$row1['item_description'];
	$item_category=$row1['item_category'];
	$item_class=$row1['item_class'];
	$opening_stock=$row1['opening_stock'];
	$available_stock=$row1['available_stock'];
	if($row1['minimum_alert_stock']>0){
	$minimum_alert_stock=$row1['minimum_alert_stock'];
	}
	$update_change=$row1['update_change'];
	$last_updated_date=$row1['last_updated_date'];
    if($last_updated_date!='' && $last_updated_date!='0000-00-00 00:00:00'){
    $last_updated_date=date('d-m-Y h:i:s',strtotime($last_updated_date));
    }
    
    $querr="select category_name from category_detail where category_status='Active' and s_no='$item_category'";
    $runn=mysqli_query($conn73,$querr) or die(mysqli_error($conn73));
    $category_name='';
    while($roww=mysqli_fetch_assoc($runn)){
        $category_name=$roww['category_name'];
    }
	
$serial_no1++;
?>

<tr>

    <td><?php echo $serial_no1; ?></td>
    <td><?php echo $item_name; ?></td>
    <td><?php echo $item_description; ?></td>
    <td><?php echo $category_name; ?></td>
    <td><?php echo $item_class; ?></td>
    <td><?php echo $opening_stock; ?></td>
    <td><button type="button" class="btn <?php if($available_stock<=$minimum_alert_stock){ echo 'btn-danger'; }else{ echo 'btn-success'; } ?>"><b><?php echo $available_stock; ?></b></button></td>
    <td><?php echo $update_change; ?></td>
    <td><?php echo $last_updated_date; ?></td>
    <td><button type="button"  class="btn btn-primary" onclick="for_alert_new('<?php echo $item_s_no; ?>','<?php echo $item_name; ?>');" data-toggle="modal" data-target="#myModal" >Add/Edit Alert</button></td>
    </tr>

<?php } ?>
		</tbody>
             </table>
    </div>
            
            </div>
            <!-- /.box-body stock_invoice_reciept.php;-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

<!-- Model Start -->
    <div class="modal fade" id="myModal" role="dialog">
	<form role="form"  method="post" enctype="multipart/form-data" id="my_form">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"  data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Minimum Alert Value</h4>
        </div>
        <div class="modal-body">
        <center><p id="prod_name" style="color:green; font-weight:bold;"></p></center>
        <div class="col-md-12" id="alert_details">
        
		</div>
        
        </div>
	    <div class="modal-footer">
	    <button type="button" class="btn btn-default" id="myModal_close" data-dismiss="modal">Close</button>
		<input type="submit" name="finish" value="Add / Edit" class="btn btn-success" />
        </div>
      </div>
      
    </div>
	
		  </form>
  </div>
<!-- Model End -->   

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable()
  })
 
</script>