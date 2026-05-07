<?php include("../attachment/session.php"); ?>
<script>
window.scrollTo(0, 0);
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
url: access_link+"hostel/hostel_dlt.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('hostel/hostel_list');
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
         <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li class="active"><?php echo $language['Hostel List']; ?></a></li>
    </ol>
    </section>

	<!---***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Student Hostel List']; ?></h3>
			  <a href="javascript:get_content('hostel/add_hostel')"><button type="button"  class="btn btn-danger"><?php echo $language['Add Hostel']; ?></button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Hostel Name']; ?></th>
                  <th><?php echo $language['Hostel Type']; ?></th>
                  <th><?php echo $language['No Of Room']; ?></th>
                  <th><?php echo $language['Total Capacity']; ?></th>
                  <th><?php echo $language['Facilities']; ?></th>
                  <th><?php echo $language['Laundry Services']; ?></th>
                  <th><?php echo $language['Mess']; ?></th>
                  <th><?php echo $language['Warden Name']; ?></th>
                  <th><?php echo $language['Action']; ?></th>
                </tr>
                </thead>
                <tbody>
<?php 
$que="select * from hostel_info where hostel_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$hostel_name=$row['hostel_name'];
		$hostel_type=$row['hostel_type'];
		$hostel_number_of_room=$row['hostel_number_of_room'];
		$hostel_total_capacity=$row['hostel_total_capacity'];
		$hostel_facility=$row['hostel_facility'];
		$hostel_laundry=$row['hostel_laundry'];
		$hostel_mess=$row['hostel_mess'];
		$hostel_warden_name=$row['hostel_warden_name'];
		
	$serial_no++;
	
?>
                <tr>
                 <td ><?php echo $serial_no; ?></td>
                 <td ><?php echo $hostel_name; ?></td>
                 <td ><?php echo $hostel_type; ?></td>
                 <td ><?php echo $hostel_number_of_room; ?></td>
                 <td ><?php echo $hostel_total_capacity; ?></td>
                 <td ><?php echo $hostel_facility; ?></td>
                 <td ><?php echo $hostel_laundry; ?></td>
                 <td ><?php echo $hostel_mess; ?></td>
                 <td ><?php echo $hostel_warden_name; ?></td>
                  <td>
		
				  <button type="button"  onclick="post_content('hostel/hostel_details','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['Edit']; ?></button>
				 <button type="button"  class="btn class="btn btn-danger" onclick="return  valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button>
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
$(function(){
$('#example1').DataTable()
})
</script>