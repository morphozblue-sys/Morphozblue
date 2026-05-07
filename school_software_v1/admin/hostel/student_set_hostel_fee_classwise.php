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
<div class="wrapper"> 
<?php include("../attachment/header.php"); ?>  
<?php include("../attachment/sidebar.php"); ?>
<?php include("../../con73/con37.php"); ?>
<script>
function for_concession(){
var class_name1_code=document.getElementById('student_class').value;
var category_code=document.getElementById('category_code').value;
var student_class_section=document.getElementById('student_class_section').value;
var class_name1_code1=class_name1_code.split('|?|');
var class_code=class_name1_code1[1];
if(class_code!='' && category_code!='' && student_class_section!=''){
$.ajax({
type: "POST",
url: "ajax_get_for_set_hostel_fee_classwise.php?class_code="+class_code+"&category_code="+category_code+"&student_class_section="+student_class_section+"",
cache: false,
success: function(detail){
$("#set_value").html(detail);
for_student();
}
});
}
}
</script>
<script>
function for_discount(id,val){
$('#discount_percentage_'+id).prop('readonly',true);
var actual_amount=document.getElementById('actual_'+id).value;
if(val=='custom'){
var discount_name= "custom";
var discount_amount2=document.getElementById('discount_percentage_'+id).value;
$('#discount_percentage_'+id).prop('readonly',false);
if(discount_amount2==''){
discount_amount2=0;
}
var discount_amount_percentage=parseFloat(discount_amount2);
}else{
var res=val.split('|?|');
discount_amount_percentage=res[0];
var discount_name=res[1];
}
var discount_amount_final1=parseFloat(actual_amount)*parseFloat(discount_amount_percentage)/100;
var discount_amount_final=parseFloat(discount_amount_final1);
var amount_after_discount=parseFloat(actual_amount)-parseFloat(discount_amount_final);
$('#discount_'+id).val(parseFloat(discount_amount_final));
$('#discount_percentage_'+id).val(discount_amount_percentage);
$('#after_'+id).val(amount_after_discount);
$('#remark_'+id).val(discount_name);
}

function again_total(id,val2){
var id1=id.split('_');
var new_id=id1[2];
var aft_disc_val=document.getElementById('actual_'+new_id).value;
var discount_amount_final=parseFloat(aft_disc_val)*parseFloat(val2)/100;
var new_disc_val=parseFloat(aft_disc_val)-parseFloat(discount_amount_final);
$('#after_'+new_id).val(new_disc_val);
$('#discount_'+new_id).val(discount_amount_final);
}

function for_section(value){
if(value!=''){
var id=value;  
var class_name1_code1=id.split('|?|');
var class_name=class_name1_code1[0];
$.ajax({
type: "POST",
url: "ajax_class_section_all.php?class_name="+class_name+"",
cache: false,
success: function(detail){
  $("#student_class_section").html(detail);
  for_concession();
}
});
}else{
$("#student_class_section").html("<option value='All'>All</option>");
}
}
function for_student(){
var class_name1_code=document.getElementById('student_class').value;
var category_code=document.getElementById('category_code').value;
var student_class_section=document.getElementById('student_class_section').value;
var class_name1_code1=class_name1_code.split('|?|');
var class_name=class_name1_code1[0];
$.ajax({
type: "POST",
url: "ajax_get_for_set_hostel_fee_classwise_student.php?class_code="+class_name+"&category_code="+category_code+"&student_class_section="+student_class_section+"",
cache: false,
success: function(detail){
$("#student_list").html(detail);
}
});
}

function for_check_all(id){
if($('#'+id).prop("checked") == true){
	$("."+id).each(function() {
	$(this).prop('checked',true);
	});
}else{
	$("."+id).each(function() {
	$(this).prop('checked',false);
	});
}
}
</script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Hostel Fees Management
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
	 <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li><a href="hostel.php"><i class="fa fa-money"></i> Hostel</a></li>
	  <li class="active">Set Fee</li>
      </ol>
    </section>

	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
	<form method="post" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-sm-12">&nbsp;</div>
              <div class="col-sm-12">
			  
              <div class="col-sm-4">
			  <div class="container-fluid">
			  <h2>Discount Panel</h2>
			  <div class="panel panel-default">
			  <div class="panel-body">
			  
	
				<div class="col-md-12">
					<div class="form-group">
					  <label >Class<font style="color:red"><b>*</b></font></label>
					    <select class="form-control" name="student_class" id="student_class" onchange="for_section(this.value);" required>
					           <option  value="">Select Class</option>
						       <?php 
							   $que="select * from school_info_class_info";
                               $run=mysqli_query($conn73,$que);
                               while($row=mysqli_fetch_assoc($run)){
                               $class_name=$row['class_name'];
                               $class_code=$row['class_code']; ?>
						       <option value="<?php echo $class_name.'|?|'.$class_code; ?>"><?php echo $class_name; ?></option>
					           <?php } ?>
					    </select>
					  </select>
					</div>
				</div>
				<div class="col-md-12 ">	
					<div class="form-group" >
					    <label>Section</label>
					    <select class="form-control" name="student_class_section" onchange='for_concession();' id="student_class_section" >
						<option value="All">All</option>
						
					    </select>
					</div>
				</div>
				<div class="col-sm-12">
				<label>Category</label>
				<select name="category_code" id="category_code" style="width:100%;" class="form-control" onchange='for_concession();' required >
				<option value="">Select Category</option>
				<option value="category3">New Hostlers</option>
				<option value="category4">Old Hostlers</option>
				</select>
				</div>
			  </div>
			  
			  </div>
			  </div>
			  <div class="col-sm-12" id="student_list">
			  </div>
			  </div>
			  
              <div class="col-sm-8">
			  <table id="" class="table table-bordered table-striped">
                <thead >
                <tr>
				  <td>#<input type="checkbox"  id="check_all1" checked onclick="for_check_all(this.id);" ></td>
				  <td>Actual Value</td>				  
				  <td>After Discount Amt</td>				  
				  <td style="width:120px;">Discount Amt</td>				  
				  <td style="width:120px;" >Percentage</td>				  
				  <td style="width:120px;">Set Discount</td>
				  <td>Discount Remark</td>
                </tr>
                </thead>
                <tbody id="set_value">
					<?php
					$que1="select * from school_info_hostel_head where fee_head_type='Regular' ORDER BY fee_head_priority";
					$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
					$serial_no=0;
					while($row1=mysqli_fetch_assoc($run1)){
					$fee_head_name = $row1['fee_head_name'];
					
					if($fee_head_name !=''){
					$serial_no++;
					?>
					<tr>
					
					<td><span style="color:#C2260D;"><?php echo $serial_no.'.'; ?></span></td>
					<td colspan="6"><span style="color:#C2260D;"><?php echo $fee_head_name; ?></span></td>
					</tr>
					<tr>
					<td><input type="checkbox" name="" value="" class="check_all1" checked ></td>
					<td><input type="text" name="" class="form-control" placeholder="Actual Amount" readonly />
					</td>
					<td><input type="text" name="" class="form-control" placeholder="After Discount Amount" readonly /></td>
					
					<td><input type="text" name="" class="form-control" placeholder="Discount Amount" readonly /></td>
					<td><input type="text" name="" class="form-control" placeholder="Percentage" readonly /></td>
					<td>
					<select name="" class="form-control" id="">
					<option value="0|?|none">None</option>
					<option  value="50|?|half_fee">Half Fee</option>
					<option  value="100|?|free">Free</option>
					<option value="custom">Custom</option>
					<option value="100|?|NA">NA</option>
					</select>
					</td>
					<td><input type="text" name="" placeholder="Remark" class="form-control" readonly /></td>
					</tr>
					<?php } } ?>
                </tbody>
              </table>
              </div>
              </div>
			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	</form>
  </div>
    
  </div>
  
	<!---*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************-->
 <?php include("../attachment/footer.php"); ?>
 <?php include("../attachment/sidebar_2.php"); ?>
</div>
 <?php include("../attachment/link_js.php"); ?>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
</body>
</html>
<?php
if(isset($_POST['submit'])){
if(isset($_POST['student_roll_no']) && isset($_POST['fee_type_check'])){
$fee_type_check=$_POST['fee_type_check'];
$student_roll_no=$_POST['student_roll_no'];
$fee_discount_percentage=$_POST['fee_discount_percentage'];
$fee_discount_type1=$_POST['fee_discount_type'];
$fee_discount_remark=$_POST['fee_discount_remark'];
$current_date=date('Y-m-d');
$count23=count($fee_type_check);
$discount_type_value='';
$discount_amount_value='';
$discount_remark_value='';
for($l=0;$l<$count23;$l++){
$fee_type_check1=explode('|?|',$fee_type_check[$l]);
$fee_code1=$fee_type_check1[0];
$discount_type_column=$fee_code1."_discount_type";
$discount_amount_column=$fee_code1."_discount_amount";
$discount_remark_column=$fee_code1."_discount_remark";
$index1=$fee_type_check1[1];
if($fee_discount_type1[$index1]=='custom'){
$fee_discount_type3[$index1]=$fee_discount_type1[$index1];
}else{
$fee_discount_type2=explode('|?|',$fee_discount_type1[$index1]);
$fee_discount_type3[$index1]=$fee_discount_type2[1];
}
$discount_type_value=$discount_type_value.",$discount_type_column='$fee_discount_type3[$index1]'";
$discount_amount_value=$discount_amount_value.",$discount_amount_column='$fee_discount_percentage[$index1]'";
$discount_remark_value=$discount_remark_value.",$discount_remark_column='$fee_discount_remark[$index1]'";
}
$count22=count($student_roll_no);
for($k=0;$k<$count22;$k++){
$query123="select * from student_hostel_fees_discount where student_roll_no='$student_roll_no[$k]' and session_value='$session1'";
$result123=mysqli_query($conn73,$query123)or die(mysqli_error($conn73));
if(mysqli_num_rows($result123)<1){
$query1234="insert into student_hostel_fees_discount(student_roll_no,session_value,$update_by_insert_sql_column) values('$student_roll_no[$k]','$session1',$update_by_insert_sql_value)";
mysqli_query($conn73,$query1234);
}
$query12345="update student_hostel_fees_discount set fee_status='Active',last_updated_date='$current_date'$discount_type_value$discount_amount_value$discount_remark_value,$update_by_update_sql  where student_roll_no='$student_roll_no[$k]' and session_value='$session1'";
mysqli_query($conn73,$query12345);
}
echo "<script>alert_new('Successfully Add Discount !!!');</script>";
}else{
echo "<script>alert_new('Please Select Atleast One Student & One Fee !!!');</script>";
}
}
?>
<script>

</script>