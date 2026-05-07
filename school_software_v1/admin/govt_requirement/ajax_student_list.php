<?php include("../attachment/session.php"); ?>  

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
 echo $student_class_section=$_GET['student_class_section1'];
 $religion=$_GET['religion']; 
 $gender=$_GET['gender']; 
 $categories=$_GET['categories']; 
 $regular=$_GET['regular']; 
 $handicapped=$_GET['handicapped']; 
 $govt=$_GET['govt'];
 
 if($govt!=''){
 $condition7=" and student_admission_scheme='$govt'";
 }else{
 $condition7="";
 }   
 if($handicapped!=''){
 $condition6=" and student_handicapped='$handicapped'";
 }else{
 $condition6="";
 }    
 if($regular!=''){
 $condition5=" and student_admission_type='$regular'";
 }else{
 $condition5="";
 } 
 if($categories!=''){
 $condition4=" and student_category='$categories'";
 }else{
 $condition4="";
 }
   if($gender!=''){
 $condition3=" and student_gender='$gender'";
 }else{
 $condition3="";
 }
 if($religion!=''){
  $condition=" and student_religion='$religion'";
 }else{
 $condition="";
 }
 if($student_class!='All'){
 $condition1=" and student_class='$student_class'";
 }else{
 $condition1="";
 }
 
 if($student_class_section!='All'){
 $condition2=" and student_class_section='$student_class_section'";
 }else{
 $condition2="";
 }
 


$query1="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition$condition1$condition2$condition3$condition4$condition5$condition6$condition7";

$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
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