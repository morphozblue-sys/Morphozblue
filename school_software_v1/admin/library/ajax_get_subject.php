<?php
                    $class=$_GET['value'];
					include("../../con73/con37.php");
                    $query="select * from school_info_subject_info where class='$class'";
                    $res=mysqli_query($conn73,$query);
                    while($row=mysqli_fetch_assoc($res)){
                    $subject_name=$row['subject_name'];
					$subject_code=$row['subject_code'];

?>
					<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>
					
					 <?php } ?>