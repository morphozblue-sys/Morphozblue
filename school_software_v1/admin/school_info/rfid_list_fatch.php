<?php include("../attachment/session.php"); ?>
	<?php
$que="select * from school_info_rfid_card order by s_no DESC";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=mysqli_num_rows($run);
	
while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$rfid_no = $row['rfid_no'];
	


?>				
			
				<tr  align='center' >

	<th ><?php echo $serial_no; ?></th>
	<th  ><?php echo $rfid_no; ?></th>
	<th  >	
<button type="button" onclick="return valid('<?php echo $s_no; ?>')" class="btn btn-success">
                <?php echo $language['Delete']; ?></button>	</th>

	
	
	
	
	            </tr>
				<?php
				
					$serial_no--;
					
					} ?>