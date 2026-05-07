<?php include("../attachment/session.php")?>  <!DOCTYPE html>
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
         Sports Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
       <li><a href="sports.php"#><i class="fa fa-futbol-o"></i> Sport Management</a></li>
       <li><i class="fa fa-list"></i> View Sports</li>
    </section>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
     <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-warning  ">
            <div class="box-header with-border ">
              <h3 class="box-title">Edit Sports Form</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
	<?php
$s_no=$_GET['id'];


include("../../con73/con37.php");

$que="select * from sports_table where sports_name='$s_no'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){

    $sports_name = $row['sports_name'];
	$sports_type = $row['sports_type'];
	$sports_activity = $row['sports_activity'];
	$sports_address	 = $row['sports_address'];
	
	$sports_date_1 = $row['sports_date'];
	$sports_date_2 = explode("-",$sports_date_1);
	$sports_date=$sports_date_2[2]."-".$sports_date_2[1]."-".$sports_date_2[0];
	
		}

?>		
            <div class="box-body "  >
			<form role="form" method="post" enctype="multipart/form-data">
			
			
			
			 <div class="col-md-6 ">
						<div class="form-group">
						  <label>Sports Name<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="sports_name" placeholder="Add Sports Name"  value="<?php echo $sports_name; ?>" class="form-control">
						</div>
				</div>
				
				<div class="col-md-6 ">				
					 <div class="form-group" >
					  <label >Sports Type<font style="color:red"><b>*</b></font></label>
					  <select class="form-control" name="sports_type">
					   <option><?php echo $sports_type; ?></option>
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
					  <label >Sports Activity<font style="color:red"><b>*</b></font></label>
					  <select class="form-control" name="sports_activity">
					   <option><?php echo $sports_activity; ?></option>
					 <option>Dancing</option>
					  <option>Singing</option>
					  <option>Painting</option>
					  <option>Poetry</option>
					  <option>Play</option>
					  
					  
					  </select>
					</div>
				  </div>
				
				<div class="col-md-3 ">
						<div class="form-group">
						  <label>Sports Date<font style="color:red"><b>*</b></font></label>
						   <input type="date"  name="sports_date" placeholder=""  value="<?php echo $sports_date; ?>" class="form-control">
						</div>
				</div>
				
				
				<div class="col-md-6 ">
						<div class="form-group">
						  <label>Sports Venue<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="sports_address" placeholder="Add Sports Venue Details" value="<?php echo $sports_address; ?>" class="form-control">
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

       
	$sports_name = $_POST['sports_name'];
	$sports_type = $_POST['sports_type'];
	$sports_activity = $_POST['sports_activity'];
	$sports_date_1 = $_POST['sports_date'];
	$sports_date_2 = explode("-",$sports_date_1);
	$sports_date=$sports_date_2[2]."-".$sports_date_2[1]."-".$sports_date_2[0];
	$sports_address = $_POST['sports_address'];
	
    
	 $quer="update sports_table set sports_name='$sports_name',sports_type='$sports_type',sports_activity='$sports_activity',sports_date='$sports_date',sports_address='$sports_address',$update_by_update_sql   where s_no='$s_no'";
  
 if(mysqli_query($conn73,$quer)){
	echo "<script>window.open('sports_list.php','_self');</script>";
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
