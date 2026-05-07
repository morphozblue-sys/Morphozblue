<?php include("../attachment/session.php");

?>

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
</script>

<script>
function for_pf(value){
if(value=='Yes'){
$('#for_pf_number').show();
$('#for_pf_amount').show();
}else{
$('#for_pf_number').hide();
$('#for_pf_amount').hide();
}
}

function valid_month(){
var fromDate = $('#salary_from').val(); 
var toDate = $('#salary_to').val(); 

if(fromDate!='' && toDate!=''){
var month_from23=fromDate.split('-');
var month_to3=toDate.split('-');
if(month_from23[1]!=month_to3[1]){
alert_new("Please Select Same Month !!!",'red');
$('#salary_from').val(''); 
$('#salary_to').val(''); 
}else if(month_from23[2]>month_to3[2]){
alert_new("From Date Can Not Be Grater Than To Date !!!!",'red');
$('#salary_from').val(''); 
$('#salary_to').val(''); 
}else{
	for_attendance(fromDate,toDate);
	}
	}
}



function for_attendance(fromdate,todate){
var staff_id=document.getElementById('staff_id').value;
$("#for_present").html("Loading....");
$("#total_present").val("Loading....");
$("#for_absent").html("Loading....");
$("#total_absent").val("Loading....");
$("#for_leave").html("Loading....");
$("#total_leave").val("Loading....");
$("#for_holiday").html("Loading....");
$("#total_holiday").val("Loading....");
$("#for_sunday").html("Loading....");
$("#total_sunday").val("Loading....");
$("#for_total_days").html("Loading....");
$("#total_total_days").val("Loading....");
$("#for_working_days").html("Loading....");
$("#total_working_days").val("Loading....");
$("#for_salary_days").html("Loading....");
$("#salary_days").val("Loading....");
$("#total_days_in_month").val("Loading....");
$("#total_advance").val("Loading....");
$.ajax({
address: "POST",
url: access_link+"staff/ajax_get_attendance.php?fromdate="+fromdate+"&todate="+todate+"&staff_id="+staff_id+"",
cache: false,
success: function(detail){
var str=detail;
var res=str.split("|?|");
$("#for_present").html(res[1]);
$("#total_present").val(res[1]);
$("#for_absent").html(res[2]);
$("#total_absent").val(res[2]);
$("#for_leave").html(res[3]);
$("#total_leave").val(res[3]);
$("#for_holiday").html(res[4]);
$("#total_holiday").val(res[4]);
$("#for_sunday").html(res[5]);
$("#total_sunday").val(res[5]);
$("#for_total_days").html(res[6]);
$("#total_total_days").val(res[6]);
$("#for_working_days").html(res[7]);
$("#total_working_days").val(res[7]);
$("#for_salary_days").html(res[10]);
$("#salary_days").val(res[10]);
$("#total_days_in_month").val(Number(res[11]));
// $("#total_days_in_month123").val(30);
$("#total_advance").val(res[12]);
var total_holiday_days=res[13];
var holidays_list='';
for(var x=0; x<total_holiday_days; x++){
var p=x+1;
var y=14+2*x;
var z=15+2*x;
var m=res[y];
var n=res[z];
holidays_list=holidays_list+"<tr><td>"+p+"</td><td>"+n+"</td><td>"+m+"</td></tr>";

}
$('#my_table').html(holidays_list);
salary_calculation();
}
});
}

function salary_calculation(){
$('#level_ptax_deduction').html("Loading....");
$('#level_esic_deduction').html("Loading....");
$('#level_tds_deduction').html("Loading....");
$('#level_pf_deduction').html("Loading....");
$('#level_other_deduction').html("Loading....");
$('#level_total_incentive').html("Loading....");
$('#level_allowance').html("Loading....");
$('#level_basic_salary').html("Loading....");
$('#level_total_present').html("Loading....");
$('#level_total_absent').html("Loading....");
$('#level_salary_days').html("Loading....");
$('#level_total_leave').html("Loading....");
$('#level_total_deduction').html("Loading....");
$('#level_final_salary').html("Loading....");
$('#level_working_days').html("Loading....");
$('#level_days_in_month').html("Loading....");
$('#level_per_day_salary').html("Loading....");
$('#level_total_holiday').html("Loading....");
$('#level_total_sunday').html("Loading....");
$('#level_total_days1').html("Loading....");
$('#level_total_advance').html("Loading....");
$('#level_ptax_deduction11').val("Loading....");
$('#level_esic_deduction11').val("Loading....");
$('#level_tds_deduction11').val("Loading....");
$('#level_pf_deduction11').val("Loading....");
$('#level_other_deduction11').val("Loading....");
$('#level_total_incentive11').val("Loading....");
$('#level_allowance11').val("Loading....");
$('#level_basic_salary11').val("Loading....");
$('#level_total_present11').val("Loading....");
$('#level_total_absent11').val("Loading....");
$('#level_salary_days11').val("Loading....");
$('#level_total_leave11').val("Loading....");
$('#level_total_deduction11').val("Loading....");
$('#level_final_salary11').val("Loading....");
$('#level_working_days11').val("Loading....");
$('#level_days_in_month11').val("Loading....");
$('#level_per_day_salary11').val("Loading....");
$('#level_total_holiday11').val("Loading....");
$('#level_total_sunday11').val("Loading....");
$('#level_total_days11').val("Loading....");
$('#level_total_advance11').val("Loading....");
$('#salary_days').val(salary_days);
var my_database_name=document.getElementById('my_database_name').value;
var basic_salary=document.getElementById('actual_salary').value;
var total_present=document.getElementById('total_present').value;
var total_absent=document.getElementById('total_absent').value;
var total_sunday=document.getElementById('total_sunday').value;
var total_holiday=document.getElementById('total_holiday').value;
var total_leave=document.getElementById('total_leave').value;
var total_working_days=document.getElementById('total_working_days').value;
var salary_days=document.getElementById('salary_days').value;
var total_total_days=document.getElementById('total_total_days').value;
var total_days_in_month=document.getElementById('total_days_in_month').value;

var allowance=document.getElementById('allowance1').value;
var allowance_ma=document.getElementById('allowance_ma').value;
console.log(allowance_ma);
var pf_deduction=document.getElementById('pf_amount_input').value;
var tds_deduction=document.getElementById('tds_amount_input').value;
var ptax_deduction=document.getElementById('ptax_amount_input').value;
var other_deduction=document.getElementById('other_amount_input').value;
var da_amount=document.getElementById('da_amount').value;
var hra_amount=document.getElementById('hra_amount').value;
var esic_deduction=document.getElementById('esic_amount_input').value;
var total_advance=document.getElementById('total_advance').value;
var total_incentive=document.getElementById('total_incentive1').value;

var per_days_salary=parseFloat(parseFloat(basic_salary)/parseFloat(total_days_in_month));
var salary_days=parseFloat(total_total_days)-parseFloat(total_absent);
var salary_without_pf=parseFloat(parseFloat(per_days_salary)*parseFloat(salary_days));

if($("#pf_otherway_deduction").prop("checked")==true){
if(my_database_name=='simptlcb_devmataschoolnasrullaganj'){
//if(my_database_name=='simptnhu_new_software'){
var per_day_hra=parseFloat(parseFloat(hra_amount)/parseFloat(total_days_in_month));
var hra_amount01=parseFloat(parseFloat(per_day_hra)*parseFloat(salary_days));
var hra_amount=hra_amount01.toFixed(2);
var per_day_da=parseFloat(parseFloat(da_amount)/parseFloat(total_days_in_month));
var da_amount01=parseFloat(parseFloat(per_day_da)*parseFloat(salary_days));
var da_amount=da_amount01.toFixed(2);
}

//if($("#pf_otherway_deduction").prop("checked")==true){
var per_day_pf_deduction=parseFloat(parseFloat(pf_deduction)/parseFloat(total_days_in_month));
var pf_deduction_amount01=parseFloat(parseFloat(per_day_pf_deduction)*parseFloat(salary_days));
var pf_deduction=pf_deduction_amount01.toFixed(2);
}

var final_salary=parseFloat(salary_without_pf)+parseFloat(total_incentive)+parseFloat(allowance)+parseFloat(allowance_ma)+parseFloat(hra_amount)+parseFloat(da_amount)-parseFloat(other_deduction)-parseFloat(ptax_deduction)-parseFloat(pf_deduction)-parseFloat(tds_deduction)-parseFloat(esic_deduction)-parseFloat(total_advance);
var total_deduction=parseFloat(total_advance)+parseFloat(other_deduction)+parseFloat(ptax_deduction)+parseFloat(pf_deduction)+parseFloat(tds_deduction)+parseFloat(esic_deduction);
final_salary=final_salary.toFixed(2);
total_deduction=total_deduction.toFixed(2);
per_days_salary=per_days_salary.toFixed(2);

$('#level_generate_final_salary11').val(salary_without_pf.toFixed(2));

$('#level_ptax_deduction').html(ptax_deduction);
$('#level_esic_deduction').html(esic_deduction);
$('#level_tds_deduction').html(tds_deduction);
$('#level_pf_deduction').html(pf_deduction);
$('#level_other_deduction').html(other_deduction);
$('#level_total_incentive').html(total_incentive);
$('#level_allowance').html(allowance);
$('#level_basic_salary').html(basic_salary);
$('#level_total_present').html(total_present);
$('#level_total_absent').html(total_absent);
$('#level_salary_days').html(salary_days);
$('#level_total_leave').html(total_leave);
$('#level_total_deduction').html(total_deduction);
$('#level_final_salary').html(final_salary);
$('#level_working_days').html(total_working_days);
$('#level_days_in_month').html(total_days_in_month);
$('#level_per_day_salary').html(per_days_salary);
$('#level_total_holiday').html(total_holiday);
$('#level_total_sunday').html(total_sunday);
$('#level_total_days1').html(total_total_days);
$('#level_total_advance').html(total_advance);
$('#level_total_hra').html(hra_amount);
$('#level_total_da').html(da_amount);
$('#level_ptax_deduction11').val(ptax_deduction);
$('#level_esic_deduction11').val(esic_deduction);
$('#level_tds_deduction11').val(tds_deduction);
$('#level_pf_deduction11').val(pf_deduction);
$('#level_other_deduction11').val(other_deduction);
$('#level_total_incentive11').val(total_incentive);
$('#level_allowance11').val(allowance);
$('#level_basic_salary11').val(basic_salary);
$('#level_total_present11').val(total_present);
$('#level_total_absent11').val(total_absent);
$('#level_salary_days11').val(salary_days);
$('#level_total_leave11').val(total_leave);
$('#level_total_deduction11').val(total_deduction);
$('#level_final_salary11').val(final_salary);
$('#level_working_days11').val(total_working_days);
$('#level_days_in_month11').val(total_days_in_month);
$('#level_per_day_salary11').val(per_days_salary);
$('#level_total_holiday11').val(total_holiday);
$('#level_total_sunday11').val(total_sunday);
$('#level_total_days11').val(total_total_days);
$('#level_total_advance11').val(total_advance);
$('#level_total_hra11').val(hra_amount);
$('#level_total_da11').val(da_amount);
}

function for_leave(value){
if(value=='verify'){
$('#verify_total_leaves').prop("readonly", false);
}else{
$('#verify_total_leaves').val('0');
$('#verify_total_leaves').prop("readonly", true);
}
}

function check_leave(value){
var total_leave=document.getElementById('total_leave').value;
if(parseFloat(value)>parseFloat(total_leave)){
alert_new('Sorry ! Entered value Greater than Leave !!!','red');
$('#verify_total_leaves').val('0');
}
}
    $("#my_form").submit(function(e){
        e.preventDefault();
    var formdata = new FormData(this);
window.scrollTo(0, 0);
    loader();
        $.ajax({
            url: access_link+"staff/emp_salary_generate_api.php",
            type: "POST",
            data: formdata,
            mimeTypes:"multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(detail){
				console.log(detail)
               var res=detail.split("|?|");
			   if(res[1]=='success'){
				   alert_new('Successfully Complete','green');
				   get_content('staff/emp_salary_list');
            }
			}
         });
      });
      
      
function for_pf(){
    var pf_method=document.getElementById('pf_method').value;
    var pf_amount_input1=document.getElementById('pf_amount_input1').value;
    var level_basic_salary11=document.getElementById('level_generate_final_salary11').value;
    if(pf_amount_input1>0 && level_basic_salary11>0){
    if(pf_method=='%'){
        var pf_amt=parseFloat(parseFloat(level_basic_salary11)*parseFloat(pf_amount_input1))/100;
        $('#pf_amount_input').val(pf_amt);
    }else if(pf_method=='Rs'){
        $('#pf_amount_input').val(pf_amount_input1);
    }
    }else{
        $('#pf_amount_input').val('0');
    }
    salary_calculation();
}
</script>


<?php
$emp_id=$_GET['emp_id'];
$que="select * from employee_info where emp_id='$emp_id'";
$run=mysqli_query($conn73,$que);
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
    
	$emp_name = $row['emp_name'];
	$emp_account_no = $row['emp_account_no'];
	$emp_pf_number = $row['emp_pf_number'];
	$emp_basic_salary = $row['emp_basic_salary'];
		$pf_deduction = $row['pf_deduction'];
		$emp_ifsc_code = $row['emp_ifsc_code'];
	$hra_amount = $row['hra_amount'];
	$da_amount = $row['da_amount'];
	$emp_allowance = $row['emp_allowance'];
		$tds_deduction = $row['tds_deduction'];
	$esic_deduction = $row['esic_deduction'];
	$ptax_deduction = $row['ptax_deduction'];
	$emp_bank_name = $row['emp_bank_name'];
	$emp_account_no = $row['emp_account_no'];
	$emp_ifsc_code = $row['emp_ifsc_code'];
	$remarks=$row['remarks'];
	if($remarks=='' || (!is_numeric($remarks)))
	{
	    $remarks=0;
	}
		if($tds_deduction==''){
	    $tds_deduction=0;
	}
		if($emp_basic_salary==''){
	    $emp_basic_salary=0;
	}
	if($esic_deduction==''){
	    $esic_deduction=0;
	}
	if($ptax_deduction==''){
	    $ptax_deduction=0;
	}
	if($pf_deduction==''){
	    $pf_deduction=0;
	}
	if($hra_amount==''){
	    $hra_amount=0;
	}
	if($da_amount==''){
	    $da_amount=0;
	}
	if($emp_allowance==''){
	    $emp_allowance=0;
	}
	
	$emp_leave_cl = $row['emp_leave_cl'];
	if($emp_leave_cl==''){
	$emp_leave_cl = '0';
	}
	$emp_leave_pl = $row['emp_leave_pl'];
	if($emp_leave_pl==''){
	$emp_leave_pl = '0';
	}
	$emp_leave_sl = $row['emp_leave_sl'];
	if($emp_leave_sl==''){
	$emp_leave_sl = '0';
	}
	$emp_leave_other = $row['emp_leave_other'];
	if($emp_leave_other==''){
	$emp_leave_other = '0';
	}
}

?>


    <section class="content-header">
       <h1> Employee Management 
        <small> Control Panel </small></h1>
      <ol class="breadcrumb">
 <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="javascript:get_content('staff/staff')"><i class="fa fa-graduation-cap"></i> <?php echo $language['Employee']; ?></a></li>
	  <li class="active"> Employee Salary Generate </li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <!-- Main content -->
	<form method="post" enctype="multipart/form-data" id="my_form">
	<input type="hidden" name="pf_number"  value="<?php echo $emp_pf_number; ?>">
	<input type="hidden" name="emp_id"  value="<?php echo $emp_id; ?>">
	<input type="hidden" id="my_database_name" value="<?php echo $_SESSION['database_name']; ?>">
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
    <div class="box box-primary my_border_top">
            
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
			
    <div class="box-body">
				<div class="col-md-6 ">
				  <h2> Salary Panel </h2>
				  <div class="panel panel-default">
				  <div class="panel-body">
					<div class="col-md-6 ">
						<div class="form-group">
						  <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $emp_id; ?>">
						  <label> Employee Name :<font style="color:red"><b>*</b></font></label>
						  <input type="text" required name="emp_name" placeholder="Employee Name"  value="<?php echo $emp_name; ?>" class="form-control">
						  <input type="hidden" name="emp_account_no" value="<?php echo $emp_account_no; ?>" class="form-control" />
						  <input type="hidden" name="emp_ifsc_code" value="<?php echo $emp_ifsc_code; ?>" class="form-control" />
						</div>
					</div>
					<div class="col-md-6 ">
						<div class="form-group">
						  <label  > Salary From :</label>
						  <input type="date" name="salary_from" id="salary_from" class="form-control" required value="<?php echo date('Y-m-d')?>" oninput="valid_month();">
						</div>
					</div>
					<div class="col-md-6 ">		
						<div class="form-group">
						  <label  > Salary To :</label>
						  <input type="date" name="salary_to" id="salary_to" class="form-control" required value="" oninput="valid_month();">
						</div>
					</div>
					<div class="col-md-6 ">	
					<div class="form-group" >
					  <label  > Salary :</label>
					  <td><input type="text" name="actual_salary" id="actual_salary" placeholder=" Actual Salary" oninput='salary_calculation();' class="form-control"  value="<?php echo $emp_basic_salary; ?>"></td>
					</div>
					</div>
					<div class="col-md-6 ">	
					<div class="form-group" >
					  <label  > HRA:</label>
					  <td><input type="text" name="hra_amount" id="hra_amount" placeholder="HRA" class="form-control" value='<?php echo $hra_amount; ?>' oninput='salary_calculation();' ></td>
					</div>
					</div>
					<div class="col-md-6 ">	
					<div class="form-group" >
					    <?php if($_SESSION['software_link']=='lotusvalleyschoolozar'){?>
					    <label  >Last Year Dues</label>
					    <? }else{ ?>
					  <label  > DA:</label>
					  <? } ?>
					  <td><input type="text" name="da_amount" id="da_amount" placeholder="HRA" class="form-control" value='<?php echo $da_amount; ?>' oninput='salary_calculation();'  ></td>
					</div>
					</div>
					<div class="col-md-6 ">				
					<div class="form-group" >
					  <label  > Total Incentive :</label>
					  <td><input type="text" name="total_incentive" id="total_incentive1" placeholder="Total Incentive"  oninput='salary_calculation();' class="form-control"  value="0" ></td>
					</div>
					</div>
	                <div class="col-md-6 ">				
					<div class="form-group" >
					  <label  > Allowance:</label>
					  <td><input type="text" name="allowance1" id='allowance1' placeholder="Allowance" class="form-control" oninput='salary_calculation();' value="<?php echo $emp_allowance; ?>"></td>
					</div>
					</div>
					
		        	<div class="col-md-6 ">				
					<div class="form-group" >
					  <label  > MA :</label>
			           <?php if($_SESSION['software_link']=="bharatiyaschoolnadiad"){?>		  
					  <td><input type="text" name="allowance_ma" id='allowance_ma' placeholder="MA" class="form-control" oninput='salary_calculation();' value="<?php echo $remarks; ?>"></td>
			           <?php }else{ ?>	
                      <td><input type="text" name="allowance_ma" id='allowance_ma' placeholder="MA" class="form-control" oninput='salary_calculation();' value="0"></td>    			
		               <?php } ?>
					</div>
					</div>
					
					<div class="col-md-6 ">				
					<div class="form-group" >
					  <label  > Advance:</label>
					  <td><input type="text" name="total_advance" id='total_advance' placeholder="Allowance" class="form-control" oninput='salary_calculation();' value="0"></td>
					</div>
					</div>
	
					<div class="col-md-6 ">				
				<div class="form-group">
                   <label >PF Deduction</label>
                   
                 
				    <input type="text" name="pf_amount_input" class="form-control" id="pf_amount_input" oninput='salary_calculation();' value="<?php echo $pf_deduction; ?>">
					
				  
                   
                </div>
			</div>
			<div class="col-md-6 ">				
				<div class="form-group">
                   <label >TDS Deduction</label>
                  <input type="text" name="tds_amount_input" class="form-control"  id="tds_amount_input"  oninput='salary_calculation();' value="<?php echo $tds_deduction; ?>">
			        </select>
                </div>
			</div>
			
			<div class="col-md-6 ">				
				<div class="form-group">
                   <label >ESIC Deduction</label>
                  <input type="text" name="esic_amount_input" class="form-control" id="esic_amount_input" oninput='salary_calculation();' value="<?php echo $esic_deduction; ?>">
                </div>
			</div>
			
			<div class="col-md-6 ">				
				<div class="form-group">
                   <label >Professional Tax</label>
                 <input type="text" name="ptax_amount_input" class="form-control" id="ptax_amount_input" oninput='salary_calculation();' value="<?php echo $ptax_deduction; ?>">
                </div>
			</div>

       <div class="col-md-6 " >			
					<div class="form-group" >
					  <label  > Other Deduction :</label>
					  <td><input type="number" name="other_deduction" id="other_amount_input" class="form-control" placeholder="PF Amount" oninput='salary_calculation();' value="0"></td>
					</div>
					</div>	
                    <div class="col-md-6 "  >			
					<div class="form-group" >
					  <label > Other Deduction Remark :</label>
					  <td><input type="text" name="level_other_deduction_remark11" class="form-control" placeholder="PF Amount" value="None"></td>
					</div>
					</div>
					
					<div class="col-md-6 "  >			
					<div class="form-group" >
					  <label>Salary Generate date</label>
					  <td><input type="date" name="salery_generate_date" class="form-control" value="<?php echo date('Y-m-d');?>"></td>
					</div>
					</div>
					
 
					<div class="col-md-6 ">				
					<div class="form-group" >
					  <label  > Payment Mode :</label>
					  <td>
					  <select name="salary_payment_mode" class="form-control" onchange="payment_mode(this.value);" required >
			
					  <option value="Cash"> Cash </option>
					  <option value="Cheque"> Cheque </option>
					  <option value="NEFT"> NEFT Net Banking </option>
					  
					  </select>
					  </td>
					</div>
					</div>
					
					
					
					<div class="col-md-6 " id="for_cheque_name" style="display:none;">				
					<div class="form-group" >
					  <label  > Bank Name :</label>
					  <td><input type="text" name="cheque_bank_name" class="form-control" placeholder="Bank Name" value="<?php echo $emp_bank_name; ?>"></td>
					</div>
					</div>
					<div class="col-md-6 " id="for_cheque_no" style="display:none;">				
					<div class="form-group" >
					  <label  > Cheque No .</label>
					  <td><input type="text" name="cheque_no" class="form-control" placeholder="Cheque No." value=""></td>
					</div>
					</div>
					<div class="col-md-6 " id="for_cheque_date" style="display:none;">				
					<div class="form-group" >
					  <label  > Cheque Date :</label>
					  <td><input type="date" name="cheque_date" class="form-control" placeholder="Cheque Date" value="<?php echo date('Y-m-d'); ?>"></td>
					</div>
					</div>
					<div class="col-md-6 " id="for_neft_bank_name" style="display:none;">				
					<div class="form-group" >
					  <label  > Bank Name </label>
					  <td><input type="text" name="neft_bank_name" class="form-control" placeholder="Bank Name" value="<?php echo $emp_bank_name; ?>"></td>
					</div>
					</div>
					<div class="col-md-6 " id="for_neft_account_no" style="display:none;">				
					<div class="form-group" >
					  <label  > Account No .</label>
					  <td><input type="text" name="neft_bank_account_no" class="form-control" placeholder="Account No." value="<?php echo $emp_account_no; ?>"></td>
					</div>
					</div>
					<div class="col-md-2 ">				
					<div class="form-group" >
					  
					</div>
					</div>
				
				  </div>
				  </div>
				  				  		  <div class="panel panel-default">
					<div class="panel-body">
					<div class="col-md-12 ">
					<div class="form-group" >
					  <h3 align="center"> Salary Detail </h3>
					  <hr style="border-top: 1px solid #616465;">
					</div>
					</div>
				  <table  class="table table-bordered table-striped">
                <thead >
				<tr>
                  <th> S No </th>
                  <th>Description</th>
                  <th> Amount </th>
                </tr>
                </thead>
                <tbody>
				<tr>
				<td>A</td>
				<td>Basic Salary:</td>
				<td > <label id='level_basic_salary' ></label><input type='hidden' name="level_basic_salary11" id="level_basic_salary11" ></td>
				</tr>
				<tr>
				<td>B</td>
				<td>Day in Month</td>
				<td > <label id='level_days_in_month' ></label><input type='hidden' name="level_days_in_month11" id="level_days_in_month11" ></td>
				</tr>
				<tr>
				<td>C</td>
			<td>Per Day Salary<b>(A/B)</b></td>
				<td > <label id='level_per_day_salary' ></label><input type='hidden' name="level_per_day_salary11" id="level_per_day_salary11" ></td>
				</tr>
				<tr>
				<td>C</td>
				 <td>Working Days</td>
				<td > <label id='level_working_days' ></label><input type='hidden' name="level_working_days11" id="level_working_days11" ></td>
				</tr>
				<tr>
				<td>D</td>
				<td>Total Days</td>
				<td > <label id='level_total_days1' ></label><input type='hidden' name="level_total_days11" id="level_total_days11" ></td>
				</tr>
		  
				<tr>
				<td>E</td>
			<td>Absent</td>
				<td > <label id='level_total_absent' ></label><input type='hidden' name="level_total_absent11" id="level_total_absent11" ></td>
				</tr>
		<tr>
				<td>F</td>
			<td>Present</td>
				<td > <label id='level_total_present' ></label><input type='hidden' name="level_total_present11" id="level_total_present11" ></td>
				</tr>
			<tr>
			<td>G</td>
			<td>Leave</td>
				<td > <label id='level_total_leave' ></label><input type='hidden' name="level_total_leave11" id="level_total_leave11" ></td>
				</tr>
			<tr>
				<td>H</td>
			<td>Sunday</td>
				<td > <label id='level_total_sunday' ></label><input type='hidden' name="level_total_sunday11" id="level_total_sunday11" ></td>
				</tr>
			<tr>
				<td>I</td>
			<td>Holiday</td>
				<td > <label id='level_total_holiday' ></label><input type='hidden' name="level_total_holiday11" id="level_total_holiday11" ></td>
				</tr>
				<tr>
				<td>J</td>
			<td>Salary Days<b>(D-E)</b></td>
				<td > <label id='level_salary_days' ></label><input type='hidden' name="level_salary_days11" id="level_salary_days11" ></td>
				</tr>
						<tr>
				<td>K</td>
			<td>Professional tax</td>
				<td > <label id='level_ptax_deduction' ></label><input type='hidden' name="level_ptax_deduction11" id="level_ptax_deduction11" ></td>
				</tr>
						<tr>
				<td>L</td>
			<td>TDS</td>
				<td > <label id='level_tds_deduction' ></label><input type='hidden' name="level_tds_deduction11" id="level_tds_deduction11" ></td>
				</tr>
						<tr>
				<td>M</td>
			<td>PF Amount</td>
				<td > <label id='level_pf_deduction' ></label><input type='hidden' name="level_pf_deduction11" id="level_pf_deduction11" ></td>
				</tr>
				<tr>
				<td>N</td>
			<td>ESIC Amount</td>
				<td > <label id='level_esic_deduction' ></label><input type='hidden' name="level_esic_deduction11" id="level_esic_deduction11" ></td>
				</tr>
				<tr>
							<tr>
				<td>O</td>
			<td>Other Deduction</td>
				<td > <label id='level_other_deduction' ></label><input type='hidden' name="level_other_deduction11" id="level_other_deduction11" ></td>
				</tr>
				<td>P</td>
			<td>Incentive</td>
				<td > <label id='level_total_incentive' ></label><input type='hidden' name="level_total_incentive11" id="level_total_incentive11" ></td>
				</tr>
	
			<tr>
				<td>Q</td>
			<td>Allowance</td>
				<td > <label id='level_allowance' ></label><input type='hidden' name="level_allowance11" id="level_allowance11" ></td>
				</tr>
				<tr>
				<td>R</td>
			<td>Advance</td>
				<td > <label id='level_total_advance' ></label><input type='hidden' name="level_total_advance11" id="level_total_advance11" ></td>
				</tr>
			<tr>
				<td>S</td>
			<td>HRA</td>
				<td > <label id='level_total_hra' ></label><input type='hidden' name="level_total_hra11" id="level_total_hra11" ></td>
				</tr>
						<tr>
				<td>T</td>
				<?php if($_SESSION['software_link']=='lotusvalleyschoolozar'){?>
				<td>Last Year Dues</td>
				<?php  }else{?>
			    <td>DA</td>
			    <?php }?>
				<td > <label id='level_total_da' ></label><input type='hidden' name="level_total_da11" id="level_total_da11" ></td>
				</tr>
				<tr>
				<td>U</td>
			<td>Total Deduction<b>(K+L+M+N+O+R)</b></td>
				<td > <label id='level_total_deduction' ></label><input type='hidden' name="level_total_deduction11" id="level_total_deduction11" ></td>
				</tr>
				<tr>
				<td>V</td>
			<td>Final Salary<b>(C*I+P+Q+S+T-R-U)</b></td>
				<td > <label id='level_final_salary' ></label><input type='hidden' name="level_final_salary11" id="level_final_salary11" ><input type='hidden' id="level_generate_final_salary11" ></td>
				</tr>
				</tbody>
             </table>
					</div>
				  </div>
				  
				  
				</div>
			<div class="col-md-6">
            <input type="checkbox" name="" id="pf_otherway_deduction" onclick="salary_calculation();" /> <b>PF Deduction Based on Attendance</b>
            </div>
				<div class="col-md-6 ">
				  <h2> Attendance Panel </h2>
				  <div class="panel panel-default">
					<div class="panel-body">
					<div class="col-md-12 ">
					<div class="form-group" >
					  <h3 align="center"> ATTENDANCE INFORMATION </h3>
					  <hr style="border-top: 1px solid #616465;">
					</div>
					</div>
				   <div class="col-md-3 ">				
					<div class="form-group" >
					  <center><h4><b> Total Days </b></h4></center>
					  <center><h4 style="color:#3498DB"><b id="for_total_days">0</b></h4></center>
					  <input type="hidden" name="total_total_days" id="total_total_days" class="form-control" value="">
					 	</div>
					</div>
					<div class="col-md-3 ">				
					<div class="form-group" >
					  <center><h4><b>Holiday </b></h4></center>
					  <center><h4 style="color:#922B21"><b id="for_holiday">0</b></h4></center>
					  <input type="hidden" oninput='salary_calculation();' name="total_holiday" id="total_holiday" class="form-control" value="">
					</div>
					</div>
					<div class="col-md-3 ">				
					<div class="form-group" >
					  <center><h4><b>Sunday </b></h4></center>
					  <center><h4 style="color:#E67E22"><b id="for_sunday">0</b></h4></center>
					  <input type="hidden" name="total_sunday" oninput='salary_calculation();' id="total_sunday" class="form-control" value="">
					</div>
					</div>
					<div class="col-md-3 ">				
					<div class="form-group" >
					  <center><h4><b>Working</b></h4></center>
					  <center><h4 style="color:#E67E22"><b id="for_working_days">0</b></h4></center>
					  <input type="hidden" oninput='salary_calculation();'  name="total_working_days" id="total_working_days" class="form-control" value="">
					</div>
					</div>
					<div class="col-md-3 ">				
					<div class="form-group" >
					  <center><h4><b>Present </b></h4></center>
					  <center><h4 style="color:#3498DB"><b id="for_present">0</b></h4></center>
					  <input type="text" oninput='salary_calculation();' name="total_present" id="total_present" class="form-control" value="">
					</div>
					</div>
					<div class="col-md-3 ">				
					<div class="form-group" >
					  <center><h4><b>Absent </b></h4></center>
					  <center><h4 style="color:#922B21"><b id="for_absent">0</b></h4></center>
					  <input type="text" oninput='salary_calculation();' name="total_absent" id="total_absent" class="form-control" value="">
					</div>
					</div>
					<div class="col-md-3 ">				
					<div class="form-group" >
					  <center><h4><b>Leave </b></h4></center>
					  <center><h4 style="color:#E67E22"><b id="for_leave">0</b></h4></center>
					  <input type="text" oninput='salary_calculation();' name="total_leave" id="total_leave" class="form-control" value="">
					</div>
					</div>
					<div class="col-md-3 ">				
					<div class="form-group" >
					  <center><h4><b> Salary Days </b></h4></center>
					  <center><h4 style="color:#E67E22"><b id="for_salary_days">0</b></h4></center>
					  <input type="text" name="salary_days" readonly id="salary_days" class="form-control" value="">
					</div>
					</div>
					<div class="col-md-3 ">				
					<div class="form-group" >
					  <center><h4><b> Days in Month</b></h4></center>
					   <input type="number" name="total_days_in_month" id="total_days_in_month" class="form-control" oninput='salary_calculation();' value="">
					</div>
					</div>
					<div class="col-md-8 " style="display:none">				
					<div class="form-group" >
					  <label  > Verify Total Leaves :</label>
					  <td><input type="number" name="verify_total_leaves" id="verify_total_leaves" class="form-control" placeholder="Total Leaves" value="0" oninput="check_leave(this.value);" readonly></td>
					</div>
					</div>
					
					<div class="col-md-4 " style="display:none">				
					<div class="form-group" >
					  <br/>
					  <input type="radio" name="leave_verification" value="verify" onclick="for_leave(this.value);">  Verify <br>
					  <input type="radio" name="leave_verification" value="not_verify" onclick="for_leave(this.value);" checked>  Not Verify 
					</div>
					</div>
					
					</div>
				  </div>
				  
				  
				  <div class="panel panel-default">
					<div class="panel-body">
					<div class="col-md-12 ">
					<div class="form-group" >
					  <h3 align="center"> LEAVE INFORMATION </h3>
					  <hr style="border-top: 1px solid #616465;">
					</div>
					</div>
					
					<div class="col-md-3">				
					<div class="form-group" >
					  <center><h5><b> Casual Leave </b></h5></center>
					  <center><h4 style="color:#E67E22"><b><?php echo $emp_leave_cl; ?></b></h4></center>
					</div>
					</div>
					
					<div class="col-md-3">				
					<div class="form-group" >
					  <center><h5><b> Pay/Earn Leave </b></h5></center>
					  <center><h4 style="color:#E67E22"><b><?php echo $emp_leave_pl; ?></b></h4></center>
					</div>
					</div>
					
					<div class="col-md-3">				
					<div class="form-group" >
					  <center><h5><b> Sick Leave </b></h5></center>
					  <center><h4 style="color:#E67E22"><b><?php echo $emp_leave_sl; ?></b></h4></center>
					</div>
					</div>
					
					<div class="col-md-3">				
					<div class="form-group" >
					  <center><h5><b> Other Leave </b></h5></center>
					  <center><h4 style="color:#E67E22"><b><?php echo $emp_leave_other; ?></b></h4></center>
					</div>
					</div>
					
					</div>
				  </div>
				  
				  
				  		  <div class="panel panel-default">
					<div class="panel-body">
					<div class="col-md-12 ">
					<div class="form-group" >
					  <h3 align="center"> OTHER INFORMATION </h3>
					  <hr style="border-top: 1px solid #616465;">
					</div>
					</div>
				  <table id="example1" class="table table-bordered table-striped">
                <thead >
				<tr>
                  <th> S No </th>
                  <th> Date </th>
                  <th> Description </th>
                </tr>
                </thead>
                <tbody id="my_table">
				  
				</tbody>
             </table>
					</div>
				  </div>
				</div>
				
				
		<div class="col-md-12">
		        <center><button type="submit" name="submit" class="btn btn-success"> Submit </button></center>
		</div>
	</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
    </div>
    </div>
</section>
</form>
 