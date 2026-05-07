<?php include("../attachment/session.php"); ?>


<script type="text/javascript">


    function sms_function() {
    var checkBox = document.getElementById("sms_check");
    var text = document.getElementById("text");
    var today_date="<?php echo date('d-m-Y'); ?>";
      var school_name = "<?php echo $_SESSION['school_name_sms'] ?>";
    if (checkBox.checked == true){
        text.style.display = "block";
		$('#sms_content').val("Dear Parent, Your ward student_name is Present today "+today_date+". Regards "+school_name+"[SCHOOL]");
		 $('#send_sms').val('Yes');
    } else {
       text.style.display = "none";
	   $('#sms_content').val('');
	   $('#send_sms').val('No');
    }
}

function set_attendance(value){
    if(value!=''){
var sms_content=document.getElementById('sms_content').value;
var send_sms=document.getElementById('send_sms').value;
$.ajax({
	type:"POST",
	url:access_link+"attendance_management/student_rfid_attendance_api.php?student_info="+value+"&sms_content="+sms_content+"&send_sms="+send_sms+"",
	cache:false,
	success:function(data)
	{
	   var res=data.split("|???|");
	   if(res[1]=='success'){
	       alert_new( res[2]+" Attendance Successfully Updated","green");
	   }else{
	       alert_new("Sorry!!!! Some error occured","red");
	   }
	}
});
}
}


function attendance_detail(){
    $("#attendance_list").html(loader_div_google);
$.ajax({
	type:"POST",
	url:access_link+"attendance_management/student_rfid_attendance_ajax.php",
	cache:false,
	success:function(data)
	{
	$('#attendance_list').html(data);
	}
});
}

</script>
  <section class="content-header">
      <h1>
      Attendance Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i>  Home</a></li>
	 <li><a href="javascript:get_content('attendance_management/attendance_management')"><i class="fa fa-dashboard"></i>  Attendance</a></li>
	  <li class="active"> Student Attendance Fill</li>
      </ol>
    </section>
<div class="col-md-12">
<div class="col-md-5">
	<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Student RFID Attendance</h5>
              </div>
			   <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-12">
                     	<div class="form-group">
                    	<label>Search Student</label>
					  <select name="" id="select_rfid_no" class="form-control select2" onchange="set_attendance(this.value);" style="width:100%;">
					  <option value="">Select student</option>
					        <?php
							
							$qry="select * from  student_admission_info where student_status='Active' and student_rf_id_number!='' and session_value='$session_value'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$school_roll_no=$row22['school_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							$student_rf_id_number=$row22['student_rf_id_number'];
							?>
							<option value="<?php echo $student_roll_no."|?|".$student_name."|?|".$student_class."|?|".$student_section."|?|".$student_rf_id_number."|?|".$student_father_contact_number; ?>"><?php echo $student_name."[".$school_roll_no."]-[".$student_rf_id_number."]-[".$student_class."-".$student_section."]-[".$student_father_name."-".$student_father_contact_number."]"; ?></option>
							<?php
							} 
							?>
					  </select>
					  	</div>
					</div>
					     <div class="col-md-12">
					  	<div class="form-group">
					<label><input type="checkbox" name="sms_check" id="sms_check" checked onclick="sms_function();">&nbsp;&nbsp;&nbsp;Check For Present Student Message</label>
				    <div class="form-group" id="text" style="display:none">
					
					  <textarea type="text" name="sms"  id="sms_content"  class="form-control" readonly></textarea>
					  <input type="hidden" name="send_sms" placeholder="" id="send_sms"  class="form-control">
					 
					</div>
					</div>
					</div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-7">
	<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">RFID Attendance List </h5>
                <button type="button" class="btn btn-success" style="float:right;" onclick="attendance_detail();">Refresh List</button>
              </div>
			   <div class="box-body">
                <div class="col-md-12 table-responsive" id="attendance_list">
                    </div>
                    </div>
                    </div>
                    </div>
             
<script>
  $(function () {
    $('.select2').select2({
    })
  })
sms_function();
</script>