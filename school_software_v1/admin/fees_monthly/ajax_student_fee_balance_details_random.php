<?php include("../attachment/session.php"); ?>
<script>
function for_print()
 {
 var divToPrint=document.getElementById("printable");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
</script>
<?php
$transport_head_yearly=$_POST['transport_head_yearly'];
$transport_head_monthly=$_POST['transport_head_monthly'];
$previous_head_yearly=$_POST['previous_head_yearly'];
?>
<div id='printable'>
<table class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
<thead class="my_background_color">
<tr>
  <th>S.No</th>
  <th>Admission No.</th>
  <th><?php echo $language['Student Name']; ?></th>
  <th><?php echo $language['Father Name']; ?></th>
  <th>Class (Sec.)</th>
  
  <th>Contact No</th>
  <th>Address</th>
  
  <th>Month</th>
  <th>Remaining Fee Till Inst</th>
  <?php if($transport_head_yearly=='transport_head_yearly'){ ?>
  <th>Transport Yearly</th>
  <?php } ?>
  <?php if($transport_head_monthly!=''){ ?>
  <th>Transport Month</th>
  <?php } ?>
  <?php if($previous_head_yearly=='previous_head_yearly'){ ?>
  <th>Previous Year Dues Fee</th>
  <?php } ?>
  <th>Total</th>
</tr>
</thead>
<tbody>

<?php
$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
$run=mysqli_query($conn73,$que);
$serial_no11=0;
while($row=mysqli_fetch_assoc($run)){

$s_no=$row['s_no'];
$fee_type5 = $row['fee_type'];
$fee_code = $row['fee_code'];
if($fee_type5!=''){
$fee_type = preg_replace('/\s+/', '_', $fee_type5);
$fee_type1[$serial_no11] = $row['fee_type'];
$fee_type=strtolower($fee_type);
$fee_code11[$serial_no11] = $row['fee_code'];
$fee[$serial_no11]="student_".$fee_code."_month";
$fee_balance[$serial_no11]="student_".$fee_code."_balance_month";
$fee_paid[$serial_no11]="student_".$fee_code."_paid_total_month";
$total_amount_after_discount[$serial_no11]="student_".$fee_code."_total_amount_after_discount_month";
$serial_no11++;
}
}

$month_detail=['01'=>'January  ','02'=>'February  ','03'=>'March  ','04'=>'April  ','05'=>'May  ','06'=>'June  ','07'=>'July  ','08'=>'August  ','09'=>'September  ','10'=>'October  ','11'=>'November  ','12'=>'December '];

$student_class=$_POST['student_class'];
if($student_class!='All'){
	$condition=" and student_class='$student_class'";
	$condition1=" and student_class='$student_class'";
}else{
	$condition="";
	$condition1="";
}
$student_section=$_POST['student_section'];
if($student_section!='All'){
	$condition2=" and student_class_section='$student_section'";
}else{
	$condition2="";
}
$month_code=$_POST['month_code'];
$month_count=count($month_code);

$que2="select * from student_admission_info where session_value='$session1' and student_status='Active' and registration_final='yes'$condition$condition2 order by student_name asc";
$run2=mysqli_query($conn73,$que2);
$serial_no=0;
$grand_total_total=0;
$grand_paid_total=0;
$grand_balance_total=0;

$grand_total_till_month=0;
$grand_total_student_transport_fee_balance=0;
$grade_total_studentwise_total_balance=0;
while($row2=mysqli_fetch_assoc($run2)){
$student_roll_no=$row2['student_roll_no'];
$student_name=$row2['student_name'];
$student_father_name=$row2['student_father_name'];
$student_class=$row2['student_class'];
$student_class_section=$row2['student_class_section'];
$student_admission_number=$row2['student_admission_number'];

$student_father_contact_number=$row2['student_father_contact_number'];
$student_adress=$row2['student_adress'];

$que1="select * from common_fees_student_fee where session_value='$session1' and fee_status='Active' and balance_total > '0' and student_roll_no='$student_roll_no'$condition1";
$run1=mysqli_query($conn73,$que1);
if(mysqli_num_rows($run1)>0){
$total_till_month=0;
$paid_total_till_month=0;
$balance_total_till_month=0;
while($row1=mysqli_fetch_assoc($run1)){
$grand_total=$row1['grand_total'];
$grand_total_total=$grand_total_total+$grand_total;

$studentwise_total_balance=0;
$all_month_detail='';
$comma='';
$transport_monthly_amt=0;
for($as=0;$as<$month_count;$as++){
    
    for($ad=0;$ad<$serial_no11;$ad++){
        $total_till_month=$total_till_month+$row1[$total_amount_after_discount[$ad].$month_code[$as]];
        // $grand_total_till_month=$grand_total_till_month+$row1[$total_amount_after_discount[$ad].$month_code[$as]];
        $paid_total_till_month=$paid_total_till_month+$row1[$fee_paid[$ad].$month_code[$as]];
        // $grand_paid_total_till_month=$grand_paid_total_till_month+$row1[$fee_paid[$ad].$month_code[$as]];
        $balance_total_till_month=$balance_total_till_month+$row1[$fee_balance[$ad].$month_code[$as]];
        // $grand_balance_total_till_month=$grand_balance_total_till_month+$row1[$fee_balance[$ad].$month_code[$as]];
        if($transport_head_monthly!='' && $fee_code11[$ad]==$transport_head_monthly){
        $transport_monthly_amt=$transport_monthly_amt+$row1[$fee_balance[$ad].$month_code[$as]];
        }
    }
    $all_month_detail=$all_month_detail.$comma.$month_detail[$month_code[$as]];
    $comma=',';
}

$studentwise_total_balance=$studentwise_total_balance+$balance_total_till_month;
if($transport_head_monthly!=''){
$balance_total_till_month=$balance_total_till_month-$transport_monthly_amt;
}
$student_transport_fee_balance=$row1['student_transport_fee_balance'];
$student_previous_year_fee_balance=$row1['student_previous_year_fee_balance'];
if($transport_head_yearly=='transport_head_yearly'){
$studentwise_total_balance=$studentwise_total_balance+$student_transport_fee_balance;
}
if($previous_head_yearly=='previous_head_yearly'){
$studentwise_total_balance=$studentwise_total_balance+$student_previous_year_fee_balance;
}

// $total_till_month=$total_till_month+$row1['student_transport_fee'];
// $grand_total_till_month=$grand_total_till_month+$row1['student_transport_fee'];
// $paid_total_till_month=$paid_total_till_month+$row1['student_transport_fee_paid_total']+$row1['penalty_amount']+$row1['other_fee_amount'];
// $grand_paid_total_till_month=$grand_paid_total_till_month+$row1['student_transport_fee_paid_total']+$row1['penalty_amount']+$row1['other_fee_amount'];
// $balance_total_till_month=$balance_total_till_month+$row1['student_transport_fee_balance'];
// $grand_balance_total_till_month=$grand_balance_total_till_month+$row1['student_transport_fee_balance'];
   $grand_total_till_month+=$balance_total_till_month;
   $grand_total_student_transport_fee_balance+=$transport_monthly_amt;
   $grade_total_studentwise_total_balance+=$studentwise_total_balance;
}

$serial_no++;
?>
<tr>
  <td><?php echo $serial_no; ?></td>
  <td><?php echo $student_admission_number; ?></td>
  <td><?php echo $student_name; ?></td>
  <td><?php echo $student_father_name; ?></td>
  <td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
  
  <td><?php echo $student_father_contact_number; ?></td>
  <td><?php echo $student_adress; ?></td>
  
  <td><?php echo $all_month_detail; ?></td>
  <td><?php echo $balance_total_till_month; ?></td>
  <?php if($transport_head_yearly=='transport_head_yearly'){ ?>
  <td><?php echo $student_transport_fee_balance; ?></td>
  <?php } ?>
  <?php if($transport_head_monthly!=''){ ?>
  <td><?php echo $transport_monthly_amt; ?></td>
  <?php } ?>
  <?php if($previous_head_yearly=='previous_head_yearly'){ ?>
  <td><?php echo $student_previous_year_fee_balance; ?></td>
  <?php } ?>
  <td><?php echo $studentwise_total_balance; ?></td>
</tr>
<?php } } ?>
</tbody>

 <tfoot>
<tr>
  <td colspan="8"><center><b>Total  </b></center></td>
  <td><b><?php echo $grand_total_till_month; ?></b></td>
  <td><b><?php echo $grand_total_student_transport_fee_balance; ?></b></td>
  <td><b><?php echo $grade_total_studentwise_total_balance; ?></b></td>
</tr>
</tfoot> 

</table>
</div>
 <div class="col-md-12">
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('printable', 'Balance Report')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
			  </div>
			  <div class="col-md-6">
			  <center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
			  </div>
</div>
