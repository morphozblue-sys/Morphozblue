<?php include("../attachment/session.php"); ?>
<style>
#staff_company {
    padding: 15px;
    width: 100%;
    height: 300px;
    overflow: scroll;
    border: 1px solid #ccc;
}
</style>
<div id="staff_company">
<table id="example1" class="table table-bordered table-striped">
		<thead >
		<tr>
        <th>All<br/><input type="checkbox" id="checked2" checked value="" name="" onclick="for_check(this.id);"></th>
	    <th>S No.</th>
        <th>Name Of Staff</th>
        <th>Designation</th>
        <th>Contact No</th>
        <th>Name Of Events</th>
        <th style="width:150px;">Remarks</th>
        </tr>
        </thead>
        <tbody>
		<?php
$sports_name=$_GET['sports_name'];		
$query1="select * from employee_info where s_no!='' ORDER BY emp_name";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no1=0;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
	$emp_name= $row['emp_name'];
	$emp_designation = $row['emp_designation'];
	$emp_mobile = $row['emp_mobile'];
	$serial_no++;
	
	?>
  <tr align='center'>
    <td><input type="checkbox" class="checked2" checked value="<?php echo $serial_no1; ?>" name="staff_index[]"></td>
    <td><?php echo $serial_no; ?></td>
	<td><input type="text" value="<?php echo $emp_name; ?>" name="emp_name[]" class="form-control" style="border:none;" readonly></td>
	<td><input type="text" value="<?php echo $emp_designation; ?>" name="emp_designation[]" class="form-control" style="border:none;" readonly></td>
    <td><input type="text" value="<?php echo $emp_mobile; ?>" name="emp_mobile[]" class="form-control" style="border:none;" readonly></td>
   <td><input type="text" name="sports_name[]" class="form-control" value="<?php echo $sports_name; ?>" readonly></td>
   <td><input type="text" name="remark_staff[]" class="form-control"></td>
  </tr>
	<?php  $serial_no1++; } ?>
     </tbody>
     </table>
	 </div>
	 <!----<div class="col-md-12">
		<center><input type="submit" name="finish" value="Submit" onclick="return validation();" class="btn btn-success"/></center> 
	 </div>--->
	 
<script>
$(function(){
$('#example1').DataTable()
})
</script>