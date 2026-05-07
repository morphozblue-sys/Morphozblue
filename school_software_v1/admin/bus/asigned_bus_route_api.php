<?php include("../attachment/session.php");

$bus_no=$_POST['bus_no'];
$bus_route=$_POST['bus_route'];

$quer="update bus_route_details set bus_no='$bus_no',$update_by_update_sql  where bus_route='$bus_route'";
 
if(mysqli_query($conn73,$quer)){
$quer1="update bus_details set bus_route='$bus_route',$update_by_update_sql  where bus_no='$bus_no'";
mysqli_query($conn73,$quer1);
echo "|?|success|?|";
}
?>