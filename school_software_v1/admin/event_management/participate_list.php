<?php include("../attachment/session.php"); ?>
<script>
	function valid(s_no){
	var myval=confirm("Are you sure want to delete this record !!!!");
	if(myval==true){
	delete_fee(s_no);
	}
	else  {
	return false;
	}
	}
	
	function delete_fee(s_no){
	$.ajax({
	type: "POST",
	url: access_link+"event_management/delete_participate.php?id="+s_no+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert_new('Successfully Deleted','green');
	   get_content('event_management/participate_list');
	}else{
	//alert_new(detail); 
	}
	}
	});
	}
	</script>

    <section class="content-header">
      <h1>
         Participation List
	   <small>Control Panel</small> 
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Management</a></li>
        <li class="active"><i class="fa fa-list"></i> Participation List</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
   <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title">Participation List</h3>
			  <a href="javascript:get_content('event_management/add_participate')"><button type="button" class="btn btn-default pull-right my_background_color">Add Participate</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                   <th>Serial No.</th>
				   <th>Participate Type</th>
				   <th>Event Name</th>
				   <th>House Name</th>
				   <th>School/Institute Participate</th>
                   <th>Student Name</th>
				   <th>Student Class</th>
				   <th>Student Gender</th>
				   <th>Student DOB</th>
                   <th>Edit</th>
				   <th>Delete</th>
				</tr>
                </thead>
                <tbody>
				<?php	
				$que="select * from event_participate_table ORDER BY s_no DESC";
				$run=mysqli_query($conn73,$que);
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				$s_no = $row['s_no'];
				$event_name = $row['event_name'];
				$participate_type = $row['participate_type'];
				$house_name = $row['house_name'];
				$school_name = $row['school_name'];
				$student_name = $row['student_name'];
				$student_class = $row['student_class'];
				$student_roll_no = $row['student_roll_no'];
				$gender = $row['gender'];
				$dateofbirth = $row['dateofbirth'];
				$serial_no++;

				$query="select * from event_table where s_no='$event_name'";
				$res=mysqli_query($conn73,$query);
				while($row15=mysqli_fetch_assoc($res)){
				$event_name1=$row15['event_name'];
				}
				?>
                <tr>
				<th><?php echo $serial_no; ?></th>
				<th><?php echo $participate_type; ?></th>
				<th><?php echo $event_name; ?></th>
				<th><?php echo $house_name; ?></th>
				<th><?php echo $school_name; ?></th>
				<th><?php echo $student_name; ?></th>
				<th><?php echo $student_class; ?></th>
				<th><?php echo $gender; ?></th>
				<th><?php echo $dateofbirth; ?></th>
				<th><button type="button"  class="btn btn-default" onclick="post_content('event_management/edit_participate','<?php echo 'id='.$s_no; ?>');" >Edit</button></th>
                <th><button type="button" onclick="return valid('<?php echo $s_no; ?>');" class="btn btn-default" >Delete</button></th>
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