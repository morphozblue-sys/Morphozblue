<?php include("../attachment/session.php"); 
$que11="select * from login";
       $run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
       while($row11=mysqli_fetch_assoc($run11)){
	   $student_id_generate=$row11['student_id_generate']; 
	   }
$student_adress='';
$student_city='';
$student_block='';
$student_district='';
$student_state='';
$student_pincode='';
$student_landmark='';
$student_mother_name='';


?>
   <section class="content-header">
      <h1>
        <?php echo $language['Student Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
		 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('student/students')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Student']; ?></a></li>
	  <li class="active"><?php echo $language['Student Registration']; ?></li>
      </ol>
    </section>
	  

<script>
	
function for_stream_get(){
var class_name=document.getElementById('student_class').value;
$('#student_class_stream').html("<option value='' >Loading....</option>"); 
$.ajax({
type: "POST",
url:access_link+"student/ajax_get_stream_name.php?class_name="+class_name+"",
cache: false,
success: function(detail){
    // alert_new(detail);
$("#student_class_stream").html(detail);
}
});
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
function for_stream(value2){
for_stream_get();
		   if(value2=="11TH" || value2=="12TH"){
$("#student_class_stream_div").show();
$("#student_class_group_div").show();
$("#student_class_group_subject_div").show();
$("#student_class_stream").attr('required',true);
$("#student_class_group").attr('required',true);
}else{
$("#student_class_stream_div").hide();
$("#student_class_group_div").hide();
$("#student_class_group_subject_div").hide();
$("#student_class_stream").attr('required',false);
$("#student_class_group").attr('required',false);
}
}
   function get_group(value1){
       
       $.ajax({
			  type: "POST",
              url:  access_link+"student/ajax_stream_group.php?stream_name="+value1+"",
              cache: false,
              success: function($detail1){
                   var str1 =$detail1;                
        
                  $("#student_class_group").html(str1);
              }
           });
    }  

	function sms_contact(value1){
       
$('#student_sms_contact_number').val(value1);
    }
	  function get_group_subject(){
     var  student_class=document.getElementById('student_class').value;
     var  group_name=document.getElementById('student_class_group').value;
     var  stream_name=document.getElementById('student_class_stream').value;
       if(student_class!=''){
       $.ajax({
			  type: "POST",
              url:  access_link+"student/ajax_stream_group_subject.php?student_class="+student_class+"&stream_name="+stream_name+"&group_name="+group_name+"",
              cache: false,
              success: function(detail1){
                  
                  $("#student_class_group_subject").val(detail1);
				    
              }
           });
       }else{
       $("#student_class_group_subject").val('');
       }

    }
function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var student_name = document.getElementById("student_name").value;
    var school_name123 = document.getElementById("school_name123").value;
    var text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
	//	$('#contact').val('Dear '+student_name+',Your Registration Have Completed Successfully . Thanking You '+school_name123);
		$('#contact').val('Dear Student,Your Registration Has Been Completed Successfully . Thank You. From '+school_name123+' [SIMPTION]');
		 $('#send_sms').val('Yes');
    } else {
       text.style.display = "none";
	   $('#contact').val('');
	   $('#send_sms').val('No');
    }
}





    $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
 window.scrollTo(0, 0);
     $("#get_content").html(loader_div);
        $.ajax({
            url: access_link+"student/student_registration_api_flow.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
                // alert_new(detail);
                // console.log(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete',"green");
				   get_content('student/student_registration_list');
            }
			}
         });
      });
    
</script>	

<?php
$que00="select student_registration_number from student_admission_info where session_value='$session1' and student_registration_number!='' ORDER BY s_no DESC LIMIT 0, 1";
$run00=mysqli_query($conn73,$que00);
$student_registration_number=1;
while($row00=mysqli_fetch_assoc($run00)){
$student_registration_number=1+$row00['student_registration_number'];
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
		  <form name="myForm" method="post" id="my_form" enctype="multipart/form-data" action="" onsubmit="return validate();">	
    <div class="box-body">
		
			    <div class="col-md-3">				
					<div class="form-group">
					  <label >Registration No.</label><font style="color:red"><b>*</b></font><br>
						<input type="text" name="student_registration_number" value="<?php echo $student_registration_number; ?>" class="form-control"  required/>
					</div>
				</div>
			    
			    <div class="col-md-3">				
					<div class="form-group">
					  <label ><?php echo $language['Student Old New']; ?></label>
					  <select class="form-control" name="stuent_old_or_new">
					  <option value="New"><?php echo $language['New']; ?></option>
					  <option value="Old"><?php echo $language['Old']; ?></option>
					  </select>
					</div>
				</div>

				<div class="col-md-3 ">				
					<div class="form-group">
					  <label ><?php echo $language['Class']; ?><font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class" id="student_class" onchange="for_stream(this.value);get_group_subject();" required>
					           <option  value=""><?php echo $language['Select Class']; ?></option>
						       <?php 
							   $class37=$_SESSION['class_name37'];
							   $class371=explode('|?|',$class37);
							   $total_class=$_SESSION['class_total37'];
				               for($q=0;$q<$total_class;$q++){
                               $class_name=$class371[$q]; ?>
						       <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
					           <?php } ?>
					    </select>
					  </select>
					</div>
				</div>	
					<div class="col-md-3 " id="student_class_stream_div" style="display:none;">				
					<div class="form-group">
					  <label >Stream<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class_stream" id="student_class_stream" onchange="get_group(this.value);get_group_subject();" >
					           <option  value="">Select Stream</option>
						       <?php  $que="select * from school_info_stream_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $stream_name=$row['stream_name'];
                               if($stream_name!=''){
							   ?>
						       <option value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
					           <?php } } ?>
					    </select>
					
					</div>
				</div>
				<div class="col-md-3 " id="student_class_group_div" style="display:none;">				
					<div class="form-group">
					  <label >Group<font style="color:red"><b>*</b></font></label>
					      <select class="form-control" name="student_class_group" id="student_class_group" onchange="get_group_subject();" >
					           <option  value="">Select Group</option>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-8 " id="student_class_group_subject_div" style="display:none;">				
					<div class="form-group">
					  <label >Group Subject</label>
					 <input type="text" name="student_class_group_subject" id="student_class_group_subject" value="" class="form-control new_student" readonly>
					</div>
				</div>
			    
			    <?php 
			        $schol_info_school_name1='';
			        $que154="select * from school_info_general";
                    $run154=mysqli_query($conn73,$que154) or die(mysqli_error($conn73));
                    while($row154=mysqli_fetch_assoc($run154)){
                    $school_info_school_name1 = $row154['school_info_school_name'];
                    } 
			    ?>
			    
			    <div class="col-md-3" style="display:none;">
						<div class="form-group">
						  <label><?php echo "School_name"; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="school_name123" id="school_name123"   value="<?php echo $school_info_school_name1; ?>" class="form-control new_student">
						</div>
				</div>
			    
			    
			    <div class="col-md-3 ">
						<div class="form-group">
						  <input type="hidden" name="student_id_generate" id="student_id_generate" value="<?php echo $student_id_generate; ?>" class="form-control ">
						  <label><?php echo $language['Student Name']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="student_name" id="student_name" required  placeholder="<?php echo $language['Student Name']; ?>"  value="" class="form-control new_student">
						</div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Father Name']; ?></label>
						   <input type="text"  name="student_father_name" id="student_father_name" placeholder="<?php echo $language['Father Name']; ?>"  value="" class="form-control new_student">
					
						</div>
			    </div>
			    
			    <div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Mother Name']; ?></label>
						   <input type="text"  name="student_mother_name" id="student_mother_name" placeholder="<?php echo $language['Mother Name']; ?>"  value="" class="form-control new_student">
					
						</div>
			    </div>
			    
				<div class="col-md-3">		
						<div class="form-group">
						  <label><?php echo $language['Father Contact No1']; ?><font style="color:red"><b>*</b></font></label>
						   <input type="number" minlength="10" maxlength="10" name="student_father_contact_number" placeholder="<?php echo $language['Father Contact No1']; ?>" oninput="sms_contact(this.value);" value="" id="student_father_contact_number" class="form-control new_student">
						</div>
				</div>
				<div class="col-md-3">		
						<div class="form-group">
						  <label><?php echo $language['Father Contact No2']; ?></label>
				<input type="number" minlength="10" maxlength="10" name="student_father_contact_number2" placeholder="<?php echo $language['Father Contact No2']; ?>"  value="" id="student_father_contact_number2" class="form-control new_student" >
						</div>
				</div>
				<div class="col-md-3 ">	
					<div class="form-group" >
					  <label><?php echo $language['Date Of Birth']; ?><font style="color:red"><b>*</b></font></label>
					  <input type="date"  name="student_date_of_birth" placeholder="" oninput="get_dob_in_words(this.value);" id="student_date_of_birth" value="<?php echo date('Y-m-d') ?>" class="form-control new_student" required>
	
					</div>
				</div>
				<div class="col-md-3">
						<div class="form-group">
						  <label><?php echo $language['Dob In Word']; ?></label>
						   <input type="text"  id="student_date_of_birth_in_word1" name="student_date_of_birth_in_word"  value="" class="form-control" placeholder="<?php echo $language['Dob In Word']; ?>" readonly >
				        </div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label ><?php echo $language['Gender']; ?></label><br>
                      <select class="form-control new_student" name="student_gender" id="student_gender">
					  <option value="Male">Male</option>
					  <option value="Female">Female</option>
                      <option value="Other">Other</option>
					  </select>
					
					</div>
				</div>
				<div class="col-md-3 ">				
					<div class="form-group" >
					  <label ><?php echo $language['Date Of Admission']; ?></label>
					  <input type="date"  name="student_date_of_admission" placeholder=""  value="<?php echo date('Y-m-d') ?>" class="form-control">
					</div>
				</div>	
								
				<div class="col-md-3 ">				
					 <div class="form-group" >
					  <label><?php echo $language['Admission Type']; ?></label>
					  <select class="form-control" name="student_admission_type" id="student_admission_type">
					  <option value="Regular">Regular</option>
					  <option value="Private">Private</option>
					  </select>
					</div>
				 </div>
				<div class="col-md-3">				
					<div class="form-group">
					  <label><?php echo $language['Admission Scheme']; ?></label>
					  <select class="form-control" name="student_admission_scheme">
					  <option value="NON-RTE">NON-RTE</option>
					  <option value="RTE">RTE</option>
					  </select>
					</div>
				</div>
				
				<div class="col-md-3" <?php if($_SESSION['school_info_medium']!='Both'){ ?> style="display:none" <?php } ?>>				
					<div class="form-group">
					  <label><?php echo $language['Medium']; ?></label>
					  <select class="form-control" name="student_medium" <?php if($_SESSION['school_info_medium']=='Both'){ echo "required"; } ?> >
					   <option value="">Select</option>
					   <option value="English">English</option>
					   <option value="Hindi">Hindi</option>
					  </select>
					</div>
				</div>	
				
				<div class="col-md-3" <?php if($_SESSION['school_info_school_board']!='Both'){ ?> style="display:none" <?php } ?>>				
					<div class="form-group">
					  <label>BOARD</label>
					  <select class="form-control" name="student_board" <?php if($_SESSION['school_info_school_board']=='Both'){ echo "required"; } ?> >
					   <option value="">Select</option>
					   <option value="CBSE">CBSE</option>
					   <option value="MP Board">MP Board</option>
					  </select>
					</div>
				</div>
			
				<div class="col-md-3" <?php if($_SESSION['shift']!='yes'){ ?> style="display:none" <?php } ?> >				
					<div class="form-group">
					  <label>SHIFT</label>
					  <select class="form-control" name="student_shift" <?php if($_SESSION['shift']=='yes'){ echo "required"; } ?> >
					   <option value="">Select</option>
					   <option value="Shift2">Shift2</option>
					   <option value="Shift1">Shift1</option>
					  </select>
					</div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group" >
					  <label>Fee Category</label>
					  <select class="form-control" name="student_fee_category">
                    <?php
                    $que1="select * from school_info_fee_category where category_name!=''";
                    $run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
                    while($row1=mysqli_fetch_assoc($run1)){
                    $category_name = $row1['category_name'];
	                $category_name_hindi = $row1['category_name_hindi'];
	                $category_code = $row1['category_code'];
                    ?>
					  <option value="<?php echo $category_name.'|?|'.$category_code; ?>"><?php echo $category_name; ?></option>
					<?php } ?>
					  </select>
					  </div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Bus']; ?></label>
					  <select class="form-control"  name="student_bus">
					    <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Hostel']; ?></label>
					 <select class="form-control"  name="student_hostel">
					    <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
				</div>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Library']; ?></label>
					  <select class="form-control"  name="student_library">
					    <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
				</div>
				<?php
				$que011="select fees_type from school_info_general";
			    $run011=mysqli_query($conn73,$que011);
			    while($row011=mysqli_fetch_assoc($run011)){
			    $fees_type=$row011['fees_type'];
				}
				?>
				
				<div class="col-md-3" style="<?php if($fees_type=='fees1'){ echo 'display:none;'; } ?>">				
					<div class="form-group" >
					  <label><?php echo $language['Registration Fees']; ?></label>
					  <input type="text"  name="student_registration_fee" placeholder="<?php echo $language['Registration Fees']; ?>"  value="" class="form-control">
					</div>
				</div>
				
				<?php
				if($fees_type=='fees1'){
			    ?>
				<div class="col-md-3 " >				
					<div class="form-group">
					  <label>Fee Category<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_fee_category" id="student_fee_category" required >
					           <option  value="">Select Category</option>
						       <?php  $que="select * from school_info_fee_category where category_name!=''";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $category_name=$row['category_name'];
                               $category_code=$row['category_code'];
							   ?>
						       <option value="<?php echo $category_name.'|?|'.$category_code; ?>"><?php echo $category_name; ?></option>
					           <?php } ?>
					    </select>
					
					</div>
				</div>
				<?php } ?>
				<div class="col-md-3">				
					<div class="form-group" >
					  <label><?php echo $language['Sms Contact No']; ?></label>
					  <input type="text"  name="student_sms_contact_number" id="student_sms_contact_number" placeholder="<?php echo $language['Sms Contact No']; ?>"  value="" class="form-control">
					</div>
				</div>
				
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
				
				
				
				
              <div class="col-md-12 ">
				<div class="col-md-3">	
					<div class="form-group">
					  <label><?php echo $language['Student Photo']; ?></label>
					  <input type="file" name="student_photo" id="student_photo" placeholder="" onchange="check_file_type(this,'student_photo','show_student_photo','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_student_photo" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-3">	
					<div class="form-group">
					  <label>Father Photo</label>
					  <input type="file" name="father_photo" id="father_photo" placeholder="" onchange="check_file_type(this,'father_photo','show_father_photo','image');"class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_father_photo" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
					<div class="col-md-3">	
					<div class="form-group">
					  <label>Mother Photo</label>
					  <input type="file" name="mother_photo" id="mother_photo" placeholder="" onchange="check_file_type(this,'mother_photo','show_mother_photo','image');"class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_mother_photo" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				</div>
				<div class="col-md-12 ">
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Remark 1']; ?></label>
						   <input type="text"  name="student_remark_1" placeholder="<?php echo $language['Remark 1']; ?>"  value="" class="form-control">
						</div>
			    </div>
				<div class="col-md-3 ">
					<div class="form-group">
					  <label><?php echo $language['Remark 2']; ?></label>
					   <input type="text"  name="student_remark_2" placeholder="<?php echo $language['Remark 2']; ?>"  value="" class="form-control">
					</div>
			    </div>
							<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Remark 3']; ?></label>
						   <input type="text"  name="student_remark_3" placeholder="<?php echo $language['Remark 3']; ?>"  value="" class="form-control">
						</div>
			    </div>
							<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Remark 4']; ?></label>
						   <input type="text"  name="student_remark_4" placeholder="<?php echo $language['Remark 4']; ?>"  value="" class="form-control">
						</div>
			    </div>
				</div>
				<div class="col-md-12 ">
						<div class="col-md-8 ">	
				<label><input type="checkbox" name="myCheck" id="myCheck"  onclick="myFunction()">&nbsp;&nbsp;&nbsp;<?php echo $language['Check For Message']; ?></label>
				   <div class="form-group" id="text" style="display:none">
					  <input type="text"   name="sms" placeholder="" id="contact"  class="form-control" readonly>
					  <input type="hidden"   name="send_sms" placeholder="" id="send_sms"  class="form-control">
					 
					</div>
				</div>
				</div>
				<div class="col-md-12 ">
				<center><input type="submit" name="finish" id="submitButtonId" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
				</div>
				
		
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

<!---------------------------------------------Model window start --------------------------------------------------------->

</form>

</div>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>