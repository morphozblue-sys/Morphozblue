<?php include("../attachment/session.php");
$day_name=$_GET['day_name'];

					$que="select * from school_info_class_period where class_code=''";
					$run=mysqli_query($conn73,$que);
					$serial_no=0;
					$total_period=0;
					while($row=mysqli_fetch_assoc($run)){
					$period_name1=$row['period_name'];
					$period_code1=$row['period_code'];
					if($period_name1!=''){
					$period_coloum_subject[$total_period]=$period_code1."_subject_$day_name";
					$period_coloum_teacher[$total_period]=$period_code1."_teacher_$day_name";
					$total_period++;
					}
					}
				 	$que1="select * from class_time_table";
					$run1=mysqli_query($conn73,$que1);
					while($row1=mysqli_fetch_assoc($run1)){
					    	$serial_no++;
					    		$class=$row1['class'];
					    		$section=$row1['section'];
					    		$group_name=$row1['group_name'];
					    		$stream_code=$row1['stream_code'];
					    	?>
					    	
					    	<tr>
<td><?php echo $class." [".$section."]"; ?><?php if($group_name!=''){ echo $group_name."<br>[".$stream_code."]"; } ?></td>
<?php
					    	
					    for($k=0;$k<$total_period;$k++){
					$period_coloum_subject_name=$row1[$period_coloum_subject[$k]];
					$period_coloum_teacher_name=$row1[$period_coloum_teacher[$k]];
				
					?>

<td><?php if($period_coloum_subject_name!=''){ echo $period_coloum_subject_name."<br>[".$period_coloum_teacher_name."]"; } ?></td>


<?php } ?>


</tr>
<?php }
?>
 	<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>