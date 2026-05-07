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
var student_class=document.getElementById('student_class_search').value;
var section=document.getElementById('student_section_search').value;
var category_code=document.getElementById('category_code').value;
var from_date=document.getElementById('from_date').value;
var to_date=document.getElementById('to_date').value;
var installment_no=document.getElementById('installment_no').value;
if(from_date!='' && to_date!='' && installment_no!=''){

$.ajax({
type: "POST",
url: "ajax_student_hostel_expense_list.php",
data: {from_date:from_date,to_date:to_date,student_class:student_class,section:section,installment_no:installment_no,category_code:category_code},
success: function(detail){
$('#for_challan_list').html(detail);
  }
});

}else{
$('#for_challan_list').html('');
}
}

function for_section(){
var value=document.getElementById('student_class_search').value;
if(value=='All'){
$("#student_section_search").html('<option value="All">All</option>');
for_search11();
}else{
$.ajax({
	  type: "POST",
	  url: "ajax_class_section_all.php?class_name="+value+"",
	  cache: false,
	  success: function(detail){
	  $("#student_section_search").html(detail);
	  for_search11();
	  }
   });
}
}

function for_check1(id){
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

function validation(){
var add=0;
$(".all_expense").each(function() {
if($(this).is(':checked')){
add=add+1;
}
});
if(add<1){
alert_new("Please Select Atleast One Student !!!",'red');
return false;
}else{
return true;
}
}

</script>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Student Expense List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Expense List</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
    <!-- Main content -->
	<form method="post" enctype="multipart/form-data">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-sm-12">&nbsp;</div>
              <div class="col-sm-12">
			  
			  <div class="container-fluid">
			  <h2>Expense Panel</h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
			    <div class="col-sm-12">
			    <div class="col-sm-2">
				<label>Student Class</label>
				<select name="" id="student_class_search" class="form-control" onchange="for_section();" >
				<option value="All">All</option>
				<?php
				$query2="select * from school_info_class_info where class_name!=''";
				$res2=mysqli_query($conn73,$query2);
				while($row2=mysqli_fetch_assoc($res2)){
				$class_code=$row2['class_code'];
				$class_name=$row2['class_name'];
				?>
				<option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
				<?php } ?>
				</select>
				</div>
			    <div class="col-sm-2">
				<label>Section</label>
				<select name="" id="student_section_search" class="form-control" onchange="for_search11();">
				<option value="All">All</option>
				
				</select>
				</div>
				<div class="col-sm-2">
				<label>Category</label>
				<select name="" id="category_code" onchange="for_search11();" class="form-control">
				<option value="All">All Category</option>
				<option value="category3">New Hostlers</option>
				<option value="category4">Old Hostlers</option>
				</select>
				</div>
			    <div class="col-sm-2">
				<label>Date From</label>
				<input type="date" name="from_date" id="from_date" oninput="for_search11();" class="form-control" />
				</div>
				<div class="col-sm-2">
				<label>Date To</label>
				<input type="date" name="to_date" id="to_date" oninput="for_search11();" class="form-control" />
				</div>
				<div class="col-sm-2">
				<label>Installment</label>
				<select name="installment_no" id="installment_no" onchange="for_search11();" class="form-control">
				<option value="">Select</option>
				<option value="installment1">installment1</option>
				<option value="installment2">installment2</option>
				<option value="installment3">installment3</option>
				<option value="installment4">installment4</option>
				</select>
				</div>
				</div>
				<div class="col-sm-12">&nbsp;</div>
				<div class="col-sm-12">
				<center><input type="submit" name="submit" value="Submit" class="btn btn-success" onclick="return validation();" /></center>
				</div>
			  </div>
			  </div>
			  </div>
<div id="for_challan_list">

</div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
	</form>
    <!-- /.content -->
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
$from_date=$_POST['from_date'];
if($from_date!=''){
$condition11=" and create_date>='$from_date'";
}else{
$condition11="";
}
$to_date=$_POST['to_date'];
if($to_date!=''){
$condition22=" and create_date<='$to_date'";
}else{
$condition22="";
}
$student_roll_no=$_POST['student_roll_no'];
$installment_no=$_POST['installment_no'];
$count1=count($student_roll_no);
$message=0;
for($p=0;$p<$count1;$p++){
$que127="update expense_monthly set add_in_challan='Yes', add_in_installment='$installment_no',$update_by_update_sql  where student_roll_no='$student_roll_no[$p]' and add_in_challan='No' and session_value='$session1'$condition11$condition22";
if(mysqli_query($conn73,$que127)){
$message=$message+1;
}
}
if($message>0){
echo "<script>alert_new('Successfully Add Expenses in Installment !!!');</script>";
echo "<script>window.open('add_expense_in_fee.php','_self');</script>";
}else{
echo "<script>alert_new('This Record is Already Add in Installment !!!');</script>";
echo "<script>window.open('add_expense_in_fee.php','_self');</script>";
}
}
?>