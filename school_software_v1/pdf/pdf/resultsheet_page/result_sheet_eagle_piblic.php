<?php
include("../../../admin/attachment/session.php");
if(isset($_SESSION['database_name1'])){
$session_value=$session_value;
$query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
        while($row=mysqli_fetch_assoc($run1)){
        $school_info_school_name = strtoupper($row['school_info_school_name']);
        $school_info_school_district = $row['school_info_school_district'];
		$school_info_school_district = strtoupper($school_info_school_district);
		$school_info_school_code = $row['school_info_school_code'];
	    $school_info_dise_code = $row['school_info_dise_code'];
	    $school_info_registration_code = $row['school_info_registration_code'];
		$school_info_school_address = $row['school_info_school_address'];
		$school_info_school_contact_no = $row['school_info_school_contact_no'];
		$school_info_school_email_id = $row['school_info_school_email_id'];
		$school_info_school_website = $row['school_info_school_website'];
		$school_info_school_city = $row['school_info_school_city'];
		$school_info_medium = $row['school_info_medium'];

	$school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
	
	if($school_info_logo!=''){
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;
	
    $school_logo=str_replace(" ","%20",$path1);
	}
		if($school_info_principal_signature!=''){
    $path2=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_signature;
    
    $principal_signature=str_replace(" ","%20",$path2);
		}
    	if($school_info_principal_seal!=''){
    $path3=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_seal;
    
    $principal_seal=str_replace(" ","%20",$path3);
    	}
    
    
    
    
}


$student_roll_no_get=$_GET['roll_no'];
$student_class_get=$_GET['class'];
$class_name=$_GET['class'];
$session_value=$_GET['session'];
$student_class_section_get=$_GET['section'];
$student_class_stream_get=$_GET['student_class_stream'];
$student_class_group_get=$_GET['student_class_group'];  
$exam_type=$_GET['exam_type'];
$condition="and student_class='$student_class_get'";
if($student_class_section_get!='')
$sec_condition="and (student_class_section='A' or student_class_section='B') ";  
else
$sec_condition='';

    $total_student_filter=0;
    $total_girls=0;
    $total_boys=0;
    $total_student=0;
    $total_general=0;
    $total_sc=0;
    $total_st=0;
    $total_obc=0;
   
      
      $query2="select s_no from student_admission_info where  student_status='Active' and session_value='$session_value'$condition$sec_condition$filter37  ORDER BY school_roll_no ASC";
	  $run2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
	  while($row2=mysqli_fetch_assoc($run2)){
	  $student_roll_no_filter[$total_student_filter]=$row2['s_no'];
      $total_student_filter++;
      $total_girls++;
      $total_general++;
	  }
	  
	  $total_student=0;
	  for($sss=0;$sss<$total_student_filter;$sss++){    
   $que1="select * from student_admission_info where s_no='$student_roll_no_filter[$sss]'";
  $run1=mysqli_query($conn73,$que1);
while($row1=mysqli_fetch_assoc($run1)){ 
	$student_id=$row1['student_roll_no'];
	$student_data[$total_student]=$row1['student_roll_no'];
	$student_name[$student_id]=$row1['student_name'];
	$student_father_name[$student_id]=$row1['student_father_name'];
	$student_mother_name[$student_id]=$row1['student_mother_name'];
	$student_class[$student_id]=$row1['student_class'];
	$student_class_section[$student_id]=$row1['student_class_section'];
	$student_admission_number[$student_id]=$row1['student_admission_number'];
	$student_gender[$student_id]=$row1['student_gender'];
	$student_dob[$student_id]="";
	$student_dob_word[$student_id]=$row1['student_date_of_birth_in_word'];
	$school_roll_number[$student_id]=$row1['school_roll_no'];
	$student_category[$student_id]=$row1['student_category'];
	$student_dob[$student_id]=$row1['student_date_of_birth'];
 $student_adhar_number[$student_id]=$row1['student_adhar_number'];
	  $student_sssmid_number[$student_id]=$row1['student_child_id'];
	
	$student_scholar_number[$student_id]=$row1['student_scholar_number'];
	$student_adhar_number[$student_id]=$row1['student_adhar_number'];
		$student_sssmid_number[$student_id]=$row1['student_child_id'];
		$student_address[$student_id]=$row1['student_adress'];
		$student_city[$student_id]=$row1['student_city'];
		$student_district[$student_id]=$row1['student_district'];
		$student_state[$student_id]=$row1['student_state'];

$student_photo=$row1['student_image_name'];
if($student_photo!=''){
	    $student_image=$_SESSION['amazon_file_path']."student_documents/".$student_photo;$student_image=str_replace(" ","%20",$student_image);
	}else{
	    $student_image="../../../images/blank.jpg";
	}

$student_class_stream[$student_id]=$row1['student_class_stream'];
$student_class_group[$student_id]=$row1['student_class_group'];
$student_class_info[$student_id]=$student_class[$student_id]." [".$student_class_section[$student_id]."] ";
if($student_class[$student_id]=='11TH' || $student_class[$student_id]=='12TH' ){
 $student_class_info[$student_id]=$student_class_info[$student_id]." [".$student_class_stream[$student_id]."] ";
}
$total_student++;
}  
}
require('../fpdf_large1.php');
class PDF extends FPDF
{

public function GetVerticalPosition() {
  // Include page and Y position of the document
  return array(
    'page' => $this->PageNo(),
    'y' => $this->GetY(),
  );
}

public function SetVerticalPosition( $pos ) {
  // Set the page and Y position of the document
  $this->page = $pos['page'];
  $this->SetY( $pos['y'] );
}

public function FurthestVerticalPosition( $aPos, $bPos = null ) {
  if ( $bPos === null ) $bPos = $this->GetVerticalPosition();

  // Returns the "furthest" vertical position between two points, based on page and Y position
  if ( 
    ($aPos['page'] > $bPos['page']) // Furthest position is located on another page
    ||
    ($aPos['page'] == $bPos['page'] && $aPos['y'] > $bPos['y'] ) // Furthest position is within the same page, but further down
  ) {
    return $aPos;
  }else{
    return $bPos;
  }
}  
    
function TextWithDirection($x, $y, $txt, $direction='R'){
    if ($direction=='R')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',1,0,0,1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    elseif ($direction=='L')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',-1,0,0,-1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    elseif ($direction=='U')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,1,-1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    elseif ($direction=='D')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,-1,1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    else
        $s=sprintf('BT %.2F %.2F Td (%s) Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}  

function division($final_percentage){
    $division="-";
    if($final_percentage>=60){
$division='I Division';    
}elseif($final_percentage>=45){
$division='II Division';    
}elseif($final_percentage>=33){
$division='III Division';    
}
    return $division;
}    
    
function roman_class($class){  
    $roman_class="";
    if($class=='PRE SCHOOL'){
        $roman_class='PRE SCHOOL';
    }elseif($class=='PREP'){
        $roman_class='PREP';
    }elseif($class=='NURSERY'){
        $roman_class='NURSERY';
    }elseif($class=='KG'){
        $roman_class='KG';
    }elseif($class=='UKG'){
        $roman_class='UKG';
    }elseif($class=='1ST'){
        $roman_class='I';
    }elseif($class=='2ND'){
        $roman_class='II';
    }elseif($class=='3RD'){
        $roman_class='III';
    }elseif($class=='4TH'){
        $roman_class='IV';
    }elseif($class=='5TH'){
        $roman_class='V';
    }elseif($class=='6TH'){
        $roman_class='VI';
    }elseif($class=='7TH'){
        $roman_class='VII';
    }elseif($class=='8TH'){
        $roman_class='VIII';
    }elseif($class=='9TH'){
        $roman_class='IX';
    }elseif($class=='10TH'){
        $roman_class='X';
    }elseif($class=='11TH'){
        $roman_class='XI';
    }elseif($class=='12TH'){
        $roman_class='XII';
    }else{
        $roman_class=$class;
    }
    return $roman_class;
}       
    
function promotion_class($class){
    $promoted_class="";
if($class=='PRE SCHOOL'){
    $promoted_class="PREP";
}else if($class=='PREP'){
    $promoted_class="1ST";
}else if($class=='1ST'){
    $promoted_class="2ND";
}else  if($class=='2ND'){
    $promoted_class="3RD";
}else  if($class=='3RD'){
    $promoted_class="4TH";
}else  if($class=='4TH'){
    $promoted_class="5TH";
}else  if($class=='5TH'){
    $promoted_class="6TH";
}else  if($class=='6TH'){
    $promoted_class="7TH";
}else  if($class=='7TH'){
    $promoted_class="8TH";
}else  if($class=='8TH'){
    $promoted_class="9TH";
}else  if($class=='9TH'){
    $promoted_class="10TH";
}else  if($class=='10TH'){
    $promoted_class="11TH";
}else  if($class=='11TH'){
    $promoted_class="12TH";
}
return $promoted_class;
}

function grade($marks){
if(is_numeric($marks)){    
     $grade='';
     if($marks>=90){
     $grade="A+";
     }else if($marks>=80){
     $grade="A";
     }else if($marks>=70){
     $grade="B";
     }else if($marks>=60){
     $grade="C";
     }else if($marks>=50){
     $grade="D";
     }else if($marks>=40){
     $grade="E";
     }else if($marks>=0){
     $grade="F";
     }
     return $grade;
}else{
   return $marks;  
}
}

function fail_pass_remark($marks){
 if($marks>90){
     $remark="Execellent";
 }else if($marks>80){
     $remark="Very Good";
 }else if($marks>70){
     $remark="Good";
 }else if($marks>60){
     $remark="Good";
 }else if($marks>50){
     $remark="Need To Imporve";
 }else  if($marks>40){
     $remark="Poor";
 }else  if($marks>33){
     $remark="Very Poor";
 }else{
     $remark="Fail";
 } 
 return $remark;
}

function percentage($obtain,$total){
    $percentage=0;
    if($total!=0 && $total!=''){
        $percentage=round($obtain*100/$total,2);
    }
    return $percentage;
}

function Header(){
    
    $this->SetFillColor(210,247,210);
		$this->SetXY(0,0);
		$this->Cell(460,300,'',0,0,'C');
    $this->SetDrawColor(0,0,0);
		$this->SetLineWidth(0.5);
		$this->SetXY(3,3);
		$this->Cell(298,452,'',1);
			$this->SetXY(5,5);
}

function rank_calcuation(){
     global $total_subject,$exam_marks,$total_exam,$exam_minimum_marks,$exam_maximum_marks,$exam_marks_other,$student_class,
$total_exam,$exam_name,$exam_code,$grand_total_maximum,$grand_total_minimum,$grand_total_obtain,$fail_pass,$percentage,$grade,$total_subject,$subject,$subject_code,$exam_maximum_marks,$exam_minimum_marks,$exam_marks_add,$total_obtain,$total_subject_other,$subject_other,$subject_code_other,$exam_maximum_marks_other,$exam_minimum_marks_other,$exam_marks_add_other,$total_obtain_other,$total_subject_practical,$subject_practical,$subject_code_practical,$exam_maximum_marks_practical,$exam_minimum_marks_practical,$exam_marks_add_practical,$total_obtain_practical,$session_value,$total_days,$exam_maximum_marks_monthly,$other_exam_maximum_marks_monthly;
     global $student_class_get,$session_value,$student_class_group_get,$student_class_stream_get,$total_student;
     global $total_exam,$exam_name,$exam_code,$grand_total_maximum,$grand_total_minimum,$grand_total_obtain,$fail_pass,$percentage,$grade,$total_subject,$subject,$subject_code,$exam_maximum_marks,$exam_minimum_marks,$exam_marks_add,$total_obtain,$total_subject_other,$subject_other,$subject_code_other,$exam_maximum_marks_other,$exam_minimum_marks_other,$exam_marks_add_other,$total_obtain_other,$total_subject_practical,$subject_practical,$subject_code_practical,$exam_maximum_marks_practical,$exam_minimum_marks_practical,$exam_marks_add_practical,$total_obtain_practical,$session_value, $total_subject,$exam_marks,$total_exam,$exam_marks_other,$total_days,$total_present,$exam_marks_practical,$student_data;
    
     global $session_value,$conn73,$subject_code,$total_subject,$total_exam_monthly,$exam_marks_monthly,$exam_code_monthly,$rank_final_array;
  
     global $subjects_category,$subject_category_name_array,$subject_category_code_array; 
   $query1="select * from examination where student_class='$student_class_get' and session_value='$session_value'";
    $run1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
    while($row1=mysqli_fetch_assoc($run1)){

    $student_marks_obtain_rank=0; 
    $student_marks_maximum_rank=0; 
    $student_id=$row1['student_roll_no'];
   
    $total_obt_main_subject=0;
    $total_max_main_subject=0;
    $total_obt_other_subject=0;
    $total_max_other_subject=0;
    $over_all_obt=0;
    $over_all_max=0;
    $fail_pass='CLEAR';
    for($s=0;$s<$total_subject;$s++)
    {
    
    $subjects_wise_total[$s]=0;
    $subjects_wise_total_max[$s]=0;
    $subjects_wise_per[$s]=0;
    for($a=0;$a<$total_exam;$a++)
    {
     for($c=0;$c<$subjects_category[$subject_code[$s]];$c++)
     {
      $subjects_wise_total[$s]+=$exam_marks[$a][$s][$c];     
      $subjects_wise_total_max[$s]+=$exam_maximum_marks[$a][$s][$c];
     }
    }
    $total_obt_main_subject+=$subjects_wise_total[$s];
    $total_max_main_subject+=$subjects_wise_total_max[$s];
    $subjects_wise_per[$s]=$subjects_wise_total[$s]*100/$subjects_wise_total_max[$s];
    if($subjects_wise_per[$s]<40)
    $fail_pass='N.C';
    }
    
    for($o=0;$o<$total_subject_other;$o++)
    {
     for($a=0;$a<$total_exam;$a++)
     {
     for($c=0;$c<$subjects_category[$subject_code_other[$o]];$c++)
     {    
     $total_obt_other_subject+=$exam_marks_other[$a][$o][$c];
     $total_max_other_subject+=$exam_maximum_marks_other[$a][$o][$c];   
     }
     }
    }
    
    $over_all_max=$total_max_other_subject+$total_max_main_subject;
    $over_all_obt=$total_obt_other_subject+$total_obt_main_subject;

	$rank_array[$student_id]=$over_all_obt;
	

	}
/*arsort($rank_array);

$rankwise_student=array_keys($rank_array);
for($x=0;$x<count($rankwise_student);$x++){
    $rank=$x+1;
  $rank_final_array[$rankwise_student[$x]]=$rank;  
}*/



$json = json_encode($rank_array);
$rank_final_array=$this->getRanks($json);


}
 
function getRanks($json) {
        $tmp_arr = json_decode($json, TRUE);
        arsort($tmp_arr);
        $uniq_vals = array_values(array_unique($tmp_arr)); // unique values indexed numerically from 0
        
        foreach ($tmp_arr as $k => $v) {
            $tmp_arr[$k] = array_search($v, $uniq_vals) + 1; //as rank will start with 1
        }
        return $tmp_arr;
        }
        
function result_calcuation(){
    global     $student_class_get,$session_value,$student_class_group_get,$student_class_stream_get,$conn73,$total_student;
     global $total_exam,$exam_name,$exam_code,$grand_total_maximum,$grand_total_minimum,$grand_total_obtain,$fail_pass,$percentage,$grade,$total_subject,$subject,$subject_code,$exam_maximum_marks,$exam_minimum_marks,$exam_marks_add,$total_obtain,$total_subject_other,$subject_other,$subject_code_other,$exam_maximum_marks_other,$exam_minimum_marks_other,$exam_marks_add_other,$total_obtain_other,$total_subject_practical,$subject_practical,$subject_code_practical,$exam_maximum_marks_practical,$exam_minimum_marks_practical,$exam_marks_add_practical,$total_obtain_practical,$session_value,$conn73, $total_subject,$exam_marks,$total_exam,$exam_marks_other,$total_days,$total_present,$exam_marks_practical,$student_data;
    
     global $session_value,$conn73,$subject_code,$total_subject,$total_exam_monthly,$exam_marks_monthly,$exam_code_monthly,$rank_final_array,$grade_student_count,$exam_maximum_marks_monthly,$other_exam_maximum_marks_monthly,$practical_exam_maximum_marks_monthly,$exam_maximum_marks_practical,$exam_maximum_marks_other,$exam_maximum_marks_practical,$total_student,$student_id;
    global $subjects_category,$subject_category_name_array,$subject_category_code_array;
    
    $grade_student_count['Total']['A']=0;
    $grade_student_count['Total']['B']=0;
    $grade_student_count['Total']['C']=0;
    $grade_student_count['Total']['D']=0;
    $grade_student_count['Total']['E']=0;
    
      $grade_student_count['Male']['A']=0;
    $grade_student_count['Male']['B']=0;
    $grade_student_count['Male']['C']=0;
    $grade_student_count['Male']['D']=0;
    $grade_student_count['Male']['E']=0;
	
	  $grade_student_count['Female']['A']=0;
    $grade_student_count['Female']['B']=0;
    $grade_student_count['Female']['C']=0;
    $grade_student_count['Female']['D']=0;
    $grade_student_count['Female']['E']=0;
	  $grade_student_count['General']['A']=0;
    $grade_student_count['General']['B']=0;
    $grade_student_count['General']['C']=0;
    $grade_student_count['General']['D']=0;
    $grade_student_count['General']['E']=0;
	  $grade_student_count['SC']['A']=0;
    $grade_student_count['SC']['B']=0;
    $grade_student_count['SC']['C']=0;
    $grade_student_count['SC']['D']=0;
    $grade_student_count['SC']['E']=0;
	  $grade_student_count['ST']['A']=0;
    $grade_student_count['ST']['B']=0;
    $grade_student_count['ST']['C']=0;
    $grade_student_count['ST']['D']=0;
    $grade_student_count['ST']['E']=0;
	  $grade_student_count['OBC']['A']=0;
    $grade_student_count['OBC']['B']=0;
    $grade_student_count['OBC']['C']=0;
    $grade_student_count['OBC']['D']=0;
    $grade_student_count['OBC']['E']=0;
    
 
}

function get_exam_detail(){
global     $student_class_get,$session_value,$student_class_group_get,$student_class_stream_get,$conn73;
  global $total_exam,$exam_name,$exam_code,$grand_total_maximum,$grand_total_minimum,$grand_total_obtain,$fail_pass,$percentage,$grade,$total_subject,$subject,$subject_code,$exam_maximum_marks,$exam_minimum_marks,$exam_marks_add,$total_obtain,$total_subject_other,$subject_other,$subject_code_other,$exam_maximum_marks_other,$exam_minimum_marks_other,$exam_marks_add_other,$total_obtain_other,$total_subject_practical,$subject_practical,$subject_code_practical,$exam_maximum_marks_practical,$exam_minimum_marks_practical,$exam_marks_add_practical,$total_obtain_practical,$session_value,$conn73,$exam_name_monthly,$exam_code_monthly,$total_exam_monthly,
$exam_maximum_marks_monthly,$exam_minimum_marks_monthly,$exam_marks_add_monthly,$exam_maximum_marks,$total_exam,$other_exam_maximum_marks_monthly,$practical_exam_maximum_marks_monthly,$other_exam_maximum_marks_monthly,$exam_maximum_marks_practical;
  global $subjects_category,$subject_category_name_array,$subject_category_code_array,$exam_type;

$que4="select * from school_info_class_info where class_name='$student_class_get'";
$run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
while($row4=mysqli_fetch_assoc($run4)){
$class_code=$row4['class_code'];
}
$exam_condition='';
if($exam_type!='')
{
$exam_condition=" and exam_code='$exam_type'";    
}

$que="select * from school_info_exam_types where class_code='$class_code' $exam_condition and session_value='$session_value'$filter37";
$total_exam=0;
$run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
$exam_type7=$row1['exam_type'];
if($exam_type7!=''){
$exam_name[$total_exam]=$row1['exam_type'];
$exam_code[$total_exam]=$row1['exam_code'];
$total_exam++;
}
}



$que="select * from school_info_exam_types_monthly where class_code='$class_code' and session_value='$session_value'$filter37";
$total_exam_monthly=0;
$run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
while($row11=mysqli_fetch_assoc($run1)){
    $exam_type_monthly=$row11['exam_type'];
if($exam_type_monthly!=''){
 $exam_name_monthly[$total_exam_monthly]=$row11['exam_type'];
 $exam_code_monthly[$total_exam_monthly]=$row11['exam_code'];
 $total_exam_monthly++;
}
}


    $total_subject=0;
    $total_subject_other=0;
    $total_subject_practical=0;
 $query5="select * from school_info_subject_info where class='$student_class_get' and (filter2='Yes' || filter2='') and group_name='$student_class_group_get' and stream_name='$student_class_stream_get' and session_value='$session_value' $filter37 order by CAST(filter1 as SIGNED)";
$res4=mysqli_query($conn73,$query5) or die(mysqli_error($conn73));
while($row4=mysqli_fetch_assoc($res4)){ 
 $subject_code1=$row4['subject_code'];
 $subject_type=$row4['subject_type'];
 
 for($i=1;$i<=10;$i++){ 
    $subject_category=$row4['category'.$i];
    $subject_category_column='category'.$i;
    if($subject_category!=''){
       $category_set=1;
       $subject_category_name_array[$subject_code1][]=$subject_category;
       $subject_category_code_array[$subject_code1][]=$i-1;
       $subjects_category[$subject_code1]=$subjects_category[$subject_code1]+1;
      }
    }
    if($subjects_category[$subject_code1]==0){ 
    $subjects_category[$subject_code1]=1;
    $subject_category_name_array[$subject_code1][]='';
    $subject_category_code_array[$subject_code1][]='';
    }
 
 if($subject_type=='subject'){
 $subject[$total_subject]=$row4['subject_name'];
 $subject_code[$total_subject]=$row4['subject_code'];
for($j=0; $j<$total_exam; $j++){
 $exam_maximum_marks121=explode("|?|",$row4[$exam_code[$j]."_maximum_mark"]);
 $exam_minimum_marks121=explode("|?|",$row4[$exam_code[$j]."_minimum_mark"]);
 $exam_marks_add121=explode("|?|",$row4[$exam_code[$j]."_mark_add"]);    
 for($c=0;$c<$subjects_category[$subject_code1];$c++)
 {
 $exam_maximum_marks[$j][$total_subject][$c]=floatval($exam_maximum_marks121[$c]);
 $exam_minimum_marks[$j][$total_subject][$c]=floatval($exam_minimum_marks121[$c]);
 $exam_marks_add[$j][$total_subject][$c]=$exam_marks_add121[$c];
 }
}
/*

for($j=0; $j<$total_exam_monthly; $j++){
 $exam_maximum_marks_monthly[$j][$total_subject]=$row4["monthly_".$exam_code_monthly[$j]."_maximum_mark"];
 $exam_minimum_marks_monthly[$j][$total_subject]=$row4["monthly_".$exam_code_monthly[$j]."_minimum_mark"];
 $exam_marks_add_monthly[$j][$total_subject]=$row4["monthly_".$exam_code_monthly[$j]."_mark_add"];
}
*/
$total_obtain[$total_subject]=0;
$total_subject++;

}else if($subject_type=='other_subject'){
     $subject_other[$total_subject_other]=$row4['subject_name'];
 $subject_code_other[$total_subject_other]=$row4['subject_code'];
for($j=0; $j<$total_exam; $j++){
 $exam_maximum_marks_other121=explode("|?|",$row4[$exam_code[$j]."_maximum_mark"]);
 $exam_minimum_marks_other121=explode("|?|",$row4[$exam_code[$j]."_minimum_mark"]);
 $exam_marks_add_other121=explode("|?|",$row4[$exam_code[$j]."_mark_add"]);
 for($c=0;$c<$subjects_category[$subject_code1];$c++)
 {
  $exam_maximum_marks_other[$j][$total_subject_other][$c]=1; //floatval($exam_maximum_marks_other121[$c]);
  $exam_minimum_marks_other[$j][$total_subject_other][$c]=floatval($exam_minimum_marks_other121[$c]);
  $exam_marks_add_other[$j][$total_subject_other][$c]=$exam_marks_add_other121[$c];   
 }
}
/*for($j=0; $j<$total_exam_monthly; $j++){
 $other_exam_maximum_marks_monthly[$j][$total_subject_other]=$row4["monthly_".$exam_code_monthly[$j]."_maximum_mark"];
 $exam_minimum_marks_monthly[$j][$total_subject]=$row4["monthly_".$exam_code_monthly[$j]."_minimum_mark"];
 $exam_marks_add_monthly[$j][$total_subject]=$row4["monthly_".$exam_code_monthly[$j]."_mark_add"];
}*/
$total_obtain_other[$total_subject_other]=0;
$total_subject_other++;
}else if($subject_type=='practical'){
 $subject_practical[$total_subject_practical]=$row4['subject_name'];
 $subject_code_practical[$total_subject_practical]=$row4['subject_code'];
for($j=0; $j<$total_exam; $j++){
 $exam_maximum_marks_practical121=explode('|?|',$row4[$exam_code[$j]."_maximum_mark"]);
 $exam_minimum_marks_practical121=explode('|?|',$row4[$exam_code[$j]."_minimum_mark"]);
 $exam_marks_add_practical121=explode('|?|',$row4[$exam_code[$j]."_mark_add"]);    
 for($c=0;$c<$subjects_category[$subject_code1];$c++)
 {    
 $exam_maximum_marks_practical[$j][$total_subject_practical][$c]=floatval($exam_maximum_marks_practical121[$c]);
 $exam_minimum_marks_practical[$j][$total_subject_practical][$c]=floatval($exam_minimum_marks_practical121[$c]);
 $exam_marks_add_practical[$j][$total_subject_practical][$c]=$exam_marks_add_practical121[$c];
 }
}
/*for($j=0; $j<$total_exam_monthly; $j++){
 $practical_exam_maximum_marks_monthly[$j][$total_subject_practical]=$row4["monthly_".$exam_code_monthly[$j]."_maximum_mark"];
 $exam_minimum_marks_monthly[$j][$total_subject]=$row4["monthly_".$exam_code_monthly[$j]."_minimum_mark"];
 $exam_marks_add_monthly[$j][$total_subject]=$row4["monthly_".$exam_code_monthly[$j]."_mark_add"];
}*/
$total_obtain_practical[$total_subject_practical]=0;
$total_subject_practical++;
}
  

}
 $abc = 0;

}

function get_student_marks_info($student_id){  
    global $total_exam,$exam_name,$exam_code,$exam_marks_other,$grand_total_maximum,$grand_total_minimum,$grand_total_obtain,$fail_pass,$percentage,$grade,$total_subject,$subject,$subject_code,$exam_maximum_marks,$exam_minimum_marks,$exam_marks_add,$total_obtain,$total_subject_other,$subject_other,$subject_code_other,$exam_maximum_marks_other,$exam_minimum_marks_other,$exam_marks_add_other,$total_obtain_other,$total_subject_practical,$subject_practical,$subject_code_practical,$exam_maximum_marks_practical,$exam_minimum_marks_practical,$exam_marks_add_practical,$total_obtain_practical,$session_value,$conn73, $total_subject,$exam_marks,$total_exam,$exam_marks_other,$total_days,$total_present,$exam_marks_practical,$exam_marks_practical_monthly1,$exam_marks_other_monthly,$total_present_days,$total_working_days,$total_days1;
    
     global $session_value,$total_days_final,$total_present_final,$conn73,$subject_code,$student_class_get,$total_subject,$total_exam_monthly,$exam_marks_monthly,$exam_code_monthly,$total_present12,$total_present11,$total_present10,$total_present9,$total_present8,$total_present7,$total_present6,$total_present3,$total_present2,$total_present1,$total_student,$abc;
    global $subjects_category,$subject_category_name_array,$subject_category_code_array;
        
    
    $query1="select * from examination where student_roll_no='$student_id' and session_value='$session_value'";
    $run1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
    while($row1=mysqli_fetch_assoc($run1)){

     for($j=0; $j<$total_exam; $j++){
         
      //$total_days_final=$row1[$exam_code[3].'_total_attendance'];
      //$total_present_final=$row1[$exam_code[3].'_total_present']; 
     }


    for($i=0; $i<$total_subject; $i++){
     for($j=0; $j<$total_exam; $j++){
	$exam_marks_column=$exam_code[$j]."_".$subject_code[$i]."_marks";
    $exam_marks121=explode('|?|',$row1[$exam_marks_column]);
    for($c=0;$c<$subjects_category[$subject_code[$i]];$c++)
    {
    $exam_marks[$j][$i][$c]=floatval($exam_marks121[$c]);  
    }
	}
	}
	/*for($i1=0; $i1<$total_subject_practical; $i1++){
	for($j1=0; $j1<$total_exam; $j1++){
	$exam_marks_column_practical=$exam_code[$j1]."_".$subject_code_practical[$i1]."_marks";
    $exam_marks_practical[$j1][$i1]=$row1[$exam_marks_column_practical];
	}
	} */
	for($i1=0; $i1<$total_subject_other; $i1++){
	for($j1=0; $j1<$total_exam; $j1++){
	$exam_marks_column_other=$exam_code[$j1]."_".$subject_code_other[$i1]."_marks";
    $exam_marks_other121=explode('|?|',$row1[$exam_marks_column_other]);
    for($c=0;$c<$subjects_category[$subject_code_other[$i1]];$c++)
    {
    $exam_marks_other[$j1][$i1][$c]=round(floatval($exam_marks_other121[$c]),2);    
    }
	}
	}

	}
	
	
 

}

function set_student_detail(){
     global $student_name,$student_admission_number,$student_father_name,$student_mother_name,$student_class,$student_class_section,$student_dob,$student_class_stream,
	$student_adhar_number,$student_sssmid_number,$student_address,$student_city,$student_district,$student_state,$student_dob_word,$student_image,$student_scholar_number,$student_class_get;
	  global $conn73,$school_info_school_name,$school_info_school_district,$filter37,$school_info_school_code,
$session_value,$school_info_school_address,$school_info_school_city,$school_info_dise_code,$school_info_registration_code,
$student_scholar_number,$school_info_medium,$principal_seal,$school_info_school_contact_no,$student_class,$principal_signature,$school_logo,$session_value,$total_subject,$subject,$total_subject_other;

    global $session_value,$student_class,$student_id,$total_girls,$total_boys,$total_student,$total_general,$total_sc,$total_st,$total_obc,$grade_student_count,$exam_maximum_marks,$total_subject,$total_exam,$total_exam_monthly,$exam_maximum_marks_monthly,$exam_maximum_marks_other,$other_exam_maximum_marks_monthly,$practical_exam_maximum_marks_monthly,$total_subject_practical,$exam_maximum_marks_practical,$total_days1,$total_present;


	
$this->SetFont('Times','B',16);
$this->SetTextColor(0,0,0);
$this->Cell(298,6,' '.$school_info_school_name.', '.$school_info_school_city."",0,0,'C');

$this->Ln();
$this->Cell(298,6,'ANNUAL RESULT SHEET '.str_replace("_","-",$session_value),0,0,'C');


}

function marksheet_design_1(){
    
global $total_subject,$exam_marks,$total_exam,$exam_minimum_marks,$exam_maximum_marks,$exam_marks_other,$student_class,
$total_exam,$exam_name,$exam_code,$grand_total_maximum,$grand_total_minimum,$grand_total_obtain,$fail_pass,$percentage,$grade,$total_subject,$subject,$subject_code,$exam_maximum_marks,$exam_minimum_marks,$exam_marks_add,$total_obtain,$total_subject_other,$subject_other,$subject_code_other,$exam_maximum_marks_other,$exam_minimum_marks_other,$exam_marks_add_other,$total_obtain_other,$total_subject_practical,$subject_practical,$subject_code_practical,$exam_maximum_marks_practical,$exam_minimum_marks_practical,$exam_marks_add_practical,$total_obtain_practical,$session_value,$conn73,$total_days,$student_father_name,$student_name,$student_class,$exam_marks_monthly,$total_exam_monthly,$exam_maximum_marks_monthly,$rank_final_array,$total_subject_other,$other_exam_maximum_marks_monthly;
global $student_data,$total_days_final,$total_present_final,$student_class_get,$total_student,$school_roll_number,$exam_marks_practical_monthly1,$practical_exam_maximum_marks_monthly,$exam_maximum_marks_practical,$total_present12,$total_present11,$total_present10,$total_present9,$total_present8,$total_present7,$total_present6,$total_present3,$total_present2,$total_present1;


     global $student_name,$student_admission_number,$student_father_name,$student_mother_name,$student_class,$student_class_section,$student_dob,$student_class_stream,
	$student_adhar_number,$student_sssmid_number,$student_address,$student_city,$student_district,$student_state,$student_dob_word,$student_image,$student_scholar_number,$student_class_get;
	  global $conn73,$school_info_school_name,$school_info_school_district,$filter37,$school_info_school_code,
$session_value,$school_info_school_address,$school_info_school_city,$school_info_dise_code,$school_info_registration_code,$grade_count,
$student_scholar_number,$school_info_medium,$principal_seal,$school_info_school_contact_no,$student_class,$principal_signature,$school_logo,$session_value,$student_category,$student_adhar_number,$student_sssmid_number,$total_subject_practical,$exam_marks_practical,$total_other_max_marks,$exam_marks_other_monthly,$grade1;

  global $subjects_category,$subject_category_name_array,$subject_category_code_array,$class_name,$exam_type;
  
$student_start=34;
$student_count=0;

$session_value1=explode('_',$session_value);

$rank=$_GET['rank'];
if($rank=='No')
$subject_with=111/$total_subject;
else
$subject_with=100/$total_subject;

$exam_name1='Final';
if($exam_type!='')
{
$exam_name1=$exam_name[0];
}


$this->SetXY(6,20);
$this->Cell(293,10,"",1,0,'C');

$this->SetFont('Times','B',10);
$this->SetXY(8,20);
$this->Cell(10,10,"Class : ".$class_name,0,0,'L');
$this->SetXY(90,20);
$this->Cell(10,10,"Year : ".$session_value1[0].'-'.$session_value1[1],0,0,'C');
$this->SetXY(150,20);
$this->Cell(10,10,"Result : ".$exam_name1,0,0,'C');

$this->SetFillColor(211,211,211);
$this->SetFont('Times','B',10);
$this->SetXY(6,30);
$this->Cell(10,8,"S No",1,0,'C',true);
$this->Cell(50,8,"Student Name",1,0,'C',true);
$this->Cell(50,8,"Father Name",1,0,'C',true);
for($s=0;$s<$total_subject;$s++)
$this->Cell($subject_with,8,"".substr($subject[$s],0,3),1,0,'C',true);
$this->Cell(9,8,"A.S",1,0,'C',true); 
$this->Cell(9,8,"G.S",1,0,'C',true); 
$this->Cell(9,8,"O.M",1,0,'C',true); 
$this->Cell(9,8,"T.M",1,0,'C',true); 
$this->Cell(10,8,"%age",1,0,'C',true); 
$this->Cell(12,8,"C/R",1,0,'C',true); 
$this->Cell(14,8,"Grade",1,0,'C',true); 
if($rank=='Yes')
$this->Cell(11,8,"Pos",1,0,'C',true); 

$this->SetFont('Times','',12);
$this->SetXY(30,38);
$get_student_position=array();
$get_student_rank_array=array();
for($k=0;$k<$total_student;$k++){ 
    $student_id=$student_data[$k];
    $this->get_student_marks_info($student_id);
    $row_value=5+10*$student_count;
    $student_count++;

    $student_postion=$student_start+$row_value;
  if($student_dob[$student_id]!=''){
     $student_dob_explode=explode("-",$student_dob[$student_id]); 
     $dd=$student_dob_explode[2];
     $mm=$student_dob_explode[1];
     $yy=$student_dob_explode[0];
     $dob=$dd."-".$mm."-".$yy;
  }else{
    $dd="";
     $mm="";
     $yy=""; 
     $dob="";
  }
$this->SetLeftMargin(0);
$this->SetFont('Times','B',12);
$this->SetTextColor(0,0,0);
$this->SetXY(6,$student_postion,'',0,0);
$this->Cell(10,10,"".$k+1,1,0,'C');
$this->Cell(50,10,$student_name[$student_id],1,0,'L');
$this->Cell(50,10,$student_father_name[$student_id],1,0,'L');
$this->SetFont('Times','',10);
$this->SetFont('Times','B',8);
$total_obt_main_subject=0;
$total_max_main_subject=0;
$total_obt_other_subject=0;
$total_max_other_subject=0;
$over_all_obt=0;
$over_all_max=0;
$fail_pass='CLEAR';

for($s=0;$s<$total_subject;$s++)
{

$subjects_wise_total[$s]=0;
$subjects_wise_total_max[$s]=0;
$subjects_wise_per[$s]=0;
for($a=0;$a<$total_exam;$a++)
{
 for($c=0;$c<$subjects_category[$subject_code[$s]];$c++)
 {
  $subjects_wise_total[$s]+=$exam_marks[$a][$s][$c];     
  $subjects_wise_total_max[$s]+=$exam_maximum_marks[$a][$s][$c];
 }
}
$total_obt_main_subject+=$subjects_wise_total[$s];
$total_max_main_subject+=$subjects_wise_total_max[$s];
$subjects_wise_per[$s]=$subjects_wise_total[$s]*100/$subjects_wise_total_max[$s];
if($subjects_wise_per[$s]<40)
$fail_pass='N.C';
$this->Cell($subject_with,10,"".$subjects_wise_total[$s],1,0,'C'); 
}

for($o=0;$o<$total_subject_other;$o++)
{
 for($a=0;$a<$total_exam;$a++)
 {
 for($c=0;$c<$subjects_category[$subject_code_other[$o]];$c++)
 {    
 $total_obt_other_subject+=$exam_marks_other[$a][$o][$c];
 $total_max_other_subject+=$exam_maximum_marks_other[$a][$o][$c];   
 }
 }
}

$over_all_max=$total_max_other_subject+$total_max_main_subject;
$over_all_obt=$total_obt_other_subject+$total_obt_main_subject;
$get_student_rank_array_1[$student_id]=$over_all_obt;

$this->Cell(9,10,"".$total_obt_main_subject,1,0,'C');
$this->Cell(9,10,"".$total_max_other_subject,1,0,'C');
$this->Cell(9,10,"".$over_all_obt,1,0,'C');
$this->Cell(9,10,"".$over_all_max,1,0,'C');
$this->Cell(10,10,"".round($over_all_obt*100/$over_all_max,2),1,0,'C');
$this->Cell(12,10,"".$fail_pass,1,0,'C');
$startPos = $this->GetVerticalPosition();
if($fail_pass=='CLEAR')
$this->Cell(14,10,"".$this->grade($over_all_obt*100/$over_all_max),1,0,'C');
else
$this->Cell(14,10,"",1,0,'C');
$furthestPos = $this->GetVerticalPosition();
$get_student_position[$student_id]=$furthestPos;

  if($student_postion>409){
    $student_start=0;
    $student_count=0;
    $this->AddPage(); 
    }
}
if($rank=='Yes')
{
$json = json_encode($get_student_rank_array_1);
$get_student_rank_array=$this->getRanks($json);
foreach($get_student_position as $index=>$value)
{
  $furthestPos=$get_student_position[$index];
  $this->SetVerticalPosition($furthestPos);
  $this->Cell(288,10,"",0,0,'C');
  $this->Cell(11,10,"".$get_student_rank_array[$index],1,0,'C');
}
}

}

function Footer(){
    global $student_class,$student_id,$fail_status,$grade_count;
    
 $this->SetFont('Times','B',14);
  $this->SetXY(14,438);
  
 $this->Cell(200,5,'Signature of Class Teacher',0,0,'L');
 $this->Cell(220,10,'Signature of Principal & Seal',0,0,'R');
}

function main_table(){
global $student_data,$student_class_get,$total_student;

$this->get_exam_detail();
$this->result_calcuation();
$this->set_student_detail();
$this->marksheet_design_1(); 
//$this->rank_calcuation();

}
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();                    
$pdf->SetAutoPageBreak(false,0);
$pdf->main_table();	
$pdf->Output('');
}else{
    echo "<center><h2 style='color:red;margin-top:300px'>Sorry!!! Your Session has been Expired Please login Again</h2></center>";
}
?>