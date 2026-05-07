<?php include("../attachment/session.php");
?>           
                <table id="example5" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>#</th>
                  <th>Student Name</th>
                  <th>Class</th>
				  <th>User Id</th>
				  <th>Password</th>
                </tr>
                </thead>
              
				<tbody id="">
				<?php
				$class_name=$_GET['class_name'];
				$class_section=$_GET['class_section'];
				$student_class_stream=$_GET['student_class_stream'];
				$student_class_group=$_GET['student_class_group'];
				
	
		$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_class_section='$class_section' and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and session_value='$session1'  order by student_name ASC";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;
				$month_wise='';
				while($row=mysqli_fetch_assoc($run)){
					$s_no=$row['s_no'];
					$unique_id = $row['student_roll_no'];
					$school_roll_no = $row['school_roll_no'];
					$student_name = $row['student_name'];
					$student_class=$row['student_class'];
					$student_class_section=$row['student_class_section'];
					$student_password=$row['student_password'];

					$serial_no++;
					
				?>
				
                <tr>
                  <td><input type="text" value="<?php echo $serial_no; ?>" style="border:none;width:10px;"  name="student_serial_no[]" readonly></td>
                  <td><?php echo $student_name; ?></td>
				  <td><input type="text" value="<?php echo $student_class; ?>" name="student_class" readonly></td>
				  <td><input type="text" value="<?php echo $unique_id; ?>" name="unique_id[]" readonly></td>
                  <td><input type="text" value="<?php echo $student_password; ?>" name="password[]"></td>
                </tr>
				<?php } ?>
			   </tbody>
               </table>
			   </br>
			  
		  
	   
<script>
$(function () {
$('#example5').DataTable()
})
</script>		