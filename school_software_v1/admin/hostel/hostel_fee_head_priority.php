<?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
<head>
 
  <?php include("../attachment/link_css.php")?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>
<?php include("../../con73/con37.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Fee Head Priority Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Set Priority</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	<form method="post" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-sm-12">&nbsp;</div>
              <div class="col-sm-12">
			  
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
			  <div class="container-fluid">
			  <h2>Hostel Fee Head Priority Panel</h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
			    <div class="col-sm-12">
				
				<table class="table table-bordered table-striped">
				<thead >
				<tr>
				<td>#</td>
				<td>Fee Head Name</td>
				<td>Set Priority</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$query="select * from school_info_hostel_head where fee_head_name!='' ORDER BY fee_head_priority ASC";
				$result=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($result)){
				$fee_head_code=$row['fee_head_code'];
				$fee_head_name=$row['fee_head_name'];
				$fee_head_priority=$row['fee_head_priority'];
				$serial_no++;
				?>
				<tr>
				<td><b><?php echo $serial_no.'.'; ?></b><input type="hidden" name="fee_head_code[]" class="form-control" value="<?php echo $fee_head_code;; ?>" readonly /></td>
				<td><input type="text" name="fee_head_name[]" class="form-control" value="<?php echo $fee_head_name; ?>" readonly /></td>
				<td><input type="text" name="fee_head_priority[]" class="form-control" value="<?php echo $fee_head_priority; ?>" placeholder="Priority" /></td>
				</tr>
				<?php
				}
				?>
				</tbody>
				<tfoot>
				
				<tr>
				<td colspan="3"><center><input type="submit" name="submit" value="Update" class="btn btn-success" /></center></td>
				</tr>
				
				</tfoot>
				</table>
				
				</div>
			  </div>
			  </div>
			  </div>
			  </div>
			  <div class="col-sm-2"></div>
			  
			  </div>
			</div>
		</div>
	</div>
  </div>
      <!-- /.row -->
  </section>
  </form>
  </div>
    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
 <?php include("../attachment/link_js.php")?>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
</body>
</html>
<?php
if(isset($_POST['submit'])){
$fee_head_code=$_POST['fee_head_code'];
$fee_head_name=$_POST['fee_head_name'];
$fee_head_priority=$_POST['fee_head_priority'];
$count1=count($fee_head_code);
for($i=0;$i<$count1;$i++){
$query1="update school_info_hostel_head set fee_head_priority='$fee_head_priority[$i]',$update_by_update_sql  where fee_head_code='$fee_head_code[$i]'";
mysqli_query($conn73,$query1);
}
echo "<script>alert_new('Successfully Set Priority !!!');</script>";
echo "<script>window.open('hostel_fee_head_priority.php','_self');</script>";
}
?>