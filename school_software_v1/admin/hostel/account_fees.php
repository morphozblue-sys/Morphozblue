<?php include("../attachment/session.php")?>

<!DOCTYPE html>
<html>
<head>
<?php include("../attachment/link_css.php")?>

</head>

<?php include("../attachment/header.php")?>
<?php include("../attachment/sidebar.php")?>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">


  


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
	    <li class="Active">Account Fees</li>
      </ol>
    </section>
	

	<!---************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
         <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-header with-border">
              <h3 class="box-title">Fee Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th>SNo</th>
                  <th>Student Name</th>
                  <th>Unique Id</th>
                  <th>Room Charge Per Bed</th>
                  <th>Mess Fee</th>
                  <th>Laundry Charge</th>
                  <th>Caution Money</th>
                  <th>Total Charge</th>
                  <th>Date</th>
                  <th>Month</th>
                </tr>
                </thead>
                <tbody>
<?php


include("../../con73/con37.php");

$que="select * from hostel_fee_details";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    
	$s_no=$row['s_no'];
	$hostel_student_name = $row['hostel_student_name'];
	$hostel_student_id = $row['hostel_student_id'];
	$pay_hostel_room_charge = $row['pay_hostel_room_charge'];
	$pay_mess_fee = $row['pay_mess_fee'];
	$pay_laundry_charge = $row['pay_laundry_charge'];
	$pay_caution_money = $row['pay_caution_money'];
	$pay_hostel_charge = $row['pay_hostel_charge'];
	$pay_date = $row['pay_date'];
	$month_pay = $row['month_pay'];
	
	
	$serial_no++;
?>

    <tr>
	    <td><?php echo $serial_no; ?></td>
        <td><?php echo $hostel_student_name; ?></td>
        <td><?php echo $hostel_student_id; ?></td>
        <td><?php echo $pay_hostel_room_charge; ?></td>
        <td><?php echo $pay_mess_fee; ?></td>
        <td><?php echo $pay_laundry_charge; ?></td>
        <td><?php echo $pay_caution_money; ?></td>
        <td><?php echo $pay_hostel_charge; ?></td>
        <td><?php echo $pay_date; ?></td>
        <td><?php echo $month_pay; ?></td>
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
