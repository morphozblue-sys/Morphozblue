<?php include("../attachment/session.php");

$bus_route=$_POST['bus_route'];

$que1="insert into bus_stop_details(bus_route,$update_by_insert_sql_column)values('$bus_route',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$que1)){ ;

echo "|?|success|?|";
}
?>