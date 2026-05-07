<?php include("../attachment/session.php"); ?>
<?php
$emp_id=$_GET['emp_id'];
if($emp_id!='All'){
    $condition=" and emp_id='$emp_id'";
}else{
    $condition="";
}

			 	$que="select * from employee_info where emp_status='Active'$condition";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$emp_name=$row['emp_name'];
				$emp_mobile=$row['emp_mobile'];
				$emp_designation=$row['emp_designation'];
				$emp_id=$row['emp_id'];
				
                $update_change=$row['update_change'];
                if($row['last_updated_date']!='0000-00-00'){
                $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                }else{
                $last_updated_date=$row['last_updated_date'];
                }
			
			$serial_no++;
			$emp_photo ='';
			    $emp_photo = $row['emp_photo'];
	
	$que2="select * from  school_info_pdf_info ";
	$run2=mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
	while($row2=mysqli_fetch_assoc($run2)){
	$joining_letter=$row2['joining_letter'];
	    
	}
	?>
                <tr>
                <td ><?php echo $serial_no; ?></td>
				<td><?php echo $emp_name; ?></td>
				<td> <img onclick="open_file1('emp_photo','<?php echo $emp_id; ?>');" src="<?php if($emp_photo!=''){ echo 'data:image;base64,'.$emp_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50" style="margin-top:10px;"></td>
				<td><?php echo $emp_mobile; ?></td>
				<td><?php echo $emp_designation; ?></td>
				
                <td><?php echo $update_change; ?></td>
                <td><?php echo $last_updated_date; ?></td>
				
				<td><button type="button"  onclick="post_content('staff/employee_edit','<?php echo 's_no='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['Edit']; ?></button></td>
				<td><button type="button"  class="btn btn-warning" onclick="return for_drop('<?php echo $s_no; ?>');" >Drop - Emp</button></td>
				<td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
			    <td><a  href='<?php echo $pdf_path; ?>joining_letter/<?php echo $joining_letter; ?>?emp_id=<?php echo $emp_id; ?>'><button type="button" class="btn btn-success"><?php echo $language['Print']; ?></button></a></td>
			
				</tr>
				<?php } ?>