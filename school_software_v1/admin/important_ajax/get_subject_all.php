<?php include("../attachment/session.php");
                     $class_name=$_GET['class_name'];
                    $class_group=$_GET['class_group'];
                   $class_stream=$_GET['class_stream'];
		$cond1="";
		$cond2="";
		if($class_name=='11TH' ||$class_name=='12TH'){
                if($class_stream!='All' && $class_stream!=''){
		              $cond1= " and stream_name='$class_stream'";
	     	     }
	    if($class_group!='All' && $class_group!=''){
		              $cond2= " and group_name='$class_group'";
	     	     }
		  
		        }
           $query="select * from school_info_subject_info where   class='$class_name' $cond1$cond2 and session_value='$session1' $filter37 group by subject_code";
                    $res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
                      ?> 
                        <option value="">All</option><?php
                    while($row=mysqli_fetch_assoc($res)){
                    $subject_name=$row['subject_name'];
					$subject_code=$row['subject_code'];
?>					<option value="<?php echo $subject_name; ?>"><?php echo $subject_name; ?></option>

				<?php	}  ?>