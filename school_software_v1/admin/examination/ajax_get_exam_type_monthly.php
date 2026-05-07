<?php include("../attachment/session.php");
?>
  <option value="">Select Exam Type</option>
<?php 
                    $class=$_GET['class_name'];
					   		
							
					 $query3="select * from school_info_class_info where class_name='$class'";
                    $res3=mysqli_query($conn73,$query3)or die(mysqli_error($conn73));
                    while($row3=mysqli_fetch_assoc($res3)){
					$class_code=$row3['class_code']; 
			}

                    $query="select * from school_info_exam_types_monthly where class_code='$class_code' and (session_value='$session1' || session_value='') $filter37";
                    $res=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
                    while($row=mysqli_fetch_assoc($res)){
                         $exam_type=$row['exam_type']; 
                               $exam_code=$row['exam_code']; 
							  if($exam_type!=''){
                               ?>
						       <option value="<?php echo $exam_code; ?>"><?php echo $exam_type; ?></option>
					     <?php } } ?>