<?php include("../attachment/session.php"); ?>
<table id="example1" class="table table-bordered table-striped">
	<thead class="my_background_color">
		<tr>
	    <th>All<br/><input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	    <th>S No.</th>
        <th>Participate Type</th>
        <th>Name Of Event</th>
        <th>Name Of Participants</th>
        <th>DOB</th>
        <th>Class & Section</th>
        <th>Gender</th>
        <th>School/Institute Name</th>
        <th>Category</th>
        <th>House Name</th>
        <th style="width:150px;">Result Remarks</th>
        <th>Delete</th>
        </tr>
	</thead>
	<tbody>
<?php

// if($event_name!=''){  
// $condition1=" and event_name='$event_name'";
// }else{
// $condition1="";
// }

$event_name=$_GET['event_name'];
if($event_name!=''){
if($event_name!='All'){
$condition1=" and event_name='$event_name'";
}else{
$condition1="";
}
}else{
$condition1="";
}
// if($house_wise!=''){
// $condition2=" and house_name='$house_wise'";
// }else{
// $condition2="";
// }

$house_wise=$_GET['house_wise'];
if($house_wise!=''){
if($house_wise!='All'){
    $condition2=" and house_name='$house_wise'";
}else{
   $condition2="";
}
}else{
  $condition2="";
}

// if($remarks!=''){
// $condition3=" remark='$remarks'";
// }else{
// $condition3="";
// }

$remarks=$_GET['remarks'];
if($remarks!=''){
if($remarks!='All'){
$condition3=" and remark='$remarks'";
}else{
$condition3="";
}
}else{
$condition3="";
}

 $query1="select * from event_result where s_no!=''$condition3$condition1$condition2 ORDER BY student_name"; 
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
	$participate_type = $row['participate_type'];
	$student_name = $row['student_name'];
	$event_name = $row['event_name'];
	$house_name = $row['house_name'];
	$school_name = $row['school_name'];
	$gender = $row['gender'];
	$student_class = $row['student_class'];
	$dateofbirth = $row['dateofbirth'];
	$remark = $row['remark'];
	$category = $row['category'];
    $serial_no++;
	?>
  <tr align='center'>
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no1; ?>" name="student_index[]"></td>
    <td><?php echo $serial_no; ?></td>
	<td><input type="text" value="<?php echo $participate_type; ?>" name="" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $event_name; ?>" name="" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $student_name; ?>" name="" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $dateofbirth; ?>" name="" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $student_class; ?>" name="" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $gender; ?>" name="" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $school_name; ?>" name="" class="form-control" style="border:none;" readonly></td>
    <td><?php echo $category; ?></td>
    <td><?php echo $house_name; ?></td>
    <td><?php echo $remark; ?></td>
    <td><button type="button" class="btn btn-default" onclick="return valid('<?php echo $s_no; ?>');">Delete</button></td>
  </tr>
	<?php  $serial_no11++; } ?>
     </tbody>
     </table>
	<div class="col-md-12">
	    <center><input type="submit" name="submit" class="btn btn-success" onclick="return validation();" style="display:none;" value="Print"/></center>
	 </div>
	 
	 
<script>

$(function () {
$('#example1').DataTable()
})



  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>