<?php include("../attachment/session.php"); 

?>

<script>
function call_me(){
var selected_student=document.getElementById('selected_student').value;
var chk_all="";
if($('#fee_month').prop("checked") == true){
chk_all="&check_all='all'";
}
var fee_month='';
var num=0;
$(".fee_month").each(function() {
if($(this).prop("checked") == true){
num = Number(parseInt(num)+1);
if(num>1){
fee_month=fee_month+','+$(this).val();
}else{
fee_month=$(this).val();
}
}
});
if(selected_student!='' && fee_month!='') {
post_content('fees_monthly/student_fee_add_form','student_roll_no='+selected_student+'&fee_month='+fee_month+chk_all);
//window.open('student_fee_add_form.php?student_roll_no='+selected_student+'&fee_month='+fee_month,'_self');
}
}

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

function payment_mode(value){
if(value=='Cheque'){
$('#for_cheque_date').show();
$('#for_cheque_no').show();
$('#for_cheque_name').show();
$('#for_neft_account_no').hide();
$('#for_neft_bank_name').hide();
$('#for_transaction_no').hide();
}else if(value=='NEFT'){
$('#for_neft_account_no').show();
$('#for_neft_bank_name').show();
$('#for_cheque_date').hide();
$('#for_cheque_no').hide();
$('#for_cheque_name').hide();
$('#for_transaction_no').hide();
}else if(value=='Paytm' || value=='Phone Pay' || value=='Google Pay' || value=='Other Wallet' || value=='Upi'){
$('#for_transaction_no').show();
$('#for_neft_account_no').hide();
$('#for_neft_bank_name').hide();
$('#for_cheque_date').hide();
$('#for_cheque_no').hide();
$('#for_cheque_name').hide();
}else{
$('#for_cheque_date').hide();
$('#for_cheque_no').hide();
$('#for_cheque_name').hide();
$('#for_neft_account_no').hide();
$('#for_neft_bank_name').hide();
$('#for_transaction_no').hide();
}
}
</script>  
  
<script>
function total_fee(){
var add = 0;
$('.amt').each(function() {
add += Number($(this).val());
});
var discount_amount=document.getElementById('discount_amount').value;
add=Number(add-discount_amount);
document.getElementById('total_paid').value = add;
myFunction();
}
function validate(){
var x = document.forms["myForm"]["total_paid"].value;
var month=0;
$('.fee_month').each(function() {
if($(this).prop('checked')==true){
month = Number(parseInt(month)+1);
}
});
if (x=="" || x<=0 || month<=0) {
	alert("Total Paid amount or Month must be required !!!");
	return false;
}
}
function myFunction(){
    var checkBox = document.getElementById("myCheck");
    var student_name = document.getElementById("student_name").value;
    var school_name = document.getElementById("school_info_school_name11").value;
    var total_amount = document.getElementById("total_paid").value;
    var text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
// 		$('#contact').val('Dear'+student_name+',Your Fee Amount '+total_amount+' Successfully deposited. Thanking You '+school_name);
		//	$('#contact').val('Dear'+student_name+',Your Fee Amount '+total_amount+' Has Been Successfully Deposited. Thank You, From '+school_name+'[SIMPTION]');
			
			$('#contact').val('Dear '+student_name+',Your Fee Amount '+total_amount+' Has Been Successfully Deposited. Thank You, From '+school_name+' [SIMPTION]');
// 		$('#contact').val('Dear'+student_name+',Your Fee Amount '+total_amount+' Has Been Successfully Deposited. Thank You, From '+school_name+'[SCHOOL]); 
		 $('#send_sms').val('Yes');
    } else {
       text.style.display = "none";
	   $('#contact').val('');
	   $('#send_sms').val('No');
    }
}
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
call_me();
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
	    
	   // alert(detail)
	   // console.log(detail);
	   
	   var res=detail.split("|?|");
	   if(res[1]=='success'){
		   alert('Successfully Complete');
		  // get_content('fees_monthly/student_fee_add_form');
		  // window.open(res[3],'_blank');
		   post_content('fees_monthly/student_fee_list_particular','student_roll_no='+res[2]);
	}else if(res[1]=='session_not_set'){
                alert('Session Expire !!!');
            }
	}
 });
});
function for_paid(serial_no,month_count){
    var submission_amount=document.getElementById('submission_amount').value;
    var total_payable=0;
    $(".bal1").each(function() {
    total_payable += Number($(this).val());
    });
    if(Number(submission_amount)<=Number(total_payable)){
        for(var j=0; j<month_count; j++){
        for(var i=0; i<serial_no; i++){
            if(Number($("#balance_tot_"+i+"_"+j).val())<=Number(submission_amount)){
                submission_amount = Number(parseFloat(submission_amount)-parseFloat($("#balance_tot_"+i+"_"+j).val()));
                $("#paid_tot_"+i+"_"+j).val($("#balance_tot_"+i+"_"+j).val());
            }else{
                if(submission_amount!='0'){
                    $("#paid_tot_"+i+"_"+j).val(submission_amount);
                    submission_amount=0;
                }else{
                    $("#paid_tot_"+i+"_"+j).val(submission_amount);
                }
            }
        }
        }
    }else{
        alert("Please Enter Valid Amount !!!");
        $('#submission_amount').val('');
    }
    total_fee();
}
function for_penalty(value){
    var selected_student=document.getElementById('selected_student').value;
    var select_month=[];
    var select_count=0;
    $('.fee_month').each(function() {
    if($(this).prop('checked')==true){
    select_month.push($(this).val());
    select_count = Number(parseInt(select_count)+1);
    }
    });
    if(select_count>0 && selected_student!='' && value!=''){
        
        $.ajax({
        type: "POST",
        url: access_link+"fees_monthly/ajax_get_penalty_amount.php",
        data: {select_month:select_month,select_count:select_count,selected_student:selected_student,value:value},
        cache: false,
        success: function(detail){
        var res=detail.split("|?|");
        $("#penalty_fee").val(res[1]);
        total_fee();
        }
        });
        
    }else{
        $("#penalty_fee").val('0');
        total_fee();
    }
}
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
$qry221="select * from school_info_general";
$rest221=mysqli_query($conn73,$qry221);
while($row221=mysqli_fetch_assoc($rest221)){
$school_info_school_name = $row221['school_info_school_name'];
}
?>
	
<?php
$qry1="select * from login";
$rest1=mysqli_query($conn73,$qry1);
while($row2=mysqli_fetch_assoc($rest1)){
$blank_field_5_change=$row2['blank_field_5_change'];
if($blank_field_5_change=='Yes'){
$blank_field_5=$row2['editable_blank_field_5_'.$session1];
$blank_field_column_name="editable_blank_field_5_".$session1;
}else{
$blank_field_5=$row2['editable_blank_field_5'];
$blank_field_column_name="editable_blank_field_5";
}
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
			<div class="col-md-4">				
					<div class="form-group" >
					<label><?php echo $language['Search Student']; ?></label>
					<select name="" class="form-control select2" id="selected_student" onchange="for_dues1();call_me();" style="width:100%;" required>
					<option value=""><?php echo $language['Select student']; ?></option>
					<?php
					$qry="select * from student_admission_info where student_status='Active' and session_value='$session1'";
					$rest=mysqli_query($conn73,$qry);
					while($row22=mysqli_fetch_assoc($rest)){
					$student_roll_no3=$row22['student_roll_no'];
					$school_roll_no3=$row22['school_roll_no'];
					$student_name3=$row22['student_name'];
					$student_class3=$row22['student_class'];
					$student_section3=$row22['student_class_section'];
					$student_father_name3=$row22['student_father_name'];
					$student_father_contact_number3=$row22['student_father_contact_number'];
					$student_admission_number=$row22['student_admission_number'];
					?>
					<option <?php if (isset($_GET['student_roll_no'])) { if($_GET['student_roll_no']==$student_roll_no3){ echo 'selected';} } ?> value="<?php echo $student_roll_no3; ?>"><?php echo $student_name3."[".$student_admission_number."]-[".$school_roll_no3."]-[".$student_class3."-".$student_section3."]-[".$student_father_name3."-".$student_father_contact_number3."]"; ?></option>
					<?php
					}
					?>
					</select>
					</div>
			</div>
			<div class="col-md-8">
			<div class="col-md-12">
			    <span style="float:right;"><input type="checkbox" value="" id="fee_month" onclick="for_check(this.id);" <?php if (isset($_GET['check_all'])) { echo 'checked'; } ?> /><b style="color:red;">Check All</b></span>
			</div>
			 <?php
			 if (isset($_GET['fee_month'])){
			 $month=$_GET['fee_month'];
			 $month_strcount1=substr_count($month,',');
			 if($month_strcount1>0){
			 $month_exp=explode(',',$month);
			 $month_count=count($month_exp);
			 }else{
			 $month_exp[]=$month;
			 $month_count=1;
			 }
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
			 
			 $penalty_day_monthly[$fees_code[$sno]] = $row01['penalty_day_monthly'];
			 
			 $dues_last_date[$fees_code[$sno]] = $row01['dues_last_date'];
			 $penalty_percent_rupees_amount[$fees_code[$sno]] = $row01['penalty_percent_rupees_amount'];
			 $penalty_method[$fees_code[$sno]] = $row01['penalty_method'];
			 ?>
			
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="<?php echo $fees_code[$sno]; ?>" <?php if (isset($_GET['fee_month'])){ for($f=0;$f<$month_count;$f++){ if($month_exp[$f]==$fees_code[$sno]){ echo 'checked'; } } } ?> onclick="call_me();" > <?php echo $fees_type_name[$sno]; ?> / <span style="color:red;font-weight:bold;" id="<?php echo 'dues_'.$fees_code[$sno]; ?>">0</span>
			</div>
			<?php $sno++; } ?>
			</div>
		</div>
		
	<?php
	if(isset($_GET['student_roll_no'])){
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
	if($row['student_sms_contact_number']!=''){
	$student_sms_contact_number=$row['student_sms_contact_number'];
	}else{
	$student_sms_contact_number=$row['student_father_contact_number'];
	}
	$student_bus=$row['student_bus'];
	$student_bus_fee_category_code11=$row['student_bus_fee_category_code'];
	}
	
    $class_que1="select class_code from school_info_class_info where class_name='$student_class'";
    $class_run1=mysqli_query($conn73,$class_que1) or die(mysqli_error($conn73));
    $class_sno=0;
    while($class_row1=mysqli_fetch_assoc($class_run1)){
    $class_code[$class_sno]=$class_row1['class_code'];
    $class_sno++;
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
				$calculate_penalty=0;
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
                  <input type="text" name="<?php echo $fee_balance[$i].$month_exp[$g];?>" placeholder="0" value="<?php echo $fee_balance1[$i]; ?>" id="<?php echo 'balance_tot_'.$i.'_'.$g; ?>" class="form-control bal1" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><small><?php echo $fee_type1[$i];?> Paid Amount</small></label>
                  <input type="number" name="<?php echo $fee_paid[$i].$month_exp[$g];?>" value="<?php echo $fee_balance1[$i]; ?>" placeholder="amount" id="<?php echo 'paid_tot_'.$i.'_'.$g; ?>" oninput="total_fee();" step="1" max="<?php echo $fee_balance1[$i]; ?>" class="form-control amt" />
				  
				  <input type="hidden" name="<?php echo 'fee_paid1_'.$i.$g;?>" value="<?php echo $fee_paid1[$i][$g]; ?>" />
                </div>
				</div>
				</div>
						
				<?php
				}
				if(date('Y-m-d') > $dues_last_date[$month_exp[$g]] && $dues_last_date[$month_exp[$g]]!='0000-00-00'){
				    if($penalty_day_monthly[$month_exp[$g]]=='Day'){
				    
				    $current_date=date_create(date('Y-m-d'));
				    $dues_last_date11=date_create($dues_last_date[$month_exp[$g]]);
				    $diff=date_diff($current_date,$dues_last_date11);
					$clear_difference=$diff->format("%a");
				    
				    if($penalty_method[$month_exp[$g]]=='%'){
				    $calculate_penalty=$calculate_penalty+(($show_balance_fee*$clear_difference*$penalty_percent_rupees_amount[$month_exp[$g]])/100);
				    }elseif($penalty_method[$month_exp[$g]]=='Rs'){
				    $calculate_penalty=$calculate_penalty+($penalty_percent_rupees_amount[$month_exp[$g]]*$clear_difference);
				    }
				    }else{
				    if($penalty_method[$month_exp[$g]]=='%'){
				    $calculate_penalty=$calculate_penalty+(($show_balance_fee*$penalty_percent_rupees_amount[$month_exp[$g]])/100);
				    }elseif($penalty_method[$month_exp[$g]]=='Rs'){
				    $calculate_penalty=$calculate_penalty+number_format($penalty_percent_rupees_amount[$month_exp[$g]],2);
				    }
				    }
				}else{
				    $calculate_penalty=$calculate_penalty;
				}
				?>
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
				<?php
                $bus_que="select * from bus_fee_category where bus_fee_category_code='$student_bus_fee_category_code11'";
                $bus_run=mysqli_query($conn73,$bus_que) or die(mysqli_error($conn73));
                $transport_payable_amt=0;
                while($bus_row=mysqli_fetch_assoc($bus_run)){
                for($al=0;$al<$class_sno;$al++){
                for($am=0;$am<$month_count111;$am++){
                $transport_payable_amt=$transport_payable_amt+$bus_row[$class_code[$al].'_amount_month'.$month_exp[$am]];
                }
                }
                }
				?>
				
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
                  <input type="number"  name="transport_fee_paid" value="" placeholder="<?php echo $transport_payable_amt; ?>" step="1" max="<?php echo $student_transport_fee_balance; ?>" oninput="total_fee();" id="transport_fee_paid1" class="form-control amt" <?php if (isset($_GET['student_roll_no'])) { echo ''; } else { echo 'readonly'; } ?> />
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
				
				<div class="col-md-2">
				<div class="form-group">
				  <label><small>Editable Receipt No</small></label>
                  <input type="number" name="editable_fee_receipt_no" placeholder="" value="<?php if($blank_field_5==''){ echo $blank_field_5+1;}else{echo $blank_field_5;} ?>" class="form-control" <?php if($_SESSION['database_name']=='simptlcb_sanskarschoolparbatsar' ) { echo 'readonly'; } ?>>
                </div>
                </div>
				<div class="col-md-2">
				<div class="form-group">
                  <label><?php echo $language['Fee Submission Date']; ?></label>
                  <input type="date" name="fee_submission_date" value="<?php echo date('Y-m-d'); ?>" onchange="for_penalty(this.value);" class="form-control" <?php if($_SESSION['sub_panel_submission_date_change']!='yes'){ echo "readonly"; }?> >
                </div>
                </div>
				
				<div class="col-md-2" style="display:none;">
				<?php
				if($_SESSION['database_name']=='simpthqt_wisdomipshdr'){
				    if(substr_count($school_info_school_name, " ")>0){
				        $school_info_school_name1=explode(" ",$school_info_school_name);
				        $schl_count=count($school_info_school_name1);
				        $school_info_school_name='';
				        for($ai=0;$ai<$schl_count;$ai++){
				            $school_info_school_name=$school_info_school_name.substr($school_info_school_name1[$ai],0,1);
				        }
				    }
				}
				?>
				<div class="form-group">
                  <label><?php echo "School Name"; ?></label>
                  <input type="text"  name="school_name" placeholder="<?php echo "school_name"; ?>" id="school_info_school_name11" value="<?php echo $school_info_school_name; ?>" class="form-control" readonly/>
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
					  <label>Office Account</label>
					    <select name="office_account_sno" class="form-control" >
					    <option value="">Select</option>
					    <?php
                        $que="select s_no,bank_account_holder_name,bank_account_no from account_office_bank_account";
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
                  <label><?php echo $language['Payment Mode']; ?></label>
                    <select name="student_payment_mode" class="form-control" onchange="payment_mode(this.value);" required >
					  <option value=""><?php echo $language['Select']; ?></option>
			          <option value="Cash"><?php echo $language['Cash']; ?></option>
					  <option value="Cheque"><?php echo $language['Cheque']; ?></option>
			          <option value="NEFT"><?php echo $language['NEFT Net Banking']; ?></option>
					  <option value="Paytm">Paytm</option>
					  <option value="Phone Pay">Phone Pay</option>
					  <option value="Google Pay">Google Pay</option>
					  <option value="BharatPe">BharatPe</option>
					  <option value="Upi">UPI</option>
					  <option value="Other Wallet">Other Wallet</option>
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
				
				<div class="col-md-2" id="for_transaction_no" style="display:none;">
				<div class="form-group">
                  <label>Transaction No</label>
                  <input type="text"  name="transaction_no"  placeholder="Transaction No."  value="" class="form-control">
                </div>
                </div>
                
              <div class="col-md-2">
			   <div class="form-group">
                  <label>Discount Remark</label>
                  <input type="text" name="discount_remark" placeholder="Discount Remark" value="" id="discount_remark" class="form-control" />
				</div>
               </div>
               
               <div class="col-md-2">
			   <div class="form-group">
                  <label>Discount Amount <small>( In Rs )</small></label>
                  <input type="text" name="discount_amount" placeholder="Discount Amount" value="" id="discount_amount" class="form-control" oninput="total_fee();" />
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
                  <label>To Be Paid</label>
                  <input type="text" name="total_paid" placeholder="0"  value="" id="total_paid" class="form-control " readonly >
                </div>
             </div>
			 <div class="col-md-1">				
		      <div class="form-group">
                  <label><?php echo $language['Penalty']; ?></label>
                  <input type="text" name="penalty_fee" id="penalty_fee" placeholder="0" value="<?php echo $calculate_penalty; ?>" class="form-control amt" oninput="total_fee();">
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
		            <div class="col-md-3">				
        		      <div class="form-group">
                          <label>Pay Amount</label>
                          <input type="number" placeholder="Enter Pay Amount" id="submission_amount" class="form-control" oninput="for_paid('<?php echo $serial_no; ?>','<?php echo $month_count111; ?>');" />
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
				    <input type="hidden" name="editable_blank_field_column_name" value="<?php echo $blank_field_column_name; ?>" />
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
total_fee();
</script>
<script>
$(function () {
    $('.select2').select2();
  });
</script>