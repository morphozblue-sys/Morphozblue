<?php include("../attachment/session.php");
					
$que321="select * from school_info_pdf_info";
$run321=mysqli_query($conn73,$que321);
while($row321=mysqli_fetch_assoc($run321)){
	$time_table_pdf = $row321['time_table_pdf'];
}	

$class_name=$_GET['class'];
$section=$_GET['section'];
$student_class_group=$_GET['student_class_group'];
$student_class_stream=$_GET['student_class_stream'];
$que="select * from class_time_table where class_code='$class_name' and section='$section'  and group_name='$student_class_group' and stream_code='$student_class_stream' ";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$time_table_student_class = $row['class'];
	$time_table_section = $row['section'];
	$time_table_group = $row['group_name'];
	$time_table_stream = $row['stream_code'];
	$update_change=$row['update_change'];
    if($row['last_updated_date']!='0000-00-00'){
    $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
    }else{
    $last_updated_date=$row['last_updated_date'];
    }
	$serial_no++;
?>

<tr align='center'>
	<th><?php echo $serial_no; ?></th>
	<th><?php echo $time_table_student_class; ?></th>
	<th><?php echo $time_table_section; ?></th>
	
	<th><?php echo $update_change; ?></th>
    <th><?php echo $last_updated_date; ?></th>
	
	<th><a href='<?php echo $pdf_path; ?>time_table/<?php echo $time_table_pdf; ?>?class=<?php echo $time_table_student_class; ?>&class_code=<?php echo $class_name; ?>&section=<?php echo $time_table_section; ?>&student_class_stream=<?php echo $student_class_stream; ?>&student_class_group=<?php echo $student_class_group; ?>' target="_blank"><button type="button" class="btn btn-success" >Print</th>
</tr>
<?php } ?>