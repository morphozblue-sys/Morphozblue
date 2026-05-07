<option value="">Select</option>
<?php
$sports_name=$_GET['name'];

include("../../con73/con37.php");
$que15="select * from event_table where event_name='$sports_name'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));

while($row15=mysqli_fetch_assoc($run15)){
         
		$event_activity=$row15['event_activity'];
	
?>
<option value="<?php echo $event_activity; ?>"><?php echo $event_activity; ?></option>

<?php } ?>