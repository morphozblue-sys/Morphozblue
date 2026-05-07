<?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
<head>
<?php include("../attachment/link_css.php"); ?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php"); ?>  <?php include("../attachment/sidebar.php"); ?>
<?php include("../../con73/con37.php"); ?>
<script>
function for_class(value){
if(value!=''){
$.ajax({
type: "POST",
url: access_link+"hostel/ajax_student_hostel_class.php?student_roll_no="+value+"",
cache: false,
success: function(detail){
var str =detail;
var res = str.split("|?|");
$("#student_class").val(res[1]);
$("#student_class_code").val(res[0]);
$("#student_category").val(res[2]);
$("#category_code").val(res[3]);
get_insatllment_amount();
  }
});
}else {
$("#student_class").val('');
$("#student_class_code").val('');
$("#student_category").val('');
$("#category_code").val('');
get_insatllment_amount();
}
}

function get_insatllment_amount(){
var installment_number=document.getElementById('installment_number').value;
var class_code=document.getElementById('student_class_code').value;
var student_class=document.getElementById('student_class').value;
var category_code=document.getElementById('category_code').value;
var student_category=document.getElementById('student_category').value;
var student_roll_no=document.getElementById('student_name').value;
if(class_code!='' && category_code!=''&& installment_number!='' && student_roll_no!='' ){
window.open('student_hostel_fee_add_form_studentwise.php?student_roll_no='+student_roll_no+'&class_code='+class_code+'&category_code='+category_code+'&installment_number='+installment_number+'&student_class='+student_class+'&student_category='+student_category,'_self');
}
}
</script>
<script>
function for_calculation(value,start_month,end_month){
$('#current_challan_remark').val('');
$('#next_challan_remark').val('');
if(value=='Partial'){
for(var y=start_month; y<=end_month; y++){
$('.monthly_pay_'+y).each(function() {
$(this).prop('readonly',false);
});
}
$('#challan_remakrs').show();
$('#my_check').prop('checked',false);
$('#my_check11').hide();
}else{
$('#challan_remakrs').hide();
location.reload();
}
}

function installment_calculation(){
var installment_no=document.getElementById('installment_number').value;
if(installment_no=="installment1"){
var s_month=4;
var e_month=6;
}else if(installment_no=="installment2"){
var s_month=7;
var e_month=9;
}else if(installment_no=="installment3"){
var s_month=10;
var e_month=12;
}else if(installment_no=="installment4"){
var s_month=1;
var e_month=3;
}
var add6=0;
var add7=0;
var add10=0;
for(var v=s_month; v<=e_month; v++){
var add3=0;
$('.monthly_total_'+v).each(function() {
add3 += Number($(this).val());
});
$('#total_month_'+v).val(add3);
add6=parseInt(add6)+parseInt(add3);
$('#total_amount').val(add6);

var add4=0;
$('.monthly_pay_'+v).each(function() {
add4 += Number($(this).val());
});
$('#paid_month_'+v).val(add4);
add10=parseInt(add10)+parseInt(add4);
$('#paid_amount').val(add10);
var add5=parseInt(add3)-parseInt(add4);
$('#balance_month_'+v).val(add5);
add7=parseInt(add7)+parseInt(add4);
}
var add8=parseInt(add6)-parseInt(add7);
$('#paid_balance').val(add8);

var add=0;
var add9=0;
var add9_arr=[];
$('.total_payable').each(function() {
add += Number($(this).val());
add9 = Number($(this).val());
add9_arr.push(add9);
});
var add2=0;
var add10=0;
var add10_arr=[];
$('.total_pay').each(function() {
add2 += Number($(this).val());
add10 = Number($(this).val());
add10_arr.push(add10);
});
var my_no=0;
var balance_value='';
$(".total_balance").each(function() {
balance_value=add9_arr[my_no]-add10_arr[my_no];
$(this).val(balance_value);
my_no++;
});
var add1=0;
$('.total_balance').each(function() {
add1 += Number($(this).val());
});
var penalty_amt=$('#penalty_pay').val();
$('#total_payble_final').html(add);
$('#total_balance_final').html(add1);
$('#total_pay_final').html(parseInt(add2)+parseInt(penalty_amt));
$('#total_pay_final2').val(parseInt(add2)+parseInt(penalty_amt));
$('#total_balance_final1').html(add1);
$('#total_balance_final2').val(add1);
}

function for_students(){
var student_class=document.getElementById('student_class_search').value;
var student_section=document.getElementById('student_section_search').value;
var category_code=document.getElementById('student_category_search').value;
var student_roll_no=document.getElementById('student_name').value;
$.ajax({
	  type: "POST",
	  url: access_link+"hostel/ajax_get_student_for_hostel_challan_list.php?student_class="+student_class+"&student_section="+student_section+"&category_code="+category_code+"&student_roll_no="+student_roll_no+"",
	  cache: false,
	  success: function(detail){
		  $("#student_name").html(detail);
	  }
   });
}

function change_fee(id,id1,value){
$('#'+id1+'_'+id).val(value);
var add11=0;
$('.total_'+id).each(function() {
add11 += Number($(this).val());
});
$('#my_total_'+id).val(add11);
$('#my_pay_'+id).val(add11);
installment_calculation();
}

function for_partial(id){
var add12=0;
$('.pay_'+id).each(function() {
add12 += Number($(this).val());
});
$('#my_pay_'+id).val(add12);
installment_calculation();
}

function for_checking(start_month,end_month){
if ($('#my_check').is(':checked')) {
	for(var ab=start_month; ab<=end_month; ab++){
	$('.monthly_total_'+ab).each(function() {
	$(this).prop('readonly',false);
	});
	}
	$('#payment_full_partial').val('Full');
	$('#challan_remakrs').hide('');
	$('#current_challan_remark').val('');
	$('#next_challan_remark').val('');
	$('#payment_full_partial').hide();
} else {
	for(var ac=start_month; ac<=end_month; ac++){
	$('.monthly_total_'+ac).each(function() {
	$(this).prop('readonly',true);
	});
	}
	$('#payment_full_partial').val('Full');
	$('#challan_remakrs').hide('');
	$('#current_challan_remark').val('');
	$('#next_challan_remark').val('');
	$('#payment_full_partial').show();
}
}

function for_all_fee(value){
if ($('#student_full_fee').is(':checked')) {
$('#all_fee').val(value);
$('#payment_full_partial').val('Full');
$('#challan_remakrs').hide('');
$('#current_challan_remark').val('');
$('#next_challan_remark').val('');
$('#payment_full_partial').hide();
}else{
$('#all_fee').val('No');
$('#payment_full_partial').val('Full');
$('#challan_remakrs').hide('');
$('#current_challan_remark').val('');
$('#next_challan_remark').val('');
$('#payment_full_partial').show();
}
}

</script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Fees Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Set Fee</li>
      </ol>
    </section>
<?php
$qry1="select * from login";
$result1=mysqli_query($conn73,$qry1);
while($row01=mysqli_fetch_assoc($result1)){
$hostel_challan_no=$row01['challan_no_'.$session1];
}
?>
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
			  
              <div class="col-sm-12">
			  <div class="container-fluid">
				<?php
				$qryy="select challan_no from student_hostel_fees_paid where session_value='$session1'";
				$resultt1=mysqli_query($conn73,$qryy);
				while($roww01=mysqli_fetch_assoc($resultt1)){
				$show_challan_no=$roww01['challan_no'];
				}
				?>
			  <h2>Hostel Fee Panel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Last Challan No. - <?php if(mysqli_num_rows($resultt1)>0){ echo $show_challan_no; } ?></small></h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
				
			    <div class="col-sm-3">
				<label>Student Roll No</label>
				<input type="text" name="student_roll_no" id="student_name" value="<?php if(isset($_GET['student_roll_no'])){ echo $_GET['student_roll_no']; } ?>" class="form-control" required readonly />
				</div>
				
				<div class="col-sm-3">
				<label>Student Class</label>
				<input type="text" name="student_class" id="student_class" value="<?php if(isset($_GET['student_roll_no'])){ echo $_GET['student_class']; } ?>" class="form-control" readonly>
				<input type="hidden" name="student_class_code" id="student_class_code" value="<?php if(isset($_GET['student_roll_no'])){ echo $_GET['class_code']; } ?>" class="form-control" readonly>				
				</div>
				
				<div class="col-sm-3">
				<label>Category</label>
				<input type="text" name="student_category" id="student_category" value="<?php if(isset($_GET['student_roll_no'])){ echo $_GET['student_category']; } ?>" class="form-control" readonly />
				<input type="hidden" name="category_code" id="category_code" value="<?php if(isset($_GET['student_roll_no'])){ echo $_GET['category_code']; } ?>" class="form-control" readonly />
				</div>
				<div class="col-sm-3">
				<label>Select Installment</label>
				<input type="text" name="installment_number" id="installment_number" value="<?php if(isset($_GET['student_roll_no'])){ echo $_GET['installment_number']; } ?>" class="form-control" required readonly >
				</div>
			  </div>
			  
			  </div>
			  </div>
			  </div>
<?php
if(isset($_GET['student_roll_no'])){
$category_code=$_GET['category_code'];
$class_code=$_GET['class_code'];
$installment_no1=$_GET['installment_number'];
$student_roll_no23=$_GET['student_roll_no'];
$edit_challan_no111=$_GET['challan_no'];
?>
	       <div class="col-sm-12">
			  <div class="container-fluid">
			  <h2>Fee Details</h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
			  
			<?php	include("../../con73/con37.php");
			$que9="select * from school_info_hostel_head where fee_head_name!=''";
            $run9=mysqli_query($conn73,$que9)or die(mysqli_error($conn73));
			$fee_sno=0;
            while($row9=mysqli_fetch_assoc($run9)){
			$fee_head_name[$fee_sno] = $row9['fee_head_name'];
			$fee_head_code[$fee_sno] = $row9['fee_head_code'];
			$fee_sno++;
			}
			
			if($installment_no1=='installment1'){
			$start_month=4;
			$end_month=6;
			$month_name4="April";
			$month_name5="May";
			$month_name6="June";
			}elseif($installment_no1=='installment2'){
			$start_month=7;
			$end_month=9;
			$month_name7="July";
			$month_name8="August";
			$month_name9="September";
			}elseif($installment_no1=='installment3'){
			$start_month=10;
			$end_month=12;
			$month_name10="October";
			$month_name11="November";
			$month_name12="December";
			}elseif($installment_no1=='installment4'){
			$start_month=1;
			$end_month=3;
			$month_name1="January";
			$month_name2="Fabruary";
			$month_name3="March";
			}
			
			$que10="select * from student_hostel_fees_discount where student_roll_no='$student_roll_no23'";
            $run10=mysqli_query($conn73,$que10)or die(mysqli_error($conn73));
			$fee_sno1=0;
			if(mysqli_num_rows($run10)>0){
            while($row10=mysqli_fetch_assoc($run10)){
			for($f=0;$f<$fee_sno;$f++){
			$discount_amount[$fee_sno1] = $row10[$fee_head_code[$f]."_discount_amount"];
			$discount_remark[$fee_sno1] = $row10[$fee_head_code[$f]."_discount_remark"];
			$fee_sno1++;
			}
			}
			}else{
			for($c=0;$c<$fee_sno;$c++){
			$discount_amount[$fee_sno1] = 0;
			$discount_remark[$fee_sno1] = '';
			$fee_sno1++;
			}
			}
			
		    $que19="select * from student_hostel_fees_structure_monthly where class_code='$class_code' and category_code='$category_code'";
            $run19=mysqli_query($conn73,$que19) or die(mysqli_error($conn73));
			$hostel_monthly_amount='';
			$hostel_month_total_amount='';
			$hostel_month_total_amount13='';
			$hos_sno=0;
            while($row19=mysqli_fetch_assoc($run19)){
			for($d=$start_month;$d<=$end_month;$d++){
		    for($c=0;$c<$fee_sno;$c++){
			$month_amount_total1=$row19[$fee_head_code[$c].'_month'.$d];
			$hostel_monthly_amount[$c][$d]=(($month_amount_total1)-($month_amount_total1*$discount_amount[$c])/100);
			if($hos_sno==0){
			$hostel_month_total_amount[$c]=0;
			$hostel_month_total_amount13[$c]=0;
			}
			$hostel_month_total_amount[$c]=$hostel_month_total_amount[$c]+$row19[$fee_head_code[$c].'_month'.$d];
			$hostel_month_total_amount13[$c]=$hostel_month_total_amount13[$c]+(($row19[$fee_head_code[$c].'_month'.$d])-($row19[$fee_head_code[$c].'_month'.$d]*$discount_amount[$c])/100);
			}
			$hos_sno++;
			}
			}
			
			$que20="select * from expense_monthly where student_roll_no='$student_roll_no23' and add_in_installment='$installment_no1'";
            $run20=mysqli_query($conn73,$que20) or die(mysqli_error($conn73));
			$exp_sno=0;
			if(mysqli_num_rows($run20)>0){
            while($row20=mysqli_fetch_assoc($run20)){
			for($e=0;$e<$fee_sno;$e++){
			if($exp_sno==0){
			$expense_fee_amount1[$e]=0;
			$expense_fee_amount[$e]=0;
			}
			$expense_fee_amt12=$row20[$fee_head_code[$e]];
			$expense_fee_amount1[$e]=$expense_fee_amount1[$e]+$expense_fee_amt12;
			$expense_fee_amount[$e]=$expense_fee_amount[$e]+(($expense_fee_amt12)-($expense_fee_amt12*$discount_amount[$e])/100);
			}
			$exp_sno++;
			}
			}else{
			for($e=0;$e<$fee_sno;$e++){
			$expense_fee_amount[$e]=0;
			$expense_fee_amount1[$e]=0;
			}
			}
			$que21="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no23' and installment_no='$installment_no1' and session_value='$session1'";
			$run21=mysqli_query($conn73,$que21)or die(mysqli_error($conn73));
			$paid_sno=0;
			$fees_paid_penalty_amount=0;
			if(mysqli_num_rows($run21)>0){
			while($row21=mysqli_fetch_assoc($run21)){
			for($ae=0;$ae<$fee_sno;$ae++){
			if($paid_sno==0){
			$fees_paid_amount[$ae]=0;
			}
			$fees_paid_amount[$ae]=$fees_paid_amount[$ae]+$row21[$fee_head_code[$ae]];
			}
			$fees_paid_penalty_amount=$fees_paid_penalty_amount+$row21['penalty_amount'];
			$paid_sno++;
			}
			}else{
			for($ae=0;$ae<$fee_sno;$ae++){
			$fees_paid_amount[$ae]=0;
			}
			}
?>
		<div class="col-md-12">
		<div class="col-md-4">
		<div class="form-group">
		<label><?php echo ucwords($installment_no1); ?></label>
		<input type="text" name="total_amount" id="total_amount" value="" class="form-control" readonly />
		</div>
		</div>
		
		<div class="col-md-4">
		<div class="form-group">
		<label>Pay Amount</label>
		<input type="text" name="paid_amount" id="paid_amount" value="" class="form-control" readonly />
		</div>
		</div>
		
		<div class="col-md-4">
		<div class="form-group">
		<label>Balance</label>
		<input type="text" name="balance" id="paid_balance" value="" class="form-control" readonly />
		</div>
		</div>
		
		</div>
		<div class="col-sm-12">
		<div class="col-sm-4">
		<div class="col-sm-12"><h4>Installment Months</h4></div>
<?php if($installment_no1=='installment1'){ ?>
		<div class="col-sm-4">
		<div class="form-group">
		<label>April</label>
		<input type="text" name="installment_month_wise[]" id="total_month_4" value="" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>May</label>
		<input type="text" name="installment_month_wise[]" value="" id="total_month_5" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>June</label>
		<input type="text" name="installment_month_wise[]" value="" id="total_month_6" class="form-control" readonly />
		</div>
		</div>
		<?php }elseif($installment_no1=='installment2'){ ?>
		<div class="col-sm-4">
		<div class="form-group">
		<label>July</label>
		<input type="text" name="installment_month_wise[]" value=""  id="total_month_7" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>August</label>
		<input type="text" name="installment_month_wise[]" value=""  id="total_month_8" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>September</label>
		<input type="text" name="installment_month_wise[]" value=""  id="total_month_9" class="form-control" readonly />
		</div>
		</div>
		<?php }elseif($installment_no1=='installment3'){ ?>
		<div class="col-sm-4">
		<div class="form-group">
		<label>October</label>
		<input type="text" name="installment_month_wise[]" value=""  id="total_month_10" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>November</label>
		<input type="text" name="installment_month_wise[]" value=""  id="total_month_11" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>December</label>
		<input type="text" name="installment_month_wise[]" value=""  id="total_month_12" class="form-control" readonly />
		</div>
		</div>
		<?php }elseif($installment_no1=='installment4'){ ?>
			<div class="col-sm-4">
		<div class="form-group">
		<label>January</label>
		<input type="text" name="installment_month_wise[]" value=""  id="total_month_1" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>February</label>
		<input type="text" name="installment_month_wise[]" value=""  id="total_month_2" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>March</label>
		<input type="text" name="installment_month_wise[]" value=""  id="total_month_3" class="form-control" readonly />
		</div>
		</div>
		<?php } ?>
		</div>
		<div class="col-sm-4">
		<div class="col-sm-12"><h4>Pay Months</h4></div>
		
		<?php if($installment_no1=='installment1'){ ?>
		<div class="col-sm-4">
		<div class="form-group">
		<label>April</label>
		<input type="text" name="paid_month_wise[]" id="paid_month_4" value="" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>May</label>
		<input type="text" name="paid_month_wise[]" value="" id="paid_month_5" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>June</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_6" class="form-control" readonly />
		</div>
		</div>
		<?php }elseif($installment_no1=='installment2'){ ?>
		<div class="col-sm-4">
		<div class="form-group">
		<label>July</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_7" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>August</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_8" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>September</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_9" class="form-control" readonly />
		</div>
		</div>
		<?php }elseif($installment_no1=='installment3'){ ?>
		<div class="col-sm-4">
		<div class="form-group">
		<label>October</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_10" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>November</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_11" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>December</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_12" class="form-control" readonly />
		</div>
		</div>
		<?php }elseif($installment_no1=='installment4'){ ?>
			<div class="col-sm-4">
		<div class="form-group">
		<label>January</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_1" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>February</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_2" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>March</label>
		<input type="text" name="paid_month_wise[]" value=""  id="paid_month_3" class="form-control" readonly />
		</div>
		</div>
		<?php } ?>
		
		</div>
		<div class="col-sm-4">
		<div class="col-sm-12"><h4>Balance Months</h4></div>
		
		<?php if($installment_no1=='installment1'){ ?>
		<div class="col-sm-4">
		<div class="form-group">
		<label>April</label>
		<input type="text" name="balance_month_wise[]" id="balance_month_4" value="" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>May</label>
		<input type="text" name="balance_month_wise[]" value="" id="balance_month_5" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>June</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_6" class="form-control" readonly />
		</div>
		</div>
		<?php }elseif($installment_no1=='installment2'){ ?>
		<div class="col-sm-4">
		<div class="form-group">
		<label>July</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_7" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>August</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_8" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>September</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_9" class="form-control" readonly />
		</div>
		</div>
		<?php }elseif($installment_no1=='installment3'){ ?>
		<div class="col-sm-4">
		<div class="form-group">
		<label>October</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_10" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>November</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_11" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>December</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_12" class="form-control" readonly />
		</div>
		</div>
		<?php }elseif($installment_no1=='installment4'){ ?>
			<div class="col-sm-4">
		<div class="form-group">
		<label>January</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_1" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>February</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_2" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group">
		<label>March</label>
		<input type="text" name="balance_month_wise[]" value=""  id="balance_month_3" class="form-control" readonly />
		</div>
		</div>
		<?php } ?>
		
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<div class="col-md-12">
		<div class="col-md-2"><div id="my_check11">
		<h4><b><input type="checkbox" id="my_check" onclick="for_checking('<?php echo $start_month; ?>','<?php echo $end_month; ?>');"> Edit Fee</b></h4>
		</div></div>
		<div class="col-md-2">
		<h4><b><input type="checkbox" id="student_full_fee" value="Yes" onclick="for_all_fee(this.value);"> Full Fee</b></h4>
		<input type="hidden" name="all_fee" id="all_fee" value="No" />
		</div>
		<div class="col-md-6">
		
		</div>
		</div>
              <div class="col-sm-12" id="get_details">
			  <table id="" class="table table-bordered table-striped">
                <thead >
                <tr>
				
				  <td rowspan="2">Main Head</td>
				  <td rowspan="2" style="">Amount</td>
				  <td rowspan="2" style="" >Disc(%)</td>
				  <td rowspan="2" style="">Remark</td>
				  <?php for($o=$start_month;$o<=$end_month;$o++){
				  $o1="month_name".$o;
				  ?>
				  <td colspan='2' style="width:120px" class="for_colspan"><?php echo $$o1; ?></td>				  
 <?php } ?>
  <td rowspan="2">Total</td>
  <td rowspan="2">Balance</td>
  <td rowspan="2"  style="width:120px">Pay</td>
 
                </tr>
				 <tr>

				  <?php for($o=$start_month;$o<=$end_month;$o++){ ?>				  
				  <td>Total</td>
				  <td>Pay</td>				  			  
 <?php } ?>

 
                </tr>
                </thead>
                <tbody id="set_value">
				<?php
				for($w=0;$w<$fee_sno;$w++){
				$hostel_and_expense[$w]=$hostel_month_total_amount[$w]+$expense_fee_amount1[$w];
				$after_discount_amount[$w]=$hostel_month_total_amount13[$w]+$expense_fee_amount[$w];
				?>
				<tr>
				<td><h5 style="color:#900C3F;"><b><?php echo $fee_head_name[$w]; ?></b></h5></td>
				<td><input type="text" name="" id="" class="" value="<?php echo $hostel_and_expense[$w]; ?>" style="width:60px;background:#ECEBEB;" readonly /></td>
				<td><input type="text" name="" id="" class="" value="<?php echo $discount_amount[$w]; ?>" style="width:40px;background:#ECEBEB;" readonly /></td>
				<td><input type="text" name="" id="" class="" value="<?php echo $discount_remark[$w]; ?>" style="width:60px;background:#ECEBEB;" readonly /></td>
				<?php
				for($x=$start_month;$x<=$end_month;$x++){
				if($x==$end_month){
				$hostel_expense_amt11=$hostel_monthly_amount[$w][$x]+$expense_fee_amount[$w];
				}else{
				$hostel_expense_amt11=$hostel_monthly_amount[$w][$x];
				}
				?>
				<td><input type="text" name="" id="" class="<?php echo 'monthly_total_'.$x.' total_'.$fee_head_code[$w]; ?>" value="<?php echo $hostel_expense_amt11; ?>" style="width:50px;" oninput="change_fee('<?php echo $fee_head_code[$w]; ?>','<?php echo $x; ?>',this.value);" readonly /></td>
				<td><input type="text" name="" id="<?php echo $x.'_'.$fee_head_code[$w]; ?>" class="<?php echo 'monthly_pay_'.$x.' pay_'.$fee_head_code[$w]; ?>" value="<?php echo $hostel_expense_amt11; ?>" style="width:50px;" oninput="for_partial('<?php echo $fee_head_code[$w]; ?>');" readonly /></td>
				<?php
				}
				?>
				<td><input type="text" name="" id="<?php echo 'my_total_'.$fee_head_code[$w]; ?>" class="total_payable" value="<?php echo $after_discount_amount[$w]; ?>" style="color:#FF0000;width:60px;" readonly /></td>
				<td><input type="text" name="student_hostel_balance[]" id="" class="total_balance" value="" style="color:#FF0000;width:60px;" readonly /></td>
				<td><input type="text" name="student_hostel_fee[]" id="<?php echo 'my_pay_'.$fee_head_code[$w]; ?>" class="total_pay" value="<?php echo $fees_paid_amount[$w]; ?>" style="color:#0000FF;width:60px;" readonly /></td>
				</tr>
				<?php
				}
				?>
				<tr>
				<td colspan="12" class="for_colspan0">Penalty Amount</td>
				<td id="penalty" >
				<input type="text" name="penalty_pay" id="penalty_pay" class="" value="<?php echo $fees_paid_penalty_amount; ?>" style="color:#0000FF;width:60px;" oninput="installment_calculation();" />
				</td>
				</tr>
				<tr>
				<td colspan="10" class="for_colspan1">Full / Partial Payment</td>
				<td colspan="2" id="full_partial" >
				<select name="payment_full_partial" id="payment_full_partial" class="form-control" onchange="for_calculation(this.value,'<?php echo $start_month; ?>','<?php echo $end_month; ?>');">
				<option value="Full">Full</option>
				<option value="Partial">Partial</option>
				</select>
				</td>
				<td></td>
				</tr>
				<tr id="challan_remakrs" style="display:none;">
				<td colspan="13">
				<div class="col-md-12">
				<div class="col-md-6">
				<label>Remark <small>(For Current challan)</small></label>
				<input type="text" name="current_challan_remark" id="current_challan_remark" class="form-control" placeholder="Remark" />
				</div>
				<div class="col-md-6">
				<label>Remark <small>(For Next challan)</small></label>
				<input type="text" name="next_challan_remark" id="next_challan_remark" class="form-control" placeholder="Remark" />
				</div>
				</div>
				</td>
				</tr>
				<tr>
				<td colspan="10" class="for_colspan2">Total</td>
				<td style="color:#FF0000;" id="total_payble_final" ></td>
				<td style="color:#FF0000;" id="total_balance_final"></td>
				<td style="color:#0000FF;" id="total_pay_final"></td>
				</tr>
				<tr>
				<td colspan="11" class="for_colspan3">Balance</td>
				<td><input type="hidden" name="total_balance_final2" id="total_balance_final2" style="width:60px;" /><input type="hidden" name="total_pay_final2" id="total_pay_final2" style="width:60px;" /></td>
				<td id="total_balance_final1" ></td>
				</tr>
                </tbody>
				<tfoot>
				<tr>
				<td colspan="13" class="for_colspan3"><center><input type="submit" name="submit" value="Submit" class="btn btn-success" /></center></td>
				</tr>
				</tfoot>
              </table>
              </div>
              </div>
			</div>
            <!-- /.box-body -->
          </div>
     <?php } ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	</form>
  </div>
    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
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
$student_roll_no=$_POST['student_roll_no'];
$student_class=$_POST['student_class'];
$student_class_code=$_POST['student_class_code'];
$student_category=$_POST['student_category'];
$category_code=$_POST['category_code'];
$installment_number=$_POST['installment_number'];
$payment_full_partial=$_POST['payment_full_partial'];
$current_challan_remark=$_POST['current_challan_remark'];
$next_challan_remark=$_POST['next_challan_remark'];
$penalty_pay=$_POST['penalty_pay'];
$all_fee=$_POST['all_fee'];
$total_balance_final2=$_POST['total_balance_final2'];
$total_pay_final2=$_POST['total_pay_final2'];

$student_hostel_fee=$_POST['student_hostel_fee'];
$student_hostel_balance=$_POST['student_hostel_balance'];

$count1=count($student_hostel_fee);
$hostel_paid_column_name='';
$hostel_paid_column_value='';
$hostel_paid_column_value1='';
for($ad=0;$ad<$count1;$ad++){
$hostel_paid_column_name=$hostel_paid_column_name.",$fee_head_code[$ad]";
$hostel_paid_column_value=$hostel_paid_column_value.",$fee_head_code[$ad]='$student_hostel_fee[$ad]'";
$hostel_paid_column_value1=$hostel_paid_column_value1.",'$student_hostel_balance[$ad]'";
}
$query22="update student_hostel_fees_paid set student_roll_no='$student_roll_no',total_amount='$total_pay_final2',installment_no='$installment_number',payment_full_partial='$payment_full_partial',partial_remark='$current_challan_remark',ready_for_verify='Yes',penalty_amount='$penalty_pay',all_fee='$all_fee'$hostel_paid_column_value,$update_by_update_sql  where challan_no='$edit_challan_no111' and session_value='$session1'";
if(mysqli_query($conn73,$query22)){
if($payment_full_partial=='Partial' && $total_balance_final2>0){
$query23="insert into student_hostel_fees_paid(student_roll_no,total_amount,installment_no,challan_no,payment_full_partial,partial_remark,parent_challan_no,ready_for_verify,penalty_amount,session_value,all_fee$hostel_paid_column_name,$update_by_insert_sql_column) values('$student_roll_no','$total_balance_final2','$installment_number','$hostel_challan_no','$payment_full_partial','$next_challan_remark','$edit_challan_no111','No','0','$session1','$all_fee'$hostel_paid_column_value1,$update_by_insert_sql_value)";
mysqli_query($conn73,$query23);
$update_challan_no=$hostel_challan_no+1;
}
$query24="update login set challan_no_$session1='$update_challan_no'";
mysqli_query($conn73,$query24);
echo "<script>window.open('../pdf/challan_hostel_fee.php?student_roll_no=$student_roll_no&installment_no=$installment_number','_self');</script>";
echo "<script>window.open('student_hostel_fee_challan_details.php?challan_no=$edit_challan_no111','_self');</script>";
}
}
?>
<script>
//for_section();
installment_calculation();
</script>