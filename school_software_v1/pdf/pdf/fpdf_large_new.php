<?php
include("../../../admin/attachment/session.php");
$query2="select * from school_info_general";
        $run2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
        while($row2=mysqli_fetch_assoc($run2)){
        $school_info_school_name=$row2['school_info_school_name'];
        $school_info_school_name=strtoupper($school_info_school_name);
        $school_info_school_district=$row2['school_info_school_district'];
		$school_info_school_district=strtoupper($school_info_school_district);
		$school_info_school_city=$row2['school_info_school_city'];
		$school_info_school_city=strtoupper($school_info_school_city);
        }
		
	  $class_name=$_GET['class'];	
	  $session1=$_GET['session'];	
      
	  
	  $query2="select * from student_admission_info where student_class='$class_name' and student_status='Active' and session_value='$session1'$condition$condition1$filter37";
	  $total_student=0;
	  $run2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
	  while($row2=mysqli_fetch_assoc($run2)){
	  $student_roll_no[$total_student]=$row2['student_roll_no'];
	  $school_roll_no[$total_student]=$row2['school_roll_no'];
	  $student_name[$total_student]=$row2['student_name'];
	  $student_father_name[$total_student]=$row2['student_father_name'];
	  $student_mother_name[$total_student]=$row2['student_mother_name'];
	  $student_class[$total_student]=$row2['student_class'];
	  $student_scholar_number[$total_student]=$row2['student_scholar_number'];
	  $student_category[$total_student]=$row2['student_category'];
	  $student_admission_number[$total_student]=$row2['student_admission_number'];
	  $student_date_of_birth[$total_student] = $row2['student_date_of_birth'];
	  $total_student++;
      } 
     
      	  
require('../fpdf1.php');

class PDF extends FPDF
{

protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{			$this->SetFont('Times','',13);
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(7,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('Times',$style,13);
}

function PutLink($URL, $txt)
{
    // Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

function Heading($num, $label)
{
    // Arial 12
    $this->SetFont('Arial','',12);
    // Background color
    $this->SetFillColor(220,220,220);
    // Title
    $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
    // Line break
    $this->Ln(4);
}

function Body($file)
{
    // Read text file
    // Times 12
    $this->SetFont('Times','',12);
    // Output justified text
    $this->MultiCell(0,5,$file);
    // Line break
    $this->Ln();
   
}

// Page header
function Header()
{
     // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(25);
	  $this->SetTextColor(255,0,0);
    // Title
$this->Ln();
	 $this->SetFont('Arial','B',10);

    // Line break
    $this->Ln();
	 
	 
}

// Page footer
function Footer()
{
   
		
	    $this->SetDrawColor(0,0,0);
		$this->SetLineWidth(0.55);
		$this->SetXY(3,3);
		$this->Cell(291,204,'',1);
		$this->Ln();
           	 
	
}


function Table1()
{
  global $conn73,$school_info_school_name,$school_info_school_district,$filter37,$session1,$student_name,$student_class,$student_roll_no,$student_father_name,$school_info_logo,$student_photo,$total_exam,$remark,$fail_pass,$school_roll_no,$student_id_generate,$school_info_school_city,$total_student,$student_mother_name,$student_date_of_birth,$student_category,$student_admission_number;
$class_name=$_GET['class'];

           global $conn73,$session1;
	  
           $this->SetLeftMargin(0);
		   $this->SetFont('Times','B',18);
           $this->SetTextColor(0,0,0);
		   $this->SetXY(8,6);
           $this->Cell(235,10,$school_info_school_name.', '.$school_info_school_city,0);
		   $this->SetFont('Times','B',16);
           $this->SetTextColor(0,0,0);
		   $this->SetXY(46,14);
           $this->Cell(235,10,'DISTRICT - '.$school_info_school_district,0);
		   $this->SetFont('Times','B',11);
           $this->SetTextColor(0,0,0);
		 
		    $class_name=$_GET['class'];

           $que4="select * from school_info_class_info where class_name='$class_name'";
           $run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
           while($row4=mysqli_fetch_assoc($run4)){
           $class_code=$row4['class_code'];
           }
           $que="select * from school_info_exam_types where class_code='$class_code' and session_value='$session1'";
           $total_exam=0;
           $g=0;
           $run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
           while($row1=mysqli_fetch_assoc($run1)){
           $exam_type7=$row1['exam_type'];
	       if($exam_type7!=''){
          $exam_code[]=$row1['exam_code'];
		   $exam_type=$row1['exam_type'];
		   $exam_type=strtoupper($exam_type);
		   $g=$exam_type.','.$g;
		   	 $grand_total_maximum[$total_exam]=0;
	         $grand_total_minimum[$total_exam]=0;
	         $grand_total_obtain[$total_exam]=0;
	         $grand_total_cgpa[$total_exam]=0;
	         $fail_pass="Pass";
	         $percentage[]=0;	 
             $total_exam++;
             }
             }
			 $examination1=$g;
			 $examination2=explode(",",$examination1);
			 
		   if($total_exam=='4'){
		   $this->SetXY(192,6);		
		   $this->Cell(235,5,''.$examination2[3].',',0);
		   $this->SetXY(234,6);
           $this->Cell(235,5,''.$examination2[2].',',0);
		   $this->SetXY(199,11);
           $this->Cell(235,5,''.$examination2[1].' /',0);
		   $this->SetXY(237,11);
           $this->Cell(235,5,''.$examination2[0],0);
		   }elseif($total_exam=='3'){
		   $this->SetXY(192,6);
           $this->Cell(235,5,''.$examination2[2].',',0);
		   $this->SetXY(234,6);
           $this->Cell(235,5,''.$examination2[1].',',0);
		   $this->SetXY(220,11);
           $this->Cell(235,5,''.$examination2[0],0);
		   }elseif($total_exam=='2'){
		   $this->SetXY(192,8);
           $this->Cell(235,5,''.$examination2[1].',',0);
		   $this->SetXY(234,8);
           $this->Cell(235,5,''.$examination2[0],0);
		   }else{
		   $this->SetXY(220,8);
           $this->Cell(235,5,''.$examination2[0].',',0);
		   }
		   $this->SetFont('Times','B',12);
           $this->SetTextColor(0,0,0);
		   if($class_name=='nursery'){
		   $this->SetXY(175,15);
           $this->Cell(235,10,'EXAMINATION SHEET  CLASS  '.$class_name.'   SESSION '.$session1,0);
		   }else{
		   $this->SetXY(181,15);
           $this->Cell(235,10,'EXAMINATION SHEET  CLASS  '.$class_name.'   SESSION '.$session1,0);
		   }
		   $this->Ln();
		   
    //-----------------------------------------------//
     $group_name=$_GET['group_name'];
      if($group_name!=''){
          
         $condition=" and group_name='$group_name'"; 
      }else{
          
          $condition="";
      }
      $stream_code=$_GET['stream_code'];
      if($stream_code!=''){
          
         $condition1=" and stream_code='$stream_code'"; 
      }else{
          
          $condition1="";
      }
      
     $que="select * from school_info_subject_info where class='$class_name'$condition$condition1 and session_value='$session1'$filter37";
    $total_subject=0;
    $total_subject_other=0;
    $run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
    while($row1=mysqli_fetch_assoc($run1)){
	$subject_type = $row1['subject_type'];
	if($subject_type=='subject'){
	$subject[] = strtolower($row1['subject_name']);
	$subject_code[] =$row1['subject_code'];
    for($j=0; $j<$total_exam; $j++){
	$exam_marks_maximum1=$exam_code[$j]."_maximum_mark";
    $exam_marks_minimum1=$exam_code[$j]."_minimum_mark";
    $exam_marks_add1=$exam_code[$j]."_mark_add";
    $student_maximum_marks[]=$row1[$exam_marks_maximum1];
    $student_minimum_marks[]=$row1[$exam_marks_minimum1];
    $exam_marks_add[]=$row1[$exam_marks_add1];
    }
    $total_obtain[]=0;
    $total_subject++;
}else if($subject_type=='other_subject'){
	$subject_other[] = strtolower($row1['subject_name']);
	$subject_code_other[] =$row1['subject_code'];
    for($j=0; $j<$total_exam; $j++){
}
    $total_obtain_other[]=0;
    $total_subject_other++;
}
}
	
		   $this->SetXY(3,31);
           $this->Cell(226,0,'',0,0,'C');
           $this->SetFont('Times','B',8);
		   $this->Cell(8,0,'Total',0,0,'C');
           $this->Cell(12,0,'Exam',0,0,'C');
           $this->Cell(12,0,'',0,0,'C');
           $this->Cell(12,0,'Subject',0,0,'C');
           $this->Cell(21,0,'',0,0,'C');
		   
		   $this->SetXY(3,24);
		   $this->SetFont('Times','B',11);
           $this->Cell(65,23,'Exam Details',1,0,'C');
           $this->Cell(25,23,'Exam Type',1,0,'C');

    
	       $k=0;
	       for($i=0; $i<$total_subject; $i++){
		   if($total_subject=='3'){
           $this->SetFont('Times','B',10);
		   $this->Cell(45.33,11.5,''.strtoupper($subject[$i]),1,0,'C');
		   }elseif($total_subject=='4'){
           $this->SetFont('Times','B',10);
		   $this->Cell(34,11.5,''.strtoupper($subject[$i]),1,0,'C');
		   }elseif($total_subject=='5'){
           $this->SetFont('Times','B',8);
		   $this->Cell(27.2,11.5,''.strtoupper($subject[$i]),1,0,'C');
		   }elseif($total_subject=='6'){
           $this->SetFont('Times','B',7);
		   $this->Cell(22.66,11.5,''.strtoupper($subject[$i]),1,0,'C');
		   }elseif($total_subject=='7'){
           $this->SetFont('Times','B',6);
		   $this->Cell(19.42,11.5,''.strtoupper($subject[$i]),1,0,'C');
		   }elseif($total_subject=='8'){
           $this->SetFont('Times','B',6);
		   $this->Cell(17,11.5,''.strtoupper($subject[$i]),1,0,'C');
		   }elseif($total_subject=='9'){
           $this->SetFont('Times','B',5);
		   $this->Cell(15.11,11.5,''.strtoupper($subject[$i]),1,0,'C');
		   }elseif($total_subject=='10'){
           $this->SetFont('Times','B',7);
		   $this->Cell(13.6,11.5,''.strtoupper($subject[$i]),1,0,'C');
		   }else{
		   $this->SetFont('Times','B',7);
		   $this->Cell(12.36,11.5,''.strtoupper($subject[$i]),1,0,'C');
		   }
           }
		   
		   $this->SetFont('Times','B',8);		   
		   $this->Cell(8,23,'Obt',1,0,'C');
           $this->Cell(12,23,'Result',1,0,'C');
           $this->Cell(12,23,'Division',1,0,'C');
           $this->Cell(12,23,'of Supp.',1,0,'C');
           $this->Cell(21,5.75,'EVS &',1,0,'C');
		   
		   $this->SetXY(3,29.75);
           $this->Cell(270,0,'',0,0,'C');
           $this->Cell(21,5.75,'Disaster',1,0,'C');
		   
		   $this->SetXY(3,35.5);
           $this->Cell(90,0,'',0,0,'C');
		   for($i=0; $i<$total_subject; $i++){
		   if($total_subject=='3'){
           $this->Cell(22.66,5.75,'Obt.',1,0,'C');
           $this->Cell(22.66,5.75,'cgpa',1,0,'C');
		   }elseif($total_subject=='4'){
           $this->Cell(17,5.75,'Obt.',1,0,'C');
           $this->Cell(17,5.75,'cgpa',1,0,'C');
		   }elseif($total_subject=='5'){
           $this->Cell(13.6,5.75,'Obt.',1,0,'C');
           $this->Cell(13.6,5.75,'cgpa',1,0,'C');
		   }elseif($total_subject=='6'){
           $this->Cell(11.33,5.75,'Obt.',1,0,'C');
           $this->Cell(11.33,5.75,'cgpa',1,0,'C');
		   }elseif($total_subject=='7'){
           $this->Cell(9.71,5.75,'Obt.',1,0,'C');
           $this->Cell(9.71,5.75,'cgpa',1,0,'C');
		   }elseif($total_subject=='8'){
           $this->Cell(8.5,5.75,'Obt.',1,0,'C');
           $this->Cell(8.5,5.75,'cgpa',1,0,'C');
		   }elseif($total_subject=='9'){
           $this->Cell(7.55,5.75,'Obt.',1,0,'C');
           $this->Cell(7.55,5.75,'cgpa',1,0,'C');
		   }elseif($total_subject=='10'){
           $this->Cell(6.8,5.75,'Obt.',1,0,'C');
           $this->Cell(6.8,5.75,'cgpa',1,0,'C');
		   }
		   }
           $this->Cell(44,0,'',0,0,'C');
           $this->Cell(21,5.75,'Mng. 100',1,0,'C');
		   
		   $this->SetXY(3,41.25);
           $this->Cell(90,0,'',0,0,'C');
		   for($i=0; $i<$total_subject; $i++){
		   if($total_subject=='3'){
           $this->Cell(45.33,5.75,'',1,0,'C');
		   }elseif($total_subject=='4'){
           $this->Cell(34,5.75,'',1,0,'C');
		   }elseif($total_subject=='5'){
           $this->Cell(27.2,5.75,'',1,0,'C');
		   }elseif($total_subject=='6'){
           $this->Cell(22.66,5.75,'',1,0,'C');
		   }elseif($total_subject=='7'){
           $this->Cell(19.42,5.75,'',1,0,'C');
		   }elseif($total_subject=='8'){
           $this->Cell(17,5.75,'',1,0,'C');
		   }elseif($total_subject=='9'){
           $this->Cell(15.11,5.75,'',1,0,'C');
		   }elseif($total_subject=='10'){
           $this->Cell(13.6,5.75,'',1,0,'C');
		   }
		   }
           $this->Cell(44,0,'',0,0,'C');
           $this->Cell(10.5,5.75,'obt',1,0,'C');
           $this->Cell(10.5,5.75,'grade',1,0,'C');

		   $this->SetXY(3,47);
		   $this->SetFont('Times','B',10);
		   if($total_subject=='3'){
		   $this->Cell(5,7,'1',1,0,'C');
		   $this->Cell(60,7,'2',1,0,'C');
		   $this->Cell(25,7,'3',1,0,'C');
		   $this->Cell(22.66,7,'4',1,0,'C');
		   $this->Cell(22.66,7,'5',1,0,'C');
		   $this->Cell(22.66,7,'6',1,0,'C');
		   $this->Cell(22.66,7,'7',1,0,'C');
		   $this->Cell(22.66,7,'8',1,0,'C');
		   $this->Cell(22.66,7,'9',1,0,'C');
		   $this->Cell(8,7,'10',1,0,'C');
		   $this->Cell(12,7,'11',1,0,'C');
		   $this->Cell(12,7,'12',1,0,'C');
		   $this->Cell(12,7,'13',1,0,'C');
		   $this->Cell(10.5,7,'14',1,0,'C');
		   $this->Cell(10.5,7,'15',1,0,'C');
		   }elseif($total_subject=='4'){
		   $this->Cell(5,7,'1',1,0,'C');
		   $this->Cell(60,7,'2',1,0,'C');
		   $this->Cell(25,7,'3',1,0,'C');
		   $this->Cell(17,7,'4',1,0,'C');
		   $this->Cell(17,7,'5',1,0,'C');
		   $this->Cell(17,7,'6',1,0,'C');
		   $this->Cell(17,7,'7',1,0,'C');
		   $this->Cell(17,7,'8',1,0,'C');
		   $this->Cell(17,7,'9',1,0,'C');
		   $this->Cell(17,7,'10',1,0,'C');
		   $this->Cell(17,7,'11',1,0,'C');
		   $this->Cell(8,7,'12',1,0,'C');
		   $this->Cell(12,7,'13',1,0,'C');
		   $this->Cell(12,7,'14',1,0,'C');
		   $this->Cell(12,7,'15',1,0,'C');
		   $this->Cell(10.5,7,'16',1,0,'C');
		   $this->Cell(10.5,7,'17',1,0,'C');
		   }elseif($total_subject=='5'){
		   $this->Cell(5,7,'1',1,0,'C');
		   $this->Cell(60,7,'2',1,0,'C');
		   $this->Cell(25,7,'3',1,0,'C');
		   $this->Cell(13.6,7,'4',1,0,'C');
		   $this->Cell(13.6,7,'5',1,0,'C');
		   $this->Cell(13.6,7,'6',1,0,'C');
		   $this->Cell(13.6,7,'7',1,0,'C');
		   $this->Cell(13.6,7,'8',1,0,'C');
		   $this->Cell(13.6,7,'9',1,0,'C');
		   $this->Cell(13.6,7,'10',1,0,'C');
		   $this->Cell(13.6,7,'11',1,0,'C');
		   $this->Cell(13.6,7,'12',1,0,'C');
		   $this->Cell(13.6,7,'13',1,0,'C');
		   $this->Cell(8,7,'14',1,0,'C');
		   $this->Cell(12,7,'15',1,0,'C');
		   $this->Cell(12,7,'16',1,0,'C');
		   $this->Cell(12,7,'17',1,0,'C');
		   $this->Cell(10.5,7,'18',1,0,'C');
		   $this->Cell(10.5,7,'19',1,0,'C');
		   }elseif($total_subject=='6'){
		   $this->Cell(5,7,'1',1,0,'C');
		   $this->Cell(60,7,'2',1,0,'C');
		   $this->Cell(25,7,'3',1,0,'C');
		   $this->Cell(11.33,7,'4',1,0,'C');
		   $this->Cell(11.33,7,'5',1,0,'C');
		   $this->Cell(11.33,7,'6',1,0,'C');
		   $this->Cell(11.33,7,'7',1,0,'C');
		   $this->Cell(11.33,7,'8',1,0,'C');
		   $this->Cell(11.33,7,'9',1,0,'C');
		   $this->Cell(11.33,7,'10',1,0,'C');
		   $this->Cell(11.33,7,'11',1,0,'C');
		   $this->Cell(11.33,7,'12',1,0,'C');
		   $this->Cell(11.33,7,'13',1,0,'C');
		   $this->Cell(11.33,7,'14',1,0,'C');
		   $this->Cell(11.33,7,'15',1,0,'C');
		   $this->Cell(8,7,'16',1,0,'C');
		   $this->Cell(12,7,'17',1,0,'C');
		   $this->Cell(12,7,'18',1,0,'C');
		   $this->Cell(12,7,'19',1,0,'C');
		   $this->Cell(10.5,7,'20',1,0,'C');
		   $this->Cell(10.5,7,'21',1,0,'C');
		   }elseif($total_subject=='7'){
		   $this->Cell(5,7,'1',1,0,'C');
		   $this->Cell(60,7,'2',1,0,'C');
		   $this->Cell(25,7,'3',1,0,'C');
		   $this->Cell(9.71,7,'4',1,0,'C');
		   $this->Cell(9.71,7,'5',1,0,'C');
		   $this->Cell(9.71,7,'6',1,0,'C');
		   $this->Cell(9.71,7,'7',1,0,'C');
		   $this->Cell(9.71,7,'8',1,0,'C');
		   $this->Cell(9.71,7,'9',1,0,'C');
		   $this->Cell(9.71,7,'10',1,0,'C');
		   $this->Cell(9.71,7,'11',1,0,'C');
		   $this->Cell(9.71,7,'12',1,0,'C');
		   $this->Cell(9.71,7,'13',1,0,'C');
		   $this->Cell(9.71,7,'14',1,0,'C');
		   $this->Cell(9.71,7,'15',1,0,'C');
		   $this->Cell(9.71,7,'16',1,0,'C');
		   $this->Cell(9.71,7,'17',1,0,'C');
		   $this->Cell(8,7,'18',1,0,'C');
		   $this->Cell(12,7,'19',1,0,'C');
		   $this->Cell(12,7,'20',1,0,'C');
		   $this->Cell(12,7,'21',1,0,'C');
		   $this->Cell(10.5,7,'22',1,0,'C');
		   $this->Cell(10.5,7,'23',1,0,'C');
		   }elseif($total_subject=='8'){
		   $this->Cell(5,7,'1',1,0,'C');
		   $this->Cell(60,7,'2',1,0,'C');
		   $this->Cell(25,7,'3',1,0,'C');
		   $this->Cell(8.5,7,'4',1,0,'C');
		   $this->Cell(8.5,7,'5',1,0,'C');
		   $this->Cell(8.5,7,'6',1,0,'C');
		   $this->Cell(8.5,7,'7',1,0,'C');
		   $this->Cell(8.5,7,'8',1,0,'C');
		   $this->Cell(8.5,7,'9',1,0,'C');
		   $this->Cell(8.5,7,'10',1,0,'C');
		   $this->Cell(8.5,7,'11',1,0,'C');
		   $this->Cell(8.5,7,'12',1,0,'C');
		   $this->Cell(8.5,7,'13',1,0,'C');
		   $this->Cell(8.5,7,'14',1,0,'C');
		   $this->Cell(8.5,7,'15',1,0,'C');
		   $this->Cell(8.5,7,'16',1,0,'C');
		   $this->Cell(8.5,7,'17',1,0,'C');
		   $this->Cell(8.5,7,'18',1,0,'C');
		   $this->Cell(8.5,7,'19',1,0,'C');
		   $this->Cell(8,7,'20',1,0,'C');
		   $this->Cell(12,7,'21',1,0,'C');
		   $this->Cell(12,7,'22',1,0,'C');
		   $this->Cell(12,7,'23',1,0,'C');
		   $this->Cell(10.5,7,'24',1,0,'C');
		   $this->Cell(10.5,7,'25',1,0,'C');
		   }elseif($total_subject=='9'){
		   $this->Cell(5,7,'1',1,0,'C');
		   $this->Cell(60,7,'2',1,0,'C');
		   $this->Cell(25,7,'3',1,0,'C');
		   $this->Cell(7.55,7,'4',1,0,'C');
		   $this->Cell(7.55,7,'5',1,0,'C');
		   $this->Cell(7.55,7,'6',1,0,'C');
		   $this->Cell(7.55,7,'7',1,0,'C');
		   $this->Cell(7.55,7,'8',1,0,'C');
		   $this->Cell(7.55,7,'9',1,0,'C');
		   $this->Cell(7.55,7,'10',1,0,'C');
		   $this->Cell(7.55,7,'11',1,0,'C');
		   $this->Cell(7.55,7,'12',1,0,'C');
		   $this->Cell(7.55,7,'13',1,0,'C');
		   $this->Cell(7.55,7,'14',1,0,'C');
		   $this->Cell(7.55,7,'15',1,0,'C');
		   $this->Cell(7.55,7,'16',1,0,'C');
		   $this->Cell(7.55,7,'17',1,0,'C');
		   $this->Cell(7.55,7,'18',1,0,'C');
		   $this->Cell(7.55,7,'19',1,0,'C');
		   $this->Cell(7.55,7,'20',1,0,'C');
		   $this->Cell(7.55,7,'21',1,0,'C');
		   $this->Cell(8,7,'22',1,0,'C');
		   $this->Cell(12,7,'23',1,0,'C');
		   $this->Cell(12,7,'24',1,0,'C');
		   $this->Cell(12,7,'25',1,0,'C');
		   $this->Cell(10.5,7,'26',1,0,'C');
		   $this->Cell(10.5,7,'27',1,0,'C');
		   }elseif($total_subject=='10'){
		   $this->Cell(5,7,'1',1,0,'C');
		   $this->Cell(60,7,'2',1,0,'C');
		   $this->Cell(25,7,'3',1,0,'C');
		   $this->Cell(6.8,7,'4',1,0,'C');
		   $this->Cell(6.8,7,'5',1,0,'C');
		   $this->Cell(6.8,7,'6',1,0,'C');
		   $this->Cell(6.8,7,'7',1,0,'C');
		   $this->Cell(6.8,7,'8',1,0,'C');
		   $this->Cell(6.8,7,'9',1,0,'C');
		   $this->Cell(6.8,7,'10',1,0,'C');
		   $this->Cell(6.8,7,'11',1,0,'C');
		   $this->Cell(6.8,7,'12',1,0,'C');
		   $this->Cell(6.8,7,'13',1,0,'C');
		   $this->Cell(6.8,7,'14',1,0,'C');
		   $this->Cell(6.8,7,'15',1,0,'C');
		   $this->Cell(6.8,7,'16',1,0,'C');
		   $this->Cell(6.8,7,'17',1,0,'C');
		   $this->Cell(6.8,7,'18',1,0,'C');
		   $this->Cell(6.8,7,'19',1,0,'C');
		   $this->Cell(6.8,7,'20',1,0,'C');
		   $this->Cell(6.8,7,'21',1,0,'C');
		   $this->Cell(6.8,7,'22',1,0,'C');
		   $this->Cell(6.8,7,'23',1,0,'C');
		   $this->Cell(8,7,'24',1,0,'C');
		   $this->Cell(12,7,'25',1,0,'C');
		   $this->Cell(12,7,'26',1,0,'C');
		   $this->Cell(12,7,'27',1,0,'C');
		   $this->Cell(10.5,7,'28',1,0,'C');
		   $this->Cell(10.5,7,'29',1,0,'C');
		   }else{
		   $this->Cell(5,7,'1',1,0,'C');
		   $this->Cell(60,7,'2',1,0,'C');
		   $this->Cell(25,7,'3',1,0,'C');
		   $this->Cell(6.18,7,'4',1,0,'C');
		   $this->Cell(6.18,7,'5',1,0,'C');
		   $this->Cell(6.18,7,'6',1,0,'C');
		   $this->Cell(6.18,7,'7',1,0,'C');
		   $this->Cell(6.18,7,'8',1,0,'C');
		   $this->Cell(6.18,7,'9',1,0,'C');
		   $this->Cell(6.18,7,'10',1,0,'C');
		   $this->Cell(6.18,7,'11',1,0,'C');
		   $this->Cell(6.18,7,'12',1,0,'C');
		   $this->Cell(6.18,7,'13',1,0,'C');
		   $this->Cell(6.18,7,'14',1,0,'C');
		   $this->Cell(6.18,7,'15',1,0,'C');
		   $this->Cell(6.18,7,'16',1,0,'C');
		   $this->Cell(6.18,7,'17',1,0,'C');
		   $this->Cell(6.18,7,'18',1,0,'C');
		   $this->Cell(6.18,7,'19',1,0,'C');
		   $this->Cell(6.18,7,'20',1,0,'C');
		   $this->Cell(6.18,7,'21',1,0,'C');
		   $this->Cell(6.18,7,'22',1,0,'C');
		   $this->Cell(6.18,7,'23',1,0,'C');
		   $this->Cell(6.18,7,'24',1,0,'C');
		   $this->Cell(6.18,7,'25',1,0,'C');
		   $this->Cell(8,7,'26',1,0,'C');
		   $this->Cell(12,7,'27',1,0,'C');
		   $this->Cell(12,7,'28',1,0,'C');
		   $this->Cell(12,7,'29',1,0,'C');
		   $this->Cell(10.5,7,'30',1,0,'C');
		   $this->Cell(10.5,7,'31',1,0,'C');
		   }
		   $this->Ln();

//-------------------Detail-Section-------------------------//  
    
    for($d=0;$d<$total_student;$d++){   

	$query1="select * from examination where student_roll_no='$student_roll_no[$d]' and session_value='$session1'";
    $run1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
    while($row1=mysqli_fetch_assoc($run1)){
	$c8=0;
    for($j=0; $j<$total_exam; $j++){
	for($i=0; $i<$total_subject; $i++){
    $exam_marks=$exam_code[$j]."_".$subject_code[$i]."_marks";
    $exam_marks1[$c8]=$row1[$exam_marks];
	$cgpa_marks[$c8]= round ($exam_marks1[$c8]/9.8,1);
	//$grand_total_maximum[$j]=$grand_total_maximum[$j]+$exam_maximum_marks1;
	//$grand_total_obtain[$j]=$grand_total_obtain[$j]+$exam_marks1;
	$c8++;
	}
	}
	$c9=0;
	for($i7=0; $i7<$total_subject; $i7++){
	for($j7=0; $j7<$total_exam; $j7++){
    $exam_marks_exam_wise=$exam_code[$j7]."_".$subject_code[$i7]."_marks";
    $exam_marks_exam_wise1[$c9]=$row1[$exam_marks_exam_wise];
	$cgpa_marks_exam_wise[$c9]= round ($exam_marks_exam_wise1[$c9]/9.8,1);
	//$grand_total_maximum[$j]=$grand_total_maximum[$j]+$exam_maximum_marks1;
	//$grand_total_obtain[$j]=$grand_total_obtain[$j]+$exam_marks1;
	}
	}
	$c9++;
	}
	
	
	 $k=0;
	 for($j1=0; $j1<$total_exam; $j1++){
	 $this->Cell(93,48,'',0,0,'C');
	 for($i1=0; $i1<$total_subject; $i1++){
	
	 if($exam_marks_add[$k]=='Yes'){
	 $grand_total_maximum[$j1]=$grand_total_maximum[$j1]+$student_maximum_marks[$k];
	 $grand_total_minimum[$j1]=$grand_total_minimum[$j1]+$student_minimum_marks[$k];
	 $grand_total_obtain[$j1]=$grand_total_obtain[$j1]+$exam_marks1[$k];
     }
	 
    if($exam_marks1[$k]<$student_minimum_marks[$k] or $exam_marks1[$k]==0)
	{
	$fail_pass="Pass";
	}
	
    if($student_maximum_marks[$k]!=0){  
    $grade[$k]=($exam_marks1[$k]*100)/$student_maximum_marks[$k];
	$grade[$k]=round($grade[$k],2);

	switch($grade[$k]){
	case ($grade[$k]>90):
	$grade2[$k]="A+";
	break;
	case ($grade[$k]<=80 && $grade[$k]>70):
	$grade2[$k]="B+";
	break;
	case ($grade[$k]<=70 && $grade[$k]>60):
	$grade2[$k]="B";
	break;
	case ($grade[$k]<=60 && $grade[$k]>50):
	$grade2[$k]="C+";
	break;
	case ($grade[$k]<=50 && $grade[$k]>40):
	$grade2[$k]="C";
	break;
	case ($grade[$k]<=40 && $grade[$k]>33):
	$grade2[$k]="D+";
	break;
	case ($grade[$k]<=32 && $grade[$k]>0):
	$grade2[$k]="F";
	break;
	}
	if($grade[$k]==0){
	$grade2[$k]="F";
	}
	}
	else{
	$grade2[$k]='';
	}

	
	if($grand_total_maximum[$j1]!=0){  
    $percentage[$j1]=($grand_total_obtain[$j1]*100)/$grand_total_maximum[$j1];
	$percentage[$j1]=round($percentage[$j1],2);

	switch($percentage[$j1]){
	case ($percentage[$j1]>90):
	$percentage2[$j1]="A+";
	$remark[$j1]="Excellent";
	break;
	case ($percentage[$j1]<=80 && $percentage[$j1]>70):
	$percentage2[$j1]="B+";
	$remark[$j1]="GOOD";
	break;
	case ($percentage[$j1]<=70 && $percentage[$j1]>60):
	$percentage2[$j1]="B";
	$remark[$j1]="AVERAGE";
	break;
	case ($percentage[$j1]<=60 && $percentage[$j1]>50):
	$percentage2[$j1]="C+";
	$remark[$j1]="TRY TO IMPROVE";
	break;
	case ($percentage[$j1]<=50 && $percentage[$j1]>40):
	$percentage2[$j1]="C";
	$remark[$j1]="WORK HARD";
	break;
	case ($percentage[$j1]<=40 && $percentage[$j1]>33):
	$percentage2[$j1]="D+";
	$remark[$j1]="NEED CARE";
	break;
	case ($percentage[$j1]<=32 && $percentage[$j1]>0):
	$percentage2[$j1]="F";
	$remark[$j1]="VERY POOR";
	break;
	}
	if($percentage[$j1]==0){
	$percentage2[$j1]="F";
	$remark[$j1]="VERY POOR";
	}
	}
	else{
	$percentage2[$j1]='';
	$remark[$j1]='';  
	}
	
	if($cgpa_marks[$k]==0){
	    $cgpa_marks[$k]="G.P";
	}
	
	       $this->SetFont('Times','B',8);
		   if($total_subject=='2'){
		   $this->Cell(33.9,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(33.9,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='3'){
		   $this->Cell(22.66,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(22.66,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='4'){
		   $this->Cell(16.99,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(16.99,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='5'){
		   $this->Cell(13.59,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(13.59,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='6'){
		   $this->Cell(11.33,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(11.33,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='7'){
		   $this->Cell(9.68,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(9.68,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='8'){
		   $this->Cell(8.47,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(8.47,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='9'){
		   $this->Cell(7.53,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(7.53,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='10'){
		   $this->Cell(6.78,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(6.78,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='11'){
		   $this->Cell(6.16,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(6.16,6,''.$cgpa_marks[$k],1,0,'C');
		   }elseif($total_subject=='12'){
		   $this->Cell(5.65,6,''.$exam_marks1[$k],1,0,'C');
		   $this->Cell(5.65,6,''.$cgpa_marks[$k],1,0,'C');
		   }
		   $k++;
		   }
		   $this->Ln();
		   
           }
           	   
		   if($total_exam=='1'){
		   $this->Cell(1,-6,'',0,0,'C');
		   $this->Ln();
           }elseif($total_exam=='2'){
		   $this->Cell(1,-12,'',0,0,'C');
		   $this->Ln();
		   }elseif($total_exam=='3'){
		   $this->Cell(1,-18,'',0,0,'C');
		   $this->Ln();
           }elseif($total_exam=='4'){
		   $this->Cell(1,-24,'',0,0,'C');
		   $this->Ln();
           }
		   
		   if($total_subject=='1'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[1]+$exam_marks1[2];
		  $great_grand_obtain=$grand_total_obtain1;
          $percentage1=$great_grand_obtain*100/300;
		  $percentage=round($percentage1,2).' %';
	      }elseif($total_subject=='2'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[2]+$exam_marks1[4];
		  $grand_total_obtain2=$exam_marks1[1]+$exam_marks1[3]+$exam_marks1[5];
		  $great_grand_obtain=$grand_total_obtain1+$grand_total_obtain2;
		  $percentage1=$great_grand_obtain*100/600;
		  $percentage=round($percentage1,2).' %';
	      }elseif($total_subject=='3'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[3]+$exam_marks1[6];
		  $grand_total_obtain2=$exam_marks1[1]+$exam_marks1[4]+$exam_marks1[7];
		  $grand_total_obtain3=$exam_marks1[2]+$exam_marks1[5]+$exam_marks1[8];
		  $great_grand_obtain=$grand_total_obtain1+$grand_total_obtain2+$grand_total_obtain3;
		  $percentage1=$great_grand_obtain*100/900;
		  $percentage=round($percentage1,2).' %';
	      }elseif($total_subject=='4'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[4]+$exam_marks1[8];
		  $grand_total_obtain2=$exam_marks1[1]+$exam_marks1[5]+$exam_marks1[9];
		  $grand_total_obtain3=$exam_marks1[2]+$exam_marks1[6]+$exam_marks1[10];
		  $grand_total_obtain4=$exam_marks1[3]+$exam_marks1[7]+$exam_marks1[11];
		  $great_grand_obtain=$grand_total_obtain1+$grand_total_obtain2+$grand_total_obtain3+$grand_total_obtain4;
          $percentage1=$great_grand_obtain*100/1200;
		  $percentage=round($percentage1,2).' %';
	      }elseif($total_subject=='5'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[5]+$exam_marks1[10];
		  $grand_total_obtain2=$exam_marks1[1]+$exam_marks1[6]+$exam_marks1[11];
		  $grand_total_obtain3=$exam_marks1[2]+$exam_marks1[7]+$exam_marks1[12];
		  $grand_total_obtain4=$exam_marks1[3]+$exam_marks1[8]+$exam_marks1[13];
		  $grand_total_obtain5=$exam_marks1[4]+$exam_marks1[9]+$exam_marks1[14];
		  $great_grand_obtain=$grand_total_obtain1+$grand_total_obtain2+$grand_total_obtain3+$grand_total_obtain4+$grand_total_obtain5;
          $percentage1=$great_grand_obtain*100/500;
		  $percentage=round($percentage1,2).' %';
		  
          }elseif($total_subject=='6'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[6]+$exam_marks1[12];
		  $grand_total_obtain2=$exam_marks1[1]+$exam_marks1[7]+$exam_marks1[13];
		  $grand_total_obtain3=$exam_marks1[2]+$exam_marks1[8]+$exam_marks1[14];
		  $grand_total_obtain4=$exam_marks1[3]+$exam_marks1[9]+$exam_marks1[15];
		  $grand_total_obtain5=$exam_marks1[4]+$exam_marks1[10]+$exam_marks1[16];
		  $grand_total_obtain6=$exam_marks1[5]+$exam_marks1[11]+$exam_marks1[17];
		  $great_grand_obtain=$grand_total_obtain1+$grand_total_obtain2+$grand_total_obtain3+$grand_total_obtain4+$grand_total_obtain5+$grand_total_obtain6;
		  $percentage1=$great_grand_obtain*100/600;
		  $percentage=round($percentage1,2).' %';
	      }elseif($total_subject=='7'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[7]+$exam_marks1[14];
		  $grand_total_obtain2=$exam_marks1[1]+$exam_marks1[8]+$exam_marks1[15];
		  $grand_total_obtain3=$exam_marks1[2]+$exam_marks1[9]+$exam_marks1[16];
		  $grand_total_obtain4=$exam_marks1[3]+$exam_marks1[10]+$exam_marks1[17];
		  $grand_total_obtain5=$exam_marks1[4]+$exam_marks1[11]+$exam_marks1[18];
		  $grand_total_obtain6=$exam_marks1[5]+$exam_marks1[12]+$exam_marks1[19];
		  $grand_total_obtain7=$exam_marks1[6]+$exam_marks1[13]+$exam_marks1[20];
		  $great_grand_obtain=$grand_total_obtain1+$grand_total_obtain2+$grand_total_obtain3+$grand_total_obtain4+$grand_total_obtain5+$grand_total_obtain6+$grand_total_obtain7;
		  $percentage1=$great_grand_obtain*100/2100;
		  $percentage=round($percentage1,2).' %';
	      }elseif($total_subject=='8'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[8]+$exam_marks1[16];
		  $grand_total_obtain2=$exam_marks1[1]+$exam_marks1[9]+$exam_marks1[17];
		  $grand_total_obtain3=$exam_marks1[2]+$exam_marks1[10]+$exam_marks1[18];
		  $grand_total_obtain4=$exam_marks1[3]+$exam_marks1[11]+$exam_marks1[19];
		  $grand_total_obtain5=$exam_marks1[4]+$exam_marks1[12]+$exam_marks1[20];
		  $grand_total_obtain6=$exam_marks1[5]+$exam_marks1[13]+$exam_marks1[21];
		  $grand_total_obtain7=$exam_marks1[6]+$exam_marks1[14]+$exam_marks1[22];
		  $grand_total_obtain8=$exam_marks1[7]+$exam_marks1[15]+$exam_marks1[23];
		  $great_grand_obtain=$grand_total_obtain1+$grand_total_obtain2+$grand_total_obtain3+$grand_total_obtain4+$grand_total_obtain5+$grand_total_obtain6+$grand_total_obtain7+$grand_total_obtain8;
          $percentage1=$great_grand_obtain*100/2400;
		  $percentage=round($percentage1,2).' %';
	      }elseif($total_subject=='9'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[9]+$exam_marks1[18];
		  $grand_total_obtain2=$exam_marks1[1]+$exam_marks1[10]+$exam_marks1[19];
		  $grand_total_obtain3=$exam_marks1[2]+$exam_marks1[11]+$exam_marks1[20];
		  $grand_total_obtain4=$exam_marks1[3]+$exam_marks1[12]+$exam_marks1[21];
		  $grand_total_obtain5=$exam_marks1[4]+$exam_marks1[13]+$exam_marks1[22];
		  $grand_total_obtain6=$exam_marks1[5]+$exam_marks1[14]+$exam_marks1[23];
		  $grand_total_obtain7=$exam_marks1[6]+$exam_marks1[15]+$exam_marks1[24];
		  $grand_total_obtain8=$exam_marks1[7]+$exam_marks1[16]+$exam_marks1[25];
		  $grand_total_obtain9=$exam_marks1[8]+$exam_marks1[17]+$exam_marks1[26];
		  $great_grand_obtain=$grand_total_obtain1+$grand_total_obtain2+$grand_total_obtain3+$grand_total_obtain4+$grand_total_obtain5+$grand_total_obtain6+$grand_total_obtain7+$grand_total_obtain8+$grand_total_obtain9;
          $percentage1=$great_grand_obtain*100/2700;
		  $percentage=round($percentage1,2).' %';
	      }elseif($total_subject=='10'){
		  $grand_total_obtain1=$exam_marks1[0]+$exam_marks1[10]+$exam_marks1[20];
		  $grand_total_obtain2=$exam_marks1[1]+$exam_marks1[11]+$exam_marks1[21];
		  $grand_total_obtain3=$exam_marks1[2]+$exam_marks1[12]+$exam_marks1[22];
		  $grand_total_obtain4=$exam_marks1[3]+$exam_marks1[13]+$exam_marks1[23];
		  $grand_total_obtain5=$exam_marks1[4]+$exam_marks1[14]+$exam_marks1[24];
		  $grand_total_obtain6=$exam_marks1[5]+$exam_marks1[15]+$exam_marks1[25];
		  $grand_total_obtain7=$exam_marks1[6]+$exam_marks1[16]+$exam_marks1[26];
		  $grand_total_obtain8=$exam_marks1[7]+$exam_marks1[17]+$exam_marks1[27];
		  $grand_total_obtain9=$exam_marks1[8]+$exam_marks1[18]+$exam_marks1[28];
		  $grand_total_obtain10=$exam_marks1[9]+$exam_marks1[19]+$exam_marks1[29];
		  $great_grand_obtain=$grand_total_obtain1+$grand_total_obtain2+$grand_total_obtain3+$grand_total_obtain4+$grand_total_obtain5+$grand_total_obtain6+$grand_total_obtain7+$grand_total_obtain8+$grand_total_obtain9+$grand_total_obtain10;
		  $percentage1=$great_grand_obtain*100/3000;
		  $percentage=round($percentage1,2).' %';
	      }else{

	      }
		  
		  if($percentage>='60'){
		  $division='First';
		  }elseif($percentage>='50' && $percentage<'60'){
		  $division='Second';
		  }elseif($percentage>='40' && $percentage<'50'){
		  $division='Third';
		  }elseif($percentage>='30' && $percentage<'40'){
		  $division='Third';
		  }else{
		  $division='';
		  } 
		   
		   $this->SetFont('Times','B',8);
		   $this->Cell(3,1,'',0,0,'C');
		   $this->Cell(5,48,''.$d+1,1,0,'C');
		   $this->Cell(60,6,'Student Name - '.$student_name[$d],1,0,'L');
		   if($total_exam=='4'){
		   $this->Cell(25,6,''.strtolower($examination2[3]),1,0,'C');
		   }elseif($total_exam=='3'){
		   $this->Cell(25,6,''.strtolower($examination2[2]),1,0,'C');
		   }else{
		   $this->Cell(25,6,''.strtolower($examination2[1]),1,0,'C');
		   }
		   $this->Cell(136,48,'',0,0,'C');
		   $this->Cell(8,48,'',1,0,'C');
           $this->Cell(12,42,''.$fail_pass,1,0,'C');
		   $this->Cell(12,42,''.$division,1,0,'C');
		   $this->Cell(12,24,'',1,0,'C');
		   $this->Cell(10.5,48,'',1,0,'C');
		   $this->Cell(10.5,6,'',1,0,'C');
		   $this->Ln();
		  
		   
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(60,6,"Father's Name - ".$student_father_name[$d],1,0,'L');
		   if($total_exam=='4'){
		   $this->Cell(25,6,''.strtolower($examination2[2]),1,0,'C');
		   }elseif($total_exam=='3'){
		   $this->Cell(25,6,''.strtolower($examination2[1]),1,0,'C');
		   }else{
		   $this->Cell(25,6,''.strtolower($examination2[0]),1,0,'C');
		   }
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(10.5,0,'',0,0,'C');
		   $this->Cell(10.5,6,'',0,0,'C');
		   $this->Ln();
		   
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(60,6,"Mother's Name - ".$student_mother_name[$d],1,0,'L');
		   if($total_exam=='4'){
		   $this->Cell(25,6,''.strtolower($examination2[1]),1,0,'C');
		   }elseif($total_exam=='3'){
		   $this->Cell(25,6,''.strtolower($examination2[0]),1,0,'C');
		   }else{
		   $this->Cell(25,12,'',1,0,'C');
		   }
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(10.5,0,'',0,0,'C');
		   $this->Cell(10.5,6,'',0,0,'C');
		   $this->Ln();
		   
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(60,6,'Date of Birth - '.$student_date_of_birth[$d],1,0,'L');
		   if($total_exam=='4'){
		   $this->Cell(25,6,''.strtolower($examination2[0]),0,0,'C');
		   }else{
		   $this->Cell(25,6,'',1,0,'C');
		   }
		   if($total_exam=='4'){
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   $this->Cell(11.33,0,'',0,0,'C');
		   }else{
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   }
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(10.5,0,'',0,0,'C');
		   $this->Cell(10.5,6,'',0,0,'C');
		   $this->Ln();
		   
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(60,6,'Admission No.'.$student_admission_number[$d],1,0,'L');
		   $this->Cell(25,6,'',1,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,24,'',1,0,'C');
		   $this->Cell(10.5,0,'',0,0,'C');
		   $this->Cell(10.5,6,'',0,0,'C');
		   $this->Ln();
		   
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(60,6,' Enrollment No. '.$student_roll_no[$d],1,0,'L');
		   $this->Cell(25,6,'',1,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(11.33,6,'',0,0,'C');
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(10.5,0,'',0,0,'C');
		   $this->Cell(10.5,6,'',0,0,'C');
		   $this->Ln();
		   
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(60,6,'Category - '.$student_category[$d],1,0,'L');
		   $this->Cell(25,6,'Total CGPA',1,0,'C');
           
           if($total_subject=='1'){
		    $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[1]+$cgpa_marks[2];
            
			$this->Cell(136,6,''.$grand_total_cgpa1,1,0,'C');
	       }elseif($total_subject=='2'){
		   $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[2]+$cgpa_marks[4];
	       $grand_total_cgpa2=$cgpa_marks[1]+$cgpa_marks[3]+$cgpa_marks[5];
	       
		   $this->Cell(68,6,''.$grand_total_cgpa1,1,0,'C');
	       $this->Cell(68,6,''.$grand_total_cgpa2,1,0,'C');
	       }elseif($total_subject=='3'){
		   $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[3]+$cgpa_marks[6];
	       $grand_total_cgpa2=$cgpa_marks[1]+$cgpa_marks[4]+$cgpa_marks[7];
	       $grand_total_cgpa3=$cgpa_marks[2]+$cgpa_marks[5]+$cgpa_marks[8];
		   
	       $this->Cell(45.33,6,''.$grand_total_cgpa1,1,0,'C');
	       $this->Cell(45.33,6,''.$grand_total_cgpa2,1,0,'C');
	       $this->Cell(45.33,6,''.$grand_total_cgpa3,1,0,'C');
	       }elseif($total_subject=='4'){
		   $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[4]+$cgpa_marks[8];
	       $grand_total_cgpa2=$cgpa_marks[1]+$cgpa_marks[5]+$cgpa_marks[9];
	       $grand_total_cgpa3=$cgpa_marks[2]+$cgpa_marks[6]+$cgpa_marks[10];
	       $grand_total_cgpa4=$cgpa_marks[3]+$cgpa_marks[7]+$cgpa_marks[11];
		   
	       $this->Cell(34,6,''.$grand_total_cgpa1,1,0,'C');
	       $this->Cell(34,6,''.$grand_total_cgpa2,1,0,'C');
	       $this->Cell(34,6,''.$grand_total_cgpa3,1,0,'C');
	       $this->Cell(34,6,''.$grand_total_cgpa4,1,0,'C');
	       }elseif($total_subject=='5'){
	       $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[5]+$cgpa_marks[10];
	       $grand_total_cgpa2=$cgpa_marks[1]+$cgpa_marks[6]+$cgpa_marks[11];
	       $grand_total_cgpa3=$cgpa_marks[2]+$cgpa_marks[7]+$cgpa_marks[12];
	       $grand_total_cgpa4=$cgpa_marks[3]+$cgpa_marks[8]+$cgpa_marks[13];
	       $grand_total_cgpa5=$cgpa_marks[4]+$cgpa_marks[9]+$cgpa_marks[14];
	 
	       $this->Cell(27.18,6,''.$grand_total_cgpa1,1,0,'C');
	       $this->Cell(27.18,6,''.$grand_total_cgpa2,1,0,'C');
	       $this->Cell(27.18,6,''.$grand_total_cgpa3,1,0,'C');
	       $this->Cell(27.18,6,''.$grand_total_cgpa4,1,0,'C');
	       $this->Cell(27.18,6,''.$grand_total_cgpa5,1,0,'C');
	       }elseif($total_subject=='6'){
		   $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[6]+$cgpa_marks[12];
	       $grand_total_cgpa2=$cgpa_marks[1]+$cgpa_marks[7]+$cgpa_marks[13];
	       $grand_total_cgpa3=$cgpa_marks[2]+$cgpa_marks[8]+$cgpa_marks[14];
	       $grand_total_cgpa4=$cgpa_marks[3]+$cgpa_marks[9]+$cgpa_marks[15];
	       $grand_total_cgpa5=$cgpa_marks[4]+$cgpa_marks[10]+$cgpa_marks[16];
	       $grand_total_cgpa6=$cgpa_marks[5]+$cgpa_marks[11]+$cgpa_marks[17];
		   
	       $this->Cell(22.66,6,''.$grand_total_cgpa1,1,0,'C');
	       $this->Cell(22.66,6,''.$grand_total_cgpa2,1,0,'C');
	       $this->Cell(22.66,6,''.$grand_total_cgpa3,1,0,'C');
	       $this->Cell(22.66,6,''.$grand_total_cgpa4,1,0,'C');
	       $this->Cell(22.66,6,''.$grand_total_cgpa5,1,0,'C');
	       $this->Cell(22.66,6,''.$grand_total_cgpa6,1,0,'C');
	       }elseif($total_subject=='7'){
		   $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[7]+$cgpa_marks[14];
	       $grand_total_cgpa2=$cgpa_marks[1]+$cgpa_marks[8]+$cgpa_marks[15];
	       $grand_total_cgpa3=$cgpa_marks[2]+$cgpa_marks[9]+$cgpa_marks[16];
	       $grand_total_cgpa4=$cgpa_marks[3]+$cgpa_marks[10]+$cgpa_marks[17];
	       $grand_total_cgpa5=$cgpa_marks[4]+$cgpa_marks[11]+$cgpa_marks[18];
	       $grand_total_cgpa6=$cgpa_marks[5]+$cgpa_marks[12]+$cgpa_marks[19];
	       $grand_total_cgpa7=$cgpa_marks[6]+$cgpa_marks[13]+$cgpa_marks[20];
		   
	       $this->Cell(19.43,6,''.$grand_total_cgpa1,1,0,'C');
	       $this->Cell(19.43,6,''.$grand_total_cgpa2,1,0,'C');
	       $this->Cell(19.43,6,''.$grand_total_cgpa3,1,0,'C');
	       $this->Cell(19.43,6,''.$grand_total_cgpa4,1,0,'C');
	       $this->Cell(19.43,6,''.$grand_total_cgpa5,1,0,'C');
	       $this->Cell(19.43,6,''.$grand_total_cgpa6,1,0,'C');
	       $this->Cell(19.43,6,''.$grand_total_cgpa7,1,0,'C');
	       }elseif($total_subject=='8'){
		   $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[8]+$cgpa_marks[16];
	       $grand_total_cgpa2=$cgpa_marks[1]+$cgpa_marks[9]+$cgpa_marks[17];
	       $grand_total_cgpa3=$cgpa_marks[2]+$cgpa_marks[10]+$cgpa_marks[18];
	       $grand_total_cgpa4=$cgpa_marks[3]+$cgpa_marks[11]+$cgpa_marks[19];
	       $grand_total_cgpa5=$cgpa_marks[4]+$cgpa_marks[12]+$cgpa_marks[20];
	       $grand_total_cgpa6=$cgpa_marks[5]+$cgpa_marks[13]+$cgpa_marks[21];
	       $grand_total_cgpa7=$cgpa_marks[6]+$cgpa_marks[14]+$cgpa_marks[22];
	       $grand_total_cgpa8=$cgpa_marks[7]+$cgpa_marks[15]+$cgpa_marks[23];
		   
	       $this->Cell(17,6,''.$grand_total_cgpa1,1,0,'C');
	       $this->Cell(17,6,''.$grand_total_cgpa2,1,0,'C');
	       $this->Cell(17,6,''.$grand_total_cgpa3,1,0,'C');
	       $this->Cell(17,6,''.$grand_total_cgpa4,1,0,'C');
	       $this->Cell(17,6,''.$grand_total_cgpa5,1,0,'C');
	       $this->Cell(17,6,''.$grand_total_cgpa6,1,0,'C');
	       $this->Cell(17,6,''.$grand_total_cgpa7,1,0,'C');
	       $this->Cell(17,6,''.$grand_total_cgpa8,1,0,'C');
	       }elseif($total_subject=='9'){
		   $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[9]+$cgpa_marks[18];
	       $grand_total_cgpa2=$cgpa_marks[1]+$cgpa_marks[10]+$cgpa_marks[19];
	       $grand_total_cgpa3=$cgpa_marks[2]+$cgpa_marks[11]+$cgpa_marks[20];
	       $grand_total_cgpa4=$cgpa_marks[3]+$cgpa_marks[12]+$cgpa_marks[21];
	       $grand_total_cgpa5=$cgpa_marks[4]+$cgpa_marks[13]+$cgpa_marks[22];
	       $grand_total_cgpa6=$cgpa_marks[5]+$cgpa_marks[14]+$cgpa_marks[23];
	       $grand_total_cgpa7=$cgpa_marks[6]+$cgpa_marks[15]+$cgpa_marks[24];
	       $grand_total_cgpa8=$cgpa_marks[7]+$cgpa_marks[16]+$cgpa_marks[25];
	       $grand_total_cgpa9=$cgpa_marks[8]+$cgpa_marks[17]+$cgpa_marks[26];
		   
	       $this->Cell(15.11,6,''.$grand_total_cgpa1,1,0,'C');
	       $this->Cell(15.11,6,''.$grand_total_cgpa2,1,0,'C');
	       $this->Cell(15.11,6,''.$grand_total_cgpa3,1,0,'C');
	       $this->Cell(15.11,6,''.$grand_total_cgpa4,1,0,'C');
	       $this->Cell(15.11,6,''.$grand_total_cgpa5,1,0,'C');
	       $this->Cell(15.11,6,''.$grand_total_cgpa6,1,0,'C');
	       $this->Cell(15.11,6,''.$grand_total_cgpa7,1,0,'C');
	       $this->Cell(15.11,6,''.$grand_total_cgpa8,1,0,'C');
	       $this->Cell(15.11,6,''.$grand_total_cgpa9,1,0,'C');
	       }elseif($total_subject=='10'){
		   $grand_total_cgpa1=$cgpa_marks[0]+$cgpa_marks[10]+$cgpa_marks[20];
	       $grand_total_cgpa2=$cgpa_marks[1]+$cgpa_marks[11]+$cgpa_marks[21];
	       $grand_total_cgpa3=$cgpa_marks[2]+$cgpa_marks[12]+$cgpa_marks[22];
	       $grand_total_cgpa4=$cgpa_marks[3]+$cgpa_marks[13]+$cgpa_marks[23];
	       $grand_total_cgpa5=$cgpa_marks[4]+$cgpa_marks[14]+$cgpa_marks[24];
	       $grand_total_cgpa6=$cgpa_marks[5]+$cgpa_marks[15]+$cgpa_marks[25];
	       $grand_total_cgpa7=$cgpa_marks[6]+$cgpa_marks[16]+$cgpa_marks[26];
	       $grand_total_cgpa8=$cgpa_marks[7]+$cgpa_marks[17]+$cgpa_marks[27];
	       $grand_total_cgpa9=$cgpa_marks[8]+$cgpa_marks[18]+$cgpa_marks[28];
	       $grand_total_cgpa10=$cgpa_marks[9]+$cgpa_marks[19]+$cgpa_marks[29];
		   
	       $this->Cell(13.6,6,''.$grand_total_cgpa1,1,0,'C');
	       $this->Cell(13.6,6,''.$grand_total_cgpa2,1,0,'C');
	       $this->Cell(13.6,6,''.$grand_total_cgpa3,1,0,'C');
	       $this->Cell(13.6,6,''.$grand_total_cgpa4,1,0,'C');
	       $this->Cell(13.6,6,''.$grand_total_cgpa5,1,0,'C');
	       $this->Cell(13.6,6,''.$grand_total_cgpa6,1,0,'C');
	       $this->Cell(13.6,6,''.$grand_total_cgpa7,1,0,'C');
	       $this->Cell(13.6,6,''.$grand_total_cgpa8,1,0,'C');
	       $this->Cell(13.6,6,''.$grand_total_cgpa9,1,0,'C');
	       $this->Cell(13.6,6,''.$grand_total_cgpa10,1,0,'C');
	       }else{
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       $this->Cell(12.36,6,'',1,0,'C');
	       }
           $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(10.5,0,'',0,0,'C');
		   $this->Cell(10.5,6,'',0,0,'C');
		   $this->Ln();
		   
		   $this->Cell(8,0,'',0,0,'C');
		   $this->Cell(60,6,'Roll No. - '.$school_roll_no[$d],1,0,'L');
		   $this->Cell(25,6,'Total Obtained',1,0,'C');
		  if($total_subject=='1'){
		  $this->Cell(136,6,''.$grand_total_obtain1,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');
	      }elseif($total_subject=='2'){
		  $this->Cell(68,6,''.$grand_total_obtain1,1,0,'C');
	      $this->Cell(68,6,''.$grand_total_obtain2,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');

	      }elseif($total_subject=='3'){
		  $this->Cell(45.33,6,''.$grand_total_obtain1,1,0,'C');
	      $this->Cell(45.33,6,''.$grand_total_obtain2,1,0,'C');
	      $this->Cell(45.33,6,''.$grand_total_obtain3,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');

	      }elseif($total_subject=='4'){
		  $this->Cell(34,6,''.$grand_total_obtain1,1,0,'C');
	      $this->Cell(34,6,''.$grand_total_obtain2,1,0,'C');
	      $this->Cell(34,6,''.$grand_total_obtain3,1,0,'C');
	      $this->Cell(34,6,''.$grand_total_obtain4,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');
		  
	      }elseif($total_subject=='5'){
          $this->Cell(27.18,6,''.$grand_total_obtain1,1,0,'C');
	      $this->Cell(27.18,6,''.$grand_total_obtain2,1,0,'C');
	      $this->Cell(27.18,6,''.$grand_total_obtain3,1,0,'C');
	      $this->Cell(27.18,6,''.$grand_total_obtain4,1,0,'C');
	      $this->Cell(27.18,6,''.$grand_total_obtain5,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');
          }elseif($total_subject=='6'){
          $this->Cell(22.66,6,''.$grand_total_obtain1,1,0,'C');
	      $this->Cell(22.66,6,''.$grand_total_obtain2,1,0,'C');
	      $this->Cell(22.66,6,''.$grand_total_obtain3,1,0,'C');
	      $this->Cell(22.66,6,''.$grand_total_obtain4,1,0,'C');
	      $this->Cell(22.66,6,''.$grand_total_obtain5,1,0,'C');
	      $this->Cell(22.66,6,''.$grand_total_obtain6,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');
	      }elseif($total_subject=='7'){
          $this->Cell(19.43,6,''.$grand_total_obtain1,1,0,'C');
	      $this->Cell(19.43,6,''.$grand_total_obtain2,1,0,'C');
	      $this->Cell(19.43,6,''.$grand_total_obtain3,1,0,'C');
	      $this->Cell(19.43,6,''.$grand_total_obtain4,1,0,'C');
	      $this->Cell(19.43,6,''.$grand_total_obtain5,1,0,'C');
	      $this->Cell(19.43,6,''.$grand_total_obtain6,1,0,'C');
	      $this->Cell(19.43,6,''.$grand_total_obtain7,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');
		  }elseif($total_subject=='8'){
          $this->Cell(17,6,''.$grand_total_obtain1,1,0,'C');
	      $this->Cell(17,6,''.$grand_total_obtain2,1,0,'C');
	      $this->Cell(17,6,''.$grand_total_obtain3,1,0,'C');
	      $this->Cell(17,6,''.$grand_total_obtain4,1,0,'C');
	      $this->Cell(17,6,''.$grand_total_obtain5,1,0,'C');
	      $this->Cell(17,6,''.$grand_total_obtain6,1,0,'C');
	      $this->Cell(17,6,''.$grand_total_obtain7,1,0,'C');
	      $this->Cell(17,6,''.$grand_total_obtain8,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');

	      }elseif($total_subject=='9'){
          $this->Cell(15.11,6,''.$grand_total_obtain1,1,0,'C');
	      $this->Cell(15.11,6,''.$grand_total_obtain2,1,0,'C');
	      $this->Cell(15.11,6,''.$grand_total_obtain3,1,0,'C');
	      $this->Cell(15.11,6,''.$grand_total_obtain4,1,0,'C');
	      $this->Cell(15.11,6,''.$grand_total_obtain5,1,0,'C');
	      $this->Cell(15.11,6,''.$grand_total_obtain6,1,0,'C');
	      $this->Cell(15.11,6,''.$grand_total_obtain7,1,0,'C');
	      $this->Cell(15.11,6,''.$grand_total_obtain8,1,0,'C');
	      $this->Cell(15.11,6,''.$grand_total_obtain9,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');

	      }elseif($total_subject=='10'){
          $this->Cell(13.6,6,''.$grand_total_obtain1,1,0,'C');
	      $this->Cell(13.6,6,''.$grand_total_obtain2,1,0,'C');
	      $this->Cell(13.6,6,''.$grand_total_obtain3,1,0,'C');
	      $this->Cell(13.6,6,''.$grand_total_obtain4,1,0,'C');
	      $this->Cell(13.6,6,''.$grand_total_obtain5,1,0,'C');
		  $this->Cell(13.6,6,''.$grand_total_obtain6,1,0,'C');
	      $this->Cell(13.6,6,''.$grand_total_obtain7,1,0,'C');
	      $this->Cell(13.6,6,''.$grand_total_obtain8,1,0,'C');
	      $this->Cell(13.6,6,''.$grand_total_obtain9,1,0,'C');
	      $this->Cell(13.6,6,''.$grand_total_obtain10,1,0,'C');
		  
		  $this->Cell(8,6,''.$great_grand_obtain,1,0,'C');
		  }else{
		  $this->Cell(12.36,6,'',1,0,'C');
	      $this->Cell(12.36,6,'',1,0,'C');
		  $this->Cell(12.36,6,'',1,0,'C');
	      $this->Cell(12.36,6,'',1,0,'C');
		  $this->Cell(12.36,6,'',1,0,'C');
	      $this->Cell(12.36,6,'',1,0,'C');
		  $this->Cell(12.36,6,'',1,0,'C');
	      $this->Cell(12.36,6,'',1,0,'C');
		  $this->Cell(12.36,6,'',1,0,'C');
	      $this->Cell(12.36,6,'',1,0,'C');
		  $this->Cell(12.36,6,'',1,0,'C');
		  
		  $this->Cell(8,6,'0',1,0,'C');
	      }
		  
		   
		   $this->Cell(24,6,''.$percentage,1,0,'C');
		   $this->Cell(12,0,'',0,0,'C');
		   $this->Cell(10.5,0,'',0,0,'C');
		   $this->Cell(10.5,6,'',1,0,'C');
		   $this->Ln();
		   
		   
           
		   $this->SetLineWidth(0.80);
		   $this->Cell(3,0,'',0,0,'C');
		   $this->Cell(5,0.10,'',1,0,'C');
		   $this->Cell(60,0.10,'',1,0,'L');
		   $this->Cell(25,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(11.33,0.10,'',1,0,'C');
		   $this->Cell(8,0.10,'',1,0,'C');
		   $this->Cell(24,0.10,'',1,0,'C');
		   $this->Cell(12,0.10,'',1,0,'C');
		   $this->Cell(10.5,0.10,'',1,0,'C');
		   $this->Cell(10.5,0.10,'',1,0,'C');
		   $this->Ln();
		   $this->SetLineWidth(0.10);
		   
		   
           }
		   

    		   
}



function Table2()
{

	
}	  	  








function sign($s1, $s2){

	    $this->Cell(90,6,$s1,'',0,'L',false);
        $this->Cell(90,6,$s2,'',0,'R',false);
		$this->Ln();
}



}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

 //$pdf->Image('background.png',5,5,287,200);
 
 
 
	
		
		
	//  $pdf->SetLeftMargin(30);
		$pdf->Table1();
		$pdf->Ln(0);
		$pdf->Table2();
		$pdf->Ln(0);
		

		
		
		
	//	$pdf->SetLeftMargin(-30);

	
$pdf->Output();
?>