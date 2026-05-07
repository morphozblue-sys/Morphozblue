<?php
include("../attachment/session.php");
?>
<script type="text/javascript">
				  google.charts.load('current', {'packages':['bar']});
				  google.charts.setOnLoadCallback(drawChart);

			  function drawChart() {
				var data = google.visualization.arrayToDataTable([
				  ['Class', 'Student', 'Not Mark', 'Leave','Present','Absent']
				  
				  
<?php
$current_date=$_GET['current_date'];

if($current_date!=''){
$current_date1=explode('-',$current_date);
$current_year=$current_date1[0];
$current_month=$current_date1[1];
$current_date1=$current_date1[2];
}else{
$current_year=date('Y');
$current_month=date('m');
$current_date1=date('d');
}

$query="select class_name,section from school_info_class_info where status='Active'";
$result=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($result)){
$class_name=$row['class_name'];
$total_present='total_present_'.$class_name;
$total_absent='total_absent_'.$class_name;
$total_leave='total_leave_'.$class_name;
$not_mark='not_mark_'.$class_name;

$$total_present=0;
$$total_absent=0;
$$total_leave=0;
$$not_mark=0;

$query1="select student_id from  student_admission_info where student_class='$class_name' and student_status='Active' and session_value='$session_value'";
$result1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
$classwise_strength=0;
while($row1=mysqli_fetch_assoc($result1)){
$student_id=$row1['student_id'];
$classwise_strength++;

$query2="select * from student_attendance where month='$current_month' and year='$current_year' and session_value='$session_value' and student_class='$class_name' and student_id='$student_id'";
$result2=mysqli_query($conn73,$query2)or die(mysqli_error($conn73));
if(mysqli_num_rows($result2)>0){
while($row2=mysqli_fetch_assoc($result2)){

for($i=$current_date1;$i<=$current_date1;$i++){
$attendance_column='attendance_'.$i;    
$a=$row2[$attendance_column];
if($a=='P'){
$$total_present=$$total_present+1;
}elseif($a=='P/2'){
$$total_present=$$total_present+0.5;
$$total_absent=$$total_absent+0.5;
}elseif($a=='A'){
$$total_absent=$$total_absent+1;
}elseif($a=='L'){
$$total_leave=$$total_leave+1;
}elseif($a==''){
$$not_mark=$$not_mark+1;
}
}

}
}else{
$$not_mark=$$not_mark+1;
}
}

?>
		  
,['<?php echo $class_name; ?>', <?php echo $classwise_strength; ?>, <?php echo $$not_mark; ?>, <?php echo $$total_leave; ?>, <?php echo $$total_present; ?>, <?php echo $$total_absent; ?>]
		  
<?php
}
?>
				  
				]);

				var options = {
				  chart: {
					title: 'Classwise Attendance Report',
				  },
				  bars: 'horizontal' // Required for Material Bar Charts.
				};

				var chart = new google.charts.Bar(document.getElementById('barchart_material'));

				chart.draw(data, google.charts.Bar.convertOptions(options));
			  }
			</script>
<div id="barchart_material" style="width: 100%; height: 800px;"></div>