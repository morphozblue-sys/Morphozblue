<?php include("../attachment/session.php"); ?>
<?php
$hostel_student_id=$_GET['id'];
?>
     <section class="content-header">
      <h1>
                <?php echo $language['Hostel Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="javascript:get_content('hostel/hostel')"><i class="fa fa-bed"></i> <?php echo $language['Hostel']; ?></a></li>
	    <li><a href="javascript:get_content('hostel/hostel_student_list')"><i class="fa fa-bed"></i><?php echo $language['Hostel Student List']; ?></a></li>
	    <li class="Active"><?php echo $language['Hostel Pay Fee Details']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Fees Details']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead >
                <tr>
                  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <th><?php echo $language['Room Charge Per Bed']; ?></th>
                  <th><?php echo $language['Mess Fee']; ?></th>
                  <th><?php echo $language['Laundry Charge']; ?></th>
                  <th><?php echo $language['Caution Money']; ?></th>
                  <th><?php echo $language['Total Charge']; ?></th>
                  <th><?php echo $language['Date']; ?></th>
                  <th><?php echo $language['Month']; ?></th>
                </tr>
                </thead>
                <tbody>
<?php


include("../../con73/con37.php");

$que="select * from hostel_fee_details where hostel_student_id='$hostel_student_id' and fee_status='Active'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    
	$s_no=$row['s_no'];
	$roll_number = $row['roll_number'];
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
        <td><?php echo $roll_number; ?></td>
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
  