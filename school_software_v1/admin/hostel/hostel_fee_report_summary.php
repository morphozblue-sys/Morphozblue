 <?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
<html>
<head>
 
 <?php include("../attachment/link_css.php"); ?>
  <script>
   function for_section(value){
   if(value=='All'){
   $("#student_section").html('<option value="All">All</option>');
   }else{
   var val1=value.split('|?|');
   var val2=val1[1];
       $.ajax({
			  type: "POST",
              url: "ajax_class_section_all.php?class_name="+val2+"",
              cache: false,
              success: function(detail){
                  $("#student_section").html(detail);
              }
           });
	}
}

function for_download(){
var student_class=document.getElementById('student_class').value;
var student_section=document.getElementById('student_section').value;
var category=document.getElementById('student_category').value;
var installment=document.getElementById('installment_number').value;
var verify=document.getElementById('verify_unverify').value;
var from_date=document.getElementById('date_from').value;
var to_date=document.getElementById('date_to').value;
var student_status=document.getElementById('student_status').value;
window.open("hostel_fee_report_summary_excel.php?student_class="+student_class+"&student_section="+student_section+"&category="+category+"&installment="+installment+"&verify="+verify+"&from_date="+from_date+"&to_date="+to_date+"&student_status="+student_status,"_blank");
}

</script>


</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">
<?php include("../attachment/header.php"); ?> 
<?php include("../attachment/sidebar.php");?>
<?php include("../../con73/con37.php");    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Summary Report
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="hostel.php"><i class="fa fa-phone-square"></i> Hostel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Summary Report</li>
      </ol>
    </section>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h2 class="box-title">Hostel Summary Details
			 </h2>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
         <div class="box-body "  >
		 <form role="form" method="post" action='' enctype="multipart/form-data">			
		 <div class="col-md-12"><h3>Class & Category Info :- </h3></div>
		 <div class="col-md-12">
		 <div class="col-md-1">&nbsp;</div>
		 <div class="col-md-2">
		 <label>Student Class</label>
		 <select name="student_class" id="student_class" class="form-control" onchange="for_section(this.value);" required >
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
		 <div class="col-md-2">
		 <label>Section</label>
		 <select name="student_section" id="student_section" class="form-control" required >
		 <option value="All">All</option>
		 </select>
		 </div>
		 <div class="col-md-2">
		 <label>Category</label>
		 <select name="student_category" id="student_category" class="form-control" required >
		 <option value="All">All Category</option>
		 <option value="category3|?|New Hostlers">New Hostlers</option>
		 <option value="category4|?|Old Hostlers">Old Hostlers</option>
		 </select>
		 </div>
		  <div class="col-md-2">
		 <label>Installment</label>
		 <select name="installment_number" id="installment_number" style="width:100%;" class="form-control" required >
		 <option value="All">All Installment</option>
		 <option value="installment1">installment1</option>
		 <option value="installment2">installment2</option>
		 <option value="installment3">installment3</option>
		 <option value="installment4">installment4</option>
		 </select> 
		 </div>
		 <div class="col-md-2">
		 <label>Verify / Unverify</label>
		 <select name="verify_unverify" id="verify_unverify" style="width:100%;" class="form-control" required >
				<option value="All">All</option>
				<option value="Yes">Verify</option>
				<option value="No">Unverify</option>
				</select> 
		 </div>
		 <div class="col-md-1">&nbsp;</div>
		 <div class="col-md-3">&nbsp;</div>
		 <div class="col-md-2">
		 <label>From Date</label>
		 <input type="date" name="date_from" id="date_from" class="form-control" />
		 </div>
		 <div class="col-md-2">
		 <label>To Date</label>
		 <input type="date" name="date_to" id="date_to" class="form-control" />
		 </div>
		 <div class="col-md-2">
		 <label>Student Status</label>
		 <select name="student_status" id="student_status" style="width:100%;" class="form-control" >
		 <option value="All">All</option>
		 <option value="Normal">Normal</option>
		 <option value="Left">Left</option>
		 <option value="TC">TC</option>
		 </select>
		 </div>
		 <div class="col-md-3">&nbsp;</div>
		 </div>				
					
		<div class="col-md-12">&nbsp;</div>
		<div class="col-md-12">
		<div class="col-md-5">&nbsp;</div>
		   <div class="col-md-1">
		   <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></center>
		   </div>
		   <div class="col-md-1">
		   <center><button type="button" name="button" class="btn btn-success" onclick="for_download();" >Excel Download</button></center>
		   </div>
		   <div class="col-md-5">&nbsp;</div>
		   </div>
		   </form>	
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
  
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php"); ?>
 <?php include("../attachment/sidebar_2.php"); ?>
</div>
 <?php include("../attachment/link_js.php"); ?>
</body>
</html>
<?php
if(isset($_POST['submit'])){
$student_class=$_POST['student_class'];
$student_section=$_POST['student_section'];
$student_category=$_POST['student_category'];
$installment_number=$_POST['installment_number'];
$verify_unverify=$_POST['verify_unverify'];
$date_from=$_POST['date_from'];
$date_to=$_POST['date_to'];
$student_status=$_POST['student_status'];

echo "<script>window.open('../pdf/hostel_fee_summary_report.php?class=$student_class&section=$student_section&category=$student_category&installment_no=$installment_number&verify=$verify_unverify&date_from=$date_from&date_to=$date_to&student_status=$student_status','_blank');</script>";
}
?>