<?php include("../attachment/session.php"); 
$class_name=$_GET['class_name'];
	$que4="select * from school_info_class_info Where class_name='$class_name'";
    $run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
    while($row4=mysqli_fetch_assoc($run4)){
    $class_code = $row4['class_code'];
    }
$query = "select  class_code,period_code FROM school_info_class_period";
if(!mysqli_query($conn73,$query)) { 
   echo $alter = "ALTER TABLE `school_info_class_period` ADD `class_code` VARCHAR(20) NOT NULL AFTER `s_no`, ADD `period_code` VARCHAR(20) NOT NULL AFTER `class_code`;"; 
   mysqli_query($conn73,$alter) or die(mysqli_error($conn73));
}
   	       $que="select * from school_info_class_period where class_code='$class_code'";
					$run=mysqli_query($conn73,$que);
					if(mysqli_num_rows($run)<1){
					 	$que12="select * from school_info_class_period where class_code='' and period_code=''";
					$run12=mysqli_query($conn73,$que12);
					$x=0;
						while($row12=mysqli_fetch_assoc($run12)){
						    $period_name1=$row12['period_name'];
	                $period_start_time1 = $row12['period_start_time'];
					$period_end_time1 = $row12['period_end_time'];
					$x++;
					$period_code='period'.$x;
					    $insert_q="insert into school_info_class_period (class_code,period_code,period_name,period_start_time,period_end_time)values('$class_code','$period_code','$period_name1','$period_start_time1','$period_start_time1')";
					       mysqli_query($conn73,$insert_q);
						    
						}
							$run=mysqli_query($conn73,$que);
					}
					$serial_no=0;
					while($row=mysqli_fetch_assoc($run)){
					$period_code=$row['period_code'];
					$period_name1=$row['period_name'];
	                $period_start_time1 = $row['period_start_time'];
					$period_end_time1 = $row['period_end_time'];
	$name_str=$period_name1.'|?|'.$period_start_time1.'|?|'.$period_end_time1.'|?|'.$class_code;
	
if($period_name1!=''){
	$serial_no++;
?>				
    <tr  align='center' >
      
    <th><?php echo $serial_no; ?></th>
	<th><?php echo strtoupper($period_name1); ?></th>
	<th><?php echo $period_start_time1; ?></th>
	<th><?php echo $period_end_time1; ?></th>
	
	<th><button type="button" id="<?php echo $period_code; ?>" name="<?php echo $name_str; ?>" class="btn btn-success" onclick="add_edit(this.id,this.name)" data-toggle="modal" data-target="#myModal" >Add/Edit</th>
	</tr>
	<?php } else{ if($add_more_button==0){ $period_code_blank=$period_code;
	} $add_more_button++; } } if($add_more_button!=0){?>
	<tr align='center' >
	<th colspan="4" ><button type="button" id="<?php echo $period_code_blank; ?>" name="<?php echo $name_str; ?>" class="btn btn-success" onclick="add_edit(this.id,this.name)" data-toggle="modal" data-target="#myModal" >Add More</th>
				</tr>
				<?php } ?>