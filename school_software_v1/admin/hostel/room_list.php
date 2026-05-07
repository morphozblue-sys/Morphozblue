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
url: access_link+"hostel/room_dlt.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('hostel/room_list');
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
        <small> <?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
     <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	  <li class="Active"> <?php echo $language['Room List']; ?></li>
      </ol>
    </section>

	<!---******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Student Room List']; ?></h3>
			   <a href="javascript:get_content('hostel/add_room')"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default"><?php echo $language['Add Room']; ?></button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Hostel']; ?></th>
                  <th><?php echo $language['Room No']; ?></th>
                  <th><?php echo $language['Room Bed Type']; ?></th>
                  <th><?php echo $language['Facilities']; ?></th>
                  <th><?php echo $language['Attach Washroom']; ?></th>
                  <th><?php echo $language['Charges Per Student']; ?></th>
                 <th><?php echo $language['Action']; ?></th>
                </tr>
                </thead>
                <tbody>
<?php 

$que="select * from hostel_add_room where room_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
$hostel_charges=0;
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$hostel_name=$row['hostel_name'];
		$room_number=$row['room_number'];
		$room_bed_type=$row['room_bed_type'];
		$room_facility=$row['room_facility'];
		$room_attach_washroom=$row['room_attach_washroom'];
		$room_charge_per_student=$row['room_charge_per_student'];
		
	$serial_no++;
?>
                <tr>
                 <td ><?php echo $serial_no; ?></td>
                 <td ><?php echo $hostel_name; ?></td>
                 <td ><?php echo $room_number; ?></td>
                 <td ><?php echo $room_bed_type; ?></td>
                 <td ><?php echo $room_facility; ?></td>
                 <td ><?php echo $room_attach_washroom; ?></td>
                 <td ><?php echo $room_charge_per_student; ?></td>
            
				 <td><button type="button"  onclick="post_content('hostel/room_details','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['Edit']; ?></button>
				 <button type="button"  class="btn class="btn btn-danger" onclick="return  valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
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