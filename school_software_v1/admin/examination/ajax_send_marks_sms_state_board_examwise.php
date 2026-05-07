<?php include("../attachment/session.php");
?>
<?php
$student_class=$_POST['student_class'];
$student_section=$_POST['student_class_section'];
$student_class_stream=$_POST['student_class_stream'];
$student_class_group=$_POST['student_class_group'];

if(isset($_POST['selected_exam'])){
$selected_exam=$_POST['selected_exam'];
}else{
$selected_exam=array();
}
if(isset($_POST['selected_exam_monthly'])){
$selected_exam_monthly=$_POST['selected_exam_monthly'];
}else{
$selected_exam_monthly=array();
}
if(isset($_POST['selected_subject'])){
$selected_subject=$_POST['selected_subject'];
}else{
$selected_subject=array();
}
$sub_count=count($selected_subject);
$sub_condition='';
$seprtr='';
for($t=0; $t<$sub_count; $t++){
    $sub_condition=$sub_condition.$seprtr." subject_code='$selected_subject[$t]'";
    $seprtr=' || ';
}
if($sub_condition!=''){
    $sub_condition=' and ('.$sub_condition.')';
}

if($student_class=='11TH' || $student_class=='12TH'){
    $condition1=" and stream_name='$student_class_stream'";
    $condition01=" and student_class_stream='$student_class_stream'";
    $condition2=" and group_name='$student_class_group'";
    $condition02=" and student_class_group='$student_class_group'";
}else{
    $condition1="";
    $condition01="";
    $condition2="";
    $condition02="";
}
$query="select * from school_info_subject_info where class='$student_class' and (session_value='$session1' || session_value='') $condition1$condition2$sub_condition$filter37";
$res=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
$total_subject=0;
// $subject_code='';
// $subject_name='';
$total_marks=0;
$exm_cnt=0;
$exm_cnt1=0;
//$total_subject_code='';
$comma='';
while($row=mysqli_fetch_assoc($res)){
$subject_code[$total_subject]=$row['subject_code'];
$subject_name[$total_subject]=$row['subject_name'];
//$total_subject_code=$total_subject_code.$comma.$row['subject_code'];
//$comma='|?|';
$subjectwise_total_marks[$total_subject]=0;
$subjectwise_exam_date[$total_subject]='';
if(isset($_POST['selected_exam_monthly'])){
$monthly_exam_count=count($selected_exam_monthly);
$exm_cnt=$monthly_exam_count;
for($aq=0;$aq<$monthly_exam_count;$aq++){
$total_marks=$total_marks+$row['monthly_'.$selected_exam_monthly[$aq].'_maximum_mark'];
$subjectwise_total_marks[$total_subject]=$subjectwise_total_marks[$total_subject]+$row['monthly_'.$selected_exam_monthly[$aq].'_maximum_mark'];
$subjectwise_exam_date[$total_subject]=$row['monthly_'.$selected_exam_monthly[$aq].'_time_date'];
}
}
if(isset($_POST['selected_exam'])){
$exam_count=count($selected_exam);
$exm_cnt1=$exam_count;
for($aq1=0;$aq1<$exam_count;$aq1++){
$total_marks=$total_marks+$row[$selected_exam[$aq1].'_maximum_mark'];
$subjectwise_total_marks[$total_subject]=$subjectwise_total_marks[$total_subject]+$row[$selected_exam[$aq1].'_maximum_mark'];
$subjectwise_exam_date[$total_subject]=$row[$selected_exam[$aq1].'_time_date'];
}
}
$total_subject++;
}

$my_exm_cnt=$exm_cnt+$exm_cnt1;
// $my_exm_name='';
if($my_exm_cnt==1){
$query003="select * from school_info_class_info where class_name='$student_class'";
$res003=mysqli_query($conn73,$query003)or die(mysqli_error($conn73));
while($row003=mysqli_fetch_assoc($res003)){
$class_code=$row003['class_code']; 
}
$query00="select * from school_info_exam_types where exam_type!='' and class_code='$class_code' and (session_value='$session1' || session_value='') $filter37";
$res00=mysqli_query($conn73,$query00)or die(mysqli_error($conn73));
// $exam_type11='';
while($row00=mysqli_fetch_assoc($res00)){
$exam_code11=$row00['exam_code'];
$exam_type11[$exam_code11]=$row00['exam_type'];
}
$query000="select * from school_info_exam_types_monthly where exam_type!='' and class_code='$class_code' and (session_value='$session1' || session_value='') $filter37";
$res000=mysqli_query($conn73,$query000)or die(mysqli_error($conn73));
// $exam_type111='';
while($row000=mysqli_fetch_assoc($res000)){
$exam_code111=$row000['exam_code'];
$exam_type111[$exam_code111]=$row000['exam_type'];
}

if(isset($_POST['selected_exam'])){
    for($as=0;$as<$exam_count;$as++){
        $my_exm_name=' in '.$exam_type11[$selected_exam[$as]];
    }
}
if(isset($_POST['selected_exam_monthly'])){
    for($as1=0;$as1<$monthly_exam_count;$as1++){
        $my_exm_name=' in '.$exam_type111[$selected_exam_monthly[$as1]];
    }
}
}
?>

        <div class="col-md-12">
          <!-- /.box -->
          <div class="box <?php echo $box_head_color; ?>" >
            <!-- /.box-header -->
			<div class="col-md-10 col-md-offset-1">
            <div class="box-body table-responsive" id="printTable">
			<?php
			$schl_query="select school_info_school_name,school_info_dise_code,school_info_school_code from school_info_general";
			$schl_result=mysqli_query($conn73,$schl_query)or die(mysqli_error($conn73));
			while($schl_row=mysqli_fetch_assoc($schl_result)){
			$school_info_school_name=$schl_row['school_info_school_name'];
			$school_info_dise_code=$schl_row['school_info_dise_code'];
			$school_info_school_code=$schl_row['school_info_school_code'];
			}
				
			?>

   <div class="col-md-12">
	<!-- <input type="hidden" name="total_subject_code" value="<?php //echo $total_subject_code; ?>" class="form-control" readonly />	-->	
				  <table  class="table table-bordered table-striped" border="1px" cellpadding="10px" cellspacing="0" width="100%">
						<thead class="my_background_color">
								<tr>
								  <th>S.NO.</th>
								  <th>Student Name</th>
								  <th>Father Name</th>
								  <th>Student_Roll_No</th>
								  <?php for($i1=0;$i1<$total_subject;$i1++){ ?>
								  <th><?php echo $subject_name[$i1]; ?></th>
								  <?php } ?>
								  <th>Total Marks</th>
								  <th>Total Obtain</th>
								  <th><input type="checkbox" value="" id="sel_student" onclick="for_check1(this.id);" checked /><b>Check All</b></th>
								</tr>
						</thead>
					<tbody >
<?php
$query3="select * from student_admission_info where student_class='$student_class' and student_class_section='$student_section' and student_status='Active' and session_value='$session1'$condition01$condition02 $filter37 ORDER BY school_roll_no ASC";
$serial_no=0;
$serial_no11=0;
$res3=mysqli_query($conn73,$query3) or die(mysqli_error($conn73));
while($row3=mysqli_fetch_assoc($res3)){
$school_roll_no=$row3['school_roll_no'];
$student_name=$row3['student_name'];
$student_father_name=$row3['student_father_name'];
$student_roll_no=$row3['student_roll_no'];
$student_class1=$row3['student_class'];
$student_class_section1=$row3['student_class_section'];
$student_sms_contact_number=$row3['student_sms_contact_number'];

$total_obtain=0;
$ex_count=0;
if(isset($_POST['selected_exam_monthly'])){
$query1="select * from examination_monthly where student_roll_no='$student_roll_no' and session_value='$session1'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($res1)){
for($p2=0;$p2<$total_subject;$p2++){
$subjectwise_total_obtain[$p2]=0;
for($p1=0;$p1<$monthly_exam_count;$p1++){
$exam_marks1=$selected_exam_monthly[$p1]."_".$subject_code[$p2]."_marks";
$total_obtain=$total_obtain+$row1[$exam_marks1];
$subjectwise_total_obtain[$p2]=$subjectwise_total_obtain[$p2]+$row1[$exam_marks1];
}
}
$ex_count++;
}
}

if(isset($_POST['selected_exam'])){
$query01="select * from examination where student_roll_no='$student_roll_no' and session_value='$session1'";
$res01=mysqli_query($conn73,$query01) or die(mysqli_error($conn73));
while($row01=mysqli_fetch_assoc($res01)){
for($p02=0;$p02<$total_subject;$p02++){
if(!isset($_POST['selected_exam_monthly'])){
$subjectwise_total_obtain[$p02]=0;
}
for($p01=0;$p01<$exam_count;$p01++){
$exam_marks01=$selected_exam[$p01]."_".$subject_code[$p02]."_marks";
$total_obtain=$total_obtain+$row01[$exam_marks01];
$subjectwise_total_obtain[$p02]=$subjectwise_total_obtain[$p02]+$row01[$exam_marks01];
}
}
$ex_count++;
}
}
$serial_no11++;

$total_subject_string1='';
$seprator='';
if($ex_count>0){
for($a1=0;$a1<$total_subject;$a1++){
$student_attendace[$a1]='';
if($subjectwise_exam_date[$a1]!='' && $subjectwise_exam_date[$a1]!='0000-00-00'){

$subjectwise_exam_date11=explode('-',$subjectwise_exam_date[$a1]);
$query000="select * from student_attendance where attendance_roll_no='$student_roll_no' and month='$subjectwise_exam_date11[1]' and year='$subjectwise_exam_date11[0]' and session_value='$session1'";
$res000=mysqli_query($conn73,$query000) or die(mysqli_error($conn73));
while($row000=mysqli_fetch_assoc($res000)){
$student_attendace[$a1]=$row000[$subjectwise_exam_date11[2]];
}
if($student_attendace[$a1]=='A' || $student_attendace[$a1]=='L'){
$total_subject_string1=$total_subject_string1.$seprator.$subject_name[$a1].'-'.$student_attendace[$a1];
$seprator=', ';
}else{
$total_subject_string1=$total_subject_string1.$seprator.$subject_name[$a1].'-'.$subjectwise_total_obtain[$a1].'/'.$subjectwise_total_marks[$a1];
$seprator=', ';
}
    
}else{
$total_subject_string1=$total_subject_string1.$seprator.$subject_name[$a1].'-'.$subjectwise_total_obtain[$a1].'/'.$subjectwise_total_marks[$a1];
$seprator=', ';
}
}
}
?>
<tr>
<td><?php echo $serial_no11; ?></td>
<td><?php echo $student_name; ?><input type="hidden" name="other_detail[]" value="<?php echo $student_name.'|?|'.$student_sms_contact_number.'|?|'.$my_exm_name; ?>" class="form-control" readonly /></td>
<td><?php echo $student_father_name; ?></td>
<td><?php echo $school_roll_no; ?><input type="hidden" name="total_subject_string[]" value="<?php echo $total_subject_string1; ?>" class="form-control" readonly /></td>
<?php for($i1=0;$i1<$total_subject;$i1++){ if($ex_count>0){ if($student_attendace[$i1]=='A' || $student_attendace[$i1]=='L'){ ?>
<td><?php echo $student_attendace[$i1] ?></td>
<?php }else{ ?>
<td><?php echo $subjectwise_total_obtain[$i1].'/'.$subjectwise_total_marks[$i1]; ?></td>
<?php } }else{ ?>
<td>&nbsp;</td>
<?php } } ?>
<td><input type="text" name="total_marks[]" value="<?php echo $total_marks; ?>" style="width:50px;background:#ECEBEB;" readonly /></td>
<td><input type="text" name="total_obtain[]" value="<?php echo $total_obtain; ?>" style="width:50px;background:#ECEBEB;" readonly /></td>
<td><input type="checkbox" name="indexes[]" value="<?php echo $serial_no; ?>" class="sel_student" checked /></td>

</tr>
<?php
$serial_no++;
}
?>
<tr>
<td colspan="<?php echo $total_subject+7; ?>"><center><input type="submit" name="submit" value="Send SMS" onclick="return validate();" class="btn btn-success" /></center></td>
</tr>
					</tbody>
				 </table>
				 
		
		</div>	  
        <!-- /.col -->
      </div>
      </div>
      </div>
      </div>