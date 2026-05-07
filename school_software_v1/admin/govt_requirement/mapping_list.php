<?php include("../attachment/session.php"); ?>
   <script>
   function for_section(value){
       $("#student_class_section").html("<option value=''>Loading.....</option>");
       $.ajax({
			  type: "POST",
              url: access_link+"govt_requirement/ajax_section.php?class_name="+value+"",
              cache: false,
              success: function(detail){
                  $("#student_class_section").html(detail);
              }
           });
   }
   
   	    function form_submit(){
		    $.ajax({
           type: "POST",
            url: access_link+"govt_requirement/mapping_list_downloads.php",
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
        <?php echo $language['Goverment Requirement Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	 <li><a href="javascript:get_content('govt_requirement/govt_requirement')"><i class="fa fa-stack-overflow"></i> <?php echo $language['Govt. Requir.']; ?></a></li>
	  <li class="active"><?php echo $language['Mapping List']; ?></li>
      </ol>
    </section>

	
	
	<!---*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
	  
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Mapping List</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			<form role="form" method="post" enctype="multipart/form-data" id="my_form1">
			<div class="col-md-12">
		 	
			         <div class="col-md-2">
					 </div>
				   <div class="col-md-8">
                    <div class="col-md-6">				   
			      <div class="form-group" >
				  <th><b style="font-size:15px">Choose Class</b></th>
				<select name="std_class" class="form-control new_student" id="std_class" onchange="for_section(this.value);" >
				<option value="All">All</option>
				<?php 
				$sql= "select * From school_info_class_info";
				$result=mysqli_query($conn73,$sql);
				while($row=mysqli_fetch_assoc($result)){
				$class_name=$row['class_name'];
				 ?>
				<option value="<?php  echo $class_name; ?>"><?php echo $class_name; ?></option>
				<?php } ?>
				</select>
				  </div>
				  </div>
				  
					<div class="col-md-6">
				     <div class="form-group" >
					  <th><b style="font-size:15px">Section</b></th>
					 <select class="form-control" name="student_class_section" id="student_class_section">
					 <option value="All">All</option>
	                 </select>
					</div>
					</div>
					</div>
					<div class="col-md-2">
					 </div>
			
				  </div>	
        			</br></br></br>
					<hr>
					
					<div class="col-md-12">
					 <div class="col-md-12">
						<div class="form-group" >
					<input type="checkbox" value="" id="check_all" onclick="for_check(this.id);" checked><th><b style="color:red;">Check All Field/Unchecked All</b></th>
						 </div>
						 </div>
					
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="student_admission_number|?|Admission No" class="check_all"><th><b>Admission No.</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="student_date_of_admission|?|Admission Date" class="check_all"><th><b>Admission Date</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_name|?|student name" class="check_all"><th><b>Student's Name</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_father_name|?|student father name" class="check_all"><th><b>Father's Name</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_mother_name|?|student mother name" class="check_all"><th><b>Mother's Name</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_gender|?|Gender" class="check_all"><th><b>Gender</b></th>
						</div>
					</div>
					<div class="col-md-2 ">	
					<div class="form-group" >
					  <input type="checkbox" checked name="student_data[]" value="student_category|?|Student Category" class="check_all"><th><b>Category(Cast)</b></th>
					</div>
				    </div>
				    <div class="col-md-2 ">	
					<div class="form-group" >
					  <input type="checkbox" checked name="student_data[]" value="student_caste|?|Student Caste" class="check_all"><th><b>student Cast</b></th>
					</div>
				    </div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_child_id|?|Student Child Id" class="check_all"><th><b>Child Id</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_bank_name|?|Student Bank Name" class="check_all"><th><b>Bank Name Student</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_account_number|?|Student Account Number" class="check_all"><th><b>Account No. Student</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_bank_ifsc_code|?|IFSC Code" class="check_all"><th><b>Ifsc Student</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_adhar_number|?|Student Adhar Number" class="check_all"><th><b>Student Adhar No.</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="student_father_adhar_card_number|?|Father Adhar No" class="check_all"><th><b>Father Adhar No.</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_family_id|?|Family Id" class="check_all"><th><b>Family Id</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_sssmid_number|?|SSSM ID" class="check_all"><th><b>SSSM ID</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_bank_name|?|Bank Name Father" class="check_all"><th><b>Bank Name Father</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_bank_account_number|?|Account No. Father" class="check_all"><th><b>Account No. Father</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_bank_ifsc_code|?|Ifsc Father" class="check_all"><th><b>Ifsc Father</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_date_of_birth|?|Student Date of Birth" class="check_all"><th><b>Student Date of Birth</b></th>
						</div>
					</div>
					
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_contact_number|?|Student Father Contact Number" class="check_all"><th><b>Contact Number</b></th>
						</div>
					</div>
					</div>
					</div>
					<br><br>
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
</body>
</html>