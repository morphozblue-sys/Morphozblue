<?php include("../attachment/session.php")?>
<script>
			function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_hostel(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_hostel(s_no){
$.ajax({
type: "POST",
url: access_link+"hostel/mess_detail_dlt.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('hostel/daily_mess_purchase_detail');
			   }else{
               //alert_new(detail); 
			   }
}
});
}


</script>
    <section class="content-header">
      <h1>
              <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	  	
	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i><?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_mess')"><i class="fa fa-bed"></i><?php echo $language['Hostel Mess']; ?></a></li>
	      <li class="Active"><?php echo $language['Daily Mess Purchase Details']; ?></li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Item List']; ?></h3>
			  <a href="javascript:get_content('hostel/daily_mess_purchase')">
			  <button type="button" class="btn btn-success pull-right " data-toggle="modal" data-target="#modal-default"><?php echo $language['Add New Item']; ?></button>
			  </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Item Description']; ?></th>
                  <th><?php echo $language['Quantity']; ?></th>
                  <th><?php echo $language['Rate']; ?></th>
                  <th><?php echo $language['Date']; ?></th>
                  <th><?php echo $language['Action']; ?></th>
                </tr>
                </thead>
                <tbody>
<?php 
 

$que="select * from hostel_mess_daily_purchase where hostel_mess_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
$hostel_charges=0;
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$item_description=$row['item_description'];
		$quantity=$row['quantity'];
		$rate=$row['rate'];
		$date_purchase=$row['date_purchase'];
		
	$serial_no++;
	
?>
            <tr>
              <td><?php echo $serial_no; ?></td>
              <td><?php echo $item_description; ?></td>
              <td><?php echo $quantity; ?></td>
              <td><?php echo $rate; ?></td>
              <td><?php echo $date_purchase; ?></td>
		      <td> <button type="button"  class="btn btn-danger" onclick="return  valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
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