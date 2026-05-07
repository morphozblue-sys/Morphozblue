<?php include("../attachment/session.php"); ?>

			<?php
			
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			}
			?>
			<table cellspacing="0" cellpadding="5px;" class="" style="width:100%">
			<tr>
			<td colspan="3"><span style="font-size:20px;font-weight:bold"><center><b><?php echo $school_info_school_name; ?></b></center></span></td>
			</tr>
			<tr>
			<td style="float:left"><b>Dise Code : <?php echo $school_info_dise_code; ?></b></td>
			<td><center><b>BALANCE REPORT</b></center></td>
			<td style="float:right"><b>School Code : <?php echo $school_info_school_code; ?></b></td>
			</tr>
			<tr>
			<td style="float:left"><b><?php echo implode(", ",$_POST['month_name']); ?></b></td>
			</tr>
			</table>


<table id="example1" class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0">
<thead class="my_background_color">
<tr>
  <th>S.No.</th>
  <th>Admission No.</th>
  <th><?php echo $language['Student Name']; ?></th>
  <th><?php echo $language['Father Name']; ?></th>
  <th><?php echo 'Conatact details'; ?></th>
  <th><?php echo $language['Class']; ?></th>
  <th><?php echo $language['Roll No']; ?></th>
  <th><?php echo $language['Total Fee']; ?></th>
  <th>Total Fee Till Month</th>
  <th>Total Paid Till Month</th>
  <th>Remaining Fee Till Month</th>
  <!-- <th><?php echo $language['Details']; ?></th> -->
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
$fee[$serial_no11]="student_".$fee_code."_month";
$fee_balance[$serial_no11]="student_".$fee_code."_balance_month";
$fee_paid[$serial_no11]="student_".$fee_code."_paid_total_month";
$total_amount_after_discount[$serial_no11]="student_".$fee_code."_total_amount_after_discount_month";
$serial_no11++;
}
}


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
//if($month_code!=''){
//	$last_date=date($std_month.'-31');
//	$condition3=" and fee_submission_date<='$last_date'";
//}else{
//	$condition3="";
//}



$order_by = $_POST['order_by'];
if($order_by!=''){
if($order_by=='student_name' || $order_by=='student_father_name'){
$condition11 =" ORDER BY $order_by ASC";
}else{
$condition11 =" ORDER BY CAST($order_by AS UNSIGNED) ASC";
}
}else{
$condition11="";
}



$que2="select * from student_admission_info where session_value='$session1'$filter37 and student_status='Active' and registration_final='yes'$condition$condition2$condition11";
$run2=mysqli_query($conn73,$que2);
$serial_no=0;
$grand_total_total=0;
$grand_paid_total=0;
$grand_balance_total=0;
$grand_total_till_month=0;
$grand_paid_total_till_month=0;
$grand_balance_total_till_month=0;
while($row2=mysqli_fetch_assoc($run2)){
$student_roll_no=$row2['student_roll_no'];
$student_name=$row2['student_name'];
$student_father_name=$row2['student_father_name'];
$student_class=$row2['student_class'];
$student_class_section=$row2['student_class_section'];
$student_admission_number=$row2['student_admission_number'];
$school_roll_no=$row2['school_roll_no'];
$student_father_contact_number=$row2['student_father_contact_number'];
$student_father_contact_number2=$row2['student_father_contact_number2'];

$que1="select * from common_fees_student_fee where session_value='$session1' and fee_status='Active' and student_roll_no='$student_roll_no'$condition1";
$run1=mysqli_query($conn73,$que1);
if(mysqli_num_rows($run1)>0){
$total_till_month=0;
$paid_total_till_month=0;
$balance_total_till_month=0;
while($row1=mysqli_fetch_assoc($run1)){
$grand_total=$row1['grand_total'];
$paidtotal=$row1['paid_total'];
$grand_total_total=$grand_total_total+$grand_total;

for($as=0;$as<$month_count;$as++){
    
    for($ad=0;$ad<$serial_no11;$ad++){
        $total_till_month=$total_till_month+$row1[$total_amount_after_discount[$ad].$month_code[$as]];
        $grand_total_till_month=$grand_total_till_month+$row1[$total_amount_after_discount[$ad].$month_code[$as]];
        $paid_total_till_month=$paid_total_till_month+$row1[$fee_paid[$ad].$month_code[$as]];
        $grand_paid_total_till_month=$grand_paid_total_till_month+$row1[$fee_paid[$ad].$month_code[$as]];
        $balance_total_till_month=$balance_total_till_month+$row1[$fee_balance[$ad].$month_code[$as]];
        $grand_balance_total_till_month=$grand_balance_total_till_month+$row1[$fee_balance[$ad].$month_code[$as]];
    }
    
}

$total_till_month=$total_till_month+$row1['student_transport_fee'];
$grand_total_till_month=$grand_total_till_month+$row1['student_transport_fee'];
$paid_total_till_month=$paid_total_till_month+$row1['student_transport_fee_paid_total']+$row1['penalty_amount']+$row1['other_fee_amount'];
$paidtotal=$paidtotal+$row1['penalty_amount']+$row1['other_fee_amount'];
$grand_paid_total_till_month=$grand_paid_total_till_month+$row1['student_transport_fee_paid_total']+$row1['penalty_amount']+$row1['other_fee_amount'];
$balance_total_till_month=$balance_total_till_month+$row1['student_transport_fee_balance'];
$grand_balance_total_till_month=$grand_balance_total_till_month+$row1['student_transport_fee_balance'];

}

$serial_no++;
?>
<tr>
  <td><?php echo $serial_no; ?></td>
  <td><?php echo $student_admission_number; ?></td>
  <td><?php echo $student_name; ?></td>
  <td><?php echo $student_father_name; ?></td>
  <td><?php echo $student_father_contact_number.', '.$student_father_contact_number2; ?></td>
  <td><?php echo $student_class.'('.$student_class_section.')'; ?></td>
  <td><?php echo $school_roll_no; ?></td>
  <td><?php echo $grand_total; ?></td>
  <td><?php echo $total_till_month; ?></td>
  
  <?php if($_SESSION['software_link']=='chandausischool'){ ?>
	<td><?php echo $paidtotal; ?></td>
	<?php }else{ ?>
	<td><?php echo $paid_total_till_month; ?></td>
	<?php } ?>
	
  <td><?php echo $balance_total_till_month; ?></td>
  <!-- <td><button type="button"  onclick="post_content('fees_monthly/student_fee_balance_details_particular','<?php echo 'student_roll_no='.$student_roll_no; ?>')" class="btn btn-default my_background_color" >Balance Details</button></td> -->
</tr>
<?php } } ?>
</tbody>
<tfoot>
<tr>
  <td colspan="7"><center><b>Total</b></center></td>
  <td><b><?php echo $grand_total_total; ?></b></td>
  <td><b><?php echo $grand_total_till_month; ?></b></td>
  <td><b><?php echo $grand_paid_total_till_month; ?></b></td>
  <td><b><?php echo $grand_balance_total_till_month; ?></b></td>
</tr>
</tfoot>



</table>

<div class="col-md-12">
<div class="col-md-6">
<center><button type="button" class="btn my_background_color" onclick="exportTableToExcel('fee_details', 'Balance Report Monthly')"><i class="fa fa-print" aria-hidden="true"></i>  Print In Excel</button></center>
</div>
<div class="col-md-6">
<center><button type="button" class="btn my_background_color" onclick="for_print();"><i class="fa fa-print" aria-hidden="true"></i>  Print In Pdf</button></center>
</div>
</div>
<!--<script>-->
<!--$(function () {-->
<!--$('#example1').DataTable()-->
<!--})-->
<!--</script>-->
<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>