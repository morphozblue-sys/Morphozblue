<?php
include("../attachment/session.php");

$stock_quantity=0;
$delete_record=$_GET['id'];
$p_name=$_GET['p_name'];
$delete_quantity=$_GET['quantity'];

$query12="delete from stock_sale_table where s_no='$delete_record'";
mysqli_query($conn73,$query12);

$query10="select * from stock_buy_table_1 where s_no='$p_name'";
$res10=mysqli_query($conn73,$query10);
$row=mysqli_fetch_assoc($res10);
$item_quantity=$row['item_quantity'];

$stock_quantity=$delete_quantity+$item_quantity;
$query11="update stock_buy_table_1 set item_quantity='$stock_quantity',$update_by_update_sql  where s_no='$p_name'";
mysqli_query($conn73,$query11);
	 
if(mysqli_query($conn73,$query12)){

echo "|?|success|?|";

}

?>