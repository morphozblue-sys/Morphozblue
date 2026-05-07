<?php include("../attachment/session.php"); ?>
<script>

function valid1(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_data(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_data(s_no){
$.ajax({
type: "POST",
url: access_link+"recycle_bin/recycle_expense_list_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('recycle_bin/recycle_expense_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
function valid(s_no){   
var myval=confirm("Are you sure want to restore this record !!!!");
if(myval==true){
restore_data(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function restore_data(s_no){
$.ajax({
type: "POST",
url: access_link+"recycle_bin/recycle_expense_list_restore.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Restore','green');
				   get_content('recycle_bin/recycle_expense_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
			


</script>

     <section class="content-header">
      <h1>
        Recycle Bin
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
     	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('recycle_bin/recycle_bin')"><i class="fal fa-trash-alt"></i> Recycle Bin</a></li>
        <li class="active">Expense List Recycle Bin</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title">Expence List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                   <th>Serial No.</th>
                   <th>Date</th>
                  <th>Customer Name</th>
                  <th>Address</th>
                  <th>Designation</th>
				  <th>Total Amount</th>
				  <th>Restore</th>
				  <th>Delete</th>
				</tr>
                </thead>
                <tbody>
                <?php

$que="select * from account_expence_info where account_status='Deleted'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$account_customer_date=$row['account_customer_date'];
		$account_customer_name=$row['account_customer_name'];
		$account_customer_address=$row['account_customer_address'];
		$account_customer_designation=$row['account_customer_designation'];
		$account_customer_total_amount=$row['account_customer_total_amount'];
		
	$serial_no++;
	
?>
                
				<tr>         
	<th ><?php echo $serial_no; ?></th>
	<th  ><?php echo $account_customer_date; ?></th>
	<th  ><?php echo $account_customer_name; ?></th>
	<th  ><?php echo $account_customer_address; ?></th>
    <th  ><?php echo $account_customer_designation; ?></th>
	<th  ><?php echo $account_customer_total_amount; ?></th>
	
	<td><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Restore']; ?></button></td>
	<td><button type="button"  class="btn btn-danger" onclick="return valid1('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>

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
$(function(){
$('#example1').DataTable()
})
</script>