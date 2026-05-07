<?php 
include("../attachment/session.php");
	$item_description = $_POST['item_description'];
	$quantity = $_POST['quantity'];
	$rate = $_POST['rate'];
	 $date_purchase = $_POST['date_purchase'];
		
	$count=count($item_description);
	for($i=0; $i<$count; $i++){
 $quer="insert into hostel_mess_daily_purchase(item_description,quantity,rate,hostel_mess_status,date_purchase,$update_by_insert_sql_column)values('$item_description[$i]','$quantity[$i]','$rate[$i]','Active','$date_purchase',$update_by_insert_sql_value)";
mysqli_query($conn73,$quer);
 }
   echo "|?|success|?|";

	

?>

