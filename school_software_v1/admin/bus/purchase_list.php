<?php include("../attachment/session.php"); ?>

    <section class="content-header">
      <h1>
			<?php echo $language['Expense']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
	   
      <ol class="breadcrumb">
	<li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
	  </ol>
		<a href="javascript:get_content('bus/buy_item')"><button type="button" class="btn btn-default pull-right my_background_color"><?php echo $language['Purchase']; ?></button></a>
    </section>
	
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
for_delete(s_no);       
 }            
else  {      
return false;
 }       
  }
  
function for_delete(s_no){
$.ajax({
type: "POST",
url: access_link+"bus/purchase_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
				   get_content('bus/purchase_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script>

	<!---*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?> ">
            
			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				
<?php

$que="select * from bus_stock_purchase where purchase_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$total_purchase_amount=0;
while($row=mysqli_fetch_assoc($run)){

		$total_purchase_amount+=$row['total_purchase_amount'];
	
		}
?>

   <tr>
	<th colspan='5' align='center' ><font color="#f1f1f1"><?php echo $language['Bus Expenses']; ?></th>
	<th colspan='2' align='center' ><font color="black"><?php echo $language['Total Amount Bus Expense']; ?></th>
	<th colspan='2' align='center' ><font color="black"><?php echo $total_purchase_amount; ?>/-</th>
   </tr>
					<th style="width:50px";><?php echo $language['S No']; ?></th>
					<th><?php echo $language['Product Name']; ?></th>
					<th><?php echo $language['Quantity']; ?></th>
					<th><?php echo $language['Rate']; ?></th>
					<th><?php echo $language['Shop Name']; ?></th>
					<th><?php echo $language['Contact Person Name']; ?></th>
					<th><?php echo $language['Total Amount']; ?></th>
					<th ><center><?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody id="search_table">


<?php
	
$que="select * from bus_stock_purchase where purchase_status='Active'";
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

<tr  align='center' >

	<th style="width:50";><?php echo $serial_no; ?></th>
	<th><?php echo $item_product_name; ?></th>
	<th><?php echo $item_quantity; ?></th>
	<th><?php echo $item_purchase_rate; ?></th>
	<th><?php echo $shop_name; ?></th>
	<th><?php echo $contact_person_name; ?></th>
	<th><?php echo $total_purchase_amount; ?></th>
	
<th>
	<center>

	<input type="button" onclick="return valid('<?php echo $s_no; ?>')" value="<?php echo $language['Delete']; ?>" class="btn btn-default" style="background-color:#00a654;color:#fff;"></center> &nbsp;&nbsp;&nbsp;&nbsp;
</th>

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