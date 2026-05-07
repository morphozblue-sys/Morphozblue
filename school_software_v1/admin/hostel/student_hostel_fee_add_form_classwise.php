<?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
<head>
  <?php include("../attachment/link_css.php"); ?>
<script>
function for_section(value){
if(value!='All'){
var val1=value.split('|?|');
var val2=val1[1];
$.ajax({
	  type: "POST",
	  url: access_link+"hostel/ajax_class_section_all.php?class_name="+val2+"",
	  cache: false,
	  success: function(detail){
		  $("#student_class_section").html(detail);
	  }
   });
}else{
$("#student_class_section").html("<option value='All'>All</option>");
}
}

function view_challans(){
var class_and_code=document.getElementById('class_code').value;
var section=document.getElementById('student_class_section').value;
var category_and_code=document.getElementById('category_code').value;
var installment_no=document.getElementById('installment_number').value;

if($('#remaining_amount').prop("checked") == true){
var remaining_amount11='Yes';
}else{
var remaining_amount11='No';
}

if($('#show_all_penalty11').prop("checked") == true){
var show_all_penalty11='Yes';
}else{
var show_all_penalty11='No';
}

if(installment_no!=''){

$.ajax({
type: "POST",
url: access_link+"hostel/ajax_get_hostel_challan_view_detail.php",
data: {class_and_code:class_and_code,section:section,category_and_code:category_and_code,installment_no:installment_no,show_all_penalty11:show_all_penalty11,remaining_amount11:remaining_amount11},
success: function(detail){
$('#for_view_challans').html(detail);
  }
});

}else{
if(installment_no==''){
alert_new('Please Select Installment !!!','red');
}
$('#for_view_challans').html('');
}
}

function for_check(id){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
}

function for_penalty(sno,value){
// var val=$('#student_rollno_'+sno).val();
// alert_new(val);
if($('#student_penalty_'+sno).is(':checked')){
$('#student_rollno_'+sno).val(value+'|?|Yes');
}else{
$('#student_rollno_'+sno).val(value+'|?|No');
}
}

function for_penalty_all(id){
var val1='';
var val2='';
if($('#'+id).is(':checked')){
$(".all_check").each(function() {
val1=$(this).val();
val2=val1.split('|?|');
$(this).val(val2[0]+'|?|Yes');
});
}else{
$(".all_check").each(function() {
val1=$(this).val();
val2=val1.split('|?|');
$(this).val(val2[0]+'|?|No');
});
}
}

function validate(){
var add1=0;
$(".all_check").each(function() {
if($(this).is(':checked')){
add1=add1+1;
}
});
if(add1<1){
alert_new('Please Select Atleast One Student !!!');
return false;
}else{
return true;
}
}

function for_print(detail,installment){
$('#student_print_installment').val(installment);
$('#student_print_detail').val(detail);
$('#print_button').click();
}

</script>
</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php"); ?>  <?php include("../attachment/sidebar.php"); ?>
<?php include("../../con73/con37.php"); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Classwise Hostel Fees Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Set Fee</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	<form method="post" enctype="multipart/form-data" onsubmit="">
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
			  
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
			  <div class="container-fluid">
			  <?php
				$qryy="select challan_no from student_hostel_fees_paid where session_value='$session1'";
				$resultt1=mysqli_query($conn73,$qryy);
				while($roww01=mysqli_fetch_assoc($resultt1)){
				$show_challan_no=$roww01['challan_no'];
				}
				?>
			  <h2>Classwise Hostel Fee Panel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Last Challan No. - <?php if(mysqli_num_rows($resultt1)>0){ echo $show_challan_no; } ?></small></h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
			    
			    <div class="col-sm-12">
			    <div class="col-sm-7">&nbsp;</div>
				<div class="col-sm-3">
				<span style="float:right;"><input type="checkbox" name="challan_remain_amount" id="remaining_amount" class="" /> <b>Remaining Challan Amount</b></span>
				</div>
			    <div class="col-sm-2">
				<span style="float:right;"><input type="checkbox" name="" id="show_all_penalty11" class="" checked /> <b>For Penalty</b></span>
				</div>
				</div>
			    <div class="col-sm-12">
				<div class="col-sm-3">
				<label>Class</label>
				<select name="class_code" id="class_code" style="width:100%;" class="form-control select2" onchange="for_section(this.value);" required >
				<option value="All">All Class</option>
				<?php
				$query2="select * from school_info_class_info where class_name!=''";
				$res2=mysqli_query($conn73,$query2);
				while($row2=mysqli_fetch_assoc($res2)){
				$class_name=$row2['class_name'];
				$class_code=$row2['class_code'];
				?>
				<option value="<?php echo $class_code.'|?|'.$class_name; ?>"><?php echo $class_name; ?></option>
				<?php } ?>
				</select>
				</div>
				<div class="col-sm-3">
				<label>Section</label>
				<select name="student_class_section" id="student_class_section" style="width:100%;" class="form-control select2" required >
				<option value="All">All</option>
				</select>
				</div>
				<div class="col-sm-3">
				<label>Category</label>
				<select name="category_code" id="category_code" style="width:100%;" class="form-control select2" required >
				<option value="All">All Category</option>
				<option value="category3|?|New Hostlers">New Hostlers</option>
				<option value="category4|?|Old Hostlers">Old Hostlers</option>
				</select>
				</div>
				
				<div class="col-sm-3">
				<label>Select Installment</label>
				<select name="installment_number" id="installment_number" style="width:100%;" class="form-control select2" required >
				<option value="">Select Installment</option>
				<option value="installment1">installment1</option>
				<option value="installment2">installment2</option>
				<option value="installment3">installment3</option>
				<option value="installment4">installment4</option>
				</select>
				</div>
				</div>
				<div class="col-sm-12">&nbsp;</div>
				
				<div class="col-sm-12">
				<center><button type="button" onclick="view_challans();" class="btn btn-info">View Challans</button>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" id="submit" value="Create Challans" class="btn btn-success" onclick="return validate();" /></center>
				</div>
				
			  </div>
			  </div>
			  </div>
			  </div>
			  <div class="col-sm-1"></div>
        </div>
		<div class="col-sm-12" id="for_view_challans">
		
		</div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
  </form>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="print_button" style="display:none;">Open Modal</button>
<!-- Modal -->
<form method="post" action="../pdf/challan_hostel_fee.php" enctype="multipart/form-data" target="_blank">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Print Mode</h4>
        </div>
        <div class="modal-body">
          <p>Print Current Generated Challan !!!</p>
		  <input type="hidden" name="student_print_detail" id="student_print_detail" value="" />
		  <input type="hidden" name="student_print_installment" id="student_print_installment" value="" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="my_close">Close</button>
          <input type="submit" name="submit" value="Print" class="btn btn-success" />
        </div>
      </div>
      
    </div>
  </div>
</form>
<!-- Modal -->
	
	<?php include("../attachment/footer.php"); ?>
 <?php include("../attachment/sidebar_2.php"); ?>
</div>
 <?php include("../attachment/link_js.php"); ?>

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

$query221="select * from school_info_hostel_head where fee_head_name!=''";
$result221=mysqli_query($conn73,$query221)or die(mysqli_error($conn73));
$fee_head_name21='';
$fee_head_code21='';
$fee_sno21=0;
while($row221=mysqli_fetch_assoc($result221)){
$fee_head_name21[$fee_sno21]=$row221['fee_head_name'];
$fee_head_code21[$fee_sno21]=$row221['fee_head_code'];
$fee_sno21++;
}
$installment_number=$_POST['installment_number'];
if($installment_number=='installment1'){
$start_month1=4;
$end_month1=6;
}elseif($installment_number=='installment2'){
$start_month1=7;
$end_month1=9;
}elseif($installment_number=='installment3'){
$start_month1=10;
$end_month1=12;
}elseif($installment_number=='installment4'){
$start_month1=1;
$end_month1=3;
}
$student_roll_no1=$_POST['student_roll_no'];
$msg_res=0;
$student_challan_no_print='';
$count2=count($student_roll_no1);
for($d=0;$d<$count2;$d++){
$student_roll_no2=explode('|?|',$student_roll_no1[$d]);
$student_roll_no3=$student_roll_no2[0];
$student_penalty=$student_roll_no2[1];

$query216="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no3' and installment_no='$installment_number' and session_value='$session1' or student_roll_no='$student_roll_no3' and all_fee='Yes' and session_value='$session1'";
$result216=mysqli_query($conn73,$query216)or die(mysqli_error($conn73));
if((mysqli_num_rows($result216)<1) || (isset($_POST['challan_remain_amount']))){
$query220="select * from student_admission_info where student_hostel='Yes' and session_value='$session1' and student_roll_no='$student_roll_no3'";
$res220=mysqli_query($conn73,$query220);
while($row220=mysqli_fetch_assoc($res220)){
$student_class=$row220['student_class'];
$student_fee_category_code=$row220['student_fee_category_code'];
}

// This Code For Hostel Fees Start
$query222="select * from student_hostel_fees_discount where student_roll_no='$student_roll_no3' and session_value='$session1'";
$result222=mysqli_query($conn73,$query222)or die(mysqli_error($conn73));
$fee_discount_percentage22='';
$dis_sno22=0;
if(mysqli_num_rows($result222)>0){
while($row222=mysqli_fetch_assoc($result222)){
for($e=0;$e<$fee_sno21;$e++){
$fee_discount_percentage22[$dis_sno22]=$row222[$fee_head_code21[$e].'_discount_amount'];
$dis_sno22++;
}
}
}else{
for($e=0;$e<$fee_sno21;$e++){
$fee_discount_percentage22[$dis_sno22]=0;
$dis_sno22++;
}
}

$query224="select * from expense_monthly where student_roll_no='$student_roll_no3' and session_value='$session1' and add_in_installment='$installment_number'";
$result224=mysqli_query($conn73,$query224)or die(mysqli_error($conn73));
$expense_total_amount24=0;
$expense_fee_amount24='';
$exp=0;
if(mysqli_num_rows($result224)>0){
while($row224=mysqli_fetch_assoc($result224)){
for($h=0;$h<$fee_sno21;$h++){
if($exp==0){
$expense_fee_amount24[$h]=0;
}
$expense_fee_amount24[$h]=$expense_fee_amount24[$h]+$row224[$fee_head_code21[$h]];
}
$total_amount24=$row224['total_amount'];
$expense_total_amount24=$expense_total_amount24+$total_amount24;
$exp++;
}
}else{
for($h=0;$h<$fee_sno21;$h++){
$expense_fee_amount24[$h]=0;
}
$total_amount24=0;
$expense_total_amount24=$expense_total_amount24+$total_amount24;
$exp++;
}

//This code for Remaining Challan Amount Start
if(isset($_POST['challan_remain_amount'])){
$query0223="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no3' and session_value='$session1' and installment_no='$installment_number'";
$result0223=mysqli_query($conn73,$query0223)or die(mysqli_error($conn73));
$fee_paid_headwise='';
$total_fee_paid_headwise=0;
while($row0223=mysqli_fetch_assoc($result0223)){
for($af=0;$af<$fee_sno21;$af++){
$fee_paid_headwise[$af]=$row0223[$fee_head_code21[$af]];
}
$fee_paid_amount0223=$row0223['total_amount'];
$total_fee_paid_headwise=$total_fee_paid_headwise+$fee_paid_amount0223;
}
}else{
$total_fee_paid_headwise=0;
for($af=0;$af<$fee_sno21;$af++){
$fee_paid_headwise[$af]=0;
}
}
//This code for Remaining Challan Amount End

$query223="select * from student_hostel_fees_structure_monthly where class_name='$student_class' and category_code='$student_fee_category_code'";
$result223=mysqli_query($conn73,$query223)or die(mysqli_error($conn73));
$final_fee_installment_amount23=0;
$final_fee_amount23=0;
$fee_installment_amount23=0;
$fee_paid_column_name='';
$fee_paid_column_value='';
while($row223=mysqli_fetch_assoc($result223)){
for($f=0;$f<$fee_sno21;$f++){
$fee_installment_amount23=0;
for($g=$start_month1;$g<=$end_month1;$g++){
$fee_minthly_amount23=$row223[$fee_head_code21[$f].'_month'.$g];
$fee_installment_amount23=$fee_installment_amount23+$fee_minthly_amount23;
}
$fee_discount_percentage123=$fee_discount_percentage22[$f];
$final_fee_installment_amount23=($final_fee_installment_amount23+$fee_installment_amount23)-(($fee_installment_amount23*$fee_discount_percentage123)/100);
$final_fee_amount23=($fee_installment_amount23+$expense_fee_amount24[$f])-(($fee_installment_amount23+$expense_fee_amount24[$f])*$fee_discount_percentage123)/100;
$final_fee_amount23=$final_fee_amount23-$fee_paid_headwise[$f];
$fee_paid_column_name=$fee_paid_column_name.",$fee_head_code21[$f]";
$fee_paid_column_value=$fee_paid_column_value.",$final_fee_amount23";
}
}

$total_installment_amount=$final_fee_installment_amount23+$expense_total_amount24-$total_fee_paid_headwise;

// This Code Is Use For Penalty Start
if($student_penalty=='Yes'){
$que23="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no3' and session_value='$session1'";
$run23=mysqli_query($conn73,$que23)or die(mysqli_error($conn73));
if(mysqli_num_rows($run23)>0){
while($row23=mysqli_fetch_assoc($run23)){
$installment_no23=$row23['installment_no'];
$verification_date1=$row23['verification_date'];
$verification_date=date_create($row23['verification_date']);
}
if($verification_date1=='0000-00-00'){
$verification_date2=date('Y-m-d');
$verification_date=date_create($verification_date2);
}
$que22="select * from hostel_due_date_schedule where student_due_installment='$installment_no23' and student_due_class='$student_class' and session_value='$session1'";
$run22=mysqli_query($conn73,$que22)or die(mysqli_error($conn73));
if(mysqli_num_rows($run22)>0){
while($row22=mysqli_fetch_assoc($run22)){
$student_due_date=$row22['student_due_date'];
$student_due_date1=date_create($row22['student_due_date']);
}
if($verification_date>$student_due_date1){
$diff=date_diff($verification_date,$student_due_date1);
$clear_difference=$diff->format("%a");
$due_date_month1=explode('-',$student_due_date);
$due_date_next_month=$due_date_month1[1]+1;
$day=cal_days_in_month(CAL_GREGORIAN,$due_date_next_month,$due_date_month1[0]);
if($clear_difference<=$day){
$penalty_amount22=250;
}else{
$penalty_amount22=500;
}
}else{
$penalty_amount22=0;
}
}else{
$penalty_amount22=0;
}
}else{
$penalty_amount22=0;
}
}else{
$penalty_amount22=0;
}
$total_installment_amount=$total_installment_amount+$penalty_amount22;
// This Code Is Use For Penalty End

// This Code For Hostel Fees end

$query218="select * from login";
$result218=mysqli_query($conn73,$query218)or die(mysqli_error($conn73));
while($row218=mysqli_fetch_assoc($result218)){
$session_challan_no=$row218['challan_no_'.$session1];
}
if($d==0){
$student_challan_no_print="$session_challan_no";
}else{
$student_challan_no_print=$student_challan_no_print.",$session_challan_no";
}

$query217="insert into student_hostel_fees_paid(student_roll_no,total_amount,installment_no,challan_no,payment_full_partial,ready_for_verify,penalty_amount,session_value,all_fee$fee_paid_column_name,$update_by_insert_sql_column) values('$student_roll_no3','$total_installment_amount','$installment_number','$session_challan_no','Full','Yes','$penalty_amount22','$session1','No'$fee_paid_column_value,$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query217)){
$msg_res=$msg_res+1;
$session_challan_no1=$session_challan_no+1;
$query219="update login set challan_no_$session1='$session_challan_no1'";
mysqli_query($conn73,$query219);
}
}else{
$msg_res=$msg_res-.5;
}
}

if($msg_res>0){
echo "<script>for_print('$student_challan_no_print','$installment_number');</script>";
}else{
echo "<script>alert_new('Already Exists This Record !!!');</script>";
echo "<script>window.open('student_hostel_fee_add_form_classwise.php','_self');</script>";
}
}
?>