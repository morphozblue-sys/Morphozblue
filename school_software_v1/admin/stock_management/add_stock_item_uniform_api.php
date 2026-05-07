<?php include("../attachment/session.php");
$res=0;
	$item_name = $_POST['item_name'];
	$item_size = $_POST['item_size'];
	$item_description = $_POST['item_description'];
	$item_class = $_POST['item_class'];
	$opening_stock = $_POST['item_opening_stock'];
	$item_category = $_POST['item_category'];
	$date = date('Y-m-d H:i:s');
	$cont=count($item_name);
	for($i=0;$i<$cont;$i++){
	    $quer="insert into new_stock_item_uniform(item_name,item_size,item_description,item_class,item_category,stock_item_status,$update_by_insert_sql_column) values('$item_name[$i]','$item_size[$i]','$item_description[$i]','$item_class[$i]','$item_category[$i]','Active',$update_by_insert_sql_value)";
        if(mysqli_query($conn73,$quer)){
            $last_id=mysqli_insert_id($conn73);
            $quer1="insert into new_stock_uniform(item_s_no,opening_stock,available_stock,new_stock_status,$update_by_insert_sql_column) values('$last_id','$opening_stock[$i]','$opening_stock[$i]','Active',$update_by_insert_sql_value)";
            if(mysqli_query($conn73,$quer1)){
                $res++;
            }
        }
	}
if($res>0){
    echo "|?|success|?|";
}
?>