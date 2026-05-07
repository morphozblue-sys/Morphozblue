<?php include("../attachment/session.php"); ?>
  
  
 <script>
			function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_item(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_item(s_no){
$.ajax({
type: "POST",
url: access_link+"stock/sales_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('stock/sale_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
</script>

   <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
             <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock/stock')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active"><?php echo $language['Sale List']; ?></li>
        </ol>
    </section>
	

	<!---**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>">
            
			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <th> <?php echo $language['S No']; ?></th>
				  <th> <?php echo $language['Student Name']; ?></th>
				  <th> <?php echo $language['Father Name']; ?></th>
                  <th> <?php echo $language['Product Name']; ?></th>
                  <th>Category</th>
				  <th> <?php echo $language['Quantity']; ?></th>
                  <th> <?php echo $language['Rate']; ?></th>
                  <th> <?php echo $language['Total Amount']; ?></th>
				  <th><center> <?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody id="search_table">


<?php


	if(isset($_GET["page"]))
	$page = (int)$_GET["page"];
	else
	$page = 1;

	$setLimit = 20;
	$pageLimit = ($page * $setLimit) - $setLimit;
	
$que="select * from stock_sale_table where sale_status='Active' LIMIT $pageLimit , $setLimit ";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=$pageLimit;


	
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$student_name=$row['student_name'];
		$student_father_name=$row['student_father_name'];
		$student_roll_no=$row['student_roll_no'];
		$item_product_name=$row['item_product_name'];
		$item_quantity=$row['item_quantity'];
		$item_sales_rate=$row['item_sales_rate'];
		$total_amount=$row['total_amount'];
		$stock_id=$row['stock_id'];
		$item_product_category = $row['item_product_category'];
		
        $que1="select category_name from stock_category where category_status='Active' and s_no='$item_product_category'";
        $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
        $category_name='';
        while($row1=mysqli_fetch_assoc($run1)){
        $category_name=$row1['category_name'];
        }
		
		$que4="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
		$run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
		$row4=mysqli_fetch_assoc($run4);
		$student_name1=$row4['student_name'];
		
	$serial_no++;
	
?>

<tr align='center'>

	<th><?php echo $serial_no; ?></th>
	<th><?php echo $student_name1; ?></th>
	<th><?php echo $student_father_name; ?></th>
	<th><?php echo $item_product_name; ?></th>
	<th><?php echo $category_name; ?></th>
	<th><?php echo $item_quantity; ?></th>
	<th><?php echo $item_sales_rate; ?></th>
	<th><?php echo $total_amount; ?></th>
	
<th>
	<center>
	
<button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
			
 &nbsp;&nbsp;&nbsp;&nbsp;
	
	
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
       <script>
  $(function () {
    $('#example1').DataTable()
  })
 
</script>
