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
var student_class=document.getElementById('student_class_search').value;
var section=document.getElementById('student_section_search').value;
var verify_or_not=document.getElementById('student_verify_unverify').value;
var installment_no=document.getElementById('student_installment_no').value;
if(verify_or_not!='' || installment_no!=''){

$.ajax({
type: "POST",
url: "ajax_student_hostel_challan_list.php",
data: {verify_or_not:verify_or_not,installment_no:installment_no,student_class:student_class,section:section},
success: function(detail){
$('#for_challan_list').html(detail);
  }
});

}else{
$('#for_challan_list').html('');
}
}

function validation(){
var myval=confirm('Do You Want to Delete This Record !!!');
if(myval==true){
return true;
}else{
return false;
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

</script>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Fee Challan List
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Challan List</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
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
			  
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
			  <div class="container-fluid">
			  <h2>List Panel</h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
			  
			    <div class="col-sm-3">
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
			    <div class="col-sm-3">
				<label>Section</label>
				<select name="" id="student_section_search" class="form-control" onchange="for_search11();">
				<option value="All">All</option>
				
				</select>
				</div>
			    <div class="col-sm-3">
				<label>Verify / Unverify</label>
				<select name="student_verify_unverify" id="student_verify_unverify" class="form-control" onchange="for_search11();" required >
				<option value="">Select</option>
				<option value="Yes">Verify</option>
				<option value="No">Unverify</option>
				</select>
				</div>
				<div class="col-sm-3">
				<label>Installment No.</label>
				<select name="student_installment_no" id="student_installment_no" class="form-control" onchange="for_search11();" required >
				<option value="">Select Installment</option>
				<option value="installment1">installment1</option>
				<option value="installment2">installment2</option>
				<option value="installment3">installment3</option>
				<option value="installment4">installment4</option>
				</select>
				</div>
				
			  </div>
			  </div>
			  </div>
			  </div>
			  <div class="col-sm-2"></div>
<div id="for_challan_list">

</div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
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