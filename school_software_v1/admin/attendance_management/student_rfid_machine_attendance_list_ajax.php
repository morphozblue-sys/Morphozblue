<?php include("../attachment/session.php");
die();
	$attendance_student_class=$_GET['attendance_student_class'];
			if($attendance_student_class!='All'){
			    $condition=" and student_class='$attendance_student_class'";
			}else{
			    $condition="";
			}
		
			$attendance_student_date=$_GET['attendance_student_date'];
			
			$attendance_student_date2=explode('-',$attendance_student_date);
			$attendance_student_date3=$attendance_student_date2[2]."-".$attendance_student_date2[1]."-".$attendance_student_date2[0];
			$attendance_student_date4=$attendance_student_date2[2];
			$year=$attendance_student_date2[0];
			$month=$attendance_student_date2[1];
            $day=intval($attendance_student_date2[2]);


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
   $i=$day;
				$touch_column='touch_'.$i;
				$attendance_column='attendance_'.$i;

$quer="select * from student_attendance where $touch_column like '%-software-machine%' and month='$month' $condition and year='$year' ORDER BY update_date DESC";
$runn=mysqli_query($conn73,$quer) or die(mysqli_error($conn73));
$serial=0;
while($row=mysqli_fetch_assoc($runn)){

$student_name = $row['student_name'];
$student_class = $row['student_class'];
$student_section = $row['student_section'];
$unique_id = $row['student_id'];
$touch_time= $row[$touch_column];
$unique_id = $row['student_id'];

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