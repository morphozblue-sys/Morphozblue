<?php include("../attachment/session.php"); ?>
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
  <th><?php echo $language['S No']; ?></th>
  <th><?php echo $language['Name']; ?></th>
  <th><?php echo $language['Father Name']; ?></th>
  <th><?php echo $language['Date']; ?></th>
  <th><input type="checkbox" id="info" value="" checked onclick="for_check(this.id);" />All</th>
</tr>
</thead>
<tbody>

<?php

 $enquiry_type=$_POST['enquiry_type'];

if($enquiry_type!='All'){
	$condition1=" and enquiry_type='$enquiry_type'";
}else{
	$condition1="";
}

$from_date=$_POST['from_date'];
if($from_date!=''){
	$condition2=" and enquiry_date>='$from_date'";
}else{
	$condition2="";
}

$to_date=$_POST['to_date'];
if($to_date!=''){
	$condition3=" and enquiry_date<='$to_date'";
}else{
	$condition3="";
}


if($enquiry_type=="other"){
      $que2="select * from enquiry_info where enquiry_type !='for job' AND enquiry_type !='for admission' AND session_value='$session1'$condition2$condition3 ";
}else{
    $que2="select * from enquiry_info where session_value='$session1'$condition1$condition2$condition3";
}

// $que2="select * from enquiry_info where session_value='$session1'$condition1$condition2$condition3";
$run2=mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
$serial_no=0;
while($row2=mysqli_fetch_assoc($run2)){
$enquiry_name = $row2['enquiry_name'];
$enquiry_father_name = $row2['enquiry_father_name'];
$enquiry_contact_no_1 = $row2['enquiry_contact_no_1'];
$enquiry_contact_no_2 = $row2['enquiry_contact_no_2'];
$enquiry_date = $row2['enquiry_date'];
if($enquiry_date!=''){
$enquiry_date = date('d-m-Y',strtotime($enquiry_date));
}

$serial_no++;
?>
<tr>
  <td><?php echo $serial_no; ?></td>
  <td><?php echo $enquiry_name; ?></td>
  <td><?php echo $enquiry_father_name; ?></td>
  <td><?php echo $enquiry_date; ?></td>
  <td><input type="checkbox" name="enquiry_info[]" class="info" value="<?php echo $enquiry_contact_no_1; ?>" checked /></td>
</tr>
<?php } ?>
</tbody>
<tfoot>
<tr>
  <td colspan="5"><center><input type="submit" name="finish" value="Send SMS" onclick="return validate();" class="btn  btn-success" /></center></td>
</tr>
</tfoot>
</table>