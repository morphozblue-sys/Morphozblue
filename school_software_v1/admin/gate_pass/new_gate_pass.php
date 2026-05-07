<?php include("../attachment/session.php")?>

<script type="text/javascript">
	function student_detail(value){
	$.ajax({
	address: "POST",
	url: access_link+"gate_pass/ajax_search_student_details.php?id="+value+"",
	cache: false,
	success: function(detail){
	var str =detail;
	var res = str.split("|?|");
	$("#student_name").val(res[0]);
	$("#student_class").val(res[1]);
	$("#student_section").val(res[2]);
	$("#student_admission_number").val(res[3]);
	$("#sms_no").val(res[4]);
	}
	});
	}




 $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);

        $.ajax({
            url: access_link+"gate_pass/new_gate_pass_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
// 		alert(detail);


// console.log(detail);
		// $("#get_content").html(detail);
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				 get_content('gate_pass/gate_pass_list');
            }
			}
         });
      });
      
function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var student_name = document.getElementById("student_name").value;
    var school_name123 = document.getElementById("school_name123").value;
    //var total_amount = document.getElementById("total_paid").value;
     text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
		$('#contact').val("Dear Parents your ward "+student_name+" Gate Pass Approved Successfully. Regards "+school_name123);
// 		$('#contact').val("Dear "+student_name+", Gate Pass has been Approved Successfully. Regards "+school_name123);
		

		 $('#send_sms').val('Yes');
    } else {
       text.style.display = "none";
	   $('#contact').val('');
	   $('#send_sms').val('No');
    }
}      
      
</script>  
	
  <section class="content-header">
      <h1>
           Gate Pass
					<small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('gate_pass/gate_pass')"><i class="fa fa-inr"></i>Gate Pass</a></li>
		<li class="active">New Gate Pass</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
    <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-warning  ">
            <div class="box-header with-border ">
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
    <div class="box-body">
		<form role="form" method="post" enctype="multipart/form-data" id="my_form">
	
				<div class="col-sm-4" >				
					<div class="form-group">
					  <label><?php echo $language['Student Select']; ?></label>
					    <td>
					    <select name="student_roll_no1" class="form-control select2"  onchange="student_detail(this.value);" required >
					    <option value="">Select</option>
					        <?php
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1'$filter37";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$student_roll_no=$row22['student_roll_no'];
							$student_name=$row22['student_name'];
							$student_class=$row22['student_class'];
							$student_section=$row22['student_class_section'];
							$student_father_name=$row22['student_father_name'];
							$student_father_contact_number=$row22['student_father_contact_number'];
							?>
							<option value="<?php echo $student_roll_no; ?>"><?php echo $student_name."[".$student_roll_no."]-"."[".$student_class."-".$student_section."]-[".$student_father_name."]"; ?></option>
							<?php
							}
							?>
					    </select>
					    </td>
					</div>
				</div>
  
				<div class="col-sm-4">
						<div class="form-group">
						  <label><?php echo $language['Name']; ?></label>
						   <input type="text"  name="student_name" placeholder="<?php echo $language['Name']; ?>" id="student_name" value="" class="form-control" readonly >
						
						</div>
				</div>
				<div class="col-sm-4 ">
						<div class="form-group">
						  <label>Class</label>
						   <input type="text"  name="student_class" id="student_class"   value="" class="form-control" readonly>
						</div>
				</div>
				<div class="col-sm-4">		
						<div class="form-group">
						  <label>Section</label>
						   <input type="text" name="student_section" id="student_section"   value="" class="form-control" readonly>
						</div>
				</div>
			    <div class="col-sm-4">		
						<div class="form-group">
						  <label>Admission NO</label>
						   <input type="text" name="student_admission_number" id="student_admission_number"   value="" class="form-control" readonly>
						</div>
				</div>
				
				
				<div class="col-sm-4 ">	
				    <div class="form-group" >
				     <label><?php echo $language['Date']; ?><font style="color:red"><b>*</b></font></label>
					 <input type="date"  name="gate_pass_date"   value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
				    </div>
				</div>
				<div class="col-sm-4 ">	
				    <div class="form-group" >
				     <label><?php echo $language['Time']; ?><font style="color:red"><b>*</b></font></label>
					 <input type="text"  name="gate_pass_time"   value="<?php echo date("h:i:sa"); ?>" class="form-control" required>
				    </div>
				</div>
					<div class="col-sm-8">		
						<div class="form-group">
						  <label>Reason For Leaving</label>
						   <input type="text" name="reason_for_leaving" value="" class="form-control" >
						</div>
				</div>
			       <div class="col-sm-4">				
					<div class="form-group" >
					  <label>Recommender</label>
					  <td>
					    <select name="recommender" class="form-control select2"  required >
					    <option value="">Select</option>
					    <?php
							$qry="select * from employee_info where emp_status='Active'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_name=$row22['emp_name'];
							$emp_id=$row22['emp_id'];
							$emp_designation=$row22['emp_designation'];
							?>
							<option value="<?php echo $emp_name."(".$emp_id.")"; ?>"><?php echo $emp_name."[".$emp_id."]-"."[".$emp_designation."]"; ?></option>
							<?php
							}
							?>
					    </select>
					  </td>
					</div>
				</div>
				
				
			
					    <?php
							$qry123="select school_info_school_name from school_info_general";
							$rest123=mysqli_query($conn73,$qry123);
							while($row123=mysqli_fetch_assoc($rest123)){
							$school_info_school_name=$row123['school_info_school_name'];
							}
							?>
							
					   <div>
					       <input type="hidden" id="school_name123" name="school_name" value="<?php echo $school_info_school_name; ?>" readonly>
					   <div>
				
				
				
				
				       <div class="col-sm-4">				
					<div class="form-group" >
					  <label>Approver</label>
					  <td>
					    <select name="approver" class="form-control select2"   >
					    <option value="">Select</option>
					    <?php
							$qry="select * from employee_info where emp_status='Active'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_name=$row22['emp_name'];
							$emp_id=$row22['emp_id'];
							$emp_designation=$row22['emp_designation'];
							?>
							<option value="<?php echo $emp_name."(".$emp_id.")"; ?>"><?php echo $emp_name."[".$emp_id."]-"."[".$emp_designation."]"; ?></option>
							<?php
							}
							?>
					    </select>
					  </td>
					</div>
				</div>	
				
                <div class="col-md-12">
                		
                <div class="col-md-4">		
                <div class="form-group">
                  <label>Received By</label>
                   <input type="text" name="received_by" value="" class="form-control" />
                </div>
                </div>
                
                <div class="col-md-4">		
                <div class="form-group">
                  <label>Contact No.</label>
                   <input type="text" name="contact_no" value="" class="form-control" />
                </div>
                </div>
                
                <div class="col-md-4">		
                <div class="form-group">
                  <label>Relation</label>
                   <input type="text" name="relation" value="" class="form-control" />
                </div>
                </div>
                
                </div>
				
				<div class="col-md-12 ">
				<div class="col-md-8 ">	
				<label><input type="checkbox" name="myCheck" id="myCheck"  onclick="myFunction()">&nbsp;&nbsp;&nbsp;<?php echo $language['Check For Message']; ?></label>
				<div class="form-group" id="text" style="display:none">
				<input type="text" name="sms" placeholder="" id="contact"  class="form-control">
				  <label>Contact Number</label>
				<input type="text" name="student_sms_contact_number" id="sms_no"  value=""  class="form-control">
			    <input type="hidden" name="send_sms" placeholder="" id="send_sms"  class="form-control">	 
			    </div>
				</div>
				</div>
							
				<div class="col-sm-12">
		        <center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-primary" /></center>
		        </div>
	</div>
		</form>	
	
    </div>
    </div>
</section>
	<script>
  $(function () {
    $('.select2').select2()
  })
</script>	
 