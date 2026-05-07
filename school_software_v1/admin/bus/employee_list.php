<?php include("../attachment/session.php"); ?>

<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
for_delete(s_no);       
 }            
else  {      
return false;
 }       
  }
  
function for_delete(s_no){
$.ajax({
type: "POST",
url: access_link+"bus/employee_delete.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Deleted','green');
				   get_content('bus/employee_list');
			   }else{
               //alert_new(detail); 
			   }
}
});
}

</script>

    <section class="content-header">
      <h1>
       <?php echo $language['Bus Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
     <ol class="breadcrumb">
	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
	    <li><a href="javascript:get_content('bus/bus_staff')"><i class="fa fa-bed"></i><?php echo $language['Bus Staff']; ?></a></li>
	</ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?> ">
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
$que="select * from bus_staff_info order by s_no DESC";
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
	<td><img onclick="open_file1('emp_photo','bus_staff_document','s_no','<?php echo $s_no; ?>');" src="<?php if($emp_photo!=''){ echo $_SESSION['amazon_file_path']."bus_staff_document/".$emp_photo; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" height="50" width="50"></td>
	<td><?php echo $emp_mobile; ?></td>
	<td><?php echo $emp_designation; ?></td>
			
<td><button type="button" class="btn btn-default" onclick="post_content('bus/employee_edit','<?php echo 'id='.$s_no; ?>');" ><?php echo $language['Details']; ?></button>
<button type="button" class="btn btn-default" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
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
     <div id="mypdf_view">
			<div>
    </section>
<script>
$(function(){
$('#example1').DataTable()
})
</script>