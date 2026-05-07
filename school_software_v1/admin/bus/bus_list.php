<?php include("../attachment/session.php"); ?>
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_bus(s_no);       
 }            
else  {      
return false;
 }       
  }
  
function delete_bus(s_no){
$.ajax({
type: "POST",
url: access_link+"bus/bus_details_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('bus/bus_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script>	
    <section class="content-header">
      <h1>
        Bus Management
		    <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
        <li class="active">Bus Details List</li>
      </ol>
    </section>

	<!---****************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
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
        <th>Bus Name</th>
        <th>Bus Company</th>
        <th>Model No.</th>
        <th>Bus No.</th>
        <th>Capacity</th>
	    <th>Owner Name</th>
	    <th>Contact No.</th>
		<th>Ragistration No.</th>
		<th>Registration</th>
		<th>Bus Photo</th>
		<th>Edit</th>
		<th>Delete</th>
        </tr>
        </thead>
		
<?php

$que="select * from bus_details order by s_no DESC";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$bus_name = $row['bus_name'];
	$bus_company = $row['bus_company'];
	$bus_model_no = $row['bus_model_no'];
	$bus_no = $row['bus_no'];
	$bus_owner_name = $row['bus_owner_name'];
	$bus_owner_contact = $row['bus_owner_contact'];
	$bus_ragistration_no = $row['bus_ragistration_no'];
	$bus_photo = '';
	$bus_registration = '';
	$bus_capacity = $row['bus_capacity'];
	$bus_id = $row['bus_id'];
	
	$bus_photo=$row['bus_photo_name'];
	$bus_registration=$row['bus_registration_name'];

	$serial_no++;

?>

<tr  align='center' > 

	<th ><?php echo $serial_no; ?></th>
	<th  ><?php echo $bus_name; ?></th>
	<th  ><?php echo $bus_company; ?></th>
	<th  ><?php echo $bus_model_no; ?></th>
	<th  ><?php echo $bus_no; ?></th>
	<th  ><?php echo $bus_capacity; ?></th>
	<th  ><?php echo $bus_owner_name; ?></th>
	<th  ><?php echo $bus_owner_contact; ?></th>
	<th  ><?php echo $bus_ragistration_no; ?></th>
	<th><img src="<?php if($bus_registration!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$bus_registration; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50"></a></th>
	<th><img src="<?php if($bus_photo!=''){ echo $_SESSION['amazon_file_path']."bus_document/".$bus_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50"></a></th>


	<td><button type="button"  onclick="post_content('bus/bus_details_edit','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['Edit']; ?></button></td><td>
			<button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
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

