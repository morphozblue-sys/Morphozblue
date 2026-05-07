<?php include("../attachment/session.php");
$day=$_GET['day'];
                    $que="select * from school_info_class_period";
					$run=mysqli_query($conn73,$que);
					$total_period=0;
					while($row=mysqli_fetch_assoc($run)){
					$period_name1=$row['period_name'];
					$period_coloum_teacher[]=$period_name1."_teacher_".$day;
					$total_period++;
					}
					
					$que1="select * from employee_info where emp_categories='Teaching' and emp_status='Active'";
					$serial_no=0;
					$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
					while($row1=mysqli_fetch_assoc($run1)){
					$teacher_name=$row1['emp_name'];
					$serial_no++;
					?>
					<tr>
					<td><?php echo $serial_no ?></td>
					<td><?php echo $teacher_name ?></td>
					<?php
					for($i=0;$i<$total_period;$i++){
					$que="select * from class_time_table where $period_coloum_teacher[$i]='$teacher_name' GROUP BY class";
					$run=mysqli_query($conn73,$que);
					$total=0;
					$class_name[]='';
					$section_name[]='';
					while($row=mysqli_fetch_assoc($run)){
					$class_name[$total]=$row['class'];
					$section_name[$total]=$row['section'];
					
                    $update_change=$row['update_change'];
                    if($row['last_updated_date']!='0000-00-00'){
                    $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                    }else{
                    $last_updated_date=$row['last_updated_date'];
                    }
					
					$total++;
					} 
					if($total==0)
					{?>
					
					<td>
					<font color="green">Available</font>
                    </td>
					<?php
					}
					else{
					?>
					
					<td>
                       <?php 
					     for($j=0;$j<$total;$j++){
					   echo $class_name[$j]."(".$section_name[$j].")";
					   } 
					   ?>
                    </td>
			<?php		}  }
			
			?>
			
			<td><?php echo $update_change; ?></td>
            <td><?php echo $last_updated_date; ?></td>
			
			</tr>
			<?php
                 }

					?>

