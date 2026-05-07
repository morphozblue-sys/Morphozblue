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
function for_search11(){
var value=document.getElementById('student_challan_no').value;
var verify_date=document.getElementById('set_verify_date').value;
var payment_mode=document.getElementById('set_payment_mode').value;
if(value!=''){

$.ajax({
type: "POST",
url: "ajax_get_hostel_challan_detail.php?challan_no="+value+"&verify_date="+verify_date+"&payment_mode="+payment_mode+"",
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
$('#total_pay_final_show').html(add);
}

function for_banking(value){
if(value=='Cash'){
$('.banking').each(function() {
$(this).hide();
});
$('#cheque_dd_no').val('');
}else{
$('.banking').each(function() {
$(this).show();
});
$('#cheque_dd_no').val('');
}
}

</script>
<?php
if(isset($_GET['challan_no'])){
$challan_no11=$_GET['challan_no'];
}
?>
<?php
if(isset($_GET['verify_date'])){
$verify_date=$_GET['verify_date'];
$payment_mode=$_GET['payment_mode'];
}else{
$verify_date='';
$payment_mode='';
}
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Fee Challan Details
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Challan Details</li>
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
			  <h2>Challan Panel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Total Pay = <span id="total_pay_final_show">0</span></small></h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
			  
			    <div class="col-sm-12">
				<label>Challan No.</label>
				<input type="hidden" name="" id="set_verify_date" value="<?php echo $verify_date; ?>" />
				<input type="hidden" name="" id="set_payment_mode" value="<?php echo $payment_mode; ?>" />
				<select name="student_challan_no" id="student_challan_no" style="width:100%;" class="form-control select2" onchange="for_search11();" required >
				<option value="">Select Challan</option>
				<?php
				$query1="select * from student_hostel_fees_paid where session_value='$session1'";
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
$verify_date=$_POST['verify_date'];
$remark=$_POST['remark'];
$cheque_dd_no=$_POST['cheque_dd_no'];
$verify_unverify=$_POST['verify_unverify'];
$student_roll_no23=$_POST['student_roll_no23'];

$querrr="select * from student_hostel_fees_paid where challan_no='$student_challan_no' and ready_for_verify='Yes'";
$resss=mysqli_query($conn73,$querrr) or die(mysqli_error($conn73));
if(mysqli_num_rows($resss)>0){

$query="update student_hostel_fees_paid set payment_mode='$payment_mode',cheque_dd_no='$cheque_dd_no',remark='$remark',verify='$verify_unverify',verification_date='$verify_date',$update_by_update_sql  where challan_no='$student_challan_no' and session_value='$session1'";

if(mysqli_query($conn73,$query)){

$querr258="update student_hostel_fees_paid set ready_for_verify='Yes',$update_by_update_sql  where parent_challan_no='$student_challan_no' and session_value='$session1'";
mysqli_query($conn73,$querr258);

echo "<script>alert_new('Successfully Verify !!!');</script>";
echo "<script>window.open('student_hostel_fee_challan_details.php?challan_no=$student_challan_no&verify_date=$verify_date&payment_mode=$payment_mode','_self');</script>";
}
}else{
echo "<script>alert_new('Please Verify Previous Challan !!!');</script>";
echo "<script>window.open('student_hostel_fee_challan_details.php?challan_no=$student_challan_no&verify_date=$verify_date&payment_mode=$payment_mode','_self');</script>";
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