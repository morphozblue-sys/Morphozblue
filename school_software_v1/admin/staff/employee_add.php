<?php include("../attachment/session.php")?>
<?php
  $query21="select * from school_info_general";
  $res32=mysqli_query($conn73,$query21) or die(mysqli_error($conn73));
  
  while($row55=mysqli_fetch_assoc($res32)){
      $school_info_medium=$row55['school_info_medium'];
      $shift=$row55['shift'];
  }
?>
<script>
function for_teaching(value){
if(value=='Teaching'){
$('#for_class_prefered').show();
$('#for_subject_prefered').show();
}else{
$('#for_class_prefered').hide();
$('#emp_class_preferred').val('');
$('#for_subject_prefered').hide();
$('#emp_subject_preferred').val('');
}
}

function myFunction(){
    var checkBox = document.getElementById("myCheck");
    var emp_name = document.getElementById("emp_name").value;
    var school_name123 = document.getElementById("school_name123").value;
    var text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
// 		$('#contact').val('Dear '+emp_name+', Congratulation You Have Become Part of our organisation.');
		$('#contact').val('Dear '+emp_name+', Congratulation You Have Become Part of our organisation. Regards '+school_name123+' [SIMPTION]');
		 $('#send_sms').val('Yes');
    } else {
       text.style.display = "none";
	   $('#contact').val('');
	   $('#send_sms').val('No');
    }
}
function readURL(input,id){
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
	   if (file.size >= 50 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 50KB",'red');
      return;
    }  
if(!file.type.match("image/*"))
{
 $('#'+id).val('');
alert_new("Please Upload JPG/JPEG/PNG/GIF File",'red');

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
	alert_new("Please Upload JPG/JPEG/PNG/GIF File",'red');
	
	}
  };
  fileReader.readAsArrayBuffer(file);
  readURL(input,id_show);
}else{

	   var file = input.files[0];
	   if (file.size >= 50 * 1024) {
	    $('#'+id).val('');
      alert_new("File size must be at most 50KB",'red');
	  
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
	alert_new("Please Upload JPG/JPEG/PNG/GIF/PDF/DOC File",'red');
	 
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
window.scrollTo(0, 0);
    $("#get_content").html(loader_div);
        $.ajax({
            url: access_link+"staff/employee_add_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
            
            
            console.log(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('staff/employee_list');
            }
			}
         });
      });
    
</script> 
 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $language['Employee Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small></h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('staff/staff')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Employee']; ?></a></li>
	  <li class="active"><?php echo $language['Add Employee']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
            </div>

    <div class="box-body">
	<form method="post" enctype="multipart/form-data" action="" id="my_form">
			 
		<div class="box-body ">
		<h4 style="color:#d9534f;"><b><?php echo $language['Personal Detail']; ?>:</b></h4>
			<div class="col-md-3 ">
				<div class="form-group">
                    <label><?php echo $language['Employee Name']; ?><font style="color:red"><b>*</b></font></label>
                    <input type="text" required name="emp_name" id="emp_name" placeholder="<?php echo $language['Employee Name']; ?>" oninput="myFunction();"  value="" class="form-control">
                </div>
					
			</div>
			<div class="col-md-3 ">
				<div class="form-group">
                  <label><?php echo $language['Gender']; ?></label>
                   <select name="emp_gender" class="form-control">
			          <option value="Male">Male</option>  
			          <option value="Female">Female</option>
			          <option value="Transgender">Transgender</option>
			        </select>
				</div>
			</div>
			<div class="col-md-3 ">		
				<div class="form-group">
                    <label><?php echo $language['Date Of Birth']; ?></label>
                    <input type="date" name="emp_dob" placeholder="<?php echo $language['Date Of Birth']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">	
				<div class="form-group">
                    <label><?php echo $language['Husband Father Name']; ?></label>
                    <input type="text" name="emp_father" placeholder="<?php echo $language['Husband Father Name']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                    <label><?php echo $language['Email Address']; ?> <font style="color:red"><b>*</b></font></label>
                    <input type="email" name="emp_email" placeholder="<?php echo $language['Email Address']; ?>"  value="" class="form-control" required>
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                    <label>SMS Contact No</label>
                    <input type="text" name="emp_mobile" placeholder="SMS Contact No"  value="" class="form-control">
                </div>
			</div>
		
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label><?php echo $language['Address']; ?></label>
                   <input type="text" name="emp_address" placeholder="<?php echo $language['Address']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                    <label><?php echo $language['Employee Qualification']; ?></label>
                    <input type="text" name="emp_qualification" placeholder="<?php echo $language['Employee Qualification']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                    <label>Blood Group</label>
                    <input type="text" name="blank_field_5" placeholder="Blood Group"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                    <label>Enter Emp Id Prefix Text </label>
                    <input type="text" name="emp_id_prefix" placeholder="Enter Emp Id Prefix text"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                    <label>SSSM ID</label>
                    <input type="text" name="emp_sssm_id" value="" class="form-control" />
                </div>
			</div>
			
			<?php //if($school_info_medium=='Both') { ?>
			<div class="col-md-3 " style="<?php if($school_info_medium!='Both') { echo 'display:none;'; } ?>">				
				<div class="form-group">
                    <label>Medium </label>
                    <select type="text" name="emp_medium" placeholder="Medium" class="form-control">
                        <option value="">Select Medium</option>
                        <option value='Hindi'>Hindi</option>
                        <option value='English'>English</option>
                    </select>    
                </div>
			</div>
			<?php //}  if($shift=='yes') { ?>
			
			<div class="col-md-3 " style="<?php if($shift!='yes') { echo 'display:none;'; } ?>">				
				<div class="form-group">
                    <label>Shift </label>
                    <select name="emp_shift" placeholder="Shift" class="form-control">
                        <option value="">Select Shift</option>
                        <option value="shift1">Shift-1</option>
                        <option value="shift2">Shift-2</option>
                    </select>
                </div>
			</div>
			<?php //} ?>
		</div>	
		<div class="box-body ">
		  <h4 style="color:#d9534f;"><b>Document Upload:</b></h4>

<div class="col-md-2">	
					<div class="form-group" >
					  <label>Employee Photo</label>
					  <input type="file" id="emp_photo" name="emp_photo" placeholder="" onchange="check_file_type(this,'emp_photo','show_emp_photo','image');"  value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					  <img id="show_emp_photo" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-2 ">	
					<div class="form-group" > 
					  <label>Experience Letter</label>
					  <input type="file"  id="emp_experience_latter" name="emp_experience_latter" placeholder="" onchange="check_file_type(this,'emp_experience_latter','show_emp_experience_latter','image');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					    <img id="show_emp_experience_latter" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-2 ">	
					<div class="form-group" > 
					  <label>Qualification Proof</label>
					  <input type="file"  id="emp_degree" name="emp_degree" placeholder="" onchange="check_file_type(this,'emp_degree','show_emp_degree','image');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					   <img id="show_emp_degree" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-2">	
					<div class="form-group">
					  <label>Id Proof</label>
					  <input type="file" id="emp_id_proof" name="emp_id_proof" placeholder=""  value="" onchange="check_file_type(this,'emp_id_proof','show_emp_id_proof','image');"class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group" >
					   <img id="show_emp_id_proof" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
			    <div class="col-md-2 ">
						<div class="form-group">
						  <label>Other Document 1</label>
						   <input type="file" id="emp_other_document1" name="emp_other_document1" onchange="check_file_type(this,'emp_other_document1','show_emp_other_document1','all');" placeholder=""  value="" class="form-control" accept=".gif, .jpg, .jpeg, .png" >
						</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group" >
					    <img id="show_emp_other_document1" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				<div class="col-md-2 ">
						<div class="form-group">
						  <label>Other Document 2</label>
						   <input type="file"  id="emp_other_document2" name="emp_other_document2"  placeholder="" onchange="check_file_type(this,'emp_other_document2','show_emp_other_document2','all');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png" >
						</div>
				</div>
			<div class="col-md-1">	
					<div class="form-group" >
					    <img id="show_emp_other_document2" src='<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
				</div>



		  
		  <div class="box-body ">
		  <h4 style="color:#d9534f;"><b><?php echo $language['Document Details']; ?>:</b></h4>
			<div class="col-md-3 ">				
				<div class="form-group">
                    <label><?php echo $language['Date Of joining']; ?></label>
                    <input type="date" name="emp_doj" placeholder=""  value="<?php echo date('Y-m-d'); ?>" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                    <label><?php echo $language['Rfid No']; ?></label>
                    <input type="text" name="emp_rf_id_no" placeholder="<?php echo $language['Rfid No']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                  <label><?php echo $language['Categories']; ?></label>
                    <select name="emp_categories" class="form-control" onchange="for_teaching(this.value);">
			          <option value="Teaching"><?php echo $language['Teaching']; ?></option>  
			          <option value="Non Teaching"><?php echo $language['Non Teaching']; ?></option>
			        </select>
                </div>
			</div>
			
			<div class="col-md-3 " id="for_class_prefered">				
				<div class="form-group">
                  <label><?php echo $language['Teaching Class Preferred']; ?></label>
                   <input type="text" name="emp_class_preferred" id="emp_class_preferred" placeholder="<?php echo $language['Teaching Class Preferred']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-3 " id="for_subject_prefered">				
				<div class="form-group">
                  <label><?php echo $language['Teaching Subject Preferred']; ?></label>
                   <input type="text" name="emp_subject_preferred" id="emp_subject_preferred" placeholder="<?php echo $language['Teaching Subject Preferred']; ?>"  value="" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label><?php echo $language['Designation']; ?></label>
				<select name="emp_designation" class="form-control" >
			          <option value="">Select</option>
			          <option value="Director">Director</option>
			          <option value="Principle">Principal</option>
			          <option value="Vice Principal">Vice Principal</option>
			          <option value="Incharge Principal">Incharge Principal</option>
			          <option value="Head Master">Head Master</option>
			          <option value="Head Mistress">Head Mistress</option>
			          <option value="Teacher">Teacher</option> 
			          <option value="Accountant">Accountant</option>  
			          <option value="Librarian">Librarian</option>			           
			          <option value="Computer Operator">Computer Operator</option>
			          <option value="Driver">Driver</option> 
			          <option value="Peon">Peon</option>  
			          <option value="Maid">Maid</option> 
			          <option value="Cordinator">Cordinator</option>  
			          <option value="PGT">PGT</option>  
			          <option value="TGT">TGT</option> 
			          <option value="PRT">PRT</option> 
			          <option value="sport Incharge">sport Incharge</option> 
			          <option value="Music Incharge">Music Incharge</option> 
			          <option value="Dance Teacher">Dance Teacher</option> 
			          <option value="PPT">PPT</option> 
			           <option value="AT">AT</option>
			          <option value="Assistant Teacher">Assistant Teacher</option>  
			          <option value="Other">Other</option>
               </select>
                </div>
			</div>
		</div>
		
	<div class="box-body ">
		<h4 style="color:#d9534f;"><b><?php echo $language['Salary Details']; ?>:</b></h4>
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label ><?php echo $language['Pan Card No']; ?></label>
                   <input type="text" name="emp_pan_card_no" placeholder="<?php echo $language['Pan Card No']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                  <label ><?php echo $language['Aadhar No']; ?></label>
                  <input type="text"  name="emp_uid_no" placeholder="<?php echo $language['Aadhar No']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                  <label ><?php echo $language['Bank Name']; ?> </label>
                  <input type="text" name="emp_bank_name" placeholder="<?php echo $language['Bank Name']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label ><?php echo $language['Bank Account No']; ?></label>
                   <input type="text" name="emp_account_no" placeholder="<?php echo $language['Bank Account No']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label ><?php echo $language['Bank Ifsc Code']; ?></label>
                   <input type="text" name="emp_ifsc_code" onkeyup="this.value = this.value.toUpperCase();" placeholder="<?php echo $language['Bank Ifsc Code']; ?>"  value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label><?php echo $language['Salary']; ?></label>
                   <input type="number" name="emp_basic_salary" placeholder="<?php echo $language['Salary']; ?>"  min="0" value="" class="form-control">
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label ><?php echo $language['Other Wages']; ?> </label>
                   <input type="number"  name="emp_other_wages" placeholder="<?php echo $language['Other Wages']; ?>"  min="0" value="" class="form-control">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label ><?php echo $language['Pf Number']; ?></label>
                   <input type="text" name="emp_pf_number" placeholder="<?php echo $language['Pf Number']; ?>"  value="" class="form-control">
                </div>
			</div>
			
				<div class="col-md-3 ">				
				<div class="form-group">
                   <label >PF Amount Monthly</label>
                   <input type="number" name="pf_deduction"   value="" class="form-control" min="0">
                </div>
			</div>
				<div class="col-md-3 ">				
				<div class="form-group">
                   <label >TDS Amount Monthly</label>
                   <input type="number" name="tds_deduction"   class="form-control" min="0">
                </div>
			</div>
				<div class="col-md-3 ">				
				<div class="form-group">
                   <label >ESIC Amount Monthly</label>
                   <input type="number" name="esic_deduction"   class="form-control" min="0">
                </div>
			</div>
				<div class="col-md-3 ">				
				<div class="form-group">
                   <label >Professional TAX Amount Monthly</label>
                   <input type="number" name="ptax_deduction"   class="form-control" min="0">
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                  <label >HRA Amount Monthly</label>
                  <input type="number"  name="hra_amount" min="0"  value="" class="form-control"   >
                </div>
			</div>
				<div class="col-md-3 ">				
				<div class="form-group">
				    <?php if($_SESSION['software_link']=='lotusvalleyschoolozar'){?>
				    <label >Last Year Dues</label>
				    <?php }else{ ?>
                   <label >DA Amount Monthly</label>
                   <?php } ?>
                   <input type="number" name="da_amount"  value="" class="form-control" min="0">
                </div>
			</div>
			<div class="col-md-3 ">				
				<div class="form-group">
                  <label >Allowances Monthly</label>
                  <input type="number" name="emp_allowance"   value="" class="form-control" min="0">
                </div>
			</div>
			
		
			
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label ><?php echo $language['Remark']; ?></label>
                   <input type="text" name="remarks" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control">
                </div>
			</div>
		</div>
		<div class="box-body ">
		<h4 style="color:#d9534f;"><b><?php echo $language['Leave Details']; ?>:</b></h4>
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label ><?php echo $language['Casual Leave']; ?></label>
                   <input type="number" name="emp_leave_cl" placeholder="<?php echo $language['Casual Leave']; ?>"  value="" class="form-control" min="0">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                  <label ><?php echo $language['Pay Earn Leave']; ?></label>
                  <input type="number"  name="emp_leave_pl" min="0" placeholder="<?php echo $language['Pay Earn Leave']; ?>"  value="" class="form-control"   >
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                  <label ><?php echo $language['Sick Leave']; ?></label>
                  <input type="number" name="emp_leave_sl" placeholder="<?php echo $language['Sick Leave']; ?>"  value="" class="form-control" min="0">
                </div>
			</div>
			
			<div class="col-md-3 ">				
				<div class="form-group">
                   <label ><?php echo $language['Other Leave']; ?></label>
                   <input type="number" name="emp_leave_other" placeholder="<?php echo $language['Other Leave']; ?>"  value="" class="form-control" min="0">
                </div>
			</div>
			
			
		</div>

<div class="box-body ">
    
    
        <?php 
			        $schol_info_school_name1='';
			        $que154="select * from school_info_general";
                    $run154=mysqli_query($conn73,$que154) or die(mysqli_error($conn73));
                    while($row154=mysqli_fetch_assoc($run154)){
                    $school_info_school_name = $row154['multiple_school'];
                    if($school_info_school_name==""){
                    $school_info_school_name = $row154['school_info_school_name'];
                    }
                    } 
			    ?>
			    
			    	<?php
				if($_SESSION['database_name1']=='wisdomipshdr' || $_SESSION['database_name1']=='gyanbhartischoolkabrai'){
				    if(substr_count($school_info_school_name, " ")>0){
				        $school_info_school_name1=explode(" ",$school_info_school_name);
				        $schl_count=count($school_info_school_name1);
				        $school_info_school_name='';
				        for($ai=0;$ai<$schl_count;$ai++){
				            $school_info_school_name=$school_info_school_name.substr($school_info_school_name1[$ai],0,1);
				        }
				    }
				}
				?>
			    
			    
			    
			    <div class="col-md-3" style="display:none;">
						<div class="form-group">
						  <label><?php echo "School_name"; ?><font style="color:red"><b>*</b></font></label>
						   <input type="text"  name="school_name123" id="school_name123"   value="<?php echo $school_info_school_name; ?>" class="form-control new_student">
						</div>
				</div>
				
				
				
		<h4 style="color:#d9534f;"><b><?php echo $language['Message Details']; ?>:</b></h4>
			<div class="col-md-3 ">				
				<div class="form-group">
                   &nbsp;
                </div>
			</div>
			
			<div class="col-md-6 ">				
				<div class="form-group">
					<label><input type="checkbox" name="myCheck" id="myCheck" onclick="myFunction();">&nbsp;&nbsp;&nbsp;<?php echo $language['Check For Message']; ?></label>
				    <div class="form-group" id="text" style="display:none">
					
					  <input type="text" name="sms" placeholder="" id="contact"  class="form-control" readonly>
					  <input type="hidden" name="send_sms" placeholder="" id="send_sms"  class="form-control">
					 
					</div>
                </div>
			</div>
			
		</div>

		<div class="col-md-12">
		        <center><input type="submit" name="finish" value="<?php echo $language['Submit']; ?>" class="btn btn-success" /></center>
		</div>
	  </form>	
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>

    
 