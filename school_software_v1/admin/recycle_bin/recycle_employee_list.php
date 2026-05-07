<?php include("../attachment/session.php")?>
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
url: access_link+"recycle_bin/recycle_employee_list_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('recycle_bin/recycle_employee_list');
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
url: access_link+"recycle_bin/recycle_employee_list_restore.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Restore','green');
				   get_content('recycle_bin/recycle_employee_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}
			


</script>
			


</script>

    <section class="content-header">
      <h1>
        Recycle Bin
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
  	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('recycle_bin/recycle_bin')"><i class="fal fa-trash-alt"></i> Recycle Bin</a></li>
        <li class="active">Employee List Recycle Bin</li>
      </ol>
    </section>


    <!-- Main content -->
      <section class="content">
      <div class="row">
       <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title">Employee List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>S no.</th>
                  <th>Employee Name</th>
                  <th>Photo</th>
				  <th>Contact No.</th>
                  <th>Designation</th>
                  <th style="<?php if($_SESSION['recycle_sub_panel_reset_delete_button']!='yes'){ echo 'display:none'; } ?>">Restore</th>
				  <th style="<?php if($_SESSION['recycle_sub_panel_reset_delete_button']!='yes'){ echo 'display:none'; } ?>">Delete</th>
                </tr>
                </thead>
                <tbody>
<?php
$que="select * from employee_info where emp_status='Deleted' and session_value='$session1'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){
		$s_no=$row['s_no'];
		$emp_name=$row['emp_name'];
		$emp_photo=$row['emp_photo'];
		$emp_mobile=$row['emp_mobile'];
		$emp_designation=$row['emp_designation'];
		$emp_id=$row['emp_id'];
	$emp_photo=$row['emp_photo_name'];
$serial_no++;



?>
<tr>
    <td><?php echo $serial_no; ?></td>
	<td><?php echo $emp_name; ?></td>
	<td><img src="<?php if($emp_photo!=''){ echo 'data:image;base64,'.$emp_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50"></td>
	<td><?php echo $emp_mobile; ?></td>
	<td><?php echo $emp_designation; ?></td>
	<td style="<?php if($_SESSION['recycle_sub_panel_reset_delete_button']!='yes'){ echo 'display:none'; } ?>"><button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $emp_id; ?>');"><?php echo $language['Restore']; ?></button></td>
	<td style="<?php if($_SESSION['recycle_sub_panel_reset_delete_button']!='yes'){ echo 'display:none'; } ?>"><button type="button"  class="btn btn-danger" onclick="return valid1('<?php echo $emp_id; ?>');"><?php echo $language['Delete']; ?></button></td>
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