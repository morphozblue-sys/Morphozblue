<!DOCTYPE html> <?php include("../attachment/session.php")?>
<html>
<head>
 
 <?php include("../attachment/link_css.php")?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php")?>  <?php include("../attachment/sidebar.php")?>
  <?php include("../../con73/con37.php")?>

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
function total_fee(){
var add = 0;
$('.amt').each(function() {
add += Number($(this).val());
});
document.getElementById('total_paid').value = add;
}

function validate(){
var x = document.forms["myForm"]["total_paid"].value;
    if (x=="" || x<=0) {
        alert("Total Paid amount must be required !!!");
        return false;
    }
}

function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var student_name = document.getElementById("student_name").value;
    var text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
		$('#contact').val('Dear '+student_name+',Your Fee Successfully deposited. Thanking You');
		 $('#send_sms').val('Yes');
    } else {
       text.style.display = "none";
	   $('#contact').val('');
	   $('#send_sms').val('No');
    }
}	
</script>
  
  
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
        <li class="active">Student Fees Edit</li>
      </ol>
    </section>

	
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
	<?php
	$student_roll_no=$_GET['student_roll_no'];
	$que="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1' ";
    $run=mysqli_query($conn73,$que);
    while($row=mysqli_fetch_assoc($run)){
    $student_name=$row['student_name'];
	$student_father_name=$row['student_father_name'];
	$student_father_contact_number=$row['student_father_contact_number'];
	$student_class=$row['student_class'];
	$student_class_section=$row['student_class_section'];
	$student_roll_no=$row['student_roll_no'];
	$school_roll_no=$row['school_roll_no'];
	}
	?>
	
	
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
           
            <!-- /.box-header -->			
        <div class="box-body">
		<br>
    <form name="myForm" method="post" enctype="multipart/form-data" action="" onsubmit="return validate();">
		   
		    <div class="col-md-1">
		    </div>
			
		    <div class="box-body col-md-3">
                <div class="form-group">
                  <label><?php echo $language['Fee Submission Date']; ?></label>
                  <input type="date"  name="fee_submission_date" placeholder=""  value="<?php echo date('Y-m-d'); ?>" class="form-control">
                </div>
			
				<div class="form-group">
                  <label><?php echo $language['Student Name']; ?></label>
                  <input type="text"  name="student_name" id="student_name" placeholder="Student Name"  value="<?php echo $student_name; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label><?php echo $language['Father Name']; ?></label>
                  <input type="text"  name="student_father_name" placeholder="Student Father's Name"  value="<?php echo $student_father_name; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label><?php echo $language['Student Roll No']; ?></label>
                  <input type="hidden"  name="student_roll_no" placeholder="Student Roll No"  value="<?php echo $student_roll_no; ?>" class="form-control" readonly />
				   <input type="text"   placeholder="Student Roll No"  value="<?php echo $school_roll_no; ?>" class="form-control" readonly />
                </div>
			    <div class="form-group">
                  <label><?php echo $language['Class']; ?></label>
                  <input type="text"  name="student_class" placeholder="Student Class"  value="<?php echo $student_class; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label><?php echo $language['Section']; ?></label>
                  <input type="text"  name="student_class_section" placeholder="Student Class section"  value="<?php echo $student_class_section; ?>" class="form-control" readonly />
                </div>
				<div class="form-group">
                  <label><?php echo $language['Payment Mode']; ?></label>
                    <select name="student_payment_mode" class="form-control" onchange="payment_mode(this.value);" required >
			          <option value=""><?php echo $language['Select']; ?></option>  
			          <option value="Cash"><?php echo $language['Cash']; ?></option>
					  <option value="Cheque"><?php echo $language['Cheque']; ?></option>
			          <option value="NEFT"><?php echo $language['NEFT Net Banking']; ?></option>
			        </select>
                </div>
				<div class="form-group" id="for_cheque_name" style="display:none;">
                  <label><?php echo $language['Bank Name']; ?></label>
                  <input type="text"  name="cheque_bank_name" placeholder="Bank Name"  value="" class="form-control">
                </div>
				<div class="form-group" id="for_cheque_no" style="display:none;">
                  <label>Cheque No.</label>
                  <input type="text"  name="cheque_no" placeholder="Cheque No."  value="" class="form-control">
                </div>
				<div class="form-group" id="for_cheque_date" style="display:none;">
                  <label>Cheque Date</label>
                  <input type="date"  name="cheque_date" placeholder="Cheque Date"  value="<?php echo date('Y-m-d'); ?>" class="form-control">
                </div>
				<div class="form-group" id="for_neft_bank_name" style="display:none;">
                  <label><?php echo $language['Bank Name']; ?></label>
                  <input type="text"  name="neft_bank_name" placeholder="Bank Name"  value="" class="form-control">
                </div>
				<div class="form-group" id="for_neft_account_no" style="display:none;">
                  <label><?php echo $language['Account No']; ?></label>
                  <input type="text"  name="neft_bank_account_no" placeholder="Account No."  value="" class="form-control">
                </div>			
			</div>
			<div class="col-md-1">
			</div>
		<div class="box-body col-md-6" style="border:1px solid;">
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
				$fee[$serial_no]="student_".$fee_code."_per_year";
				$fee_balance[$serial_no]="student_".$fee_code."_balance";
				$fee_paid[$serial_no]="student_".$fee_code."_paid_total";
				$total_amount_after_discount[$serial_no]="student_".$fee_code."_total_amount_after_discount";
				$serial_no++;
	            }
				}
			    $que5="select * from common_fees_student_fee where student_roll_no='$student_roll_no'";
				$run1=mysqli_query($conn73,$que5);
                while($row=mysqli_fetch_assoc($run1)){
				$s_no=$row['s_no'];
				$fee_status = $row['fee_status'];
				}
				
				$que="select * from common_fees_student_fee where student_roll_no='$student_roll_no'";
                $run=mysqli_query($conn73,$que);
                while($row=mysqli_fetch_assoc($run)){
				$total_fee=0;
                $student_admission_fee = $row['student_admission_fee'];
				$student_admission_fee_balance = $row['student_admission_fee_balance'];
				$student_admission_fee_paid = $row['student_admission_fee_paid'];
				$grand_total = $row['grand_total'];
				$balance_total = $row['balance_total'];
				$paid_total = $row['paid_total'];
			
					for($i=0;$i<$serial_no;$i++)
					{ 
					   
				        $fee1[$i] = $row[$fee[$i]];
				        $fee_balance1[$i] = $row[$fee_balance[$i]];
						$fee_paid1[$i] = $row[$fee_paid[$i]];
						$total_amount_after_discount1[$i] = $row[$total_amount_after_discount[$i]];
						?>
				
                <div class="col-md-12">						
                <div class="col-md-4">						
				<div class="form-group">
                  <label ><?php echo $fee_type1[$i];?> Fee/ Year</label>
                  <input type="text"  name="<?php echo $fee[$i];?>" placeholder="<?php echo $fee_type1[$i];?>"  value="<?php echo $total_amount_after_discount1[$i];?>" id="" class="form-control fee" oninput="for_total();" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><?php echo $fee_type1[$i];?> Fee Balance/ Year</label>
                  <input type="text"  name="<?php echo $fee_balance[$i];?>" placeholder="0" value="<?php echo $fee_balance1[$i]; ?>" id="" class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><?php echo $fee_type1[$i];?> Fee Paid Amount</label>
                  <input type="number"  name="<?php echo $fee_paid[$i];?>" value="" placeholder="amount" id="" oninput="total_fee();" step="0.01" max="<?php echo $fee_balance1[$i]; ?>" class="form-control amt" />
                </div>
				</div>
				</div>
						
				<?php	}  } ?>
				
				<div class="col-md-12" style="display:none">				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><?php echo $language['Admission Fee']; ?></label>
                  <input type="text"  name="student_admission_fee" value="<?php echo $student_admission_fee;?>" placeholder="Admission Fee" id=""  class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><?php echo $language['Admission Fee Balance']; ?></label>
                  <input type="text"  name="student_admission_fee_balance" value="<?php echo $student_admission_fee_balance;?>" placeholder="Admission Fee Balance" id=""  class="form-control" readonly />
                </div>
				</div>
				
				<div class="col-md-4">				
				<div class="form-group">
                  <label><?php echo $language['Admission Fee Paid Amount']; ?></label>
                  <input type="number"  name="admission_fee_paid" value="" placeholder="<?php echo $language['Admission Fee Paid Amount']; ?>" id="" step="0.01" max="<?php echo $admission_fee_paid; ?>" oninput="total_fee();"  class="form-control amt" >
                </div>
				</div>
		        </div>				
		        </div>
		  
		    <div class="col-md-8">
			 <br/>
			  <div class="col-md-3">
			   <div class="form-group">
                  <label><?php echo $language['Total Fee / Year']; ?></label>
                  <input type="text" name="grand_total" placeholder="0"  value="<?php echo $grand_total; ?> " id="grand_total1" class="form-control" readonly />
				</div>
               </div>			  
             <div class="col-md-3">				
		      <div class="form-group">
                  <label><?php echo $language['Total Fee Balance']; ?></label>
                  <input type="text" name="balance_total" placeholder="0"  value="<?php echo $balance_total; ?> " id="grand_total1" class="form-control" readonly >
                </div>
             </div>
			 <div class="col-md-3">				
		      <div class="form-group">
                  <label><?php echo $language['Total Paid']; ?></label>
                  <input type="text" name="total_paid" placeholder="0"  value="" id="total_paid" class="form-control " readonly >
                </div>
             </div>
			 <div class="col-md-3">				
		        <div class="form-group">
                  <label><?php echo $language['Penalty']; ?></label>
                  <input type="text" name="penalty_fee" placeholder="0" value="" class="form-control amt" oninput="total_fee();">
                </div>
                </div>
			 
		    </div>
		</div>
		        <div class="col-md-12 ">
				<div class="col-md-8 ">	
				<label><input type="checkbox" name="myCheck" id="myCheck"  onclick="myFunction()">&nbsp;&nbsp;&nbsp;<?php echo $language['Check For Message']; ?></label>
				<div class="form-group" id="text" style="display:none">
				<input type="text" name="sms" placeholder="" id="contact"  class="form-control">
			    <input type="hidden" name="send_sms" placeholder="" id="send_sms"  class="form-control">	 
			    </div>
				</div>
				</div>
		
		        <div class="box-body ">
			       <div class="col-md-12">
		            <center><input type="submit" name="finish" value="<?php echo $language['Fee Submit']; ?>" class="btn  my_background_color" /></center>
		           </div>
			    </div>
				<br/>
	</form>			
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
	$penalty_fee_paid = $penalty_fee+$student_admission_fee_paid;	
	//---student_admission_fee using as panalty end---//
	$admission_fee_paid = $_POST['admission_fee_paid'];
	$student_admission_fee_paid = $student_admission_fee_paid+$admission_fee_paid;
	$student_admission_fee_balance = $_POST['student_admission_fee_balance'];
	$student_admission_fee_balance = $student_admission_fee_balance-$admission_fee_paid;
	$grand_total = $_POST['grand_total'];
	$total_paid = $_POST['total_paid'];
	$paid_total = $paid_total+$total_paid;
	$balance_total = $_POST['balance_total'];
	$balance_total = $balance_total-$total_paid;

	$column_name="";
	$insert_column_name="";
	$insert_column_value="";
    for($i=0;$i<$serial_no;$i++)
	{
	$fee2[$i] = $_POST[$fee[$i]];	
	$fee_balance2[$i] = $_POST[$fee_balance[$i]];
	$fee_paid2[$i] = $_POST[$fee_paid[$i]];
    $fee_paid1[$i] = $fee_paid1[$i]+$fee_paid2[$i];	
	$fee_balance2[$i] = $fee_balance2[$i]-$fee_paid2[$i];

	$column_name=$column_name.$total_amount_after_discount[$i]."="."'".$fee2[$i]."',".$fee_balance[$i]."="."'".$fee_balance2[$i]."',".$fee_paid[$i]."="."'".$fee_paid1[$i]."',";
	
	$insert_column_name=$insert_column_name.$total_amount_after_discount[$i].",".$fee_balance[$i].",".$fee_paid[$i].",";    
	$insert_column_value=$insert_column_value."'".$fee2[$i]."','".$fee_balance2[$i]."','".$fee_paid2[$i]."',";
	
	}

	$quer22="insert into common_fees_student_fee_add($insert_column_name fee_submission_date,student_name,student_father_name,student_roll_no,student_class,student_class_section,grand_total,balance_total,paid_total,student_admission_fee,student_admission_fee_balance,student_admission_fee_paid,student_payment_mode,cheque_bank_name,cheque_no,cheque_date,neft_bank_name,neft_bank_account_no,session_value)
    values($insert_column_value '$fee_submission_date','$student_name','$student_father_name','$student_roll_no','$student_class','$student_class_section','$grand_total','$balance_total','$total_paid','$penalty_fee','$student_admission_fee_balance','$penalty_fee','$student_payment_mode','$cheque_bank_name','$cheque_no','$cheque_date','$neft_bank_name','$neft_bank_account_no','$session1')";
  
    $quer1="update common_fees_student_fee set $column_name grand_total='$grand_total',balance_total='$balance_total',paid_total='$paid_total',student_admission_fee='$penalty_fee',student_admission_fee_balance='$student_admission_fee_balance',student_admission_fee_paid='$penalty_fee_paid' where student_roll_no='$student_roll_no'";
    mysqli_query($conn73,$quer1);
	
	$query="insert into ledger_info (emp_id_or_student_roll_no,emp_or_student_name,date,amount_type,payment_mode,total_amount,credit_or_debit_from,session_value) values('$student_roll_no','$student_name','$fee_submission_date','Credit','$student_payment_mode','$total_paid','fee','$session1')";
    mysqli_query($conn73,$query);
  
    if(mysqli_query($conn73,$quer22)){
		if($send_sms=="Yes"){
		include("../sms/sms.php");
		sendDNDSMS($student_father_contact_number,$sms);	
		}
		
		echo "<script>alert('successfully Paid Fee amount $paid_total');</script>";
		echo "<script>window.open('student_fee_list.php?student_roll_no=$student_roll_no','_self')</script>";
	}
    }
  
  ?>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>
</body>
</html>
