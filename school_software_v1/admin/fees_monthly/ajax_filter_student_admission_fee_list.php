<?php include("../attachment/session.php"); ?>  

<table id="example2" class="table table-bordered table-striped">
						<thead class="my_background_color">
								<tr>
								  <th>#</th>
								  <th>Admission No.sdfsd</th>
								  <th><?php echo $language['Student Name']; ?></th>
								  <th><?php echo $language['Father Name']; ?></th>
								  <th><?php echo $language['Class']; ?></th>
								  <th><?php echo $language['Student Section']; ?></th>
								  <th><?php echo $language['Student Roll No']; ?></th>
								  
								  <th>Update By</th>
                                  <th>Date</th>
								  
								  <th>Reset Fee</th>
								  <th>Fee Status</th>
								  <th><?php echo $language['Set Fee']; ?></th>
								</tr>
						</thead>
					<tbody >
	<?php
	$gender=$_GET['gender'];
	$religion=$_GET['religion'];
	$caste=$_GET['caste'];
	$age=$_GET['age'];
	$scheme=$_GET['scheme'];
	$type=$_GET['type'];
	$class=$_GET['student_class'];
	$section=$_GET['student_class_section'];
	$sort_by=$_GET['sort_by'];
	$student_class_group=$_GET['student_class_group'];
	$student_class_stream=$_GET['student_class_stream'];
	$bus_fee_category_name=$_GET['bus_fee_category_name'];
	
	$current_date= date('Y-m-d');
	$current_date_d= date('d');
	$current_date_m= date('m');
	$current_date_y= date("Y");
	$student_age=$current_date_y-$age;
	$student_dob=$student_age.'-'.$current_date_m.'-'.$current_date_d;
	
	if($gender=='Both'){
	$condition="";
	}else{
	$condition=" and student_gender='$gender'";
	}


	if($religion=='All'){
	$condition1="";
	}else{
	$condition1=" and student_religion='$religion'";
	}
	
	if($caste=='All'){
	$condition2="";
	}else{
	$condition2=" and student_category='$caste'";
	}
	
	if($age==0){
	$condition3="";
	}else{
	$condition3=" and student_date_of_birth >='$student_dob'";
	}
	
	if($scheme=='All'){
	$condition4="";
	}else{
	$condition4=" and student_admission_scheme='$scheme'";
	}
	
	if($type=='All'){
	$condition5="";
	}else{
	$condition5=" and student_admission_type='$type'";
	}
	
	if($class=='All'){
	$condition6="";
	}else{
	$condition6=" and student_class='$class'";
	}
	if($section=='All' || $section==''){
	$condition7="";
	}else{
	$condition7=" and student_class_section='$section'";
	}
	$condition8="";
	$condition9="";
	if($class=="11TH" || $class=="12TH" ){
		if($student_class_group=='All'){
	$condition8="";
	}else{
	$condition8=" and student_class_group='$student_class_group'";
	}
	if($student_class_stream=='All'){
	$condition9="";
	}else{
	$condition9=" and student_class_stream='$student_class_stream'";
	}
	}
	
	if($bus_fee_category_name=='All'){
	$condition10="";
	}else{
	$condition10=" and student_bus_fee_category_code='$bus_fee_category_name'";
	}
	
	if($sort_by=='none'){
	$sort_by1="s_no";
	}else{
	$sort_by1=$sort_by;
	}
	
	$que="select * from student_admission_info where registration_final='yes' and student_status='Active' and session_value='$session1' $condition$condition1$condition8$condition9$condition10$condition2$condition3$condition4$condition5$condition6$condition7$filter37  ORDER BY $sort_by1 ASC";
	$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
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
	$student_admission_number=$row['student_admission_number'];
	
	$que1="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and fee_status='Active' and session_value='$session1'";
	$run1=mysqli_query($conn73,$que1);
	if(mysqli_num_rows($run1)>0){
	$student_fee_status="<b style='color:blue;'>Set</b>";
	}else{
	$student_fee_status="<b style='color:red;'>Not Set</b>";
	}
	
    $row1=mysqli_fetch_assoc($run1);
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
	  <td><?php echo $student_name; ?></td>
	  <td><?php echo $student_father_name; ?></td>
	  <td><?php echo $student_class; ?></td>
	  <td><?php echo $student_class_section; ?></td>
	  <td><?php echo $school_roll_no; ?></td>
	  
      <td><?php echo $update_change; ?></td>
      <td><?php echo $last_updated_date; ?></td>
	  
	  <td><button type="button" value="Reset Fee" onclick="reset_fee1('<?php echo $student_roll_no; ?>');" class="btn  my_background_color" >Reset Fee</button></td>
	  <td><?php echo $student_fee_status; ?></td>
	  
	  <td><button type="button"  onclick="post_content('fees_monthly/set_fee_details','<?php echo 'student_roll_no='.$student_roll_no; ?>')" class="btn btn-default my_background_color" >Set Fee</button></td>
	</tr>
	<?php } ?>
	</tbody>
	</table>
	
<script>
  $(function () {
    $('#example2').DataTable()
  })
</script>