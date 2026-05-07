<?php include("../attachment/session.php");
					
$que321="select * from school_info_pdf_info";
$run321=mysqli_query($conn73,$que321);
while($row321=mysqli_fetch_assoc($run321)){
	$time_table_pdf = $row321['time_table_pdf'];
}	

$emp_name=$_GET['emp_name'];

?>

<tr align='center'>
	<th>1</th>
	<th><?php echo $emp_name; ?></th>
	
	<th></th>
    <th></th>
	
	<th><a href='<?php echo $pdf_path; ?>time_table/<?php echo 'teacherwise_new_'.$time_table_pdf; ?>?emp_name=<?php echo $emp_name; ?>' target="_blank"><button type="button" class="btn btn-success" >Print</th>
</tr>
