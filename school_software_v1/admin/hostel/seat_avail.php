<?php include("../attachment/session.php"); ?>
<?php
 $hostel_name=$_GET['hostel_name'];
 $hostel_name=str_replace("%20"," ",$hostel_name);

 $que13="select * from hostel_add_room where hostel_name='$hostel_name' and room_status='Active'";
 $run13=mysqli_query($conn73,$que13);
$ser=0;
while($row13=mysqli_fetch_assoc($run13)){
 $s_no=$row13['s_no'];
 $room_number=$row13['room_number'];
 $room_bed_type=$row13['room_bed_type'];
 $fill=$row13['fill'];
 $hostel_name=$row13['hostel_name'];

$ser++;
?>

<div class="form-group col-md-2">
<div class="form-group col-md-10 my_background_color" style="background:#BFC9CA;height:120px; border-radius:5px; color:white; padding:5px 5px 5px 5px;">
<label>Room Number:<?php echo $room_number; ?></label>
</br>
<?php
for($i=1; $i<=$room_bed_type; $i++){
if($i<=$fill){
?>
<div class="btn-group">
<button class="btn" style="background-color:green;margin:5px;" disabled onclick="bed_details(<?php echo $room_number.','.$room_bed_type; ?>);" data-dismiss="modal" ><?php echo $i; ?> </button></div>
<?php }else { ?>
<!-- a href="javascript:post_content('hostel_student_list_detail','<?php echo 'id='.$room_number.'&sno='.$hostel_name;?>')" -->
<div class="btn-group" style="background-color:red;width:32px;height:32px;margin:5px;">
<center style="padding:5px 5px 5px 5px;"><font style="color:white;"><?php echo $i; ?></font></center>
</div>
<!-- /a -->
<?php } } ?>
</div></div>
<?php } ?>
