  <?php include("../attachment/session.php")?>  

   <table id="example3" class="table table-bordered table-striped">
                <thead >
              <tr>
				  <th>#</th>
				  <th><?php echo $language['Student Name']; ?></th>
				  <th><?php echo $language['Father Name']; ?></th>
				  <th><?php echo $language['Class']; ?></th>
				  <th>Father Contact No.</th>
				  <th><?php echo $language['Registration Date']; ?></th>
                  <th>Remark</th>
                  
                  <th>Update By</th>
                  <th>Date</th>
                  
                 <th><?php echo $language['Make Admission']; ?></th>
                 <th><?php echo $language ['Print']; ?></th>
				  <th><?php echo $language['Delete']; ?></th>
                </tr>
                </thead>
                <tbody>
                
				<?php		
$class_name=$_GET['id'];
if($class_name=='All'){
$condition="";
}else{
$condition="and student_class='$class_name'";
}				
            
	$que="select * from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
	$registration_form_pdf = $row['registration_form_pdf'];
}	
                $que="select * from student_admission_info where registration_final='no' $condition and student_status='Deactive' and session_value='$session1' ORDER BY s_no DESC";
                $run=mysqli_query($conn73,$que);
                $serial_no=0;
                while($row=mysqli_fetch_assoc($run)){

						$s_no=$row['s_no'];
				$student_name=$row['student_name'];
				$student_father_name=$row['student_father_name'];
				$student_class=$row['student_class'];
				$student_date_of_birth=$row['student_date_of_birth'];
				$student_roll_no=$row['student_roll_no'];
				$student_father_contact_no=$row['student_father_contact_number'];
				$student_date_of_admission=$row['student_date_of_admission'];
		     	$student_remark_1=$row['student_remark_1'];
		     	$student_registration_fee=$row['student_registration_fee'];
		     	
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
				<td><?php echo $student_name; ?></td>
				<td><?php echo $student_father_name; ?></td>
				<td><?php echo $student_class; ?></td>
				<td><?php echo $student_father_contact_no; ?></td>
				<td><?php echo $student_date_of_admission; ?></td>
				<td><?php echo $student_remark_1; ?></td>
				
                <td><?php echo $update_change; ?></td>
                <td><?php echo $last_updated_date; ?></td>

                <td><button type="button" onclick="post_content('student/student_admission','<?php echo 'student_roll_no='.$student_roll_no; ?>')" class="btn btn-success">
                <?php echo $language['Make Admission']; ?></button></td>
				<td><a href='<?php echo $pdf_path; ?>registration_form/<?php echo $registration_form_pdf; ?>?id=<?php echo $student_roll_no; ?>' target="_blank"><button type="button" class="btn btn-success"><?php echo $language['Print']; ?></button></a></td>
				<td><button type="button" onclick="return valid('<?php echo $student_roll_no; ?>','<?php echo $student_date_of_admission; ?>','<?php echo $student_registration_fee; ?>')" class="btn btn-success">
                <?php echo $language['Delete']; ?></button></td>
                </tr>
                <?php } ?>
                </tbody>
             </table>
				<script>
  $(function () {
    $('#example3').DataTable()
  })
</script>