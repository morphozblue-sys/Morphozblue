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
 $order_by_key = isset($_GET['order_by']) ? $_GET['order_by'] : '';
 $order_by_map = [
     'name'    => ' ORDER BY student_name ASC',
     'father'  => ' ORDER BY student_father_name ASC',
     'roll_no' => ' ORDER BY CAST(school_roll_no AS SIGNED) ASC',
 ];
 $order_by = isset($order_by_map[$order_by_key]) ? $order_by_map[$order_by_key] : ' ORDER BY CAST(school_roll_no AS SIGNED) ASC';

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
$category_set=0;
 echo $query5="select * from school_info_subject_info where class='$student_class' and subject_code='$subject_name' and session_value='$session1'$condition_0011$filter37";
$res4=mysqli_query($conn73,$query5) or die(mysqli_error($conn73));
while($row4=mysqli_fetch_assoc($res4)){
  $student_maximum_marks=$row4[$exam_marks_maximum1];
  $student_minimum_marks=$row4[$exam_marks_minimum1];
  $exam_marks_add=$row4[$exam_marks_add1];
 
  for($i=1;$i<=10;$i++){
                $subject_category=$row4['category'.$i];
                $subject_category_column='category'.$i;
                    if($subject_category!=''){
                        $category_set=1;
                      $subject_category_name_array[]=$subject_category;
                      $subject_category_code_array[]=$i-1;
                    }
                }
                
                 if($category_set==1){
    if($student_maximum_marks==""){
        for($mm=0;$mm<10;$mm++){
        $student_maximum_marks_categorywise[$mm]="";
        }
    }else{
       $student_maximum_marks_explode=explode("|?|",$student_maximum_marks);
       if(count($student_maximum_marks_explode)>0){
          for($mm=0;$mm<10;$mm++){
        $student_maximum_marks_categorywise[$mm]=$student_maximum_marks_explode[$mm];
        }   
       }else{
           for($mm=0;$mm<10;$mm++){
               if($mm==0){
               $student_maximum_marks_categorywise[$mm]= $student_maximum_marks;   
               }else{
        $student_maximum_marks_categorywise[$mm]=$student_maximum_marks;
               }
        }   
       }
    }
    
    
    
        if($student_minimum_marks==""){
        for($mm=0;$mm<10;$mm++){
        $student_mimimum_marks_categorywise[$mm]="";
        }
    }else{
       $student_minimum_marks_explode=explode("|?|",$student_minimum_marks);
       if(count($student_minimum_marks_explode)>0){
          for($mm=0;$mm<10;$mm++){
        $student_minimum_marks_categorywise[$mm]=$student_minimum_marks_explode[$mm];
        }   
       }else{
           for($mm=0;$mm<10;$mm++){
               if($mm==0){
               $student_minimum_marks_categorywise[$mm]= $student_minimum_marks;   
               }else{
        $student_minimum_marks_categorywise[$mm]=$student_minimum_marks;
               }
        }   
       }
    }
    
    
    
        if($exam_marks_add==""){
        for($mm=0;$mm<10;$mm++){
        $student_exam_marks_add_categorywise[$mm]="";
        }
    }else{
          $exam_marks_add_explode=explode("|?|",$exam_marks_add);
       if(count($exam_marks_add_explode)>0){
          for($mm=0;$mm<10;$mm++){
        $student_exam_marks_add_categorywise[$mm]=$exam_marks_add_explode[$mm];
        }   
       }else{
           for($mm=0;$mm<10;$mm++){
               if($mm==0){
               $student_exam_marks_add_categorywise[$mm]= $exam_marks_add;   
               }else{
        $student_exam_marks_add_categorywise[$mm]=$exam_marks_add;
               }
        }   
       }
    }
    
    
  
         
    
}
                
                
}



?>

<input type="hidden" name="category_set" value="<?php echo $category_set; ?>">

<input type="hidden" name="category_set" value="<?php echo $category_set; ?>">
   <table id="" class="table table-bordered table-striped">
                <thead class="my_background_color">
                <tr>
				  <th><?php echo $language['S No']; ?></th>
                  <th><?php echo $language['Student Name']; ?></th>
                  <th><?php echo $language['Father Name']; ?></th>
                  <th><?php echo $language['Roll No']; ?></th>
                  <?php
                  if(isset($subject_category_name_array)){ 
                      
                  for($xx=0;$xx<count($subject_category_name_array);$xx++){  
                     ?>
                      <th><?php echo $subject_category_name_array[$xx]; ?></th> <input type="hidden" name="subject_category_code[]" value="<?php echo $subject_category_code_array[$xx]; ?>">   
               
               <?php }  }else{ ?>
				  <th><?php echo $language['Fill Mark']; ?></th>
				  <?php } ?>
				  <th>Total Days</th>
                  <th>Total Present</th>
                  <th>Remark</th>
				  
				  <th>Update By</th>
                  <th>Date</th>
				  
                </tr>
                </thead>
				
				<tbody >
				    
				    
				    <tr>
				        
				        
<td colspan="4"><center><b>Marks Add In Total Marks</b></center></td>
<?php for($aw0=0;$aw0<count($subject_category_name_array);$aw0++){ ?>
<td>
<select name="student_mark_add[<?php echo  $subject_category_code_array[$aw0]; ?>]" id="" style="width:60px;" title="<?php echo $subject_category_name_array[$aw0]; ?>" required>
<option <?php if($student_exam_marks_add_categorywise[$aw0]=='Yes'){ echo 'selected'; } ?> value="Yes">Yes</option>
<option <?php if($student_exam_marks_add_categorywise[$aw0]=='No' || $student_exam_marks_add_categorywise[$aw0]==''){ echo 'selected'; } ?> value="No">No</option>
</select>
</td>
<?php } ?>
<td>&nbsp;</td>
<td>&nbsp;</td>

<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4"><center><b>Maximum Marks</b></center></td>
<?php for($aw0=0;$aw0<count($subject_category_name_array);$aw0++){ ?>
<td><input type="text" name="student_maximum_marks[<?php echo  $subject_category_code_array[$aw0]; ?>]" value="<?php echo $student_maximum_marks_categorywise[$aw0]; ?>" id="<?php echo 'student_maximum_marks_'.$subject_category_code_array[$aw0]; ?>" title="<?php echo $subject_category_name_array[$aw0]; ?>" style="width:60px;"></td>
<?php } ?>
<td>&nbsp;</td>

<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4"><center><b>Minimum Marks</b></center></td>
<?php for($aw01=0;$aw01<count($subject_category_name_array);$aw01++){ ?>
<td><input type="text" name="student_minimum_marks[<?php echo  $subject_category_code_array[$aw01]; ?>]" value="<?php echo $student_minimum_marks_categorywise[$aw01]; ?>" id="<?php echo 'student_minimum_marks_'.$subject_category_code_array[$aw0]; ?>" title="<?php echo $subject_category_name_array[$aw01]; ?>" style="width:60px;"></td>
<?php } ?>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>



<!-- <tr>-->
				        
				        


				    
<?php


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
if($category_set==1){
    if($student_marks==""){
        for($mm=0;$mm<10;$mm++){
        $student_marks_categorywise[$mm]="";
        }
    }else{
       $student_marks_explode=explode("|?|",$student_marks);
       if(count($student_marks_explode)>0){
          for($mm=0;$mm<10;$mm++){
        $student_marks_categorywise[$mm]=$student_marks_explode[$mm];
        }   
       }else{
           for($mm=0;$mm<10;$mm++){
               if($mm==0){
               $student_marks_categorywise[$mm]= $student_marks;   
               }else{
        $student_marks_categorywise[$mm]="";
               }
        }   
       }
    }
}
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

 <?php
                  if(isset($subject_category_name_array)){ 
                  for($xx=0;$xx<count($subject_category_name_array);$xx++){  
                     ?>
                    
<td><input type="text" name="student_marks<?php echo $subject_category_code_array[$xx]; ?>[]" value="<?php echo $student_marks_categorywise[$xx]; ?>"  oninput="for_validation(this.id,this.value,'<?php echo $subject_category_code_array[$xx]; ?>');for_same(this.value);"  id="<?php echo 'id_'.$student_roll_no.$subject_category_code_array[$xx]; ?>" ></td>   
               
               <?php }  }else{ ?>
			
<td><input type="text" name="student_marks[]" value="<?php echo $student_marks; ?>" id="<?php echo 'id_'.$student_roll_no; ?>" class="check_for_same" ></td>
				  <?php } ?>



<td><input type="text" name="total_attendance[]" value="<?php echo $total_attendance; ?>"></td>
<td><input type="text" name="total_present[]" value="<?php echo $total_present; ?>"></td>
<td><input type="text" name="attendance_remark[]" value="<?php echo $attendance_remark; ?>"></td>

<td><?php echo $update_change; ?></td>
<td><?php echo $last_updated_date; ?></td>

</tr>
<?php } 


?>
    </tbody>
				
                </table>
                </div>
                <?php 
                if($serial_no>0){

}else{
}
?>