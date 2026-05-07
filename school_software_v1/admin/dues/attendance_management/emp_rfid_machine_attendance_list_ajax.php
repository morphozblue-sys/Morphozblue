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
		$emp_department=$_GET['emp_department'];
			$condition="";
			if($emp_department!='All'){
			    $condition="and emp_department='$emp_department'";
			}
			$attendance_staff_date=$_GET['attendance_staff_date'];
			$attendance_staff_date2=explode('-',$attendance_staff_date);
			$attendance_staff_date3=$attendance_staff_date2[2]."-".$attendance_staff_date2[1]."-".$attendance_staff_date2[0];
			$attendance_staff_date4=$attendance_staff_date2[2];
			$year=$attendance_staff_date2[0];
			$month=$attendance_staff_date2[1];
            $day=intval($attendance_staff_date2[2]);
   $i=$day;
				$touch_column='touch_'.$i;
				$attendance_column='attendance_'.$i;

$quer="select * from staff_attendance where $touch_column like '%-software-machine%' and month='$month' and year='$year' ORDER BY update_date DESC";
$runn=mysqli_query($conn73,$quer) or die(mysqli_error($conn73));
$serial=0;
while($row=mysqli_fetch_assoc($runn)){

$emp_name = $row['emp_name'];
$emp_department = $row['emp_department'];
$emp_designation = $row['emp_designation'];
$unique_id = $row['emp_id'];
$touch_time= $row[$touch_column];
$unique_id = $row['emp_id'];

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