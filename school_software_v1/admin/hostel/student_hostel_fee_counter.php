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
<div class="wrapper">
<?php include("../attachment/header.php"); ?> 
<?php include("../attachment/sidebar.php"); ?>
<?php include("../../con73/con37.php"); ?>
<script>
function for_search11(){
var value=document.getElementById('student_challan_no').value;
if(value!=''){

$.ajax({
type: "POST",
url: "ajax_get_hostel_challan_counter.php?challan_no="+value+"",
cache: false,
success: function(detail){
$('#for_fee_list').html(detail);
for_pay();
  }
});

}else{
$('#for_fee_list').html('');
}
}

function for_pay(){
var add=0;
$('.pay').each(function() {
add += Number($(this).val());
});
$('#total_pay_final').html(add);
$('#challan_amount').val(add);
$('#challan_paid_amount').val(add);
}

function for_banking(value){
if(value=='Cash'){
$('.banking').each(function() {
$(this).hide();
});
$('#bank_name').val('');
$('#cheque_dd_no').val('');
$('#cheque_dd_date').val('');
}else{
$('.banking').each(function() {
$(this).show();
});
$('#bank_name').val('');
$('#cheque_dd_no').val('');
$('#cheque_dd_date').val('');
}
}

function for_full_partial(val1){
if(val1=='Full'){
var challan_amount=document.getElementById('challan_amount').value;
$('#challan_paid_amount').val(challan_amount);
$('#challan_balance').val('0');
$('#for_paid_amount').hide();
}else{
$('#for_paid_amount').show();
}
}

function for_balance(val2){
var challan_amount=document.getElementById('challan_amount').value;
var balance=parseFloat(challan_amount)-parseFloat(val2);
$('#challan_balance').val(balance);
}
</script>
<?php
if(isset($_GET['challan_no'])){
$challan_no11=$_GET['challan_no'];
}
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Fee Counter Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Fee Counter</li>
      </ol>
    </section>

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
			  
              <div class="col-sm-3"></div>
              <div class="col-sm-6">
			  <div class="container-fluid">
			  <h2>Counter Panel</h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
			  
			    <div class="col-sm-12">
				<label>Challan No.</label>
				<select name="student_challan_no" id="student_challan_no" style="width:100%;" class="form-control select2" onchange="for_search11();" required >
				<option value="">Select Challan</option>
				<?php
				$query1="select * from student_hostel_fees_paid where verify='No' and session_value='$session1'";
				$res1=mysqli_query($conn73,$query1);
				while($row1=mysqli_fetch_assoc($res1)){
				$challan_no=$row1['challan_no'];
				$student_roll_no=$row1['student_roll_no'];
				
				$query2="select student_name,student_class,student_admission_number from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
				$res2=mysqli_query($conn73,$query2);
				while($row2=mysqli_fetch_assoc($res2)){
				$student_name=$row2['student_name'];
				$student_class=$row2['student_class'];
				$student_admission_number=$row2['student_admission_number'];
				}
				?>
				<option <?php if(isset($_GET['challan_no'])){ if($challan_no11==$challan_no){ echo 'selected'; } } ?> value="<?php echo $challan_no; ?>"><?php echo $challan_no.'['.$student_name.']['.$student_class.']['.$student_admission_number.']'; ?></option>
				<?php } ?>
				</select>
				</div>
			  </div>
			  </div>
			  </div>
			  </div>
			  <div class="col-sm-3"></div>
<div id="for_fee_list">

</div>
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
$student_challan_no=$_POST['student_challan_no'];
$payment_mode=$_POST['payment_mode'];
$date=$_POST['verify_date'];
$remark=$_POST['remark'];
$bank_name=$_POST['bank_name'];
$cheque_dd_no=$_POST['cheque_dd_no'];
$cheque_dd_date=$_POST['cheque_dd_date'];
$full_partial=$_POST['verify_unverify'];
$student_roll_no23=$_POST['student_roll_no23'];
$challan_amount=$_POST['challan_amount'];
$challan_paid_amount=$_POST['challan_paid_amount'];
$challan_balance=$_POST['challan_balance'];
$installment_no=$_POST['installment_no'];

$querr="select * from student_hostel_fees_counter where challan_no='$student_challan_no' and session_value='$session1'";
$ress=mysqli_query($conn73,$querr) or die(mysqli_error($conn73));
if(mysqli_num_rows($ress)<1){

$query="insert into student_hostel_fees_counter(student_roll_no,challan_no,installment_no,challan_amount,challan_paid_amount,challan_balance,challan_remark,challan_full_partial,date,payment_mode,bank_name,cheque_dd_no,cheque_dd_date,session_value,$update_by_insert_sql_column) values('$student_roll_no23','$student_challan_no','$installment_no','$challan_amount','$challan_paid_amount','$challan_balance','$remark','$full_partial','$date','$payment_mode','$bank_name','$cheque_dd_no','$cheque_dd_date','$session1',$update_by_insert_sql_value)";
if(mysqli_query($conn73,$query)){
echo "<script>alert_new('Successfully Complete !!!');</script>";
echo "<script>window.open('../pdf/hostel_invoice.php?challan_no=$student_challan_no','_blank');</script>";
echo "<script>window.open('student_hostel_fee_counter.php','_self');</script>";
}
}else{
echo "<script>alert_new('This Challan No is Already Exists !!!');</script>";
echo "<script>window.open('student_hostel_fee_counter.php','_self');</script>";
}
}
?>
<?php
if(isset($_GET['challan_no'])){
?>
<script>
for_search11();
</script>
<?php
}
?>