<?php include("../attachment/session.php")?>
<script type="text/javascript">
	function student_detail(value){
	$("#student_name1").val("Loading....");
	$("#student_adress1").val("Loading....");
	$("#student_father_contact_no1").val("Loading....");
	$("#student_roll_no1").val("Loading....");
	$.ajax({
	address: "POST",
	url: access_link+"account/ajax_search_student_details.php?id="+value+"",
	cache: false,
	success: function(detail){
	var str =detail;
	var res = str.split("|?|");
	$("#student_name1").val(res[0]); 
	$("#student_adress1").val(res[1]); 
	$("#student_father_contact_no1").val(res[2]);  
	$("#student_roll_no1").val(res[3]);  
	}
	});
	}
</script> 
<script type="text/javascript">
	function staff_detail(value){
	$("#student_name1").val("Loading...."); 
	$("#student_adress1").val("Loading...."); 
	$("#student_father_contact_no1").val("Loading....");  
    $("#student_roll_no1").val("Loading....");
    $("#designation").val("Loading....");
	$.ajax({
	address: "POST",
	url: access_link+"account/ajax_search_staff_details.php?id="+value+"",
	cache: false,
	success: function(detail){
	var str =detail;
	var res = str.split("|?|");
	$("#student_name1").val(res[0]); 
	$("#student_adress1").val(res[1]); 
	$("#student_father_contact_no1").val(res[2]);  
    $("#student_roll_no1").val(res[3]);
    $("#designation").val(res[4]);	
	}
	});
	}
</script> 

<script>
$( document ).ready(function() { 
party_select('Other');
});
function party_select(value){
if(value=='Student'){
$('#student_select').show();
$('#staff_select').hide();
$('#staff_designation').hide();
$('#student_name1').prop("readonly", true);
$('#student_adress1').prop("readonly", true);
$('#student_father_contact_no1').prop("readonly", true);
$('#staff_select1').prop("required", false);
$('#student_select1').prop("required", true);
}else if(value=='Staff'){
$('#staff_select').show();
$('#staff_designation').show();
$('#student_select').hide();
$('#student_name1').prop("readonly", true);
$('#student_adress1').prop("readonly", true);
$('#student_father_contact_no1').prop("readonly", true);
$('#designation').prop("readonly", true);
$('#staff_select1').prop("required", true);
$('#student_select1').prop("required", false);
}else{
$('#staff_select').hide();
$('#student_select').hide();
$('#staff_designation').hide();
$('#student_name1').prop("readonly", false);
$('#student_adress1').prop("readonly", false);
$('#student_father_contact_no1').prop("readonly", false);
$('#staff_select1').prop("required", false);
$('#student_select1').prop("required", false);
}
}
</script>
<script>
function payment_mode(value){
if(value=='Cheque'){
$('#for_transaction_no').hide();    
$('#for_cheque_date').show();
$('#for_cheque_no').show();
$('#for_cheque_name').show();
$('#for_neft_account_no').hide();
$('#for_neft_bank_name').hide();
}else if(value=='NEFT'){
$('#for_transaction_no').hide();    
$('#for_neft_account_no').show();
$('#for_neft_bank_name').show();
$('#for_cheque_date').hide();
$('#for_cheque_no').hide();
$('#for_cheque_name').hide();
}else if( value=='Phonepay'  || value=='Googlepay')
{
 $('#for_transaction_no').show();   
 $('#for_cheque_date').hide();
$('#for_cheque_no').hide();
$('#for_cheque_name').hide();
$('#for_neft_account_no').hide();
$('#for_neft_bank_name').hide();
}else{
$('#for_transaction_no').hide();    
$('#for_cheque_date').hide();
$('#for_cheque_no').hide();
$('#for_cheque_name').hide();
$('#for_neft_account_no').hide();
$('#for_neft_bank_name').hide();
}
}
	      $("#my_form").submit(function(e){
        e.preventDefault();

    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"account/income_or_expence_edit_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
			
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('account/income_or_expence_list');
            }else if(res[1]=='session_not_set'){
                alert_new('Session Expire !!!','red');
            }
			}
         });
      });
</script> 

<?php 
$s_no1=$_GET['id'];
$que="select * from account_expence_info where s_no='$s_no1'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    $account_customer_name = $row['account_customer_name'];
	$account_customer_address = $row['account_customer_address'];
	$account_customer_contact_no = $row['account_customer_contact_no'];
	$account_customer_designation = $row['account_customer_designation'];
	$account_customer_total_amount = $row['account_customer_total_amount'];
	$account_customer_date = $row['account_customer_date'];
	$account_customer_remark = $row['account_customer_remark'];	
	$account_student_or_emp_id = $row['account_student_or_emp_id'];
	$account_amount_type = $row['account_amount_type'];
	$account_party_type = $row['account_party_type'];
	$account_payment_mode = $row['account_payment_mode'];
	$account_cheque_bank_name = $row['account_cheque_bank_name'];
	$account_cheque_no = $row['account_cheque_no'];
	$account_cheque_date = $row['account_cheque_date'];
	$account_neft_bank_name = $row['account_neft_bank_name'];
	$account_neft_bank_account_no = $row['account_neft_bank_account_no'];
	$office_account_sno = $row['office_account_sno'];
	
	$blank_field_1 = $row['blank_field_1'];
	$blank_field_2 = $row['blank_field_2'];
	
	$transaction_no = $row['transaction_no'];
	
	
	$bill_upload=$row['bill_upload_name'];
   }

	// }

?> 



    <section class="content-header">
      <h3>
        <?php echo $language['Account Management']; ?>
					<small><?php echo $language['Control Panel']; ?></small>
      </h3>
      <ol class="breadcrumb">
        	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i><?php echo $language['Account']; ?></a></li>
		<li><a href="javascript:get_content('account/income_or_expence_list')"><i class="fa fa-list"></i><?php echo $language['List']; ?></a></li>
		<li><i class="Active"></i><?php echo $language['Add Info']; ?></li>
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
		  <input type="hidden"  name="s_no1"  value="<?php echo $s_no1; ?>" >
			    <div class="col-md-2">				
					<div class="form-group">
					  <label><?php echo $language['Amount Type']; ?></label>
					    <select name="account_amount_type" class="form-control" >
					    <option value="<?php echo $account_amount_type; ?>"><?php echo $account_amount_type; ?></option>
					    <option value="">Select</option>
					    <option value="Debit">Debit</option>
					    <option value="Credit">Credit</option>
					    </select>
					</div>
				</div>
				
				<div class="col-md-3">				
					<div class="form-group">
					  <label>Office Account</label>
					    <select name="office_account_info" class="form-control" >
					    <option value="">Select</option>
					    <?php
                        $que="select * from account_office_bank_account";
                        $run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
                        while($row=mysqli_fetch_assoc($run)){
                        $s_no=$row['s_no'];
                        $bank_account_holder_name =$row['bank_account_holder_name'];
                        $bank_account_no=$row['bank_account_no'];
					    ?>
					    <option <?php if($office_account_sno==$s_no){ echo 'selected'; } ?> value="<?php echo $s_no; ?>"><?php echo $bank_account_holder_name.' ( '.$bank_account_no.' )'; ?></option>
					    <?php } ?>
					    </select>
					</div>
				</div>
				
                <div class="col-md-3">					
					<div class="form-group">
					  <label><?php echo $language['Party Type']; ?></label><br>
						<div class="form-control">
							<input type="radio" name="account_party_type" id="" value="Other" onclick="party_select(this.value);" <?php if($account_party_type=='Other') { ?> checked <?php } ?> >&nbsp;&nbsp;<b>Other</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="account_party_type" id="" onclick="party_select(this.value);" value="Staff" <?php if($account_party_type=='Staff') { ?> checked <?php } ?>>&nbsp;&nbsp;<b>Staff</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="account_party_type" id="" onclick="party_select(this.value);" value="Student" <?php if($account_party_type=='Student') { ?> checked <?php } ?>>&nbsp;&nbsp;<b>Student</b>
					    </div>
					</div>
				</div>
				<div class="col-md-4" style="display:none" id="student_select">				
					<div class="form-group">
					  <label><?php echo $language['Student Select']; ?></label>
					    <select name="account_student_select" class="form-control select2" id="student_select1" onchange="student_detail(this.value);" style="width:100%" required >
					    <option value="">Select</option>
					        <?php
							$qry="select * from student_admission_info where student_status='Active'  and session_value='$session1' ";
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
					</div>
				</div>
                <div class="col-md-4" style="display:none" id="staff_select">				
					<div class="form-group" >
					  <label><?php echo $language['Staff Select']; ?></label>
					    <select name="account_staff_select" class="form-control select2" id="staff_select1" onchange="staff_detail(this.value);" style="width:100%;" required>
					    <option value="">Select</option>
					    <?php
							$qry="select * from employee_info where emp_status='Active'";
							$rest=mysqli_query($conn73,$qry);
							while($row22=mysqli_fetch_assoc($rest)){
							$emp_name=$row22['emp_name'];
							$emp_father=$row22['emp_father'];
							$emp_id=$row22['emp_id'];
							$emp_address=$row22['emp_address'];
							$emp_mobile=$row22['emp_mobile'];
							$emp_designation=$row22['emp_designation'];
							?>
							<option value="<?php echo $emp_id; ?>"><?php echo $emp_name."[".$emp_id."]-"."[".$emp_designation."]"; ?></option>
							<?php
							}
							?>
					    </select>
					</div>
				</div>
			   
				<div class="col-md-4">
						<div class="form-group">
						  <label><?php echo $language['Name']; ?></label>
						   <input type="text"  name="account_customer_name" placeholder="Name" id="student_name1" value="<?php echo $account_customer_name; ?>" class="form-control" readonly >
						</div>
				</div>
				<div class="col-md-4 ">
						<div class="form-group">
						  <label><?php echo $language['Address']; ?></label>
						   <input type="text"  name="account_customer_address" id="student_adress1" placeholder="Address"  value="<?php echo $account_customer_address; ?>" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-4">		
						<div class="form-group">
						  <label><?php echo $language['Contact No']; ?></label>
						   <input type="number" name="account_customer_contact_no" id="student_father_contact_no1" placeholder="Contact No."  value="<?php echo $account_customer_contact_no; ?>" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-4" style="display:none" id="staff_designation">		
						<div class="form-group">
						  <label><?php echo $language['Designation']; ?></label>
						   <input type="text" name="account_customer_designation" placeholder="Designation" id="designation" value="<?php echo $account_customer_designation; ?>" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-4 ">		
						<div class="form-group">
						  <label><?php echo $language['Total Amount']; ?></label>
						   <input type="number" name="account_customer_total_amount" placeholder="Total Amount"  value="<?php echo $account_customer_total_amount; ?>" class="form-control">
						</div>
				</div>
				<div class="col-md-4 ">	
				    <div class="form-group" >
				     <label><?php echo $language['Date']; ?></label>
					 <input type="date"  name="account_customer_date" placeholder="Date"  value="<?php echo $account_customer_date; ?>" class="form-control">
				    </div>
				</div>
				
				<div class="col-md-2">				
                <div class="form-group">
                  <label>Bill/Quotation No.</label>
                  <input type="text" name="bill_quotation_no" class="form-control" placeholder="Bill/Quotation No." value="<?php echo $blank_field_1; ?>" />
                </div>
                </div>
                <div class="col-md-2">				
                <div class="form-group">
                  <label>Bill/Quotation Date</label>
                  <input type="date" name="bill_quotation_date" class="form-control" value="<?php echo $blank_field_2; ?>" />
                </div>
                </div>
				
				<div class="col-md-4">				
					<div class="form-group" >
					  <label><?php echo $language['Payment Mode']; ?></label>
					  <td>
					  <select name="account_payment_mode" class="form-control" onchange="payment_mode(this.value);" required >
					  <option value="<?php echo $account_payment_mode; ?>"><?php echo $account_payment_mode; ?></option>
					  <option value="">Select</option>
					  <option value="Cash">Cash</option>
					  <option value="Cheque">Cheque</option>
					  <option value="NEFT">NEFT/Net Banking</option>
					  <option value="Phonepay">Phonepay</option>
			          <option value="Googlepay">Googlepay</option>
					  </select>
					  </td>
					</div>
			    </div>
				
                    <?php if($account_payment_mode=='Cheque') { ?>
                    <div class="col-md-4">
                    <?php } else { ?>					
					<div class="col-md-4" id="for_cheque_name" style="display:none;">
                    <?php } ?>					
					<div class="form-group" >
					  <label><?php echo $language['Bank Name']; ?></label>
					  <input type="text" name="account_cheque_bank_name" class="form-control" placeholder="Bank Name" value="<?php echo $account_cheque_bank_name; ?>">
					</div>
					</div>
					
					<?php if($account_payment_mode=='Cheque') { ?>
                    <div class="col-md-4">		
                    <?php } else { ?>					
					<div class="col-md-4" id="for_cheque_no" style="display:none;">		
                    <?php } ?>							
					<div class="form-group" >
					  <label>Cheque No.</label>
					  <input type="text" name="account_cheque_no" class="form-control" placeholder="Cheque No." value="<?php echo $account_cheque_no; ?>">
					</div>
					</div>
					<?php if($account_payment_mode=='Cheque') { ?>
                    <div class="col-md-4">		
                    <?php } else { ?>					
					<div class="col-md-4" id="for_cheque_date" style="display:none;">		
                    <?php } ?>										
					<div class="form-group" >
					  <label>Cheque Date:</label>
					  <input type="date" name="account_cheque_date" class="form-control" placeholder="Cheque Date" value="<?php echo $account_cheque_date; ?>">
					</div>
					</div>
					<?php if($account_payment_mode=='NEFT') { ?>
                    <div class="col-md-4">	
                    <?php } else { ?>					
					<div class="col-md-4" id="for_neft_bank_name" style="display:none;">	
                    <?php } ?>												
					<div class="form-group" >
					  <label>Bank Name</label>
					  <input type="text" name="account_neft_bank_name" class="form-control" placeholder="Bank Name" value="<?php echo $account_neft_bank_name; ?>">
					</div>
					</div>
					<?php if($account_payment_mode=='NEFT') { ?>
                    <div class="col-md-4">		
                    <?php } else { ?>					
					<div class="col-md-4" id="for_neft_account_no" style="display:none;">		
                    <?php } ?>								
					<div class="form-group" >
					  <label>Account No.</label>
					  <input type="text" name="account_neft_bank_account_no" class="form-control" placeholder="Account No." value="<?php echo $account_neft_bank_account_no; ?>">
					</div>
					</div>
					<?php if($account_payment_mode=='Phonepay' || $account_payment_mode=='Googlepay' ) { ?>
                    <div class="col-md-4" id="for_transaction_no" >		
                    <?php } else { ?>
					<div class="col-md-2" id="for_transaction_no" style="display:none;">
					<?php } ?>    
				    <div class="form-group">
                    <label>Transaction Id/No</label>
                    <input type="text" name="transaction_no" placeholder="Transaction Id/No"  value="<?php echo $transaction_no; ?>" class="form-control">
                    </div>
                    </div>
				    <div class="col-md-4">		
						<div class="form-group">
						  <label>Remark</label>
						   <input type="text" name="account_customer_remark" placeholder="Remark"  value="<?php echo $account_customer_remark; ?>" class="form-control">
						</div>
					</div>
					
				<div class="col-md-3 ">	
					<div class="form-group" > 
						  <label><?php echo $language['Bill Quotation Image Upload']; ?></label>
					  <input type="file"  id="bill_upload" name="bill_upload" placeholder="" onchange="check_file_type(this,'bill_upload','shwo_bill_upload','image');" value="" class="form-control" accept=".gif, .jpg, .jpeg, .png">
					</div>
				</div>
				<div class="col-md-1">	
					<div class="form-group">
					  <img onclick="open_file1('bill_upload','account_document','account_id','<?php echo $s_no1; ?>');" src="<?php if($bill_upload!=''){ echo $_SESSION['amazon_file_path']."account_document/".$bill_upload; }else{ echo "../".$school_software_path."images/student_blank.png"; }  ?>" id="shwo_bill_upload" height="50" width="50" style="margin-top:10px;">
					</div>
				</div>
					
					 <div class="col-md-4" style="display:none">
						<div class="form-group">
						  <label>Roll No./Emp Id</label>
						   <input type="text"  name="account_student_or_emp_id" placeholder="Roll No./Emp Id" id="student_roll_no1" value="<?php echo $account_student_or_emp_id; ?>" class="form-control" readonly >
						</div>
				     </div>
				<div class="col-md-12">
		        <center><input type="submit" name="submit" value="<?php echo $language['Submit']; ?>" class="btn btn-primary" /></center>
		        </div>
	</div>

    </div>
    </div>
</section>
<div id="mypdf_view">
			<div>
	<script>
  $(function () {
    $('.select2').select2()
  })
</script>	
  