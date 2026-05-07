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

<!-- Page Header -->
<section class="si-ph">
  <div class="si-ph-left">
    <div class="si-ph-badge"><i class="fa fa-user-plus"></i></div>
    <div>
      <h1 class="si-ph-title"><?php echo $language['Student Registration']; ?></h1>
      <p class="si-ph-sub"><?php echo $language['Control Panel']; ?></p>
    </div>
  </div>
  <nav class="si-ph-bc">
    <a class="si-bc-link" href="javascript:get_content('index_content')"><i class="fa fa-home"></i> Home</a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <a class="si-bc-link" href="javascript:get_content('student/students')"><i class="fa fa-user"></i> <?php echo $language['Student']; ?></a>
    <span class="si-bc-sep"><i class="fa fa-chevron-right"></i></span>
    <span class="si-bc-active"><i class="fa fa-user-plus"></i> <?php echo $language['Student Registration']; ?></span>
  </nav>
</section>

<style>
/* ════════════════════════════════════════════
   STUDENT REGISTRATION — Rich Animated Form
   ════════════════════════════════════════════ */

/* Wrapper */
.reg-wrap {
    padding: 22px 18px 40px;
    background: linear-gradient(160deg, #eef1f7 0%, #f4f6fb 60%, #eaecf4 100%);
    min-height: 80vh;
    font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
}

/* ── Section card ── */
.reg-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 6px 28px rgba(15,52,96,.10), 0 1px 4px rgba(0,0,0,.05);
    overflow: hidden;
    margin-bottom: 22px;
    opacity: 0;
    transform: translateY(28px);
    animation: regCardIn .55s cubic-bezier(.34,1.56,.64,1) forwards;
    border: 1px solid rgba(15,52,96,.07);
}
.reg-card:nth-child(1){ animation-delay:.06s }
.reg-card:nth-child(2){ animation-delay:.14s }
.reg-card:nth-child(3){ animation-delay:.22s }
.reg-card:nth-child(4){ animation-delay:.30s }
.reg-card:nth-child(5){ animation-delay:.38s }
.reg-card:nth-child(6){ animation-delay:.46s }
.reg-card:nth-child(7){ animation-delay:.54s }
@keyframes regCardIn {
    to { opacity:1; transform:translateY(0); }
}

/* ── Section header ── */
.reg-card-hdr {
    background: linear-gradient(135deg, #0f3460 0%, #16213e 55%, #1a1a2e 100%);
    padding: 13px 22px;
    display: flex;
    align-items: center;
    gap: 13px;
    border-bottom: 3px solid #b92b27;
    position: relative;
    overflow: hidden;
}
.reg-card-hdr::after {
    content: '';
    position: absolute;
    right: -20px; top: -20px;
    width: 90px; height: 90px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(185,43,39,.35) 0%, transparent 70%);
    pointer-events: none;
}
.reg-hdr-icon {
    width: 34px; height: 34px;
    border-radius: 10px;
    background: rgba(255,255,255,.15);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,.2);
}
.reg-hdr-icon i { font-size: 15px; color: #fff; }
.reg-hdr-title {
    font-size: 12px; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1.1px;
    color: #fff;
}
.reg-hdr-sub {
    font-size: 11px; color: rgba(255,255,255,.55);
    margin-left: auto; letter-spacing: .3px;
}

/* ── Card body ── */
.reg-card-body { padding: 20px 22px 12px; }

/* ── Labels ── */
.reg-wrap .form-group { margin-bottom: 16px; }
.reg-wrap .form-group label {
    font-size: 11.5px; font-weight: 800; color: #2c3e6b;
    text-transform: uppercase; letter-spacing: .5px;
    margin-bottom: 6px; display: flex; align-items: center; gap: 5px;
}
.reg-wrap .form-group label i { font-size: 11px; color: #7f8fa6; }
.reg-req { color: #e74c3c; font-size: 13px; margin-left: 1px; line-height:1; }

/* ── Inputs ── */
.reg-wrap .form-control {
    border: 1.5px solid #dce3ef;
    border-radius: 9px;
    height: 40px;
    font-size: 13.5px;
    color: #2d3436;
    background: #f8f9fc;
    transition: border-color .22s, box-shadow .22s, background .22s;
    padding-left: 12px;
}
.reg-wrap .form-control::placeholder { color: #b2becd; font-size: 13px; }
.reg-wrap .form-control:focus {
    border-color: #0f3460;
    box-shadow: 0 0 0 3.5px rgba(15,52,96,.13);
    background: #fff;
    outline: none;
}
.reg-wrap select.form-control { height: 40px; }
.reg-wrap .form-control:not(:placeholder-shown):not(:focus):not(.reg-invalid) {
    border-color: #27ae60;
    background: #f8fff9;
}
.reg-wrap select.form-control:valid { border-color: #27ae60; background: #f8fff9; }

/* Invalid state */
.reg-wrap .form-control.reg-invalid {
    border-color: #e74c3c !important;
    box-shadow: 0 0 0 3px rgba(231,76,60,.13) !important;
    background: #fff8f7 !important;
    animation: regShake .35s ease;
}
@keyframes regShake {
    0%,100%{ transform:translateX(0); }
    20%    { transform:translateX(-5px); }
    40%    { transform:translateX(5px); }
    60%    { transform:translateX(-3px); }
    80%    { transform:translateX(3px); }
}

/* ── Photo upload zone ── */
.reg-photo-zone {
    border: 2px dashed #c5d0e6;
    border-radius: 12px;
    padding: 14px 12px;
    text-align: center;
    background: #f8f9fc;
    transition: border-color .2s, background .2s;
    cursor: pointer;
    position: relative;
}
.reg-photo-zone:hover {
    border-color: #0f3460;
    background: #f0f4ff;
}
.reg-photo-zone .form-control {
    position: absolute; inset: 0;
    opacity: 0; cursor: pointer;
    height: 100% !important;
    border: none !important; background: none !important;
}
.reg-photo-zone-label {
    font-size: 11px; font-weight: 700;
    color: #7f8fa6; text-transform: uppercase;
    letter-spacing: .5px; margin-top: 6px; display: block;
}

/* Photo preview */
.reg-photo-preview {
    width: 72px; height: 72px;
    border-radius: 14px;
    border: 2.5px solid #dce3ef;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0,0,0,.12);
    transition: transform .25s, box-shadow .25s;
}
.reg-photo-preview:hover { transform: scale(1.06); box-shadow: 0 6px 20px rgba(0,0,0,.2); }

/* ── Submit row ── */
.reg-submit-row {
    text-align: center;
    padding: 22px 0 8px;
}
#submitButtonId {
    background: linear-gradient(135deg, #b92b27 0%, #0f3460 100%) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 12px !important;
    padding: 13px 56px !important;
    font-size: 15px !important;
    font-weight: 800 !important;
    letter-spacing: .5px !important;
    box-shadow: 0 6px 22px rgba(185,43,39,.38) !important;
    transition: transform .22s, box-shadow .22s !important;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
#submitButtonId::after {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,.18) 50%, transparent 70%);
    transform: translateX(-130%);
    animation: regBtnShimmer 2.4s ease-in-out infinite;
}
@keyframes regBtnShimmer {
    0%,60%,100% { transform:translateX(-130%); }
    30%          { transform:translateX(130%); }
}
#submitButtonId:hover:not(:disabled) {
    transform: translateY(-3px) scale(1.02) !important;
    box-shadow: 0 12px 32px rgba(185,43,39,.45) !important;
}
#submitButtonId:disabled { opacity: .6 !important; cursor: not-allowed; }

/* ── Limit exceeded ── */
.reg-limit-msg {
    text-align: center; padding: 44px 20px;
    color: #e74c3c; font-size: 15px; font-weight: 600;
}

/* ── Field entrance stagger ── */
.reg-field-anim {
    opacity: 0;
    transform: translateY(14px);
    animation: regFieldIn .4s ease forwards;
}
@keyframes regFieldIn {
    to { opacity:1; transform:translateY(0); }
}

/* ── Responsive ── */
@media(max-width:767px) {
    .reg-card-body { padding: 14px 14px 8px; }
    .reg-hdr-sub { display: none; }
}
</style>


<script>
function for_stream_get() {
    var class_name = document.getElementById('student_class').value;
    $('#student_class_stream').html("<option value=''>Loading...</option>");
    $.ajax({
        type: "POST",
        url: access_link + "student/ajax_get_stream_name.php?class_name=" + class_name,
        cache: false,
        success: function(detail) { $("#student_class_stream").html(detail); }
    });
}

function get_dob_in_words(dob1) {
    $.ajax({
        type: "POST",
        url: access_link + "student/ajax_datetoword.php?dob=" + dob1,
        cache: false,
        success: function(detail) {
            document.getElementById('student_date_of_birth_in_word1').value = detail;
        }
    });
}

function for_stream(value2) {
    for_stream_get();
    if (value2 === "11TH" || value2 === "12TH") {
        $("#student_class_stream_div, #student_class_group_div, #student_class_group_subject_div").show();
        $("#student_class_stream, #student_class_group").attr('required', true);
    } else {
        $("#student_class_stream_div, #student_class_group_div, #student_class_group_subject_div").hide();
        $("#student_class_stream, #student_class_group").attr('required', false);
    }
}

function get_group(value1) {
    $.ajax({
        type: "POST",
        url: access_link + "student/ajax_stream_group.php?stream_name=" + value1,
        cache: false,
        success: function(detail) { $("#student_class_group").html(detail); }
    });
}

function sms_contact(value1) {
    $('#student_sms_contact_number').val(value1);
}

function get_group_subject() {
    var student_class = document.getElementById('student_class').value;
    var group_name    = document.getElementById('student_class_group').value;
    var stream_name   = document.getElementById('student_class_stream').value;
    if (student_class) {
        $.ajax({
            type: "POST",
            url: access_link + "student/ajax_stream_group_subject.php?student_class=" + student_class + "&stream_name=" + stream_name + "&group_name=" + group_name,
            cache: false,
            success: function(detail) { $("#student_class_group_subject").val(detail); }
        });
    } else {
        $("#student_class_group_subject").val('');
    }
}

function myFunction() {
    var checked    = document.getElementById("myCheck").checked;
    var schoolName = document.getElementById("school_name123").value;
    document.getElementById("text").style.display = checked ? "block" : "none";
    if (checked) {
        $('#contact').val('Dear Student, Your Registration Has Been Completed Successfully. Thank You. From ' + schoolName + ' [SIMPTION]');
        $('#send_sms').val('Yes');
    } else {
        $('#contact').val('');
        $('#send_sms').val('No');
    }
}

/* ── Validation ── */
function reg_markInvalid($el) {
    $el.addClass('reg-invalid');
    $el.one('input change', function() { $(this).removeClass('reg-invalid'); });
}

function validate() {
    var ok = true, msg = '';

    function need(id, label) {
        var $el = $('#' + id);
        if (!($el.val() || '').trim()) {
            reg_markInvalid($el);
            if (ok) msg = label + ' is required';
            ok = false;
        }
    }

    need('student_class',         'Class');
    need('student_name',          'Student Name');
    need('student_date_of_birth', 'Date of Birth');

    var contact = ($('#student_father_contact_number').val() || '').trim();
    if (contact && !/^\d{10}$/.test(contact)) {
        reg_markInvalid($('#student_father_contact_number'));
        if (ok) msg = 'Father Contact No. must be exactly 10 digits';
        ok = false;
    }

    var cls = $('#student_class').val();
    if (cls === '11TH' || cls === '12TH') {
        need('student_class_stream', 'Stream (required for ' + cls + ')');
        need('student_class_group',  'Group (required for '  + cls + ')');
    }

    if (!ok) { alert_new(msg, 'red'); window.scrollTo(0, 0); }
    return ok;
}

$("#my_form").submit(function(e) {
    e.preventDefault();
    if (!validate()) return;

    var $btn = $('#submitButtonId');
    $btn.prop('disabled', true).val('Saving...');
    var formdata = new FormData(this);
    window.scrollTo(0, 0);
    $("#get_content").html(loader_div);

    $.ajax({
        url: access_link + "student/student_registration_api.php",
        type: "POST",
        data: formdata,
        contentType: false,
        cache: false,
        processData: false,
        success: function(detail) {
            var res = detail.split("|?|");
            if (res[1] === 'success') {
                alert_new('Student registered successfully!', 'green');
                get_content('student/student_registration_list');
            } else {
                alert_new(detail || 'Registration failed. Please try again.', 'red');
                get_content('student/student_registration');
            }
        },
        error: function() {
            alert_new('Server error. Please try again.', 'red');
            get_content('student/student_registration');
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
      <div class="reg-wrap">
        <form name="myForm" method="post" id="my_form" enctype="multipart/form-data" action="">
		
		<?php 
		
		$student_limit="";
$que11="select * from school_info_general";
       $run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
       while($row11=mysqli_fetch_assoc($run11)){
	   $student_limit=$row11['sms_sender_id']; 
	   }

$qqqu="select student_registration_number from student_admission_info where session_value='$session1' and student_status='Active'"; 

$run0011=mysqli_query($conn73,$qqqu);

$total_student=mysqli_num_rows($run0011);
		
		if($student_limit>=$total_student || $student_limit==""){ ?>

<!-- ═══ SECTION 1: Basic Information ═══ -->
<div class="reg-card col-md-12">
  <div class="reg-card-hdr">
    <div class="reg-hdr-icon"><i class="fa fa-user"></i></div>
    <span class="reg-hdr-title">Basic Information</span>
    <span class="reg-hdr-sub">Student &amp; class details</span>
  </div>
  <div class="reg-card-body row">

			    <div class="col-md-3">
					<div class="form-group reg-field-anim" style="animation-delay:.05s">
					  <label><i class="fa fa-hashtag"></i> Registration No. <span class="reg-req">*</span></label>
						<input type="text" name="student_registration_number" value="<?php echo $student_registration_number; ?>" class="form-control"  required/>
					</div>
				</div>
			    
			    <div class="col-md-3">
					<div class="form-group reg-field-anim" style="animation-delay:.10s">
					  <label><i class="fa fa-tag"></i> <?php echo $language['Student Old New']; ?></label>
					  <select class="form-control" name="stuent_old_or_new">
					  <option value="New"><?php echo $language['New']; ?></option>
					  <option value="Old"><?php echo $language['Old']; ?></option>
					  </select>
					</div>
				</div>

				<div class="col-md-3 ">
					<div class="form-group reg-field-anim" style="animation-delay:.15s">
					  <label><i class="fa fa-graduation-cap"></i> <?php echo $language['Class']; ?> <span class="reg-req">*</span></label>
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
                    $school_info_school_name = $row154['school_info_school_name'];
                    } 
			    ?>
			    
			    	<?php
				if($_SESSION['database_name']=='simpthqt_wisdomipshdr' || $_SESSION['database_name']=='simptvla_gyanbhartischoolkabrai'){
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
			    
			    
			    <div class="col-md-3 ">
						<div class="form-group reg-field-anim" style="animation-delay:.20s">
						  <input type="hidden" name="student_id_generate" id="student_id_generate" value="<?php echo $student_id_generate; ?>">
						  <label><i class="fa fa-user"></i> <?php echo $language['Student Name']; ?> <span class="reg-req">*</span></label>
						   <input type="text" name="student_name" id="student_name" required placeholder="<?php echo $language['Student Name']; ?>" value="" class="form-control new_student">
						</div>
				</div>

  </div><!-- /.reg-card-body -->
</div><!-- /.reg-card sec-1 -->

<!-- ═══ SECTION 2: Family Information ═══ -->
<div class="reg-card col-md-12">
  <div class="reg-card-hdr">
    <div class="reg-hdr-icon"><i class="fa fa-users"></i></div>
    <span class="reg-hdr-title">Family Information</span>
    <span class="reg-hdr-sub">Parent &amp; contact details</span>
  </div>
  <div class="reg-card-body row">

			    <div class="col-md-3 ">
						<div class="form-group reg-field-anim" style="animation-delay:.05s">
						  <label><i class="fa fa-male"></i> <?php echo $language['Father Name']; ?></label>
						   <input type="text" name="student_father_name" id="student_father_name" placeholder="<?php echo $language['Father Name']; ?>" value="" class="form-control new_student">
						</div>
			    </div>
			    <div class="col-md-3 ">
						<div class="form-group reg-field-anim" style="animation-delay:.10s">
						  <label><i class="fa fa-female"></i> <?php echo $language['Mother Name']; ?></label>
						   <input type="text" name="student_mother_name" id="student_mother_name" placeholder="<?php echo $language['Mother Name']; ?>" value="" class="form-control new_student">
						</div>
			    </div>
				<div class="col-md-3">
						<div class="form-group reg-field-anim" style="animation-delay:.15s">
						  <label><i class="fa fa-phone"></i> <?php echo $language['Father Contact No1']; ?> <span class="reg-req">*</span></label>
						   <input type="number" minlength="10" maxlength="10" name="student_father_contact_number" placeholder="10-digit mobile" oninput="sms_contact(this.value);" value="" id="student_father_contact_number" class="form-control new_student">
						</div>
				</div>
				<div class="col-md-3">
						<div class="form-group reg-field-anim" style="animation-delay:.20s">
						  <label><i class="fa fa-phone"></i> <?php echo $language['Father Contact No2']; ?></label>
						  <input type="number" minlength="10" maxlength="10" name="student_father_contact_number2" placeholder="Alternate number" value="" id="student_father_contact_number2" class="form-control new_student">
						</div>
				</div>

  </div><!-- /.reg-card-body -->
</div><!-- /.reg-card sec-2 -->

<!-- ═══ SECTION 3: Personal Details ═══ -->
<div class="reg-card col-md-12">
  <div class="reg-card-hdr">
    <div class="reg-hdr-icon"><i class="fa fa-id-card"></i></div>
    <span class="reg-hdr-title">Personal Details</span>
    <span class="reg-hdr-sub">DOB, gender &amp; admission info</span>
  </div>
  <div class="reg-card-body row">

			<div class="col-md-3 ">
				<div class="form-group reg-field-anim" style="animation-delay:.05s">
				  <label><i class="fa fa-calendar"></i> <?php echo $language['Date Of Birth']; ?> <span class="reg-req">*</span></label>
				  <input type="date" name="student_date_of_birth" oninput="get_dob_in_words(this.value);" id="student_date_of_birth" value="" class="form-control new_student" required>
	
					</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.10s">
						<div class="form-group">
						  <label><i class="fa fa-font"></i> <?php echo $language['Dob In Word']; ?></label>
						   <input type="text"  id="student_date_of_birth_in_word1" name="student_date_of_birth_in_word"  value="" class="form-control" placeholder="<?php echo $language['Dob In Word']; ?>" readonly >
				        </div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.15s">
					<div class="form-group" >
					  <label><i class="fa fa-venus-mars"></i> <?php echo $language['Gender']; ?></label>
                      <select class="form-control new_student" name="student_gender" id="student_gender">
					  <option value="Male">Male</option>
					  <option value="Female">Female</option>
                      <option value="Other">Other</option>
					  </select>
					</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.10s">
					<div class="form-group" >
					  <label><i class="fa fa-calendar-check-o"></i> <?php echo $language['Date Of Admission']; ?></label>
					  <input type="date"  name="student_date_of_admission" placeholder=""  value="<?php echo date('Y-m-d') ?>" class="form-control">
					</div>
				</div>

  </div><!-- /.reg-card-body -->
</div><!-- /.reg-card sec-3 -->

<!-- ═══ SECTION 4: Academic Details ═══ -->
<div class="reg-card col-md-12">
  <div class="reg-card-hdr">
    <div class="reg-hdr-icon"><i class="fa fa-book"></i></div>
    <span class="reg-hdr-title">Academic Details</span>
    <span class="reg-hdr-sub">Admission type, fees &amp; facilities</span>
  </div>
  <div class="reg-card-body row">

				<div class="col-md-3 reg-field-anim" style="animation-delay:.05s">
					 <div class="form-group" >
					  <label><i class="fa fa-id-badge"></i> <?php echo $language['Admission Type']; ?></label>
					  <select class="form-control" name="student_admission_type" id="student_admission_type">
					  <option value="Regular">Regular</option>
					  <option value="Private">Private</option>
					  </select>
					</div>
				 </div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.10s">
					<div class="form-group">
					  <label><i class="fa fa-certificate"></i> <?php echo $language['Admission Scheme']; ?></label>
					  <select class="form-control" name="student_admission_scheme">
					  <option value="NON-RTE">NON-RTE</option>
					  <option value="RTE">RTE</option>
					  </select>
					</div>
				</div>

				<div class="col-md-3 reg-field-anim" style="animation-delay:.15s" <?php if($_SESSION['school_info_medium']!='Both'){ ?> style="display:none" <?php } ?>>
					<div class="form-group">
					  <label><i class="fa fa-language"></i> <?php echo $language['Medium']; ?></label>
					  <select class="form-control" name="student_medium" <?php if($_SESSION['school_info_medium']=='Both'){ echo "required"; } ?> >
					   <option value="">Select</option>
					   <option value="English">English</option>
					   <option value="Hindi">Hindi</option>
					  </select>
					</div>
				</div>

				<div class="col-md-3 reg-field-anim" style="animation-delay:.20s" <?php if($_SESSION['school_info_school_board']!='Both'){ ?> style="display:none" <?php } ?>>
					<div class="form-group">
					  <label><i class="fa fa-university"></i> Board</label>
					  <select class="form-control" name="student_board" <?php if($_SESSION['school_info_school_board']=='Both'){ echo "required"; } ?> >
					   <option value="">Select</option>
					   <option value="CBSE">CBSE</option>
					   <option value="MP Board">MP Board</option>
					  </select>
					</div>
				</div>

				<div class="col-md-3 reg-field-anim" style="animation-delay:.25s" <?php if($_SESSION['shift']!='yes'){ ?> style="display:none" <?php } ?> >
					<div class="form-group">
					  <label><i class="fa fa-clock-o"></i> Shift</label>
					  <select class="form-control" name="student_shift" <?php if($_SESSION['shift']=='yes'){ echo "required"; } ?> >
					   <option value="">Select</option>
					   <option value="Shift2">Shift2</option>
					   <option value="Shift1">Shift1</option>
					  </select>
					</div>
				</div>

				<div class="col-md-3 reg-field-anim" style="animation-delay:.30s">
					<div class="form-group" >
					  <label><i class="fa fa-tags"></i> Fee Category</label>
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

				<div class="col-md-2 reg-field-anim" style="animation-delay:.35s">
					<div class="form-group" >
					  <label><i class="fa fa-bus"></i> <?php echo $language['Bus']; ?></label>
					  <select class="form-control"  name="student_bus">
					    <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
				</div>

				<div class="col-md-2 reg-field-anim" style="animation-delay:.40s">
					<div class="form-group" >
					  <label><i class="fa fa-home"></i> <?php echo $language['Hostel']; ?></label>
					 <select class="form-control"  name="student_hostel">
					    <option value="No">No</option>
					  <option value="Yes">Yes</option>
					  </select>
					  </div>
				</div>
				<div class="col-md-2 reg-field-anim" style="animation-delay:.45s">
					<div class="form-group" >
					  <label><i class="fa fa-book"></i> <?php echo $language['Library']; ?></label>
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

				<div class="col-md-3 reg-field-anim" style="animation-delay:.50s;<?php if($fees_type=='fees1'){ echo 'display:none;'; } ?>">
					<div class="form-group" >
					  <label><i class="fa fa-money"></i> <?php echo $language['Registration Fees']; ?></label>
					  <input type="text"  name="student_registration_fee" placeholder="<?php echo $language['Registration Fees']; ?>"  value="" class="form-control">
					</div>
				</div>

				<?php
				if($fees_type=='fees1'){
			    ?>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.50s" >
					<div class="form-group">
					  <label><i class="fa fa-tags"></i> Fee Category <span class="reg-req">*</span></label>
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
				<div class="col-md-3 reg-field-anim" style="animation-delay:.55s">
					<div class="form-group" >
					  <label><i class="fa fa-mobile"></i> <?php echo $language['Sms Contact No']; ?></label>
					  <input type="text"  name="student_sms_contact_number" id="student_sms_contact_number" placeholder="<?php echo $language['Sms Contact No']; ?>"  value="" class="form-control">
					</div>
				</div>

  </div><!-- /.reg-card-body -->
</div><!-- /.reg-card sec-4 -->

<!-- ═══ SECTION 5: Address ═══ -->
<div class="reg-card col-md-12">
  <div class="reg-card-hdr">
    <div class="reg-hdr-icon"><i class="fa fa-map-marker"></i></div>
    <span class="reg-hdr-title">Address</span>
    <span class="reg-hdr-sub">Student residential details</span>
  </div>
  <div class="reg-card-body row">

				<div class="col-md-3 reg-field-anim" style="animation-delay:.05s">
						<div class="form-group">
						  <label><i class="fa fa-home"></i> <?php echo $language['Student Address']; ?></label>
						   <input type="text"  name="student_adress"  id="student_adress"    value="<?php echo $student_adress; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.10s">
						<div class="form-group">
						  <label><i class="fa fa-building"></i> <?php echo $language['Village/City']; ?></label>
						   <input type="text"  name="student_city"  id="student_city"    value="<?php echo $student_city; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.15s">
						<div class="form-group">
						  <label><i class="fa fa-map"></i> <?php echo $language['Block']; ?></label>
						   <input type="text"  name="student_block"  id="student_block"    value="<?php echo $student_block; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.20s">
						<div class="form-group">
						  <label><i class="fa fa-map-o"></i> <?php echo $language['District']; ?></label>
						   <input type="text"  name="student_district"  id="student_district"    value="<?php echo $student_district; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.25s">
						<div class="form-group">
						  <label><i class="fa fa-flag"></i> <?php echo $language['State']; ?></label>
						   <input type="text"  name="student_state"  id="student_state"    value="<?php echo $student_state; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.30s">
						<div class="form-group">
						  <label><i class="fa fa-hashtag"></i> <?php echo $language['Pincode']; ?></label>
						   <input type="text"  name="student_pincode"  id="student_pincode"    value="<?php echo $student_pincode; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.35s">
						<div class="form-group">
						  <label><i class="fa fa-location-arrow"></i> <?php echo $language['Landmark']; ?></label>
						   <input type="text"  name="student_landmark"  id="student_landmark"    value="<?php echo $student_landmark; ?>" class="form-control">
						</div>
				</div>

  </div><!-- /.reg-card-body -->
</div><!-- /.reg-card sec-5 -->

<!-- ═══ SECTION 6: Documents & Photos ═══ -->
<div class="reg-card col-md-12">
  <div class="reg-card-hdr">
    <div class="reg-hdr-icon"><i class="fa fa-camera"></i></div>
    <span class="reg-hdr-title">Documents &amp; Photos</span>
    <span class="reg-hdr-sub">Upload student &amp; parent photos</span>
  </div>
  <div class="reg-card-body row">

				<div class="col-md-3 reg-field-anim" style="animation-delay:.05s">
					<div class="form-group">
					  <label><i class="fa fa-user-circle"></i> <?php echo $language['Student Photo']; ?></label>
					  <div class="reg-photo-zone">
					    <input type="file" name="student_photo" id="student_photo" onchange="check_file_type(this,'student_photo','show_student_photo','image');" class="form-control" accept=".gif,.jpg,.jpeg,.png">
					    <i class="fa fa-cloud-upload" style="font-size:22px;color:#b0bec5;"></i>
					    <span class="reg-photo-zone-label">Click to upload</span>
					  </div>
					</div>
				</div>
				<div class="col-md-1 reg-field-anim" style="animation-delay:.08s">
					<div class="form-group" style="padding-top:22px;">
					   <img id="show_student_photo" src='<?php echo $school_software_path; ?>images/student_blank.png' class="reg-photo-preview">
					</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.12s">
					<div class="form-group">
					  <label><i class="fa fa-male"></i> Father Photo</label>
					  <div class="reg-photo-zone">
					    <input type="file" name="father_photo" id="father_photo" onchange="check_file_type(this,'father_photo','show_father_photo','image');" class="form-control" accept=".gif,.jpg,.jpeg,.png">
					    <i class="fa fa-cloud-upload" style="font-size:22px;color:#b0bec5;"></i>
					    <span class="reg-photo-zone-label">Click to upload</span>
					  </div>
					</div>
				</div>
				<div class="col-md-1 reg-field-anim" style="animation-delay:.15s">
					<div class="form-group" style="padding-top:22px;">
					   <img id="show_father_photo" src='<?php echo $school_software_path; ?>images/student_blank.png' class="reg-photo-preview">
					</div>
				</div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.18s">
					<div class="form-group">
					  <label><i class="fa fa-female"></i> Mother Photo</label>
					  <div class="reg-photo-zone">
					    <input type="file" name="mother_photo" id="mother_photo" onchange="check_file_type(this,'mother_photo','show_mother_photo','image');" class="form-control" accept=".gif,.jpg,.jpeg,.png">
					    <i class="fa fa-cloud-upload" style="font-size:22px;color:#b0bec5;"></i>
					    <span class="reg-photo-zone-label">Click to upload</span>
					  </div>
					</div>
				</div>
				<div class="col-md-1 reg-field-anim" style="animation-delay:.21s">
					<div class="form-group" style="padding-top:22px;">
					   <img id="show_mother_photo" src='<?php echo $school_software_path; ?>images/student_blank.png' class="reg-photo-preview">
					</div>
				</div>

  </div><!-- /.reg-card-body -->
</div><!-- /.reg-card sec-6 -->

<!-- ═══ SECTION 7: Additional Info ═══ -->
<div class="reg-card col-md-12">
  <div class="reg-card-hdr">
    <div class="reg-hdr-icon"><i class="fa fa-sticky-note"></i></div>
    <span class="reg-hdr-title">Additional Info</span>
    <span class="reg-hdr-sub">Remarks &amp; SMS notification</span>
  </div>
  <div class="reg-card-body row">

				<div class="col-md-3 reg-field-anim" style="animation-delay:.05s">
						<div class="form-group">
						  <label><i class="fa fa-comment"></i> <?php echo $language['Remark 1']; ?></label>
						   <input type="text"  name="student_remark_1" placeholder="<?php echo $language['Remark 1']; ?>"  value="" class="form-control">
						</div>
			    </div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.10s">
					<div class="form-group">
					  <label><i class="fa fa-comment"></i> <?php echo $language['Remark 2']; ?></label>
					   <input type="text"  name="student_remark_2" placeholder="<?php echo $language['Remark 2']; ?>"  value="" class="form-control">
					</div>
			    </div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.15s">
						<div class="form-group">
						  <label><i class="fa fa-comment"></i> <?php echo $language['Remark 3']; ?></label>
						   <input type="text"  name="student_remark_3" placeholder="<?php echo $language['Remark 3']; ?>"  value="" class="form-control">
						</div>
			    </div>
				<div class="col-md-3 reg-field-anim" style="animation-delay:.20s">
						<div class="form-group">
						  <label><i class="fa fa-comment"></i> <?php echo $language['Remark 4']; ?></label>
						   <input type="text"  name="student_remark_4" placeholder="<?php echo $language['Remark 4']; ?>"  value="" class="form-control">
						</div>
			    </div>
				<div class="col-md-12 reg-field-anim" style="animation-delay:.25s">
					<div class="col-md-8">
						<label style="font-weight:600;color:#2c3e6b;">
						  <input type="checkbox" name="myCheck" id="myCheck" onclick="myFunction()">&nbsp;&nbsp;
						  <?php echo $language['Check For Message']; ?>
						</label>
						<div class="form-group" id="text" style="display:none;margin-top:8px;">
						  <input type="text" name="sms" placeholder="" id="contact" class="form-control" readonly>
						  <input type="hidden" name="send_sms" placeholder="" id="send_sms" class="form-control">
						</div>
					</div>
				</div>

  </div><!-- /.reg-card-body -->
</div><!-- /.reg-card sec-7 -->

<!-- Submit -->
<div class="reg-submit-row">
  <input type="submit" name="finish" id="submitButtonId" value="<?php echo $language['Submit']; ?>" class="btn" />
</div>

		<?php }else{ ?>
		<div class="col-md-12">
            <div class="reg-limit-msg">
                <i class="fa fa-exclamation-circle" style="font-size:32px;display:block;margin-bottom:10px;"></i>
                Student limit exceeded. No more registrations allowed this session.
            </div>
        </div>
	<?php } ?>

        </form>
      </div><!-- /.reg-wrap -->
    </section>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>