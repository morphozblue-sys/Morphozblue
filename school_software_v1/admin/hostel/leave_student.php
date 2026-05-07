<?php include("../attachment/session.php"); ?>

    <section class="content-header">
      <h1>
        <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
    <ol class="breadcrumb">
	
	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i><?php echo $language['Hostel']; ?></a></li>

	    <li class="Active"><?php echo $language['Leave Student']; ?></li>
	</ol>
    </section>

	<!---******************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"> <?php echo $language['Old Hostel Student List']; ?></h3>
			  <!--<a href='hostel_student.php'><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">Add Student</button></a>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <th><?php echo $language['Name']; ?></th>
                  <th><?php echo $language['Action']; ?></th>
                </tr>
                </thead>
                <tbody>
<?php 
$que="select * from hostel_leave where leave_status='Deactivate'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
$hostel_charges=0;
while($row=mysqli_fetch_assoc($run)){

		$s_no=$row['s_no'];
		$roll_number=$row['roll_number'];
		$hostel_student_id=$row['hostel_student_id'];
		$hostel_student_name=$row['hostel_student_name'];
		
	$serial_no++;
?>
                <tr>
                 <td ><?php echo $serial_no; ?></td>
                 <td ><?php echo $roll_number; ?></td>
                 <td ><?php echo $hostel_student_name; ?></td>
                 <td>
				 <button type="button"  onclick="post_content('hostel/leave_student_details','<?php echo 'id='.$hostel_student_id; ?>')" class="btn btn-success" ><?php echo $language['View']; ?></button>
				  <button type="button"  onclick="post_content('hostel/leave_hostel_rejoin','<?php echo 'id='.$hostel_student_id; ?>')" class="btn btn-success" >Rejoin</button>
				
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
 