<!DOCTYPE html><?php include("../attachment/session.php")?>
<html>
<head>
 
<?php include("../attachment/link_css.php")?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>
  <?php include("../../con73/con37.php")?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $language['Fees Management']; ?>
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
		<li><a href="fees.php"><i class="fa fa-money"></i> <?php echo $language['Fees']; ?></a></li>
        <li class="active"><?php echo $language['Student Fee Add']; ?></li>
      </ol>
    </section>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	
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
					  <select name="" class="form-control select2" id="selected_student" style="width:100%;" required>
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
							?>
							<option <?php if (isset($_GET['student_roll_no'])) { if($_GET['student_roll_no']==$student_roll_no3){ echo 'selected';} } ?> value="<?php echo $student_roll_no3; ?>"><?php echo $student_name3."[".$school_roll_no3."]-"."[".$student_class3."-".$student_section3."]-[".$student_father_name3."-".$student_father_contact_number3."]"; ?></option>
							<?php
							}
							?>
					  </select>
					</div>
			</div>
			<div class="col-md-8">
			 <?php
			 if (isset($_GET['fee_month'])){
			 $month=$_GET['fee_month'];
			 $month_strcount1=substr_count($month,',');
			 $month1='';
			 $month2='';
			 $month3='';
			 $month4='';
			 $month5='';
			 $month6='';
			 $month7='';
			 $month8='';
			 $month9='';
			 $month10='';
			 $month11='';
			 $month12='';
			 if($month_strcount1>0){
			 $month_exp=explode(',',$month);
			 $month_count=count($month_exp);
			 for($f=0;$f<$month_count;$f++){
			 if($month_exp[$f]=='01'){
			 $month1='01';
			 }elseif($month_exp[$f]=='02'){
			 $month2='02';
			 }elseif($month_exp[$f]=='03'){
			 $month3='03';
			 }elseif($month_exp[$f]=='04'){
			 $month4='04';
			 }elseif($month_exp[$f]=='05'){
			 $month5='05';
			 }elseif($month_exp[$f]=='06'){
			 $month6='06';
			 }elseif($month_exp[$f]=='07'){
			 $month7='07';
			 }elseif($month_exp[$f]=='08'){
			 $month8='08';
			 }elseif($month_exp[$f]=='09'){
			 $month9='09';
			 }elseif($month_exp[$f]=='10'){
			 $month10='10';
			 }elseif($month_exp[$f]=='11'){
			 $month11='11';
			 }elseif($month_exp[$f]=='12'){
			 $month12='12';
			 }
			 //$month_array_var[$f]=$month_exp[$f];
			 }
			 }else{
			 if($month=='01'){
			 $month1='01';
			 }elseif($month=='02'){
			 $month2='02';
			 }elseif($month=='03'){
			 $month3='03';
			 }elseif($month=='04'){
			 $month4='04';
			 }elseif($month=='05'){
			 $month5='05';
			 }elseif($month=='06'){
			 $month6='06';
			 }elseif($month=='07'){
			 $month7='07';
			 }elseif($month=='08'){
			 $month8='08';
			 }elseif($month=='09'){
			 $month9='09';
			 }elseif($month=='10'){
			 $month10='10';
			 }elseif($month=='11'){
			 $month11='11';
			 }elseif($month=='12'){
			 $month12='12';
			 }
			 $month_exp[]=$month;
			 }
			 }
			 ?>
			
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="04" <?php if (isset($_GET['fee_month'])){ if($month4=='04'){ echo 'checked'; } } ?> onclick="call_me();" > April Month / <span style="color:red;font-weight:bold;" id="dues_04">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="05" <?php if (isset($_GET['fee_month'])){ if($month5=='05'){ echo 'checked'; } } ?> onclick="call_me();" > May Month / <span style="color:red;font-weight:bold;" id="dues_05">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="06" <?php if (isset($_GET['fee_month'])){ if($month6=='06'){ echo 'checked'; } } ?> onclick="call_me();" > June Month / <span style="color:red;font-weight:bold;" id="dues_06">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="07" <?php if (isset($_GET['fee_month'])){ if($month7=='07'){ echo 'checked'; } } ?> onclick="call_me();" > July Month / <span style="color:red;font-weight:bold;" id="dues_07">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="08" <?php if (isset($_GET['fee_month'])){ if($month8=='08'){ echo 'checked'; } } ?> onclick="call_me();" > August Month / <span style="color:red;font-weight:bold;" id="dues_08">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="09" <?php if (isset($_GET['fee_month'])){ if($month9=='09'){ echo 'checked'; } } ?> onclick="call_me();" > September Month / <span style="color:red;font-weight:bold;" id="dues_09">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="10" <?php if (isset($_GET['fee_month'])){ if($month10=='10'){ echo 'checked'; } } ?> onclick="call_me();" > October Month / <span style="color:red;font-weight:bold;" id="dues_10">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="11" <?php if (isset($_GET['fee_month'])){ if($month11=='11'){ echo 'checked'; } } ?> onclick="call_me();" > November Month / <span style="color:red;font-weight:bold;" id="dues_11">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="12" <?php if (isset($_GET['fee_month'])){ if($month12=='12'){ echo 'checked'; } } ?> onclick="call_me();" > December Month / <span style="color:red;font-weight:bold;" id="dues_12">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox"  id="" class="fee_month" value="01" <?php if (isset($_GET['fee_month'])){ if($month1=='01'){ echo 'checked'; } } ?> onclick="call_me();" > January Month / <span style="color:red;font-weight:bold;" id="dues_01">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="02" <?php if (isset($_GET['fee_month'])){ if($month2=='02'){ echo 'checked'; } } ?> onclick="call_me();" > February Month / <span style="color:red;font-weight:bold;" id="dues_02">0</span>
			</div>
			<div class="col-md-3">
			<input type="checkbox" id="" class="fee_month" value="03" <?php if (isset($_GET['fee_month'])){ if($month3=='03'){ echo 'checked'; } } ?> onclick="call_me();" > March Month / <span style="color:red;font-weight:bold;" id="dues_03">0</span>
			</div>
			</div>
		</div>
			
		<div class="box-body col-md-12" style="border:1px solid;">
		<center><h4 style="color:red;">Pay Other Fee</h4></center>
            <table>
			<thead>
			<tr>
			<td>#</td>
			<td>Fee Name</td>
			<td>Amount</td>
			</tr>
			</thead>
			<tbody id="my_table">
			<td>1.</td>
			<td><input type="text" name="fee_name[]" id="fee_name_1" /></td>
			<td><input type="text" name="fee_amount[]" id="fee_amount_1" /></td>
			</tbody>
			<tfoot>
			<td colspan="2"><span style="font-weight:bold;float:right;">Grand Total = </span></td>
			<td><span id="grand_total">0</span></td>
			</tfoot>
            </table>
		</div>
		  

		</div>

		
		        <div class="box-body">
			       <div class="col-md-12">
		            <center><input type="submit" name="finish" value="<?php echo $language['Fee Submit']; ?>" class="btn  my_background_color" /></center>
		           </div>
			    </div>

</div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
  </div>
</div>
</section>
  <?php
  
    if(isset($_POST['finish'])){
    
	$fee_submission_date = $_POST['fee_submission_date'];
	$student_name = $_POST['student_name'];
	$student_father_name = $_POST['student_father_name'];
	$student_roll_no = $_POST['student_roll_no'];
	$student_class = $_POST['student_class'];
	$student_class_section = $_POST['student_class_section'];
	$student_payment_mode = $_POST['student_payment_mode'];
	$cheque_bank_name = $_POST['cheque_bank_name'];
	$send_sms = $_POST['send_sms'];
	$sms = $_POST['sms'];
	$student_sms_contact_number = $_POST['student_sms_contact_number'];
	$cheque_no = $_POST['cheque_no'];
	$cheque_date = $_POST['cheque_date'];
	$neft_bank_name = $_POST['neft_bank_name'];
	$neft_bank_account_no = $_POST['neft_bank_account_no'];
	//---student_admission_fee using as panalty start---//
	$penalty_fee = $_POST['penalty_fee'];
	$penalty_fee_paid = $penalty_fee+$penalty_amount;	
	//---student_admission_fee using as panalty end---//
	//---Transport Fee start---//
	$student_transport_fee = $_POST['student_transport_fee'];
	$student_transport_fee_balance1 = $_POST['student_transport_fee_balance'];
	$transport_fee_paid = $_POST['transport_fee_paid'];
	$transport_fee_paid1 = $transport_fee_paid+$student_transport_fee_paid_total;
	$student_transport_fee_balance=$student_transport_fee_balance1-$transport_fee_paid;
	//---Transport Fee End---//
	$grand_total = $_POST['grand_total'];
	$total_paid = $_POST['total_paid'];
	$paid_total = $paid_total+$total_paid;
	$balance_total = $_POST['balance_total'];
	$balance_total = $balance_total+$penalty_fee-$total_paid;
	
	$fee_receipt_no = $_POST['fee_receipt_no'];
	$fee_receipt_no1 = $fee_receipt_no+1;
	
	$column_name="";
	$insert_column_name="";
	$insert_column_value="";
	
	for($n=0;$n<$month_count111;$n++){
    for($i=0;$i<$serial_no;$i++){
	
	$fee2[$i] = $_POST[$fee[$i].$month_exp[$n]];	
	$fee_balance2[$i] = $_POST[$fee_balance[$i].$month_exp[$n]];
	$fee_paid2[$i] = $_POST[$fee_paid[$i].$month_exp[$n]];
    $fee_paid1[$i][$n] = $fee_paid1[$i][$n]+$fee_paid2[$i];	
	$fee_balance2[$i] = $fee_balance2[$i]-$fee_paid2[$i];

	$column_name=$column_name.$total_amount_after_discount[$i].$month_exp[$n]."="."'".$fee2[$i]."',".$fee_balance[$i].$month_exp[$n]."="."'".$fee_balance2[$i]."',".$fee_paid[$i].$month_exp[$n]."="."'".$fee_paid1[$i][$n]."',";
	
	$insert_column_name=$insert_column_name.$total_amount_after_discount[$i].$month_exp[$n].",".$fee_balance[$i].$month_exp[$n].",".$fee_paid[$i].$month_exp[$n].",";    
	$insert_column_value=$insert_column_value."'".$fee2[$i]."','".$fee_balance2[$i]."','".$fee_paid2[$i]."',";
	
	}
	}
	
	$path_to_fcm = "https://fcm.googleapis.com/fcm/send";
       									
												$que="select * from login";
												$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
												
												while($row=mysqli_fetch_assoc($run)){

													 $server_key=$row['blank_field_4'];
													}
											
 $que = "select fcm_token from fcm_info where roll_number='$student_roll_no'";
        $run = mysqli_query($conn73,$que);
        $row = mysqli_fetch_assoc($run);
        $fcm_token= $row['fcm_token'];
       
        
         $headers = array
			(
				'Authorization: key='. $server_key,
				'Content-Type: application/json'
			);
			$fields = array
			(
				'to'=> $fcm_token,
				'notification'=> array('title'=>"Fee",'body'=>$total_paid)
			);
			$payload  = json_encode($fields);
			$curl_session = curl_init();
			curl_setopt( $curl_session,CURLOPT_URL,$path_to_fcm );
		    curl_setopt( $curl_session,CURLOPT_POST, true );
			curl_setopt( $curl_session,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $curl_session,CURLOPT_RETURNTRANSFER, true );
			curl_setopt ($curl_session, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt( $curl_session,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $curl_session,CURLOPT_POSTFIELDS, $payload);
			
			$result = curl_exec($curl_session);
 
			curl_close($curl_session);
	
	
	

	$quer22="insert into common_fees_student_fee_add($insert_column_name fee_submission_date,student_name,student_father_name,student_roll_no,student_class,student_class_section,grand_total,balance_total,paid_total,student_payment_mode,cheque_bank_name,cheque_no,cheque_date,neft_bank_name,neft_bank_account_no,session_value,blank_field_5,student_transport_fee,student_transport_fee_balance,student_transport_fee_paid_total,penalty_amount,fee_paid_months) values($insert_column_value '$fee_submission_date','$student_name','$student_father_name','$student_roll_no','$student_class','$student_class_section','$grand_total','$balance_total','$total_paid','$student_payment_mode','$cheque_bank_name','$cheque_no','$cheque_date','$neft_bank_name','$neft_bank_account_no','$session1','$fee_receipt_no','$student_transport_fee','$student_transport_fee_balance','$transport_fee_paid','$penalty_fee','$month')";
  
    $quer1="update common_fees_student_fee set $column_name grand_total='$grand_total',balance_total='$balance_total',paid_total='$paid_total',student_transport_fee='$student_transport_fee',student_transport_fee_balance='$student_transport_fee_balance',student_transport_fee_paid_total='$transport_fee_paid1',penalty_amount='$penalty_fee_paid' where student_roll_no='$student_roll_no'";
    mysqli_query($conn73,$quer1);
	
	$quer11="update login set blank_field_5='$fee_receipt_no1'";
    mysqli_query($conn73,$quer11);
	
	$query="insert into ledger_info (emp_id_or_student_roll_no,emp_or_student_name,date,amount_type,payment_mode,total_amount,credit_or_debit_from,session_value) values('$student_roll_no','$student_name','$fee_submission_date','Credit','$student_payment_mode','$total_paid','fee','$session1')";
    mysqli_query($conn73,$query);
    if(mysqli_query($conn73,$quer22)){
		if($send_sms=="Yes"){
		include("../sms/sms.php");
		sendDNDSMS($student_sms_contact_number,$sms);	
		}
		
		echo "<script>alert('successfully Paid Fee amount $paid_total');</script>";
		echo "<script>window.open('student_fee_list.php?student_roll_no=$student_roll_no','_self')</script>";
	}
    }
  
  ?>
	

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 </div>
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
 <?php include("../attachment/link_js.php")?>
</body>
</html>
<script>
  $(function () {
    $('.select2').select2()
  })
</script>
<script>
for_dues1();
</script>