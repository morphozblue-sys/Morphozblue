<?php include("../attachment/session.php"); ?>
<?php
$stop_name=$_GET['stop_name'];
if($stop_name!=''){
    $condition=" and bus_stop_name='$stop_name'";
}else{
    $condition="";
}
$student_bus_route=$_GET['student_bus_route'];
if($student_bus_route!=''){
    $condition1=" and bus_route='$student_bus_route'";
}else{
    $condition1="";
}

$query="select * from bus_route_details where bus_route!=''$condition$condition1";
$result=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
$bus_no='';
while($row=mysqli_fetch_assoc($result)){
// $bus_route=$row['bus_route'];
// $bus_stop_name=$row['bus_stop_name'];
// $bus_route_time=$row['bus_route_time'];
// $bus_trip=$row['bus_trip'];
$bus_no=$row['bus_no'];
}
echo $bus_no;
?>