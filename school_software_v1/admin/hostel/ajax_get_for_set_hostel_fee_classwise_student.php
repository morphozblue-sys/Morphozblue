       <table id="" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>S.No.</th>
                  <th>Student Name</th>
                  <th><input type="checkbox"  id="check_all" checked onclick="for_check_all(this.id);" ></th>
                </tr>
                </thead>
				
				<tbody>

<?php
include("../attachment/session.php");
$class_name=$_GET['class_code'];
$student_class_section=$_GET['student_class_section'];
$category_code=$_GET['category_code'];
include("../../con73/con37.php");

if($student_class_section=="All"){
$condition="student_class='$class_name' and";
}
else{
$condition="student_class='$class_name' and student_class_section='$student_class_section' and";
}

include("../../con73/con37.php");

$query1="select * from student_admission_info where $condition student_status='Active' and student_fee_category_code='$category_code' and session_value='$session1' and student_hostel='Yes' ORDER BY student_name";
$serial_no=0;
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$student_name=$row1['student_name'];
$student_roll_no=$row1['student_roll_no'];
$school_roll_no=$row1['school_roll_no'];

$serial_no++;
?>

  
<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $student_name; ?></td>
<td><input type="checkbox"  name="student_roll_no[]" class="check_all" value="<?php echo $student_roll_no; ?>" checked ></td>
</tr>
<?php  } ?>
 	
		        </tbody>
				
                </table>
				<script>
  $(function () {
    $('#example3').DataTable()
  })
</script>