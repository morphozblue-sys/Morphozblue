<?php
 $search_by = $_GET['search_by'];
 include("../../con73/con37.php");	
 $query="select * from stock_item_table where item_status='Active' && item_product_name like '%$search_by%' ";
 
 
 
 
 
 
$result=mysqli_query($conn73,$query);
$serial_no=0;
 while($row=mysqli_fetch_assoc($result)){
	$s_no=$row['s_no'];
		$item_product_name=$row['item_product_name'];
		$item_brand_name=$row['item_brand_name'];
		$item_description=$row['item_description'];
		$item_status=$row['item_status'];
		
	$serial_no++;
	
?>
	
<tr  align='center' >

	<th style="width:50";><?php echo $serial_no; ?></th>
	<th><?php echo $item_product_name; ?></th>
	<th><?php echo $item_brand_name; ?></th>
	<th><?php echo $item_description; ?></th>
	
<th style="width:50";>
	<center>
	<a href='sales_item.php?id=<?php echo $s_no; ?> 'style="color:#fff;"><input type="button" value="Sale" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a href='buy_item.php?id=<?php echo $s_no; ?> 'style="color:#fff;"><input type="button" value="Buy" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a style="color:Red;" aria-hidden="true" onclick="return myFunction()" class="fa fa-times" href='item_delete.php?id=<?php echo $s_no; ?>'> Delete</a>
	</center>
</th>

</tr>

<?php } ?>