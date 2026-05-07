<?php include("../attachment/session.php"); ?>

<script>
function for_dues1(){
var student_rollno=document.getElementById('selected_student').value;
$.ajax({
type: "POST",
url: access_link+"fees_monthly/ajax_get_student_dues_amount.php?student_rollno="+student_rollno+"",
cache: false,
success: function(detail){
var str=detail.split('|?|');
var lienth_count=str.length;
for(var k=1;k<lienth_count;k++){
	var str1=str[k].split('|??|');
	$("#dues_"+str1[1]).html(str1[0]);
}
}
});
}

$("#my_form").submit(function(e){
e.preventDefault();

var formdata = new FormData(this);
window.scrollTo(0, 0);
    get_content(loader_div);
$.ajax({
	url: access_link+"fees_monthly/student_fee_add_form_api.php",
	type: "POST",
	data: formdata,
	mimeTypes:"multipart/form-data",
	contentType: false,
	cache: false,
	processData: false,
	success: function(detail){
	   var res=detail.split("|?|");
	   if(res[1]=='success'){
		   alert('Successfully Complete');
		   post_content('fees_monthly/student_fee_list_particular','student_roll_no='+res[2]);
	}
	}
 });
});
</script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	    <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
        <li class="active"><?php echo $language['Student Fee Add']; ?></li>
      </ol>
    </section>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
<?php
$qry1="select * from login";
$rest1=mysqli_query($conn73,$qry1);
while($row2=mysqli_fetch_assoc($rest1)){
$blank_field_5_change=$row2['blank_field_5_change'];
if($blank_field_5_change=='Yes'){
$blank_field_5=$row2['blank_field_5_'.$session1];
$blank_field_column_name="blank_field_5_".$session1;
}else{
$blank_field_5=$row2['blank_field_5'];
$blank_field_column_name="blank_field_5";
}
}

if(isset($_GET['s_no']) && isset($_GET['student_roll_no'])){
$s_no=$_GET['s_no'];
$student_roll_no=$_GET['student_roll_no'];

$quee="select * from common_fees_student_fee_add where s_no='$s_no' and student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active'";
$runn=mysqli_query($conn73,$quee);
while($roww=mysqli_fetch_assoc($runn)){
$s_no=$roww['s_no'];
$student_name=$roww['student_name'];
$student_father_name=$roww['student_father_name'];
$student_class=$roww['student_class'];
$student_class_section=$roww['student_class_section'];
$fee_submission_date1=$roww['fee_submission_date'];
if($fee_submission_date1!=''){
$fee_submission_date=date('d-m-Y',strtotime($fee_submission_date1));
}else{
$fee_submission_date=$fee_submission_date1;
}
$paid_total=$roww['paid_total'];
$blank_field_5=$roww['blank_field_5'];
$medium=$roww['medium'];			
$shift=$roww['shift'];			
$board=$roww['board'];			
$fee_paid_months=$roww['fee_paid_months'];
}


?>
	<form name="myForm" method="post" enctype="multipart/form-data" id="my_form">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->			
        <div class="box-body">
		<br>
		<div class="box-body  col-md-12">
			<div class="col-md-3">				
					<div class="form-group" >
					<label><?php echo $language['Search Student']; ?></label>
					<input type="text" name="student_name" id="" class="form-control" value="<?php echo $student_name; ?>" required readonly />
					<input type="hidden" name="selected_student" id="selected_student" class="form-control" value="<?php echo $student_roll_no; ?>" required readonly />
					</div>
			</div>
			<div class="col-md-9">
			<div class="col-md-12">
			    <span style="float:right;"><input type="checkbox" value="" id="fee_month" onclick="for_check(this.id);" /><b style="color:red;">Check All</b></span>
			</div>
			 <?php
			 $month_strcount1=substr_count($fee_paid_months,',');
			 if($month_strcount1>0){
			 $month_exp=explode(',',$fee_paid_months);
			 $month_count=count($month_exp);
			 }else{
			 $month_exp[]=$fee_paid_months;
			 $month_count=1;
			 }
			 
			 $que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
			 $run01=mysqli_query($conn73,$que01);
			 $sno=0;
			 while($row01=mysqli_fetch_assoc($run01)){
			 $fees_type_name[$sno] = $row01['fees_type_name'];
			 $fees_type = $row01['fees_type'];
			 $fees_code[$sno] = $row01['fees_code'];
			 $fees_count = $row01['fees_count'];
			 $var_condition="month".$fees_code[$sno];
			 ?>
			
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="<?php echo $fees_code[$sno]; ?>" <?php for($f=0;$f<$month_count;$f++){ if($month_exp[$f]==$fees_code[$sno]){ echo 'checked'; } } ?> onclick="call_me();" > <?php echo $fees_type_name[$sno]; ?> / <span style="color:red;font-weight:bold;" id="<?php echo 'dues_'.$fees_code[$sno]; ?>">0</span>
			</div>
			<?php $sno++; } ?>
			</div>
		</div>
		
	<?php
	if(isset($_GET['student_roll_no']) && isset($_GET['fee_month'])){
	$student_roll_no=$_GET['student_roll_no'];
	
	$que="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1' ";
    $run=mysqli_query($conn73,$que);
    while($row=mysqli_fetch_assoc($run)){
    $student_name=$row['student_name'];
	$student_father_name=$row['student_father_name'];
	$student_class=$row['student_class'];
	$student_class_section=$row['student_class_section'];
	$student_roll_no=$row['student_roll_no'];
	$school_roll_no=$row['school_roll_no'];
	$student_sms_contact_number=$row['student_sms_contact_number'];
	$student_bus=$row['student_bus'];
	}
	?>
			
		<div class="box-body col-md-12" style="border:1px solid;">
		<center><h4 style="color:red;"><?php echo $language['Pay Fees']; ?></h4></center>
            <?php				
                $que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
                $run=mysqli_query($conn73,$que);
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){

				$s_no=$row['s_no'];
				$fee_type5 = $row['fee_type'];
				$fee_code = $row['fee_code'];
					if($fee_type5!=''){
				$fee_type = preg_replace('/\s+/', '_', $fee_type5);
				$fee_type1[$serial_no] = $row['fee_type'];
				$fee_type=strtolower($fee_type);
				$fee[$serial_no]="student_".$fee_code."_month";
				$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
				$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
				$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
				$serial_no++;
	            }
				}

				
				$que="select * from common_fees_student_fee where student_roll_no='$student_roll_no' and session_value='$session1' and fee_status='Active'";
                $run=mysqli_query($conn73,$que);
				if(mysqli_num_rows($run)<1){
				$grand_total=0;
                $balance_total=0;
                $penalty_amount=0;
                $other_fee_amount1=0;
                $paid_total=0;
	       echo "<script>alert('Student Fee Has Not Set Please Set It Firstly');</script>";
		   
		   echo "<script>post_content('fees_monthly/set_fee_details','student_roll_no='+$student_roll_no);</script>";
	       //echo "<script>window.open('set_fee_details.php?student_roll_no=$student_roll_no','_self')</script>";
				}
				
                while($row=mysqli_fetch_assoc($run)){
				$total_fee=0;
				$fee_status = $row['fee_status'];
				$penalty_amount = $row['penalty_amount'];
				$other_fee_amount1 = $row['other_fee_amount'];
				
				$student_transport_fee = $row['student_transport_fee'];
				$student_transport_fee_balance = $row['student_transport_fee_balance'];
				$student_transport_fee_paid_total = $row['student_transport_fee_paid_total'];
				
				$student_previous_year_fee = $row['student_previous_year_fee'];
				$student_previous_year_fee_balance = $row['student_previous_year_fee_balance'];
				$student_previous_year_fee_paid_total = $row['student_previous_year_fee_paid_total'];
				
				$grand_total = $row['grand_total'];
				$balance_total = $row['balance_total'];
				$paid_total = $row['paid_total'];
				$m=1;
				$month_count111=count($month_exp);
				for($g=0;$g<$month_count111;$g++){
				?>
				<div class="col-md-6">
				<div class="col-md-12">
				<h4 style="color:green;"><?php for($h=0;$h<$fees_count;$h++){ if($month_exp[$g]==$fees_code[$h]){ echo $fees_type_name[$h]; } } ?> Fee Set</h4>
				</div>
				<?php
				$show_total_fee=0;
				$show_paid_fee=0;
				$show_balance_fee=0;
				for($i=0;$i<$serial_no;$i++){

				$fee1[$i] = $row[$fee[$i].$month_exp[$g]];
				$fee_balance1[$i] = $row[$fee_balance[$i].$month_exp[$g]];
				if($fee_balance1[$i]==''){
				$fee_balance1[$i]=0;
				}
				$fee_paid1[$i][$g] = $row[$fee_paid[$i].$month_exp[$g]];

				$total_amount_after_discount1[$i] = $row[$total_amount_after_discount[$i].$month_exp[$g]];
				if($total_amount_after_discount1[$i]==''){
				$total_amount_after_discount1[$i]=0;
				}
				$show_total_fee=$show_total_fee+$total_amount_after_discount1[$i];
				$show_paid_fee=$show_paid_fee+$fee_paid1[$i][$g];
				$show_balance_fee=$show_balance_fee+$fee_balance1[$i];
				?>
				
                <div class="col-md-12">						
                <div class="col-md-4">						
				<div class="form-group">
                  <label ><?php echo $fee_type1[$i];?></label>
                  <input type="text" name="<?php echo $fee[$i].$month_exp[$g];?>" placeholder="<?php echo $fee_type1[$i];?>" value="<?php echo $total_amount_after_discount1[$i];?>" id="" class="form-control fee" oninput="for_total();" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><small><?php echo $fee_type1[$i];?> Balance</small></label>
                  <input type="text" name="<?php echo $fee_balance[$i].$month_exp[$g];?>" placeholder="0" value="<?php echo $fee_balance1[$i]; ?>" id="" class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><small><?php echo $fee_type1[$i];?> Paid Amount</small></label>
                  <input type="number" name="<?php echo $fee_paid[$i].$month_exp[$g];?>" value="<?php echo $fee_balance1[$i]; ?>" placeholder="amount" id="" oninput="total_fee();" step="1" max="<?php echo $fee_balance1[$i]; ?>" class="form-control amt" />
				  
				  <input type="hidden" name="<?php echo 'fee_paid1_'.$i.$g;?>" value="<?php echo $fee_paid1[$i][$g]; ?>" />
                </div>
				</div>
				</div>
						
				<?php } ?>
				<div class="col-md-12" style="border:1px solid;border-radius:20px;">
				<div class="col-md-4">
				<center><h4 style="color:blue;">Total Fee : <?php echo $show_total_fee; ?></h4></center>
				</div>
				<div class="col-md-4">
				<center><h4 style="color:blue;">Total Balance : <?php echo $show_balance_fee; ?></h4></center>
				</div>
				<div class="col-md-4">
				<center><h4 style="color:blue;">Total Paid : <?php echo $show_paid_fee; ?></h4></center>
				</div>
				</div>
				</div>
				<?php } } ?>
				
				<div class="col-md-12" style="<?php if($student_previous_year_fee<=0 || $student_previous_year_fee==''){ echo 'display:none;'; } ?>">				
				<div class="col-md-4">				
				<div class="form-group">
                  <label>Previous Year Fee</label>
                  <input type="text" name="student_previous_year_fee" value="<?php echo $student_previous_year_fee; ?>" placeholder="Previous Year Fee" id=""  class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label>Previous Year Fee Balance</label>
                  <input type="text" name="student_previous_year_fee_balance" value="<?php echo $student_previous_year_fee_balance; ?>" placeholder="Previous Year Fee Balance" id=""  class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label>Previous Year Fee Paid</label>
                  <input type="number" name="student_previous_year_fee_paid" value="" placeholder="Previous Year Fee Paid" step="1" max="<?php echo $student_previous_year_fee_balance; ?>" oninput="total_fee();" id="previous_year_fee_paid1" class="form-control amt" />
                </div>
				</div>
		        </div>
				
				<?php if($student_bus=='Yes'){ ?>
				<div class="col-md-12">				
				<div class="col-md-4">				
				<div class="form-group">
                  <label>Transport Fee</label>
                  <input type="text"  name="student_transport_fee" value="<?php echo $student_transport_fee; ?>" placeholder="Transport Fee" id=""  class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label>Transport Fee Balance</label>
                  <input type="text" name="student_transport_fee_balance" value="<?php echo $student_transport_fee_balance; ?>" placeholder="Transport Fee Balance" id=""  class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label>Transport Fee Paid</label>
                  <input type="number"  name="transport_fee_paid" value="" placeholder="Transport Fee Paid" step="1" max="<?php echo $student_transport_fee_balance; ?>" oninput="total_fee();" id="transport_fee_paid1" class="form-control amt" <?php if (isset($_GET['student_roll_no'])) { echo ''; } else { echo 'readonly'; } ?> />
                </div>
				</div>
		        </div>
				<?php }else{ $student_transport_fee=0; $student_transport_fee_balance=0; $student_transport_fee_paid_total=0; ?>
				<div class="col-md-12">				
				<div class="form-group">
                  <input type="hidden"  name="student_transport_fee" value="<?php echo $student_transport_fee; ?>" placeholder="Transport Fee" id=""  class="form-control" readonly />
				  
				  <input type="hidden" name="student_transport_fee_balance" value="<?php echo $student_transport_fee_balance; ?>" placeholder="Transport Fee Balance" id=""  class="form-control" readonly />
				  
                  <input type="hidden"  name="transport_fee_paid" value="<?php echo $student_transport_fee_paid_total; ?>" placeholder="Transport Fee Paid" step="1" max="<?php echo $student_transport_fee_balance; ?>" oninput="total_fee();" id="transport_fee_paid1" class="form-control amt" <?php if (isset($_GET['student_roll_no'])) { echo ''; } else { echo 'readonly'; } ?> />
                </div>
				</div>
				<?php } ?>
				
		        </div>
		  
		    <div class="col-md-12">
				
				<div class="col-md-1">
				<div class="form-group">
				  <label>Receipt No</label>
                  <input type="number" name="fee_receipt_no" placeholder="" value="<?php if($blank_field_5==''){ echo $blank_field_5+1;}else{echo $blank_field_5;} ?>" class="form-control" readonly >
                </div>
                </div>
				<div class="col-md-2">
				<div class="form-group">
                  <label><?php echo $language['Fee Submission Date']; ?></label>
                  <input type="date"  name="fee_submission_date" placeholder=""  value="<?php echo date('Y-m-d'); ?>" class="form-control" <?php if($_SESSION['sub_panel_submission_date_change']!='yes'){ echo "readonly"; } ?> >
                </div>
                </div>
				<div class="col-md-2" style="display:none;">
				<div class="form-group">
                  <label><?php echo $language['Student Name']; ?></label>
                  <input type="text"  name="student_name" placeholder="<?php echo $language['Student Name']; ?>" id="student_name" value="<?php echo $student_name; ?>" class="form-control" readonly />
                </div>
                </div>
				<div class="col-md-2" style="display:none;">
				<div class="form-group">
                  <label><?php echo $language['Father Name']; ?></label>
                  <input type="text"  name="student_father_name" placeholder="<?php echo $language['Father Name']; ?>"  value="<?php echo $student_father_name; ?>" class="form-control" readonly />
                </div>
                </div>
				<div class="col-md-2" style="display:none;">
				<div class="form-group">
                  <label><?php echo $language['Student Roll No']; ?></label>
                  <input type="hidden"  name="student_roll_no" placeholder="<?php echo $language['Student Roll No']; ?>"  value="<?php echo $student_roll_no; ?>" class="form-control" readonly />
				   <input type="text"   placeholder="Student Roll No"  value="<?php echo $school_roll_no; ?>" class="form-control" readonly />
                </div>
                </div>
				<div class="col-md-2" style="display:none;">
			    <div class="form-group">
                  <label><?php echo $language['Class']; ?></label>
                  <input type="text"  name="student_class" placeholder="<?php echo $language['Class']; ?>"  value="<?php echo $student_class; ?>" class="form-control" readonly />
                </div>
                </div>
				<div class="col-md-2" style="display:none;">
				<div class="form-group">
                  <label><?php echo $language['Section']; ?></label>
                  <input type="text"  name="student_class_section" placeholder="<?php echo $language['Section']; ?>"  value="<?php echo $student_class_section; ?>" class="form-control" readonly />
                </div>
                </div>
				<div class="col-md-2">
				<div class="form-group">
                  <label><?php echo $language['Payment Mode']; ?></label>
                    <select name="student_payment_mode" class="form-control" onchange="payment_mode(this.value);" required >
					  <option value=""><?php echo $language['Select']; ?></option>
			          <option value="Cash"><?php echo $language['Cash']; ?></option>
					  <option value="Cheque"><?php echo $language['Cheque']; ?></option>
			          <option value="NEFT"><?php echo $language['NEFT Net Banking']; ?></option>
			        </select>
                </div>
                </div>
				<div class="col-md-2" id="for_cheque_name" style="display:none;">
				<div class="form-group">
                  <label><?php echo $language['Bank Name']; ?></label>
                  <input type="text"  name="cheque_bank_name" placeholder="Bank Name"  value="" class="form-control">
                </div>
                </div>
				<div class="col-md-2" id="for_cheque_no" style="display:none;">
				<div class="form-group">
                  <label>Cheque No</label>
                  <input type="text"  name="cheque_no" placeholder="Cheque No."  value="" class="form-control">
                </div>
                </div>
				<div class="col-md-2" id="for_cheque_date" style="display:none;">
				<div class="form-group">
                  <label>Cheque Date</label>
                  <input type="date"  name="cheque_date" placeholder="Cheque Date"  value="<?php echo date('Y-m-d'); ?>" class="form-control">
                </div>
                </div>
				<div class="col-md-2" id="for_neft_bank_name" style="display:none;">
				<div class="form-group">
                  <label><?php echo $language['Bank Name']; ?></label>
                  <input type="text"  name="neft_bank_name" placeholder="Bank Name"  value="" class="form-control">
                </div>
                </div>
				<div class="col-md-2" id="for_neft_account_no" style="display:none;">
				<div class="form-group">
                  <label><?php echo $language['Account No']; ?></label>
                  <input type="text"  name="neft_bank_account_no" placeholder="Account No."  value="" class="form-control">
                </div>
                </div>
			 
			  <div class="col-md-2">
			   <div class="form-group">
                  <label><?php echo $language['Total Fee / Year']; ?></label>
                  <input type="text" name="grand_total" placeholder="0"  value="<?php echo $grand_total; ?> " id="grand_total1" class="form-control" readonly />
				</div>
               </div>			  
             <div class="col-md-2">				
		      <div class="form-group">
                  <label><?php echo $language['Total Fee Balance']; ?></label>
                  <input type="text" name="balance_total" placeholder="0"  value="<?php echo $balance_total; ?> " id="grand_total1" class="form-control" readonly >
                </div>
             </div>
			 <div class="col-md-2">				
		      <div class="form-group">
                  <label><?php echo $language['Total Paid']; ?></label>
                  <input type="text" name="total_paid" placeholder="0"  value="" id="total_paid" class="form-control " readonly >
                </div>
             </div>
			 <div class="col-md-1">				
		      <div class="form-group">
                  <label><?php echo $language['Penalty']; ?></label>
                  <input type="text" name="penalty_fee" placeholder="0" value="" class="form-control amt" oninput="total_fee();">
                </div>
             </div>
			 
			 <div class="col-md-3">				
		      <div class="form-group">
                  <label>Other Fee Remark</label>
                  <input type="text" name="other_fee_remark" placeholder="Other Fee Remark" value="" class="form-control" />
                </div>
             </div>
			 <div class="col-md-1">				
		      <div class="form-group">
                  <label>Other Fee</label>
                  <input type="text" name="other_fee_amount" placeholder="0" value="" class="form-control amt" oninput="total_fee();" />
                </div>
             </div>
			 
		    </div>
		</div>
		        <div class="col-md-12 ">
				<div class="col-md-8 ">	
				<label><input type="checkbox" name="myCheck" id="myCheck"  onclick="myFunction()">&nbsp;&nbsp;&nbsp;<?php echo $language['Check For Message']; ?></label>
				<div class="form-group" id="text" style="display:none">
				<input type="text" name="sms" placeholder="" id="contact"  class="form-control">
				  <label>Contact Number</label>
				<input type="text" name="student_sms_contact_number"  value="<?php echo $student_sms_contact_number; ?>"  class="form-control">
			    <input type="hidden" name="send_sms" placeholder="" id="send_sms"  class="form-control">	 
			    </div>
				</div>
				</div>
		
		        <div class="box-body">
			       <div class="col-md-12">
		            <input type="hidden" name="penalty_amount" value="<?php echo $penalty_amount; ?>" />
				    <input type="hidden" name="other_fee_amount1" value="<?php echo $other_fee_amount1; ?>" />
				    <input type="hidden" name="student_previous_year_fee_paid_total" value="<?php echo $student_previous_year_fee_paid_total; ?>" />
				    <input type="hidden" name="student_transport_fee_paid_total" value="<?php echo $student_transport_fee_paid_total; ?>" />
				    <input type="hidden" name="paid_total" value="<?php echo $paid_total; ?>" />
				    <input type="hidden" name="month_count111" value="<?php echo $month_count111; ?>" />
				    <input type="hidden" name="month" value="<?php echo $month; ?>" />
				    <input type="hidden" name="blank_field_column_name" value="<?php echo $blank_field_column_name; ?>" />
		            <center><input type="submit" name="finish" value="<?php echo $language['Fee Submit']; ?>" onclick="return validate();" class="btn  my_background_color" /></center>
		           </div>
			    </div>

</div>
<?php } ?>	
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>
</form>

<script>
for_dues1();
</script>
<?php } ?>