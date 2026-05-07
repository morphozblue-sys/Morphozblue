<?php
include("../../con73/con37.php");
 $id=$_GET['id'];
 $id2=$_GET['id2'];
 $sql="select * from school_library_book where book_catagory='$id' && class='$id2'";
$serial_no=0;
$ex=mysqli_query($conn73,$sql);
while($row=mysqli_fetch_assoc($ex)){
     $id=$row['id'];
    $book_id_no=$row['book_id_no'];
    $book_title=$row['book_title'];
    $book_catagory=$row['book_catagory'];
    $class=$row['class'];
    $publish_date=$row['publish_date'];
    $date1=explode("-",$publish_date);
	$date2=$date1[2]."-".$date1[1]."-".$date1[0];
    $publish_name=$row['publish_name'];
    $price=$row['price'];
    $no_of_copy=$row['no_of_copy'];
    $avaible_copy=$row['available_copy'];
    $image=$row['image'];
	$path="../image/";
	 $serial_no++;
	?>

			  
			  
			  

				<tr>
	        <th><?php echo $serial_no; ?></th>
	        <th><?php echo $book_id_no; ?></th>
	        <th><?php echo $book_title; ?></th>
	        <th><?php echo $book_catagory; ?></th>
			<th><?php echo $class; ?></th>
			<th><?php echo $date2; ?></th>
	        <th><?php echo $publish_name; ?></th>
		     <th><?php echo $price; ?></th>
			<th><?php echo $no_of_copy; ?></th>
			<th><?php echo $avaible_copy; ?></th>
			<?php if($image==null){  ?>
	<th><img src="<?php echo '../image/blank.jpg'; ?>" height="50" width="50"></th>
	<?php }else{ ?>
	<th><img src="<?php echo $path."/".$image; ?>" height="50" width="50"></th> 
	<?php	 } ?> 
			
			
			<td><a href='add_copy.php?id=<?php echo $book_id_no; ?>' style="color:black;"><input type="button" value="ADD BOOk" class="btn btn-primary" /></a>
			</td>
			
	   </tr>
				
			<?php } ?>
			