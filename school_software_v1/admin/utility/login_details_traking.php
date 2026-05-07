<?php include("../attachment/session.php")?> 
	

    <section class="content-header">
      <h1>
        Login Management 
      </h1>
      <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="javascript:get_content('utility/login_details')"><i class="fa fa-photo"></i> Login Details</a></li>
        <li class="active"><i class="fa fa-list"></i>Login List</li>
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
              <h3 class="box-title">Login List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th>Login User</th>
                  <th>Login Time</th>
                  <th>Logout Time</th>
                  <th>Ip Address</th>

                </tr>
                </thead>
		
		<tbody>
				<?php 
				$query="select * from login_details where login_user!='morphozblue@gmail.com' ORDER BY s_no DESC";
				$run=mysqli_query($conn73,$query) or die (mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				      $login_user=$row['login_user'];
				      $login_time=$row['login_time'];
				      $login_ip=$row['login_ip'];
				      $logout_time=$row['logout_time'];
		
				$serial_no++;
				?>
                <tr>
                  <td><?php echo $serial_no; ?></td>
                  <td><?php echo $login_user; ?></td>
                  <td><?php echo $login_time; ?></td>
                  <td><?php echo $logout_time; ?></td>
                  <td><?php echo $login_ip; ?></td>
                 
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