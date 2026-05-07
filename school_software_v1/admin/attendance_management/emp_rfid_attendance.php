<?php include("../attachment/session.php"); ?>


<script type="text/javascript">


    function sms_function() {
    var checkBox = document.getElementById("sms_check");
    var text = document.getElementById("text");
    var today_date="<?php echo date('d-m-Y'); ?>";
    var today_time="<?php echo date('h:i:sa'); ?>";
      var school_name = "<?php echo $_SESSION['school_info_school_name5'] ?>";
    if (checkBox.checked == true){
        text.style.display = "block";
		$('#sms_content').val("Dear emp_name, Your Attendance Has Successfully Been Updated At Time:"+today_time+" Date:"+today_date+" Thank You. From "+school_name+"[SCHOOL]");
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
	url:access_link+"attendance_management/emp_rfid_attendance_api.php?emp_info="+value+"&sms_content="+sms_content+"&send_sms="+send_sms+"",
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
	url:access_link+"attendance_management/emp_rfid_attendance_ajax.php",
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
	  <li class="active"> Employee Attendance Fill</li>
      </ol>
    </section>
<div class="col-md-12">
<div class="col-md-5">
	<div class="box <?php echo $box_head_color; ?> ">
              <div class="box-header with-border">
                <h5 class="box-title" style="color:teal;">Employee RFID Attendance</h5>
              </div>
			   <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-12">
                     	<div class="form-group">
                    	<label>Search Employee</label>
					  <select name="" id="select_rfid_no" class="form-control select2" onchange="set_attendance(this.value);" style="width:100%;">
					  <option value="">Select emp</option>
					        <?php
							
							$qry="select * from employee_info where emp_status='Active' and emp_rf_id_no!=''";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_id=$row22['emp_id'];
							$emp_name=$row22['emp_name'];
							$emp_department=$row22['emp_categories'];
							$emp_designation=$row22['emp_designation'];
							$emp_mobile_1=$row22['emp_mobile'];
							$emp_rfid=$row22['emp_rf_id_no'];
							?>
							<option value="<?php echo $emp_id."|?|".$emp_name."|?|".$emp_department."|?|".$emp_designation."|?|".$emp_rfid."|?|".$emp_mobile_1; ?>"><?php echo $emp_name."[".$emp_rfid."]-[".$emp_department."-".$emp_designation."]-[".$emp_mobile_1."]"; ?></option>
							<?php
							} 
							?>
					  </select>
					  	</div>
					</div>
					     <div class="col-md-12">
					  	<div class="form-group">
					<label><input type="checkbox" name="sms_check" id="sms_check" checked onclick="sms_function();">&nbsp;&nbsp;&nbsp;Check For Present Employee Message</label>
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