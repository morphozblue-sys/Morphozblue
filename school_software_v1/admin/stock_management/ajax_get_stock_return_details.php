<?php include("../attachment/session.php");
$item_s_no = $_GET['item_s_no'];
$qry="select * from new_stock where item_s_no='$item_s_no' and new_stock_status='Active'";
$rest=mysqli_query($conn73,$qry);
while($row22=mysqli_fetch_assoc($rest)){
$available_stock=$row22['available_stock'];
$sale_rate=$row22['sale_rate'];
$purchase_rate=$row22['purchase_rate'];
echo '|?|'.$available_stock.'|?|'.$purchase_rate.'|?|';
}
?>