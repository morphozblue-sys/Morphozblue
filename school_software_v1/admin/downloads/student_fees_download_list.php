<?php include("../attachment/session.php"); ?>
<script>
function form_submit(){

		    $.ajax({
           type: "POST",
            url: access_link+"downloads/student_fees_list_download.php",
           data: $("#my_form").serialize(), 
           success: function(data1)
           {
			$('#get_content').html(data1);
			//alert_new(data1);
			}
         });
      }
      
       function for_section(value){
 $('#student_class_section').html("<option value=''>Loading....</option>");
       $.ajax({
			  type: "POST",
              url: access_link+"downloads/ajax_class_section.php?class_name="+value+"",
              cache: false,
              success: function(detail){
                 $("#student_class_section").html("<option value='All'>All</option>"+detail);
              }
           });
    }
</script>
    <section class="content-header">
      <h1>
        Download Student Fees
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
    <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('downloads/downloads')"><i class="fa fa-phone-square"></i>Download panel</a></li>
        <li class="active"><i class="fa fa-user-plus"></i> <?php echo $language['Enquiry Add']; ?></li>
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
              <h2 class="box-title"><b>Student Fees Download</b></h2>
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
            <div class="box-body "  >
			<form role="form" method="post" id="my_form" enctype="multipart/form-data">
			<div class="col-md-12">
			<div class="col-md-3">				
			<div class="form-group">
			<th><b style="font-size:15px">From Date</b></th><input type="date" name="date_from" class="form-control" >
			</div>
			</div>
			<div class="col-md-3">				
			<div class="form-group">
			<th><b style="font-size:15px">To Date</b></th><input type="date"  name="date_to" class="form-control" >
			</div>
			</div>
            <div class="col-md-2">				
            <div class="form-group" >
            <th><b   style="font-size:15px">Choose Class</b></th>
            <select name="std_class" class="form-control new_student" id="" onchange="for_section(this.value);" >
            <option value="All">All</option>
            <?php 
            $sql= "select * From school_info_class_info";
            $result=mysqli_query($conn73,$sql);
            while($row=mysqli_fetch_assoc($result)){
            $class_name=$row['class_name'];
            ?>
            <option value="<?php echo $class_name; ?>"><?php echo $class_name; ?></option>
            <?php } ?>
            </select>
            </div>
            </div>
            <div class="col-md-1">
                <div class="form-group" >
                    <th><b style="font-size:15px">Section</b></th>
                    <select class="form-control" name="student_class_section" id="student_class_section">
                    <option value="All">All</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-3">
             <label>Order By</label>
             <select class="form-control" name="order_by" id="order_by">
                <option  value="">Select</option>
            	<option value="student_name">Student Name</option>
            	<option value="student_father_name">Father Name</option>
            	<option value="school_roll_no">School Roll No</option>
            	<option value="student_admission_number">Admission No</option>
            	<option value="student_scholar_number">Scholar No</option>
            	<option value="student_registration_number">Registration No</option>
            	<option value="student_enrollment_number">Enrollment No</option>
             </select>
            </div>
            
			</div></br></br></br>
			<hr>
					 <div class="col-md-12">
						<div class="form-group" >
					<input type="checkbox" name="" value="" id="check_all" onclick="for_check(this.id);" checked><th><b style="color:red;">Check All Field/Unchecked All</b></th>
						 </div>
						 </div>
					
				<div class="col-md-12">	
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="fee_status|?|fee status" class="check_all"><th><b>Fee Status</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="student_name|?|student name" class="check_all"><th><b>Student Name</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_name|?|student father name" class="check_all"><th><b>Student Father Name</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_class|?|student class" class="check_all"><th><b>Student Class</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_class_section|?|student class section" class="check_all"><th><b>Student Class Section</b></th>
						</div>
					</div>
					<div class="col-md-2 ">	
					<div class="form-group" >
					  <input type="checkbox" checked name="student_data[]" value="student_roll_no|?|student roll no" class="check_all"><th><b>Student Roll No</b></th>
					</div>
				    </div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="fee_submission_date|?|fee submission date" class="check_all"><th><b>Fee Submission Date</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="grand_total|?|grand total" class="check_all"><th><b>Grand Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="balance_total|?|balance total" class="check_all"><th><b>Balance Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="paid_total|?|paid total" class="check_all"><th><b>Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_payment_mode|?|student payment mode" class="check_all"><th><b>Student Payment Mode</b></th>
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
					<div class="col-md-2">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="neft_bank_account_no|?|neft bank account no" class="check_all"><th><b>Neft Bank Account No</b></th>
						</div>
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
