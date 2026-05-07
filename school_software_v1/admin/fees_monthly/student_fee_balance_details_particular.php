<?php include("../attachment/session.php"); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:get_content('index_content')"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="javascript:get_content('fees_monthly/fees')"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
		<li><a href="javascript:get_content('fees_monthly/student_fee_balance_details')"><i class="fa fa-money"></i> Balance Details</a></li>
        <li class="active">Balance Details Particular</li>
      </ol>
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
for_details();
}

function for_details(){
	var student_roll_no=document.getElementById('student_roll_no').value;
	var month_code = [];
	var month_name = [];
	$(".my_check").each(function() {
	if($(this).prop("checked") == true){
	month_code.push($(this).val());
	month_name.push($(this).attr('id'));
	}
	});
	$("#particular_details").html(loader_div);
	if(month_code!='' && month_name!=''){
	$.ajax({
	type: "POST",
	url: access_link+"fees_monthly/ajax_student_fee_balance_details_particular.php",
	data: {student_roll_no:student_roll_no,month_code:month_code,month_name:month_name},
	cache: false,
	success: function(detail){
	// alert(detail);
	$("#particular_details").html(detail);
	}
	});
	}else{
	$("#particular_details").html('');
	}
}

function for_pay(){
    var student_roll_no=document.getElementById('student_roll_no').value;
    var fee_month = '';
	$(".my_check").each(function() {
	if($(this).prop("checked") == true){
	if(fee_month!=''){
	fee_month=fee_month+','+$(this).val();
	}else{
	fee_month=$(this).val();
	}
	}
	});
    if(student_roll_no!='' && fee_month!='') {
    post_content('fees_monthly/student_fee_add_form','student_roll_no='+student_roll_no+'&fee_month='+fee_month);
    }
}
</script>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->			
        <div class="box-body">
		
		<div class="box-body  col-md-12">
		<div class="col-md-3">&nbsp;</div>
		<div class="col-md-7">
		<?php
		$student_roll_no=$_GET['student_roll_no'];
		
		$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
		$run01=mysqli_query($conn73,$que01);
		$a=0;
		while($row01=mysqli_fetch_assoc($run01)){
		$fees_code[$a] = $row01['fees_code'];
		$fees_type_name[$a] = $row01['fees_type_name'];
		?>
		<div class="col-md-4">
			<input type="checkbox" id="<?php echo $fees_type_name[$a]; ?>" class="my_check" value="<?php echo $fees_code[$a]; ?>" onclick="for_details();" checked /><span style="font-weight:bold;"> <?php echo $fees_type_name[$a]; ?></span>
		</div>
		<?php $a++; } ?>
		</div>
		<div class="col-md-2">
		<input type="checkbox" name="" id="my_check" onclick="for_check(this.id);" checked /><span style="color:red;font-weight:bold;"> All Check / Uncheck</span>
		<input type="hidden" name="" id="student_roll_no" value="<?php echo $student_roll_no; ?>" />
		</div>
		</div>
		<div class="col-md-12">&nbsp;</div>

		<div class="box-body col-md-10 col-md-offset-1" style="overflow:scroll;border:1px solid;" id="particular_details">

<?php
$que0="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
$run0=mysqli_query($conn73,$que0) or die(mysqli_error($conn73)) ;
$serial_no=0;
while($row0=mysqli_fetch_assoc($run0)){
$s_no=$row0['s_no'];
$fee_type = $row0['fee_type'];
$fee_code = $row0['fee_code'];
if($fee_type!=''){
$fee_type1[$serial_no] = $row0['fee_type'];
$fee_code1[$serial_no] = $row0['fee_code'];
$fee_type=strtolower($fee_type);
$fee[$serial_no]="student_".$fee_code."_month";
$fee_discount_type[$serial_no]="student_".$fee_code."_discount_month";
$fee_discount_method[$serial_no]="student_".$fee_code."_discount_method_month";
$fee_discount_amount[$serial_no]="student_".$fee_code."_discount_amount_month";
$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
$fee_balance[$serial_no]="student_".$fee_code."_balance_month";
$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
$serial_no++;
} }
?>
		
<table id="example1" class="table table-bordered table-striped">
<thead class="my_background_color">
<tr>
  <th>#</th>
  <th><?php echo $language['Student Name']; ?></th>
  <?php for($i=0;$i<$a;$i++){ ?>
  <th><?php echo $fees_type_name[$i].' Balance'; ?></th>
  <?php } ?>
  <th>Transport Balance</th>
  <th>Total Balance</th>
  <th>Action</th>
</tr>
</thead>
<tbody>

<?php
$que1="select * from common_fees_student_fee where session_value='$session1' and fee_status='Active' and student_roll_no='$student_roll_no'";
$run1=mysqli_query($conn73,$que1);
$serial_no1=0;
while($row1=mysqli_fetch_assoc($run1)){
$student_name=$row1['student_name'];
$student_roll_no=$row1['student_roll_no'];
$paid_total=$row1['paid_total'];
$balance_total=$row1['balance_total'];
$grand_total=$row1['grand_total'];
$student_transport_fee_balance=$row1['student_transport_fee_balance'];

$serial_no1++;
?>
<tr>
  <td><?php echo $serial_no1.'.'; ?></td>
  <td><?php echo $student_name; ?></td>
  <?php
  $total_balance=0;
  for($j=0;$j<$a;$j++){
  $monthly_balance[$j]=0;
  for($k=0;$k<$serial_no;$k++){
	  $monthly_balance[$j]=$monthly_balance[$j]+$row1[$fee_balance[$k].$fees_code[$j]];
	  $total_balance=$total_balance+$row1[$fee_balance[$k].$fees_code[$j]];
  }
  ?>
  <td><?php echo $monthly_balance[$j]; ?></td>
  <?php } $total_balance=$total_balance+$student_transport_fee_balance; ?>
  <td><?php echo $student_transport_fee_balance; ?></td>
  <td><?php echo $total_balance; ?></td>
  <td><button type="button" name="" id="" class="btn btn-default my_background_color" onclick="for_pay();">Pay Fee</button></td>
</tr>
<?php } ?>
</tbody>
</table>
		
		</div>
		  
		    
		</div>
		
</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>