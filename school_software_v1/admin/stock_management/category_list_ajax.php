<?php include("../attachment/session.php"); ?>  
 <div class="col-xs-12">
              <table id="example1" class="table table-bordered table-striped" >
                <thead >
                <tr>
					<th>S.No.</th>
					<th>Category Name</th>
					<th>Short Description</th>
					<th>Remark</th>
					<th>Classwise</th>
					<th>Color</th>
					<th>Size</th>
					<th>Height</th>
					<th>Weight</th>
					<th>Subject</th>
                    <th>Update By</th>
                    <th>Date</th>
					
					<th><center><?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody id="search_table">


<?php
$que="select * from stock_management_item_category where status='Active' ORDER BY s_no DESC";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
	    $category_name=$row['category_name'];
    $category_description=$row['category_description'];
    $category_remark=$row['category_remark'];
    $class_wise=$row['class_wise'];
    $color=$row['color'];
    $size=$row['size'];
    $height=$row['height'];
    $weight=$row['weight'];
    $subject=$row['subject'];
		$update_by=$row['update_change'];
		$update_date=$row['last_updated_date'];
		if($update_date!='' && $update_date!='0000-00-00 00:00:00'){
		    $update_date=date('d-m-Y h:i:s',strtotime($update_date));
		}
		
	$serial_no++;
?>

<tr>

	<td><?php echo $serial_no; ?></td>
	<td><?php echo $category_name; ?></td>
	<td><?php echo $category_description; ?></td>
	<td><?php echo $category_remark; ?></td>
	<td><?php echo $class_wise; ?></td>
	<td><?php echo $color; ?></td>
	<td><?php echo $size; ?></td>
	<td><?php echo $height; ?></td>
	<td><?php echo $weight; ?></td>
	<td><?php echo $subject; ?></td>
	<td><?php echo $update_by; ?></td>
	<td><?php echo $update_date; ?></td>
	
    <td>
    <center><input type="button" value="Edit" class="btn btn-success" onclick="edit_item('<?php echo $s_no; ?>');" style="margin:5px;width:70px;">
    <button type="button"  class="btn btn-warning" onclick="return valid('<?php echo $s_no; ?>');" style="margin:5px;width:70px;" ><?php echo $language['Delete']; ?></button>
    </center>
    </td>

</tr>

<?php } ?>
		</tbody>
             </table>
             </div>
             <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>