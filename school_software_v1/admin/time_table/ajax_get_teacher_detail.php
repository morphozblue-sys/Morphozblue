<?php include("../attachment/session.php");
?>
  <div class="box <?php echo $box_head_color; ?>" >
                <div class="box-header with-border">
                </div>
                <div class="box-body table-responsive">
                <table id="table-data" border="1" class="table table-bordered table-striped" width="100%">
                <thead >
				  <tr>
				  <th>S.no</th>
				  <th><?php echo $language['Teacher Name']; ?></th>
				  <th><?php echo 'present/Absent'; ?></th>
				<?php 
				$que="select * from school_info_class_period where class_code=''";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				while($row=mysqli_fetch_assoc($run)){
				    
				$period_name = $row['period_name'];
				if($period_name!=''){
				?>
                  <th><?php echo strtoupper($period_name) ?></th>
				  <?php } } ?>
				  
				  <th>Update By</th>
                  <th>Date</th>
				  
                  </tr>
                </thead>
				<tbody >
<?php
$day=$_GET['day'];

$date1221=date_create($day);
$today_date= date_format($date1221,"Y-m-d");
$day= strtolower(date_format($date1221,"l"));
$month=date_format($date1221,"m");
$date=date_format($date1221,"d");
$year=date_format($date1221,"Y");


                    $que="select * from school_info_class_period where class_code=''";
					$run=mysqli_query($conn73,$que);
					$total_period=0;
					while($row=mysqli_fetch_assoc($run)){
					$period_name1=$row['period_name'];
					$period_code1=$row['period_code'];
					if($period_name1!=''){
					$period_coloum_teacher[]=$period_code1."_teacher_".$day;
					$total_period++;
					} }
					
					$que1="select * from employee_info where emp_categories='Teaching' and emp_status='Active'";
					$serial_no=0;
					$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
					while($row1=mysqli_fetch_assoc($run1)){
					$teacher_name=$row1['emp_name'];
					$emp_id=$row1['emp_id'];
					$serial_no++;
					
					$avail_date='';
					$que00="select * from staff_attendance where staff_id='$emp_id' and session_value='$session1' and month='$month'";
					$run00=mysqli_query($conn73,$que00);
				    while($row00=mysqli_fetch_assoc($run00)){
					$avail_date=$row00[$date];
				    }
					
					if($avail_date!='P'){
					    $print_var1='Absent';
					     
					    $color_var2='red';
					}else{
					    $print_var1='Present';
					     
					    $color_var2='green';
					 }
					
					?>
					<tr>
					<td><?php echo $serial_no ?></td>
					<td><?php echo $teacher_name ?></td>
					<td><font color="<?php echo $color_var2; ?>"><?php echo $print_var1 ?></font></td>
					<?php
					for($i=0;$i<$total_period;$i++){
					$que="select * from class_time_table where $period_coloum_teacher[$i]='$teacher_name' GROUP BY class";
					$run=mysqli_query($conn73,$que);
					$total=0;
					while($row=mysqli_fetch_assoc($run)){
					$class_name[$total]=$row['class'];
					$section_name[$total]=$row['section'];
					
                    $update_change=$row['update_change'];
                    if($row['last_updated_date']!='0000-00-00'){
                    $last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
                    }else{
                    $last_updated_date=$row['last_updated_date'];
                    }
					
					
					if($avail_date!='P'){
					    $print_var='-';  
					    $color_var='red';
					    $color_var1='red';
					}else{
					    $print_var='Available';
					    $color_var='Blue';
					    $color_var1='Black';
					 }
					$total++;
					} 
					if($total==0)
					{?>
					
					<td>
					<font color="<?php echo $color_var; ?>"><?php echo $print_var; ?></font>
                    </td>
					<?php
					}
					else{
					?>
					
					<td>	<font color="<?php echo $color_var1; ?>">
                       <?php 
					     for($j=0;$j<$total;$j++){
					   echo $class_name[$j]."(".$section_name[$j].")";
					   } 
					   ?></font>
                    </td>
			<?php		}  }
			
			?>
			
			<td><?php echo $update_change; ?></td>
            <td><?php echo $last_updated_date; ?></td>
			
			</tr>
			<?php
                 }

					?>

	
		        </tbody>
				
                </table>
                </div>