<?php include("../attachment/session.php")?>
<script type="text/javascript">
   function sibling_1_detail(value){
           
			$.ajax({
			  address: "POST",
              url: access_link+"student/ajax_sibling_1_detail_box.php?id="+value+"",
              cache: false,
              success: function(detail){
			  //alert_new(detail);
                var str =detail;
				var res = str.split("|?|");
				$("#sibling_1_student_roll_no").val(value); 
				$("#sibling_1_student_name").val(res[0]); 
              }
           });
    }
</script> 
<script type="text/javascript">
   function sibling_2_detail(value){
           
			$.ajax({
			  address: "POST",
              url: access_link+"student/ajax_sibling_2_detail_box.php?id="+value+"",
              cache: false,
              success: function(detail){
			  //alert_new(detail);
                var str =detail;
				var res = str.split("|?|");
				$("#sibling_2_student_roll_no").val(value); 
				$("#sibling_2_student_name").val(res[0]); 
              }
           });
    }
</script> 

<script type="text/javascript">
   function for_section(value2){
          
       $.ajax({
			  type: "POST",
              url: "ajax_class_section.php?class_name="+value2+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                  $("#student_class_section").html(str);
              }
           });
		   if(value2=="11TH" || value2=="12TH"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
$("#student_class_stream").attr('required',true);
$("#student_class_group").attr('required',true);
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
$("#student_class_stream").attr('required',false);
$("#student_class_group").attr('required',false);
}

    }
	function get_dob_in_words(dob1){
       $.ajax({
			  type: "POST",
              url: access_link+"student/ajax_datetoword.php?dob="+dob1+"",
              cache: false,
              success: function(detail){
                  
				  document.getElementById('student_date_of_birth_in_word1').value=detail;
              }
           });

    }
		  function get_group_subject(){
     var  group_name=document.getElementById('student_class_group').value;
     var  stream_name=document.getElementById('student_class_stream').value;
       $.ajax({
			  type: "POST",
              url: access_link+"student/ajax_stream_group_subject.php?stream_name="+stream_name+"&group_name="+group_name+"",
              cache: false,
              success: function($detail1){
                   var str1 =$detail1;                
                  $("#student_class_group_subject").val(str1);
				    
              }
           });

    }
</script>

<script>


function for_cwsn(value){
if(value=="Yes"){
$('#student_cwsn_div').show();
}else{
$('#student_cwsn_div').hide();
}
}
</script>

<script type="text/javascript">
  
	function change_class(){
	
	 var class_change_confirmation=confirm("Do You Really Want To Change The Class !!! This Action Will Reset Fee Details. Your Previous Fee Details Of This Student Will Destroy. ");
	 if(class_change_confirmation==true){
	 document.getElementById('class_change_hidden').value = "Active";
	 document.getElementById('student_class_section').value = "A";
	 $("#save").click();
	 }
	 else{
	 var pre_selected_class=document.getElementById('class_hidden').value;
	 document.getElementById('student_class').value = pre_selected_class;
	 }
}


</script>
<script>	
function get_group(value1){
       $.ajax({
			  type: "POST",
              url: access_link+"student/ajax_stream_group.php?stream_name="+value1+"",
              cache: false,
              success: function($detail1){
                  var str1 =$detail1;
                  $("#student_class_group").html(str1);
              }
           });
		   $("#student_class_group_subject_div").show();

    }
</script>	
<script type="text/javascript">
function walk_through(value){
if(value=="By Bus" || value=="With Guardian"){
$('#student_walk_with').show();
}else{
$('#student_walk_with').hide();
}
}
</script>
<script type="text/javascript">
  $(function(){
            var id=document.getElementById('student_class').value;			
            var section_hidden=document.getElementById('student_class_section_hidden').value;			
       $.ajax({
			  type: "POST",
              url: access_link+"student/ajax_class_section_hidden.php?class_name="+id+"&section_hidden="+section_hidden+"",
              cache: false,
              success: function($detail){
                   var str =$detail;                
                   // alert_new(str);
                  $("#student_class_section").html(str);
              }
           });
		    var walk_through=document.getElementById('student_walk_through').value;	
			if(walk_through=="By Bus" || walk_through=="With Guardian"){
			$('#student_walk_with').show();
			}else{
			$('#student_walk_with').hide();
            }
    });
	
	function open_file1(image_type,student_roll_no){

	$.ajax({
	address: "POST",
	url: access_link+"student/ajax_open_image.php?image_type="+image_type+"&student_roll_no="+student_roll_no+"",
	cache: false,
	success: function(detail){
	 $("#mypdf_view").html('');
	 $("#mypdf_view").html(detail);
	}
	});
	}
	
function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
		$('#'+id).attr('src', e.target.result);
            };
			
            reader.readAsDataURL(input.files[0]);
			
        }
    }
function check_file_type(input,id,id_show,type1){
if(type1=="image"){
	   var file = input.files[0];
	   if (file.size >= 1024 * 1024 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 2MB","red");
      return;
    }  
if(!file.type.match("image/*"))
{
 $('#'+id).val('');
alert_new("Please Upload JPG/JPEG/PNG/GIF File","red");

 return;
}  
	var fileReader = new FileReader();
  fileReader.onloadend = function(e) {
    var arr = (new Uint8Array(e.target.result)).subarray(0, 4);
    var header = "";
    for (var i = 0; i < arr.length; i++) {
      header += arr[i].toString(16);
    }
	if(mimeType(header)==1){
	  $('#'+id).val('');
	alert_new("Please Upload JPG/JPEG/PNG/GIF File","red");
	
	}
  };
  fileReader.readAsArrayBuffer(file);
  readURL(input,id_show);
}else{

	   var file = input.files[0];
	   if (file.size >= 1024 * 1024 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 2MB","red");
	  
      return;
    }  
 
	var fileReader = new FileReader();
  fileReader.onloadend = function(e) {
    var arr = (new Uint8Array(e.target.result)).subarray(0, 4);
    var header = "";
    for (var i = 0; i < arr.length; i++) {
      header += arr[i].toString(16);
    }
	if(mimeType(header)==1){
	 $('#'+id).val('');
	alert_new("Please Upload JPG/JPEG/PNG/GIF/PDF/DOC File","red");
	 
	}
  };
  fileReader.readAsArrayBuffer(file);
  readURL(input,id_show);
}

}
function mimeType(headerString) {
  switch (headerString) {
    case "89504e47":
      type = "image/png";
      break;
    case "47494638":
      type = "image/gif";
      break;
    case "ffd8ffe0":
    case "ffd8ffe1":
    case "ffd8ffe2":
      type = "image/jpeg";
      break;
	 case "25504446":
      type = "application/pdf";
      break;
	  case "d0cf11e0":
      type = "application/doc";
      break;
    default:
      type = "1";
      break;
  }
  return type;
}
    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: access_link+"student/student_admission_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			//alert_new(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				  alert_new('Successfully Complete',"green");
				  post_content('student/student_admission_list',res[1]);
            }
			}
         });
      });
	  function same_address_function(){
	   if ($("#same_address_checkbox").is(":checked")) {
$("#student_city_permanent").val($("#student_city").val());
$("#student_address_permanent").val($("#student_adress").val());
$("#student_block_permanent").val($("#student_block").val());
$("#student_state_permanent").val($("#student_state").val());
$("#student_pincode_permanent").val($("#student_pincode").val());
$("#student_district_permanent").val($("#student_district").val());
  } else {
$("#student_city_permanent").val('');
$("#student_address_permanent").val('');
$("#student_block_permanent").val('');
$("#student_state_permanent").val('');
$("#student_pincode_permanent").val('');
$("#student_district_permanent").val('');
  }
}

function for_bus_category(){
	var bus=document.getElementById('student_bus').value;
	if(bus=='No'){
		$('#bus_fee_category_name').val('').change();
		$('#div_bus_fee_ctgry_name').hide();
	}else{
		$('#div_bus_fee_ctgry_name').show();
	}
} 
	  
</script>

  
  
 <section class="content-header">
      <h1>
         <?php echo $language['Student Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('student/students')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Student']; ?></a></li>
	  <li><a href="javascript:get_content('student/student_admission_list')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Student Admission List']; ?></a></li>
	  <li class="active"><?php echo $language['Student Admission']; ?></li>
      </ol>
    </section>

	
	<?php
	$student_roll_no=$_GET['student_roll_no'];
	$que="select * from student_admission_info where student_roll_no='$student_roll_no' and student_status='Active' and session_value='$session1'";
    $run=mysqli_query($conn73,$que);
    while($row=mysqli_fetch_assoc($run)){print_r($row);
    $student_name=$row['student_name'];
	$student_father_name=$row['student_father_name'];
	$student_mother_name=$row['student_mother_name'];
	$student_class=$row['student_class'];
	$student_class_stream=$row['student_class_stream'];
	$student_class_group=$row['student_class_group'];
	$student_date_of_birth=$row['student_date_of_birth'];
	$student_gender=$row['student_gender'];
	$student_handicapped=$row['student_handicapped'];
	$student_religion=$row['student_religion'];
	$student_category=$row['student_category'];
	$student_rf_id_number=$row['student_rf_id_number'];
	$student_adhar_number=$row['student_adhar_number'];
	$student_father_adhar_card_number=$row['student_father_adhar_card_number'];
	$student_sssmid_number=$row['student_sssmid_number'];
	$student_family_id=$row['student_family_id'];
	$student_child_id=$row['student_child_id'];
	$student_registration_number=$row['student_registration_number'];
	$student_enrollment_number=$row['student_enrollment_number'];
	$student_father_bank_name=$row['student_father_bank_name'];
	$student_father_bank_account_number=$row['student_father_bank_account_number'];
	$student_father_bank_ifsc_code=$row['student_father_bank_ifsc_code'];
	$student_bank_name=$row['student_bank_name'];
	$student_account_number=$row['student_account_number'];
	$student_bank_ifsc_code=$row['student_bank_ifsc_code'];
	$student_admission_type=$row['student_admission_type'];
	$student_admission_scheme=$row['student_admission_scheme'];
	$stuent_old_or_new=$row['stuent_old_or_new'];
	$student_medium=$row['student_medium'];
	$student_date_of_admission=$row['student_date_of_admission'];
	$student_date_of_birth_in_word=$row['student_date_of_birth_in_word'];
	$student_previous_class=$row['student_previous_class'];
	$student_previous_school_name=$row['student_previous_school_name'];
	$student_admission_scheme=$row['student_admission_scheme'];
	$student_sibling_name_1=$row['student_sibling_name_1'];
	$student_sibling_unique_id_1=$row['student_sibling_unique_id_1'];
	$student_sibling_name_2=$row['student_sibling_name_2'];
	$student_sibling_unique_id_2=$row['student_sibling_unique_id_2'];
	$student_admission_number=$row['student_admission_number'];
	$student_scholar_number=$row['student_scholar_number'];
	$student_father_contact_number=$row['student_father_contact_number'];
	$student_father_contact_number2=$row['student_father_contact_number2'];
	$student_father_email_id=$row['student_father_email_id'];
	$student_mother_contact_number=$row['student_mother_contact_number'];
	$student_mother_email_id=$row['student_mother_email_id'];
	$student_father_occupation=$row['student_father_occupation'];
	$student_mother_occupation=$row['student_mother_occupation'];
	$student_contact_number=$row['student_contact_number'];
	$student_email_id=$row['student_email_id'];

	
	$student_roll_no=$row['student_roll_no'];
	$student_adress=$row['student_adress'];
	$student_city=$row['student_city'];
	$student_block=$row['student_block'];
	$student_district=$row['student_district'];
	$student_pincode=$row['student_pincode'];
	$student_landmark=$row['student_landmark'];
	$student_state=$row['student_state'];
	$student_id_generate=$row['student_id_generate'];
	$student_class_section=$row['student_class_section'];
	$student_facility=$row['student_facility'];	
	$student_bus=$row['student_bus'];	
	$student_hostel=$row['student_hostel'];	
	$student_library=$row['student_library'];	
	$student_admission_remark=$row['student_admission_remark'];	
	$student_cwsn=$row['student_cwsn'];	
	$student_cwsn_description=$row['student_cwsn_description'];	
	$student_guardian_name=$row['student_guardian_name'];	
	$student_guardian_contact_number=$row['student_guardian_contact_number'];	
	$student_guardian_relation=$row['student_guardian_relation'];	
	$student_guardian_email_id=$row['student_guardian_email_id'];	
	$student_guardian_occupation=$row['student_guardian_occupation'];	
	$student_sms_contact_number=$row['student_sms_contact_number'];	
	$student_web_sms=$row['student_web_sms'];	
	$student_walk_through=$row['student_walk_through'];	
	$student_walk_with=$row['student_walk_with'];	
	$student_bus=$row['student_bus'];	
	$student_hostel=$row['student_hostel'];	
	$student_library=$row['student_library'];

    $student_fee_category=$row['student_fee_category'];	
	$student_fee_category_code=$row['student_fee_category_code'];
	$student_bus_fee_category_code = $row['student_bus_fee_category_code'];
	$student_bus_fee_category = $row['student_bus_fee_category'];

	
		$student_address_permanent=$row['student_address_permanent'];
	$student_city_permanent=$row['student_city_permanent'];
	$student_block_permanent=$row['student_block_permanent'];
	$student_district_permanent=$row['student_district_permanent'];
	$student_pincode_permanent=$row['student_pincode_permanent'];
	$student_state_permanent=$row['student_state_permanent'];
	
	$student_board=$row['board'];	
	if($student_medium==''){	
	$student_medium=$row['medium'];
    }	
	$student_shift=$row['shift'];	

	$student_remark_1=$row['student_remark_1'];
	$student_remark_2=$row['student_remark_2'];
	$student_remark_3=$row['student_remark_3'];
	$student_remark_4=$row['student_remark_4'];
	
	}

    while($row1=mysqli_fetch_assoc($run1)){
	$student_image=$row1['student_image'];
	 $student_father_image=$row1['student_father_image'];
	$student_mother_image=$row1['student_mother_image'];
	$student_guardian_image=$row1['student_guardian_image'];
	$student_tc_image=$row1['student_tc_image'];
	$student_last_marksheet_image=$row1['student_last_marksheet_image'];
	$student_income_certificate_image=$row1['student_income_certificate_image'];
	$student_cast_certificate_image=$row1['student_cast_certificate_image'];
	$student_dob_image=$row1['student_dob_image'];
	$student_adhar_card_image=$row1['student_adhar_card_image'];

	}
	?>
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body">
			  <!---------------------------Start Admission form--------------------------------------->
        <!---------------------------Start Personal Details ------------------------------------->
			
		<form name="myForm" method="post" enctype="multipart/form-data" action="" onsubmit="return validate();" id="my_form">
		
				
            <div class="box-body ">
			<h3 style="color:#d9534f;"><b><?php echo $language['Personal Detail']; ?>:</b></h3>
			    <div class="col-md-3 ">
						<div class="form-group">
						  <label>Software Id</label>
						   <input type="text"  name="student_roll_no" value="<?php echo $student_roll_no; ?>" class="form-control" readonly>
						   <input type="hidden"  name="s_no" value="<?php echo $s_no; ?>" class="form-control" readonly>
						 </div>
				</div>   <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Name']; ?></label>
						   <input type="text"  name="student_name"    value="<?php echo $student_name; ?>" class="form-control">
					
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Father Name']; ?></label>
						   <input type="text"  name="student_father_name"   value="<?php echo $student_father_name; ?>" class="form-control">
						</div>
				</div>

					<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Mother Name']; ?></label>
						   <input type="text"  name="student_mother_name"   value="<?php echo $student_mother_name; ?>" class="form-control">
						</div>
				</div>	
				<div class="col-md-3 ">				
					 <div class="form-group" >
					  <label ><?php echo $language['Gender']; ?></label><br>
						<div class="form-control">
							<input type="radio" name="student_gender" id="optionsRadios2" value="Male" <?php if($student_gender=='Male'){ echo 'checked'; } ?> >&nbsp;&nbsp;<b>Male</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="student_gender" id="optionsRadios2" value="Female" <?php if($student_gender=='Female'){ echo 'checked'; } ?> >&nbsp;&nbsp;<b>Female</b>
						</div>
				     </div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Handicapped']; ?></label>
						    <select class="form-control" name="student_handicapped">
							<?php if($student_handicapped==null) { ?>
					        <option value="No">No</option>
					        <?php } else { ?>
					        <option value="<?php echo $student_handicapped; ?>"><?php echo $student_handicapped; ?></option>
					        <?php } ?>
					        <option value="No">No</option>
					        <option value="Yes">Yes</option>
					        </select>
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Child With Special Need']; ?></label>
						    <select class="form-control" name="student_cwsn" onchange="for_cwsn(this.value);">
					        <option value="<?php echo $student_cwsn; ?>"><?php echo $student_cwsn; ?></option>
					        <option value="No">No</option>
					        <option value="Yes">Yes</option>
					        </select>
						</div>
				</div>
				<div class="col-md-3 " style="display:none" id="student_cwsn_div">	
					<div class="form-group" >
					  <label>CWSN Description</label>
					  <input type="text"  name="student_cwsn_description"   value="<?php echo $student_cwsn_description; ?>" class="form-control">
					</div>
				</div>				
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Religion']; ?></label>
					  <select class="form-control" name="student_religion">
					  <?php if($student_religion==null) { ?>
					  <option value="Hindu">Hindu</option>
					  <?php } else { ?>
					  <option value="<?php echo $student_religion; ?>"><?php echo $student_religion; ?></option>
					  <?php } ?>
					  <option value="Hindu">Hindu</option>
					  <option value="Muslim">Muslim</option>
					  <option value="Sikh">Sikh</option>
					  <option value="Christian">Christian</option>
					  <option value="Jain">Jain</option>
					  <option value="Buddh">Buddh</option>
					  <option value="Other">Other</option>
					  </select>
					</div>
				  </div>
				<div class="col-md-3 ">	
					<div class="form-group">
					  <label><?php echo $language['Category']; ?></label>
					  <select class="form-control" name="student_category" >
					  <?php if($student_category==null) { ?>
					  <option value="">Select Category</option>
					  <?php } else { ?>
					  <option value="<?php echo $student_category; ?>"><?php echo $student_category; ?></option>
					  <?php } ?>
					  <option value="General">General</option>
					  <option value="OBC">OBC</option>
					  <option value="SC">SC</option>
					  <option value="ST">ST</option>
					  <option value="Other">Other</option>
					  </select>
					</div>
				</div>	
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Add RF Id Number']; ?></label>
					  <input type="text"  name="student_rf_id_number"   value="<?php echo $student_rf_id_number; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Date Of Birth']; ?></label>
					  <input type="date"  name="student_date_of_birth" id="student_date_of_birth"   value="<?php echo $student_date_of_birth; ?>" oninput="get_dob_in_words(this.value);" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Date Of Birth(word)']; ?></label>
						   <input type="text"  id="student_date_of_birth_in_word1" name="student_date_of_birth_in_word"  value="<?php echo $student_date_of_birth_in_word; ?>" class="form-control" readonly>
				        </div>
				</div>
				<div class="box-body ">
			       <div class="col-md-12">
		            <center><input type="submit" name="finish" value="<?php echo $language['Save & Change']; ?>" class="btn btn-success" /></center>
		          </div>
			    </div>
				
			</div>
		
				
		
				 <!---------------------------End Personal Details ----------------------------------------->
				 <!---------------------------Start Document Details ----------------------------------------->
			<div class="box-body">
					<h3 style="color:#d9534f;"><b><?php echo $language['Document Details']; ?>:</b></h3>
			    <div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Aadhar Card (Student)']; ?></label>
						  <input type="text" minlength="12" maxlength="12" name="student_adhar_number" value="<?php echo $student_adhar_number; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Aadhar Card (Father)']; ?></label>
						   <input type="text" minlength="12" maxlength="12" name="student_father_adhar_card_number"    value="<?php echo $student_father_adhar_card_number; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3">		
						<div class="form-group">
						  <label><?php echo $language['Sssm Id No']; ?></label>
						   <input type="text" minlength="7" maxlength="12" name="student_sssmid_number"  value="<?php echo $student_sssmid_number; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group" >
					  <label><?php echo $language['Family Id']; ?></label>
					  <input type="text" name="student_family_id"  value="<?php echo $student_family_id; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group">
					  <label ><?php echo $language['Child Id']; ?></label><br>
						<input type="text"  name="student_child_id"   value="<?php echo $student_child_id; ?>" class="form-control">
					</div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group">
					  <label ><?php echo "Registration No";//$language['Child Id']; ?></label><br>
						<input type="text"  name="student_registration_number"   value="<?php echo $student_registration_number; ?>" class="form-control">
					</div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group">
					  <label ><?php echo "Enrollment No";//$language['Child Id']; ?></label><br>
						<input type="text"  name="student_enrollment_number"   value="<?php echo $student_enrollment_number; ?>" class="form-control">
					</div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Bank Name (Father)']; ?></label>
					  <input type="text"  name="student_father_bank_name"    value="<?php echo $student_father_bank_name; ?>" class="form-control">
					</div>
				</div>	
				<div class="col-md-3">				
					 <div class="form-group" >
					  <label ><?php echo $language['Account Number (Father)']; ?></label>
					  <input type="number"  name="student_father_bank_account_number"   value="<?php echo $student_father_bank_account_number; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group">
					  <label ><?php echo $language['Bank IFSC Code (Father)']; ?></label>
					  <input type="text"  name="student_father_bank_ifsc_code"    value="<?php echo $student_father_bank_ifsc_code; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group">
					  <label ><?php echo $language['Bank Name (Student)']; ?></label>
					  <input type="text"  name="student_bank_name"  value="<?php echo $student_bank_name; ?>" class="form-control">
					</div>
				</div>	
				<div class="col-md-3">				
					 <div class="form-group" >
					  <label ><?php echo $language['Account Number (Student)']; ?></label>
					  <input type="number"  name="student_account_number"   value="<?php echo $student_account_number; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Bank IFSC Code (Student)']; ?></label>
					  <input type="text"  name="student_bank_ifsc_code"   value="<?php echo $student_bank_ifsc_code; ?>" class="form-control">
					</div>
				</div>
				
				<div class="box-body">
			       <div class="col-md-12">
		            <center><input type="submit" name="finish" value="<?php echo $language['Save & Change']; ?>" class="btn btn-success" /></center>
		          </div>
			    </div>
				
			</div>
				
		
		
				<!---------------------------End Document Details ----------------------------------------->
				<!---------------------------Start Admission Details -------------------------------------->
				
		 <div class="box-body">
			<h3 style="color:#d9534f;"><b><?php echo $language['Admission Details']; ?>:</b></h3>
			    <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Admission Type']; ?></label>
						    <select class="form-control" name="student_admission_type">
							<option value="<?php echo $student_admission_type; ?>"><?php echo $student_admission_type; ?></option>
							<option value="Regular">Regular</option>
							<option value="Private">Private</option>
							</select>
						</div>
				</div>
				<div class="col-md-3 ">				
					<div class="form-group">
					  <label ><?php echo $language['Admission Scheme']; ?></label>
					  <select class="form-control"  name="student_admission_scheme">
					  <option value="<?php echo $student_admission_scheme; ?>"><?php echo $student_admission_scheme; ?></option>
					 <option value="NON-RTE">NON-RTE</option>
					  <option value="RTE">RTE</option>
					  </select>
					</div>
				</div>
				<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Student Old Or New']; ?></label>
						    <select class="form-control" name="stuent_old_or_new">
							<option value="<?php echo $stuent_old_or_new; ?>"><?php echo $stuent_old_or_new; ?></option>
							<option value="New">New</option>
							<option value="Old">Old</option>
							</select>
						</div>
				</div>
				
				<div class="col-md-3" <?php if($_SESSION['school_info_medium']!='Both'){ ?> style="display:none" <?php } ?> >				
					<div class="form-group">
					  <label ><?php echo $language['Medium']; ?></label>
					  <select class="form-control" name="student_medium" <?php if($_SESSION['school_info_medium']=='Both'){ echo "required"; } ?> >
					  <?php if($student_medium!=''){ ?>
					   <option value="<?php echo $student_medium; ?>"><?php echo $student_medium; ?></option>
					   <option value="English">English</option>
					   <option value="Hindi">Hindi</option>
					   <?php }else{ ?>
					   <option value="">Select</option>
					   <option value="English">English</option>
					   <option value="Hindi">Hindi</option>
					   <?php } ?>
					  </select>
					</div>
				</div>	
						<div class="col-md-3" <?php if($_SESSION['school_info_school_board']!='Both'){ ?> style="display:none" <?php } ?> >	
						
					<div class="form-group">
					  <label >BOARD</label>
					 	    <select class="form-control" name="student_board" <?php if($_SESSION['school_info_school_board']=='Both'){ echo "required"; } ?> >
					   <?php if($student_board!=''){ ?>
					   <option value="<?php echo $student_board; ?>"><?php echo $student_board; ?></option>
					   <option value="CBSE">CBSE</option>
					   <option value="MP Board">MP Board</option>
					   <?php }else{ ?>
					   <option value="">Select</option>
					   <option value="CBSE">CBSE</option>
					   <option value="MP Board">MP Board</option>
					   <?php } ?>
					   </select>
					</div>
				</div>
				<div class="col-md-3" <?php if($_SESSION['shift']!='yes'){ ?> style="display:none" <?php } ?> >	
							
					<div class="form-group">
					  <label>SHIFT</label>
					  <select class="form-control" name="student_shift" <?php if($_SESSION['shift']=='yes'){ echo "required"; } ?> >	 
					   <?php if($student_shift!=''){ ?>
					   <option value="<?php echo $student_shift; ?>"><?php echo $student_shift; ?></option>
					   <option  value="Shift1">Shift1</option>
					   <option  value="Shift2">Shift2</option>
					   <?php }else{ ?>
					   <option value="">Select</option>
					   <option  value="Shift1">Shift1</option>
					   <option  value="Shift2">Shift2</option>
					   <?php } ?>
					  </select>
					</div>
				</div>
				

				<div class="col-md-3 ">
						<div class="form-group">
						   <label><?php echo $language['Date Of Admission']; ?></label>
						   <input type="date" name="student_date_of_admission"   value="<?php echo $student_date_of_admission; ?>" class="form-control">
						</div>
				</div>
				
	
				<div class="col-md-3 ">
						<div class="form-group">
						<label><?php echo $language['Admission No']; ?></label>
						<!--<input type="text"  name="student_admission_number"    value="<?php echo $student_admission_number; ?>" class="form-control">-->
							<input type="text"  name="student_admission_number" value="<?php echo $student_admission_number; ?>" class="form-control" >
						   <!--<input type="hidden"  name="s_no" value="<?php echo $s_no; ?>" class="form-control" readonly>-->
				        </div>
			    </div>			
			    <div class="col-md-3">	
					<div class="form-group" >
					<label><?php echo $language['Scholar No']; ?></label>
					 <input type="text"  name="student_scholar_number"   value="<?php echo $student_scholar_number; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Previous Class']; ?></label>
						  <select class="form-control" name="student_previous_class" >
						  <?php if($student_previous_class==null) { ?>
						  <option value="">Select Previous Class</option>
						  <option value="NONE">NONE</option>
						  
						  <?php } else { ?>
						  <option value="<?php echo $student_previous_class; ?>"><?php echo $student_previous_class; ?></option></option>
						  <?php } ?>
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
				
				<div class="col-md-3 ">
					<div class="form-group">
					  <label><?php echo $language['Previous School Name']; ?></label>
					   <input type="text"  name="student_previous_school_name"    value="<?php echo $student_previous_school_name; ?>" class="form-control">
					</div>
			    </div>
				
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Class']; ?></label>
						<input type="hidden" name="class_change_hidden" id="class_change_hidden" value="Deactive" class="form-control">
						<input type="hidden" name="class_hidden" id="class_hidden" value="<?php echo $student_class; ?>" class="form-control">
					    <select name="student_class" onchange="for_section(this.value);change_class();for_fee();" id="student_class" class="form-control" required>
						       <option value="<?php echo $student_class; ?>"><?php echo $student_class; ?></option>
						       <?php 	   $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					     <?php } ?>
					    </select>
					</div>
				</div>
				<?php 
				if($student_class=="11TH" || $student_class=="12TH"){ ?>
				<div class="col-md-3 " id="student_class_stream_div">				
					<div class="form-group">
					  <label >Stream<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);change_stream();" >
						<?php if($student_class_stream==''){ ?>
						 <option value="">Select Stream</option> <?php } else { ?>
					           <option value="<?php echo $student_class_stream; ?>"><?php echo $student_class_stream; ?></option>
							   
						       <?php } $que="select * from school_info_stream_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name'];
							   if($stream_name!=''){?>
						       <option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
					           <?php } } ?>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-3" id="student_class_group_div">				
					<div class="form-group">
					  <label >Group<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_group" id="student_class_group" onchange="get_group_subject();">
					          <option value="<?php echo $student_class_group; ?>"><?php echo $student_class_group; ?></option>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-8" id="student_class_group_subject_div" style="display:none;">				
					<div class="form-group">
					  <label>Group Subject</label>
					 <input type="text" id="student_class_group_subject"   value="" class="form-control new_student" readonly>
					</div>
				</div>
				<?php } ?>
				<div class="col-md-3 ">	
					<div class="form-group" >
					    <label><?php echo $language['Section']; ?></label>
						<input type="hidden"  name="student_class_section_hidden" id="student_class_section_hidden"  value="<?php echo $student_class_section; ?>" class="form-control">
					    <select class="form-control" name="student_class_section" id="student_class_section">
						<?php if($student_class_section=='') { ?>
						<option value="">Select Section</option>
						<?php } else { ?>
						<option value="<?php echo $student_class_section; ?>"><?php echo $student_class_section; ?></option>
						<?php } ?>
					    </select>
					</div>
				</div>
				<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Admission Remark']; ?></label>
					  <input type="text"  name="student_admission_remark"    value="<?php echo $student_admission_remark; ?>" class="form-control">
					</div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group" >
					  <label>Fee Category</label>
					  <select class="form-control" name="student_fee_category">
                    <?php
                    $que01="select * from school_info_fee_category where category_name!=''";
                    $run01=mysqli_query($conn73,$que01) or die(mysqli_error($conn73));
                    while($row01=mysqli_fetch_assoc($run01)){
                    $category_name = $row01['category_name'];
	                $category_name_hindi = $row01['category_name_hindi'];
	                $category_code = $row01['category_code'];
                    ?>
					  <option <?php if($student_fee_category_code==$category_code){ echo 'selected'; } ?> value="<?php echo $category_name.'|?|'.$category_code; ?>"><?php echo $category_name; ?></option>
					<?php } ?>
					  </select>
					  </div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Bus']; ?></label>
					  <select class="form-control"  name="student_bus" id="student_bus" onchange="for_bus_category();">
					   <option value="<?php echo $student_bus; ?>"><?php echo $student_bus; ?></option>
					    <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
				</div>
				
				<div class="col-md-3" id="div_bus_fee_ctgry_name" style="<?php if($student_bus=='No'){ echo 'display:none'; } ?>">				
					<div class="form-group">
					  <label>Bus Fee Category</label>
					    <select class="form-control select2" name="bus_fee_category_name" id="bus_fee_category_name" style="width:100%;">
					           <option  value="">Select</option>
						       <?php
								$query18="select * from bus_fee_category where bus_fee_category_name!=''";
								$run18=mysqli_query($conn73,$query18) or die(mysqli_error($conn73));
								while($row=mysqli_fetch_assoc($run18)){
								$bus_fee_category_name=$row['bus_fee_category_name'];
								$bus_fee_category_code=$row['bus_fee_category_code'];
								?>
								<option <?php if($student_bus_fee_category_code==$bus_fee_category_code){ echo "selected"; } ?> value="<?php echo $bus_fee_category_name.'|?|'.$bus_fee_category_code; ?>"><?php echo $bus_fee_category_name; ?></option>
								<?php } ?>
					    </select>
					</div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Hostel']; ?></label>
					 <select class="form-control"  name="student_hostel">
					  <option value="<?php echo $student_hostel; ?>"><?php echo $student_hostel; ?></option>
					    <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Library']; ?></label>
					  <select class="form-control"  name="student_library">
					   <option value="<?php echo $student_library; ?>"><?php echo $student_library; ?></option>
					    <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
				</div>
					<div class="col-md-12 ">	

				<div class="col-md-3 ">				
					<div class="form-group" >
					  <label><?php echo $language['Sibling(1) Details']; ?></label>
					  <select name="" class="form-control select2" onchange="sibling_1_detail(this.value);" style="width:100%;">
					  <?php if($student_sibling_name_1!='') { ?>
					  <option value="<?php echo $student_sibling_name_1; ?>"><?php echo $student_sibling_name_1; ?></option>
					  <?php }else{ ?>
					  <option value="">Select student</option>
					  <?php } ?>
					        <?php
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1' ";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$sibling_1_student_roll_no=$row22['student_roll_no'];
							$sibling_1_student_name=$row22['student_name'];
							$sibling_1_student_class=$row22['student_class'];
							$sibling_1_student_section=$row22['student_class_section'];
							$sibling_1_student_father_name=$row22['student_father_name'];
							$sibling_1_student_father_contact_number=$row22['student_father_contact_number'];
							?>
							<option value="<?php echo $sibling_1_student_roll_no; ?>"><?php echo $sibling_1_student_name."[".$sibling_1_student_roll_no."]-"."[".$sibling_1_student_class."-".$sibling_1_student_section."]-[".$sibling_1_student_father_name."-".$sibling_1_student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
			    </div>

				<div class="col-md-3 ">				
					<div class="form-group" >
					  <label><?php echo $language['Sibling(1) Name']; ?></label>
					  <input type="text"  name="student_sibling_name_1" id="sibling_1_student_name"   value="<?php echo $student_sibling_name_1; ?>" class="form-control" readonly>
					</div>
				</div>
				<div class="col-md-3 ">				
					<div class="form-group" >
					  <label>Sibling(2) Details</label>
					  <select name="" class="form-control select2" onchange="sibling_2_detail(this.value);" style="width:100%;">
					  <?php if($student_sibling_name_2!='') { ?>
					  <option value="<?php echo $student_sibling_name_2; ?>"><?php echo $student_sibling_name_2; ?></option>
					  <?php }else{ ?>
					  <option value="">Select student</option>
					  <?php } ?>
					        <?php
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1' ";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$sibling_2_student_roll_no=$row22['student_roll_no'];
							$sibling_2_student_name=$row22['student_name'];
							$sibling_2_student_class=$row22['student_class'];
							$sibling_2_student_section=$row22['student_class_section'];
							$sibling_2_student_father_name=$row22['student_father_name'];
							$sibling_2_student_father_contact_number=$row22['student_father_contact_number'];
							?>
							<option value="<?php echo $sibling_2_student_roll_no; ?>"><?php echo $sibling_2_student_name."[".$sibling_2_student_roll_no."]-"."[".$sibling_2_student_class."-".$sibling_2_student_section."]-[".$sibling_2_student_father_name."-".$sibling_2_student_father_contact_number."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
			    </div>
				<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Sibling(2) Name']; ?></label>
					  <input type="text"  name="student_sibling_name_2" id="sibling_2_student_name"    value="<?php echo $student_sibling_name_2; ?>" class="form-control" readonly>
					</div>
				</div>
				
					<div class="col-md-3">				
					<div class="form-group" style="display:none;">
					  <label><?php echo $language['Sibling Unique ID (1)']; ?></label>
					  <input type="text"  name="student_sibling_unique_id_1" id="sibling_1_student_roll_no"   value="<?php echo $student_sibling_unique_id_1; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3 " style="display:none;">				
					<div class="form-group" >
					  <label><?php echo $language['Sibling Unique ID (2)']; ?></label>
					  <input type="text"  name="student_sibling_unique_id_2" id="sibling_2_student_roll_no"   value="<?php echo $student_sibling_unique_id_2; ?>" class="form-control">
					</div>
				</div>
				</div>
				<div class="box-body ">
			       <div class="col-md-12">
		            <center><input type="submit" name="finish" id="save" value="<?php echo $language['Save & Change']; ?>" class="btn btn-success" /></center>
		          </div>
			    </div>
				
			</div>
		<!---------------------------End Admission Details ----------------------------------------->
				   
	
	
                  <!---------------------------Start Family Contact ----------------------------------------->
		<div class="box-body ">
			<h3 style="color:#d9534f;"><b><?php echo $language['Family Contacts']; ?>:</b></h3>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Father Contact No']; ?></label>
						   <input type="text" minlength="10" maxlength="10" name="student_father_contact_number"    value="<?php echo $student_father_contact_number; ?>" class="form-control">
						</div>
				</div>
						<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Father Contact No2']; ?></label>
						   <input type="text" minlength="10" maxlength="10" name="student_father_contact_number2"    value="<?php echo $student_father_contact_number2; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Father Email Id']; ?></label>
						   <input type="email"  name="student_father_email_id"   value="<?php echo $student_father_email_id; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Mother Contact No']; ?></label>
						   <input type="tel" minlength="10" maxlength="10" name="student_mother_contact_number"   value="<?php echo $student_mother_contact_number; ?>" class="form-control">
						</div>
				</div>			
				<div class="col-md-3">	
					<div class="form-group">
					  <label><?php echo $language['Mother Email Id']; ?></label>
					  <input type="email"  name="student_mother_email_id"   value="<?php echo $student_mother_email_id; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Father Occupation']; ?></label>
						   <input type="text"  name="student_father_occupation"    value="<?php echo $student_father_occupation; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Mother Occupation']; ?></label>
						   <input type="text"  name="student_mother_occupation"    value="<?php echo $student_mother_occupation; ?>" class="form-control">
						</div>
				</div>	
						<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Guardian Name']; ?></label>
						   <input type="text"  name="student_guardian_name"    value="<?php echo $student_guardian_name; ?>" class="form-control">
						</div>
				</div>
						<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Relation With Guardian']; ?></label>
						   <input type="text"  name="student_guardian_relation"    value="<?php echo $student_guardian_relation; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Guardian Contact Number']; ?></label>
						   <input type="text"  minlength="10" maxlength="10" name="student_guardian_contact_number"    value="<?php echo $student_guardian_contact_number; ?>" class="form-control">
						</div>
				</div>
						<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Guardian Email Id']; ?></label>
					  <input type="email"  name="student_guardian_email_id"   value="<?php echo $student_guardian_email_id; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Guardian Occupation']; ?></label>
						   <input type="text"  name="student_guardian_occupation"    value="<?php echo $student_guardian_occupation; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Contact Number']; ?></label>
						   <input type="text" minlength="10" maxlength="10" name="student_contact_number"    value="<?php echo $student_contact_number; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['SMS Contact Number']; ?></label>
						   <input type="text" minlength="10" maxlength="10" name="student_sms_contact_number"   value="<?php echo $student_sms_contact_number; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['SMS Facility']; ?></label>
						   <select class="form-control" name="student_web_sms">
					        <option value="<?php echo $student_web_sms; ?>"><?php echo $student_web_sms; ?></option>
					        <option value="No">No</option>
					        <option value="Yes">Yes</option>
					        </select>
						</div>
				</div>				
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Conveyance']; ?></label>
						   <select class="form-control" name="student_walk_through" onchange="walk_through(this.value)">
						   <?php if($student_bus=="Yes"){ 
						   if($student_walk_through!=""){    ?>
					        <option value="<?php echo $student_walk_through; ?>"><?php echo $student_walk_through; ?></option>
							<?php }else { ?>
							<option value="By Bus">By Bus</option>
							<?php } }else{ ?>
					        <option value="With Parent">With Parent</option>
					        <option value="By Bus">By Bus</option>
					        <option value="With Guardian">With Guardian</option>
					        <option value="On Foot">On Foot</option>
							<?php } ?>
					        </select>
						</div>
				</div>
				<div class="col-md-3 " style="display:none" id="student_walk_with">
						<div class="form-group">
						  <label>BUS/Gradian Name</label>
						   <input type="text"  name="student_walk_with"    value="<?php echo $student_walk_with; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Student Email Id']; ?></label>
						   <input type="email"  name="student_email_id"    value="<?php echo $student_email_id; ?>" class="form-control">
						</div>
				</div>
				<div class="box-body">
			       <div class="col-md-12">
		           <center><input type="submit" name="finish" value="<?php echo $language['Save & Change']; ?>" class="btn btn-success" /></center>
		           </div>
			    </div>
				
				
		</div>
				  
				  
				  <!---------------------------End Family Contact ----------------------------------------->
				      
					  	  <!---------------------------Start Address Details ----------------------------------------->
				      
					  
					  <div class="box-body ">
			<h3 style="color:#d9534f;"><b>Address Details:</b></h3>
				
				<div class="col-md-12">
				<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Student Address']; ?></label>
						   <input type="text"  name="student_adress"  id="student_adress"    value="<?php echo $student_adress; ?>" class="form-control">
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Village/City']; ?></label>
						   <input type="text"  name="student_city"  id="student_city"    value="<?php echo $student_city; ?>" class="form-control">
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Block']; ?></label>
						   <input type="text"  name="student_block"  id="student_block"    value="<?php echo $student_block; ?>" class="form-control">
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['District']; ?></label>
						   <input type="text"  name="student_district"  id="student_district"    value="<?php echo $student_district; ?>" class="form-control">
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['State']; ?></label>
						   <input type="text"  name="student_state"  id="student_state"    value="<?php echo $student_state; ?>" class="form-control">
						
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Pincode']; ?></label>
						   <input type="text"  name="student_pincode"  id="student_pincode"    value="<?php echo $student_pincode; ?>" class="form-control">
						</div>
				</div>
					<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Landmark']; ?></label>
						   <input type="text"  name="student_landmark"  id="student_landmark"    value="<?php echo $student_landmark; ?>" class="form-control">
						</div>
				</div>
				</div>
				<div class="col-md-12">

						  <label style="color:red">For Same</label>
						   <input type="checkbox"   id="same_address_checkbox" onclick="same_address_function();" >
				</div>
				<div class="col-md-12">
				<div class="col-md-3">
						<div class="form-group">
						  <label>Student Address Permanent</label>
						   <input type="text"  name="student_address_permanent"  id="student_address_permanent"    value="<?php echo $student_address_permanent; ?>" class="form-control">
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label>Village/City Permanent</label>
						   <input type="text"  name="student_city_permanent"  id="student_city_permanent"    value="<?php echo $student_city_permanent; ?>" class="form-control">
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label>Block Permanent</label>
						   <input type="text"  name="student_block_permanent"  id="student_block_permanent"    value="<?php echo $student_block_permanent; ?>" class="form-control">
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label>District Permanent</label>
						   <input type="text"  name="student_district_permanent"  id="student_district_permanent"    value="<?php echo $student_district_permanent; ?>" class="form-control">
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label>State Permanent</label>
						   <input type="text"  name="student_state_permanent"  id="student_state_permanent"    value="<?php echo $student_state_permanent; ?>" class="form-control">
						
						</div>
				</div>
							<div class="col-md-3">
						<div class="form-group">
						  <label>Pincode Permanent</label>
						   <input type="text"  name="student_pincode_permanent"  id="student_pincode_permanent"    value="<?php echo $student_pincode_permanent; ?>" class="form-control">
						</div>
				</div>
		
				</div>
				<div class="box-body">
			       <div class="col-md-12">
		           <center><input type="submit" name="finish" value="<?php echo $language['Save & Change']; ?>" class="btn btn-success" /></center>
		           </div>
			    </div>
				
				
		</div>
				 <!---------------------------End Address Details ----------------------------------------->
					  
				 <!---------------------------Start Document Upload ----------------------------------------->
		    <div class="box-body ">
			    <h3 style="color:#d9534f;"><b><?php echo $language['Document Uploads']; ?>:</b></h3>
				<div class="col-md-2">	
					<div class="form-group" >
					  <label><?php echo $language['Student Photo']; ?></label>
					  <input type="file" id="student_image" name="student_image"  onchange="check_file_type(this,'student_image','show_student_photo','image');"  value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					 <img onclick="open_file1('student_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_image!=''){ echo 'data:image;base64,'.$student_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_student_photo" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
				<div class="col-md-2 ">	
					<div class="form-group" > 
					  <label>Father Photo</label>
					  <input type="file"  id="student_father_image" name="student_father_image"  onchange="check_file_type(this,'student_father_image','show_father_photo','image');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					  <img onclick="open_file1('student_father_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_father_image!=''){ echo 'data:image;base64,'.$student_father_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_father_photo" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
				<div class="col-md-2 ">	
					<div class="form-group" > 
					  <label>Mother Photo</label>
					  <input type="file"  id="student_mother_image" name="student_mother_image"  onchange="check_file_type(this,'student_mother_image','show_mother_photo','image');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					  <img onclick="open_file1('student_mother_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_mother_image!=''){ echo 'data:image;base64,'.$student_mother_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_mother_photo" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
				<div class="col-md-2">	
					<div class="form-group">
					  <label><?php echo $language['Guardian Photo']; ?></label>
					  <input type="file" id="student_guardian_image" name="student_guardian_image"   value="" onchange="check_file_type(this,'student_guardian_image','show_guardian_photo','image');"class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group" >
					  <img onclick="open_file1('student_guardian_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_guardian_image!=''){ echo 'data:image;base64,'.$student_guardian_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_guardian_photo" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
			    <div class="col-md-2 ">
						<div class="form-group">
						  <label><?php echo $language['Last Passed Marksheet']; ?></label>
						   <input type="file" id="student_last_marksheet_image" name="student_last_marksheet_image" onchange="check_file_type(this,'student_last_marksheet_image','show_student_last_marksheet','all');"   value="" class="form-control" accept=".gif, .jpg, .jpeg, .png" >
						</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group" >
					  <img onclick="open_file1('student_last_marksheet_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_last_marksheet_image!=''){ echo 'data:image;base64,'.$student_last_marksheet_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_student_last_marksheet" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
				<div class="col-md-2 ">
						<div class="form-group">
						  <label><?php echo $language['Transfer Certificate']; ?></label>
						   <input type="file"  id="student_tc_image" name="student_tc_image"   onchange="check_file_type(this,'student_tc_image','show_student_tc','all');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png" >
						</div>
				</div>
			<div class="col-md-1">	
					<div class="form-group" >
					  <img onclick="open_file1('student_tc_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_tc_image!=''){ echo 'data:image;base64,'.$student_tc_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_student_tc" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
				<div class="col-md-2">
						<div class="form-group">
						  <label><?php echo $language['Income Certificate']; ?></label>
						   <input type="file"  id="student_income_certificate_image" name="student_income_certificate_image"   onchange="check_file_type(this,'student_income_certificate_image','show_student_income_certificate','all');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png" >
						</div>
				</div>
			<div class="col-md-1">	
					<div class="form-group" >
					  <img onclick="open_file1('student_income_certificate_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_income_certificate_image!=''){ echo 'data:image;base64,'.$student_income_certificate_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_student_income_certificate" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
				<div class="col-md-2 ">
						<div class="form-group">
						<label><?php echo $language['Caste of Certificate']; ?></label>
						  <input type="file" id="student_cast_certificate_image" name="student_cast_certificate_image" onchange="check_file_type(this,'student_cast_certificate_image','show_student_cast_certificate','all');"  value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
						</div>
				</div>	
			<div class="col-md-1">	
					<div class="form-group" >
					  <img onclick="open_file1('student_cast_certificate_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_cast_certificate_image!=''){ echo 'data:image;base64,'.$student_cast_certificate_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_student_cast_certificate" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>			
				<div class="col-md-2 ">	
					<div class="form-group" >
					  <label><?php echo $language['DOB Certificate']; ?></label>
					  <input type="file" id="student_dob_image" name="student_dob_image"  onchange="check_file_type(this,'student_dob_image','show_student_dob','all');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
			<div class="col-md-1">	
					<div class="form-group" >
					  <img onclick="open_file1('student_dob_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_dob_image!=''){ echo 'data:image;base64,'.$student_dob_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_student_dob" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
							<div class="col-md-2 ">	
					<div class="form-group" > 
					  <label>Adhar Card</label>
					  <input type="file"  id="student_adhar_card_image" name="student_adhar_card_image"  onchange="check_file_type(this,'student_adhar_card_image','show_adhar_photo','image');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group" >
					  <img onclick="open_file1('student_adhar_card_image','<?php echo $student_roll_no; ?>');" src="<?php if($student_adhar_card_image!=''){ echo 'data:image;base64,'.$student_adhar_card_image; }else{ echo $school_software_path."images/student_blank.png"; }  ?>" id="show_adhar_photo" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
				<div id="mypdf_view">
				</div>
				<div class="col-md-12">
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Remark 1']; ?></label>
						   <input type="text"  name="student_remark_1"  value="<?php echo $student_remark_1; ?>" class="form-control">
						</div>
			    </div>
				<div class="col-md-3">
					<div class="form-group">
					  <label><?php echo $language['Remark 2']; ?></label>
					   <input type="text"  name="student_remark_2"   value="<?php echo $student_remark_2; ?>" class="form-control">
					</div>
			    </div>
				<div class="col-md-3">
					<div class="form-group">
					  <label><?php echo $language['Remark 3']; ?></label>
					   <input type="text"  name="student_remark_3"   value="<?php echo $student_remark_3; ?>" class="form-control">
					</div>
			    </div>
				<div class="col-md-3 ">
					<div class="form-group">
					  <label><?php echo $language['Remark 4']; ?></label>
					   <input type="text"  name="student_remark_4"   value="<?php echo $student_remark_4; ?>" class="form-control">
					</div>
			    </div>
				</div>
				</br>
				</br>
				<div class="box-body col-md-12" >
			       <div class="col-md-6">
		            <input type="submit" style="float:right;" name="finish" value="<?php echo $language['Save & Change']; ?>" class="btn btn-success" />
		           </div>
			    </div>
			</div>
			</br></br>
              <!---------------------------End Document Upload ----------------------------------------->

    <!---------------------------------------------End Admission form------------------------->
		  <!-- /.box-body -->
         
		</form>	
<div id="mypdf_view">
			<div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>



<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>