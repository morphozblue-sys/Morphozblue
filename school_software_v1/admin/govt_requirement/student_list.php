<?php include("../attachment/session.php"); ?>
  
  	<script type="text/javascript">
   function for_section(value){
       $("#student_class_section1").html("<option value=''>Loading.....</option>");
       $.ajax({
			  type: "POST",
              url: access_link+"govt_requirement/ajax_class_section_all.php?class_name="+value+"",
              cache: false,
              success: function(detail){
                  $("#student_class_section1").html(detail);
                  for_student();
              }
           });
    } 
	 function for_class(filter){
	  $("#class_and_section").show();
	  document.getElementById('filter_name').value=filter;
	  document.getElementById('filter_name').value=filter;
	 }
	 function for_filter(value){
	  $("#class_and_section").hide();
           if(value=="student_religion"){
		   $("#religion_filter").show();
		   $("#gender_filter").hide();
		   $("#government_filter").hide();
		   $("#regular_private_filter").hide();
		   $("#categories_filter").hide();
		   $("#handicapped_filter").hide();
		   }
		   if(value=="student_gender"){
		   $("#religion_filter").hide();
		   $("#gender_filter").show();
		   $("#government_filter").hide();
		   $("#regular_private_filter").hide();
		   $("#categories_filter").hide();
		   $("#handicapped_filter").hide();
		   }
		   if(value=="student_category"){
		   $("#religion_filter").hide();
		   $("#gender_filter").hide();
		   $("#government_filter").hide();
		   $("#regular_private_filter").hide();
		   $("#categories_filter").show();
		   $("#handicapped_filter").hide();
		   }
		   if(value=="student_admission_scheme"){
		   $("#religion_filter").hide();
		   $("#gender_filter").hide();
		   $("#government_filter").show();
		   $("#regular_private_filter").hide();
		   $("#categories_filter").hide();
		   $("#handicapped_filter").hide();
		   }
		   if(value=="student_admission_type"){
		   $("#religion_filter").hide();
		   $("#gender_filter").hide();
		   $("#government_filter").hide();
		   $("#regular_private_filter").show();
		   $("#categories_filter").hide();
		   $("#handicapped_filter").hide();
		   }
		   	   if(value=="student_handicapped"){
		   $("#religion_filter").hide();
		   $("#gender_filter").hide();
		   $("#government_filter").hide();
		   $("#regular_private_filter").show();
		   $("#categories_filter").hide();
		   $("#handicapped_filter").show();
		   }
document.getElementById('filter_type').value=value;
			}
			
	function for_student(){
	var student_class1= document.getElementById('student_class1').value;
	var student_class_section1= document.getElementById('student_class_section1').value;
	var student_class= document.getElementById('student_class').value;
	var religion= document.getElementById('religion').value;
	var gender= document.getElementById('gender').value;
	var categories= document.getElementById('categories').value;
	var regular= document.getElementById('regular').value;
	var govt= document.getElementById('govt').value;
	var handicapped= document.getElementById('handicapped').value;
	$('#mapping_student_list').html(loader_div);
   
       $.ajax({
			  type: "POST",
              url: access_link+"govt_requirement/ajax_student_list.php?student_class1="+student_class1+"&student_class_section1="+student_class_section1+"&religion="+religion+"&gender="+gender+"&categories="+categories+"&regular="+regular+"&handicapped="+handicapped+"&govt="+govt+"",
              cache: false,
              success: function(detail){
			 //alert_new(detail);
			 $('#mapping_student_list').html(detail);
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
	  <li class="active"><?php echo $language['Student List']; ?></li>
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
              <h3 class="box-title"><?php echo $language['Contact List']; ?></h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
<?php 
$que="select * from school_info_pdf_info";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){
$student_list_pdf = $row['student_list_pdf'];
}	
?>  			
            <div class="box-body "  >
			<form method='post' action="<?php echo $pdf_path; ?>govt_requirement/<?php echo $student_list_pdf; ?>" target="_blank"; enctype="multipart/form-data">
			<div class="col-md-12" >
			<div class="col-md-12" >
			 <div class="col-md-6 ">	
					<div class="form-group" >
					    <label><?php echo $language['Filter Type']; ?></label>
					    <select name="student_class" onchange="for_filter(this.value);for_student();" id="student_class" class="form-control" required>
						        <option value="">Select Filter</option>
							    <option value="student_religion">Religion Wise</option>
							    <option value="student_gender">Gender</option>
							    <option value="student_category">Categories</option>
							    <option value="student_admission_scheme">EWS/Non-EWS</option>
							    <option value="student_admission_type">Private/Regular</option>
							    <option value="student_handicapped">Handicapped</option>
					    </select>
					</div>
				</div>
			 <div class="col-md-6" id="religion_filter" style="display:none">	
					<div class="form-group" >
					    <label>Filter Type</label>
					    <select name="student_class" onchange="for_class(this.value);for_student();" id="religion" class="form-control" >
						        <option value="">Select Religion</option>
							    <option value="Hindu">Hindu</option>
							    <option value="Muslim">Muslim</option>
							    <option value="Sikh">Sikh</option>
							    <option value="Jain">Jain</option>
							    <option value="Cristian">Christian</option>
							    <option value="Other">Other</option>
					    </select>
					</div>
				</div>
			<div class="col-md-6 " id="gender_filter" style="display:none">	
					<div class="form-group">
					    <label>Filter Type</label>
					    <select name="student_class" onchange="for_class(this.value);for_student();" id="gender" class="form-control">
						       <option value="">Select Gender</option>
							    <option value="Male">Male</option>
							    <option value="Female">Female</option>
								<option value="Other">Other</option>
					    </select>
					</div>
				</div>
				<div class="col-md-6 " id="categories_filter" style="display:none">	
					<div class="form-group" >
					    <label>Filter Type</label>
					    <select name="student_class" onchange="for_class(this.value);for_student();" id="categories" class="form-control" >
						          <option value="">Select Categories</option>
							      <option value="General">General</option>
								  <option value="OBC">OBC</option>
								  <option value="SC">SC</option>
								  <option value="ST">ST</option>
								  <option value="Other">Other</option>
					    </select>
					</div>
				</div>
							 <div class="col-md-6 " id="regular_private_filter" style="display:none">	
					<div class="form-group" >
					    <label>Filter Type</label>
					    <select name="student_class" onchange="for_class(this.value);for_student();" id="regular" class="form-control" >
						       <option value="">Select Student Type</option>
							     <option value="Regular">Regular</option>
					  <option value="Private">Private</option>
					    </select>
					</div>
				</div>
				<div class="col-md-6 " id="government_filter" style="display:none">	
					<div class="form-group" >
					    <label>Filter Type</label>
					    <select name="student_class" onchange="for_class(this.value);for_student();" id="govt" class="form-control" >
						       <option value="">Select Student</option>
							    <option value="EWS">EWS</option>
					            <option value="Non-EWS">Non-EWS</option>
							    <option value="RTE">RTE</option>
							    <option value="NON-RTE">Non-RTE</option>
					    </select>
					</div>
				</div>
					<div class="col-md-6 " id="handicapped_filter" style="display:none">	
					<div class="form-group" >
					    <label>Filter Type</label>
					    <select name="student_class" onchange="for_class(this.value);" id="handicapped" class="form-control" >
						       <option value="">Select Student</option>
							    <option value="Yes">Yes</option>
					            <option value="No">No</option>
					    </select>
					</div>
				</div>
			</div>
			<div class="col-md-12" id="class_and_section"style="display:none" >
			  <div class="col-md-4">&nbsp;</div>
			  <div class="col-md-2">	
					<div class="form-group" >
					    <label>Class</label>
					    <select name="class" onchange="for_section(this.value);for_student();" id="student_class1" class="form-control" required>
							   <option value="All">All</option>
						       <?php  $que="select * from school_info_class_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $class_name=$row['class_name']; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
				<div class="col-md-2 ">	
					<div class="form-group" >
					    <label>Section</label>
					    <select class="form-control" name="section" onchange="for_student();"  id="student_class_section1">
						<option value="All">All</option>
						 
                      </select>
					</div>
				</div>
				<div class="col-md-4">&nbsp;</div>
				
				<div class="col-md-12" id="mapping_student_list">
				
				</div>
				<input type="hidden" name="filter_type" id="filter_type" value="" >
				<input type="hidden" name="filter_name" id="filter_name" value="" >
				<div class="col-md-12">	
					<center><input type="submit" name="submit" value="submit" class="btn btn-primary" ></center>
				</div>
				 	
			</div>	
			
			</div>	
		</form>	
		
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>