<?php include("../attachment/session.php"); ?>
<table id="example1" class="table table-bordered table-striped">
<thead >
                <tr>

<?php
$que12="select * from school_info_pdf_info";
$run12=mysqli_query($conn73,$que12) or die(mysqli_error($conn73));
while($row12=mysqli_fetch_assoc($run12)){
$hostal_feereciept=$row12['hostal_feereciept'];
}

 $from = $_GET['from'];
 $from1=explode('-',$from);
 $from2=$from1[2].'-'.$from1[1].'-'.$from1[0];
 $to = $_GET['to'];
 $to1=explode('-',$to);
 $to2=$to1[2].'-'.$to1[1].'-'.$to1[0];

$que="select * from hostel_fee_details where pay_date>='$from2' and pay_date<='$to2' and fee_status='Active'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$pay_hostel_charge=0;
while($row=mysqli_fetch_assoc($run)){

		$pay_hostel_charge+=$row['pay_hostel_charge'];
	
		}
?>

   <tr>
	<th colspan='7' align='center' ><font color="#f1f1f1">Hostel STUDENT FEE Details</th>
	<th colspan='3' align='center' ><font color="black">Total Amount of Hostelers</th>
	<th colspan='2' align='center' ><font color="black"><?php echo $pay_hostel_charge; ?>/-</th>
   </tr>
                  <th>SNo</th>
                  <th>Student Name</th>
                  <th>Roll No</th>
                  <th>Room Charge Per Bed</th>
                  <th>Mess Fee</th>
                  <th>Laundry Charge</th>
                  <th>Caution Money</th>
                  <th>Total Charge</th>
                  <th>Date</th>
                  <th>Month</th>
                  <th>Print</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
<?php
$que1="select * from hostel_fee_details where pay_date>='$from2' and pay_date<='$to2' and fee_status='Active'";
$run1=mysqli_query($conn73,$que1);
$serial_no=0;
while($row1=mysqli_fetch_assoc($run1)){
    
	$s_no=$row1['s_no'];
	$hostel_student_name = $row1['hostel_student_name'];
	$hostel_student_id = $row1['hostel_student_id'];
	$roll_number = $row1['roll_number'];
	$pay_hostel_room_charge = $row1['pay_hostel_room_charge'];
	$pay_mess_fee = $row1['pay_mess_fee'];
	$pay_laundry_charge = $row1['pay_laundry_charge'];
	$pay_caution_money = $row1['pay_caution_money'];
	$pay_hostel_charge = $row1['pay_hostel_charge'];
	
	$pay_date = $row1['pay_date'];
	
	
	$month_pay = $row1['month_pay'];
	
	
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
        <td><a target="_blank" href='<?php echo $pdf_path; ?>Hostal_feereciept/<?php echo $hostal_feereciept; ?>?s_no1=<?php echo $s_no; ?>&roll_no=<?php echo $roll_number; ?>'><button type="button" class="btn btn-success"><?php echo $language['Print']; ?></button></a></td>
        <td><button type="button" onclick="return valid('<?php echo $s_no; ?>');" class="btn btn-success">Delete</button></td>
    </tr>
        <?php } ?>
                </tbody>
                </table>