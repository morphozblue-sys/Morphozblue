<?php
include("../attachment/session.php");
$category_s_no=$_GET['category_s_no'];
if($category_s_no!='All'){
    $condition1=" and nst.item_category='$category_s_no'";
}else{
    $condition1="";
}
$search_item_class=$_GET['search_item_class'];
if($search_item_class!='All'){
    $condition2=" and nst.item_class='$search_item_class'";
}else{
    $condition2="";
}
?>
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
					<th>S.No.</th>
					<th>Item Name  </th>
					<!--<th><?php echo $language['Product Brand']; ?></th>-->
					<th>Item Description</th>
					<th>Category</th>
					<th>Item Class</th>
					<th>Sale Rates</th>
					<th>Opening Stock</th>
					<th>Update By</th>
					<th>Date</th>
					<th><center><?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody>
                <?php
                $que="select nst.*, ns.opening_stock, ns.sale_rate from new_stock_item as nst join new_stock as ns on ns.item_s_no=nst.s_no where nst.stock_item_status='Active'$condition1$condition2 order by nst.s_no desc";
                $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                $serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
                		$s_no=$row['s_no'];
                		$item_name=$row['item_name'];
                		//$item_brand_name=$row['item_brand_name'];
                		$item_description=$row['item_description'];
                		$item_category=$row['item_category'];
                		$item_class=$row['item_class'];
                		$sale_rate=$row['sale_rate'];
                		$opening_stock=$row['opening_stock'];
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
                    	<td><?php echo $item_name; ?></td>
                    	<td><?php echo $item_description; ?></td>
                    	<td><?php echo $category_name; ?></td>
                    	<td><?php echo $item_class; ?></td>
                    	<td><?php echo $sale_rate; ?></td>
                    	<td><?php echo $opening_stock; ?></td>
                    	<td><?php echo $update_change; ?></td>
                    	<td><?php echo $last_updated_date; ?></td>
                        <td>
                        	<center>
                        	<a href="javascript:post_content('stock_management/edit_stock_item','id=<?php echo $s_no; ?>')" style="color:#fff;"><input type="button" value="Edit" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;
                        	<button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button> &nbsp;
                        	<button type="button"  class="btn btn-warning" onclick="for_rates('<?php echo $s_no; ?>');" data-toggle="modal" data-target="#myModal" >Add/Edit Rates</button>
                        	</center>
                        </td>
                    </tr>
                <?php } ?>
        		</tbody>
             </table>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>