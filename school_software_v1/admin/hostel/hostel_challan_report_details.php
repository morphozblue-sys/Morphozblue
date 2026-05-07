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

function for_document(value1){
var student_class=document.getElementById('student_class').value;
var section=document.getElementById('student_section').value;
var category=document.getElementById('student_category').value;
var installment=document.getElementById('installment_number').value;
var verify=document.getElementById('verify_unverify').value;
var from_date=document.getElementById('date_from').value;
var to_date=document.getElementById('date_to').value;
var student_status=document.getElementById('student_status').value;
if($('#summarization').prop('checked')==true){
var summarize='Yes';
}else{
var summarize='No';
}
if(value1=='headwise'){
window.open("../pdf/hostel_challan_report_headwise_pdf.php?student_class="+student_class+"&section="+section+"&category="+category+"&installment="+installment+"&verify="+verify+"&from_date="+from_date+"&to_date="+to_date+"&summarize="+summarize+"&student_status="+student_status);
}
}
</script>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">
<?php include("../attachment/header.php"); ?> <?php include("../attachment/sidebar.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Challan Report
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="hostel.php"><i class="fa fa-phone-square"></i> Hostel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Challan Report</li>
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
              <h2 class="box-title">Hostel Challan Details
			 </h2>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
         <div class="box-body "  >
		 <form role="form" method="post" action='hostel_challan_report_details_export.php' enctype="multipart/form-data">
			<?php 
			include("../../con73/con37.php");
			$sql1="select * from school_info_hostel_head where fee_head_name!=''";
			$a=0;
			$result1=mysqli_query($conn73,$sql1);
			while($row1=mysqli_fetch_assoc($result1)){
		    $fee_head_code1= $row1['fee_head_code'];
			$fee_head_code[$a]=$fee_head_code1;
		    $fee_head_name1= $row1['fee_head_name'];			
		    $fee_head_name[$a]=$fee_head_name1;			
			$a++;
			}
			?>
		 <div class="col-md-8"><h3>Class & Category Info :- </h3></div>
		 <div class="col-md-2"><input type="checkbox" name="" id="summarization" value="Yes" /> <b>Summarize</b></div>
		 <div class="col-md-2">
		 <div class="dropdown">
			<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Download PDF
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
			  <li><a href="#" onclick="for_document('headwise');" >Headwise</a></li>
			</ul>
		  </div>
		 </div>
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
		 <div class="col-md-12"><h3>Student Info :- </h3></div>				
		 <div class="col-md-12">				
		 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="student_admission_info.student_admission_number,Admission No"><th><b>Student 
				Admission No</b></th>
				  </div>
				  </div>
				  
				  <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="student_admission_info.student_adhar_number,Student UID"><th><b>Student UID</b></th>
				  </div>
				  </div>
				  
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="student_admission_info.student_name,Student Name"><th><b>Student Name</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="student_admission_info.student_father_name,Student Father Name"><th><b>Student Father Name</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_info.student_class,Student Class"><th><b>Student Class</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_admission_info.student_class_section,Section"><th><b>Student Class Section</b></th>
						</div>
					</div>
				    <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_hostel_fees_paid.challan_no,Challan No"><th><b>Challan No</b></th>
						</div>
					</div>
			</div>

					<div class="col-md-12"><h3>Challan Fee Info :- </h3></div>
					<div class="col-md-12">
					<div class="col-md-4">
					<div class="form-group">
					<input type="checkbox" id="fee_head" onclick="for_check(this.id);" checked ><th><b><span style="color:red;"> Check / Uncheck All </span></b></th>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
					&nbsp;
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
					&nbsp;
					</div>
					</div>
					</div>
					
					<div class="col-md-12">
				 <?php $count=count($fee_head_code);
					
					for($i=0; $i<$count; $i++){
                      
					?>
					<div class="col-md-4">
					
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="<?php echo "student_hostel_fees_paid.".$fee_head_code[$i]; ?>,<?php echo $fee_head_name[$i]; ?>" class="fee_head"><th><b> <?php echo $fee_head_name[$i]; ?> </b></th>
						</div>
					</div>
										
					<?php }  ?>
					
					<div class="col-md-4">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_hostel_fees_paid.penalty_amount,Penalty" class="fee_head"><th><b> Penalty</b></th>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_hostel_fees_paid.total_amount,Total" class="fee_head"><th><b> Total Amount</b></th>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_hostel_fees_paid.remark,Remark" class="fee_head"><th><b> Remark</b></th>
						</div>
					</div>
					
					</div>
					
				
					
		<div class="col-md-12">
		   <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></center>
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

