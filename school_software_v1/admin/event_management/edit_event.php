<?php include("../attachment/session.php")?> <!DOCTYPE html>
<html>
<head>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> 
<?php include("../attachment/header.php")?> 
 <?php include("../attachment/sidebar.php")?>


  
  
  

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Event Management
	   <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
	   <li><a href="event_management.php"#><i class="fa fa-calendar-check-o"></i> Event Management</a></li>
	   <li><a href="event_list.php"#><i class="fa fa-list"></i> Event List</a></li>
        <li class="active"><i class="fa fa-edit"></i> Edit</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title">Edit Event Form</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
	<?php
$s_no=$_GET['id'];


include("../../con73/con37.php");

$que="select * from event_table where s_no='$s_no'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

    $event_name = $row['event_name'];
	$event_type = $row['event_type'];
	$event_activity = $row['event_activity'];
	$event_address	 = $row['event_address'];
	
	$event_date_1 = $row['event_date'];
	$event_date_2 = explode("-",$event_date_1);
	$event_date=$event_date_2[2]."-".$event_date_2[1]."-".$event_date_2[0];
	
		}

?>		
            <div class="box-body "  >
			<form role="form" method="post" enctype="multipart/form-data">
			
			
			
			 <div class="col-md-6 ">
						<div class="form-group">
						  <label>Event Name</label>
						   <input type="text"  name="event_name" placeholder="Add Event Name"  value="<?php echo $event_name; ?>" class="form-control" required />
						</div>
				</div>
				
				<div class="col-md-6 ">				
					 <div class="form-group" >
					  <label >Event Type</label>
					  <select class="form-control" name="event_type">
					   <option><?php echo $event_type; ?></option>
					  <option>Teacher Day</option>
					  <option>Republic Day</option>
					  <option>Independance Day</option>
					  <option>Anual Function</option>
					  <option>Technical Quiz</option>
					  <option>Technical Funtion</option>
					  <option>Singing</option>
					  <option>Dancing</option>
					  </select>
					</div>
				  </div>
				
				 <br> <br> <br> <br> <br> 

				<div class="col-md-3 ">				
					 <div class="form-group" >
					  <label >Event Activity</label>
					 <input type="text" name="event_activity" value="<?php echo $event_activity; ?>" class="form-control">
					  
					  </select>
					</div>
				  </div>
				
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Event Date</label>
						   <input type="date"  name="event_date" placeholder=""  value="<?php echo $event_date; ?>" class="form-control">
						</div>
				</div>
				
				
				<div class="col-md-6 ">
						<div class="form-group">
						  <label>Event Venue</label>
						   <input type="text"  name="event_address" placeholder="Add Event Venue Details" value="<?php echo $event_address; ?>" class="form-control" required  />
						</div>
				</div>

				
				<div class="col-md-12">
		        <center><input type="submit" name="finish" value="Submit" class="btn btn-primary" /></center>
		  </div>
	</div>
		</form>	
		
	
<?php


include("../../con73/con37.php");

if(isset($_POST['finish'])){

       
	$event_name = $_POST['event_name'];
	$event_type = $_POST['event_type'];
	$event_activity = $_POST['event_activity'];
	$event_date_1 = $_POST['event_date'];
	$event_date_2 = explode("-",$event_date_1);
	$event_date=$event_date_2[2]."-".$event_date_2[1]."-".$event_date_2[0];
	$event_address = $_POST['event_address'];
	
    
	 $quer="update event_table set event_name='$event_name',event_type='$event_type',event_activity='$event_activity',event_date='$event_date',event_address='$event_address',$update_by_update_sql   where s_no='$s_no'";
  
 if(mysqli_query($conn73,$quer)){
	echo "<script>window.open('event_list.php','_self');</script>";
}
 }

	?>	

<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
    <!-- /.content -->
  </div>
    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
