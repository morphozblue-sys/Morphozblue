<?php include("../attachment/session.php"); ?>
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
url: access_link+"hostel/employee_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('hostel/employee_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
</script>

    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
                <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	 
	    <li><a href="javascript:get_content('hostel/staff')"><i class="fa fa-bed"></i> <?php echo $language['Hostel Staff']; ?></a></li>
	    <li class="Active"><?php echo $language['Staff List']; ?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Employee List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Employee Name']; ?></th>
                  <th><?php echo $language['Photo']; ?></th>
				  <th><?php echo $language['Contact No']; ?></th>
                  <th><?php echo $language['Designation']; ?></th>
                  <th><?php echo $language['Details']; ?></th>
                </tr>
                </thead>
                <tbody>
                
<?php
$que="select * from hostel_staff_info";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$emp_name=$row['emp_name'];
		$emp_photo=$row['emp_photo'];
		$emp_mobile=$row['emp_mobile'];
		$emp_designation=$row['emp_designation'];
		$emp_photo=$row['emp_photo_name'];

	
		$serial_no++;
	
?>
<tr>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $emp_name; ?></td>
	<td><img src="<?php if($emp_photo!=''){ echo $_SESSION['amazon_file_path']."hostel_staff/".$emp_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50"></td>
	<td><?php echo $emp_mobile; ?></td>
	<td><?php echo $emp_designation; ?></td>
			
    <td><button type="button"  onclick="post_content('hostel/employee_edit','<?php echo 'id='.$s_no; ?>')" class="btn btn-success" ><?php echo $language['Edit']; ?></button>
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