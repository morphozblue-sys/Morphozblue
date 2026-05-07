<?php include("../attachment/session.php")?>
<script type="text/javascript">
   function fill_detail(){
             var value=document.getElementById('student_select').value;
           var checkup=document.getElementById('checkup_id').value;
           		  $("#student_name").val('Loading....'); 
		  $("#student_class").val('Loading....'); 
          $("#student_section").val('Loading....'); 
          $("#tc_student_father_name").val('Loading....'); 
          $("#tc_mother_name").val('Loading....'); 
          $("#date_of_birth").val('Loading....'); 
          $("#date_of_birth_in_word").val('Loading....'); 
          $("#tc_student_sssm_id_no").val('Loading....'); 
          $("#tc_admission_date").val('Loading....'); 
          $("#tc_admission_no").val('Loading....'); 
          $("#school_roll_no").val('Loading....'); 
          $("#class_in_which_admitted").val('Loading....'); 
          $("#tc_student_class_leaving").val('Loading....'); 
          $("#tc_student_uid_no").val('Loading....'); 
		  $("#student_cwsn").val('Loading....'); 
		  $("#student_cwsn_description").val('Loading....'); 
			$.ajax({
			  address: "POST",
              url: access_link+"student/ajax_search_student_box_medical.php?id="+value+"",
              cache: false,
              success: function(detail){
			  //alert_new(detail);
                 var str =detail;
		  var res = str.split("|?|");
		 $("#student_roll_no").val(value); 
		  $("#student_name").val(res[0]); 
		  $("#student_class").val(res[1]); 
          $("#student_section").val(res[2]);  
          $("#tc_student_father_name").val(res[3]);  
          $("#tc_mother_name").val(res[4]);  
          $("#date_of_birth").val(res[5]);  
          $("#date_of_birth_in_word").val(res[6]);  
          $("#tc_student_sssm_id_no").val(res[7]);  
          $("#tc_admission_date").val(res[8]);  
          $("#tc_admission_no").val(res[9]);
          $("#school_roll_no").val(res[10]);
          $("#class_in_which_admitted").val(res[11]);  
          $("#tc_student_class_leaving").val(res[12]);  
          $("#tc_student_uid_no").val(res[13]);  
		  $("#student_cwsn").val(res[14]); 
		  $("#student_cwsn_description").val(res[15]); 
        
      
              }
           });
		   fill_checkup();

    }
</script>
<script type="text/javascript">
   function fill_checkup(){
           var value=document.getElementById('student_select').value;
           var checkup=document.getElementById('checkup_id').value;
           	  $("#student_major_illness").val('Loading....'); 
		  $("#student_height").val('Loading....'); 
		  $("#student_weight").val('Loading....'); 
		  $("#checkup_date").val('Loading....'); 
		  $("#checkup_hospital_name").val('Loading....'); 
          $("#checkup_doctor_name").val('Loading....'); 
          $("#checkup_bp").val('Loading....'); 
          $("#checkup_hb").val('Loading....'); 
          $("#checkup_suger").val('Loading....'); 
          $("#checkup_hiv").val('Loading....'); 
          $("#checkup_tb").val('Loading....'); 
          $("#checkup_eye_problem").val('Loading....'); 
          $("#checkup_specs").val('Loading....'); 
          $("#checkup_left_specs_no").val('Loading....'); 
          $("#checkup_right_specs_no").val('Loading....'); 
          $("#checkup_remark").val('Loading....'); 
          $("#checkup_discription").val('Loading....'); 
          $("#checkup_marks").val('Loading....'); 
		  $("#student_medical_history1").val('Loading....'); 
			$.ajax({
			  address: "POST",
              url: access_link+"student/ajax_checkup_box.php?id="+value+"&&checkup="+checkup+"",
              cache: false,
              success: function(detail){
                 var str =detail;
		  var res = str.split("|?|");
		
		  
		  $("#student_major_illness").val(res[1]);
		  $("#student_height").val(res[2]);
		  $("#student_weight").val(res[3]);
		  $("#checkup_date").val(res[4]); 
		  $("#checkup_hospital_name").val(res[5]); 
          $("#checkup_doctor_name").val(res[6]);  
          $("#checkup_bp").val(res[7]);  
          $("#checkup_hb").val(res[8]);  
          $("#checkup_suger").val(res[9]);  
          $("#checkup_hiv").val(res[10]);  
          $("#checkup_tb").val(res[11]);  
          $("#checkup_eye_problem").val(res[12]);
          $("#checkup_specs").val(res[13]);
          $("#checkup_left_specs_no").val(res[14]);  
          $("#checkup_right_specs_no").val(res[15]);  
          $("#checkup_remark").val(res[16]);  
          $("#checkup_discription").val(res[17]); 
          $("#checkup_marks").val(res[18]); 
		  $("#student_medical_history1").val(res[20]);
		  drop(res[13]);
		   detail1(res[0]);
	

		  	  var path=res[19];
	
		  if(res[19]!=''){

		$("#show_checkup_report1").attr('src', path);
            }else{
                	$("#show_checkup_report1").attr('src', '../school_software/images/hostel_student_list.png');
            }
		
		  
              }
           });

    }
</script>
<script>
function detail1(value1){
if(value1=='Yes'){
$('#for_yes').show();
}else{
$('#for_yes').hide();
}
}
</script>  
<script>
function drop(value){
if(value=='Yes'){
$('#for_eye_left').show();
$('#for_eye_right').show();
}else{
$('#for_eye_left').hide();
$('#for_eye_right').hide();
}
}
      	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
     $("#get_content").html(loader_div);
        $.ajax({
            url: access_link+"student/health_zone_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete',"green");
				   get_content('student/health_zone');
            }
			}
         });
      });
</script>

    <section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-medkit"></i></div>
    <div>
      <h1 class="si-ph-title"><?php echo $language['Health Zone']; ?></h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <?php echo $language['Student']; ?></a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-medkit"></i> <?php echo $language['Medical Fitness']; ?></span>
  </nav>
</section>


	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top" style="border-radius:12px;border-top:3px solid #b92b27;">
            <div class="box-header with-border" style="background:linear-gradient(135deg,#0f3460,#16213e);border-radius:11px 11px 0 0;">
              <h3 class="box-title" style="color:#fff;font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:1px;"><i class="fa fa-medkit" style="margin-right:7px;"></i><?php echo $language['Health Zone']; ?></h3>
            </div>
<!------------------------------------------------Start Registration form--------------------------------------------------->
				<form role="form" method="post" enctype="multipart/form-data" id="my_form">
            <div class="box-body "  >

		
			<div class="col-md-12">
			 <div class="col-md-6 ">				
					<div class="form-group" >
					  <label><?php echo $language['Search Student']; ?></label>
					  <select name="" class="form-control select2" id="student_select" onchange="fill_detail();" required>
					  <option value=""><?php echo $language['Select student']; ?></option>
					        <?php
							
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$school_roll_no=$row22['school_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							$student_mother_name=$row22['student_mother_name'];
							$student_date_of_birth=$row22['student_date_of_birth'];
							$student_admission_number=$row22['student_admission_number'];
							
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_admission_number."]-[".$school_roll_no."]-[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
			</div>
		  </div>
			
			
			         <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="student_name" value="" placeholder="<?php echo $language['Student Name']; ?>"   id="student_name" class="form-control" readonly>
						</div>
					 </div>
					 
				     <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Class']; ?></label>
						   <input type="text"  name="student_class" value="" placeholder="<?php echo $language['Class']; ?>"  id="student_class" class="form-control" readonly>
						</div>
					 </div>
					  
				    <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Section']; ?></label>
						   <input type="text"  name="student_class_section" value="" placeholder="<?php echo $language['Student Section']; ?>"  id="student_section" class="form-control" readonly>
						  </div>
					</div>
					
					<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Roll No']; ?></label>
						   <input type="text"  name="student_roll_no" value="" placeholder="<?php echo $language['Student Roll No']; ?>"  id="student_roll_no" class="form-control" readonly>
						  </div>
					</div>

                  <div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Father Name']; ?></label>
					  <input type="text"  name="student_father_name" id="tc_student_father_name" placeholder="<?php echo $language['Father Name']; ?>"  value="" class="form-control" readonly>
					</div>
				  </div>


				 
				 <div class="col-md-3 ">	
                     <div class="form-group" >
					  <label><?php echo $language['Student CWSN']; ?></label>
					  <input type="text"  name="student_cwsn" value="" placeholder="<?php echo $language['Student CWSN']; ?>"  id="student_cwsn" class="form-control" readonly>
					</div>
				 </div>
				 
				 <div class="col-md-3 ">	
                     <div class="form-group" >
					  <label><?php echo $language['Student CWSN Description']; ?></label>
					  <input type="text"  name="student_cwsn_description" value="" placeholder="<?php echo $language['Student CWSN Description']; ?>"  id="student_cwsn_description" class="form-control" readonly>
					</div>
				 </div>
				 
				  <div class="col-md-3">	
                     <div class="form-group" >
					  <label><?php echo $language['Medical History']; ?></label>
					  <select name="student_medical_history" id="student_medical_history1" class="form-control" onchange="detail1(this.value);" required>
			        <option value="No">No</option>
					  <option value="Yes">Yes</option>
					
					  </select>
					</div>
                   </div>
				 
				 <div class="col-md-3" style="display:none;" id="for_yes">	
                     <div class="form-group" >
					  <label>Major Illness</label>
					  <input type="text"  name="student_major_illness" value="" placeholder="Major Illness"  id="student_major_illness" class="form-control" >
					</div>
                 </div>
				 
				 <div class="col-md-3 ">	
                     <div class="form-group" >
					  <label><?php echo $language['Student Height']; ?></label>
					  <input type="text"  name="student_height" value="" placeholder="<?php echo $language['Student Height']; ?>"  id="student_height" class="form-control" >
					</div>
				 </div>
				 
				 <div class="col-md-3 ">	
                     <div class="form-group" >
					  <label><?php echo $language['Student weight']; ?></label>
					  <input type="text"  name="student_weight" value="" placeholder="<?php echo $language['Student weight']; ?>"  id="student_weight" class="form-control" >
					</div>
				 </div>
				 
				 
				 
		    
			
			<div class="col-md-12">
			   <div class="col-md-4 ">				
					<div class="form-group" >
					  <label><?php echo $language['Health Checkup']; ?></label>
					  <select name="health_checkup" id="checkup_id" class="form-control " onchange="fill_checkup();" required>
					  <option value="checkup1"><?php echo $language['Checkup1']; ?></option>
					  <option value="checkup2"><?php echo $language['Checkup2']; ?></option>
					  </select>
					</div>
				</div>
			</div>
				
				<div class="col-md-4">	
                     <div class="form-group" >
					  <label><?php echo $language['Checkup Date']; ?></label>
					  <input type="date"  name="checkup_date" value="" placeholder=""  id="checkup_date" class="form-control" >
					</div>
				 </div>
				 
				  <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Hospital Name']; ?></label>
						   <input type="text"  name="checkup_hospital_name" value="" placeholder="<?php echo $language['Hospital Name']; ?>"   id="checkup_hospital_name" class="form-control" >
						</div>
			      </div>
				  
				  <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Doctor Name']; ?></label>
						   <input type="text"  name="checkup_doctor_name" value="" placeholder="<?php echo $language['Doctor Name']; ?>"   id="checkup_doctor_name" class="form-control" >
						</div>
			      </div>
				  	<div class="col-md-3">	
					<div class="form-group">
				 <label><?php echo $language['Checkup Report']; ?></label>
					  <input type="file" name="checkup_report1" id="checkup_report1" placeholder="" onchange="check_file_type(this,'checkup_report1','show_checkup_report1','image');"class="form-control" accept=" .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_checkup_report1" src='<?php echo $school_software_path; ?>images/hostel_student_list.png' width='60px' height='60px'>
					</div>
				</div>
		</div>	
		
		           <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo "Blood Group"; ?></label>
						   <input type="text"  name="blood_group" value="" placeholder="<?php echo "blood_group"; ?>"   id="blood_group" class="form-control" >
						</div>
			      </div>
		           
				  <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Blood Pressure Level']; ?></label>
						   <input type="number"  name="checkup_bp" value="" placeholder="<?php echo $language['Blood Pressure Level']; ?>"   id="checkup_bp" class="form-control" >
						</div>
			      </div>
				  
				  <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Hemoglobin Level']; ?></label>
						   <input type="number"  name="checkup_hb" value="" placeholder="<?php echo $language['Hemoglobin Level']; ?>" id="checkup_hb" class="form-control" >
						</div>
			      </div>
				  
				  <div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Diabetes Level']; ?></label>
						   <input type="number"  name="checkup_suger" value="" placeholder="<?php echo $language['Diabetes Level']; ?>" id="checkup_suger" class="form-control" >
						</div>
			      </div>
				  
				  <div class="col-md-4">	
                    <div class="form-group" >
					   <label><?php echo $language['HIV']; ?></label>
					   <select name="checkup_hiv" class="form-control " id="checkup_hiv"  required>
					   <option value="No">No</option>
					   <option value="Yes">Yes</option>
					   </select>
					 </div>
                   </div>
				   
				   <div class="col-md-4">	
                     <div class="form-group" >
					  <label><?php echo $language['TB Infection']; ?></label>
					  <select name="checkup_tb" class="form-control " id="checkup_tb" required>
					  <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
                   </div>
				   
				   <div class="col-md-4">	
                     <div class="form-group" >
					  <label><?php echo $language['Eye Problem']; ?></label>
					  <select name="eye_problem" class="form-control " id="checkup_eye_problem"  required>
					  <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
                   </div>
				   
				   <div class="col-md-4">	
                     <div class="form-group"  >
					  <label><?php echo $language['Specs']; ?></label>
					  <select name="specs" class="form-control " id="checkup_specs" onchange="drop(this.value);"  required>
					  <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
                   </div>
				   
				   <div class="col-md-2 " style="display:none;" id="for_eye_left">	
                     <div class="form-group" >
					  <label>Left Side No.</label>
					  <input type="number"  name="left_specs_no" value="" placeholder="Left Side No."  id="checkup_left_specs_no" class="form-control" >
					</div>
				  </div>
				  
				  <div class="col-md-2 " style="display:none;" id="for_eye_right">	
                     <div class="form-group" >
					  <label>Right Side No.</label>
					  <input type="number"  name="right_specs_no" value="" placeholder="Right Side No."  id="checkup_right_specs_no" class="form-control" >
					</div>
				  </div>
				  
				  <div class="col-md-4 ">	
                     <div class="form-group" >
					  <label><?php echo $language['Remark']; ?></label>
					  <input type="text"  name="checkup_remark" value="" placeholder="<?php echo $language['Remark']; ?>"  id="checkup_remark" class="form-control" >
					</div>
				  </div>
				  
				  <div class="col-md-4 ">	
                     <div class="form-group" >
					  <label><?php echo $language['Description']; ?></label>
					  <input type="text"  name="checkup_discription" value="" placeholder="<?php echo $language['Description']; ?>"  id="checkup_discription" class="form-control" >
					</div>
				  </div>
				  
				  <div class="col-md-4 ">	
                     <div class="form-group" >
					  <label><?php echo $language['Health Marks']; ?></label>
					  <input type="text"  name="checkup_marks" value="" placeholder="<?php echo $language['Health Marks']; ?>"  id="checkup_marks" class="form-control" >
					</div>
				  </div>
				 
				   
				  
				  <div class="col-md-12">
				<center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn my_background_color" style="min-width:160px;font-weight:700;" /></center>
				
				</div>
				
				
				
		</form>	
		<div class="col-md-12">
		        
		  </div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

 <script>
    $('.select2').select2();

</script>