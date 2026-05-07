<?php include("../attachment/session.php");

	$category_name = $_POST['category_name'];
	
$quer="insert into stock_category(category_name,category_status,$update_by_insert_sql_column) values('$category_name','Active',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$quer)){
 echo "|?|success|?|";
}
?>