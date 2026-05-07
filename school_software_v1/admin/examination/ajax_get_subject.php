<?php include("../attachment/session.php");
                     $class=$_GET['value'];
                    $student_class_group=$_GET['student_class_group'];
                   $student_class_stream=$_GET['student_class_stream'];
		
					
				

                     $query="select * from school_info_subject_info where stream_name='$student_class_stream' and group_name='$student_class_group' and class='$class' and (session_value='$session1' || session_value='') $filter37";
                    $res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
                    while($row=mysqli_fetch_assoc($res)){
                    $subject_name=$row['subject_name'];
					$subject_code=$row['subject_code'];
?>					<option value="<?php echo $subject_code; ?>"><?php echo $subject_name; ?></option>

				<?php	}  ?>