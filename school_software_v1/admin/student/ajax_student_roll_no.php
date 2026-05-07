<?php include("../attachment/session.php"); ?>  
<table id="example3" class="table table-bordered table-striped">
<thead >
<tr>
  <th><?php echo $language['S No']; ?></th>
  <th><?php echo 'Adm. No.'; ?></th>
  <th><?php echo $language['Student Name']; ?></th>
  <th><?php echo $language['Father Name']; ?></th>
  <th><?php echo $language['Student Old Roll No']; ?></th>
  <th><?php echo $language['Generate New Roll No']; ?></th>
  
  <th>Update By</th>
  <th>Date</th>
  
</tr>
</thead>
<tbody>
<?php
$student_section=$_GET['student_section'];
if($student_section!='All'){
$condition=" and student_class_section='$student_section'";
}else{
$condition="";
}
$student_class=$_GET['id'];
$roll_no_generate_by=$_GET['roll_no_generate_by'];
$start_number=$_GET['start_number'];
if($start_number!=''){
  $start_number=$start_number;  
}else{
    $start_number=0;
}

$student_class_stream=$_GET['student_class_stream'];
if($student_class_stream!='All'){
$condition1=" and student_class_stream='$student_class_stream'";
}else{
$condition1="";
}

$student_admission_type=$_GET['student_admission_type'];
if($student_admission_type!='All'){
$condition2=" and student_admission_type='$student_admission_type'";
}else{
$condition2="";
}

$order_by=$_GET['order_by'];
$roll_no_array[]=0;
$query2="select * from student_admission_info where student_class='$student_class' and student_status='Active' and session_value='$session1'$condition$condition1$condition2 $filter37 ORDER BY student_name";
$serial_no1=0;
$res2=mysqli_query($conn73,$query2);
while($row2=mysqli_fetch_assoc($res2)){
$roll_no_array[$serial_no1]=$serial_no1+1;
$serial_no1++;
}

$query1="select * from student_admission_info where student_class='$student_class' and student_status='Active' and session_value='$session1'$condition$condition1$condition2 $filter37$order_by";
$serial_no=0;
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$s_no=$row1['s_no'];
$student_name=$row1['student_name'];
$student_father_name=$row1['student_father_name'];
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

<?php if($roll_no_generate_by=='Automatic'){ ?>    
<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $student_admission_number; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $student_father_name; ?></td>
<td><input type="hidden" placeholder="" name="student_roll_no[]" style="border:none;" value="<?php echo $student_roll_no; ?>" readonly ><input type="text" placeholder="" name="student_school_roll_no[]" style="border:none;" value="<?php echo $school_roll_no; ?>" readonly ></td>
<td><input type="text" placeholder="" name="school_roll_no[]" value="<?php echo $serial_no+$start_number; ?>" readonly ></td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>
</tr>
<?php }elseif($roll_no_generate_by=='Mannual'){ ?>
<tr>
<td><?php echo $serial_no; ?></td>
<td><?php echo $student_admission_number; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $student_father_name; ?></td>
<td><input type="hidden" placeholder="" name="student_roll_no[]" style="border:none;" value="<?php echo $student_roll_no; ?>" readonly ><input type="text" placeholder="" name="student_school_roll_no[]" style="border:none;" value="<?php echo $school_roll_no; ?>" readonly ></td>
<td><input type="text" placeholder="" name="school_roll_no[]" value="<?php echo $school_roll_no; ?>" ></td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>
</tr>
<?php } } ?>
</tbody>

</table>
<script>
//   $(function () {
//     $('#example3').DataTable()
//   })
</script>