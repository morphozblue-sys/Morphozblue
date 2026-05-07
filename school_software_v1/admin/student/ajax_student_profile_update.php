<?php include("../attachment/session.php");
$query_chk="select fees_type from school_info_general";
$result_chk=mysqli_query($conn73,$query_chk)or die(mysqli_error($conn73));
while($row_chk=mysqli_fetch_assoc($result_chk)){
$fees_type=$row_chk['fees_type'];
}
$student_class=$_GET['student_class'];
?>
<style>
#pu-table-wrap { margin: 0; }
#pu-table-wrap #example1 thead tr th { background: linear-gradient(135deg,#0f3460,#16213e); color: #fff; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .5px; border: none; white-space: nowrap; padding: 10px 8px; }
#pu-table-wrap #example1 thead tr th input[type=checkbox] { accent-color: #b92b27; width: 15px; height: 15px; }
#pu-table-wrap #example1 tbody tr:nth-child(odd)  { background: #f8f9fc; }
#pu-table-wrap #example1 tbody tr:nth-child(even) { background: #fff; }
#pu-table-wrap #example1 tbody tr:hover { background: #eef1f8; }
#pu-table-wrap #example1 tbody td { padding: 5px 6px; border-color: #e8eaef; vertical-align: middle; }
#pu-table-wrap #example1 tbody td input[type=text],
#pu-table-wrap #example1 tbody td input[type=date],
#pu-table-wrap #example1 tbody td input[type=number] {
    border: 1.5px solid #dce3ef !important;
    border-bottom: 1.5px solid #dce3ef !important;
    border-radius: 7px !important;
    height: 30px !important;
    padding: 3px 8px !important;
    font-size: 12px !important;
    background: #fff !important;
    box-shadow: none !important;
    min-width: 80px;
    transition: border-color .15s;
}
#pu-table-wrap #example1 tbody td input[type=text]:focus,
#pu-table-wrap #example1 tbody td input[type=date]:focus {
    border-color: #0f3460 !important;
    outline: none !important;
    box-shadow: 0 0 0 2px rgba(15,52,96,.1) !important;
}
#pu-table-wrap #example1 tbody td select {
    border: 1.5px solid #dce3ef !important;
    border-radius: 7px !important;
    height: 30px !important;
    padding: 2px 6px !important;
    font-size: 12px !important;
    background: #fff !important;
    box-shadow: none !important;
}
#pu-table-wrap #example1 tbody td input[type=checkbox] { accent-color: #0f3460; width: 15px; height: 15px; cursor: pointer; }
#pu-table-wrap .dataTables_wrapper .dataTables_paginate .paginate_button.current,
#pu-table-wrap .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover { background: linear-gradient(135deg,#0f3460,#16213e) !important; color: #fff !important; border-color: #0f3460 !important; border-radius: 6px; }
#pu-table-wrap .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background: #eef1f8 !important; color: #0f3460 !important; border-radius: 6px; }
.pu-submit-row { text-align: center; padding: 18px 0 4px; }
.pu-submit-btn { background: linear-gradient(135deg,#0f3460,#16213e); color: #fff; border: none; border-radius: 10px; padding: 11px 44px; font-size: 14px; font-weight: 700; letter-spacing: .5px; cursor: pointer; box-shadow: 0 4px 14px rgba(15,52,96,.25); transition: opacity .2s, transform .15s; }
.pu-submit-btn:hover { opacity: .88; transform: translateY(-1px); }
</style>

<div id="pu-table-wrap">
<table id="example1" class="table table-bordered table-striped">
	<thead >
	<tr>
	<th>All<input type="checkbox" id="checked1" checked value="" name="" onclick="for_check(this.id);"></th>
	<th>S No.</th>
	<th>Admission No.</th>
	<th>Name</th>
	<th style="display:none">Current Class</th>
	<th>Admission Class</th>
	<?php if($student_class=='11TH' || $student_class=='12TH') { ?>
    <th>class Stream</th>
	<th>Stream Group</th>
	<?php } ?>
    <th>Section</th>
	<th>Father Name</th>
	<th>Mother Name</th>
	<th>Adm. Date</th>
	<th>D.O.B</th>
	<th>Std Address</th>
	<th>Admission Scheme</th>
	<th>Std. Identity Category</th>
	<th>Father Cont No. </th>
	<th>Fee Category</th>
	<th>Bus</th>
	<th>Bus Route</th>
	<th>Bus Category / Stop</th>
	<th>Adm. No.</th>
	<th>Roll NO.</th>
	<th>Scholar No.</th>
	<th>Gender</th>
	<th>Category</th>
	<th>Religion</th>
	<th>Caste</th>
	<th>Bpl card No</th>
	<th>Income Certificate No</th>
	<th>Cast Certificate No</th>
	<th>Blood Group</th>
	<th>Show Status</th>
	<th>Medium</th>
	</tr>
	</thead>
	<tbody>
<?php
$student_class=$_GET['student_class'];
if($student_class!=''){  
$condition1=" and student_class='$student_class'";
}else{
$condition1="";
}
$student_class_section=$_GET['student_class_section'];
if($student_class_section!='All'){
$condition2=" and student_class_section='$student_class_section'";
}else{
$condition2="";
}
$student_class_stream=$_GET['student_class_stream'];
if($student_class_stream!='All'){
$condition3=" and student_class_stream='$student_class_stream'";
}else{
$condition3="";
}

$student_fee_category_code=$_GET['student_fee_category_code'];
if($student_fee_category_code!='All'){
	$condition05=" and student_fee_category_code='$student_fee_category_code'";
}else{
	$condition05="";
}
$student_limit=$_GET['student_limit'];

$order_by_filter=$_GET['order_by'];
$order_by_filter1="";
if($order_by_filter!='')
$order_by_filter1=" $order_by_filter ";
else
$order_by_filter1="ORDER BY student_name";



 $query1="select * from student_admission_info where student_status='Active' and session_value='$session1'$condition1$condition2$condition3$condition05$filter37 $order_by_filter1 LIMIT $student_limit, 20";
$run=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
$serial_no=0;
$serial_no11=0;
$serial_no12=$student_limit;
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
	$student_name = $row['student_name'];
	$student_father_name = $row['student_father_name'];
	$student_mother_name = $row['student_mother_name'];
	$student_previous_class = $row['student_previous_class'];
	$student_class = $row['student_class'];
	$student_class_section = $row['student_class_section'];
	$student_roll_no = $row['student_roll_no'];
	$student_admission_number = $row['student_admission_number'];
	$student_scholar_number = $row['student_scholar_number'];
	$student_adhar_number = $row['student_adhar_number'];
	$student_date_of_birth = $row['student_date_of_birth'];
	$student_date_of_admission = $row['student_date_of_admission'];
	$student_category = $row['student_category'];
	$blank_field_4 = $row['blank_field_4'];
	$student_gender = $row['student_gender'];
	$student_fee_category=$row['student_fee_category'];	
	$student_fee_category_code=$row['student_fee_category_code'];
	$student_bus_fee_category_code = $row['student_bus_fee_category_code'];
	$student_bus_fee_category = $row['student_bus_fee_category'];
	$student_bus = $row['student_bus'];
	$student_father_contact_number = $row['student_father_contact_number'];
	$student_identity_category = $row['student_identity_category'];
	$bpl_card_no = $row['bpl_card_no'];
	$income_certificate_no = $row['income_certificate_no'];
	$caste_certificate_no = $row['caste_certificate_no'];
	$student_bus_route = $row['student_bus_route'];
	$student_bus_no = $row['student_bus_no'];
	$student_admission_scheme = $row['student_admission_scheme'];
	$student_address = $row['student_adress'];
	$student_admission_class = $row['student_admission_class'];
	$school_roll_no = $row['school_roll_no'];
	$student_blood_group = $row['student_blood_group'];
	$student_class_stream1 = $row['student_class_stream'];
	$student_class_group = $row['student_class_group'];
	$student_caste = $row['student_caste'];
	
	$student_religion=$row['student_religion'];
	$student_medium=$row['student_medium'];
	if($student_admission_number==''){$student_admission_number=$student_scholar_number;}
    $serial_no++;
    $serial_no12++;
	?>
  <tr align='center'>
   
    <td><input type="checkbox" class="checked1" checked value="<?php echo $serial_no11; ?>" name="student_index[]"></td>
	<td><?php echo $serial_no12; ?></td>
	<td><?php echo $student_admission_number; ?></td>
	<td><input type="text" name="student_name[]" class="" value="<?php echo $student_name; ?>" title="<?php echo $student_name; ?>"><input type="hidden" name="student_roll_no[]" class="" value="<?php echo $student_roll_no; ?>"></td>
	<td style="display:none"><input type="text" name="student_class[]" class="" value="<?php echo $student_class.'('.$student_class_section.')'; ?>" title="<?php echo $student_name; ?>" style="width:80px;" readonly /></td>
	<td><input type="text" name="student_admission_class[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_admission_class; ?>"  style="width:80px;"></td>
	<?php if($student_class=='11TH' || $student_class=='12TH') { ?>
    <td>
	<select name="student_class_stream[]" style="width:60px;" title="<?php echo $student_name; ?>">
	<option value="">Select Stream</option>
	<?php
	$query19="select stream_name from school_info_stream_info where stream_name!=''";
	$run19=mysqli_query($conn73,$query19) or die(mysqli_error($conn73));
	while($row19=mysqli_fetch_assoc($run19)){
	$stream_name=$row19['stream_name'];
	?>
	<option <?php if($student_class_stream1==$stream_name){ echo "selected"; } ?> value="<?php echo $stream_name; ?>"><?php echo $stream_name; ?></option>
	<?php } ?>
	</select>
	</td> 
	<td>
	<select name="student_class_group[]" style="width:60px;" title="<?php echo $student_name; ?>">
	<option value="">Select group</option>
	<?php
	$query19="select group_name from school_info_stream_group where group_name!='' group by group_name";
	$run19=mysqli_query($conn73,$query19) or die(mysqli_error($conn73));
	while($row19=mysqli_fetch_assoc($run19)){
	$group_name=$row19['group_name'];
	?>
	<option <?php if($student_class_group==$group_name){ echo "selected"; } ?> value="<?php echo $group_name; ?>"><?php echo $group_name; ?></option>
	<?php } ?>
	</select>
	</td> 
	<?php } ?>
	<td>
	<select name="student_class_section[]" style="width:60px;" title="<?php echo $student_name; ?>">
	<?php
	$section=$_SESSION[$student_class.'_section37'];
	$section23=explode('_',$section);
	$total_section=count($section23);
	for($q=0;$q<$total_section;$q++){
	?>
	<option <?php if($student_class_section==$section23[$q]){ echo "selected"; } ?> value="<?php echo $section23[$q]; ?>"><?php echo $section23[$q]; ?></option>
	<?php } ?>
	</select>
	</td>
	<td><input type="text" name="student_father_name[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_father_name; ?>"></td>
	<td><input type="text" name="student_mother_name[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_mother_name; ?>"></td>
	<td><input type="date" name="student_date_of_admission[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_date_of_admission; ?>" style="width:130px;"></td>
	<td><input type="date" name="student_date_of_birth[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_date_of_birth; ?>" style="width:130px;"></td>
	<td><input type="text" name="student_address[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_address; ?>" style="width:130px;"></td>
	
	<td>
    <select name="student_admission_scheme[]" title="<?php echo $student_name; ?>">
    <option <?php if($student_admission_scheme=='NON-RTE'){ echo 'selected'; } ?> value="NON-RTE">NON-RTE</option>
    <option <?php if($student_admission_scheme=='RTE'){ echo 'selected'; } ?> value="RTE">RTE</option>
    </select>
    </td>
	
	<td>
	<select name="student_identity_category[]" style="width:60px;" title="<?php echo $student_name; ?>">
	<?php
	$query19="select identity_category_name from school_info_identity_category where identity_category_name!=''";
	$run19=mysqli_query($conn73,$query19) or die(mysqli_error($conn73));
	while($row19=mysqli_fetch_assoc($run19)){
	$identity_category_name=$row19['identity_category_name'];
	?>
	<option <?php if($student_identity_category==$identity_category_name){ echo "selected"; } ?> value="<?php echo $identity_category_name; ?>"><?php echo $identity_category_name; ?></option>
	<?php } ?>
	</select>
	</td>  
	
	
	<td>
	    <input style="width:90px;" type ="text" name="student_father_contact_number[]" title="<?php echo $student_name; ?>" value="<?php echo $student_father_contact_number; ?>">
	</td>
	
	<td>
    <select name="student_fee_category[]" title="<?php echo $student_name; ?>">
    <?php
    $que01="select category_name,category_code from school_info_fee_category where category_name!=''";
    $run01=mysqli_query($conn73,$que01) or die(mysqli_error($conn73));
    while($row01=mysqli_fetch_assoc($run01)){
    $category_name = $row01['category_name'];
    $category_code = $row01['category_code'];
    ?>
    <option <?php if($student_fee_category_code==$category_code){ echo 'selected'; } ?> value="<?php echo $category_name.'|?|'.$category_code; ?>"><?php echo $category_name; ?></option>
    <?php } ?>
    </select>
	</td>
	
	<td>
	<select name="student_bus[]" id="<?php echo 'student_bus_'.$serial_no; ?>" onchange="for_route('<?php echo $serial_no; ?>');" title="<?php echo $student_name; ?>">
	<option <?php if($student_bus=='No'){ echo 'selected'; } ?> value="No">No</option>
	<option <?php if($student_bus=='Yes'){ echo 'selected'; } ?> value="Yes">Yes</option>
	</select>
	</td>
	
	
	<td>
	<select name="student_bus_route[]" id="<?php echo 'student_bus_route_'.$serial_no; ?>" onchange="for_stop('<?php echo $serial_no; ?>');" title="<?php echo $student_name; ?>">
	<option value="">Select</option>
	<?php
	if($student_bus=='Yes'){
    $que12="select bus_route from bus_stop_details GROUP BY bus_route";
    $run12=mysqli_query($conn73,$que12);
    while($row12=mysqli_fetch_assoc($run12)){
    //$s_no=$row12['s_no'];
    $bus_route=$row12['bus_route'];
	?>
	<option <?php if($student_bus_route==$bus_route){ echo 'selected'; } ?> value="<?php echo $bus_route; ?>"><?php echo $bus_route; ?></option>
	<?php } } ?>
	</select>
	</td>
	<td>
	<select name="bus_fee_category_name[]" id="<?php echo 'bus_fee_category_name_'.$serial_no; ?>" onchange="for_no('<?php echo $serial_no; ?>');" title="<?php echo $student_name; ?>">
	<option value="">Select</option>
	<?php
	//if($student_bus_route!=''){
	if($fees_type=='fees1'){
    $query18="select bus_fee_category_name,bus_fee_category_code from school_info_bus_fee_category where bus_fee_category_name!=''";
    $run18=mysqli_query($conn73,$query18) or die(mysqli_error($conn73));
    while($row=mysqli_fetch_assoc($run18)){
    $bus_fee_category_name=$row['bus_fee_category_name'];
    $bus_fee_category_code=$row['bus_fee_category_code'];
	?>
	<option <?php if($student_bus_fee_category_code==$bus_fee_category_code){ echo "selected"; } ?> value="<?php echo $bus_fee_category_name.'|?|'.$bus_fee_category_code; ?>"><?php echo $bus_fee_category_name; ?></option>
	<?php } }elseif($fees_type=='fees' || $fees_type=='installmentwise' || $fees_type=='monthly' || $fees_type=='yearly'){
	$query19="select bus_fee_category_name,bus_fee_category_code from bus_fee_category where bus_fee_category_name!=''";
	$run19=mysqli_query($conn73,$query19) or die(mysqli_error($conn73));
	while($row19=mysqli_fetch_assoc($run19)){
	$bus_fee_category_name=$row19['bus_fee_category_name'];
	$bus_fee_category_code=$row19['bus_fee_category_code'];
	?>
	<option <?php if($student_bus_fee_category_code==$bus_fee_category_code){ echo "selected"; } ?> value="<?php echo $bus_fee_category_name.'|?|'.$bus_fee_category_code; ?>"><?php echo $bus_fee_category_name; ?></option>
	<?php } } //} ?>
	</select>
	<input type="hidden" name="student_bus_no[]" id="<?php echo 'student_bus_no_'.$serial_no; ?>" value="<?php echo $student_bus_no; ?>" />
	</td>
	<td><input type="text" name="student_admission_number[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_admission_number; ?>" style="width:60px;"></td>
	<td><input type="text" name="school_roll_no[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $school_roll_no; ?>" style="width:60px;"></td>
	<td><input type="text" name="student_scholar_number[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_scholar_number; ?>" style="width:60px;"></td>
	<td>
	<select name="student_gender[]" style="width:60px;" title="<?php echo $student_name; ?>">
	<option value="<?php echo $student_gender; ?>"><?php echo $student_gender; ?></option>
	<option value="Male">Male</option>
	<option value="Female">Female</option>
	</select>
	</td>
	<td>
	<select name="student_category[]" style="width:60px;" title="<?php echo $student_name; ?>">
	  <option value="<?php echo $student_category; ?>"><?php echo $student_category; ?></option>
	  <option value="General">General</option>
	  <option value="OBC">OBC</option>
	  <option value="SC">SC</option>
	  <option value="ST">ST</option>
	  <option value="Other">Other</option>
	</select>
	</td>
		<td>
	<select name="student_religion[]" style="width:60px;" title="<?php echo $student_name; ?>">
	  <option value="<?php echo $student_religion; ?>"><?php echo $student_religion; ?></option>
	  <option value="Hindu">Hindu</option>
					  <option value="Muslim">Muslim</option>
					  <option value="Sikh">Sikh</option>
					  <option value="Christian">Christian</option>
					  <option value="Jain">Jain</option>
					  <option value="Buddh">Buddh</option>
					  <option value="Other">Other</option>
	</select>
	</td>
	<td><input type="text" name="student_caste[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_caste; ?>" style="width:100px;"></td>
	<td><input type="text" name="bpl_card_no[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $bpl_card_no; ?>" style="width:100px;"></td>
	<td><input type="text" name="income_certificate_no[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $income_certificate_no; ?>" style="width:100px;"></td>
	<td><input type="text" name="caste_certificate_no[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $caste_certificate_no; ?>" style="width:100px;"></td>
	<td><input type="text" name="student_blood_group[]" class="" title="<?php echo $student_name; ?>" value="<?php echo $student_blood_group; ?>" style="width:100px;"></td>
	
		<td>
	<select name="blank_field_4[]"  title="<?php echo $student_name; ?>">
	<option value="<?php echo $blank_field_4; ?>"><?php echo $blank_field_4; ?></option>
	<option  value="No">No</option>
	<option  value="Yes">Yes</option>
	</select>
	</td>
	
	
	<td>
	<?php if($_SESSION['school_info_medium']=='Both'){ ?>
	    			  <select class="form-control" name="student_medium[]"  >
			
	
					   <option value="">Select</option>
					   <option  <?php if($student_medium=="English"){ echo "selected"; } ?>  value="English">English</option>
					   <option  <?php if($student_medium=="Hindi"){ echo "selected"; } ?>   value="Hindi">Hindi</option>
					    </select>
					    
	<?php }else{ ?> 
	<input type="text" name="student_medium[]" value="<?php echo $student_medium; ?>" style="width:100px;" readonly>
	<?php }?> 
					</div>
				</div>
	</td>
  </tr>
  
  
	
	<?php  $serial_no11++; } ?>
     </tbody>
</table>
</div><!-- /#pu-table-wrap -->
<div class="pu-submit-row">
    <button type="submit" name="finish" onclick="return validation();" class="pu-submit-btn">
        <i class="fa fa-check"></i> Submit
    </button>
</div>
	 
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
$(function () {
$('#example1').DataTable()
})
</script>