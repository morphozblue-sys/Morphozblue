<?php include("../attachment/session.php");
    $s_no = $_POST['s_no'];
	$item_product_name = $_POST['item_product_name'];
	$item_product_category = $_POST['item_product_category'];
	$item_brand_name = $_POST['item_brand_name'];
	$item_description = $_POST['item_description'];
	$item_quantity = $_POST['item_quantity'];
	$item_code = $_POST['item_code'];
	$item_rate = $_POST['item_rate'];
    
    echo $quer="update stock_item_table set item_product_name='$item_product_name',item_product_category='$item_product_category', item_brand_name='$item_brand_name', item_description='$item_description',item_quantity='$item_quantity', item_code='$item_code',item_rate='$item_rate', $update_by_update_sql where s_no='$s_no'";
    if(mysqli_query($conn73,$quer)){
        echo "|?|success|?|";
    }
?>