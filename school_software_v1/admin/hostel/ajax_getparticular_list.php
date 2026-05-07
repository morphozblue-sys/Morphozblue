<?php
$month=$_GET['month'];
$year=$_GET['year'];
$class=$_GET['s_class'];
$unique_id=$_GET['id'];
$unique_id1=$unique_id;

?>
    <tr>
        <td>&nbsp;</td>
		<td><button type="button" class="btn btn-success">DATE : </button></td>
		<td colspan="2">
	<?php
		
		$date0=$year.'-'.$month.'-01';
		$count = date(' t ', strtotime($date0) );
					
		for($i=1;$i<=$count;$i++){
				  
		$a=$i;
				  
		?>
		<button style="width:40px;" type="button" class="btn btn-success"><?php echo $a; ?></button>
		<?php } ?>
		</td>
	</tr>
		<?php
			include("../../con73/con37.php");

	$que="select * from hostel_student_attendence where hostel_name_attendance='$class' and month='$month' and year='$year' and attendance_roll_no='$unique_id' and hostel_room_attendance='$section'";
			$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
			if(mysqli_num_rows($run)>0){
			while($row=mysqli_fetch_assoc($run)){

					$unique_id = $row['attendance_roll_no'];
					$attendance_name = $row['attendance_name'];
					
					$date2=$year.'-'.$month.'-01';
					$number = date(' t ', strtotime($date2) );
				?>
                <tr>
                  <td><?php echo $unique_id; ?><input type="text" name="student_unique_id" id="student_unique_id" value="<?php echo $unique_id; ?>" style="display:none;" /></td>
                  <td><?php echo $attendance_name; ?></td>
				  <td colspan="2">
				  <?php
				  for($i=1;$i<=$number;$i++){
				  if($i<10){
				  $a=$row['0'.$i];
				  $b=$a;
				  if($a==''){
				  $a=strtoupper('0'.$i);
				  }
				  }else{
				  $a=$row[$i];
				  $b=$a;
				  if($a==''){
				  $a=strtoupper($i);
				  }
				  }
				  ?> 
                  <button type="button" class="<?php if($a=='P'){ echo 'btn btn-primary'; }elseif($a=='A'){ echo 'btn btn-danger'; }elseif($a=='L'){ echo 'btn btn-warning'; }elseif($b==''){ echo 'btn'; } ?>" title="<?php if($a=='P'){ echo 'Present'; }elseif($a=='A'){ echo 'Absent'; }elseif($a=='L'){ echo 'Leave'; }elseif($b==''){ echo 'Not Fill'; } ?>" style="width:40px;"><?php echo $a; ?></button>
				  <?php } ?>
				  </td>
                </tr>
				<?php } }else{ ?>
				<tr>
				  <td><input type="text" name="student_unique_id" id="student_unique_id" value="<?php echo $unique_id1; ?>" style="display:none;" /></td>
				  <td>&nbsp;</td>
				  <td colspan="2">
				  <center><h2>Data Not Found !!!</h2></center>
				  </td>
				</tr>
				<?php } ?>

                