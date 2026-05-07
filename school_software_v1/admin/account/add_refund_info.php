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
    function account_cust(value){
        
        $('#student_name1').val(value);
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
party_select('Student');
});
function party_select(value){
$("#div_other_or_advance").hide();
$("#other_or_advance").val('').change();
if(value=='Student'){
	$("#student_name1").val(''); 
	$("#student_adress1").val('');
	$("#student_father_contact_no1").val('');  
    $("#student_roll_no1").val('');
    $("#designation").val('');
$('#student_select').show();
$('#staff_select').hide();
$('#cust_select').hide();
$('#staff_designation').hide();
$('#student_name1').prop("readonly", true);
$('#student_adress1').prop("readonly", true);
$('#student_father_contact_no1').prop("readonly", true);
$('#staff_select1').prop("required", false);
$('#student_select1').prop("required", true);
}else if(value=='Staff'){
    
    $("#div_other_or_advance").show();
    
	$("#student_name1").val('');
	$("#student_adress1").val('');
	$("#student_father_contact_no1").val('');  
    $("#student_roll_no1").val('');
    $("#designation").val('');
$('#staff_select').show();
$('#staff_designation').show();
$('#student_select').hide();
$('#cust_select').hide();
$('#student_name1').prop("readonly", true);
$('#student_adress1').prop("readonly", true);
$('#student_father_contact_no1').prop("readonly", true);
$('#designation').prop("readonly", true);
$('#staff_select1').prop("required", true);
$('#student_select1').prop("required", false);
}else{
	$("#student_name1").val(''); 
	$("#student_adress1").val('');
	$("#student_father_contact_no1").val('');  
    $("#student_roll_no1").val('');
    $("#designation").val('');
$('#staff_select').hide();
$('#cust_select').show();
$('#student_select').hide();
$('#staff_designation').hide();
$('#student_name1').prop("readonly", false);
$('#student_adress1').prop("readonly", false);
$('#student_father_contact_no1').prop("readonly", false);
$('#staff_select1').prop("required", false);
$('#student_select1').prop("required", false);
}
}

function for_advance(value){
    $("#advance_amount").val('');
    $("#advance_installment").val('');
    if(value=='Advance'){
    $("#div_advance_amount").show();
    $("#div_advance_installment").show();
    }else{
    $("#div_advance_amount").hide();
    $("#div_advance_installment").hide();
    }
}

function same_amount(value,id){
    var prty_type=$("input[name='account_party_type']:checked").val();
    if(prty_type=='Staff'){
    $("#"+id).val(value);
    }
    for_inst();
}

function for_inst(){
    var main=document.getElementById('advance_amount').value;
    var inst=document.getElementById('advance_installment').value;
    if(Number(inst)>Number(main)){
    alert_new("Please Enter Valid Installment Amount !!!",'red');
    $("#advance_installment").val('');
    }
}
</script>
<script>
function payment_mode(value){
if(value=='Cheque'){
$('#for_cheque_date').show();
$('#for_cheque_no').show();
$('#for_cheque_name').show();
$('#for_neft_account_no').hide();
$('#for_neft_bank_name').hide();
}else if(value=='NEFT'){
$('#for_neft_account_no').show();
$('#for_neft_bank_name').show();
$('#for_cheque_date').hide();
$('#for_cheque_no').hide();
$('#for_cheque_name').hide();
}else{
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
            url: access_link+"account/add_refund_info_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
		
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				  // $("#123").html(detail);
				 alert_new('Successfully Complete','green');
				 get_content('account/refund_info_list');
            }else if(res[1]=='session_not_set'){
                alert_new('Session Expire !!!','red');
            }
			}
         });
      });
</script>  
	
    <section class="content-header">
      <h3>
        <?php echo $language['Account Management']; ?>
					<small><?php echo $language['Control Panel']; ?></small>
      </h3>
      <ol class="breadcrumb">
        	   <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('account/account')"><i class="fa fa-inr"></i><?php echo $language['Account']; ?></a></li>
		<li class="active">Refund Info</li>
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
			    <div class="col-md-2" style="display:none;">				
					<div class="form-group">
					  <label><?php echo $language['Amount Type']; ?></label>
					    <select name="account_amount_type" class="form-control" required >
					    <option value="Debit">Debit</option>
					    </select>
					</div>
				</div>
				<div class="col-md-3" style="display:none;">				
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
					    <option value="<?php echo $s_no; ?>"><?php echo $bank_account_holder_name.' ( '.$bank_account_no.' )'; ?></option>
					    <?php } ?>
					    </select>
					</div>
				</div>
                <div class="col-md-2">					
					<div class="form-group">
					  <label><?php echo $language['Party Type']; ?></label><br>
						<div class="form-control">
							<span style="display:none;"><input type="radio" name="account_party_type" id="" value="Other" onclick="party_select(this.value);" >&nbsp;&nbsp;<b>Other</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="account_party_type" id="" onclick="party_select(this.value);" value="Staff">&nbsp;&nbsp;<b>Staff</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><input type="radio" name="account_party_type" id="" onclick="party_select(this.value);" value="Student" checked>&nbsp;&nbsp;<b>Student</b>
					    </div>
					</div>
				</div>
				
				<div class="col-md-2" style="display:none;" id="div_other_or_advance">					
					<div class="form-group">
					  <label>Other Or Advance</label>
					    <select name="other_or_advance" id="other_or_advance" onchange="for_advance(this.value);" class="form-control" >
					    <option value="">Other</option>
					    <option value="Advance">Advance</option>
					    </select>
					</div>
				</div>
				<div class="col-md-2" style="display:none;" id="div_advance_amount">					
					<div class="form-group">
					  <label>Advance Amount</label>
					    <input type="text" name="advance_amount" id="advance_amount" oninput="same_amount(this.value,'account_customer_total_amount');" class="form-control" />
					</div>
				</div>
				<div class="col-md-2" style="display:none;" id="div_advance_installment">					
					<div class="form-group">
					  <label>Advance Installment</label>
					    <input type="text" name="advance_installment" id="advance_installment" oninput="for_inst();" class="form-control" />
					</div>
				</div>
				
				<div class="col-md-4" style="display:none" id="student_select">				
					<div class="form-group">
					  <label><?php echo $language['Student Select']; ?></label>
					    <select name="account_student_select" class="form-control select2" id="student_select1" onchange="student_detail(this.value);" required style="width:100%">
					    <option value="">Select</option>
					        <?php
							$qry="select * from student_admission_info where student_status='Active' and session_value='$session1' ";
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
					    <select name="account_staff_select" class="form-control select2" id="staff_select1" onchange="staff_detail(this.value);" required style="width:100%;">
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
			   <div class="col-md-4"  id="cust_select">
					<div class="form-group">
						  <label><?php echo $language['Name']; ?></label>
						     <select name="account_customer_name1" class="form-control select2" onchange="account_cust(this.value);" style="width:100%;">
						         <option value="">Select</option>
						         <?php 
						         	$que="select * from account_expence_info where account_status='Active'  and session_value='$session1' ORDER BY s_no DESC";
				                    $run=mysqli_query($conn73,$que);
				                    while($row=mysqli_fetch_assoc($run)){
				                    $account_customer_name=$row['account_customer_name'];
				                    ?>
						         <option value="<?php echo $account_customer_name; ?>"><?php echo $account_customer_name; ?></option>
						         <?php } ?>
						     </select>    
					</div>
				</div>
				<div class="col-md-3">
					 <div class="form-group">
						<label><?php echo $language['Name']; ?></label>
						<input type="text"  name="account_customer_name" placeholder="<?php echo $language['Name']; ?>" id="student_name1" value="" class="form-control" readonly >
					 </div>
				</div>
				<div class="col-md-3 ">
						<div class="form-group">
						  <label><?php echo $language['Address']; ?></label>
						   <input type="text"  name="account_customer_address" id="student_adress1" placeholder="<?php echo $language['Address']; ?>"  value="" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-3">		
						<div class="form-group">
						  <label><?php echo $language['Contact No']; ?></label>
						   <input type="number" name="account_customer_contact_no" id="student_father_contact_no1" placeholder="<?php echo $language['Contact No']; ?>"  value="" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-4" style="display:none" id="staff_designation">		
						<div class="form-group">
						  <label><?php echo $language['Designation']; ?></label>
						   <input type="text" name="account_customer_designation" placeholder="<?php echo $language['Designation']; ?>" id="designation" value="" class="form-control" readonly>
						</div>
				</div>
				<div class="col-md-3">		
						<div class="form-group">
						  <label>Refund Amount<font style="color:red"><b>*</b></font></label>
						   <input type="number" name="account_customer_total_amount" id="account_customer_total_amount" oninput="same_amount(this.value,'advance_amount');" placeholder="Refund Amount"  value="" class="form-control" required>
						</div>
				</div>
				<div class="col-md-3">	
				    <div class="form-group" >
				     <label><?php echo $language['Date']; ?><font style="color:red"><b>*</b></font></label>
					 <input type="date"  name="account_customer_date" placeholder="Date"  value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
				    </div>
				</div>
				
                <div class="col-md-2" style="display:none;">				
                <div class="form-group">
                  <label>Bill/Quotation No.</label>
                  <input type="text" name="bill_quotation_no" class="form-control" placeholder="Bill/Quotation No." />
                </div>
                </div>
                <div class="col-md-2" style="display:none;">				
                <div class="form-group">
                  <label>Bill/Quotation Date</label>
                  <input type="date" name="bill_quotation_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
                </div>
                </div>
				
				<div class="col-md-4" style="display:none;">				
					<div class="form-group" >
					  <label><?php echo $language['Payment Mode']; ?></label>
					  <td>
					  <select name="account_payment_mode" class="form-control" onchange="payment_mode(this.value);" required >
					  <option value="Cash">Cash</option>
					  <option value="Cheque">Cheque</option>
					  <option value="NEFT">NEFT/Net Banking</option>
					  </select>
					  </td>
					</div>
					</div>
					<div class="col-md-4" id="for_cheque_name" style="display:none;">				
					<div class="form-group" >
					  <label><?php echo $language['Bank Name']; ?></label>
					  <input type="text" name="account_cheque_bank_name" class="form-control" placeholder="Bank Name" value="">
					</div>
					</div>
					<div class="col-md-4" id="for_cheque_no" style="display:none;">				
					<div class="form-group" >
					  <label>Cheque No</label>
					  <input type="text" name="account_cheque_no" class="form-control" placeholder="Cheque No." value="">
					</div>
					</div>
					<div class="col-md-4" id="for_cheque_date" style="display:none;">				
					<div class="form-group" >
					  <label>Cheque Date</label>
					  <input type="date" name="account_cheque_date" class="form-control" placeholder="Cheque Date" value="<?php echo date('Y-m-d'); ?>">
					</div>
					</div>
					<div class="col-md-4" id="for_neft_bank_name" style="display:none;">				
					<div class="form-group" >
					  <label><?php echo $language['Bank Name']; ?></label>
					  <input type="text" name="account_neft_bank_name" class="form-control" placeholder="Bank Name" value="">
					</div>
					</div>
					<div class="col-md-4" id="for_neft_account_no" style="display:none;">				
					<div class="form-group" >
					  <label><?php echo $language['Account No']; ?></label>
					  <input type="text" name="account_neft_bank_account_no" class="form-control" placeholder="Account No." value="">
					</div>
					</div>
				    <div class="col-md-3">		
						<div class="form-group">
						  <label><?php echo $language['Remark']; ?></label>
						   <input type="text" name="account_customer_remark" placeholder="<?php echo $language['Remark']; ?>"  value="" class="form-control">
						</div>
					</div>
					
				<div class="col-md-3" style="display:none;">	
					<div class="form-group">
			          <label><?php echo $language['Bill Quotation Image Upload']; ?></label>
					  <input type="file" name="bill_upload" id="bill_upload" placeholder="" onchange="check_file_type(this,'bill_upload','show_bill_upload','image');" class="form-control" accept=".gif, .jpg, .jpeg, .png" value="">
					</div>
				</div>
				<div class="col-md-1" style="display:none;">	
					<div class="form-group">
					   <img id="show_bill_upload" src='../<?php echo $school_software_path; ?>images/student_blank.png' width='60px' height='60px'>
					</div>
				</div>
					
					 <div class="col-md-4" style="display:none">
						<div class="form-group">
						  <label>Roll No./Emp Id</label>
						   <input type="text"  name="account_student_or_emp_id" placeholder="Roll No./Emp Id" id="student_roll_no1" value="" class="form-control" readonly >
						</div>
				     </div>
				<div class="col-md-12">
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
 