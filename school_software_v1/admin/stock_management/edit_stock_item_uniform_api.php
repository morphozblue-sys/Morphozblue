<?php include("../attachment/session.php");
    $s_no = $_POST['s_no'];
	$item_name = $_POST['item_name'];
	$item_size = $_POST['item_size'];
	$item_description = $_POST['item_description'];
	$item_class = $_POST['item_class'];
	$item_category = $_POST['item_category'];
	$item_available_stock = $_POST['item_available_stock'];
	$opening_stock = $_POST['item_opening_stock'];
	$available_stock = $item_available_stock + $opening_stock;
    $quer="update new_stock_item_uniform set item_name='$item_name', item_size='$item_size', item_description='$item_description', item_class='$item_class',item_category='$item_category', $update_by_update_sql where s_no='$s_no'";
    if(mysqli_query($conn73,$quer)){
        $last_id=mysqli_insert_id($conn73);
        $quer1="update new_stock_uniform set opening_stock='$opening_stock', available_stock='$available_stock', $update_by_update_sql where item_s_no='$s_no'";
        if(mysqli_query($conn73,$quer1)){
             echo "|?|success|?|";
        }
    }
	
?>