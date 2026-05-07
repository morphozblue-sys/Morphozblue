<?php
include("../attachment/session.php");
$checked=$_GET['checked'];
$disabled='';
if($checked=='Yes'){
    $filter37='';
    $disabled='disabled';
}
?>  
<table id="example1" class="table table-bordered table-striped">
						<thead >
								<tr>
								  <th>#</th>
								  <th><?php echo $language['Student Name']; ?></th>
								  <th><?php echo $language['Father Name']; ?></th>
								  <th><?php echo $language['Class']; ?></th>
								  <th>Father Contact No.</th>
								  <th>student Age</th>
								  <th><?php echo $language['Student Roll No']; ?></th>
								  <th>Admission No</th>
                                <th>Update By</th>
                                <th>Date</th>
								 
								  <th><?php echo $language['Edit']; ?></th>
								  <th><?php echo $language['Delete']; ?></th>
								  <th><?php echo $language['Print']; ?></th>
								  <th>Scholar <?php echo $language['Print']; ?></th>
								</tr>
						</thead>
					<tbody>
					
						<?php
							$que="select * from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
	$admission_form_pdf = $row['admission_form_pdf'];
	$scholar_register_pdf=$row['scholar_register_pdf'];
    }	
  
				   $que="select * from student_admission_info where registration_final='yes' and student_status='Active' and session_value='$session1'$filter37  ORDER BY s_no DESC";
						$run=mysqli_query($conn73,$que);
						$serial_no=0;
						while($row=mysqli_fetch_assoc($run)){
						$s_no=$row['s_no'];
						$student_name=$row['student_name'];
						$student_father_name=$row['student_father_name'];
						$student_class=$row['student_class'];
						$student_class_section=$row['student_class_section'];
						$student_date_of_birth=$row['student_date_of_birth'];
						$student_roll_no=$row['student_roll_no'];
						$school_roll_no=$row['school_roll_no'];
						$student_date_of_admission=$row['student_date_of_admission'];
                        $student_father_contact_number=$row['student_father_contact_number'];
                        $student_admission_number=$row['student_admission_number'];
                        $student_age=$row['student_age'];
                        
                        $update_change=$row['update_change'];
                        if($row['last_updated_date']!='0000-00-00'){
                        $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                        }else{
                        $last_updated_date=$row['last_updated_date'];
                        }
                        // $student_medium=$row['student_medium'];
                        // $board=$row['board'];
                        // $shift=$row['shift'];
                        // $disabled='';
                        // if($student_medium!=$_SESSION['medium_change'] && $board!=$_SESSION['board_change'] && $shift!=$_SESSION['shift_change']){
                            
                        // }
						$serial_no++;
						?>
                        
						<tr>
    					  <td><?php echo $serial_no; ?></td>
    					  <td><?php echo $student_name; ?></td>
    					  <td><?php echo $student_father_name; ?></td>
    					  <td><?php echo $student_class."(".$student_class_section.")"; ?></td>
    					  <td><?php echo $student_father_contact_number; ?></td>
    					  <td><?php echo $student_age; ?></td>
    					  <td><?php echo $school_roll_no; ?></td>
    					  <td><?php echo $student_admission_number; ?></td>
    					  <td><?php echo $update_change; ?></td>
                          <td><?php echo $last_updated_date; ?></td>
						  
						<td><button type="button" onclick="post_content('student/student_admission','<?php echo 'student_roll_no='.$student_roll_no; ?>')" class="btn btn-success" <?php echo $disabled; ?> >
						<?php echo $language['Edit']; ?></button></td>
						<td><button type="button" onclick="return valid('<?php echo $s_no; ?>');" class="btn btn-success" <?php echo $disabled; ?> >
						<?php echo $language['Delete']; ?></button></td>
						<td><a href='<?php echo $pdf_path; ?>admission_form/<?php echo $admission_form_pdf; ?>?id=<?php echo $student_roll_no; ?>' target="_blank"><button type="button" class="btn btn-success" <?php echo $disabled; ?> >
						<?php echo $language['Print']; ?></button></a></td>
						<td><a href='<?php echo $pdf_path; ?>admission_form/<?php echo $scholar_register_pdf; ?>?id=<?php echo $student_roll_no; ?>' target="_blank"><button type="button" class="btn btn-success" <?php echo $disabled; ?> >
						<?php echo $language['Print']; ?></button></a></td>
						</tr>
						<?php } ?>
					</tbody>
				 </table>