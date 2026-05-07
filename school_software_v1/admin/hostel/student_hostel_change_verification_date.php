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
function for_section(value){
var id=value;  
var class_name1_code1=id.split('|?|');
var class_name=class_name1_code1[0];
       $.ajax({
			  type: "POST",
              url: access_link+"hostel/ajax_class_section_all.php?class_name="+class_name+"",
              cache: false,
              success: function(detail){
                $("#student_class_section").html(detail);
				for_student();
              }
           });
}
function for_student(){
var from_date=document.getElementById('from_date').value;
var to_date=document.getElementById('to_date').value;
       $.ajax({
			  type: "POST",
            url: access_link+"hostel/ajax_get_for_hostel_change_verification_date.php?from_date="+from_date+"&to_date="+to_date+"",
              cache: false,
              success: function(detail){
                $("#student_list").html(detail);
              }
           });
		   
}

function for_validity(){
var num2=0;
$(".check_student").each(function() {
if($(this).prop('checked')==true){ 
	num2 += Number(parseInt(num2)+1);
}
});
var num3=0;
$(".check_student1").each(function() {
if($(this).prop('checked')==true){ 
	num3 += Number(parseInt(num3)+1);
}
});
if(num2<1 && num3<1){
alert_new('Please Select Atleast One Student !!!','red');
return false;
}else{
return true;
}
}

function for_check(){
if($('#top_checkbox').prop("checked") == true){
	$(".check_student").each(function() {
	$(this).prop('checked',true);
	});
	$(".check_student1").each(function() {
	$(this).prop('checked',false);
	});
	$('#top_checkbox1').prop('checked',false);
}else{
	$(".check_student").each(function() {
	$(this).prop('checked',false);
	});
}
}
function for_check1(){
if($('#top_checkbox1').prop("checked") == true){
	$(".check_student1").each(function() {
	$(this).prop('checked',true);
	});
	$(".check_student").each(function() {
	$(this).prop('checked',false);
	});
	$('#top_checkbox').prop('checked',false);
}else{
	$(".check_student1").each(function() {
	$(this).prop('checked',false);
	});
}
}

function check_both(sno,identity){
if(identity=='verification'){
$('#unverify_'+sno).prop('checked',false);
}else if(identity=='unverify'){
$('#verification_'+sno).prop('checked',false);
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
	  <li class="active">Change Verification</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	<form method="post" enctype="multipart/form-data" onsubmit="return for_validity();">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-sm-12">&nbsp;</div>
              <div class="col-sm-2">&nbsp;</div>
              <div class="col-sm-8">
			  
			  <div class="container-fluid">
			  <h2>Verification Panel</h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
					<div class="col-md-12">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-4">
					<label>From Date</label>
					<input type="date" name="from_date" id="from_date" class="form-control" oninput="for_student();" />
					</div>
					<div class="col-md-4">
					<label>To Date</label>
					<input type="date" name="to_date" id="to_date" class="form-control" oninput="for_student();" />
					</div>
					<div class="col-md-2">&nbsp;</div>
					</div>
	
			  </div>
			  
			  </div>
			  </div>
			  
			  </div>
			  <div class="col-sm-2">&nbsp;</div>
			  <div class="col-sm-12" id="student_list">
			  </div>
			  
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
$student_roll_no=$_POST['student_roll_no'];
$new_verification_date=$_POST['new_verification_date'];
$installment_no=$_POST['installment_no'];
if(isset($_POST['student_count'])){
$student_count=$_POST['student_count'];
$count1=count($student_count);
for($i=0;$i<$count1;$i++){
$index=$student_count[$i];
$query5="update student_hostel_fees_paid set verification_date='$new_verification_date[$index]',$update_by_update_sql  where session_value='$session1' and challan_no='$student_challan_no[$index]'";
mysqli_query($conn73,$query5);
}
}
if(isset($_POST['student_count1'])){
$student_count1=$_POST['student_count1'];
$count2=count($student_count1);

for($j=0;$j<$count2;$j++){
$index1=$student_count1[$j];

$query10="update student_hostel_fees_paid set payment_mode='',cheque_dd_no='',remark='',verify='No',verification_date='0000-00-00',$update_by_update_sql  where installment_no='$installment_no[$index1]' and student_roll_no='$student_roll_no[$index1]' and challan_no='$student_challan_no[$index1]' and session_value='$session1'";
$result10=mysqli_query($conn73,$query10) or die(mysqli_error($conn73));

$query12="update student_hostel_fees_paid set ready_for_verify='No',$update_by_update_sql  where installment_no='$installment_no[$index1]' and student_roll_no='$student_roll_no[$index1]' and parent_challan_no='$student_challan_no[$index1]' and session_value='$session1'";
$result12=mysqli_query($conn73,$query12);

}
}
echo "<script>alert_new('Successfully Complete !!!');</script>";
}
?>
<script>

</script>