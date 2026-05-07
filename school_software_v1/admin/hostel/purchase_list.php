<?php include("../attachment/session.php")?>

<!DOCTYPE html>
<html>
<head>
 <?php include("../attachment/link_css.php")?>

</head>

<?php include("../attachment/header.php")?>
<?php include("../attachment/sidebar.php")?>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">


  


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>
       <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="../index.php"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="hostel.php"><i class="fa fa-bed"></i><?php echo $language['Hostel']; ?></a></li>
	    <li><a href="stock.php"><i class="fa fa-bed"></i><?php echo $language['Stock']; ?></a></li>
		<li class="Active"><?php echo $language['Purchase List']; ?></li>
	  </ol>
    </section>
	


<script>
function myFunction() {
    var txt=confirm("Are You Sure Want to Delete!");
    if (txt==true) {
	return true;
    } else {
        return false;
    }
   
}
</script>

	<!---*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            
			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				
				
				
<?php
include("../../con73/con37.php");

$que="select * from hostel_stock_purchase where purchase_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$total_purchase_amount=0;
while($row=mysqli_fetch_assoc($run)){

		$total_purchase_amount+=$row['total_purchase_amount'];
	
		}
?>

   <tr>
	<th colspan='5' align='center' ><font color="#f1f1f1"><?php echo $language['Hostel Expenses']; ?></th>
	<th colspan='2' align='center' ><font color="black"><?php echo $language['Total Amount Hostel Expense']; ?></th>
	<th colspan='2' align='center' ><font color="black"><?php echo $total_purchase_amount; ?>/-</th>
   </tr>
					<th style="width:50px";><?php echo $language['S No']; ?></th>
					<th><?php echo $language['Product Name']; ?></th>
					<th><?php echo $language['Quantity']; ?></th>
					<th><?php echo $language['Rate']; ?></th>
					<th><?php echo $language['Shop Name']; ?></th>
					<th><?php echo $language['Contact Person Name']; ?></th>
					<th><?php echo $language['Total Amount']; ?></th>
					<th ><center><?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody id="search_table">


<?php
include("../../con73/con37.php");

	if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;

	$setLimit = 20;
	$pageLimit = ($page * $setLimit) - $setLimit;
	
$que="select * from hostel_stock_purchase where purchase_status='Active' LIMIT $pageLimit , $setLimit ";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=$pageLimit;


	
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$item_product_name=$row['item_product_name'];
		$item_quantity=$row['item_quantity'];
		$item_purchase_rate=$row['item_purchase_rate'];
		$shop_name=$row['shop_name'];
		$contact_person_name=$row['contact_person_name'];
		$total_purchase_amount=$row['total_purchase_amount'];
		
	$serial_no++;
	
?>

<tr  align='center' >

	<th style="width:50";><?php echo $serial_no; ?></th>
	<th><?php echo $item_product_name; ?></th>
	<th><?php echo $item_quantity; ?></th>
	<th><?php echo $item_purchase_rate; ?></th>
	<th><?php echo $shop_name; ?></th>
	<th><?php echo $contact_person_name; ?></th>
	<th><?php echo $total_purchase_amount; ?></th>
	
<th>
	<center>

	<a href='purchase_delete.php?id=<?php echo $s_no; ?> 'style="color:#fff;"><input type="button" onclick="return myFunction()" value="<?php echo $language['Delete']; ?>" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a></center> &nbsp;&nbsp;&nbsp;&nbsp;
</th>

</tr>

<?php } ?>
		</tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
  
	
	<!---*******************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
