<!DOCTYPE html>
<?php
include("../../con73/con37.php");
$que="select * from admin";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_array($run)){
	$s_no = $row['s_no'];
	$username = $row['username'];
	$designation = $row['designation'];
	$password = $row['password'];
	$contact = $row['contact'];
	$image = $row['image'];
	$path="../../documents/admin/".$image;	
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <?php include("link_css.php")?>

</head>
<body class="hold-transition skin-green sidebar-collapse sidebar-mini">
<div class="wrapper">  
  <?php include("header.php")?>
  <?php include("sidebar.php")?>  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Profile From</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->			
            <div class="box-body "  >
			<form method="post" enctype="multipart/form-data" action="">
			 <div class="col-md-4 ">
			 </div>
			 <div class="col-md-4 ">
						<div class="form-group">
						  <label>Username<font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="username"   placeholder="Username"  value="<?php echo $username; ?>" class="form-control " >
						</div>
						
						<div class="form-group">
						  <label>Designation</label>
						   <input type="text"  name="designation"  placeholder="Designation"  value="<?php echo $designation; ?>" class="form-control">
						</div>
							
						<div class="form-group">
						  <label>Password</label>
						   <input type="text" name="password" placeholder="Password"  value="<?php echo $password; ?>" class="form-control">
							</div>
						<div class="form-group" >
						  <label>Contact</label>
						  <input type="text"  name="contact" placeholder="Contact"  value="<?php echo $contact; ?>" class="form-control">
						</div>
				
						<div class="form-group" >
						  <label>Profile Photo</label>
						  <input type="file" name="profile_image" class="form-control"><img src="<?php echo $path; ?>" height="70" width="70">
						</div>
				  </div>
				<div class="col-md-4 ">
		
           		
		  </div>
		  <div class="col-md-12">
		        <center><input type="submit" name="submit" value="Submit" class="btn  my_background_color" /></center>
		  </div>
		</form>	
		
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("footer.php")?>
 <?php include("sidebar_2.php")?>
</div>
 <?php include("link_js.php")?>
</body>
</html>
<?php
include("../../connection/connect.php");
	if(isset($_POST['submit'])){	
	echo "<script>document.getElementById('submit').disabled = true</script>";	
	$username = $_POST['username'];
	$designation = $_POST['designation'];
	$password = $_POST['password'];
	$contact = $_POST['contact'];	
	//-----------------------------------profile photo-----------------//
	$path1="../../documents/admin/";	
	$image_name=$_FILES['profile_image']['name'];            
	$image_temp=$_FILES['profile_image']['tmp_name'];	
	if($image_name==null){
	$image_name=$image;
	}
	else{
	move_uploaded_file($image_temp,$path1.'/'.$image_name);
	}
	
	//-----------------------------------profile photo-----------------//	
 echo $quer="update admin set username='$username',designation='$designation',password='$password',contact='$contact',image='$image_name'";
if(mysqli_query($conn73,$quer)){
	echo "<script>window.open('../index.php','_self');</script>";
}

}

	?>	