<?php include("../attachment/session.php"); ?>
<?php
	
	$bus_route = $_POST['bus_route'];
	$bus_stop_name = $_POST['bus_stop_name'];
	$bus_route_time = $_POST['bus_route_time'];
	$bus_no = $_POST['bus_no'];
	
	$s_no1 = $_POST['s_no1'];
	
$quer="update bus_route_details set bus_route='$bus_route',bus_stop_name='$bus_stop_name',bus_route_time='$bus_route_time',bus_no='$bus_no',$update_by_update_sql where s_no='$s_no1'";

if(mysqli_query($conn73,$quer)){
echo "|?|success|?|";
}
?>