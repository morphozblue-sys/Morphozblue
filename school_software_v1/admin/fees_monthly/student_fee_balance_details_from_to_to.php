<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
        <li class="active">Balance Details</li>
      </ol>
    </section>
<script>




function for_print()
 {
 var divToPrint=document.getElementById("fee_details");
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
 
 
</script>	
<script>
function for_section(value){
   $('#student_class_section').html("<option value='' >Loading....</option>");
   $.ajax({
		  type: "POST",
		  url: access_link+"fees_monthly/ajax_classwise_section_all.php?class_name="+value+"",
		  cache: false,
		  success: function(detail){
			$("#student_class_section").html(detail);
			for_feelist();
		  }
	   });
}

function for_feelist(){
   $("#fee_details").html(loader_div);
   var student_class=document.getElementById('student_class').value;
   var student_section=document.getElementById('student_class_section').value;
   var student_fee_category=document.getElementById('student_fee_category').value;
   var order_by=document.getElementById('order_by').value;
   
   
   var month_code = [];
   var month_name = [];
   $(".my_check").each(function() {
   if($(this).prop("checked") == true){
   month_code.push($(this).val());
   month_name.push($(this).attr('id'));
   }
   });
   
   if(student_class!='' && student_section!='' && month_code!=''){
   $.ajax({
	  type: "POST",
	  url: access_link+"fees_monthly/ajax_student_fee_balance_details_monthwise.php",
	  data: {student_class:student_class,student_section:student_section,month_code:month_code,month_name:month_name,student_fee_category:student_fee_category,order_by:order_by},
	  cache: false,
	  success: function(detail){
		$("#fee_details").html(detail);
	  }
   });
   }else{
	   $("#fee_details").html('');
   }
}
</script>


	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="box box-primary my_border_top">		
        <div class="box-body">
		
		<div class="col-md-12">
		<div class="col-md-3">
			<div class="form-group">
			  <label>Select Class</label>
			   <select name="student_class" id="student_class" class="form-control" onchange="for_section(this.value);" required>
			   <option value="All">All Class</option>
			   <?php
			   $class37=$_SESSION['class_name37'];
			   $class371=explode('|?|',$class37);
			   $total_class=$_SESSION['class_total37'];
			   for($q=0;$q<$total_class;$q++){
			   $class_name=$class371[$q]; ?>
			   <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
			   <?php } ?>
			   </select>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="form-group">
			  <label>Section</label>
			  <select name="student_class_section" id="student_class_section" class="form-control" onchange="for_feelist();" required>
			  <option value="All">All</option>
			  </select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			  <label>Select Category</label>
			   <select name="student_fee_category" id="student_fee_category" class="form-control" onchange="for_feelist();" required>
			   <option value="All">All</option>
			   <?php
		    $que02="select * from school_info_fee_category where category_name!=''";
		    $run02=mysqli_query($conn73,$que02);
		    while($row02=mysqli_fetch_assoc($run02)){
		    $category_code = $row02['category_code'];
		    $category_name = $row02['category_name'];
		   ?>
		    <option value="<?php echo $category_code ?>"><?php if($category_name!=''){ echo $category_name;}?></option>
		<?php } ?>
			   </select>
			</div>
		</div>
		
		<div class="col-md-3">
		    
			<div class="form-group">
					 <label>Order By</label>
				     <select class="form-control" name="order_by" id="order_by">
					    <option  value="">Select</option>
						<option value="student_name">Student Name</option>
						<option value="student_father_name">Father Name</option>
						<option value="school_roll_no">School Roll No</option>
						<option value="student_admission_number">Admission No</option>
						<option value="student_scholar_number">Scholar No</option>
						<option value="student_registration_number">Registration No</option>
						<option value="student_enrollment_number">Enrollment No</option>
					 </select>
				    </div>
				    </div>
		
		
		
		<?php
		$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
		$run01=mysqli_query($conn73,$que01);
		$a=0;
		while($row01=mysqli_fetch_assoc($run01)){
		$fees_code[$a] = $row01['fees_code'];
		$fees_type_name[$a] = $row01['fees_type_name'];
		?>
		<div class="col-md-2">
			<input type="checkbox" id="<?php echo $fees_type_name[$a]; ?>" class="my_check" value="<?php echo $fees_code[$a]; ?>" onclick="for_feelist();" /><span style="font-weight:bold;"> <?php echo $fees_type_name[$a]; ?></span>
		</div>
		<?php $a++; } ?>
		
		<div class="col-md-12">
		</div>
		</div>
		
		</div>
		</div>
		
		    
          <div class="box box-warning" style="marging-top:10px">
			
		<div class="box-body" >
		<div class="col-md-12" id="fee_details">
		
		
		</div>
		</div>
		  
		    
		</div>
		</div>
		
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>
<script>
for_feelist();
</script>



