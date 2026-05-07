<?php include("../attachment/session.php"); ?>

<?php
$student_class_code=$_GET['class_name'];
$subject_type1=$_GET['subject_type'];
$group_name=$_GET['group_name'];
$stream_name=$_GET['stream_name'];

$student_class_code1=explode("_",$student_class_code);
$class_name=$student_class_code1[0];
$class_name_hindi=$student_class_code1[1];
$class_code=$student_class_code1[2];
$serial=0;
			    $que="select * from school_info_subjects where subject_type='$subject_type1' and (session_value='$session1' || session_value='')$filter37";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				while($row=mysqli_fetch_assoc($run)){
				$subject_name=$row['subject'];
				$subject_name_hindi=$row['subject_hindi'];
				$subject_code=$row['subject_code'];
				$subject_type=$row['subject_type'];
				if($subject_name!='' || $subject_name_hindi!=''){
				$que1="select * from school_info_subject_info where class='$class_name' and subject_name='$subject_name' and stream_name='$stream_name' and group_name='$group_name' and (session_value='$session1' || session_value='')$filter37";
				$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
                if(mysqli_num_rows($run1)>0){
				
				}else{
				$serial++;
				?>		
				<tr align='center'>				
				<th><?php echo $serial; ?></th>
				<th><?php echo $subject_name; ?></th>
				<th><?php echo $subject_name_hindi; ?></th>
				<th><button type="button" class="btn btn-success" onclick="add_subject('subject_name=<?php echo $subject_name; ?>&subject_name_hindi=<?php echo $subject_name_hindi; ?>&subject_type=<?php echo $subject_type1; ?>&subject_code=<?php echo $subject_code; ?>&class_name=<?php echo $student_class_code; ?>&group_name=<?php echo $group_name; ?>&stream_name=<?php echo $stream_name; ?>')">Add Subject</button></th>
	            </tr>
				<?php } } }
				 ?>
				 <script>
	   function add_subject(data){
        $.ajax({
            type: "POST",
            url: access_link+"school_info/class_wise_subject_insert.php?"+data,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				     post_content('school_info/class_wise_subject',res[2]);
			
            }
			}
         });
      }
</script>