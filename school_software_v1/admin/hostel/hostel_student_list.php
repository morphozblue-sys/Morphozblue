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
url: access_link+"hostel/hostel_student_dlt.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('hostel/hostel_student_list');
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
	     <li class="Active"><?php echo $language['Hostel Student List']; ?></li>
      </ol>
    </section>

	<!---***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Student Hostel List']; ?></h3>
<a href="javascript:get_content('hostel/hostel_student')"><button type="button" class="btn btn-danger" ><?php echo $language['Add Student']; ?></button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Name']; ?></th>
                  <th><?php echo $language['Father Name']; ?></th>
                  <th><?php echo $language['Class']; ?></th>
                  <th><?php echo $language['Hostel Name']; ?></th>
                  <th><?php echo $language['Room No']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <th><?php echo $language['Total Fees']; ?></th>
                  <th><?php echo $language['Action']; ?></th>
                </tr>
                </thead>
                <tbody>
<?php

$que="select * from hostel_student_info where hostel_student_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
$hostel_charges=0;
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$hostel_student_name=$row['hostel_student_name'];
		$hotel_father_name=$row['hotel_father_name'];
		$hostel_student_class=$row['hostel_student_class'];
		$hostel_hostel_name=$row['hostel_hostel_name'];
		$hostel_room=$row['hostel_room'];
		$hostel_student_id=$row['hostel_student_id'];
		$roll_number=$row['roll_number'];
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
                  <td>
				  <button type="button"  onclick="post_content('hostel/hostel_student_details','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['View']; ?></button>
			<button type="button"  class="btn class="btn btn-danger" onclick="return  valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button>
				 
				 <button type="button"  onclick="post_content('hostel/hostel_pay_fee','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['Pay Fees']; ?></button>
				   <button type="button"  onclick="post_content('hostel/leave','<?php echo 'id='.$hostel_student_id; ?>')" class="btn btn-success" ><?php echo $language['Leave']; ?></button>
				  <button type="button"  onclick="post_content('hostel/hostel_pay_fee_details','<?php echo 'id='.$hostel_student_id; ?>')" class="btn btn-success" ><?php echo $language['Paid']; ?></button>
				  
			 
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