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

function for_print()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
   //$('#printTable').print();
}

</script>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Expense Report Preview
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li><a href="hostel_expense_report.php"><i class="fa fa-money"></i> Expense Report</a></li>
	  <li class="active">Report Preview</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="box box-primary my_border_top">
		<div class="box-header with-border ">
		<div class="col-md-12">
		
		</div>
        </div>
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
			<div class="col-xs-10 col-xs-offset-1">
            <div class="box-body table-responsive" id="printTable">
			  <?php
			  if(isset($_POST['submit'])){
			  $from_date11=$_POST['from_date'];
			  if($from_date11!=''){
			  $from_date112=explode('-',$from_date11);
			  $from_date11=$from_date112[2].'.'.$from_date112[1].'.'.$from_date112[0];
			  }
			  $to_date11=$_POST['to_date'];
			  if($to_date11!=''){
			  $to_date112=explode('-',$to_date11);
			  $to_date11=$to_date112[2].'.'.$to_date112[1].'.'.$to_date112[0];
			  }
			  $installment_no11=$_POST['installment_no'];
			  $current_year=date('y');
			  if($installment_no11!='All'){
			  if($installment_no11=='installment1'){
			  $installment_no22="April ".$current_year;
			  }elseif($installment_no11=='installment2'){
			  $installment_no22="July ".$current_year." to September".$current_year;
			  }elseif($installment_no11=='installment3'){
			  $installment_no22="October ".$current_year." to December".$current_year;
			  }elseif($installment_no11=='installment4'){
			  $installment_no22="January ".$current_year." to March".$current_year;
			  }
			  }else{
			  $installment_no22="All";
			  }
			  
			  
			    $school_query1="select * from school_info_general";
				$school_result1=mysqli_query($conn73,$school_query1)or die(mysqli_error($conn73));
				if(mysqli_num_rows($school_result1)>0){
				while($school_row1=mysqli_fetch_assoc($school_result1)){
				$school_info_school_name=$school_row1['school_info_school_name'];
				$school_info_school_district=$school_row1['school_info_school_district'];
				}
				}else{
				$school_info_school_name="";
				$school_info_school_district="";
				}
			  ?>
			  <div class="col-md-12">
				<center><span><h2><?php echo $school_info_school_name; ?></h2></span></center>
			  </div>
			  <div class="col-md-12">
				<center><span><h4>EXPENSES REPORT</h4></span></center>
			  </div>
			  <div class="col-md-12">
			    <?php if($from_date11!='' && $to_date11!=''){ ?>
				<h4>from <?php echo $from_date11; ?> to <?php echo $to_date11; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php } ?>
				Installment : <?php echo $installment_no22; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Date : <?php echo date('d.m.Y'); ?></h4>
			  </div>
			  <?php } ?>
			  <table border="1" cellspacing="0" cellpadding="5px;" class="">
			  <?php
			  if(isset($_POST['submit'])){
			  $fee_data01=$_POST['fee_data'];
			  $count01=count($fee_data01);
			  $fee_data02=$_POST['fee_data1'];
			  $count02=count($fee_data02);
			  ?>
			  <tr>
			  <th>S.No.</th>
			  <th>Name of Student</th>
			  <th>Father's Name</th>
			  <th>class & Section</th>
			  <th>School Adm. No.</th>
			  <th>Hostel Id</th>
			  <?php for($a=0;$a<$count01;$a++){
			  $fee_data_name1=explode('|?|',$fee_data01[$a]);
			  $fee_data_name[$a]=$fee_data_name1[1];
			  ?>
			  <th><?php echo $fee_data_name[$a]; ?></th>
			  <?php } ?>
			  <?php for($b=0;$b<$count02;$b++){
			  $fee_data_remark1=explode('|?|',$fee_data02[$b]);
			  $fee_data_remark[$b]=$fee_data_remark1[1];
			  ?>
			  <th><?php echo $fee_data_remark[$b]; ?></th>
			  <?php } ?>
			  <?php if(isset($_POST['fee_total'])){ ?>
			  <th>Total Amount</th>
			  <?php } ?>
		      </tr>
			  <?php
				
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
				if($installment_no!='All'){
				$condition3=" and add_in_installment='$installment_no'";
				}else{
				$condition3="";
				}
				$from_date=$_POST['from_date'];
				if($from_date!=''){
				$condition4=" and create_date>='$from_date'";
				}else{
				$condition4="";
				}
				$to_date=$_POST['to_date'];
				if($to_date!=''){
				$condition5=" and create_date<='$to_date'";
				}else{
				$condition5="";
				}
				$student_roll_no=$_POST['student_roll_no'];
				if($student_roll_no!='All'){
				$condition6=" and student_roll_no='$student_roll_no'";
				}else{
				$condition6="";
				}
				
				$fee_data=$_POST['fee_data'];
				$count1=count($fee_data);
				$fee_data1=$_POST['fee_data1'];
				$count2=count($fee_data1);

			  if(isset($_POST['summarize'])){

			  $que16="select * from student_admission_info where student_hostel='Yes' and session_value='$session1'$condition1$condition2$condition6";
			  $run16=mysqli_query($conn73,$que16) or die(mysqli_error($conn73));
			  $serial_no=0;
			  $gd_total_sno=0;
			  $grand_total=0;
			  $grand_total_fee_head_amount='';
			  while($row16=mysqli_fetch_assoc($run16)){
			  $student_roll_no=$row16['student_roll_no'];
			  $student_name=$row16['student_name'];
			  $student_father_name=$row16['student_father_name'];
			  $student_class=$row16['student_class'];
			  $student_class_section=$row16['student_class_section'];
			  $student_admission_number=$row16['student_admission_number'];
			  $student_hostel_id=$row16['student_hostel_id'];
			  
			  $serial_no++;
			  
			  $que17="select * from expense_monthly where student_roll_no='$student_roll_no' and session_value='$session1'$condition3$condition4$condition5";
			  $run17=mysqli_query($conn73,$que17) or die(mysqli_error($conn73));
			  if(mysqli_num_rows($run17)>0){
			  $fee_head_name='';
			  $fee_head_remark='';
			  $exp_sno=0;
			  $total_amount=0;
			  while($row17=mysqli_fetch_assoc($run17)){
			  for($j=0;$j<$count1;$j++){
			  if($serial_no=='1' && $exp_sno=='0'){
			  $grand_total_fee_head_amount[$j]=0;
			  }
			  if($exp_sno=='0'){
			  $fee_head_name[$j]=0;
			  }
			  $fee_data11=explode('|?|',$fee_data[$j]);
			  $fee_data[$j]=$fee_data11[0];
			  
			  $fee_head_name[$j]=$fee_head_name[$j]+$row17[$fee_data[$j]];
			  $grand_total_fee_head_amount[$j]=$grand_total_fee_head_amount[$j]+$row17[$fee_data[$j]];
			  }
			  for($k=0;$k<$count2;$k++){
			  if($exp_sno=='0'){
			  $fee_head_remark[$k]='';
			  $coma='';
			  }else{
			  $coma=', ';
			  }
			  $fee_data22=explode('|?|',$fee_data1[$k]);
			  $fee_data1[$k]=$fee_data22[0];
			  
			  $fee_head_remark[$k]=$fee_head_remark[$k].$coma.$row17[$fee_data1[$k]];
			  }
			  $total_amount=$total_amount+$row17['total_amount'];
			  $grand_total=$grand_total+$row17['total_amount'];
			  $exp_sno++;
			  }
			  ?>
		      <tr>
			  <td><?php echo $serial_no.'.'; ?></td>
			  <td><?php echo $student_name; ?></td>
			  <td><?php echo $student_father_name; ?></td>
			  <td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
			  <td><?php echo $student_admission_number; ?></td>
			  <td><?php echo $student_hostel_id; ?></td>
			  <?php for($l=0;$l<$count1;$l++){ ?>
			  <td><?php echo $fee_head_name[$l]; ?></td>
			  <?php } ?>
			  <?php for($m=0;$m<$count2;$m++){ ?>
			  <td><?php echo $fee_head_remark[$m]; ?></td>
			  <?php } ?>
			  <?php if(isset($_POST['fee_total'])){ ?>
			  <td><?php echo $total_amount; ?></td>
			  <?php } ?>
		      </tr>
			  <?php
			  }
			  }
			  ?>
			  <tr>
			  <td colspan="6"><center><b>Grand Total</b></center></td>
			  <?php for($n=0;$n<$count1;$n++){ ?>
			  <td><b><?php echo $grand_total_fee_head_amount[$n]; ?></b></td>
			  <?php } ?>
			  <?php for($o=0;$o<$count2;$o++){ ?>
			  <td></td>
			  <?php } ?>
			  <?php if(isset($_POST['fee_total'])){ ?>
			  <td><b><?php echo $grand_total; ?></b></td>
			  <?php } ?>
		      </tr>
			  <?php
			  }else{
			  
			  $que17="select * from expense_monthly where session_value='$session1'$condition3$condition4$condition5$condition6";
			  $run17=mysqli_query($conn73,$que17) or die(mysqli_error($conn73));
			  if(mysqli_num_rows($run17)>0){
			  $fee_head_name='';
			  $fee_head_remark='';
			  $exp_sno=0;
			  $total_amount=0;
			  $serial_no=0;
			  $grand_total=0;
			  while($row17=mysqli_fetch_assoc($run17)){
			  for($j=0;$j<$count1;$j++){
			  if($serial_no=='0' && $exp_sno=='0'){
			  $grand_total_fee_head_amount[$j]=0;
			  }
			  $fee_data11=explode('|?|',$fee_data[$j]);
			  $fee_data[$j]=$fee_data11[0];
			  
			  $fee_head_name[$j]=$row17[$fee_data[$j]];
			  $grand_total_fee_head_amount[$j]=$grand_total_fee_head_amount[$j]+$row17[$fee_data[$j]];
			  }
			  for($k=0;$k<$count2;$k++){
			  $fee_data22=explode('|?|',$fee_data1[$k]);
			  $fee_data1[$k]=$fee_data22[0];
			  
			  $fee_head_remark[$k]=$row17[$fee_data1[$k]];
			  }
			  $total_amount=$row17['total_amount'];
			  $grand_total=$grand_total+$total_amount;
			  $student_roll_no=$row17['student_roll_no'];
			  $exp_sno++;
			  $serial_no++;
			  
			  $que16="select * from student_admission_info where student_roll_no='$student_roll_no' and student_hostel='Yes' and session_value='$session1'$condition$condition1$condition2";
			  $run16=mysqli_query($conn73,$que16) or die(mysqli_error($conn73));
			  while($row16=mysqli_fetch_assoc($run16)){
			  $student_roll_no=$row16['student_roll_no'];
			  $student_name=$row16['student_name'];
			  $student_father_name=$row16['student_father_name'];
			  $student_class=$row16['student_class'];
			  $student_class_section=$row16['student_class_section'];
			  $student_admission_number=$row16['student_admission_number'];
			  $student_hostel_id=$row16['student_hostel_id'];
			  $company_name=$row16['company_name'];
			  if($company_name=='company_a'){
			  $board="MP";
			  }elseif($company_name=='company_b'){
			  $board="CBSE";
			  }elseif($company_name=='company_c'){
			  $board="NURSERY";
			  }
			  }
			  
			  ?>
		      <tr>
			  <td><?php echo $serial_no.'.'; ?></td>
			  <td><?php echo $student_name; ?></td>
			  <td><?php echo $student_father_name; ?></td>
			  <td><?php echo $student_class.' ('.$student_class_section.')'; ?></td>
			  <td><?php echo $student_admission_number; ?></td>
			  <td><?php echo $student_hostel_id; ?></td>
			  <td><?php echo $board; ?></td>
			  <?php for($l=0;$l<$count1;$l++){ ?>
			  <td><?php echo $fee_head_name[$l]; ?></td>
			  <?php } ?>
			  <?php for($m=0;$m<$count2;$m++){ ?>
			  <td><?php echo $fee_head_remark[$m]; ?></td>
			  <?php } ?>
			  <?php if(isset($_POST['fee_total'])){ ?>
			  <td><?php echo $total_amount; ?></td>
			  <?php } ?>
		      </tr>
			  <?php
			  }
			  }
			  ?>
			  <tr>
			  <td colspan="7"><center><b>Grand Total</b></center></td>
			  <?php for($n=0;$n<$count1;$n++){ ?>
			  <td><b><?php echo $grand_total_fee_head_amount[$n]; ?></b></td>
			  <?php } ?>
			  <?php for($o=0;$o<$count2;$o++){ ?>
			  <td></td>
			  <?php } ?>
			  <?php if(isset($_POST['fee_total'])){ ?>
			  <td><b><?php echo $grand_total; ?></b></td>
			  <?php } ?>
		      </tr>
			  <?php
			  }
			  }
			  ?>
			  </table>
			  
        <!-- /.col -->
      </div>
      </div>
			  <div class="col-sm-12">&nbsp;</div>
			  <div class="col-sm-12">
			  <center><button type="button" onclick="for_print();" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i>  Print</button></center>
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