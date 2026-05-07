<?php include("../attachment/session.php"); ?>
<script>
 function validation(){
 var category= document.getElementById('std_category').value;
 var gender= document.getElementById('std_gender').value; 
 var std_class= document.getElementById('std_class').value; 
 //alert_new(category+gender+std_class);
 if(category!='' || gender!='' || std_class!=''){
 return true;
 }else{
  alert_new("Please Choose Atleast One Field",'red');
  return false;
 }
 }
 </script>

 <script type="text/javascript">
 function for_section(value){

       $.ajax({
			  type: "POST",
              url: access_link+"downloads/ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function(detail){
                 $("#student_class_section").html("<option value='All'>All</option>"+detail);
              }
           });

    }
    
function for_age(value,id,id1){
    if(Number(value)<=100){
    if(value!=''){
    $('#'+id1).val(value);
    }else{
    $('#'+id1).val('0');
    }
    }else{
    $('#'+id).val('0');
    $('#'+id1).val('0');
    }
}
    
		    function form_submit(){

		    $.ajax({
           type: "POST",
            url: access_link+"downloads/student_data.php",
           data: $("#my_form1").serialize(), 
           success: function(data1)
           {

			$('#get_content').html(data1);
		
           }
         });
      }
</script>

    <section class="content-header">
      <h1>
        Download Student Info
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Select Student</li>
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
              <h3 class="box-title">Download Student Info</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post"  enctype="multipart/form-data" id="my_form1">
			<div class="col-md-12">
		     <div class="col-md-2">				
			      <div class="form-group" >
				  <th><b  style="font-size:15px">Choose Category</b></th>
				<select name="category" id="std_category" class="form-control">
				<option value="All">All</option>
				<option value="General">General</option>
				<option value="Obc">Obc</option>
				<option value="Sc">Sc</option>
				<option value="St">ST</option>
				</select>
				  </div>
				  </div>	
				  <div class="col-md-2">				
			      <div class="form-group" >
				  <th><b   style="font-size:15px">Choose Gender</b></th>
				<select name="gender" id="std_gender" class="form-control">
				<option value="All">All</option>
				<option value="Male">Boys</option>
				<option value="Female">Girls</option>
				</select>
				  </div>
				  </div>	
				   <div class="col-md-2">				
			      <div class="form-group" >
				  <th><b   style="font-size:15px">Choose Class</b></th>
				<select name="std_class" class="form-control new_student" id="std_class" onchange="for_section(this.value);" >
				<option value="">All</option>
				<?php 
				$sql= "select * From school_info_class_info";
				$result=mysqli_query($conn73,$sql);
				while($row=mysqli_fetch_assoc($result)){
				$class_name=$row['class_name'];
				 ?>
				<option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
				<?php } ?>
				</select>
				  </div>
				  </div>
				  
					<div class="col-md-2">
				     <div class="form-group" >
					  <th><b style="font-size:15px">Section</b></th>
					 <select class="form-control" name="student_class_section" id="student_class_section">
					 <option value="All">All</option>
	                 </select>
					</div>
					</div>
					
					 <div class="col-md-2">
				     <div class="form-group" >
					  <th><b style="font-size:15px">Student Old/New</b></th>
					 <select class="form-control" name="student_old_new" id="student_old_new">
					 <option value="All">All</option>
					  <option value="Old">Old</option>
					  <option value="New">New</option>
					  
	                 </select>
					</div>
					</div>
					
					<div class="col-md-2">
				     <div class="form-group" >
					  <th><b style="font-size:15px">Medium</b></th>
					 <select class="form-control" name="student_Medium" id="student_Medium">
					 <option value="All">All</option>
					 <option value="Hindi">Hindi</option>
					 <option value="English">English</option>
	                 </select>
					</div>
					</div>
					<div class="col-md-1">
				     <div class="form-group" >
					  <th><b style="font-size:15px">Bus</b></th>
					 <select class="form-control" name="student_Bus" id="student_Bus">
					 <option value="All">All</option>
					  <option value="Yes">Yes</option>
					   <option value="No">No</option>
	                 </select>
					</div>
					</div>
					<div class="col-md-2">
				     <div class="form-group" >
					  <th><b style="font-size:15px">Student Status</b></th>
					 <select class="form-control" name="Student_Status" id="Student_Status">
					 <option value="All">All</option>
					 <option value="Active">Active</option>
					 <option value="Deleted">Deactive</option>
					 <option value="Tc_issued">Tc Issued</option>
	                 </select>
					</div>
					</div>
					
					<div class="col-md-1">
				     <div class="form-group" >
					  <th><b style="font-size:15px">Hostel</b></th>
					 <select class="form-control" name="Student_hostel" id="Student_hostel">
					 <option value="All">All</option>
					 <option value="Yes">Yes</option>
					 <option value="No">No</option>
					 
	                 </select>
					</div>
					</div>
					
					<div class="col-md-3">
					 <label>Bus Category</label>
				     <select class="form-control select2" name="bus_fee_category_name" id="bus_fee_category_name" style="width:100%">
					           <option  value="All">All</option>
						       <?php
								$query18="select * from bus_fee_category where bus_fee_category_name!=''";
								$run18=mysqli_query($conn73,$query18) or die(mysqli_query($conn73));
								while($row=mysqli_fetch_assoc($run18)){
								$bus_fee_category_name=$row['bus_fee_category_name'];
								$bus_fee_category_code=$row['bus_fee_category_code'];
								?>
								<option value="<?php echo $bus_fee_category_code; ?>"><?php echo $bus_fee_category_name; ?></option>
								<?php } ?>
					 </select>
				    </div>
				    <div class="col-md-2">
					 <label>Admission Scheme</label>
				     <select class="form-control" name="admission_scheme" id="admission_scheme">
					    <option  value="All">All</option>
						<option value="RTE">RTE</option>
						<option value="NON-RTE">NON-RTE</option>
						<option value="Granted">Granted</option>
						</select>
				    </div>
				    
				  <div class="col-md-3">
					 <label>Student Address</label>
				     <select class="form-control select2" name="student_adress" id="student_adress" style="width:100%">
					           <option  value="All">All</option>
						       <?php
								$query112="select student_adress from student_admission_info where session_value='$session1'$filter37 GROUP BY student_adress";
								$run112=mysqli_query($conn73,$query112) or die();
								while($row112=mysqli_fetch_assoc($run112)){
								$student_adress=$row112['student_adress'];
								?>
								<option value="<?php echo $student_adress; ?>"><?php echo $student_adress; ?></option>
								<?php } ?>
					 </select>
				    </div>
				    </div>
				    <div class="col-md-12">
				    
				    <div class="col-md-2">
					 <label>Student Conveyance</label>
				    <select class="form-control" name="student_conveyance" id="student_conveyance">
					    <option  value="All">All</option>
						<option value="With Parent">With Parent</option>
					    <option value="By Bus">By Bus</option>
					    <option value="With Guardian">With Guardian</option>
					    <option value="On Foot">On Foot</option>
					</select>
				    </div>
				    
		<div class="col-md-2">
			<div class="form-group">
			  <label>Select Category</label>
			   <select name="student_fee_category" id="student_fee_category">
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
				    
				    
				    <div class="col-md-2">
					 <label>Photo <small>( All / Yes / No )</small></label>
				    <select class="form-control" name="student_photo1" id="student_photo1">
					    <option  value="All">All</option>
						<option value="Yes">Yes</option>
					    <option value="No">No</option>
					</select>
				    </div>
				    
				    <div class="col-md-6">
					 <label><?php echo $language['Age (In Years)']; ?></label>
					 <div class="input-group">
					<input style="width:100%;" type="range" name="student_age" id="student_age" value="0" oninput="for_age(this.value,this.id,'student_age_txt');" >
					 <span class="input-group-addon" style="padding:0px;">
					 <input style="color:red;font-size:20px;width:100px;" name="student_age_txt" id="student_age_txt" oninput="for_age(this.value,this.id,'student_age');" style="border:none;" >
					 </span>
					</div>
				</div>
				</div>
				<div class="col-md-12">
				<div class="col-md-2">
					 <label>Order By</label>
				     <select class="form-control" name="order_by" id="order_by">
					    <option  value="">Select</option>
						<option value="student_name">Student Name</option>
						<option value="class_code_no">Class Name</option>
						<option value="student_class_section">Only Section</option>
						<option value="student_father_name">Father Name</option>
						<option value="school_roll_no">School Roll No</option>
						<option value="student_admission_number">Admission No</option>
						<option value="student_scholar_number">Scholar No</option>
						<option value="student_registration_number">Registration No</option>
						<option value="student_enrollment_number">Enrollment No</option>
						<option value="student_category">Student Category</option>
					 </select>
				    </div>
					
				  </div>	
        			</br></br></br>
					<hr>
					
					 <div class="col-md-12">
						<div class="form-group" >
					<input type="checkbox" value="" id="check_all" onclick="for_check(this.id);" checked><th><b style="color:red;">Check All Field/Unchecked All</b></th>
						 </div>
						 </div>
					
					
				   <div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_scholar_number|?|student scholar number" class="check_all"><th><b>Student Scholar Number</b></th>
						</div>
					</div>
				
				  <div class="col-md-2">				
			      <div class="form-group" >
				  <input type="checkbox" checked name="student_data[]" value="student_name|?|student name" class="check_all"><th><b>Student Name</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="student_father_name|?|student father name" class="check_all"><th><b>Father Name</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_mother_name|?|student mother name" class="check_all"><th><b>Mother Name</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_class|?|student class" class="check_all"><th><b>Student Class</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_class_section|?|Student Class Section" class="check_all"><th><b>Student Class Section</b></th>
						</div>
					</div>
						<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_class_stream|?|Student Class Stream" class="check_all"><th><b>Student Class Stream</b></th>
						</div>
					</div>
						<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_class_group|?|Student Class Group" class="check_all"><th><b>Student Class Group</b></th>
						</div>
					</div>
					
					
					
					<div class="col-md-2">	
					<div class="form-group">
					  <input type="checkbox" checked name="student_data[]" value="student_roll_no|?|student roll no" class="check_all"><th><b>Student Roll No</b></th>
					</div>
				    </div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="school_roll_no|?|school roll no" class="check_all"><th><b>School Roll No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_date_of_birth|?|student date of birth" class="check_all"><th><b>Student Date Of Birth</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_gender|?|student gender" class="check_all"><th><b>Student Gender</b></th>
						</div>
					</div>
					
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_caste|?|student caste" class="check_all"><th><b>Student Caste</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_category|?|student category" class="check_all"><th><b>Student Category</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_city|?|student city" class="check_all"><th><b>Student City</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_bus_fee_category|?|student bus fee catgeory" class="check_all"><th><b>Student Bus Stop</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_sssmid_number|?|student sssmid number" class="check_all"><th><b>Student Ssmid Number</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_adhar_number|?|student adhar number" class="check_all"><th><b>Student Adhar Number</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_enrollment_number|?|student enrollment number" class="check_all"><th><b>Student Enrollment Number</b></th>
						</div>
					</div>
					
					<!--<div class="col-md-2">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_photo|?|Student Photo" class="check_all"><th><b>Student Photo</b></th>
						</div>
					</div>-->
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_handicapped|?|student handicapped" class="check_all"><th><b>Student Handicapped</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="student_rf_id_number|?|student rf id number" class="check_all"><th><b>Student Rfid Number</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_adhar_card_number|?|student father adhar card number" class="check_all"><th><b>Student Father Adhar card Number</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_child_id|?|student child id" class="check_all"><th><b>Student Child Id</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_family_id|?|student family id" class="check_all"><th><b>Student Family Id</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_walk_through|?|Student Walk Through" class="check_all"><th><b>Student Conveyance</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="bpl_card_no|?|bpl card no" class="check_all"><th><b>Bpl Card No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="income_certificate_no|?|income certificate no" class="check_all"><th><b>Income Certificate No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="caste_certificate_no|?|caste certificate no" class="check_all"><th><b>Caste Certificate No</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_bank_name|?|student father bank name" class="check_all"><th><b>Student Father Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_bank_account_number|?|student father bank account number" class="check_all"><th><b>Student Father Bank Account Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_bank_ifsc_code|?|student father bank ifsc code" class="check_all"><th><b>Student Father Bank Ifsc Code</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_bank_name|?|student bank name" class="check_all"><th><b>Student Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_account_number|?|student account number" class="check_all"><th><b>Student Account Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_bank_ifsc_code|?|student bank ifsc code" class="check_all"><th><b>Student Bank Ifsc Code</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_type|?|student admission type" class="check_all"><th><b>Student Admission Type</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_medium|?|student medium" class="check_all"><th><b>Student Medium</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="house_name|?|house name" class="check_all"><th><b>Student House Name</b></th>
						</div>
					</div>
					
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_date_of_admission|?|student date of admission" class="check_all"><th><b>Student Date Of Admission</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_previous_class|?|student previous class" class="check_all"><th><b>Student Previous Class</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_class|?|student admission class" class="check_all"><th><b>Student admission Class</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_previous_school_name|?|student previous school name" class="check_all"><th><b>Student Previous School Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_scheme|?|student admission scheme" class="check_all"><th><b>Student Admission Scheme</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_number|?|student admission number" class="check_all"><th><b>Student Admission Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_contact_number|?|student father contact number" class="check_all"><th><b>Student Father Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_mother_contact_number|?|student Mother Contact Number" class="check_all"><th><b>Student Mother Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_occupation|?|student father occupation" class="check_all"><th><b>Student Father Occupation</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_guardian_name|?|Student Guardian Name" class="check_all"><th><b>Student Guardian Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_guardian_contact_number|?|student guardian contact number" class="check_all"><th><b>Student Guardian Contact Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_contact_number|?|student contact number" class="check_all"><th><b>Student Contact Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_email_id|?|student email id" class="check_all"><th><b>Student Email Id</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_adress|?|student adress" class="check_all"><th><b>Student Address</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_address_permanent|?|student permanent address" class="check_all"><th><b>student permanent Address</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_district|?|student district" class="check_all"><th><b>Student District</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_pincode|?|student pincode" class="check_all"><th><b>Student Pincode</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_bus_no|?|student bus no" class="check_all"><th><b> Student Bus No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_hostel_name|?|student hostel name" class="check_all"><th><b>Student Hostel Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_hostel_room_no|?|student hostel room no" class="check_all"><th><b>Student Hostel Room No</b></th>
						</div>
					</div>
					
						<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_religion|?|student religion" class="check_all"><th><b>Student Religion</b></th>
						</div>
					</div>
					
					</div>
		    <div class="col-md-12">
		        <center><input type="button" name="submit" value="Submit" class="btn btn-primary" onclick="return for_validity();" /></center>
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
var num2=0;
$(".check_all").each(function() {
if($(this).prop('checked')==true){ 
	num2 += Number(parseInt(num2)+1);
}
});
if(num2<1){
alert_new('Please Select Atleast One Field !!!','red');
return false;
}else{
	form_submit();
return true;
}
}
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
