<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock/stock')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active"> <?php echo $language['Item List']; ?></li>
        </ol>
    </section>

<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_item(s_no);       
 }            
else  {      
return false;
 }       
  }

function delete_item(s_no){
$.ajax({
type: "POST",
url: access_link+"stock/item_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('stock/item_list');
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
        <div class="col-xs-12">
          <!-- /.box -->
		  
		<div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
			  <div class="col-lg-3"></div>
			   <a href="javascript:get_content('stock/add_item')"> <button style="float:right;" type="button" class="btn btn-primary"><?php echo $language['+ Add New Item']; ?></button></a>  
			</div>
			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
					<th style="width:50px";><?php echo $language['S No']; ?></th>
					<th><?php echo $language['Product Name']; ?></th>
					<th>Category</th>
					<th><?php echo $language['Product Brand']; ?></th>
					<th><?php echo $language['Product Description']; ?></th>
					<th>Product Quantity</th>
					<th>Rate/Product</th>
					<th>Product Code</th>
					<th ><center><?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody id="search_table">


<?php
$que="select * from stock_item_table where item_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$item_product_name=$row['item_product_name'];
		$item_product_category = $row['item_product_category'];
		$item_brand_name=$row['item_brand_name'];
		$item_description=$row['item_description'];
		$item_status=$row['item_status'];
	    $item_quantity = $row['item_quantity'];
    	$item_code = $row['item_code'];
    	$item_rate = $row['item_rate'];

$que1="select category_name from stock_category where category_status='Active' and s_no='$item_product_category'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
$category_name='';
while($row1=mysqli_fetch_assoc($run1)){
$category_name=$row1['category_name'];
}

	$serial_no++;
?>

<tr  align='center' >

	<th style="width:50";><?php echo $serial_no; ?></th>
	<th><?php echo $item_product_name; ?></th>
	<th><?php echo $category_name; ?></th>
	<th><?php echo $item_brand_name; ?></th>
	<th><?php echo $item_description; ?></th>
	<th><?php echo $item_quantity; ?></th>
	<th><?php echo $item_rate; ?></th>
	<th><?php echo $item_code; ?></th>
	
<th style="width:50";>
	<center>
	<!--<a href='sales_item.php?id=<?php echo $s_no; ?> 'style="color:#fff;"><input type="button" value="Sale" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;&nbsp;&nbsp;&nbsp;-->
	<a href="javascript:post_content('stock/buy_item','id=<?php echo $s_no; ?>')" style="color:#fff;"><input type="button" value="<?php echo $language['Buy']; ?>" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:post_content('stock/edit_item','id=<?php echo $s_no; ?>')" style="color:#fff;"><input type="button" value="Edit" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;
    <button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
	</center>
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
  $(function () {
    $('#example1').DataTable()
  })
 
</script>