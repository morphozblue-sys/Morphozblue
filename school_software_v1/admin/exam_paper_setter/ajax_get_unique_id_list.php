<?php
include("../attachment/session.php");
?>
<label >Unique Id</label>
<select name='paper_unique_id' class='form-control' id='paper_unique_id' onchange="for_detail();for_list();for_edit(this.value);" required>
<option value=''>Select</option>
<?php
$que="select * from question_paper_set GROUP BY paper_unique_id";
$run=mysqli_query($conn73,$que);
if(mysqli_num_rows($run)>0){
while($row=mysqli_fetch_assoc($run)){

	$paper_unique_id=$row['paper_unique_id'];

?>
<option value="<?php echo $paper_unique_id; ?>"><?php echo $paper_unique_id; ?></option>
<?php
}
}
?>
</select>