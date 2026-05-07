<?php include("../attachment/session.php"); ?> 
<script>
function valid(s_no){   
var myval=confirm("Are you sure want to delete this record !!!!");
if(myval==true){
delete_user(s_no);       
 }            
else  {      
return false;
 }       
  } 
  function delete_user(s_no){
$.ajax({
type: "POST",
url: access_link+"user_right/delete_user.php?id="+s_no+"",
cache: false,
success: function(detail){
	  var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Deleted','green');
				   get_content('user_right/user_list');
			   }else{
              //  alert_new(detail); 
			   }
}
});
}


</script>
    <section class="content-header">
      <h1>
        <?php echo $language['User Management']; ?> 
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('user_right/user_right')"><i class="fa fa-photo"></i> User Rights</a></li>
        <li class="active"><i class="fa fa-list"></i> <?php echo 'user List'; ?> </li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['User List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>S No</th>
                  <th>User Name</th>
                  <th>User Id</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Designation</th>
                  <th>Password</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <th>Update</th>
                  
                 
                </tr>
                </thead>
		
		<tbody>
				<?php 
			
				$query="select * from user_rights ORDER BY s_no DESC";
				$run=mysqli_query($conn73,$query) or die (mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				      $s_no=$row['s_no'];
				      $user_name=$row['user_name'];
				      $user_id=$row['user_id'];
				      $user_password=$row['user_password'];
				      $user_mobile=$row['user_mobile'];
				      $user_email=$row['user_email'];
				      $user_designation=$row['designation'];
				      $update_change=$row['update_change'];
	if($user_name!='bluemorphoz'){
				$serial_no++;
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $user_name; ?></td>
                  <td><?php echo $user_id; ?></td>
                  <td><?php echo $user_email; ?></td>
                  <td><?php echo $user_mobile; ?></td>
                  <td><?php echo $user_designation; ?></td>
                  <td><?php echo $user_password; ?></td>
				  <td><button type="button"  onclick="post_content('user_right/add_user','<?php echo 'user_email='.$user_email; ?>')" class="btn btn-success" ><?php echo $language['Edit']; ?></button></td><td>
			<button type="button"  class="btn btn-danger" onclick="return valid('<?php echo $s_no; ?>');" ><?php echo $language['Delete']; ?></button></td>
				 <td><?php echo $update_change; ?></td>
                  
                </tr>
	<?php } } ?>

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

