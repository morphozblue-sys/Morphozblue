<?php include("../attachment/session.php");?>
                <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Father Name']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
				  <th><?php echo $language['View Marksheet']; ?></th>
				   <?php if($_SESSION['software_link']=='lempongphom'){ ?>
                   <td>Terminal</td> 
                   <td>Half Yearly</td> 
                   <?php } ?>
				  <th><?php echo $language['Final Marksheet']; ?></th>
				  <?php if($_SESSION['software_link']=='eps'){ ?>
				  <th>View Marksheet Subjectwise</th>
				  <th>Final Marksheet Subjectwise</th>
				  <?php } ?>
				  <th>Update By</th>
                  <th>Date</th>
				  
                </tr>
                </thead>
				
				<tbody >
<?php 				    

$student_class=$_GET['id'];
$student_section=$_GET['student_section'];
if($student_section!='All'){
 $sec_condition=" and student_class_section='$student_section'";
}else{
 $sec_condition="";
}
$exam_type=$_GET['student_exam_type'];
$student_class_stream=$_GET['student_class_stream'];
$student_class_group=$_GET['student_class_group'];

$que321="select * from school_info_pdf_info";
$run321=mysqli_query($conn73,$que321);
while($row321=mysqli_fetch_assoc($run321)){

$marksheet_final_pdf = $row321['marksheet_final_pdf'];
$marksheet_exam_wise_pdf = $row321['marksheet_exam_wise_pdf'];
}
$marksheet_pdf1 = "marksheet_terminal_phom.php";
$marksheet_pdf2 = "marksheet_half_yearly_phom.php";
if($_SESSION['software_link']=='eps'){
$marksheet_pdf1 = "marksheet_examwise_eps_balistan_subjectwise.php";
$marksheet_pdf2 = "marksheet_examwise_eps_balistan_all_subjectwise.php";    
}    
$query1="select * from student_admission_info where student_class='$student_class' and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$sec_condition$filter37 order by student_name ASC";
$res=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));;
$serial_no=0;
while($row=mysqli_fetch_assoc($res)){
$student_name=$row['student_name'];
$student_father_name=$row['student_father_name'];
$student_roll_no=$row['student_roll_no'];
$school_roll_no=$row['school_roll_no'];

$update_change=$row['update_change'];
if($row['last_updated_date']!='0000-00-00'){
$last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
}else{
$last_updated_date=$row['last_updated_date'];
}

$serial_no++;
?>

<tr>
<td><?php echo $serial_no; ?></td>
<td>
<input type="hidden" name="students_name[]" value="<?php echo $student_name; ?>" readonly />
<?php echo $student_name; ?>
</td>
<td>
<input type="hidden" name="student_father_name[]" value="<?php echo $student_father_name; ?>" readonly />
<?php echo $student_father_name; ?>
</td>
<td>
<input type="hidden" name="roll_no[]" value="<?php echo $student_roll_no; ?>" readonly />
<?php echo $school_roll_no; ?>
</td>
<td><a target="_blank" href="<?php echo $pdf_path; ?>marksheet_page/<?php echo $marksheet_exam_wise_pdf; ?>?class=<?php echo $student_class; ?>&roll_no=<?php echo $student_roll_no; ?>&exam_type=<?php echo $exam_type; ?>&student_class_group=<?php echo $student_class_group; ?>&student_class_stream=<?php echo $student_class_stream; ?>&session1=<?php echo $session1; ?>">View Marksheet</a></td>
 <?php if($_SESSION['software_link']=='lempongphom'){ ?>
   <td> <a target="_blank" href="<?php echo $pdf_path; ?>marksheet_page/<?php echo $marksheet_pdf1; ?>?class=<?php echo $student_class; ?>&roll_no=<?php echo $student_roll_no; ?>&student_class_group=<?php echo $student_class_group; ?>&student_class_stream=<?php echo $student_class_stream; ?>&session1=<?php echo $session1; ?>" >Terminal</a>
   </td><td> <a target="_blank" href="<?php echo $pdf_path; ?>marksheet_page/<?php echo $marksheet_pdf2; ?>?class=<?php echo $student_class; ?>&roll_no=<?php echo $student_roll_no; ?>&student_class_group=<?php echo $student_class_group; ?>&student_class_stream=<?php echo $student_class_stream; ?>&session1=<?php echo $session1; ?>" >Half Yearly</a>
   </td>
    <?php } ?>

<td><a target="_blank" href="<?php echo $pdf_path; ?>marksheet_page/<?php echo $marksheet_final_pdf; ?>?class=<?php echo $student_class; ?>&roll_no=<?php echo $student_roll_no; ?>&student_class_group=<?php echo $student_class_group; ?>&student_class_stream=<?php echo $student_class_stream; ?>&session1=<?php echo $session1; ?>" >View FinalMarksheet</a></td>
    <?php if($_SESSION['software_link']=='eps'){ ?>
   <td><a target="_blank" href="<?php echo $pdf_path; ?>marksheet_page/<?php echo $marksheet_pdf1; ?>?class=<?php echo $student_class; ?>&roll_no=<?php echo $student_roll_no; ?>&exam_type=<?php echo $exam_type; ?>&student_class_group=<?php echo $student_class_group; ?>&student_class_stream=<?php echo $student_class_stream; ?>&session1=<?php echo $session1; ?>">View Marksheet Subjectwise</a>
   </td><td><a target="_blank" href="<?php echo $pdf_path; ?>marksheet_page/<?php echo $marksheet_pdf2; ?>?class=<?php echo $student_class; ?>&roll_no=<?php echo $student_roll_no; ?>&student_class_group=<?php echo $student_class_group; ?>&student_class_stream=<?php echo $student_class_stream; ?>&session1=<?php echo $session1; ?>" >Final Marksheet Subjectwise</a>
   </td>
    <?php } ?>
<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>

</tr>
<?php
}

?>
     
		        </tbody>
				
                </table>
<script>
$(function() {
$('#example1').DataTable()
})
</script>