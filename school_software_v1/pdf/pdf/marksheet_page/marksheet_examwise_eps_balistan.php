<?php
include("../../../admin/attachment/session.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
$class_name=$_GET['class'];
$roll_no=$_GET['roll_no'];
$student_class_stream=$_GET['student_class_stream'];
$student_class_group=$_GET['student_class_group'];
$exam_code=$_GET['exam_type'];
$que4="select * from school_info_class_info where class_name='$class_name'";
$run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
while($row4=mysqli_fetch_assoc($run4)){
       $class_code=$row4['class_code'];
}
$que4="select * from school_info_exam_types where exam_code='$exam_code' and class_code='$class_code' and session_value='$session1'";
$run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
while($row4=mysqli_fetch_assoc($run4)){
       $exam_type2=$row4['exam_type'];
}
    $exam_type_statement=strtoupper($exam_type2);
    $query1="select * from school_info_general";
    $run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
    while($row=mysqli_fetch_assoc($run1)){
    $school_info_school_name = $row['school_info_school_name'];
    $school_info_school_district = $row['school_info_school_district'];
	$school_info_school_name = strtoupper($school_info_school_name);
	$school_info_school_district = strtoupper($school_info_school_district);
	$school_info_school_address = $row['school_info_school_address'];
    $school_info_school_city = $row['school_info_school_city'];
    $school_info_school_state =$row['school_info_school_state'];
    }

    $query121="select * from school_info_general";
    $run121=mysqli_query($conn73,$query121) or die(mysqli_error($conn73));
    while($row121=mysqli_fetch_assoc($run121)){
 	$school_info_principal_seal=$row121['school_info_principal_seal_name'];
	$school_info_principal_signature=$row121['school_info_principal_signature_name'];
	$school_info_logo=$row121['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
	
    $signature_image=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_signature;$signature_image=str_replace(" ","%20",$signature_image);
    }
  


require('../fpdf.php');

class PDF extends FPDF
{


// Page header
function Header()
{
    
}

function grade($marks)
{
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

}

// Page footer
function Footer()
{        
    global $total_max_marks,$total_obt_marks,$final_result,$total_obtain_other,$total_max_other;
         $final_obt=0;
         $final_max=0;
         
         $final_obt=$total_obt_marks+$total_obtain_other;
         $final_max=$total_max_marks+$total_max_other;
         $final_per=round($final_obt*100/$final_max,2);
         $final_grade=$this->grade($final_per);
         $this->SetFont('Times','',11);
		 $this->SetXY(90,201);
		 $this->Cell(50,72,'',1,0,'C');
		 $this->Ln(1);
		 $this->Cell(75);
		 $this->Cell(50,7,'Print Date : '.date('d-m-y'),0,0,'C');
		 $this->Ln(14);
		 $this->Cell(75);
		 $this->Cell(50,7,'Principal',0,0,'L');
		 $this->Ln(15);
		 $this->Cell(75);
		 $this->Cell(50,0.2,'',1,0,'L');
		 $this->Ln(22);
		 $this->Cell(75);
		 $this->Cell(50,7,'This is computer generated',0,0,'C');
		 $this->Ln(5);
		 $this->Cell(75);
		 $this->Cell(50,7,'report. Please let us know if',0,0,'C');
		 $this->Ln(5);
		 $this->Cell(75);
		 $this->Cell(50,7,'there are any errors.',0,0,'C');
		 
		 $this->SetFont('Times','B',11);
		 $this->SetXY(148,201);
		 $this->Cell(55,72,'',1,0,'C');
		 $this->Ln(0);
		 $this->Cell(133);
		 $this->Cell(55,8,'FINAL RESULT',1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->SetFont('Times','B',8);
		 $this->Cell(40,10,'TOTAL ACADEMIC SCORE',1,0,'R'); 
		 $this->Cell(15,10,''.$total_obt_marks,1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->Cell(40,10,'TOTAL GENERAL SCORE',1,0,'R'); 
		 $this->Cell(15,10,''.$total_obtain_other,1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->Cell(40,10,'TOTAL OBTAINED SCORE',1,0,'R'); 
		 $this->Cell(15,10,''.$total_obtain_other+$total_obt_marks,1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->Cell(40,10,'TOTAL SCORE',1,0,'R'); 
		 $this->Cell(15,10,''.$total_max_marks+$total_max_other,1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->Cell(40,10,'PERCENTAGE',1,0,'R'); 
		 $this->Cell(15,10,''.$final_per.'%',1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->Cell(40,7,'RESULT',1,0,'C'); 
		 $this->Cell(15,7,'GRADE',1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 if($final_result=='CLEAR')
		 {
// 		 $this->SetTextColor(0,200,0); 
         $this->SetFont('Times','B',9);
		 $this->Cell(40,7,''.$final_result,1,0,'C'); 
		 $this->Cell(15,7,''.$final_grade,1,0,'C'); 
		 }
		 else
		 {
		 $this->SetFont('Times','B',8);    
// 		 $this->SetTextColor(200,0,0);    
		 $this->Cell(40,7,''.$final_result,1,0,'C'); 
		 $this->Cell(15,7,'',1,0,'C');    
		 }
}

function Table1($roll_no)
{
include("../../../admin/attachment/session.php");
global $session1,$school_info_school_name,$school_info_principal_signature,$filter37,$signature_image,$school_info_school_district,$student_name,$student_class,$student_roll_no,$school_roll_no,$student_father_name,$exam_type_statement,$school_info_logo,$student_photo,$student_id_generate,$path1,$student_image
,$school_info_school_address, $school_info_school_city,  $school_info_school_state,$student_address,$student_date_of_Birth,$student_admission_number;

global $total_max_marks,$total_obt_marks,$final_result,$total_obtain_other,$total_max_other;

$class_name=$_GET['class'];
$exam_code=$_GET['exam_type'];
$student_class_stream=$_GET['student_class_stream'];
$student_class_group=$_GET['student_class_group'];
$exam_marks_maximum1=$exam_code."_maximum_mark";
$exam_marks_minimum1=$exam_code."_minimum_mark";
$exam_marks_add1=$exam_code."_mark_add";


     $query2="select * from student_admission_info where student_roll_no='$roll_no' and session_value='$session1'$filter37";
        $run2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
        while($row2=mysqli_fetch_assoc($run2)){ 
        $student_roll_no=$row2['student_roll_no'];
        $student_address = $row2['student_adress'];
        $student_date_of_Birth = $row2['student_date_of_birth'];
        $school_roll_no=$row2['student_registration_number'];
        $student_admission_number=$row2['student_admission_number'];
    	$student_name=$row2['student_name'];
    	$student_father_name=$row2['student_father_name'];
    	$student_class=$row2['student_class'];
    }
    $que1="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
    $run1=mysqli_query($conn73,$que1);
    while($row1=mysqli_fetch_assoc($run1)){
    	 $student_photo=$row1['student_image_name'];
    	 $student_image=$_SESSION['amazon_file_path']."student_documents/".$student_photo;
    	 $student_image=str_replace(" ","%20",$student_image);
    	 
    	}


    $que4="select * from school_info_class_info where class_name='$class_name'";
	$run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
	while($row4=mysqli_fetch_assoc($run4)){
     $class_code=$row4['class_code'];
	}

    $que="select * from school_info_exam_types where class_code='$class_code' and session_value='$session1'$filter37";
    $total_exam=0;
    $exam_type_name='';
    $run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
    while($row1=mysqli_fetch_assoc($run1)){ 
           $exam_type = $row1['exam_type'];
           if($exam_type!=''){
               
           $exam_type2[$total_exam] = $row1['exam_type'];
           $exam_code2[$total_exam] = $row1['exam_code'];
           if($exam_code== $exam_code2[$total_exam])
           {
             $exam_type_name=$exam_type2[$total_exam];  
           }
    $total_exam++;
    }
    }
$subjet_category_name_other=array();
$subjet_category_name=array();
$student_maximum_cat_marks2=array();
$student_maximum_cat_marks2_other=array();
    $que="select * from school_info_subject_info where class='$student_class' and group_name='$student_class_group' and stream_name='$student_class_stream' and session_value='$session1'$filter37";
    $total_subject=0;
    $total_subject_other=0;
    $cat_subject = 0;
    $run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
    while($row1=mysqli_fetch_assoc($run1)){ 
        $subject_type = $row1['subject_type'];
        if($subject_type=='subject'){
    	$subject[$total_subject] = $row1['subject_name'];
    	$subject_code[$total_subject] = $row1['subject_code'];
        $student_maximum_marks[$cat_subject]=$row1[$exam_marks_maximum1];
        $student_minimum_marks[$cat_subject]=$row1[$exam_marks_minimum1];
        $exam_marks_add[$cat_subject]=$row1[$exam_marks_add1];
        $cat_count=0;
        for($i=1; $i<=10; $i++){
         $subjet_category_name[] = $row1['category'.$i];
         $subject_category_column_1 = $row1['category'.$i];
         
         if($subject_category_column_1!='')
         {
           $cat_count++;  
         }
        }
         $subject_category_column[$total_subject]=$cat_count;
        for($i=0; $i<10; $i++){
         $student_cat_maximum_marks = $row1[$exam_code.'_maximum_mark'];
         $filter_marks=explode('|?|',$student_cat_maximum_marks);
         $student_maximum_cat_marks2[] = $filter_marks[$i];
        }   
     
    
     $total_subject++;
    }
     $subject_type = $row1['subject_type'];
     if($subject_type=='other_subject'){
       $subject_other[$total_subject_other] = $row1['subject_name'];
    	$subject_other_code[$total_subject_other] = $row1['subject_code'];
     $student_maximum_marks_other[$total_subject_other]=$row1[$exam_marks_maximum1];
     $student_minimum_marks_other[$total_subject_other]=$row1[$exam_marks_minimum1];
     $exam_marks_add_other[$total_subject_other]=$row1[$exam_marks_add1]; 
        for($i=1; $i<=10; $i++){
         $subjet_category_name_other[] = $row1['category'.$i];
         $subject_category_column_other = $row1['category'.$i];
        }
        for($i=0; $i<10; $i++){
         $student_cat_maximum_marks_other = $row1[$exam_code.'_maximum_mark'];
         $filter_marks_other=explode('|?|',$student_cat_maximum_marks_other);
         $student_maximum_cat_marks2_other[] = $filter_marks_other[$i];
        }  
     
     $total_subject_other++;
     }
    }
$exam_marks2=array();
$exam_marks_other1=array();
    $que2="select * from examination where student_roll_no='$roll_no' and session_value='$session1'";
    $run2 = mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
    while($row2 = mysqli_fetch_assoc($run2)){
     for($i=0; $i<$total_subject; $i++){
     for($j=0; $j<10; $j++) {    
       $exam_marks = $exam_code.'_'.$subject_code[$i].'_marks'; 
       $exam_marks1 = $row2[$exam_marks];    
       $filter_obt_marks = explode('|?|',$exam_marks1);
       $exam_marks2[] = $filter_obt_marks[$j];
       }
     }
     for($i=0; $i<$total_subject_other; $i++){
        //  for($j=0; $j<$total_exam; $j++){
        //      if($j<2) {
             $exam_marks_other = $exam_code.'_'.$subject_other_code[$i].'_marks';
             $exam_marks_other11 = explode('|?|',$row2[$exam_marks_other]);
             $exam_marks_other1[] = $exam_marks_other11[0];
        //      }
        //   }
      }
     }
      
		$this->Ln(-3);
        $this->SetLeftMargin(15);
        
	  if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',51,20,18);
		}else{
		$this->Image($path1,5,5,18,18,'jpeg');
	    }
	    
	    if($school_info_principal_signature==null){
		$this->Image('../../../images/blank_logo.png',107,217,20,9,'jpeg');
		}else{
		//$this->Image($signature_image,107,217,20,9,'jpeg');
		} 
		
		if($student_photo==null){
		$this->Image('../../../images/blank.jpg',180,5,21,21);
		}else{
		$this->Image($student_image,180,5,21,21,'jpeg');
		}
		
		$this->SetLineWidth(0.35);
        $this->SetFont('Times','B',19);
		$this->Cell(-10);
		$this->Cell(200,7,"".$school_info_school_name.' EPS',0,0,'C');
		$this->Ln();
		 
		 $this->SetFont('Times','B',10);
		 $this->Cell(-10);
		 $this->Cell(190,6,''.$school_info_school_address.','.$school_info_school_district.'('.$school_info_school_state.')',0,0,'C');
		 $this->Ln();

		 $this->SetFont('Times','B',14);
		 $this->Cell(-10);
		 $this->Cell(200,4,' REPORT CARD',0,1,'C');
		 $this->Cell(-10);
		 $this->Cell(200,-4,' _______________',0,0,'C');
		 $this->Ln();	
		 
		 $this->Cell(267,8,"",0);
         $this->Ln();
   
         $this->Cell(-10);
	     $this->SetFont('Times','B',10);
		 $this->Cell(15,6,"Name",0);
		 $this->Cell(5,6," :-",0);
		 $this->SetFont('Times','',10);
		 $this->SetTextColor(0,0,0);
		 $this->Cell(40,6,''.$student_name,0);
		 $this->SetFont('Times','B',10);
		 $this->Cell(25,6,"Father's Name",0);
		 $this->Cell(5,6," :-",0);
		 $this->SetTextColor(0,0,0);
		 $this->SetFont('Times','',10);
		 $this->Cell(40,6,''.$student_father_name,0);
		 $this->SetFont('Times','B',10);
		 $this->Cell(10,6,"Class",0);
		 $this->Cell(5,6," :-",0);
		 $this->SetTextColor(0,0,0);
		 $this->SetFont('Times','',10);
		 $this->Cell(60,6,''.$student_class,0);
		 $this->Ln();
		 
	     $this->Cell(-10); 
	     $this->SetFont('Times','B',10);
		 $this->Cell(15,6,"Address",0);
		 $this->Cell(5,6," :-",0);
		 $this->SetTextColor(0,0,0);
		 $this->SetFont('Times','',10);
		 $this->Cell(110,6,''.$student_address,0);
		 $this->SetFont('Times','B',10);
		 $this->Cell(10,6,"DOB",0);
		 $this->Cell(5,6," :-",0);
		 $this->SetTextColor(0,0,0);
		 $this->SetFont('Times','',10);
		 $this->Cell(20,6,''.$student_date_of_Birth,0);
			$this->SetFont('Times','B',10);
    	$this->Cell(5,6,"ID",0);
    	$this->Cell(5,6," :-",0);
    	$this->SetTextColor(0,0,0);
    	$this->SetFont('Times','',10);
		 $this->Cell(60,6,''.$student_admission_number,0);
		 $this->Ln(7);
		 
		 $result123 = strstr($session1, '_', true);
		
		 $this->Cell(-11);
		 $this->SetFont('Times','B',11.5); 
		 $this->SetTextColor(0,0,0);
		 $this->Cell(48,7,"RESULT",1,0,'C');
		 $this->Cell(110,7,"".strtoupper($exam_type_name),1,0,'C');
		 $this->Cell(42,7,'ACADEMIC SCORE',1,0,'C');
		 $this->Ln();
/////////////////////////////////////////////////////subject category adjustment variable//////////////////////////////////////////////////////////////////
         
         $total_max_marks=0;
         $total_min_marks=0;
         $total_obt_marks=0;
         $final_result='CLEAR';
		 for($i=0; $i<$total_subject; $i++){
		     $total_subject_cat_adjust_sub[$i]=round(64.3/$subject_category_column[$i],2);
		     $this->Cell(-11);
		  if($i==0){
		      $this->SetFont('Times','B',8); 
		       $this->Cell(10,4,$i+1,1,0,'C');
              $this->Cell(38,8,$subject[$i],1,0,'C');
              for($i1=0; $i1<10; $i1++){
               if($subjet_category_name[$i1]!='')
               {
               $this->Cell($total_subject_cat_adjust_sub[$i],8,$subjet_category_name[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$student_maximum_cat_marks2[$i1],1,0,'C');
               $this->SetTextColor(0,0,0);
               $total_maximum[$i] = $student_maximum_cat_marks2[$i1] + $total_maximum[$i];
               }
              }
            $this->Cell(11.6,8,'Total',1,0,'C'); 
            $this->Cell(11.6,4,''.$total_maximum[$i],1,0,'C'); 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,4,'%',1,0,'C');
            $this->Cell(38,8,'',0,0,'C');
            for($i1=0; $i1<10; $i1++){
            if($subjet_category_name[$i1]!='')
            {    
            $this->Cell($total_subject_cat_adjust_sub[$i],8,'',0,0,'C'); 
            $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$exam_marks2[$i1],1,0,'C'); 
            $total_obtain[$i] = $exam_marks2[$i1] + $total_obtain[$i];
            }
            }
            $this->Cell(11.6,8,'',0,0,'C'); 
            $this->Cell(11.6,4,''.$total_obtain[$i],1,0,'C'); 
            $per_subjectwise1 = $total_obtain[$i] * 100 / $total_maximum[$i]; 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,6,''.round($per_subjectwise1,2),1,0,'C');
            if($per_subjectwise1>=40){
                $this->SetFont('Times','B',9); 
                //$this->SetTextColor(0,200,0);
                $result_subjectwise1 = 'CLEAR';
            }else{
                //$this->SetTextColor(200,0,0);
                $this->SetFont('Times','B',8); 
                $result_subjectwise1 = 'NOT CLEAR'; 
                $final_result='NOT CLEAR';
            }
            $this->Cell(38,6,''.$result_subjectwise1,1,0,'C');
             $this->SetTextColor(0,0,0);
            $this->Ln(2); 
            $total_min_marks=$total_min_marks;
            $total_max_marks=$total_max_marks+$total_maximum[$i];
            $total_obt_marks=$total_obt_marks+$total_obtain[$i];
		   }
		  elseif($i==1){
		       $this->SetFont('Times','B',8); 
		       $this->Cell(10,4,$i+1,1,0,'C');
              $this->Cell(38,8,$subject[$i],1,0,'C');
              for($i1=10; $i1<20; $i1++){
               if($subjet_category_name[$i1]!='')
               {       
               $this->Cell($total_subject_cat_adjust_sub[$i],8,$subjet_category_name[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$student_maximum_cat_marks2[$i1],1,0,'C');
               $this->SetTextColor(0,0,0);
               $total_maximum[$i] = $student_maximum_cat_marks2[$i1] + $total_maximum[$i];
               }
              }
            $this->Cell(11.6,8,'Total',1,0,'C'); 
            $this->Cell(11.6,4,''.$total_maximum[$i],1,0,'C'); 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,4,'%',1,0,'C');
            $this->Cell(38,8,'',0,0,'C');
            for($i1=10; $i1<20; $i1++){
            if($subjet_category_name[$i1]!='')
            {    
            $this->Cell($total_subject_cat_adjust_sub[$i],8,'',0,0,'C'); 
            $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$exam_marks2[$i1],1,0,'C'); 
            $total_obtain[$i] = $exam_marks2[$i1] + $total_obtain[$i];
            }
            }
            $this->Cell(11.6,8,'',0,0,'C'); 
            $this->Cell(11.6,4,''.$total_obtain[$i],1,0,'C'); 
            $per_subjectwise1 = $total_obtain[$i] * 100 / $total_maximum[$i]; 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,6,''.round($per_subjectwise1,2),1,0,'C');
            if($per_subjectwise1>=40){
                $this->SetFont('Times','B',9); 
                //$this->SetTextColor(0,200,0);
                $result_subjectwise1 = 'CLEAR';
            }else{
                $this->SetFont('Times','B',8); 
                //$this->SetTextColor(0,200,0);
                $result_subjectwise1 = 'NOT CLEAR';
                $final_result='NOT CLEAR';
               
            }
            $this->Cell(38,6,''.$result_subjectwise1,1,0,'C');
            $this->SetTextColor(0,0,0);
            $this->Ln(2); 
            $total_min_marks=$total_min_marks;
            $total_max_marks=$total_max_marks+$total_maximum[$i];
            $total_obt_marks=$total_obt_marks+$total_obtain[$i];
		   }
		  elseif($i==2){
		      $this->SetFont('Times','B',8);
		       $this->Cell(10,4,$i+1,1,0,'C');
              $this->Cell(38,8,$subject[$i],1,0,'C');
              for($i1=20; $i1<30; $i1++){
               if($subjet_category_name[$i1]!='')
               {      
               $this->Cell($total_subject_cat_adjust_sub[$i],8,$subjet_category_name[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$student_maximum_cat_marks2[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $total_maximum[$i] = $student_maximum_cat_marks2[$i1] + $total_maximum[$i];
               }
              }
            $this->Cell(11.6,8,'Total',1,0,'C'); 
            $this->Cell(11.6,4,''.$total_maximum[$i],1,0,'C'); 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,4,'%',1,0,'C');
            $this->Cell(38,8,'',0,0,'C');
            for($i1=20; $i1<30; $i1++){
            if($subjet_category_name[$i1]!='')
            {    
            $this->Cell($total_subject_cat_adjust_sub[$i],8,'',0,0,'C'); 
            $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$exam_marks2[$i1],1,0,'C'); 
            $total_obtain[$i] = $exam_marks2[$i1] + $total_obtain[$i];
            }
            }
            $this->Cell(11.6,8,'',0,0,'C'); 
            $this->Cell(11.6,4,''.$total_obtain[$i],1,0,'C'); 
            $per_subjectwise1 = $total_obtain[$i] * 100 / $total_maximum[$i]; 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,6,''.round($per_subjectwise1,2),1,0,'C');
            if($per_subjectwise1>=40){
                $this->SetFont('Times','B',9); 
                // $this->SetTextColor(0,200,0);
                $result_subjectwise1 = 'CLEAR';
            }else{
                $this->SetFont('Times','B',8); 
                // $this->SetTextColor(200,0,0);
                $result_subjectwise1 = 'NOT CLEAR'; 
                $final_result='NOT CLEAR';
               
            }
            $this->Cell(38,6,''.$result_subjectwise1,1,0,'C');
            $this->SetTextColor(0,0,0);
            $this->Ln(2); 
            $total_min_marks=$total_min_marks;
            $total_max_marks=$total_max_marks+$total_maximum[$i];
            $total_obt_marks=$total_obt_marks+$total_obtain[$i];
		   }
		  elseif($i==3){
		      $this->SetFont('Times','B',8);
		       $this->Cell(10,4,$i+1,1,0,'C');
              $this->Cell(38,8,$subject[$i],1,0,'C');
              for($i1=30; $i1<40; $i1++){
               if($subjet_category_name[$i1]!='')
               {       
               $this->Cell($total_subject_cat_adjust_sub[$i],8,$subjet_category_name[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$student_maximum_cat_marks2[$i1],1,0,'C');
               $this->SetTextColor(0,0,0);
               $total_maximum[$i] = $student_maximum_cat_marks2[$i1] + $total_maximum[$i];
               }
              }
            $this->Cell(11.6,8,'Total',1,0,'C'); 
            $this->Cell(11.6,4,''.$total_maximum[$i],1,0,'C'); 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,4,'%',1,0,'C');
            $this->Cell(38,8,'',0,0,'C');
            for($i1=30; $i1<40; $i1++){
            if($subjet_category_name[$i1]!='')
            {    
            $this->Cell($total_subject_cat_adjust_sub[$i],8,'',0,0,'C'); 
            $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$exam_marks2[$i1],1,0,'C'); 
            $total_obtain[$i] = $exam_marks2[$i1] + $total_obtain[$i];
            }
            }
            $this->Cell(11.6,8,'',0,0,'C'); 
            $this->Cell(11.6,4,''.$total_obtain[$i],1,0,'C'); 
            $per_subjectwise1 = $total_obtain[$i] * 100 / $total_maximum[$i]; 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,6,''.round($per_subjectwise1,2),1,0,'C');
            if($per_subjectwise1>=40){
                $this->SetFont('Times','B',9); 
                // $this->SetTextColor(0,200,0);
                $result_subjectwise1 = 'CLEAR';
            }else{
                $this->SetFont('Times','B',8); 
                // $this->SetTextColor(200,0,0);
                $result_subjectwise1 = 'NOT CLEAR'; 
                $final_result='NOT CLEAR';
               
            }
            $this->Cell(38,6,''.$result_subjectwise1,1,0,'C');
             $this->SetTextColor(0,0,0);
            $this->Ln(2); 
            $total_min_marks=$total_min_marks;
            $total_max_marks=$total_max_marks+$total_maximum[$i];
            $total_obt_marks=$total_obt_marks+$total_obtain[$i];
		   }
		  elseif($i==4){
		      $this->SetFont('Times','B',8);
		       $this->Cell(10,4,$i+1,1,0,'C');
              $this->Cell(38,8,$subject[$i],1,0,'C');
             for($i1=40; $i1<50; $i1++){
               if($subjet_category_name[$i1]!='')
               {     
               $this->Cell($total_subject_cat_adjust_sub[$i],8,$subjet_category_name[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$student_maximum_cat_marks2[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $total_maximum[$i] = $student_maximum_cat_marks2[$i1] + $total_maximum[$i];
               }
              }
            $this->Cell(11.6,8,'Total',1,0,'C'); 
            $this->Cell(11.6,4,''.$total_maximum[$i],1,0,'C'); 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,4,'%',1,0,'C');
            $this->Cell(38,8,'',0,0,'C');
            for($i1=40; $i1<50; $i1++){
            if($subjet_category_name[$i1]!='')
            {    
            $this->Cell($total_subject_cat_adjust_sub[$i],8,'',0,0,'C'); 
            $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$exam_marks2[$i1],1,0,'C');
            $total_obtain[$i] = $exam_marks2[$i1] + $total_obtain[$i];
            }
            }
            $this->Cell(11.6,8,'',0,0,'C'); 
            $this->Cell(11.6,4,''.$total_obtain[$i],1,0,'C'); 
            $per_subjectwise1 = $total_obtain[$i] * 100 / $total_maximum[$i]; 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,6,''.round($per_subjectwise1,2),1,0,'C');
            if($per_subjectwise1>=40){
                $this->SetFont('Times','B',9); 
                // $this->SetTextColor(0,200,0);
                $result_subjectwise1 = 'CLEAR';
            }else{
                $this->SetFont('Times','B',8); 
                // $this->SetTextColor(200,0,0);
                $result_subjectwise1 = 'NOT CLEAR'; 
                $final_result='NOT CLEAR';
               
            }
            $this->Cell(38,6,''.$result_subjectwise1,1,0,'C');
            $this->SetTextColor(0,0,0);
            $this->Ln(2); 
            $total_min_marks=$total_min_marks;
            $total_max_marks=$total_max_marks+$total_maximum[$i];
            $total_obt_marks=$total_obt_marks+$total_obtain[$i];
		   } 
		  elseif($i==5){
		      $this->SetFont('Times','B',8);
		       $this->Cell(10,4,$i+1,1,0,'C');
              $this->Cell(38,8,$subject[$i],1,0,'C');
              for($i1=50; $i1<60; $i1++){
               if($subjet_category_name[$i1]!='')
               {      
               $this->Cell($total_subject_cat_adjust_sub[$i],8,$subjet_category_name[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$student_maximum_cat_marks2[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $total_maximum[$i] = $student_maximum_cat_marks2[$i1] + $total_maximum[$i];
               }
              }
            $this->Cell(11.6,8,'Total',1,0,'C'); 
            $this->Cell(11.6,4,''.$total_maximum[$i],1,0,'C'); 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,4,'%',1,0,'C');
            $this->Cell(38,8,'',0,0,'C');
            for($i1=50; $i1<60; $i1++){
            if($subjet_category_name[$i1]!='')
            {    
            $this->Cell($total_subject_cat_adjust_sub[$i],8,'',0,0,'C'); 
            $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$exam_marks2[$i1],1,0,'C'); 
            $total_obtain[$i] = $exam_marks2[$i1] + $total_obtain[$i];
            }
            }
            $this->Cell(11.6,8,'',0,0,'C'); 
            $this->Cell(11.6,4,''.$total_obtain[$i],1,0,'C');
             $per_subjectwise1 = $total_obtain[$i] * 100 / $total_maximum[$i];
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,6,''.round($per_subjectwise1,2),1,0,'C');
            if($per_subjectwise1>=40){
                $this->SetFont('Times','B',9);
                // $this->SetTextColor(0,200,0);
                $result_subjectwise1 = 'CLEAR';
            }else{
                $this->SetFont('Times','B',8);
                // $this->SetTextColor(200,0,0);
                $result_subjectwise1 = 'NOT CLEAR'; 
                $final_result='NOT CLEAR';
               
            }
            $this->Cell(38,6,''.$result_subjectwise1,1,0,'C');
             $this->SetTextColor(0,0,0);
            $this->Ln(2); 
            $total_min_marks=$total_min_marks;
            $total_max_marks=$total_max_marks+$total_maximum[$i];
            $total_obt_marks=$total_obt_marks+$total_obtain[$i];
		   } 
		  elseif($i==6){
		      $this->SetFont('Times','B',8);
		       $this->Cell(10,4,$i+1,1,0,'C');
              $this->Cell(38,8,$subject[$i],1,0,'C');
              for($i1=60; $i1<70; $i1++){
               if($subjet_category_name[$i1]!='')
               {      
               $this->Cell($total_subject_cat_adjust_sub[$i],8,$subjet_category_name[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$student_maximum_cat_marks2[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $total_maximum[$i] = $student_maximum_cat_marks2[$i1] + $total_maximum[$i];
               }
              }
            $this->Cell(11.6,8,'Total',1,0,'C'); 
            $this->Cell(11.6,4,''.$total_maximum[$i],1,0,'C'); 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,4,'%',1,0,'C');
            $this->Cell(38,8,'',0,0,'C');
            for($i1=60; $i1<70; $i1++){
            if($subjet_category_name[$i1]!='')
            {    
            $this->Cell($total_subject_cat_adjust_sub[$i],8,'',0,0,'C'); 
            $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$exam_marks2[$i1],1,0,'C'); 
            $total_obtain[$i] = $exam_marks2[$i1] + $total_obtain[$i];
            }
            }
            $this->Cell(11.6,8,'',0,0,'C'); 
            $this->Cell(11.6,4,''.$total_obtain[$i],1,0,'C'); 
            $per_subjectwise1 = $total_obtain[$i] * 100 / $total_maximum[$i];
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,6,''.round($per_subjectwise1,2),1,0,'C');
            if($per_subjectwise1>=40){
                $this->SetFont('Times','B',9);
                // $this->SetTextColor(0,200,0);
                $result_subjectwise1 = 'CLEAR';
            }else{
                $this->SetFont('Times','B',8);
                // $this->SetTextColor(200,0,0);
                $result_subjectwise1 = 'NOT CLEAR'; 
                $final_result='NOT CLEAR';
               
            }
            $this->Cell(38,6,''.$result_subjectwise1,1,0,'C');
            $this->SetTextColor(0,0,0);
            $this->Ln(2); 
            $total_min_marks=$total_min_marks;
            $total_max_marks=$total_max_marks+$total_maximum[$i];
            $total_obt_marks=$total_obt_marks+$total_obtain[$i];
		   }
		  elseif($i==7){
		      $this->SetFont('Times','B',8);
		       $this->Cell(10,4,$i+1,1,0,'C');
              $this->Cell(38,8,$subject[$i],1,0,'C');
              for($i1=70; $i1<80; $i1++){
               if($subjet_category_name[$i1]!='')
               {      
               $this->Cell($total_subject_cat_adjust_sub[$i],8,$subjet_category_name[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$student_maximum_cat_marks2[$i1],1,0,'C'); 
               $this->SetTextColor(0,0,0);
               $total_maximum[$i] = $student_maximum_cat_marks2[$i1] + $total_maximum[$i];
               }
              }
            $this->Cell(11.6,8,'Total',1,0,'C'); 
            $this->Cell(11.6,4,''.$total_maximum[$i],1,0,'C'); 
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,4,'%',1,0,'C');
            $this->Cell(38,8,'',0,0,'C');
            for($i1=70; $i1<80; $i1++){
            if($subjet_category_name[$i1]!='')
            {    
            $this->Cell($total_subject_cat_adjust_sub[$i],8,'',0,0,'C'); 
            $this->Cell($total_subject_cat_adjust_sub[$i],4,''.$exam_marks2[$i1],1,0,'C'); 
            $total_obtain[$i] = $exam_marks2[$i1] + $total_obtain[$i];
            }
            }
            $this->Cell(11.6,8,'',0,0,'C'); 
            $this->Cell(11.6,4,''.$total_obtain[$i],1,0,'C'); 
            $per_subjectwise1 = $total_obtain[$i] * 100 / $total_maximum[$i];
            $this->Ln(); 
            $this->Cell(-11);
            $this->Cell(10,6,''.round($per_subjectwise1,2),1,0,'C');
            if($per_subjectwise1>=40){
                $this->SetFont('Times','B',9);
                // $this->SetTextColor(0,200,0);
                $result_subjectwise1 = 'CLEAR';
            }else{
                $this->SetFont('Times','B',8);
                // $this->SetTextColor(200,0,0);
                $result_subjectwise1 = 'NOT CLEAR'; 
                $final_result='NOT CLEAR';
               
            }
            $this->Cell(38,6,''.$result_subjectwise1,1,0,'C');
            $this->SetTextColor(0,0,0);
            $this->Ln(2); 
            $total_min_marks=$total_min_marks;
            $total_max_marks=$total_max_marks+$total_maximum[$i];
            $total_obt_marks=$total_obt_marks+$total_obtain[$i];
		   }
		  $this->Ln();
		 }
		 $this->SetFont('Times','B',11);
		 $this->SetXY(0,201);
		 $this->Cell(4);
		 $this->Cell(48,6,'GENERAL SCORE',1,0,'C');
		 $this->Cell(15,6,'T.S',1,0,'C');
		 $this->Cell(15,6,'O.S',1,0,'C');
		 $this->Ln();
		 $o = 0;
		 $total_obtain_other=0;
		 $total_max_other=0;
		 $this->SetFont('Times','B',9);
		 for($i11=0; $i11<$total_subject_other; $i11++){
		  $this->Cell(-11);
		  $this->Cell(10,6,$i11+1,1,0,'C');
		  $this->Cell(38,6,$subject_other[$i11],1,0,'C'); 
		  //for($j11=0; $j11<$total_exam; $j11++){
		  //    if($j11<2){
		        $this->Cell(15,6,'1',1,0,'C');     
    		    $this->Cell(15,6,''.$exam_marks_other1[$o],1,0,'C'); 
    		    $grand_total_other[$j11] += $exam_marks_other1[$o];
    		    $grand_total_other_max[$j11] +=1;
    		    $o++;
		  //    }
		  //}
		  $this->Ln();
		 }
		 $this->Cell(-11);
		  $this->SetFont('Times','B',11); 
         $this->Cell(48,6,'TOTAL SCORE',1,0,'C');
        //   for($j11=0; $j11<$total_exam; $j11++){
        //       if($j11<2){
                $this->Cell(15,6,''.$grand_total_other_max[$j11],1,0,'C');
                $this->Cell(15,6,''.$grand_total_other[$j11],1,0,'C');
                $total_obtain_other+=$grand_total_other[$j11];
    		    $total_max_other+=$grand_total_other_max[$j11];
            //   }
        //   }
		 $this->Ln();
}
function sign($s1, $s2){

	    $this->Cell(90,6,$s1,'',0,'L',false);
        $this->Cell(90,6,$s2,'',0,'R',false);
		$this->Ln();
}

}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(false);

if(isset($_GET['roll_no'])){
    
$roll_no=$_GET['roll_no'];

$pdf->AddPage();
$pdf->Table1($roll_no);
}else{

$class_name=$_GET['class'];
$session1=$_GET['session1'];
$section1=$_GET['section'];
$student_class_stream=$_GET['student_class_stream'];
$student_class_group=$_GET['student_class_group'];
$section_conidtion="";
if($section1!="All"){
    $section_conidtion="and student_class_section='$section1'";
}
 $query2="select * from student_admission_info where student_class='$class_name' $section_conidtion and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$filter37";
        $run2=mysqli_query($conn73,$query2) or die(mysql_error($conn73));
        while($row2=mysqli_fetch_assoc($run2)){
        $student_roll_no=$row2['student_roll_no'];
        

$pdf->AddPage();
$footer1=1;
$pdf->Table1($student_roll_no);
}
}

//////----------------------------//////

$file_name="marksheet_".$student_name."_".$student_class.".pdf";
$pdf->Output('I',$file_name);

?>
