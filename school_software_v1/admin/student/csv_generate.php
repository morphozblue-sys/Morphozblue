<?php include("../attachment/session.php")?>


 <script type="text/javascript">

		
  var page112 = access_link+"student/csv_download.php";
	 $('#my_form1').attr('action',page112);

</script>

    <section class="content-header">
      <h1>
        CSV Student
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
		<li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('student/students')"><i class="fa fa-phone-square"></i>Student</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Generate CSV</li>
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
              <h3 class="box-title">CSV Student</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body ">
			<form method="post" action="" enctype="multipart/form-data" id="my_form1" target="_blank">
			
					
					
					 <div class="col-md-12">
						<div class="form-group" >
					<input type="checkbox" value="" id="check_all" onclick="for_check(this.id);" checked><th><b style="color:red;">Check All Field/Unchecked All</b></th>
						 </div>
						 </div>
					
					
				 <input type="checkbox" checked name="student_data[]" value="s_no" style="display:none" >
				  <div class="col-md-2">				
			      <div class="form-group" >
				  <input type="checkbox" checked name="student_data[]"   onclick="return false" value="student_name" ><th><b>Student Name</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]"  onclick="return false" value="student_father_name" ><th><b>Father Name</b></th>
					 </div>
				  </div>
				
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]"  onclick="return false" value="student_mother_name" ><th><b>Mother Name</b></th>
						</div>
				   </div>
				     <div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]"  onclick="return false" value="student_date_of_birth" ><th><b>Student Date Of Birth</b></th>
						</div>
					</div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]"  onclick="return false" value="student_class"><th><b>Student Class</b></th>
						</div>
					</div>
						<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]"  onclick="return false" value="student_gender" ><th><b>Student Gender</b></th>
						</div>
					</div>
				
					
				
					
					<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_class_section" class="check_all"><th><b>Student Class Section</b></th>
						</div>
					</div>
				
					
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_category" class="check_all"><th><b>Student Category</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_religion" class="check_all"><th><b>Student Religion</b></th>
						</div>
					</div>
				
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_adhar_number" class="check_all"><th><b>Student Adhar Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_adhar_card_number" class="check_all"><th><b>Student Father Adhar card Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_sssmid_number" class="check_all"><th><b>Student Ssmid Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_child_id" class="check_all"><th><b>Student Child Id</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_bank_name" class="check_all"><th><b>Student Father Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_bank_account_number" class="check_all"><th><b>Student Father Bank Account Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_bank_ifsc_code" class="check_all"><th><b>Student Father Bank Ifsc Code</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_bank_name" class="check_all"><th><b>Student Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_account_number" class="check_all"><th><b>Student Account Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_bank_ifsc_code" class="check_all"><th><b>Student Bank Ifsc Code</b></th>
						</div>
					</div>
					
				
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_date_of_admission" class="check_all"><th><b>Student Date Of Admission</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_number" class="check_all"><th><b>Student Admission Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_scholar_number" class="check_all"><th><b>Student Scholar Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_contact_number" class="check_all"><th><b>Student Father Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_mother_contact_number" class="check_all"><th><b>Student Mother Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_occupation" class="check_all"><th><b>Student Father Occupation</b></th>
						</div>
					</div>
					
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_contact_number" class="check_all"><th><b>Student Contact Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_email_id" class="check_all"><th><b>Student Email Id</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_adress" class="check_all"><th><b>Student Address</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_city" class="check_all"><th><b>Student City</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_district" class="check_all"><th><b>Student District</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_pincode" class="check_all"><th><b>Student Pincode</b></th>
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
 

 <script>
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
function for_validity(){

var total_student=document.getElementById("total_student").value
if(total_student==''){
alert_new('Please Select Total Student !!!',"red");
return false;
}else{
	
return true;
}
}
</script>

