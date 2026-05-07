<?php 
include("../attachment/session.php"); ?> 
<table id="example3" class="table table-bordered table-striped">
    <thead class="my_background_color">
    <tr>
        <th>S.No.</th>
        <th>Student Name</th>
        <th>Father Name</th>
        <th>Class</th>
        <th>Section</th>
        <th>Select Student &nbsp;<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
    </tr>
    </thead>
<tbody>
<?php
$student_class=$_GET['student_class'];
$student_section=$_GET['student_section'];
if($student_section=='All'){
    $condition="";
}else{
    $condition=" and student_class_section='$student_section'";
}
$query1="select * from student_admission_info where student_status='Active' and session_value='$session1' and student_class='$student_class'$condition$filter37 ORDER BY student_name";
$serial_no=0;
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$student_name=$row1['student_name'];
$student_father_name=$row1['student_father_name'];
$student_class=$row1['student_class'];
$student_class_section=$row1['student_class_section'];
$student_roll_no=$row1['student_roll_no'];

$query2 = "select * from common_fees_student_fee where student_roll_no='$student_roll_no' and fee_status='Active' and session_value='$session1'";
$result = mysqli_query($conn73,$query2);
if(mysqli_num_rows($result)>0){
    $check="checked";
    $class="checked1";
}else{
    $check="disabled";
    $class="";
}

$serial_no++;
?>
  
<tr>
    <td><?php echo $serial_no; ?></td>
    <td><?php echo $student_name; ?></td>
    <td><?php echo $student_father_name; ?></td>
    <td><?php echo $student_class; ?></td>
    <td><?php echo $student_class_section; ?></td>
    <td><input type="checkbox"  name="student_data[]" class="<?php echo $class; ?>" value="<?php echo $student_roll_no; ?>" <?php echo $check; ?> ></td>
</tr>
<?php  } ?>
 	
    </tbody>
</table>
<!--<script>-->
<!--  $(function () {-->
<!--    $('#example3').DataTable()-->
<!--  })-->
<!--</script>-->