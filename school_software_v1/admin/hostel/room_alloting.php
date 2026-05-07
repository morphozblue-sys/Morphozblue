<?php 
include("../../con73/con37.php");

 $hostel_name=$_GET['hostel_name'];
 $hostel_name=str_replace("%20"," ",$hostel_name);
$que13="select * from hostel_add_room where hostel_name='$hostel_name' and room_status='Active'";
$run13=mysqli_query($conn73,$que13);$ser=0;
while($row13=mysqli_fetch_assoc($run13)){
$s_no=$row13['s_no'];
$room_number=$row13['room_number'];
$room_bed_type=$row13['room_bed_type'];
$room_facility=$row13['room_facility'];
$room_attach_washroom=$row13['room_attach_washroom'];
$room_charge_per_student=$row13['room_charge_per_student'];
$fill=$row13['fill']; $ser++;?>
<div class="form-group col-md-4">
<div class="form-group col-md-12 my_background_color" style="background:#BFC9CA;height:120px; border-radius:5px; color:white; padding:5px 5px 5px 5px;">
<label>Room Number:<?php echo $room_number; ?>
</label></br>
<?php
for($i=1; $i<=$room_bed_type; $i++){
if($i<=$fill){
?>
<div class="btn-group">
<input type="hidden" name="detail" id="<?php echo "detail".$room_number; ?>" value="<?php echo $room_facility."|?|".$room_attach_washroom."|?|".$room_charge_per_student; ?>" /><button class="btn" style="background-color:green;margin:5px;" onclick="bed_details('<?php echo $room_number; ?>', '<?php echo $room_bed_type; ?>');" data-dismiss="modal"><?php echo $i; ?></button></div>
<?php }else { ?>
<div class="btn-group"  style="background-color:red;width:32px;height:32px;margin:5px;" disabled>
<center style="padding:5px 5px 5px 5px;"><font style="color:white;" ><?php echo $i; ?></font></center>
</div>
<?php } } ?>
</div>
</div>
<?php } ?>
