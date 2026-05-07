<?php include("../attachment/session.php"); ?>
<script>
    function valid()
    {
var myval=confirm("Are you sure want to parmanently  delete this record !!!!");
    if(myval==true)
        {
            return true;
        }
    else
        {
            return false;
        }
        }
</script>	

    <section class="content-header">
      <h1>
         Activity Plan List
	   <small>Control Panel</small> 
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar"></i>Event Management</a></li>
        <li class="active"><i class="fa fa-list"></i>Activity Plan List</li>
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
              <h3 class="box-title">Activity Plan List</h3>
			</div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
                   <th>Sr No.</th>
				   <th>Event Name</th>
		           <th>Details</th>
                </tr>
                </thead>
                <tbody>
				<?php	
				$que="select * from event_activity_plan Group BY event_name";
				$run=mysqli_query($conn73,$que);
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				$s_no = $row['s_no'];
				$event_name = $row['event_name'];
				$activity_type = $row['activity_type'];
				$organiser = $row['organiser'];
				$objective = $row['objective'];
				$topic_theme = $row['topic_theme'];
				$venue = $row['venue'];
				$date_day = $row['date_day'];
				$category = $row['category'];
				$committee = $row['committee'];
				$incharge = $row['incharge'];
				$no_participants = $row['no_participants'];
				$name_participants = $row['name_participants'];
				$invitees = $row['invitees'];
				$review_event = $row['review_event'];
				$serial_no++;
				?>
                <tr>
                  <th><?php echo $serial_no; ?></th>
				  <th><?php echo $event_name; ?></th>
				<th><button type="button"  class="btn btn-default" onclick="post_content('event_management/activity_plan_details','<?php echo 'id='.$event_name; ?>');" >Details</button></th>
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
  