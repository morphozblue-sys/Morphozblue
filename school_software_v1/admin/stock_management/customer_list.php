<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        <?php echo $language['Stock Management']; ?>
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="javascript:get_content('stock_management/stock_management')"><i class="fa fa-money"></i> <?php echo $language['Stock Management']; ?></a></li>
        <li class="active">Customer List</li>
        </ol>
    </section>

<script>
function valid(s_no){   
    var myval=confirm("Are you sure want to delete this record !!!!");
    if(myval==true){
        delete_record(s_no);       
    }            
    else  {      
        return false;
    }
}

function delete_record(s_no){
$.ajax({
type: "POST",
url: access_link+"stock_management/customer_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
    var res=detail.split("|?|");
	    if(res[1]=='success'){
            alert_new('Successfully Deleted','green');
            get_content('stock_management/customer_list');
        }else{
            //alert_new(detail); 
	    }
    }
});
}
</script>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-md-12">
          <!-- /.box -->
		  
		<div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
			  <div class="col-md-3"></div>
			   <a href="javascript:get_content('stock_management/add_customer')"> <button style="float:right;" type="button" class="btn btn-primary">+ Add New Customer</button></a>  
			</div>
			
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
					<th>S.No.</th>
					<th>Customer Name</th>
					<th>Customer Contact</th>
					<th>Customer E-mail</th>
					<th>Customer Address</th>
					
                    <th>Update By</th>
                    <th>Date</th>
					
					<th><center><?php echo $language['Action']; ?></center></th>
                </tr>
                </thead>
				<tbody id="search_table">


<?php
$que="select * from customer_detail where customer_status='Active' ORDER BY s_no DESC";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$customer_name=$row['customer_name'];
		$customer_contact=$row['customer_contact'];
		$customer_email=$row['customer_email'];
		$customer_address=$row['customer_address'];
		$customer_status=$row['customer_status'];
		$update_change=$row['update_change'];
		$last_updated_date=$row['last_updated_date'];
		if($last_updated_date!='' && $last_updated_date!='0000-00-00 00:00:00'){
		    $last_updated_date=date('d-m-Y h:i:s',strtotime($last_updated_date));
		}
		
	$serial_no++;
?>

<tr>

	<td><?php echo $serial_no; ?></td>
	<td><?php echo $customer_name; ?></td>
	<td><?php echo $customer_contact; ?></td>
	<td><?php echo $customer_email; ?></td>
	<td><?php echo $customer_address; ?></td>
	
	<td><?php echo $update_change; ?></td>
	<td><?php echo $last_updated_date; ?></td>
	
    <td>
    <center>
    <a href="javascript:post_content('stock_management/customer_edit','id=<?php echo $s_no; ?>')" style="color:#fff;"><input type="button" value="Edit" class="btn btn-default" style="background-color:#00a654;color:#fff;"></a> &nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button>
    </center>
    </td>

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