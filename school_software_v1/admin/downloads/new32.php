<?php include("../attachment/session.php")?><!DOCTYPE html>
<html>
<head>
 <?php include("../attachment/link_css.php")?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">

<?php include("../attachment/header.php")?> <?php include("../attachment/sidebar.php")?>
  
  
  

  
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Download Student Info
        <small><?php echo $language['Control Panel']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i> <?php echo $language['Home']; ?></a></li>
        <li><a href="download_student_info.php"><i class="fa fa-phone-square"></i>Download Panel</a></li>
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
			<form role="form" method="post" action='student_fees_list_download.php' enctype="multipart/form-data">
			<div class="col-md-12" style="margin-left:200px;">
			<div class="col-md-4">				
			      <div class="form-group" >
				<th><b>From Date</b></th><input type="date" name="date_from" required>
				  </div>
				  </div>
				  <div class="col-md-4">				
			      <div class="form-group" >
				<th><b>To Date</b></th><input type="date"  name="date_to" required>
				  </div>
				  </div>
			</div></br></br></br>
			<hr>
			<?php 
			include("../../con73/con37.php");
			$query="select * From school_info_fee_types";
			$result=mysqli_query($conn73,$query);
			$arr=0;
			while($row=mysqli_fetch_assoc($result)){
		    $s_no=$row['s_no']; 
		    $fee_type[$arr]=$row['fee_type']; 
			$fee_code[$arr]=$row['fee_code'];
			
			$arr++;
			}
			
			
			
			?>
			
				 
				 <div class="col-md-2">				
			      <div class="form-group" >
				<input type="checkbox" checked name="student_data[]" value="fee_status,fee status"><th><b>Fee Status</b></th>
				  </div>
				  </div>
	
				  <div class="col-md-2 ">	
					 <div class="form-group" >
					 <input type="checkbox" checked name="student_data[]" value="student_name,student name"><th><b>Student Name</b></th>
					 </div>
				  </div>
			      <div class="col-md-2 ">
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_father_name,student father name"><th><b>Student Father Name</b></th>
						</div>
				   </div>
				   <div class="col-md-2 ">
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_class,student class"><th><b>Student Class</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						 <input type="checkbox" checked name="student_data[]" value="student_class_section,student class section"><th><b>Student Class Section</b></th>
						</div>
					</div>
					<div class="col-md-2 ">	
					<div class="form-group" >
					  <input type="checkbox" checked name="student_data[]" value="student_roll_no,student roll no"><th><b>Student Roll No</b></th>
					</div>
				    </div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="fee_submission_date,fee submission date"><th><b>Fee Submission Date</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="grand_total,grand total"><th><b>Grand Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="balance_total,balance total"><th><b>Balance Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="paid_total,paid total"><th><b>Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_payment_mode,student payment mode"><th><b>Student Payment Mode</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="cheque_bank_name,cheque bank name"><th><b>Cheque Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="cheque_no,cheque no"><th><b>Cheque No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="cheque_date,cheque date"><th><b>Cheque Date</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="neft_bank_name,neft bank name"><th><b>Neft Bank Name</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="neft_bank_account_no,neft bank account no"><th><b>Neft Bank Account No</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_fee,student admission fee"><th><b>Student Admission Fee</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_fee_balance,student admission fee balance"><th><b>Student Admission Fee Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_admission_fee_paid,student admission fee paid"><th><b>Student Admission Fee Paid</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						
						<?php 
						$count=count($fee_code);
						For($i=0; $i<$count;$i++){?>
						   <input type="checkbox" checked name="student_data[]" value="student_fee1_amount_after_discount,student <?php  echo $fee_type[$i]; ?> amount after discount"><th><b>Student Fee1 Amount After Discount</b></th>
						   <?php } ?>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee1_balance,student fee1 balance"><th><b>Student Fee1 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee1_paid_total,student fee1 paid total"><th><b>Student Fee1 Paid Total</b></th>
						    
						</div>
					</div>
					
					<div class="col-md-2 ">		
						<div class="form-group">
						
						   <input type="checkbox" checked name="student_data[]" value="student_fee2_amount_after_discount,student <?php echo $fee_type2; ?> amount after discount"><th><b>Student Fee2 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee2_balance,student fee2 balance"><th><b>Student Fee2 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee2_paid_total,student fee2 paid total"><th><b>Student Fee2 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee3_amount_after_discount,student fee3 amount after discount"><th><b>Student Fee3 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee3_balance,student fee3 balance"><th><b>Student Fee3 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee3_paid_total,student fee3 paid total"><th><b>Student Fee3 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee4_amount_after_discount,student fee4 amount after discount"><th><b>Student Fee4 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee4_balance,student fee4 balance"><th><b>Student Fee4 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee4_paid_total,student fee4 paid total"><th><b>Student Fee4 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee5_amount_after_discount,student fee5 amount after discount"><th><b>Student Fee5 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee5_balance,student fee5 balance"><th><b>student fee5 balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee5_paid_total,student fee5 paid total"><th><b>Student Fee5 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee6_amount_after_discount,student fee6 amount after discount"><th><b>Student Fee6 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee6_balance,student fee6 balance"><th><b>Student Fee6 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee6_paid_total,student fee6 paid total"><th><b>Student Fee6 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee7_amount_after_discount,student fee7 amount after discount"><th><b>Student Fee7 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee7_balance,student fee7 balance"><th><b>Student Fee7 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee7_paid_total,student fee7 paid total"><th><b>student fee7 paid total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee8_amount_after_discount,student fee8 amount after discount"><th><b>Student Fee8 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee8_balance,student fee8 balance"><th><b>Student Fee8 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee8_paid_total,student fee8 paid total"><th><b>Student Fee8 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee9_amount_after_discount,student fee9 amount after discount"><th><b>Student Fee9 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee9_balance,student fee9 balance"><th><b>Student Fee9 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee9_paid_total,student fee9 paid total"><th><b>Student Fee9 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee10_amount_after_discount,student fee10 amount after discount"><th><b>Student Fee10 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee10_balance,student fee10 balance"><th><b>student fee10 balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee10_paid_total,student fee10 paid total"><th><b>Student Fee10 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee11_amount_after_discount,student fee11 amount after discount"><th><b>Student Fee11 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee11_balance,Student Fee11 Balance"><th><b>Student Fee11 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee11_paid_total,student fee11 paid total"><th><b>Student Fee11 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee12_amount_after_discount,student fee12 amount after discount"><th><b>Student Fee12 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee12_balance,student fee12 balance"><th><b>Student Fee12 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee12_paid_total	,student fee12 paid total"><th><b>Student Fee12 Paid Total	</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee13_amount_after_discount	,student fee13 amount after discount"><th><b>Student Fee13 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee13_balance,student fee13 balance"><th><b>Student Fee13 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee13_paid_total,student fee13 paid total"><th><b>Student Fee13 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee14_amount_after_discount,student fee14 amount after discount"><th><b>Student Fee14 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee14_balance,student fee14 balance"><th><b>Student Fee14 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee14_paid_total,student fee14 paid total"><th><b>Student Fee14 Paid Total</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee15_amount_after_discount,student fee15 amount after discount"><th><b>Student Fee15 Amount After Discount</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee15_balance,student fee15 balance"><th><b>Student Fee15 Balance</b></th>
						</div>
					</div>
					<div class="col-md-2 ">		
						<div class="form-group">
						   <input type="checkbox" checked name="student_data[]" value="student_fee15_paid_total,student_fee15_paid_total"><th><b>Student Fee15 Paid Total</b></th>
						</div>
					</div>
		<div class="col-md-12">
		   <center><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></center>
		   </div>
		   </form>	
	       </div>
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section>
  
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>
 <?php include("../attachment/link_js.php")?>
</body>
</html>

