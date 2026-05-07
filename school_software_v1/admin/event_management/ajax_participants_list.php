<table class="table table-bordered table-striped">
   <thead>
      <tr>
	  <th>All<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
      <th>Name</th>
	 </tr>
   </thead>
   <tbody>
<?php
include("../attachment/session.php");
$event_name=$_GET['id'];
$query1="select * from event_participate_table where event_name='$event_name'";
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$student_name=$row1['student_name'];
?>

<tr>
<td><input type="checkbox" name="name_participants[]" class="checked1" checked value="<?php echo $s_no.'|?|'.$student_name; ?>" /></td>
<td><?php echo $student_name; ?></td>
</tr>

<?php } ?>
</tbody>
</table>
    




