<?php include("../attachment/session.php")?>


<!DOCTYPE html>
<html>
<head>
<?php include("../attachment/link_css.php")?>

</head>
<script>
 function purchase_calculation(){
   var quantity=document.getElementById("item_quantity").value;
   var rate=document.getElementById("item_purchase_rate").value;
   
	if(quantity>0 && rate>0){
	var total=parseFloat(quantity)*parseFloat(rate);
	document.getElementById("total_purchase_amount").value=total;
	}else{
	document.getElementById("total_purchase_amount").value='0';
	}
 }
</script>
<?php include("../attachment/header.php")?>
<?php include("../attachment/sidebar.php")?>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
              <?php echo $language['Hostel Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-dashboard"></i>  <?php echo $language['Home']; ?></a></li>
	    <li><a href="hostel.php"><i class="fa fa-bed"></i>  <?php echo $language['Hostel']; ?></a></li>
	    <li><a href="stock.php"><i class="fa fa-bed"></i> <?php echo $language['Stock']; ?></a></li>
	    <li class="Active"> <?php echo $language['Purchase Item']; ?></li>
      </ol>
    </section>
	
	
	<!---***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h1 class="box-title"><b><?php echo $language['Purchase Item']; ?></b></h1>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Personal Detail--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" enctype="multipart/form-data">
			
					
			<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Product Name']; ?></label>
					  <input type="text"  name="item_product_name" value=""  class="form-control">
					</div>
			</div>
		
			<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Quantity']; ?></label>
					  <input type="text"  name="item_quantity" placeholder="0" oninput="purchase_calculation();" id="item_quantity";  value="" class="form-control">
					</div>
			</div>  
				
			<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Rate']; ?></label>
					  <input type="text"  name="item_purchase_rate" placeholder="0.00" oninput="purchase_calculation();" id="item_purchase_rate" value="" class="form-control">
					</div>
			</div>
				
			<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Total Amount']; ?></label>
					  <input type="text"  name="total_purchase_amount" placeholder="0.00" id="total_purchase_amount"; value="" class="form-control">
					</div>
			</div>
			
			<div class="col-md-6 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Shop Name']; ?></label>
					  <input type="text"  name="shop_name" placeholder="<?php echo $language['Shop Name']; ?>" id="shop_name";  value="" class="form-control">
					</div>
			</div>  
			
			<div class="col-md-6">				
					<div class="form-group" >
					  <label ><?php echo $language['Contact Person Name']; ?></label>
					  <input type="text"  name="contact_person_name" placeholder="<?php echo $language['Contact Person Name']; ?>" id="contact_person_name";  value="" class="form-control">
					</div>
			</div>  
			
		<br><br><br><br><br><br>
		<div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
		</div>	
			
	</form>	

<?php



include("../../con73/con37.php");

if(isset($_POST['finish'])){
	$item_product_name = $_POST['item_product_name'];
	$item_quantity = $_POST['item_quantity'];
	$item_purchase_rate = $_POST['item_purchase_rate'];
	$total_purchase_amount = $_POST['total_purchase_amount'];
	$shop_name = $_POST['shop_name'];
	$contact_person_name = $_POST['contact_person_name'];
	
	
	$quer="insert into hostel_stock_purchase(item_product_name,item_quantity,item_purchase_rate,total_purchase_amount,shop_name,contact_person_name,$update_by_insert_sql_column)
	values('$item_product_name','$item_quantity','$item_purchase_rate','$total_purchase_amount','$shop_name','$contact_person_name',$update_by_insert_sql_value)";
 
 if(mysqli_query($conn73,$quer)){
	echo "<script>window.open('purchase_list.php','_self');</script>";
}
 }

?>	

<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          
		  </div>
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../../attachment/footer.php")?>
 <?php include("../../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>
</body>
</html>
