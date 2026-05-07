<?php include("../attachment/session.php"); ?>
    <section class="content-header">
      <h1>
        <?php echo $language['Bus Management']; ?>
		    <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('bus/bus')"><i class="fa fa-truck"></i> Bus Management</a></li>
        <li class="active"><?php echo $language['Bus Details List']; ?></li>
      </ol>
    </section>

	<!---***********************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?> ">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Bus Details']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
	    <th><?php echo $language['S No']; ?></th>
        <th><?php echo $language['Bus Route']; ?></th>
        <th><?php echo $language['Start Stop Name']; ?></th>
        <th><?php echo $language['Start Route Timing']; ?></th>
        <th><?php echo $language['Bus No']; ?></th>
        <th><?php echo $language['Details']; ?></th>
		</tr>
        </thead>
		
		<?php

$que="select * from bus_route_details GROUP BY bus_route";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$bus_route = $row['bus_route'];
	$bus_stop_name = $row['bus_stop_name'];
	$bus_route_time = $row['bus_route_time'];
	$bus_no = $row['bus_no'];
	
$serial_no++;
?>

<tr  align='center'>

	<th ><?php echo $serial_no; ?></th>
	<th  ><?php echo $bus_route; ?></th>
	<th  ><?php echo $bus_stop_name; ?></th>
	<th  ><?php echo $bus_route_time; ?></th>
	<th  ><?php echo $bus_no; ?></th>
	
	<th><button type="button" class="btn btn-default " onclick="post_content('bus/bus_route_list_details','<?php echo 'id='.$bus_route; ?>');" ><?php echo $language['Details']; ?></th>
	
	</tr>
	
	<?php } ?>

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