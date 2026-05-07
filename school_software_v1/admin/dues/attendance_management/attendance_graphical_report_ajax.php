<?php
include("../attachment/session.php");
$current_date=$_GET['current_date'];

$query="select student_id from  student_admission_info where  student_status='Active' and session_value='$session_value'";
$result=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
$student_count=0;
$total_present=0;
$total_absent=0;
$total_leave=0;
$total_not_mark=0;
while($row=mysqli_fetch_assoc($result)){
$student_id=$row['student_id'];

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
$start_date=$current_year.'-'.$current_month.'-01';
$count1 = date(' t ', strtotime($start_date) );
$query1="select * from student_attendance where month='$current_month' and year='$current_year'  and student_id='$student_id'";
$result1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
if(mysqli_num_rows($result1)>0){
while($row1=mysqli_fetch_assoc($result1)){

for($i=$current_date1;$i<=$current_date1;$i++){
$attendance_column='attendance_'.intval($i);    
$a=$row1[$attendance_column];
if($a=='P'){
$total_present=$total_present+1;
}elseif($a=='P/2'){
$total_present=$total_present+0.5;
$total_absent=$total_absent+0.5;
}elseif($a=='A'){
$total_absent=$total_absent+1;
}elseif($a=='L'){
$total_leave=$total_leave+1;
}elseif($a==''){
$total_not_mark=$total_not_mark+1;
}
}
}
}else{
$total_not_mark=$total_not_mark+1;
}

$student_count++;
}
?>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Attendance per Day'],
          ['Not Mark',      <?php echo $total_not_mark; ?>],
          ['Total Leave',  <?php echo $total_leave; ?>],
          ['Total Present', <?php echo $total_present; ?>],
          ['Total Absent',    <?php echo $total_absent; ?>]
        ]);

        var options = {
          title: 'Attendance Graphical Representation',
          pieHole: 0.4,
		  is3D: true,
		  colors: ['#e0440e', '#ff9900', '#109618', '#990099'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
</script>
<div id="donutchart" style="height:400px; width:100%"></div>