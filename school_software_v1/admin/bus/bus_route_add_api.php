<?php include("../attachment/session.php");

$bus_route=$_POST['bus_route'];

$bus_stop_name=$_POST['bus_stop'];
$bus_route_time=$_POST['bus_time'];

$count=count($bus_stop_name);
for($i=0; $i<$count; $i++){
$que1="insert into bus_route_details(bus_route,bus_stop_name,bus_route_time,session_value,$update_by_insert_sql_column) values('$bus_route','$bus_stop_name[$i]','$bus_route_time[$i]','$session1',$update_by_insert_sql_value)";
mysqli_query($conn73,$que1);
}
echo "|?|success|?|";
?>