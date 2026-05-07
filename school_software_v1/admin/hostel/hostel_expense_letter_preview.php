<?php include("../attachment/session.php"); ?>
<!DOCTYPE html>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
<head>
<?php include("../attachment/link_css.php"); ?>

</head>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper"> <?php include("../attachment/header.php"); ?>  <?php include("../attachment/sidebar.php"); ?>
<?php include("../../con73/con37.php"); ?>
<script>

function for_save(){
var last_ref_no=document.getElementById('last_reference_no').value;
$.ajax({
  type: "POST",
  url: "ajax_save_ref_no.php?last_ref_no="+last_ref_no+"",
  cache: false,
  success: function(detail){
	  for_print();
  }
});
}

function for_print()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

</script>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Expense Letter Preview
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li><a href="hostel_expense_letter.php"><i class="fa fa-money"></i> Expense Letter</a></li>
	  <li class="active">Letter Preview</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="box box-primary my_border_top">
		<div class="box-header with-border ">
		<div class="col-md-12">
		    <span style="float:right;"><button type="button" onclick="for_save();" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i>  Save & Print</button></span>
		</div>
        </div>
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
			<div class="col-md-8 col-md-offset-2">
            <div class="box-body table-responsive" id="printTable">
			  
			  	<?php
				if(isset($_POST['submit'])){
				$student_class=$_POST['student_class'];
				if($student_class!='All'){
				$student_class1=explode("|?|",$student_class);
				$class_code=$student_class1[0];
				$student_class=$student_class1[1];
				$condition1=" and student_class='$student_class'";
				}else{
				$condition1="";
				}
				$student_category=$_POST['student_category'];
				if($student_category!='All'){
				$student_category1=explode("|?|",$student_category);
				$category_code=$student_category1[0];
				$category_name=$student_category1[1];
				$condition2=" and student_fee_category_code='$category_code'";
				}else{
				$condition2="";
				}
				$installment_no=$_POST['installment_no'];
				$show_installment_no='';
				$show_installment_no_hindi='';
				if($installment_no!='All'){
				$condition3=" and installment_no='$installment_no'";
				$condition_3=" and add_in_installment='$installment_no'";
				if($installment_no=='installment1'){
				$show_installment_no="April ".date('Y');
				$show_installment_no_hindi='अप्रैल '.date('Y');
				}elseif($installment_no=='installment2'){
				$show_installment_no="July ".date('Y')." to September ".date('Y');
				$show_installment_no_hindi='जुलाई '.date('Y').' से सितंबर '.date('Y').' तक ';
				}elseif($installment_no=='installment3'){
				$show_installment_no="October ".date('Y')." to December ".date('Y');
				$show_installment_no_hindi='अक्टूबर '.date('Y').' से दिसंबर '.date('Y').' तक ';
				}elseif($installment_no=='installment4'){
				$show_installment_no="January ".date('Y')." to March ".date('Y');
				$show_installment_no_hindi='जनवरी '.date('Y').' से मार्च '.date('Y').' तक ';
				}
				
				}else{
				$condition3="";
				$condition_3="";
				$show_installment_no="All Installment ".date('Y');
				$show_installment_no_hindi='सभी '.date('Y');
				}
				
				$due_date=$_POST['due_date'];
				if($due_date!=''){
				$due_date1=explode('-',$due_date);
				$show_due_date=$due_date1[2].'.'.$due_date1[1].'.'.$due_date1[0];
				}else{
				$show_due_date='';
				}
				
				$student_roll_no=$_POST['student_roll_no'];
				if($student_roll_no!='All'){
				$condition6=" and student_roll_no='$student_roll_no'";
				}else{
				$condition6="";
				}
				
			  $qry1="select * from login";
			  $result1=mysqli_query($conn73,$qry1);
			  while($row01=mysqli_fetch_assoc($result1)){
			  $refrence_no=$row01['ref_no_'.$session1];
			  }
			  
			  $qry2="select * from school_info_hostel_head where fee_head_name!=''";
			  $result2=mysqli_query($conn73,$qry2);
			  $regular_sno=0;
			  $expense_sno=0;
			  $regular_fee_head_name='';
			  $regular_fee_head_code='';
			  $expense_fee_head_name='';
			  $expense_fee_head_name_hindi='';
			  $expense_fee_head_code='';
			  while($row02=mysqli_fetch_assoc($result2)){
			  $fee_head_type=$row02['fee_head_type'];
			  if($fee_head_type=='Regular'){
			  $regular_fee_head_name[$regular_sno]=$row02['fee_head_name'];
			  $regular_fee_head_code[$regular_sno]=$row02['fee_head_code'];
			  $regular_sno++;
			  }elseif($fee_head_type=='Expense'){
			  $expense_fee_head_name[$expense_sno]=$row02['fee_head_name'];
			  $expense_fee_head_name_hindi[$expense_sno]=$row02['fee_head_name_hindi'];
			  $expense_fee_head_code[$expense_sno]=$row02['fee_head_code'];
			  $expense_sno++;
			  }
			  }
			  $regular_count=count($regular_fee_head_code);
			  $expense_count=count($expense_fee_head_code);
				
			  $que16="select * from student_admission_info where student_hostel='Yes' and session_value='$session1'$condition1$condition2$condition6";
			  $run16=mysqli_query($conn73,$que16) or die(mysqli_error($conn73));
			  while($row16=mysqli_fetch_assoc($run16)){
			  $student_roll_no=$row16['student_roll_no'];
			  $student_name=$row16['student_name'];
			  $student_father_name=$row16['student_father_name'];
			  $student_class=$row16['student_class'];
			  $student_class_section=$row16['student_class_section'];
			  $student_admission_number=$row16['student_admission_number'];
			  $student_hostel_id=$row16['student_hostel_id'];
			  
			  $que17="select * from student_fee_paid where student_roll_no='$student_roll_no' and session_value='$session1'$condition3";
			  $grand_total_amount=0;
			  $total_challan_no='';
			  $run17=mysqli_query($conn73,$que17) or die(mysqli_error($conn73));
			  if(mysqli_num_rows($run17)>0){
			  while($row17=mysqli_fetch_assoc($run17)){
			  $total_amount=$row17['total_amount'];
			  $penalty_amount=$row17['penalty_amount'];
			  $challan_no=$row17['challan_no'];
			  $installment_no=$row17['installment_no'];
			  $grand_total_amount=$grand_total_amount+$total_amount+$penalty_amount;
			  if($total_challan_no!='' && $challan_no){
			  $comma=",";
			  }else{
			  $comma="";
			  }
			  $total_challan_no=$total_challan_no.$comma.$challan_no;
			  
			  }
			  
			  for($ah=0;$ah<$expense_count;$ah++){
			  $hostel_expenses_total_amount[$ah]=0;
			  }
			  
			  $que18="select * from student_hostel_fees_paid where student_roll_no='$student_roll_no' and session_value='$session1'$condition3";
			  $hostel_grand_total_amount=0;
			  $hostel_total_challan_no='';
			  $total_hostel_penalty_amount=0;
			  $run18=mysqli_query($conn73,$que18) or die(mysqli_error($conn73));
			  while($row18=mysqli_fetch_assoc($run18)){
			  $hostel_total_amount=$row18['total_amount'];
			  $hostel_penalty_amount=$row18['penalty_amount'];
			  $total_hostel_penalty_amount=$total_hostel_penalty_amount+$hostel_penalty_amount;
			  $hostel_challan_no=$row18['challan_no'];
			  $hostel_installment_no=$row18['installment_no'];
			  if($hostel_total_challan_no!='' && $hostel_challan_no){
			  $hostel_comma=",";
			  }else{
			  $hostel_comma="";
			  }
			  $hostel_total_challan_no=$hostel_total_challan_no.$hostel_comma.$hostel_challan_no;
			  
			  for($as=0;$as<$regular_count;$as++){
			  $hostel_grand_total_amount=$hostel_grand_total_amount+$row18[$regular_fee_head_code[$as]];
			  }
			  
			  for($af=0;$af<$expense_count;$af++){
			  $hostel_expenses_total_amount[$af]=$hostel_expenses_total_amount[$af]+$row18[$expense_fee_head_code[$af]];
			  }
			  
			  }
			  
			  ?>
			  
			  <table cellspacing="0" cellpadding="5px;" style="width:100%;">
			  <tr>
			  <td><span style="font-size:28px; font-weight:bold;"><center>HAPPY DAYS SCHOOL HOSTEL</center></span></td>
		      </tr>
			  <tr>
			  <td><span style="font-size:16px; font-weight:bold;"><center>SCHOOL & HOSTEL FEE DETAILS LETTER</center></span></td>
		      </tr>
			  <tr>
			  <td><span style="float:left"><img src="../pdf/school.jpg" height="80px;" width="110px;" /></span></td>
		      </tr>
			  </table>
			  <table cellspacing="0" cellpadding="5px;" style="width:100%;">
			  <thead>
			  <tr>
			  <th><b style="float:left;">Reference No. ( संदर्भ क्रमांक ) : <?php echo $refrence_no; ?></b></th>
			  <th><b style="float:right;">Date ( दिनांक ) : <?php echo date('d.m.Y'); ?> </b></th>
		      </tr>
			  <tr>
			  <th colspan="2"><b style="float:left;">Dear Parent ( प्रिय अभिभावक ) ,</b></th>
		      </tr>
			  </thead>
			  <tbody>
			  <tr>
			  <td colspan="2"><span>Your Ward <?php echo $student_name; ?> Class <?php echo $student_class; ?>, School Admission No. <?php echo $student_admission_number; ?>, Hostel ID No. <?php echo $student_hostel_id; ?> is a student of our school hostel and he is also living in our school hostel.</span></td>
		      </tr>
			  <tr>
			  <td colspan="2"><span>आपका पुत्र <?php echo $student_name; ?> कक्षा <?php echo $student_class; ?>, विद्यालय प्रवेश क्रमांक <?php echo $student_admission_number; ?>, हॉस्टल आईडी क्रमांक <?php echo $student_hostel_id; ?> हमारे विद्यालय के हॉस्टल का छात्र है जिसका निवास विद्यालय हॉस्टल में ही है |</span></td>
		      </tr>
			  <tr>
			  <td colspan="2"><span>His School and Hostel Fee details for the <?php echo $show_installment_no; ?> are given below :</span></td>
		      </tr>
			  <tr>
			  <td colspan="2"><span>उसकी <?php echo $show_installment_no_hindi; ?> की किश्त की स्कूल और हॉस्टल सुविधा की फीस का विवरण निम्नानुसार है :</span></td>
		      </tr>
			  <tbody>
			  </table>
			  <table border="1" cellspacing="0" cellpadding="5px;" style="width:100%;">
			  
			  <tr>
			  <th>S.N.</th>
			  <th>Particular</th>
			  <th>Fee / Expenses Date</th>
			  <th>Challan No.</th>
			  <th>Amount</th>
		      </tr>
			  <tr>
			  <td>1.</td>
			  <td>SCHOOL FEE ( विद्यालय शुल्क )</td>
			  <td><?php echo $show_installment_no; ?></td>
			  <td><?php echo $total_challan_no; ?></td>
			  <td><?php echo $grand_total_amount; ?></td>
		      </tr>
			  <tr>
			  <td>2.</td>
			  <td>HOSTEL FEE ( हॉस्टल शुल्क )</td>
			  <td><?php echo $show_installment_no; ?></td>
			  <td><?php echo $hostel_total_challan_no; ?></td>
			  <td><?php echo $hostel_grand_total_amount+$total_hostel_penalty_amount; ?></td>
		      </tr>
			  
			  <?php
			  $hostel_expenses_grand_total=0;
			  for($ad=0;$ad<$expense_count;$ad++){
			  $hostel_expenses_grand_total=$hostel_expenses_grand_total+$hostel_expenses_total_amount[$ad];
			  ?>
			  <tr>
			  <td><?php echo $ad+3; ?>.</td>
			  <td><?php echo $expense_fee_head_name[$ad].'( '.$expense_fee_head_name_hindi[$ad].' )'; ?></td>
			  <td><?php echo $show_installment_no; ?></td>
			  <td><?php echo $hostel_total_challan_no; ?></td>
			  <td><?php echo $hostel_expenses_total_amount[$ad]; ?></td>
		      </tr>
			  <?php } ?>
			  
			  <tr>
			  <td colspan="4"><center><b>TOTAL AMOUNT ( कुल राशि )</b></center></td>
			  <td><center><b><?php echo $grand_total_amount+$hostel_grand_total_amount+$total_hostel_penalty_amount+$hostel_expenses_grand_total; ?></b></center></td>
		      </tr>
			  
			  </table>
			  
			  <table cellspacing="0" style="width:100%;">
			  <tr>
			  <td>The Last Date of Deposition of above mention fees is <?php echo $show_due_date; ?>. Please Deposit Fee on time to
avoid the inconvenience.</td>
		      </tr>
			  
			  <tr>
			  <td>उपरोक्त फीस जमा करने की अंतिम तिथि <?php echo $show_due_date; ?> है। कृपया समय पर फीस जमा कर असुविधा से बचें।</td>
		      </tr>
			  <?php for($ad=0;$ad<8;$ad++){ ?>
			  <tr>
			  <td><br/></td>
		      </tr>
			  <?php } ?>
			  <tr>
			  <td><b>HOSTEL INCHARGE</b></td>
		      </tr>
			  <tr>
			  <td><b>आवास अधीक्षक</b></td>
		      </tr>
			  <?php for($ae=0;$ae<2;$ae++){ ?>
			  <tr>
			  <td><br/></td>
		      </tr>
			  <?php } ?>
			  
			  </table>
			  <?php
			  $refrence_no++;
			  
			  }
			  }
			  }
			  ?>
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-sm-12">&nbsp;</div>
			  <div class="col-sm-12"><input type="hidden" name="" id="last_reference_no" value="<?php echo $refrence_no; ?>" />
			  <center><button type="button" onclick="for_save();" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i>  Save & Print</button></center>
			  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
    
  </div>
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php"); ?>
 <?php include("../attachment/sidebar_2.php"); ?>
</div>
</div>
 <?php include("../attachment/link_js.php"); ?>
<script>
  $(function () {
    $('#example1').DataTable()
  
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
</body>
</html>