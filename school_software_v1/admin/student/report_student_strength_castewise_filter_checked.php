<?php
include("../attachment/session.php");
$checked=$_GET['checked'];
$disabled='';
if($checked=='Yes'){
    $filter37='';
    $disabled='disabled';
}
?>  
              <table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
                <thead >
                <tr>
				  <th rowspan="2">Serial No</th>
				  <th rowspan="2"><?php echo $language['Class']; ?></th>
				  <th rowspan="2"><?php echo $language['Total Students']; ?></th>
				  <th rowspan="2"><?php echo $language['Total Boys']; ?></th>
				  <th rowspan="2"><?php echo $language['Total Girls']; ?></th>
				  <th colspan="3"><?php echo $language['Total Gen']; ?></th>
				  <th colspan="3"><?php echo $language['Total Obc']; ?></th>
				  <th colspan="3"><?php echo $language['Total SC']; ?></th>
				  <th colspan="3"><?php echo $language['Total ST']; ?></th>
				  <th colspan="3"><?php echo $language['Total Other']; ?></th>				  
                </tr>
    				<tr>
                        <th>Boy</th>
                        <th>Girl</th>
                        <th>Total</th>
                        <th>Boy</th>
                        <th>Girl</th>
                        <th>Total</th>
                        <th>Boy</th>
                        <th>Girl</th>
                        <th>Total</th>
                        <th>Boy</th>
                        <th>Girl</th>
                        <th>Total</th>
                        <th>Boy</th>
                        <th>Girl</th>
                        <th>Total</th>				  
                    </tr>
                </thead>
                <tbody>
				
	
				
			
				
			
                
				<?php				
                    $total_total_student_class_wise=0;
                    $total_student_male_total=0;
                    $total_student_female_total=0;
                    $total_general_student_total_male=0;
                    $total_general_student_total_female=0;
                    $total_general_student_total=0;
                    $total_obc_student_total_male=0;
                    $total_obc_student_total_female=0;
                    $total_obc_student_total=0;
                    $total_sc_student_total_male=0;
                    $total_sc_student_total_female=0;
                    $total_sc_student_total=0;
                    $total_st_student_total_male=0;
                    $total_st_student_total_female=0;
                    $total_st_student_total=0;
                    $total_other_student_total_male=0;
                    $total_other_student_total_female=0;
                    $total_other_student_total=0;
                    $que123="select * from school_info_class_info order by s_no";
                    $run123=mysqli_query($conn73,$que123);
                    $serial_no=0;
				while($row123=mysqli_fetch_assoc($run123)){
				$class_name=$row123['class_name'];
                $serial_no++;
				
				
 				
                $color="white";
				$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$total_student_class_wise=0;
				while($row=mysqli_fetch_assoc($run)){
				$total_student_class_wise++;
				}
			
				$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Male' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$student_male_total=0;
				while($row=mysqli_fetch_assoc($run)){	
				$student_male_total++;
					
				}

				$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$student_female_total=0;
				while($row=mysqli_fetch_assoc($run)){	
				$student_female_total++;
					
				}
				
				$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_category='General' and student_gender='Male' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$general_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$general_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_category='General' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$general_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$general_student_total_female++;
				}
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_category='OBC' and student_gender='Male' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$obc_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$obc_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_category='OBC' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$obc_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$obc_student_total_female++;
				}
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_category='SC' and student_gender='Male' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$sc_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$sc_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_category='SC' and session_value='$session1'";
				$run=mysqli_query($conn73,$que);
				$sc_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$sc_student_total_female++;
				}
				
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_category='ST' and student_gender='Male' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$st_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$st_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_category='ST' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$st_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$st_student_total_female++;
				}
				
				
					$que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_category='Other' and student_gender='Male' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$other_student_total_male=0;
				while($row=mysqli_fetch_assoc($run)){	
				$other_student_total_male++;
				}
	           $que="select * from student_admission_info where student_status='Active' and student_class='$class_name' and student_gender='Female' and student_category='Other' and session_value='$session1'$filter37";
				$run=mysqli_query($conn73,$que);
				$other_student_total_female=0;
				while($row=mysqli_fetch_assoc($run)){	
				$other_student_total_female++;
				}
	$general_student_total=$general_student_total_male+$general_student_total_female;
	$obc_student_total=$obc_student_total_male+$obc_student_total_female;
	$sc_student_total=$sc_student_total_male+$sc_student_total_female;
	$st_student_total=$st_student_total_male+$st_student_total_female;
	$other_student_total=$other_student_total_male+$other_student_total_female;
                ?>

                <tr>
                  <td><b><?php echo $serial_no; ?></b></td>
                  <td><b><?php echo $class_name; ?></b></td>
                  <td><b><?php echo $total_student_class_wise ; ?></b></td>
                  <td><b><?php echo $student_male_total ; ?></b></td>
                  <td><b><?php echo $student_female_total ; ?></b></td>
                  <td><b><?php echo $general_student_total_male ; ?></b></td>
                  <td><b><?php echo $general_student_total_female ; ?></b></td>
                  <td><b><?php echo $general_student_total ; ?></b></td>
                  <td><b><?php echo $obc_student_total_male ; ?></b></td>
                  <td><b><?php echo $obc_student_total_female ; ?></b></td>
                  <td><b><?php echo $obc_student_total ; ?></b></td>
				  <td><b><?php echo $sc_student_total_male ; ?></b></td>
                  <td><b><?php echo $sc_student_total_female ; ?></b></td>
                  <td><b><?php echo $sc_student_total ; ?></b></td>
				  <td><b><?php echo $st_student_total_male ; ?></b></td>
                  <td><b><?php echo $st_student_total_female ; ?></b></td>
                  <td><b><?php echo $st_student_total ; ?></b></td>
				  <td><b><?php echo $other_student_total_male ; ?></b></td>
                  <td><b><?php echo $other_student_total_female ; ?></b></td>
                  <td><b><?php echo $other_student_total ; ?></b></td>

                  
                </tr>
                <?php 
                $total_total_student_class_wise=$total_total_student_class_wise+$total_student_class_wise;
                 $total_student_male_total=$total_student_male_total+$student_male_total;
                 $total_student_female_total=$total_student_female_total+$student_female_total;
                 $total_general_student_total_male=$total_general_student_total_male+$general_student_total_male;
                 $total_general_student_total_female=$total_general_student_total_female+$general_student_total_female;
                 $total_general_student_total=$total_general_student_total+$general_student_total;
                 $total_obc_student_total_male=$total_obc_student_total_male+$obc_student_total_male;
                 $total_obc_student_total_female=$total_obc_student_total_female+$obc_student_total_female;
                 $total_obc_student_total=$total_obc_student_total+$obc_student_total;
				  $total_sc_student_total_male=$total_sc_student_total_male+$sc_student_total_male;
                 $total_sc_student_total_female=$total_sc_student_total_female+$sc_student_total_female;
                 $total_sc_student_total=$total_sc_student_total+$sc_student_total;
				  $total_st_student_total_male=$total_st_student_total_male+$st_student_total_male;
                 $total_st_student_total_female=$total_st_student_total_female+$st_student_total_female;
                 $total_st_student_total=$total_st_student_total+$st_student_total;
				  $total_other_student_total_male=$total_other_student_total_male+$other_student_total_male;
                 $total_other_student_total_female=$total_other_student_total_female+$other_student_total_female;
                 $total_other_student_total=$total_other_student_total+$other_student_total;
				
				
				
				
				}
 ?>
				<tr>
                    <td><b></b></td>
                    <td style="color:red;"><b>All Class</b></td>
                    <td><b><?php echo $total_total_student_class_wise ; ?></b></td>
                    <td><b><?php echo $total_student_male_total ; ?></b></td>
                    <td><b><?php echo $total_student_female_total ; ?></b></td>
                    <td><b><?php echo $total_general_student_total_male ; ?></b></td>
                    <td><b><?php echo $total_general_student_total_female ; ?></b></td>
                    <td><b><?php echo $total_general_student_total ; ?></b></td>
                    <td><b><?php echo $total_obc_student_total_male ; ?></b></td>
                    <td><b><?php echo $total_obc_student_total_female ; ?></b></td>
                    <td><b><?php echo $total_obc_student_total ; ?></b></td>
                    <td><b><?php echo $total_sc_student_total_male ; ?></b></td>
                    <td><b><?php echo $total_sc_student_total_female ; ?></b></td>
                    <td><b><?php echo $total_sc_student_total ; ?></b></td>
                    <td><b><?php echo $total_st_student_total_male ; ?></b></td>
                    <td><b><?php echo $total_st_student_total_female ; ?></b></td>
                    <td><b><?php echo $total_st_student_total ; ?></b></td>
                    <td><b><?php echo $total_other_student_total_male ; ?></b></td>
                    <td><b><?php echo $total_other_student_total_female ; ?></b></td>
                    <td><b><?php echo $total_other_student_total ; ?></b></td>
                </tr>
               </tbody>
             </table>