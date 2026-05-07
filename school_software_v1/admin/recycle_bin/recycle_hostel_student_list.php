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
url: access_link+"recycle_bin/recycle_hostel_list_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('recycle_bin/recycle_hostel_student_list');
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
url: access_link+"recycle_bin/recycle_hostel_list_restore.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Restore','green');
				   get_content('recycle_bin/recycle_hostel_student_list');
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
        <li class="active">Hostel Student Recycle Bin</li>
      </ol>
    </section>


	<!---***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title">Student Hostel List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>S_no</th>
                  <th>Name</th>
                  <th>Father Name</th>
                  <th>Class</th>
                  <th>Hostel Name</th>
                  <th>Room No.</th>
                  <th>Roll No.</th>
                  <th>Total Fees</th>
                  <th>Restore</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
<?php 

$que="select * from hostel_student_info where hostel_student_status='Deleted'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
$hostel_charges=0;
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$hostel_student_name=$row['hostel_student_name'];
		$roll_number=$row['roll_number'];
		$hotel_father_name=$row['hotel_father_name'];
		$hostel_student_class=$row['hostel_student_class'];
		$hostel_hostel_name=$row['hostel_hostel_name'];
		$hostel_room=$row['hostel_room'];
		$hostel_student_id=$row['hostel_student_id'];
		$hostel_caution_money=$row['hostel_caution_money'];
		$hostel_laundry_charge=$row['hostel_laundry_charge'];
		$hostel_room_charge_per_bed=$row['hostel_room_charge_per_bed'];
		$hostel_mess_charge=$row['hostel_mess_charge'];
		$hostel_charges=$hostel_room_charge_per_bed+$hostel_mess_charge+$hostel_laundry_charge+$hostel_caution_money;
		
	$serial_no++;
	
?>
                <tr>
                 <td ><?php echo $serial_no; ?></td>
                 <td ><?php echo $hostel_student_name; ?></td>
                 <td ><?php echo $hotel_father_name; ?></td>
                 <td ><?php echo $hostel_student_class; ?></td>
                 <td ><?php echo $hostel_hostel_name; ?></td>
                 <td ><?php echo $hostel_room; ?></td>
                 <td ><?php echo $roll_number; ?></td>
                 <td ><?php echo $hostel_charges; ?></td>
                 
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