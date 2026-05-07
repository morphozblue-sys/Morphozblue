<?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
<?php
error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
<head>
   <?php include("../attachment/link_css.php"); ?>
<script>
function for_post(value){
if(value!=''){
var value1=value.split('|?|');
window.open('hostel_fee_structure.php?category_name='+value1[1]+'&category_code='+value1[0],'_self');
}
}
</script>
</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php"); ?>  <?php include("../attachment/sidebar.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Fees Structure
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Fees Structure</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
	 
	 <div class="box <?php echo $box_head_color; ?>" >
		<div class="box-body">
		<div class="col-sm-12">
		<div class="col-sm-6">
		<div class="form-group">
			<label>Choose Category</label>
		    <select name="fee_head_name" class="form-control select2" onchange="for_post(this.value);" required>
			<option <?php if(isset($_GET['category_code'])){ if($_GET['category_code']=='category3'){ echo 'selected'; } } ?> value="category3|?|New Hostlers" >New Hostlers</option>
			<option <?php if(isset($_GET['category_code'])){ if($_GET['category_code']=='category4'){ echo 'selected'; } } ?> value="category4|?|Old Hostlers" >Old Hostlers</option>
			</select>
            </div>
		    </div>
		</div>
		</div>
		</div>

        
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			<div class="col-md-12">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <td>#</td>
				   <td>Class</td>
				   <td>Catagory</td>
				<?php				
                include("../../con73/con37.php");

                $que="select * from school_info_hostel_head where fee_head_type='Regular' ORDER BY fee_head_priority";
                $run=mysqli_query($conn73,$que);
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$fee_head_name = $row['fee_head_name'];
				$fee_head_code = $row['fee_head_code'];
				if($fee_head_name!=''){
				$fee_head_column_name[$serial_no]=$fee_head_code.'_per_year';
			
				$serial_no++;
				?>
				  <td><?php echo $fee_head_name; ?></td>
				  <?php } } ?>
				  <td>Total Fee</td>
				  <td>Action</td>
                </tr>
                </thead>
                <tbody>
              
				<?php
				if(isset($_GET['category_name'])){
				$category_name=$_GET['category_name'];
				}else{
				$category_name='New Hostlers';
				}
			    $que3="select * from school_info_class_info";
                $run3=mysqli_query($conn73,$que3);
				$serial_class=0;
                while($row3=mysqli_fetch_assoc($run3)){
				$student_class=$row3['class_name'];
				$class_code=$row3['class_code'];
				$serial_class++;
				?>
				<tr>
				 <td><?php echo $serial_class; ?></td>
				 <td><?php echo $student_class; ?></td>
				 <td><?php echo $category_name; ?></td>
				<?php
				$total_amount=0;
				if(isset($_GET['category_code'])){
            $category_code=$_GET['category_code'];
          $category_name=$_GET['category_name'];
                }else{
				$category_code='category3';
                $category_name='New Hostlers';
				}
			 
				$que5="select * from student_hostel_fees_structure where category_code='$category_code' and class_code='$class_code'";
                $run5=mysqli_query($conn73,$que5) or die(mysqli_error($conn73));
				$fee_main_head_amount=0;
                while($row5=mysqli_fetch_assoc($run5)){
				  for($m=0;$m<$serial_no;$m++){
				$fee_main_head_amount=$row5[$fee_head_column_name[$m]];
				$total_amount=$total_amount+$fee_main_head_amount;
				?>
				 <td><?php echo $fee_main_head_amount; ?></td>
				 <?php }
                        } ?>
						 <td><?php echo  $total_amount; ?></td>
                    <td><a href='hostel_fee_structure_details.php?id=<?php echo $class_code; ?>&category_code=<?php echo $category_code; ?>&category_name=<?php echo $category_name; ?>&student_class=<?php echo $student_class; ?>'><button type="button" class="btn btn-success">
                Edit</button></td>
                </tr>
                <?php
				
				} ?>
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
      'lengtdChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidtd'   : false
    })
  })
</script>
</body>
</html>
