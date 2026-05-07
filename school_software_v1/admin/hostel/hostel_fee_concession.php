 <?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
<html>
<head>
<?php include("../attachment/link_css.php"); ?>
  <script>
   function for_section(value){
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
</script>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

<?php include("../attachment/header.php"); ?> 
<?php include("../attachment/sidebar.php"); ?>
<?php include("../../con73/con37.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Concession Report
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="hostel.php"><i class="fa fa-phone-square"></i> Hostel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> Fee Concession</li>
      </ol>
    </section>
	<?php
	$sql1="select * from school_info_hostel_head where fee_head_name!='' ORDER BY fee_head_priority";
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
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h2 class="box-title">Hostel Fee Concession Info
			 </h2>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
         <div class="box-body "  >
		<form role="form" method="post" action='export_hostel_fee.php' enctype="multipart/form-data">		
		 <div class="col-md-12"><h3>Class & Category Info :- </h3></div>
		 <div class="col-md-12">&nbsp;</div>
		 <div class="col-md-12">
		 <div class="col-md-2">&nbsp;</div>
		 <div class="col-md-2">
		 <label>Student Class</label>
		 <select name="student_class" class="form-control" onchange="for_section(this.value);" required >
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
		 <select name="student_category" class="form-control" required >
		 <option value="All">All Category</option>
		 <option value="category3|?|New Hostlers">New Hostlers</option>
		 <option value="category4|?|Old Hostlers">Old Hostlers</option>
		 </select>
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
		 <div class="col-md-2">&nbsp;</div>
		 </div>		 
		 <div class="col-md-12"><h3>Student Info :- </h3></div>				
		 <div class="col-md-12">				
		 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="student_admission_info.student_admission_number,ADMISSION NO"><th><b>Student 
				Admission No</b></th>
				  </div>
				  </div>
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="student_admission_info.student_name,STUDENT NAME"><th><b>Student Name</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="student_admission_info.student_father_name,STUDENT FATHER NAME"><th><b>Student Father Name</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_info.student_class,STUDENT CLASS"><th><b>Student Class</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_admission_info.student_class_section,SECTION"><th><b>Student Class Section</b></th>
						</div>
					</div>
			</div>

					<div class="col-md-12"><h3>Hostel Fees Discounts Info :- </h3></div>
					<div class="col-md-12">
					<div class="col-md-4">
					<div class="form-group">
					<input type="checkbox" id="discount" onclick="for_check(this.id);" checked ><th><b><span style="color:red;"> Check / Uncheck All </span></b></th>
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
					for($i=0; $i<$count; $i++){ ?>
					<div class="col-md-4">
					
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="<?php echo "student_hostel_fees_discount.".$fee_head_code[$i].'_discount_type'; ?>,<?php echo $fee_head_name[$i]." DISCOUNT TYPE"; ?>" class="discount"><th><b> <?php echo $fee_head_name[$i]." DISCOUNT TYPE"; ?> </b></th>
						</div>
					</div>
					
					<div class="col-md-4">
					
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="<?php echo "student_hostel_fees_discount.".$fee_head_code[$i]."_discount_amount"; ?>,<?php echo $fee_head_name[$i]." DISCOUNT PERCENT"; ?>" class="discount"><th><b> <?php echo $fee_head_name[$i]." DISCOUNT PERCENT"; ?></b></th>
						</div>
					
					</div>
					
					<div class="col-md-4">
					
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="<?php echo "student_hostel_fees_discount.".$fee_head_code[$i]."_discount_remark"; ?>,<?php echo $fee_head_name[$i]." DISCOUNT REMARK"; ?>" class="discount"><th><b> <?php echo $fee_head_name[$i]." DISCOUNT REMARK"; ?></b></th>
						</div>
					
					</div>
					<?php } ?>
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

