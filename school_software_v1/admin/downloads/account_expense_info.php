<?php include("../attachment/session.php"); ?>
<script>
		    function form_submit(){

		    $.ajax({
           type: "POST",
            url: access_link+"downloads/account_expense_download.php",
           data: $("#my_form").serialize(), 
           success: function(data1)
           {

			$('#get_content').html(data1);
	
           }
         });
      }
</script>
    <section class="content-header">
      <h1>
        Download Account expense Info
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i>Download</li>
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
              <h2 class="box-title">Account Expense  
			  Download Info</h2>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
			<div class="col-md-12">
			<div class="col-md-2">
			</div>
			<div class="col-md-3">
			<th><b style="font-size:15px">Date From:-</b></th><input type="date" name="date_from" id="date_from" class="form-control" />
			</div>
			<div class="col-md-3">
			<th><b style="font-size:15px">Date To:-</b></th><input type="date" name="date_to" id="date_to" class="form-control" />
			</div>
			
			<div class="col-md-2">
             <label>Order By</label>
             <select class="form-control" name="order_by" id="order_by">
                <option  value="">Select</option>
            	<option value="account_customer_name">Account Name</option>
            	<option value="account_customer_date">Account Date</option>
             </select>
            </div>
			
			<div class="col-md-2">
			</div>
				 </div></br></br></br></br></br>
				 <div class="col-md-12">
						<div class="form-group" >
					<input type="checkbox" name="" value="" id="check_all" onclick="for_check(this.id);" checked><th><b style="color:red;">Check All Field/Unchecked All</b></th>
						 </div>
						 </div>
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="account_customer_name|?|account customer name" class="check_all"><th><b>Account Customer Name</b></th>
				  </div>
				  </div>
				 
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="account_customer_address|?|account customer address" class="check_all"><th><b>Account Customer Address</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_customer_contact_no|?|account customer contact no" class="check_all"><th><b>Account Customer Contact No</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="account_customer_designation|?|account customer designation" class="check_all"><th><b>Account Customer Designation</b></th>
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="account_customer_total_amount|?|account customer total amount" class="check_all"><th><b>Account Customer Total Amount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">	
					<div class="form-group" >
					  <input type="checkbox" checked name="student_data[]" value="account_customer_remark|?|account customer remark" class="check_all"><th><b>Account Customer Remark</b></th>
					</div>
				    </div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_customer_date|?|account  customer date" class="check_all"><th><b>Account Customer Date</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_student_or_emp_id|?|account student or emp id" class="check_all"><th><b>Account Student Or Employee Id</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_amount_type|?|account amount type" class="check_all"><th><b>Account Amount Type</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_party_type|?|account party type" class="check_all"><th><b>Account Party Type</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_payment_mode|?|account payment mode" class="check_all"><th><b>Account Payment Mode</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_cheque_bank_name|?|account cheque bank name" class="check_all"><th><b>Account Cheque Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_cheque_no|?|account cheque no" class="check_all"><th><b>Account Cheque No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_cheque_date|?|account cheque date" class="check_all"><th><b>Account Cheque Date</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_neft_bank_name|?|account neft bank name" class="check_all"><th><b>Account Neft Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="account_neft_bank_account_no|?|account neft bank account no" class="check_all"><th><b>Account Neft Bank Account No</b></th>
						</div>
					</div>
					
		<div class="col-md-12">
		   <center><input type="button" name="submit" value="Submit" class="btn btn-primary"  onclick="return for_validity();"/></center>
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


