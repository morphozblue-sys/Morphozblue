<?php include("../attachment/session.php"); ?>
<script>

function valid1(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_data(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_data(s_no){
$.ajax({
type: "POST",
url: access_link+"recycle_bin/recycle_purchase_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('recycle_bin/recycle_hostel_account_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
function valid(s_no){   
var myval=confirm("Are you sure want to restore this record !!!!");
if(myval==true){
restore_data(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function restore_data(s_no){
$.ajax({
type: "POST",
url: access_link+"recycle_bin/recycle_purchase_restore.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Restore','green');
				   get_content('recycle_bin/recycle_hostel_account_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script>

    <section class="content-header">
      <h1>
        Recycle Bin
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
      	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('recycle_bin/recycle_bin')"><i class="fal fa-trash-alt"></i> Recycle Bin</a></li>
        <li class="active">Hostel Account Recycle Bin</li>
      </ol>
    </section>


	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                 <tr>
<?php
$que="select * from hostel_stock_purchase where purchase_status='Deleted'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$total_purchase_amount=0;
while($row=mysqli_fetch_assoc($run)){
$total_purchase_amount+=$row['total_purchase_amount'];
}
?>
   <tr>
	<th colspan='5' align='center' ><font color="#f1f1f1">Hostel Expenses</th>
	<th colspan='2' align='center' ><font color="black">Total Amount Hostel Expense</th>
	<th colspan='2' align='center' ><font color="black"><?php echo $total_purchase_amount; ?>/-</th>
   </tr>
					<th style="width:50px";>S No</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Rate</th>
					<th>Shop Name</th>
					<th>Contact Person Name</th>
					<th>Total Amount</th>
					<th >Restore</th>
					<th >Delete</th>
                </tr>
                </thead>
				<tbody id="search_table">
<?php
$que="select * from hostel_stock_purchase where purchase_status='Deleted'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$item_product_name=$row['item_product_name'];
		$item_quantity=$row['item_quantity'];
		$item_purchase_rate=$row['item_purchase_rate'];
		$shop_name=$row['shop_name'];
		$contact_person_name=$row['contact_person_name'];
		$total_purchase_amount=$row['total_purchase_amount'];
		
	$serial_no++;
	
?>

<tr align='center' >
	<th style="width:50";><?php echo $serial_no; ?></th>
	<th><?php echo $item_product_name; ?></th>
	<th><?php echo $item_quantity; ?></th>
	<th><?php echo $item_purchase_rate; ?></th>
	<th><?php echo $shop_name; ?></th>
	<th><?php echo $contact_person_name; ?></th>
	<th><?php echo $total_purchase_amount; ?></th>
	<td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Restore']; ?></button></td>
	<td><button type="button"  class="btn btn-danger" onclick="return valid1('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
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
$(function(){
$('#example1').DataTable()
})
</script>