<?php include("../attachment/session.php");
$category_code=$_GET['category_code'];
$category_name=$_GET['category_name'];
?>
<!DOCTYPE html>
<html>
<head>
 
  <?php include("../attachment/link_css.php"); ?>
   <?php include("../attachment/link_js.php"); ?>

</head>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript">

      // Load the Google Transliterate API
      google.load("elements", "1", {
            packages: "transliteration"
          });

      var transliterationControl;
      function onLoad() {
        var options = {
            sourceLanguage: 'en',
            destinationLanguage: ['hi'],
            transliterationEnabled: true,
            shortcutKey: 'ctrl+g'
        };
        // Create an instance on TransliterationControl with the required
        // options. 
        transliterationControl =
          new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.
        var ids = ["fee_type_hindi" ];
        transliterationControl.makeTransliteratable(ids);
		}
		      google.setOnLoadCallback(onLoad);

</script>
<body class="hold-transition skin-green fixed sidebar-mini">
<div class="wrapper">
<?php include("../attachment/header.php"); ?>
<?php include("../attachment/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fees Structure Edit
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel_fee_structure.php"><i class="fa fa-graduation-cap"></i> Fees Structure</a></li>
	  <li class="active">Fees Structure Details</li>
      </ol>
    </section>
<script>
function fee_head_total1(classs){
var add = 0;
$('.'+classs).each(function() {
add += Number($(this).val());
});
$('#'+classs).val(add);
}
function monthly_devide(classs,value){
var value1=parseFloat(value)/10;
$('.'+classs).each(function() {
$(this).val(value1);
});
fee_totals();
installment_totals();
}
function validation(){
var add1 = 0;
$('.my_class').each(function() {
if($(this).is(':checked')){
add1=add1+1;
}
});
if(add1<1){
alert_new("Please Select Atleast One Class !!!",'red');
return false;
}else{
return true;
}
}
function fee_totals(){
var month=4;
for(var i=1; i<13; i++){
var add = 0;
$('.fee_month'+month).each(function() {
add += Number($(this).val());
});
$('#month_'+month).val(add);
month++;
if(month==13){
month=1;
}
}
}
function installment_totals(){
var month1=1;
for(var j=1; j<5; j++){
var add = 0;
$('.installment_'+month1).each(function() {
add += Number($(this).val());
});
$('#installment_'+month1).val(add);
month1++;
}
}
</script>
	
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
    <form name="myForm" method="post" enctype="multipart/form-data" action="">
	<!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	       <!-- general form elements disabled -->
          <div class="box box-primary my_border_top">
		  
            <div class="box-header with-border ">
<h3>Class: <?php echo $_GET['student_class']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category: <?php echo $_GET['category_name']; ?></h3>Apply For:&nbsp;&nbsp;&nbsp;
<?php	include("../../con73/con37.php");
                error_reporting(E_ALL & ~E_NOTICE);	
			    $que31="select * from school_info_class_info";
                $run31=mysqli_query($conn73,$que31);
                while($row31=mysqli_fetch_assoc($run31)){
				$student_class2=$row31['class_name'];
				$class_code2=$row31['class_code'];
				?>
<?php echo $student_class2; ?>&nbsp;&nbsp;<input type="checkbox" name="apply_for[]" class="my_class" value="<?php echo $class_code2; ?>" <?php  if($class_code2==$_GET['id']){ ?> checked <?php } ?> />&nbsp;&nbsp;&nbsp;&nbsp;	<?php } ?>		
            </div>
            <!-- /.box-header -->
<!------------------------------------------------Start Registration form--------------------------------------------------->
<div class="box <?php echo $box_head_color; ?>" >
		<div class="box-body">
		<div class="col-sm-12">
		<div class="col-sm-3">
		<div class="form-group">
		<label>Installment-1</label>
		<input type="text" name="insatallment_name[]" id="installment_1" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-3">
		<div class="form-group">
		<label>Installment-2</label>
		<input type="text" name="insatallment_name[]" id="installment_2" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-3">
		<div class="form-group">
		<label>Installment-3</label>
		<input type="text" name="insatallment_name[]" id="installment_3" class="form-control" readonly />
		</div>
		</div>
		<div class="col-sm-3">
		<div class="form-group">
		<label>Installment-4</label>
		<input type="text" name="insatallment_name[]" id="installment_4" class="form-control" readonly />
		</div>
		</div>
		</div>
		</div>
		</div>
		<div class="box <?php echo $box_head_color; ?>" >
		<div class="box-body">
		<div class="col-sm-12">
		
		<div class="col-sm-1">
		<div class="form-group">
		<label>April</label>
		<input type="text" name="installment_month_wise[]" id="month_4" class="form-control installment_1" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>May</label>
		<input type="text" name="installment_month_wise[]" id="month_5" class="form-control installment_1" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>June</label>
		<input type="text" name="installment_month_wise[]" id="month_6" class="form-control installment_1" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>July</label>
		<input type="text" name="installment_month_wise[]" id="month_7" class="form-control installment_2" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>August</label>
		<input type="text" name="installment_month_wise[]" id="month_8" class="form-control installment_2" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>September</label>
		<input type="text" name="installment_month_wise[]" id="month_9" class="form-control installment_2" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>October</label>
		<input type="text" name="installment_month_wise[]" id="month_10" class="form-control installment_3" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>November</label>
		<input type="text" name="installment_month_wise[]" id="month_11" class="form-control installment_3" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>December</label>
		<input type="text" name="installment_month_wise[]" id="month_12" class="form-control installment_3" readonly />
		</div>
		</div>
			<div class="col-sm-1">
		<div class="form-group">
		<label>January</label>
		<input type="text" name="installment_month_wise[]" id="month_1" class="form-control installment_4" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>February</label>
		<input type="text" name="installment_month_wise[]" id="month_2" class="form-control installment_4" readonly />
		</div>
		</div>
		<div class="col-sm-1">
		<div class="form-group">
		<label>March</label>
		<input type="text" name="installment_month_wise[]" id="month_3" class="form-control installment_4" readonly />
		</div>
		</div>
		
		</div>
		</div>
		</div>
		
		  <div class="box <?php echo $box_head_color; ?>" >
            <div class="box-body table-responsive">
            <div class="col-md-12">
              <table id="example1" class="table table-bordered table-striped">
                <thead >

				<tr>
				  <th>Main Head</th>
				  <th>Amount</th>
				  <th>April</th>
				  <th>May</th>
				  <th>June</th>
				  <th>July</th>
				  <th>August</th>
				  <th>September</th>
				  <th>October</th>
				  <th>November</th>
				  <th>December</th>
				  <th>January</th>
				  <th>February</th>
				  <th>March</th>
				  </tr>
				</thead>
                <tbody>
				  		<?php
		include("../../con73/con37.php");
		$class_code=$_GET['id'];
        $que="select * from school_info_hostel_head where fee_head_type='Regular' ORDER BY fee_head_priority";
                $run=mysqli_query($conn73,$que);
				$serial_no=0;
                while($row=mysqli_fetch_assoc($run)){
				$fee_head_name = $row['fee_head_name'];
				$fee_head_code = $row['fee_head_code'];
				if($fee_head_name!=''){
				$fee_head_name1[$serial_no] = $row['fee_head_name'];
				$fee_head_code1[$serial_no] = $row['fee_head_code'];
				
				$serial_no++;
				 } }
				 $class_code=$_GET['id'];
				 $category_code=$_GET['category_code'];
				 $category_name=$_GET['category_name'];
				$que1="select * from student_hostel_fees_structure where class_code='$class_code' and category_code='$category_code'";
                $run1=mysqli_query($conn73,$que1);
				$serial_no1=0;
                while($row1=mysqli_fetch_assoc($run1)){
				for($k=0;$k<$serial_no;$k++){
				$fee_per_year[$serial_no1] = $row1[$fee_head_code1[$k].'_per_year'];
				$serial_no1++;
				}
				}
				$que2="select * from student_hostel_fees_structure_monthly where class_code='$class_code' and category_code='$category_code'";
                $run2=mysqli_query($conn73,$que2);
				$serial_no2=0;
                while($row2=mysqli_fetch_assoc($run2)){
				for($l=0;$l<$serial_no;$l++){
				for($m=1;$m<=12;$m++){
				$fee_monthly[$l][$m] = $row2[$fee_head_code1[$l].'_month'.$m];
				$fee_monthly_code[$l][$m] = $fee_head_code1[$l].'_month'.$m;
				$serial_no2++;
				}
				}
				}
				 for($i=0;$i<$serial_no;$i++){
				 ?>
				<tr>
				  <td><h5 style="color:#900C3F;"><b><?php echo $fee_head_name1[$i]; ?><input type="hidden" name="hostel_fee_head_code[]" id="" value="<?php echo $fee_head_code1[$i].'_per_year'; ?>" /></b></h5></td>
				  <td><input type="text" name="hostel_fee_head_yearly[]" value="<?php echo $fee_per_year[$i]; ?>" style="width:60px;<?php if($fee_head_name1[$i]=='POCKET MONEY DEBIT'){ echo 'background:gray;'; } ?>" <?php if($fee_head_name1[$i]=='POCKET MONEY DEBIT'){ echo 'readonly'; }else{ echo "id='$fee_head_code1[$i]'"; } ?> oninput="monthly_devide('<?php echo $fee_head_code1[$i]; ?>',this.value);" /></td>
				  <?php $month1=4;
				  for($j=1;$j<=12;$j++){
				  $monthly_class="fee_month".$month1;
				  ?>
				  <td><input type="hidden" name="hostel_fee_head_code_monthly[]" id="" value="<?php echo $fee_monthly_code[$i][$month1]; ?>" /><input type="text" name="hostel_fee_head_monthly[]" id="" style="width:50px;<?php if($fee_head_name1[$i]=='POCKET MONEY DEBIT' || $month1==5 || $month1==6){ echo 'background:gray;'; } ?>" value="<?php echo $fee_monthly[$i][$month1]; ?>" <?php if($fee_head_name1[$i]=='POCKET MONEY DEBIT' || $month1==5 || $month1==6){ echo 'readonly'; }else{ echo "class='$fee_head_code1[$i] $monthly_class'"; } ?> oninput="fee_head_total1('<?php echo $fee_head_code1[$i]; ?>');fee_totals();installment_totals();" /></td>
				  <?php
				  $month1++;
				  if($month1==13){
				  $month1=1;
				  }
				  } ?>
				</tr>
				<?php } ?>
			   </tbody>
			 </table>
		    </div>
		   </div>
		 </div>
		
		  <div class="box <?php echo $box_head_color; ?>" >
		  <div class="box-body">
			<div class="col-md-12">
			<center><input type="submit" name="finish" value="Submit" class="btn btn-success" onclick="return validation();" /></center>
			</div>
		  </div>
		  </div>
		  
<!---------------------------------------------End Registration form--------------------------------------------------------->
		  <!-- /.box-body -->
          </div>
    </div>
</section> 
</form> 
</div>

<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php")?>
 <?php include("../attachment/sidebar_2.php")?>
</div>

</body>
</html>

<?php
if(isset($_POST['finish'])){
	$apply_for=$_POST['apply_for'];
	$hostel_fee_head_code=$_POST['hostel_fee_head_code'];
	$hostel_fee_head_yearly=$_POST['hostel_fee_head_yearly'];
	$hostel_fee_head_code_monthly=$_POST['hostel_fee_head_code_monthly'];
	$hostel_fee_head_monthly=$_POST['hostel_fee_head_monthly'];
	$current_date=date('Y-m-d');
	$count1=count($hostel_fee_head_yearly);
	$yearly_column_value="";
	for($n=0;$n<$count1;$n++){
	$yearly_column_value=$yearly_column_value.",$hostel_fee_head_code[$n]='$hostel_fee_head_yearly[$n]'";
	}
	$count2=count($hostel_fee_head_code_monthly);
	$monthly_column_value="";
	for($o=0;$o<$count2;$o++){
	$monthly_column_value=$monthly_column_value.",$hostel_fee_head_code_monthly[$o]='$hostel_fee_head_monthly[$o]'";
	}
	$count3=count($apply_for);
	for($p=0;$p<$count3;$p++){
	$query012="update student_hostel_fees_structure set update_date='$current_date'$yearly_column_value,$update_by_update_sql  where class_code='$apply_for[$p]' and  category_code='$category_code'";
	mysqli_query($conn73,$query012);
	$query013="update student_hostel_fees_structure_monthly set update_date='$current_date'$monthly_column_value,$update_by_update_sql  where class_code='$apply_for[$p]' and  category_code='$category_code'";
	mysqli_query($conn73,$query013);	
	}
	echo "<script>alert_new('Successfully Update');</script>";
	echo "<script>window.open('hostel_fee_structure.php?category_code=$category_code&category_name=$category_name','_self')</script>";
	}
?>
<script>
fee_totals();
installment_totals();
</script>