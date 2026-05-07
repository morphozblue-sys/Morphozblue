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
function for_validation(){
var add=0;
$(".student_class").each(function() {
if($(this).is(':checked')){
add=add+1;
}
});
//var installment=document.getElementById('student_due_installment').value;
if(add>0){
return true;
}else{
alert_new("Please Select Atleast One Class !!!",'red');
return false;
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

function confirmation(){
var myval=confirm('Are You Sure Delete This Record !!!');
if(myval==true){
return true;
}else{
return false;
}
}

</script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Edit Due Date Schedule
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Edit Due Date</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	<?php
	$edit_sno=$_GET['s_no'];
	$query3="select * from hostel_due_date_schedule where session_value='$session1' and s_no='$edit_sno'";
	$res3=mysqli_query($conn73,$query3);
	while($row3=mysqli_fetch_assoc($res3)){
	$student_due_title=$row3['student_due_title'];
	$student_due_installment=$row3['student_due_installment'];
	$student_due_class_code=$row3['student_due_class_code'];
	$student_due_date=$row3['student_due_date'];
	}
	?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			<form method="post" enctype="multipart/form-data" onsubmit="return for_validation();">
              <div class="col-sm-12">
			  <div class="container-fluid">
			  <h2>Hostel Due Date Panel</h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
			    <div class="col-sm-12">
				<table class="table table-bordered table-striped">
				<tr>
				<td colspan="3">
				<div class="col-sm-12">
				<input type="checkbox" name="" id="student_class" class="" value="" onclick="for_check(this.id)" disabled /> <b>All Class</b> &nbsp;&nbsp;&nbsp;
				</div>
				<div class="col-sm-12">
				<?php
				$query="select * from school_info_class_info where class_name!=''";
				$res=mysqli_query($conn73,$query);
				while($row=mysqli_fetch_assoc($res)){
				$class_name=$row['class_name'];
				$class_code=$row['class_code'];
				?>
				<input type="checkbox" name="student_due_class[]" id="student_due_class" class="student_class" value="<?php echo $class_name.'|?|'.$class_code; ?>" <?php if($student_due_class_code==$class_code){ echo 'checked'; }else{ echo 'disabled'; } ?> /><?php echo $class_name; ?>&nbsp;&nbsp;
				<?php
				}
				?>
				</div>
				</td>
				</tr>
				<tr>
				<td>
				<div class="col-md-12">
				<label>Due Title</label>
				<input type="text" name="student_due_title" id="student_due_title" value="<?php echo $student_due_title; ?>" class="form-control" />
				</div>
				</td>
				<td>
				<div class="col-md-12">
				<label>Installment</label>
				<select name="student_due_installment" id="student_due_installment" class="form-control" required >
				<option value="<?php echo $student_due_installment; ?>"><?php echo $student_due_installment; ?></option>
				</select>
				</div>
				</td>
				<td>
				<div class="col-md-12">
				<label>Set Due Date</label>
				<input type="date" name="student_due_date" id="student_due_date" value="<?php echo $student_due_date ?>" class="form-control" required />
				</div>
				</td>
				</tr>
				<tr>
				<td colspan="3">
				<center><input type="submit" name="submit" value="Submit" class="btn btn-success" /></center>
				</td>
				</tr>
				</table>
				</div>
			  </div>
			  </div>
			  </div>
			  </div>
			</form>
			</div>
		</div>
	</div>
  </div>
      <!-- /.row -->
  </section>
  </div>
    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php"); ?>
 <?php include("../attachment/sidebar_2.php"); ?>
 <?php include("../attachment/link_js.php"); ?>

<script>
  $(function () {
    $('#example1').DataTable()
  
  });
</script>
</body>
</html>
<?php
if(isset($_POST['submit'])){
$student_due_class=$_POST['student_due_class'];
$student_due_title=$_POST['student_due_title'];
$student_due_installment=$_POST['student_due_installment'];
$student_due_date=$_POST['student_due_date'];
$count1=count($student_due_class);
$query_result=0;
$student_due_class_code='';
for($i=0;$i<$count1;$i++){
$student_due_class1=explode('|?|',$student_due_class[$i]);
$student_due_class[$i]=$student_due_class1[0];
$student_due_class_code[$i]=$student_due_class1[1];
$query4="update hostel_due_date_schedule set student_due_title='$student_due_title',student_due_installment='$student_due_installment',student_due_class='$student_due_class[$i]',student_due_class_code='$student_due_class_code[$i]',student_due_date='$student_due_date',$update_by_update_sql  where session_value='$session1' and s_no='$edit_sno'";
if(mysqli_query($conn73,$query4)){
$query_result=$query_result+1;
}
}
if($query_result>0){
echo "<script>alert_new('Successfully Completed !!!');</script>";
echo "<script>window.open('set_hostel_due_date_schedule.php','_self');</script>";
}
}
?>