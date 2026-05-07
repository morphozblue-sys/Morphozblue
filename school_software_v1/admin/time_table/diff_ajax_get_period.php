<?php include("../attachment/session.php");
$class_name=$_GET['class'];
$section=$_GET['section'];
$student_class_group=$_GET['student_class_group'];
$student_class_stream=$_GET['student_class_stream'];
$query = "select  class_code,period_code FROM school_info_class_period";
if(!mysqli_query($conn73,$query)) { 
   echo $alter = "ALTER TABLE `school_info_class_period` ADD `class_code` VARCHAR(20) NOT NULL AFTER `s_no`, ADD `period_code` VARCHAR(20) NOT NULL AFTER `class_code`;"; 
   mysqli_query($conn73,$alter) or die(mysqli_error($conn73));
}
					$que="select * from school_info_class_period where class_code='$class_name'";
					$run=mysqli_query($conn73,$que);
								if(mysqli_num_rows($run)<1){
					 	$que12="select * from school_info_class_period where class_code=''";
					$run12=mysqli_query($conn73,$que12);
					$x=0;
						while($row12=mysqli_fetch_assoc($run12)){
						    $period_name1=$row12['period_name'];
	                $period_start_time1 = $row12['period_start_time'];
					$period_end_time1 = $row12['period_end_time'];
					$x++;
					$period_code='period'.$x;
					      $insert_q="insert into school_info_class_period (class_code,period_code,period_name,period_start_time,period_end_time)values('$class_name','$period_code','$period_name1','$period_start_time1','$period_start_time1')";
					       mysqli_query($conn73,$insert_q);
						    
						}
							$run=mysqli_query($conn73,$que);
					}
					$serial_no=0;
					$add_more_button=0;
					while($row=mysqli_fetch_assoc($run)){
					$period_name1=$row['period_name'];
	                $period_start_time1 = $row['period_start_time'];
					$period_end_time1 = $row['period_end_time'];
						$period_code1=$row['period_code'];
					if($period_name1!=''){
					$period_coloum_subject_monday=$period_code1."_subject_monday";
					$period_coloum_teacher_monday=$period_code1."_teacher_monday";
					$period_coloum_subject_tuesday=$period_code1."_subject_tuesday";
					$period_coloum_teacher_tuesday=$period_code1."_teacher_tuesday";
					$period_coloum_subject_wednesday=$period_code1."_subject_wednesday";
					$period_coloum_teacher_wednesday=$period_code1."_teacher_wednesday";
					$period_coloum_subject_thursday=$period_code1."_subject_thursday";
					$period_coloum_teacher_thursday=$period_code1."_teacher_thursday";
					$period_coloum_subject_friday=$period_code1."_subject_friday";
					$period_coloum_teacher_friday=$period_code1."_teacher_friday";
					$period_coloum_subject_saturday=$period_code1."_subject_saturday";
					$period_coloum_teacher_saturday=$period_code1."_teacher_saturday";
				 	$que1="select * from class_time_table where class_code='$class_name' and section='$section'  and group_name='$student_class_group' and stream_code='$student_class_stream'";
					$run1=mysqli_query($conn73,$que1);
					if(mysqli_num_rows($run1)<1){
						$que2="select * from school_info_class_info where class_code='$class_name'";
					$run2=mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
					while($row2=mysqli_fetch_assoc($run2)){
					$class_name1=$row2['class_name'];
					
					}
					$query1="insert into class_time_table(class,class_code,section,group_name,stream_code)values('$class_name1','$class_name','$section','$student_class_group','$student_class_stream')";
					mysqli_query($conn73,$query1);
						$run1=mysqli_query($conn73,$que1);
					}
					while($row1=mysqli_fetch_assoc($run1)){
					$period_coloum_subject_monday1=$row1[$period_coloum_subject_monday];
					$period_coloum_teacher_monday1=$row1[$period_coloum_teacher_monday];
					$period_coloum_subject_tuesday1=$row1[$period_coloum_subject_tuesday];
					$period_coloum_teacher_tuesday1=$row1[$period_coloum_teacher_tuesday];
					$period_coloum_subject_wednesday1=$row1[$period_coloum_subject_wednesday];
					$period_coloum_teacher_wednesday1=$row1[$period_coloum_teacher_wednesday];
					$period_coloum_subject_thursday1=$row1[$period_coloum_subject_thursday];
					$period_coloum_teacher_thursday1=$row1[$period_coloum_teacher_thursday];
					$period_coloum_subject_friday1=$row1[$period_coloum_subject_friday];
					$period_coloum_teacher_friday1=$row1[$period_coloum_teacher_friday];
					$period_coloum_subject_saturday1=$row1[$period_coloum_subject_saturday];
					$period_coloum_teacher_saturday1=$row1[$period_coloum_teacher_saturday];
					
                    $update_change=$row1['update_change'];
                    if($row1['last_updated_date']!='0000-00-00'){
                    $last_updated_date=date('d-m-Y',strtotime($row1['last_updated_date']));
                    }else{
                    $last_updated_date=$row1['last_updated_date'];
                    }
					
					}
					$serial_no++;
					?>

<tr >
    	
<td>
<input type="text" name="period_name1[]"  value="<?php echo strtoupper($period_name1); ?>" style="border:none"   readonly/>
<input type="hidden" name="period_code1[]"  value="<?php echo $period_code1; ?>" style="border:none"   readonly/>
</td>

<td><input type="time" name="period_start_time1[]"  value="<?php echo $period_start_time1; ?>"></td>
<td><input type="time" name="period_end_time1[]"  value="<?php echo $period_end_time1; ?>"></td>

<td> <select name="subject_name_monday[]" class="select2" id='<?php echo "subject_name_monday_".$serial_no ?>' onchange="fill_subject_name('<?php echo $serial_no; ?>');" style="width:100%">
                    <?php if($period_coloum_subject_monday1==''){ ?>
					  <option value=""> </option>
				
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_subject_monday1; ?>"><?php echo $period_coloum_subject_monday1; ?></option>
					        <?php }
							
					 $query61="select * from school_info_subject_info where stream_code='$student_class_stream' and group_name='$student_class_group' and class_code='$class_name' and session_value='$session1'";
                    $res61=mysqli_query($conn73,$query61) or die(mysqli_error($conn73));
                    while($row61=mysqli_fetch_assoc($res61)){
                    $subject_name=$row61['subject_name'];
			
					?>
					<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>
<td><select name="teacher_name_monday[]" class="select2" onchange="fill_teacher_name(<?php echo $serial_no; ?>);" id="<?php echo "teacher_name_monday_".$serial_no ?>"  style="width:100%">
                    <?php if($period_coloum_teacher_monday1==''){ ?>
					  <option value=""> </option>
					
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_teacher_monday1; ?>"><?php echo $period_coloum_teacher_monday1; ?></option>
					        <?php }
							$qry="select * from employee_info where emp_categories='Teaching' and emp_status='Active'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_id=$row22['emp_id'];
							$emp_name=$row22['emp_name'];
							?>
							<option value="<?php echo $emp_name; ?>"><?php echo $emp_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>
<td> <select name="subject_name_tuesday[]" class="select2" id='<?php echo "subject_name_tuesday_".$serial_no ?>'  style="width:100%">
                    <?php if($period_coloum_subject_tuesday1==''){ ?>
					  <option value=""> </option>
				
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_subject_tuesday1; ?>"><?php echo $period_coloum_subject_tuesday1; ?></option>
					        <?php }
					 $query61="select * from school_info_subject_info where stream_code='$student_class_stream' and group_name='$student_class_group' and class_code='$class_name' and session_value='$session1'";
                    $res61=mysqli_query($conn73,$query61) or die(mysqli_error($conn73));
                    while($row61=mysqli_fetch_assoc($res61)){
                    $subject_name=$row61['subject_name'];
			
					?>
					<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>
<td> <select name="teacher_name_tuesday[]" class="select2" id="<?php echo "teacher_name_tuesday_".$serial_no ?>"  style="width:100%">
                       <?php if($period_coloum_teacher_tuesday1==''){ ?>
					  <option value=""> </option>
					
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_teacher_tuesday1; ?>"><?php echo $period_coloum_teacher_tuesday1; ?></option>
					        <?php }
							
							$qry="select * from employee_info";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_id=$row22['emp_id'];
							$emp_name=$row22['emp_name'];
							?>
							<option value="<?php echo $emp_name; ?>"><?php echo $emp_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>

<td> <select name="subject_name_wednesday[]" class="select2" id='<?php echo "subject_name_wednesday_".$serial_no ?>'  style="width:100%">
                    <?php if($period_coloum_subject_wednesday1==''){ ?>
					  <option value=""> </option>
				
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_subject_wednesday1; ?>"><?php echo $period_coloum_subject_wednesday1; ?></option>
					        <?php }
							
					 $query61="select * from school_info_subject_info where stream_code='$student_class_stream' and group_name='$student_class_group' and class_code='$class_name' and session_value='$session1'";
                    $res61=mysqli_query($conn73,$query61) or die(mysqli_error($conn73));
                    while($row61=mysqli_fetch_assoc($res61)){
                    $subject_name=$row61['subject_name'];
			
					?>
					<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>
<td> <select name="teacher_name_wednesday[]" class="select2" id='<?php echo "teacher_name_wednesday_".$serial_no ?>'  style="width:100%">
                    <?php if($period_coloum_teacher_wednesday1==''){ ?>
					  <option value=""> </option>
					
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_teacher_wednesday1; ?>"><?php echo $period_coloum_teacher_wednesday1; ?></option>
					        <?php }
							
							$qry="select * from employee_info";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_id=$row22['emp_id'];
							$emp_name=$row22['emp_name'];
							?>
							<option value="<?php echo $emp_name; ?>"><?php echo $emp_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>

<td> <select name="subject_name_thursday[]" class="select2" id='<?php echo "subject_name_thursday_".$serial_no ?>'  style="width:100%">
                    <?php if($period_coloum_subject_thursday1==''){ ?>
					  <option value=""> </option>
				
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_subject_thursday1; ?>"><?php echo $period_coloum_subject_thursday1; ?></option>
					        <?php }
							
					 $query61="select * from school_info_subject_info where stream_code='$student_class_stream' and group_name='$student_class_group' and class_code='$class_name' and session_value='$session1'";
                    $res61=mysqli_query($conn73,$query61) or die(mysqli_error($conn73));
                    while($row61=mysqli_fetch_assoc($res61)){
                    $subject_name=$row61['subject_name'];
			
					?>
					<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>
<td> <select name="teacher_name_thursday[]" class="select2"  id='<?php echo "teacher_name_thursday_".$serial_no ?>'  style="width:100%">
                    <?php if($period_coloum_teacher_thursday1==''){ ?>
					  <option value=""> </option>
					 
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_teacher_thursday1; ?>"><?php echo $period_coloum_teacher_thursday1; ?></option>
					        <?php }
							
							$qry="select * from employee_info";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_id=$row22['emp_id'];
							$emp_name=$row22['emp_name'];
							?>
							<option value="<?php echo $emp_name; ?>"><?php echo $emp_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>

<td> <select name="subject_name_friday[]" class="select2" id='<?php echo "subject_name_friday_".$serial_no ?>'  style="width:100%">
                    <?php if($period_coloum_subject_friday1==''){ ?>
					  <option value=""> </option>
				
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_subject_friday1; ?>"><?php echo $period_coloum_subject_friday1; ?></option>
					        <?php }
							
					 $query61="select * from school_info_subject_info where stream_code='$student_class_stream' and group_name='$student_class_group' and class_code='$class_name' and session_value='$session1'";
                    $res61=mysqli_query($conn73,$query61) or die(mysqli_error($conn73));
                    while($row61=mysqli_fetch_assoc($res61)){
                    $subject_name=$row61['subject_name'];
			
					?>
					<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>
<td> <select name="teacher_name_friday[]" class="select2"  id='<?php echo "teacher_name_friday_".$serial_no ?>'  style="width:100%">
                    <?php if($period_coloum_teacher_friday1==''){ ?>
					  <option value=""> </option>
					
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_teacher_friday1; ?>"><?php echo $period_coloum_teacher_friday1; ?></option>
					        <?php }
							
							$qry="select * from employee_info";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_id=$row22['emp_id'];
							$emp_name=$row22['emp_name'];
							?>
							<option value="<?php echo $emp_name; ?>"><?php echo $emp_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>


<td> <select name="subject_name_saturday[]" class="select2" id='<?php echo "subject_name_saturday_".$serial_no ?>'  style="width:100%">
                    <?php if($period_coloum_subject_saturday1==''){ ?>
					  <option value=""> </option>
				
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_subject_saturday1; ?>"><?php echo $period_coloum_subject_saturday1; ?></option>
					        <?php }
					 $query61="select * from school_info_subject_info where stream_code='$student_class_stream' and group_name='$student_class_group' and class_code='$class_name' and session_value='$session1'";
                    $res61=mysqli_query($conn73,$query61) or die(mysqli_error($conn73));
                    while($row61=mysqli_fetch_assoc($res61)){
                    $subject_name=$row61['subject_name'];
			
					?>
					<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>
<td> <select name="teacher_name_saturday[]" class="select2" id='<?php echo "teacher_name_saturday_".$serial_no ?>'  style="width:100%">
                    <?php if($period_coloum_teacher_saturday1==''){ ?>
					  <option value=""></option>
				
					  <?php }else{ ?>
					   <option value="<?php echo $period_coloum_teacher_saturday1; ?>"><?php echo $period_coloum_teacher_saturday1; ?></option>
					        <?php }
							
							$qry="select * from employee_info";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_id=$row22['emp_id'];
							$emp_name=$row22['emp_name'];
							?>
							<option value="<?php echo $emp_name; ?>"><?php echo $emp_name; ?></option>
							<?php
							}
							?>
							 <option value="---">---</option>
	</select>
</td>


<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>

</tr>
<?php } }
?>
 	<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>