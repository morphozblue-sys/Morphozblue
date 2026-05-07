<?php include("../attachment/session.php"); ?>
<script>
		    function form_submit(){

		    $.ajax({
           type: "POST",
            url: access_link+"downloads/salary_download_list.php",
           data: $("#my_form").serialize(), 
           success: function(data1)
           {

			$('#get_content').html(data1);
		
           }
         });
      }
      function report_method(value){
          $(".generate_date").hide();
          $(".monthwise").hide();
          if(value=="generate_date"){
              $(".generate_date").show();
          } if(value=="monthwise"){
              $(".monthwise").show();
          }
      }
</script>
    <section class="content-header">
      <h1>
        Download Employee Salary
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Download</li>
      </ol>
    </section><!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
            <div class="box-header with-border ">
              <h3 class="box-title">Employee Salary Info download</h3>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post"id="my_form" enctype="multipart/form-data">
			
				 <div class="col-md-12">
				   <div class="col-md-2">
                 <label>Report Type</label>
                 <select class="form-control" name="report_type" id="" onchange="report_method(this.value)">
                    <option  value="monthwise">Salary Month</option>
                	<option value="generate_date">Salary Generate Date</option>
                
                 </select>
                </div>
				 <div class="col-md-2 generate_date" style="display:none">
				<th><b style="font-size:15px">Generate Date From:-</b></th><input type="date" name="date_from" id="date_from" class="form-control" >
				</div>
				<div class="col-md-2 generate_date"  style="display:none">
				<th><b style="font-size:15px">Generate Date To:-</b></th><input type="date" name="date_to" id="date_to" class="form-control" >
				</div>
				   <div class="col-md-2 monthwise">
                 <label>Salary Month</label>
                 <select class="form-control" name="particular_month" id="particular_month">
                    <option value="All">All</option>
                	<option value="04">April</option>
                	<option value="05">May</option>
                	<option value="06">June</option>
                	<option value="07">July</option>
                	<option value="08">August</option>
                	<option value="09">September</option>
                	<option value="10">October</option>
                	<option value="11">November</option>
                	<option value="12">December</option>
                	<option value="01">January</option>
                	<option value="02">February</option>
                	<option value="03">March</option>
                 </select>
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
                	<option value="employee_name">Employee Name</option>
                	<option value="emp_id">Employee Id</option>
                 </select>
                </div>
				
				<?php 
				if(isset($_GET['error']))
				{
					$error=$_GET['error'];
					?>
					<div class="col-md-6">
				<th><b style="font-size:15px;color:red;"><?php echo $error ?></b></th>
				</div>
				<?php }	?>
				
				 </div></br></br></br></br>
				 <div class="col-md-12">
						<div class="form-group" >
					<input type="checkbox" name="" value="" id="check_all" onclick="for_check(this.id);" checked><th><b style="color:red;">Check All Field/Unchecked All</b></th>
						 </div>
						 </div>
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="emp_id|?|emp id" class="check_all"><th><b>Employee Id</b></th>
				  </div>
				  </div>
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="employee_name|?|employee name" class="check_all"><th><b>Employee Name</b></th>
					 </div>
				  </div>
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="emp_account_no|?|employee a/c no" class="check_all"><th><b>Employee A/C No.</b></th>
					 </div>
				  </div>
				   <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="emp_ifsc_code|?|emp ifsc code" class="check_all"><th><b>Employee ifsc code.</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="employee_salary_date_from|?|employee salary date from" class="check_all"><th><b>Employee Salary Date From</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="employee_salary_date_to|?|employee salary date to" class="check_all"><th><b>Employee Salary Date To</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="employee_total_working_day|?|employee total working day" class="check_all"><th><b>Employee Total Working Day</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="employee_salary_generate_date|?|employee salary generate date" class="check_all"><th><b>Employee Salary Generate Date</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="employee_total_pay|?|Employee Total Pay" class="check_all"><th><b>Employee Total Pay</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="employee_pf_no|?|employee pf no" class="check_all"><th><b>Employee Pf No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="employee_pf_amount|?|employee pf amount" class="check_all"><th><b>Employee Pf Amount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked  name="student_data[]" value="final_salary|?|employee total pay after pf" class="check_all"><th><b>Employee Total Pay After Pf</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="total_present|?|total present" class="check_all"><th><b>Total Present</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="total_absent|?|total absent" class="check_all"><th><b>Total Absent</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="total_leave|?|total leave" class="check_all"><th><b>Total Leave</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="cheque_bank_name|?|cheque bank name" class="check_all"><th><b>Cheque Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="cheque_no|?|cheque no" class="check_all"><th><b>Cheque No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="cheque_date|?|cheque date" class="check_all"><th><b>Cheque Date</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="neft_bank_name|?|neft bank name" class="check_all"><th><b>Neft Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="neft_bank_account_no|?|neft bank account no" class="check_all"><th><b>Neft Bank Account No</b></th>
						</div>
					</div>
					
				
					
		<div class="col-md-12">
		   <center><input type="button" name="submit" value="Submit" class="btn btn-primary" onclick="return for_validity();"/></center>
		   </div>
		   </form>	
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
  

 <?php include("../attachment/link_js.php")?>
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
alert('Please Select Atleast One Field !!!');
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

