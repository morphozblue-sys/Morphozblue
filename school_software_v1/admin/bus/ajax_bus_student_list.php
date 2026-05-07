<?php include("../attachment/session.php"); ?>
               <table id="example3" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th>#</th>
				  <th>Adm. No.</th>
				  <th>Student Name</th>
				  <th>Father Name</th>
				  <th>Student Class</th>
				  <th>Student Roll No</th>
				  <th>Pickup point</th>
				  <th>Bus No</th>
                  <th>Bus Route</th>
                </tr>
                </thead>
                <tbody>
                
				<?php		
$class_name=$_GET['id'];
if($class_name!=''){
$condition=" and student_class='$class_name'";
}else{
$condition="";
}				
                

                $que="select * from student_admission_info where student_bus='Yes' and student_status='Active' and session_value='$session1'$condition ORDER BY s_no DESC";
                $run=mysqli_query($conn73,$que);
                $serial_no=0;
                while($row=mysqli_fetch_assoc($run)){

				$s_no=$row['s_no'];
				$student_name=$row['student_name'];
				$student_father_name=$row['student_father_name'];
				$student_class=$row['student_class'];
				$student_date_of_birth=$row['student_date_of_birth'];
				$student_roll_no=$row['student_roll_no'];
				$school_roll_no=$row['school_roll_no'];
				$student_bus_no=$row['student_bus_no'];
				$student_bus_route=$row['student_bus_route'];
				$student_admission_number=$row['student_admission_number'];
				$student_bus_fee_category=$row['student_bus_fee_category'];
			    $serial_no++;
			    ?>

                <tr>
                  <td><?php echo $serial_no; ?><input type="hidden" name="student_roll_no[]" id="student_roll_no" value="<?php echo $student_roll_no; ?>" /></td>
                  <td><?php echo $student_admission_number; ?></td>
                  <td><?php echo $student_name; ?></td>
				  <td><?php echo $student_father_name; ?></td>
                  <td><?php echo $student_class; ?></td>
				  <td><?php echo $school_roll_no; ?></td>
				  <td><?php echo $student_bus_fee_category; ?></td>
				  <td><select name="student_bus_no[]" id="student_bus_no"  class="form-control" >
						       <option value="">Select Bus</option>
						       <?php 
							        
							     $que0="select * from bus_details";
                                 $run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73));
                                 while($row0=mysqli_fetch_assoc($run0)){
                                 $bus_name = $row0['bus_name']; 
                                 $bus_no = $row0['bus_no'];
                                 ?>
						       <option value="<?php echo $bus_no; ?>" <?php if($student_bus_no==$bus_no){ echo 'selected'; } ?> ><?php echo $bus_no.' / '.$bus_name; ?></option>
						    
					           <?php } ?>
					         </select>
				</td>
                  <td><select name="student_bus_route[]" id="student_bus_route"  class="form-control" >
						       <option value="">Select Route</option>
						       <?php 
							  $que1="select * from bus_stop_details GROUP BY bus_route";
                               $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
                                while($row1=mysqli_fetch_assoc($run1)){
                  	          $bus_route = $row1['bus_route']; ?>
						       <option value="<?php echo $bus_route; ?>" <?php if($student_bus_route==$bus_route){ echo 'selected'; } ?> ><?php echo $bus_route; ?></option>
					     <?php } ?>
					    </select></td>

                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9"><center><input type="submit" name="submit" value="Submit" class="btn btn-success"/></center></td>
                    </tr>
                </tfoot>
             </table>
