<?php include("../attachment/session.php")?>  

            <table id="example3" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S No</th>
                  <th>Student Name</th>
                  <th>Father Name</th>
                  <th>Select<br><input type="checkbox" id="checked1" checked value="<?php echo $student_roll_no; ?>" name="checked" onclick="for_check(this.id);"></th>
                </tr>
                </thead>
				
		<tbody>
<?php

 $student_class=$_GET['student_class1'];
 $student_class_section=$_GET['student_class_section1'];
if($student_class=='All'){
$query1="select * from student_admission_info where student_status='Active'";
}elseif($student_class!='' && $student_class_section!='all'){
$query1="select * from student_admission_info where student_class='$student_class' and student_class_section='$student_class_section' and student_status='Active'";
}elseif($student_class!='' && $student_class_section!=''){
$query1="select * from student_admission_info where student_class='$student_class' and student_status='Active'";
}
 

$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));;
$serial_no=0;
while($row=mysqli_fetch_assoc($res)){
$s_no=$row['s_no'];
		$student_name=$row['student_name'];
		$student_father_name=$row['student_father_name'];
		$student_roll_no=$row['student_roll_no'];
		$serial_no++;
?>

<tr>
       <td><?php echo $serial_no; ?></td>
	   <td><?php echo $student_name; ?><input type="hidden" checked value="<?php echo $student_name; ?>" name=""></td>
	   <td><?php echo $student_father_name; ?></td>
	   <td><input type="checkbox" id="checked" class="checked1" checked value="<?php echo $student_roll_no; ?>" name="student_roll_no[]">
		</td>
</tr>

<?php

}                                
?>
 		</tbody>
			   </table>
				<script>
  $(function () {
    $('#example3').DataTable()
  })
</script>