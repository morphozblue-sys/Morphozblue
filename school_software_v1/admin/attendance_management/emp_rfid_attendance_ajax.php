<?php include("../attachment/session.php"); ?>
<table id="example1" class="table table-bordered table-striped" style="width:100%">
<thead>
<tr>
  <th>S No</th>
  <th>Employee Name</th>
  <th>Department</th>
  <th>Designation</th>
  <th>Touch Time</th>
</tr>
</thead>
<tbody>
<?php
$current_date1=intval(date('d'));
$current_month1=date('m');
$current_year1=date('Y');
date_default_timezone_set('Asia/Calcutta');
   $i=$current_date1;
				
				$touch_column_in='intime_'.$i;
				$touch_column_out='outtime_'.$i;
				$attendance_column=$i;

$quer="select * from staff_attendance where  $touch_column_in!='0000-00-00 00:00:00' and $attendance_column!='' and month='$current_month1' and year='$current_year1' ORDER BY last_updated_date DESC";
$runn=mysqli_query($conn73,$quer) or die(mysqli_error($conn73));
$serial=0;
while($row=mysqli_fetch_assoc($runn)){

$emp_name = $row['staff_name'];
$emp_department = $row['staff_type'];
$emp_designation = $row['staff_designation'];
$unique_id = $row['staff_id'];
if($row[$touch_column_in]!='0000-00-00 00:00:00'){
$touch_time= $row[$touch_column_in];
}elseif($row[$touch_column_out]!='0000-00-00 00:00:00'){
$touch_time= $touch_time."-".$row[$touch_column_out];
}else{
  $touch_time="";  
}

$serial++;
?>
<tr  align='center' >

<td><?php echo $serial.'.'; ?></td>
<td><?php echo $emp_name; ?></td>
<td><?php echo $emp_department; ?></td>
<td><?php echo $emp_designation; ?></td>
<td><?php echo $touch_time; ?></td>

</tr>
<?php
}
?>
</tbody>

</table>
<script>
  $(function () {
    $('#example1').DataTable();
  })
</script>