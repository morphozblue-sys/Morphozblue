<?php include("../attachment/session.php")?>
<!DOCTYPE html>
<html>
<head>
 <?php include("../attachment/link_css.php"); ?>

  <!-- Google Font -->
 
</head>
<script>
function valid()
{
var myval=confirm("Are you sure want to parmanently delete this record !!!!");
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
<?php include("../attachment/header.php"); ?>
<?php include("../attachment/sidebar.php"); ?>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

 

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
             Hostel Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="hostel.php"><i class="fa fa-bed"></i> Hostel</a></li>
	    <li class="Active">Expense List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Expense List</h3><a href="expense_monthly.php"><span style="float:right;"><button type="button" class="btn btn-success">Add Expense</button></span></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
				<?php
				include("../../con73/con37.php");
				$que5="select * from school_info_hostel_head where fee_head_name !='' and fee_head_type !='Regular'";
				$run5=mysqli_query($conn73,$que5);
				$sl_no=0;
				while($row5=mysqli_fetch_assoc($run5)){
				$fee_head_name[$sl_no]=$row5['fee_head_name'];
				$fee_head_code[$sl_no]=$row5['fee_head_code'];
				$sl_no++;
				}
				?>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Date</th>
				  <?php for($i=0;$i<$sl_no;$i++){ ?>
                  <th><?php echo $fee_head_name[$i]; ?></th>
                  <?php } ?>
				  <th>Total</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
<?php
$que="select * from expense_monthly where session_value='$session1' ORDER BY s_no DESC";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
		$s_no=$row['s_no'];
		$student_roll_no=$row['student_roll_no'];
		$create_date=$row['create_date'];
		$create_time=$row['create_time'];
		$create_date1=explode('-',$create_date);
		$create_date2=$create_date1[2].'-'.$create_date1[1].'-'.$create_date1[0];
		$total_amount=$row['total_amount'];
		for($j=0;$j<$sl_no;$j++){
		$row[$fee_head_code[$j]];
		}
		$add_in_challan=$row['add_in_challan'];
		
	$serial_no++;
$que1="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$student_name=$row1['student_name'];
$student_class=$row1['student_class'];
$student_class_section=$row1['student_class_section'];
}
?>
<tr>
    <td><?php echo $serial_no.'.'; ?></td>
	<td><?php echo $student_name; ?></td>
	<td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
	<td><?php echo $create_date2; ?></td>
	<?php
	for($j=0;$j<$sl_no;$j++){
	$fees=$row[$fee_head_code[$j]];
	?>
	<td><?php echo $fees; ?></td>
	<?php } ?>
	<td><?php echo $total_amount; ?></td>
<td><a href='expense_monthly_edit.php?s_no=<?php echo $s_no; ?>'><button type="button" class="btn btn-success" <?php if($add_in_challan=='Yes'){ echo 'disabled'; } ?> >Edit</button> <a href='expense_monthly_delete.php?s_no=<?php echo $s_no; ?>'><button type="button" class="btn btn-danger" onclick="return valid();" <?php if($add_in_challan=='Yes'){ echo 'disabled'; } ?> >Delete</button></td>
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
  </div>
<script>
  $(function () {
    $('#example1').DataTable()
  
  });
</script>
  
<?php include("../attachment/footer.php"); ?>
<?php include("../attachment/sidebar_2.php");?>
<?php include("../attachment/link_js.php"); ?>