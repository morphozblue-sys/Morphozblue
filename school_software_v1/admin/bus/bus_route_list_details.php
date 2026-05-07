<?php include("../attachment/session.php"); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bus Management
		    <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
		<li><a href="javascript:get_content('bus/bus_route_list')"><i class="fa fa-truck"></i><?php echo $language['Bus Details List']; ?></a></li>
        <li class="active">Particular List</li>
      </ol>
    </section>
    
<script>
function valid(s_no,bus_root){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
for_delete(s_no,bus_root);       
 }            
else  {      
return false;
 }       
  }
  
function for_delete(s_no,bus_root){
$.ajax({
type: "POST",
url: access_link+"bus/bus_route_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
				   post_content('bus/bus_route_list_details','id='+bus_root);
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script>

	<!---***********************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?> ">
            <div class="box-header with-border">
              <h3 class="box-title">Bus Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
	    <th>S No.</th>
        <th>Bus Route</th>
        <th>Bus Stop Name</th>
        <th>Bus Route Timing</th>
        <th>Bus No.</th>
        <th>Edit</th>
		<th>Delete</th>
        </tr>
        </thead>
		
		<?php
$bus_route=$_GET['id'];

$que="select * from bus_route_details where bus_route='$bus_route'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$bus_route = $row['bus_route'];
	$bus_stop_name = $row['bus_stop_name'];
	$bus_route_time = $row['bus_route_time'];
	$bus_no = $row['bus_no'];
	
$serial_no++;
?>

<tr  align='center' > 

	<th ><?php echo $serial_no; ?></th>
	<th  ><?php echo $bus_route; ?></th>
	<th  ><?php echo $bus_stop_name; ?></th>
	<th  ><?php echo $bus_route_time; ?></th>
	<th  ><?php echo $bus_no; ?></th>
	
	<th><button type="button" class="btn btn-default" onclick="post_content('bus/bus_route_list_edit','<?php echo 'id='.$s_no; ?>');" >Edit</th>
	<th><button type="button" class="btn btn-default" onclick="return valid('<?php echo $s_no; ?>','<?php echo $bus_route; ?>');" >Delete</th>
	
	</tr>
	
	<?php } ?>

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
