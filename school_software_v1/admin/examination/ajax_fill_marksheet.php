<?php include("../attachment/session.php");


 $student_class=$_GET['id'];
 $student_section=$_GET['student_section'];
 if($student_section!='All'){
     $sec_condition=" and student_class_section='$student_section'";
 }else{
     $sec_condition="";
 }
 $exam_type=$_GET['student_exam_type'];
 $subject_name=$_GET['subject_name'];
 $select_month=$_GET['select_month'];
 $order_by=$_GET['order_by'];

  $student_class_stream=$_GET['student_class_stream'];
 $student_class_group=$_GET['student_class_group'];
 
 if($student_class=='11TH' || $student_class=='12TH'){
     $condition_001=" and student_class_group='$student_class_group' and student_class_stream='$student_class_stream'";
     $condition_0011=" and group_name='$student_class_group' and stream_name='$student_class_stream'";
 }else{
     $condition_001="";
     $condition_0011="";
 }


if($_SESSION['software_link']=='eaglemountainschool'){
    $exam_number=str_replace("exam","",$exam_type);
   if($exam_number<9){
$exam_table="examination";  
}else{
$exam_table="examination_extra";  
}
}else{
$exam_table="examination";    
}


 $exam_marks1=$exam_type."_".$subject_name."_marks";
  $exam_marks_maximum1=$exam_type."_maximum_mark";
 $exam_marks_minimum1=$exam_type."_minimum_mark";
 $exam_marks_add1=$exam_type."_mark_add";
 
 $exp_session_year=explode('_',$session1);
 $exp_session_year1=$exp_session_year[0];
 $exp_session_year2=$exp_session_year[0]+1;

$query5="select * from school_info_subject_info where class='$student_class' and subject_code='$subject_name' and session_value='$session1'$condition_0011$filter37";
$res4=mysqli_query($conn73,$query5) or die(mysqli_error($conn73));
while($row4=mysqli_fetch_assoc($res4)){
 $student_maximum_marks=$row4[$exam_marks_maximum1];
 $student_minimum_marks=$row4[$exam_marks_minimum1];
 $exam_marks_add=$row4[$exam_marks_add1];
}
$query3="select * from student_admission_info where student_class='$student_class' and student_status='Active' and session_value='$session1'$sec_condition$condition_001$filter37$order_by";
$serial_no=0;
$res3=mysqli_query($conn73,$query3) or die(mysqli_error($conn73));
while($row3=mysqli_fetch_assoc($res3)){
$school_roll_no=$row3['school_roll_no'];
$student_name=$row3['student_name'];
$student_father_name=$row3['student_father_name'];
$student_roll_no=$row3['student_roll_no'];
$student_class1=$row3['student_class'];
$student_class_section1=$row3['student_class_section'];

$query1="select * from $exam_table where student_roll_no='$student_roll_no' and session_value='$session1'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
if(mysqli_num_rows($res1)>0){
}else{
	$que4="select * from school_info_class_info Where class_name='$student_class1'";
    $run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
    while($row4=mysqli_fetch_assoc($run4)){
    $class_code = $row4['class_code'];
    }
    $quer111="insert into $exam_table(student_roll_no,student_class,student_section,student_name,student_class_code,session_value,$update_by_insert_sql_column) values('$student_roll_no','$student_class1','$student_class_section1','$student_name','$class_code','$session1',$update_by_insert_sql_value)";
    mysqli_query($conn73,$quer111);
	$query1="select * from $exam_table where student_roll_no='$student_roll_no' and session_value='$session1'";
$res1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
}
while($row1=mysqli_fetch_assoc($res1)){
$student_marks=$row1[$exam_marks1];

$total_attendance=$row1[$exam_type.'_total_attendance'];
$total_present=$row1[$exam_type.'_total_present'];
$attendance_remark=$row1[$exam_type.'_attendance_remark'];

$update_change=$row1['update_change'];
if($row1['last_updated_date']!='0000-00-00'){
$last_updated_date=date('d-m-Y',strtotime($row1['last_updated_date']));
}else{
$last_updated_date=$row1['last_updated_date'];
}

}
$serial_no++;
if($select_month!=''){
    $total_attendance=0;
    $total_present=0;
    $exp_select_month=explode('|?|',$select_month);
    $exp_count=count($exp_select_month);
    for($ab=1; $ab<$exp_count; $ab++){
    
    $query01="select * from student_attendance where attendance_roll_no='$student_roll_no' and session_value='$session1' and month='$exp_select_month[$ab]'";
    $res01=mysqli_query($conn73,$query01) or die(mysqli_error($conn73));
    while($row01=mysqli_fetch_assoc($res01)){
    $year=$row01['year'];
    $month=$row01['month'];
    if(($month=='04' && $year==$exp_session_year1) || ($month=='06' && $year==$exp_session_year1) || ($month=='07' && $year==$exp_session_year1) || ($month=='08' && $year==$exp_session_year1) || ($month=='09' && $year==$exp_session_year1) || ($month=='10' && $year==$exp_session_year1) || ($month=='11' && $year==$exp_session_year1) || ($month=='12' && $year==$exp_session_year1) || ($month=='01' && $year==$exp_session_year2) || ($month=='02' && $year==$exp_session_year2) || ($month=='03' && $year==$exp_session_year2)){
    $complete_date=$year.'-'.$exp_select_month[$ab].'-01';
    $number = date(' t ', strtotime($complete_date) );
    
    $day_name = date(' N ', strtotime($complete_date) );
    $day_diff=8-$day_name;
    
    
    
    
        for($i=1;$i<=$number;$i++){
        
        if($i<10){
        $x='0'.$i;
        $a=$row01['0'.$i];
        $b=$a;
        }else{
        $x=$i;
        $a=$row01[$i];
        $b=$a;
        }
        
        if($i==$day_diff || $i==$day_diff+7 || $i==$day_diff+14 || $i==$day_diff+21 || $i==$day_diff+28){
        $a="S";
        }
        $date3=$x.'-'.$exp_select_month[$ab].'-'.$year;
        $que6="select * from holiday_manage where holiday_date='$date3'";
        $result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
        while($row5=mysqli_fetch_assoc($result)){
        $a="H";
        }
        
        if($a!='S' && $a!='H'){
        $total_attendance=$total_attendance+1;
        }
        
        if($a=='P'){
        $total_present=$total_present+1;
        }elseif($a=='P/2'){
        $total_present=$total_present+0.5;
        }
        }
    
    
    
    
    }
    }
    //exit();
    }
}

?>

<tr>
<td><?php echo $serial_no; ?></td>
<td style="display:none;">
<input type="text" name="exam_student_class" value="<?php echo $student_class; ?>" readonly />
</td>
<td style="display:none;">
<input type="text" name="subject_name" value="<?php echo $subject_name; ?>" readonly />
</td>
<td style="display:none;">
<input type="text" name="exam_type" value="<?php echo $exam_type; ?>" readonly />
</td>
<td>
<input style="border:none;" type="hidden" name="student_name[]" value="<?php echo $student_name; ?>" readonly />
<?php echo $student_name; ?>
</td>
<td>
<input style="border:none;" type="hidden" name="father_name[]" value="<?php echo $student_father_name; ?>" readonly />
<?php echo $student_father_name; ?>
</td>
<td>
<input style="border:none;" type="hidden" name="student_roll_no[]" value="<?php echo $student_roll_no; ?>" readonly />
<?php echo $school_roll_no; ?>
</td>
<td><input type="text" name="student_marks[]" value="<?php echo $student_marks; ?>" id="<?php echo 'id_'.$student_roll_no; ?>" oninput="for_validation(this.id,this.value);for_same(this.value);" class="check_for_same"></td>

<td><input type="text" name="total_attendance[]" value="<?php echo $total_attendance; ?>"></td>
<td><input type="text" name="total_present[]" value="<?php echo $total_present; ?>"></td>
<td><input type="text" name="attendance_remark[]" value="<?php echo $attendance_remark; ?>"></td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>

</tr>
<?php } 
if($serial_no>0){
echo "||".$student_maximum_marks."||".$student_minimum_marks."||".$exam_marks_add;
}else{
}

?>
