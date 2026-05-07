<?php include("../attachment/session.php")?>  <!DOCTYPE html>
<html>
<head>

  <?php include("../attachment/link_css.php")?>
</head>

<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>


  
  
  

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $language['Homework Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="../index.php"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="homework.php"><i class="fa fa-book"></i> <?php echo $language['Homework']; ?></a></li>
        <li class="active"><i class="fa fa-list"></i>  <?php echo $language['Homework List']; ?></li>
      </ol>
    </section>
	
	
	 

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $language['Homework List']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
	    <th><?php echo $language['S No']; ?></th>
		<th><?php echo $language['Class']; ?></th>
		<th><?php echo $language['Student Section']; ?></th>
        <th><?php echo $language['Homework']; ?></th>
        <th><?php echo $language['Date']; ?></th>
		<th><?php echo $language['Remark']; ?></th>
		<th><?php echo $language['Edit']; ?></th>
		<th><?php echo $language['Delete']; ?></th>
        </tr>
        </thead>
		
		<?php
include("../../con73/con37.php");

$que="select * from homework_student ORDER BY s_no DESC";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;

while($row=mysqli_fetch_assoc($run)){

	$s_no=$row['s_no'];
	$homework_class = $row['homework_class'];
	$homework_section = $row['homework_section'];
	$homework = $row['homework'];
	$homework_date = $row['homework_date'];
	$homework_remark = $row['homework_remark'];

		
	$serial_no++;
	
	$homework1 = substr($homework, 0, 20);
?>

<tr  align='center' >

	<th  ><?php echo $serial_no; ?></th>
	<th  ><?php echo $homework_class; ?></th>
	<th  ><?php echo $homework_section; ?></th>
	<th  ><?php echo $homework1; ?> <br><a href='homework_Detail.php?id=<?php echo $s_no; ?> '><button type="button" class="btn btn-default" ><?php echo $language['Read More']; ?>....</a></th>
	<th  ><?php echo $homework_date; ?></th>
	<th  ><?php echo $homework_remark; ?></th>
	
	<th><a href='homework_edit.php?id=<?php echo $s_no; ?> '><button type="button" class="btn btn-default " ><?php echo $language['Edit']; ?></th>
	<th><a href='homework_delete.php?id=<?php echo $s_no; ?> '><button type="button" class="btn btn-default" ><?php echo $language['Delete']; ?></th>
	
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
