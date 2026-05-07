<?php include("../attachment/session.php"); ?>

<script>
function for_total(serial){
var amount=$("#amount"+serial).val();
var discount=$("#discount"+serial).val();
var paid=$("#paid"+serial).val();

if(amount==""){
    amount=0;
}if(discount==""){
    discount=0;
}if(paid==""){
    paid=0;
}
var after_discount=amount-discount;
var balance=after_discount-paid;
$("#after_discount"+serial).val(after_discount);
$("#balance"+serial).val(balance);

	var total_amount = 0;
	$('.amount').each(function() {
	total_amount += Number($(this).val());
	});
	$('#total_amount').html(total_amount);
	$('#total_amount1').val(total_amount);

var total_discount = 0;
	$('.discount').each(function() {
	total_discount += Number($(this).val());
	});
	$('#total_discount').html(total_discount);
var total_after_discount = 0;
	$('.after_discount').each(function() {
	total_after_discount += Number($(this).val());
	});
	$('#total_after_discount').html(total_after_discount);
var total_paid = 0;
	$('.paid').each(function() {
	total_paid += Number($(this).val());
	});
	$('#total_paid').html(total_paid);
	$('#total_paid1').val(total_paid);
var total_balance = 0;
	$('.balance').each(function() {
	total_balance += Number($(this).val());
	});
	$('#total_balance').html(total_balance);
	$('#total_balance1').val(total_balance);





}



$("#my_form").submit(function(e){
e.preventDefault();

var formdata = new FormData(this);
window.scrollTo(0, 0);
    $("#my_loader").html(loader_div);
$.ajax({
	url: access_link+"fees_monthly/transport_fees_student_list_edit_api.php",
	type: "POST",
	data: formdata,
	mimeTypes:"multipart/form-data",
	contentType: false,
	cache: false,
	processData: false,
	success: function(detail){
	     $("#my_loader").html('');
	   var res=detail.split("|?|");
	   if(res[1]=='success'){
		   alert_new('Successfully Complete...','green');
	}
	}
 });
});
</script>

    <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1>
        Fees Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> <?php echo $language['Home']; ?></a></li>
	  <li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
	  <li class="active">Transport Fees Edit</li>
      </ol>
      </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
			
            <div class="box-body">
			
		<form method="post" enctype="multipart/form-data" id="my_form">
		
            <div class="box-body">
                <div id="my_loader"></div>
           <?php
$que1="select * from school_info_monthly_transport_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$fees_type_name[] = $row1['fees_type_name'];	
$fees_code[] = $row1['fees_code'];
$fees_count = $row1['fees_count'];
}
$student_roll_no=$_GET['student_roll_no'];
$que2="select * from student_admission_info where student_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
$run2=mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
$student_serial_no=0;
while($row2=mysqli_fetch_assoc($run2)){
$student_name = $row2['student_name'];
$student_father_name = $row2['student_father_name'];
$student_class = $row2['student_class'];
$student_roll_no = $row2['student_roll_no'];
$student_bus_fee_category_code = $row2['student_bus_fee_category_code'];
$student_bus_fee_category = $row2['student_bus_fee_category'];
?>
	<div class="col-md-3">				
				<div class="form-group">
                  <label>Student Name</label>
                  <input type="text"   value="<?php echo $student_name; ?>"  class="form-control " readonly />
                </div>
				</div>
					<div class="col-md-3">				
				<div class="form-group">
                  <label>Father Name</label>
                  <input type="text"   value="<?php echo $student_father_name; ?>"  class="form-control " readonly />
                </div>
				</div>
					<div class="col-md-3">				
				<div class="form-group">
                  <label>Student CLass</label>
                  <input type="text"   value="<?php echo $student_class; ?>"  class="form-control " readonly />
                </div>
				</div>	<div class="col-md-3">				
				<div class="form-group">
                  <label>Bus Stop</label>
                  <input type="text"   value="<?php echo $student_bus_fee_category; ?>"  class="form-control " readonly />
                </div>
				</div>
<table class="table table-responsive">
<thead class="my_background_color">
<tr>
<th>S no</th>
<th>Fees Month</th>
<th>Amount</th>
<th>Disount</th>
<th>After Discount</th>
<th>Paid</th>
<th>Balance</th>
</tr>
</thead>
<tbody>
<?php

 $query11="select * from common_fees_student_transport_fee where fee_status='Active' and session_value='$session1' and student_roll_no='$student_roll_no'";
$result11=mysqli_query($conn73,$query11) or die(mysqli_error($conn73));
if(mysqli_num_rows($result11)>0){

$total_amount = 0;
$total_discount = 0;
$total_after_discount = 0;
$total_paid = 0;
$total_balance = 0;
while($row3=mysqli_fetch_assoc($result11)){
    $s_no_hidden=$row3['s_no'];
    
    $student_previous_year_fee = $row3['student_previous_year_fee'];
    $student_previous_year_fee_balance = $row3['student_previous_year_fee_balance'];
    $student_previous_year_fee_paid_total = $row3['student_previous_year_fee_paid_total'];
    
   if($student_previous_year_fee_paid_total==0){
    $student_previous_year_fee_paid_total=0;
}  if($student_previous_year_fee==0){
    $student_previous_year_fee=0;
} if($student_previous_year_fee_balance==0){
    $student_previous_year_fee_balance=0;
} 
    
for($ab=0;$ab<$fees_count;$ab++){

$amount=$row3['transport_fee_month'.$fees_code[$ab]];
$discount=$row3['transport_fee_discount_amount_month'.$fees_code[$ab]];
$after_discount=$row3['transport_fee_amount_after_discount_month'.$fees_code[$ab]];
$paid=$row3['transport_fee_paid_month'.$fees_code[$ab]];
$balance=$row3['transport_fee_balance_month'.$fees_code[$ab]];
if($discount==0){
    $discount=0;
}if($paid==0){
    $paid=0;
}

$total_amount = $total_amount+$amount;
$total_discount = $total_discount+$discount;
$total_after_discount = $total_after_discount+$after_discount;
$total_paid = $total_paid+$paid;
$total_balance = $total_balance+$balance;
?>
<tr>
<td><?php echo $ab+1; ?></td>
<td><?php echo $fees_type_name[$ab]; ?></td>
<td><input type="number" name="amount[<?php echo $ab; ?>]" id="amount<?php echo $ab; ?>" oninput="for_total('<?php echo $ab; ?>');" value="<?php echo $amount; ?>"  class="form-control amount" min="<?php echo $paid; ?>" />
<input type="hidden" name="installment[<?php echo $ab; ?>]" value="<?php echo $fees_code[$ab]; ?>"   /></td>
<td><input type="number" name="discount[<?php echo $ab; ?>]" id="discount<?php echo $ab; ?>" oninput="for_total('<?php echo $ab; ?>');" value="<?php echo $discount; ?>"  class="form-control discount" /></td>
<td><input type="text" name="after_discount[<?php echo $ab; ?>]" id="after_discount<?php echo $ab; ?>"  value="<?php echo $after_discount; ?>"  class="form-control after_discount" readonly/></td>
<td><input type="text" name="paid[<?php echo $ab; ?>]" id="paid<?php echo $ab; ?>"  value="<?php echo $paid; ?>"  class="form-control paid" readonly/></td>
<td><input type="text" name="balance[<?php echo $ab; ?>]" id="balance<?php echo $ab; ?>"  value="<?php echo $balance; ?>"  class="form-control balance" readonly/></td>
</tr>
<?php  } } }  ?>
<tr>
<td><?php echo $ab+1; ?></td>
<td>Previous Year Fees</td>
<td><input type="number" name="student_previous_year_fee" id="amount100" oninput="for_total(100);" value="<?php echo $student_previous_year_fee; ?>"  class="form-control amount" min="<?php echo $student_previous_year_fee_paid_total; ?>" />
</td>
<td><input type="text"  id="discount100"  value="0"  class="form-control discount" readonly/></td>
<td><input type="text"  id="after_discount100"  value="<?php echo $student_previous_year_fee; ?>"  class="form-control after_discount" readonly/></td>
<td><input type="text" name="student_previous_year_fee_paid_total" id="paid100"  value="<?php echo $student_previous_year_fee_paid_total; ?>"  class="form-control paid" readonly/></td>
<td><input type="text" name="student_previous_year_fee_balance" id="balance100"  value="<?php echo $student_previous_year_fee_balance; ?>"  class="form-control balance" readonly/></td>
</tr>
<tr>
<td></td>
<th>Total</th>
<th id="total_amount"><?php echo $total_amount;?></th>
<th id="total_discount"><?php echo $total_discount;?></th>
<th id="total_after_discount"><?php echo $total_after_discount;?></th>
<th id="total_paid"><?php echo $total_paid;?></th>
<th id="total_balance"><?php echo $total_balance;?></th>

                  <input type="hidden"   value="<?php echo $s_no_hidden; ?>" name="s_no_hidden" class="form-control " readonly />
 <input type="hidden"   value="<?php echo $total_amount; ?>" name="total_amount" class="form-control "  id="total_amount1" readonly />
 <input type="hidden"   value="<?php echo $total_paid; ?>" name="total_paid" class="form-control "  id="total_discount1"   readonly />
 <input type="hidden"   value="<?php echo $total_balance; ?>" name="total_balance" class="form-control "  id="total_balance1"  readonly />
            
            
            
</tr>
<?php  }   ?>
</tbody>
</table>
			<div class="col-md-12">
			<center><input type="submit" name="finish" value="Save Fee" onclick="return validate();" class="btn  my_background_color" /></center>
			</div>
			</div>
			</div>
	
		</form>	

    </div>
</section>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>