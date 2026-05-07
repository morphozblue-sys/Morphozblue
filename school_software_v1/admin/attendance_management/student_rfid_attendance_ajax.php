<?php include("../attachment/session.php"); 
die();
?>
<table id="example1" class="table table-bordered table-striped" style="width:100%">
<thead>
<tr>
  <th>S No</th>
  <th>Student Name</th>
  <th>Class</th>
  <th>Touch Time</th>
</tr>
</thead>
<tbody>
<?php
$current_date1=date('d');
$current_month1=date('m');
$current_year1=date('Y');
date_default_timezone_set('Asia/Calcutta');
   $i=$current_date1;
				
				$touch_column_in='intime_'.$i;
				$touch_column_out='outtime_'.$i;
				$attendance_column=$i;

$quer="select * from student_attendance where  $touch_column_in!='0000-00-00 00:00:00' and $attendance_column!='' and month='$current_month1' and year='$current_year1' ORDER BY last_updated_date DESC";
$runn=mysqli_query($conn73,$quer) or die(mysqli_error($conn73));
$serial=0;
while($row=mysqli_fetch_assoc($runn)){

$student_name = $row['attendance_name'];
$student_class = $row['attendance_class'];
$student_section = $row['attendance_section'];
$unique_id = $row['attendance_roll_no'];
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
<td><?php echo $student_name; ?></td>
<td><?php echo $student_class." / '".$student_section."'"; ?></td>
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