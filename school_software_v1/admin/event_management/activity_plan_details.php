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
	url: access_link+"event_management/activity_plan_dlt.php?id="+s_no+"",
	cache: false,
	success: function(detail){
	var res=detail.split("|?|");
	if(res[1]=='success'){
	   alert_new('Successfully Deleted','green');
	   get_content('event_management/activity_plane_list');
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
         Activity Plan List
	   <small>Control Panel</small> 
      </h1>
      <ol class="breadcrumb">
       <li><a href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a></li>
	    <li><a href="javascript:get_content('event_management/event_management')"><i class="fa fa-calendar-check-o"></i> Event Management</a></li>
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
                   <th>Serial No.</th>
				   <th>Event Name</th>
				   <th>Name</th>
				   <th>Delete</th>
				  
                </tr>
                </thead>
                <tbody>
                 <?php
				 
$event_name=$_GET['id'];	
$que="select * from event_activity_plan where event_name='$event_name' ORDER BY s_no DESC";
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
				<th><?php echo $name_participants; ?></th>
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
    <!-- /.content -->
 <script>
$(function(){
$('#example1').DataTable()
})
</script>
