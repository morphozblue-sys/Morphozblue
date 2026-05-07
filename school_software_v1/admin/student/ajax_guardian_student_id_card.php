<?php include("../attachment/session.php"); ?>      
                <table id="example3" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th><?php echo $language['S No']; ?></th>
				  <th>Admission No.</th>
                  <th><?php echo $language['Student Roll No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Select Student']; ?></th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                </tr>
                </thead>
				
				<tbody>
			

<?php
$student_section=$_GET['student_section'];
 $student_class=$_GET['id'];
if($student_class=="All"){
$condition="";
}elseif($student_section=="All"){
$condition="student_class='$student_class' &&";
}
else{
$condition="student_class='$student_class' && student_class_section='$student_section' &&";
}



$query1="select * from student_admission_info where $condition student_status='Active'  and session_value='$session1'  ORDER BY student_name";
$serial_no=0;
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$student_name=$row1['student_name'];
$student_roll_no=$row1['student_roll_no'];
$school_roll_no=$row1['school_roll_no'];
$student_admission_number=$row1['student_admission_number'];

$update_change=$row1['update_change'];
if($row1['last_updated_date']!='0000-00-00'){
$last_updated_date=date('d-m-Y',strtotime($row1['last_updated_date']));
}else{
$last_updated_date=$row1['last_updated_date'];
}

$serial_no++;
?>

  
<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $student_admission_number; ?></td>
<td><?php echo $school_roll_no; ?></td>
<td><?php echo $student_name; ?></td>
<td><input type="checkbox"  name="school_id_card_info[]" value="<?php echo $student_roll_no; ?>" checked ></td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>
</tr>
<?php  } ?>
 	
		        </tbody>
				
                </table>
				<script>
  $(function () {
    $('#example3').DataTable()
  })
</script>