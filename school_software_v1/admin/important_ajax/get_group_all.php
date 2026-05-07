<?php include("../attachment/session.php");
?><option  value="All">All</option>
<?php 
 $stream_name = $_GET['stream_name'];
$quer="select * from school_info_stream_group where stream_name='$stream_name'";
$result=mysqli_query($conn73,$quer);
while($row=mysqli_fetch_assoc($result)){
	$group_name = $row['group_name'];
				?>
<option value="<?php echo $group_name ?>"><?php echo $group_name ?></option>	
		<?php 	} ?>