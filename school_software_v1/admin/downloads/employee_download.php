<?php include("../attachment/session.php"); ?>
<script>
		    function form_submit(){

		    $.ajax({
           type: "POST",
            url: access_link+"downloads/employee_data_downloads.php",
           data: $("#my_form").serialize(), 
           success: function(data1)
           {

			$('#get_content').html(data1);
		
           }
         });
      }
</script>
</script>
    <section class="content-header">
      <h1>
        Download Employee  Info
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Downloads</li>
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
              <h3 class="box-title">Employee  Download</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" id= "my_form" enctype="multipart/form-data">
			
			<div class="col-md-12">
			<div class="col-md-1">
			</div>
             <div class="col-md-4">
			 <div class="form-group">
			<th><b style="font-size:15px">Choose Staff:-</b></th><select name="staff" class="form-control" required>
			<option value="All">All</option>
			<option value="Teaching">Teaching Staff</option>
			<option value="Non Teaching">Non Teaching Staff</option>
			</select>
			</div>
			</div>
			
			<div class="col-md-4">
            <label>Employee Name</label>
            <select name="employee_id" class="form-control select2" id="employee_id" style="width:100%;" required>
            <option value="All">All</option>
            <?php
            $qry="select * from employee_info where emp_status='Active'";
            $rest=mysqli_query($conn73,$qry) or die(mysqli_error($conn73));
            while($row22=mysqli_fetch_assoc($rest)){
            $emp_id=$row22['emp_id'];
            $emp_name=$row22['emp_name'];
            $emp_father=$row22['emp_father'];
            $emp_email=$row22['emp_email'];
            $emp_mobile=$row22['emp_mobile'];
            ?>
            <option value="<?php echo $emp_id; ?>"><?php echo $emp_name." [".$emp_id."] - [".$emp_father."] - [".$emp_email."] - [".$emp_mobile."]"; ?></option>
            <?php
            }
            ?>
            </select>
            </div>
			
            <div class="col-md-2">
             <label>Order By</label>
             <select class="form-control" name="order_by" id="order_by">
                <option  value="">Select</option>
            	<option value="emp_name">Employee Name</option>
            	<option value="emp_id">Employee Id</option>
            	<option value="emp_priority">Employee Priority</option>
             </select>
            </div>
			
			<div class="col-md-1">
			</div>
			</div></br></br></br></br></br>

				   <div class="col-md-12">
						<div class="form-group" >
					<input type="checkbox" name="" value="" id="check_all" onclick="for_check(this.id);" checked><th><b style="color:red;">Check All Field/Unchecked All</b></th>
						 </div>
						 </div>
						 
					
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="emp_id|?|emp id" class="check_all"/><th><b>Employee Id</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="emp_rf_id_no|?|emp rf id no" class="check_all"/><th><b>Employee Rf Id No</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_name|?|emp name" class="check_all"/><th><b>Employee Name</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_dob|?|emp DOB" class="check_all"/><th><b>Employee DOB</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="emp_gender|?|emp gender" class="check_all"/><th><b>Employee Gender</b></th>
						</div>
					</div>
					<div class="col-md-2 ">	
					<div class="form-group" >
					  <input type="checkbox" checked name="student_data[]" value="emp_father|?|emp father" class="check_all"/><th><b>Employee Father</b></th>
					</div>
				    </div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_email|?|emp email" class="check_all"/><th><b>Employee Email</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_mobile|?|emp mobile" class="check_all"/><th><b>Employee Mobile</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_address|?|emp address" class="check_all"/><th><b>Employee Address</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_qualification|?|emp qualification" class="check_all"/><th><b>Employee Qualification</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_doj|?|emp doj" class="check_all"/><th><b>Employee Date Of Joning</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="emp_categories|?|emp categories" class="check_all"/><th><b>Employee Categories</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_class_preferred|?|emp class preferred" class="check_all"/><th><b>Employee Class Preferred</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_designation|?|emp designation" class="check_all"/><th><b>Employee Designation</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_pan_card_no|?|emp pan card no" class="check_all"/><th><b>Employee Pan Card No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_bank_name|?|emp bank name" class="check_all"/><th><b>Employee Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_account_no|?|emp account no" class="check_all"/><th><b>Employee Account Number</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_ifsc_code|?|emp ifsc code" class="check_all"/><th><b>Employee Ifsc Code</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_basic_salary|?|emp basic salary" class="check_all"/><th><b>Emp Basic Salary</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_pf_number|?|emp pf number" class="check_all"/><th><b>Employee Pf Number</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_subject_preferred|?|emp subject preferred" class="check_all"/><th><b>Employee Subject Preferred</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_uid_no|?|emp aadhar / uid no"  class="check_all"/><th><b>Employee Aadhar / Uid No</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="blank_field_1|?|emp sssmid no"  class="check_all"/><th><b>Employee SSSMID No</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_basic_salary|?|salary"  class="check_all"/><th><b>Employee Salary</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_other_wages|?|other wages"  class="check_all"/><th><b>Employee Other Wages</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_leave_cl|?|casual leave"  class="check_all"/><th><b>Employee Casual Leave</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_leave_pl|?|pay/earn leave"  class="check_all"/><th><b>Employee Pay/Earn Leave</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_leave_sl|?|sick leave"  class="check_all"/><th><b>Employee Sick Leave</b></th>
						</div>
					</div>
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="emp_leave_other|?|other leave"  class="check_all"/><th><b>Employee Other Leave</b></th>
						</div>
					</div>
				
					
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
<script>
$(function () {
    $('.select2').select2();
  });
</script>
