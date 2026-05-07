<?php
include("../../../admin/attachment/session.php");
require('../fpdf.php');
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

}

// Page footer
function Footer()
{
   
   
}

function Table1(){
    
include("../../../admin/attachment/session.php");
if(isset($_POST['student_roll_no_info'])){
$query1="select * from school_info_general";
$run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run1)){ //echo '<pre>';print_r($row);
$school_info_school_name = $row['school_info_school_name'];
$school_info_school_state=$row['school_info_school_state'];
$school_info_school_district=$row['school_info_school_district'];
$school_info_school_address=$row['school_info_school_address'];
$school_info_school_name = strtoupper($school_info_school_name);
$school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
	$principal_signature=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_signature;$principal_signature=str_replace(" ","%20",$principal_signature);
	$principal_seal=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_seal;$principal_seal=str_replace(" ","%20",$principal_seal);

}
$student_class=$_POST['student_class1'];

$query1="select * from school_info_class_info where class_name='$student_class'";
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$class_code=$row1['class_code'];
}

$exam_code=$_POST['exam_type1'];
$session=$_POST['session'];
$student_class_group=$_POST['student_class_group'];
$student_class_stream=$_POST['student_class_stream'];
$query2="select * from school_info_exam_types where exam_code='$exam_code' and session_value='$session1' and class_code='$class_code'";
$res2=mysqli_query($conn73,$query2);
while($row2=mysqli_fetch_assoc($res2)){
$exam_type1=$row2['exam_type'];
}
 $student_roll_no1=$_POST['student_roll_no_info'];
 $total_student=count($student_roll_no1);
 $image_count1=0;
 $serial_no1=0;
for($k=0; $k<$total_student; $k++){
$que1="select * from student_admission_info where student_roll_no='$student_roll_no1[$k]' and session_value='$session'";
$run1=mysqli_query($conn73,$que1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){ 
  
$s_no=$row1['s_no'];
$student_name = $row1['student_name'];
$student_father_name = $row1['student_father_name'];
$student_class = $row1['student_class'];
$student_class_section = $row1['student_class_section'];
$school_roll_no = $row1['school_roll_no'];
$student_photo = $row1['student_photo'];
$student_id_generate=$row1['student_id_generate'];
$student_photo=$row1['student_image_name'];
$student_image=$_SESSION['amazon_file_path']."student_documents/".$student_photo;$student_image=str_replace(" ","%20",$student_image);

$serial_no1++;

         $this->Cell(190,1,"",0);
         $this->Ln();

		 $this->SetFont('Times','B',16);
		 $this->SetTextColor(180,0,0);
		 $this->Cell(190,6,''.$school_info_school_name,0,0,'C');
		 $this->Ln();
 
		 if($session=='2017_18'){
		 $session_value='2017-18';
		 }elseif($session=='2018_19'){
		 $session_value='2018-19';
		 }elseif($session=='2019_20'){
		 $session_value='2019-20';
		 }
		 
		 $this->SetFont('Times','B',12);
		 $this->Cell(190,5,"$school_info_school_address",0,0,'C');
         $this->Ln();
		 
		 $this->SetFont('Times','B',13);
		 $this->SetTextColor(0,128,0);
//		 $this->Cell(190,5,"Annual Exam  $session_value",0,0,'C');
		 $this->Cell(190,5,"$exam_type1 ",0,0,'C');
		 $this->Cell(0,4);
		 $this->Ln();

		 $this->Cell(190,1,"",0);
         $this->Ln();
		 
		 $this->SetFont('Times','B',13);
		 $this->SetTextColor(0,128,0);
		 $this->Cell(190,6,'ADMIT CARD',0,0,'C');
		 $this->Cell(0,4);
		 $this->Ln();	

        $this->SetFont('');
	    $this->SetFont('Times','B',13);
        $this->SetTextColor(0,128,0);
        $this->Cell(78,4,'',0);
	    $this->Cell(15,4,'',0);   
	    $this->SetTextColor(0,0,0);
        $this->Ln();

        $this->SetFont('');
	    $this->SetFont('Times','',10);
	    $this->Cell(20,6,"",0);
        $this->Cell(20,6,"Students Name:- ",0);
	    $this->SetTextColor(0,0,0);
        $this->Cell(60,6,'        '.$student_name,0);
	    $this->Cell(20,6,'Father s Name:-',0);
	    $this->Cell(85,6,'       '.$student_father_name,0);
	
	    $this->SetTextColor(0,0,0);
        $this->Ln();

        $this->SetFont('');
	    $this->SetFont('Times','',10);
	    $this->Cell(20,6,"",0);
        $this->Cell(20,6,"Student Class:-",0);
	    $this->SetTextColor(0,0,0);
        $this->Cell(60,6,'     '.$student_class.' ('.$student_class_section.')',0);
	    $this->Cell(20,6,'Student Roll No:-',0);
	    $this->Cell(85,6,'             '.$school_roll_no,0);

		 $this->Cell(190,10,"",0);
         $this->Ln();	
		
		 $this->SetLeftMargin(15);
		 $this->SetFont('Times','B',10);
		 $this->SetTextColor(0,0,0);
		 $this->Cell(60,8,"SUBJECT NAME",1,0,'C');
		 $this->Cell(30,8,'EXAM DATE',1,0,'C');	
		 $this->Cell(30,8,'DAYS',1,0,'C');	
		 $this->Cell(30,8,'TIME FROM',1,0,'C');
		 $this->Cell(30,8,'TIME TO',1,0,'C');
		 $this->Ln();

$query1="select * from school_info_class_info where class_name='$student_class'";
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$class_code=$row1['class_code'];
}

$admit_card_date_short=$exam_code."_time_date";
$admit_card_date_show=$exam_code."_admit_card_show";
$query="select * from school_info_subject_info where class_code='$class_code' and $admit_card_date_show='Yes' and stream_name='$student_class_stream' and group_name='$student_class_group' and session_value='$session1'$filter37 ORDER by $admit_card_date_short ASC";
$serial_no=0;
$res=mysqli_query($conn73,$query);
$total_subject = mysqli_num_rows($res);
while($row=mysqli_fetch_assoc($res)){
$subject_code=$row['subject_code'];
$subject_name1=$row['subject_name'];
$admit_card_date1=$exam_code."_time_date";
$exam_time_from1=$exam_code."_time_from";
$exam_time_to1=$exam_code."_time_to";
$exam_admit_card_date1=$row[$admit_card_date1];

$exam_admit_card_time_from11= $row[$exam_time_from1];
$exam_admit_card_time_from12 = new DateTime($exam_admit_card_time_from11);
$exam_admit_card_time_from = $exam_admit_card_time_from12->format('h:i a');

$exam_admit_card_time_to11 = $row[$exam_time_to1];
$exam_admit_card_time_to12 = new DateTime($exam_admit_card_time_to11);
$exam_admit_card_time_to = $exam_admit_card_time_to12->format('h:i a');


$exam_admit_card_date2=explode('-',$exam_admit_card_date1);
$exam_admit_card_date=$exam_admit_card_date2[2]."-".$exam_admit_card_date2[1]."-".$exam_admit_card_date2[0];
$serial_no++;


         $this->SetFont('');
		 $this->SetFont('Times','',12);
		 $this->SetTextColor(0,0,0);
$adjust=56/$total_subject;

$date = $exam_admit_card_date;
$days=date("l", strtotime($date));	

		 $this->Cell(60,''.$adjust,''.$subject_name1,1,0,'C');
		 $this->Cell(30,''.$adjust,''.$exam_admit_card_date,1,0,'C');
		 $this->Cell(30,''.$adjust,''.$days,1,0,'C');
		 $this->Cell(30,''.$adjust,''.$exam_admit_card_time_from,1,0,'C');
		 $this->Cell(30,''.$adjust,''.$exam_admit_card_time_to,1,0,'C');
		 $this->Ln();
		 
		 
		 }
	
	$this->Cell(30,14,'',0,0,'C');
	$this->Ln();
	     

		 $this->SetLeftMargin(10);
		 $this->SetFont('Times','B',11);
		 $this->SetTextColor(0,0,0);
		 $this->Cell(5,7,"",0);
		 $this->Cell(40,7,"Exam Controller",0);
		 $this->SetFont('Times','B',11);
		 $this->Cell(100,7,'',0);
		 $this->Cell(30,7,'Principal Signature',0);
		 $this->Ln(-121);
		 
		 $this->SetDrawColor(128,0,0);
		 $this->SetLineWidth(0.75);
         $this->Cell(190,128,"",1);
         $this->Ln();
		 $this->SetDrawColor(0,0,0);
		 $this->SetLineWidth(0.35);
		 
		 $xyz=$serial_no1%2;
		if($xyz==1){
		$this->Cell(190,10,"",0);
		}else{
		$this->Cell(190,0,"",0);
		}
        $this->Ln();
			
if($image_count1==0){

		if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',14,12,21,23);
		}else{
		$this->Image($path1,14,12,21,23,'jpeg');
		}

	    if($school_info_principal_signature==null){
		$this->Image('../../../images/blank_logo.png',174,118,15,15);
		}else{
		$this->Image($principal_signature,174,118,15,15,'jpeg');
		}	
		
		if($school_info_principal_seal==null){
		$this->Image('../../../images/blank_logo.png',100,118,35,18);
		}else{
		if($_SESSION['software_link']=='vidyasagarschoolnaxalbari')    
		$this->Image($principal_seal,90,118,35,18,'jpeg');
		else
		$this->Image($principal_seal,165,118,35,18,'jpeg');
		}
		
		 if($student_photo==null){
		$this->Image('../../../images/blank.jpg',173,12,22,22);
		}else{
		$this->Image($student_image,173,12,22,26,'jpeg');
		}

$image_count1=1;	
}else{

		if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',14,150,21,23);
		}else{
		$this->Image($path1,14,150,21,23,'png');
		}
		
		if($school_info_principal_signature==null){
		$this->Image('../../../images/blank_logo.png',174,256,15,15);
		}else{
		$this->Image($principal_signature,174,256,15,15,'jpeg');
		}	
		
		if($school_info_principal_seal==null){
		$this->Image('../../../images/blank_logo.png',100,256,35,18);
		}else{
		if($_SESSION['software_link']=='vidyasagarschoolnaxalbari')    
		$this->Image($principal_seal,90,256,35,18,'jpeg');
		else
		$this->Image($principal_seal,165,256,35,18,'jpeg');
		}
	     
		if($student_photo==null){
		$this->Image('../../../images/blank.jpg',173,150,22,22);
		}else{
		$this->Image($student_image,173,150,22,26,'jpeg');
		}

         $image_count1=0;		 
         }
	
 	    } 
}
}else{
$query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
        while($row=mysqli_fetch_assoc($run1)){
        $school_info_school_name = $row['school_info_school_name'];
	    $school_info_school_name = strtoupper($school_info_school_name);
$school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
	$principal_signature=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_signature;$principal_signature=str_replace(" ","%20",$principal_signature);
	$principal_seal=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_seal;$principal_seal=str_replace(" ","%20",$principal_seal);
	//$principal_signature="data:image/jpeg;base64,".$school_info_principal_signature;
	//$principal_seal="data:image/jpeg;base64,".$school_info_principal_seal;

}
$student_class=$_POST['student_class'];
$query1="select * from school_info_class_info where class_name='$student_class'";
$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$class_code=$row1['class_code'];
}

$student_class_section=$_POST['student_class_section'];
if($student_class_section==''){
$condition21='';
}else{
$condition21=" and student_class_section='$student_class_section'";
}
$student_class_group=$_POST['student_class_group'];
$student_class_stream=$_POST['student_class_stream'];
$exam_code=$_POST['exam_type'];
$exam_term1=$_POST['exam_term'];	
$session=$_POST['session'];	

$query2="select * from school_info_exam_types where exam_code='$exam_code' and session_value='$session1' and class_code='$class_code'$filter37";
$res2=mysqli_query($conn73,$query2);
while($row2=mysqli_fetch_assoc($res2)){
$exam_type1=$row2['exam_type'];
}

    $que2="select * from student_admission_info where  student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_class='$student_class' and session_value='$session' and student_status='Active'$condition21 ORDER BY school_roll_no ASC";
    $run2=mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
    $serial_no1=0;
    $image_count=0;
    while($row2=mysqli_fetch_assoc($run2)){
	$s_no=$row2['s_no'];
    $student_name = $row2['student_name'];
	$student_father_name = $row2['student_father_name'];
	$student_class = $row2['student_class'];
	$student_roll_no = $row2['student_roll_no'];
	$school_roll_no = $row2['school_roll_no'];
    $student_id_generate=$row2['student_id_generate'];

$student_photo=$row2['student_image_name'];
$student_image=$_SESSION['amazon_file_path']."student_documents/".$student_photo;$student_image=str_replace(" ","%20",$student_image);
	
		
	$serial_no1++;
	$image_count++; 

         $this->Cell(190,1,"",0);
         $this->Ln();

		 $this->SetFont('Times','B',16);
		 $this->SetTextColor(180,0,0);
		 $this->Cell(190,10,''.$school_info_school_name,0,0,'C');
		 $this->Ln();
 
		 if($session=='2017_18'){
		 $session_value='2017-18';
		 }elseif($session=='2018_19'){
		 $session_value='2018-19';
		 }elseif($session=='2019_20'){
		 $session_value='2019-20';
		 }
		 
		 $this->SetFont('Times','B',13);
		 $this->SetTextColor(0,128,0);
		 $this->Cell(190,5,"$exam_type1 $session_value
		 ",0,0,'C');
		 $this->Ln();
		 
		 
		 $this->Cell(190,3,"",0);
         $this->Ln();
		 
		 $this->SetFont('Times','B',13);
		 $this->SetTextColor(0,128,0);
		 if($exam_term1=='term1'){
		 $this->Cell(190,4,'ADMIT CARD'.' ( Term 1 )',0,0,'C');
		 }elseif($exam_term1=='term2'){
		 $this->Cell(190,4,'ADMIT CARD'.' ( Term 2 )',0,0,'C');
		 }elseif($exam_term1=='term3'){
		 $this->Cell(190,4,'ADMIT CARD'.' ( Term 3 )',0,0,'C');
		 }else{
		  $this->Cell(190,4,'ADMIT CARD',0,0,'C');
		 }
		 $this->Ln();	

        $this->SetFont('');
	    $this->SetFont('Times','B',13);
        $this->SetTextColor(0,128,0);
        $this->Cell(78,4,'',0);
	    $this->Cell(15,4,'',0);   
	    $this->SetTextColor(0,0,0);
        $this->Ln();

        $this->SetFont('');
	    $this->SetFont('Times','',10);
	    $this->Cell(20,6,"",0);
        $this->Cell(20,6,"Students Name:- ",0);
	    $this->SetTextColor(0,0,0);
        $this->Cell(60,6,'        '.$student_name,0);
	    $this->Cell(20,6,'Father s Name:-',0);
	    $this->Cell(85,6,'       '.$student_father_name,0);
	
	    $this->SetTextColor(0,0,0);
        $this->Ln();

    

        $this->SetFont('');
	    $this->SetFont('Times','',10);
	    $this->Cell(20,6,"",0);
        $this->Cell(20,6,"Student Class:-",0);
	    $this->SetTextColor(0,0,0);
        $this->Cell(60,6,'     '.$student_class.' ('.$student_class_section.')',0);
	    $this->Cell(20,6,'Student Roll No:-',0);
	    $this->Cell(85,6,'             '.$school_roll_no,0);

		 $this->Cell(190,10,"",0);
         $this->Ln();	
		
		 $this->SetLeftMargin(15);
		 $this->SetFont('Times','B',10);
		 $this->SetTextColor(0,0,0);
    	 $this->Cell(60,8,"SUBJECT NAME",1,0,'C');
		 $this->Cell(30,8,'EXAM DATE',1,0,'C');	
		 $this->Cell(30,8,'DAYS',1,0,'C');	
		 $this->Cell(30,8,'TIME FROM',1,0,'C');
		 $this->Cell(30,8,'TIME TO',1,0,'C');
		 $this->Ln();

$query1="select * from school_info_class_info where class_name='$student_class'";

$res1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($res1)){
$class_code=$row1['class_code'];
}

$admit_card_date_short=$exam_code."_time_date";
$admit_card_date_show=$exam_code."_admit_card_show";
$query="select * from school_info_subject_info where class_code='$class_code' and $admit_card_date_show='Yes' and stream_name='$student_class_stream' and session_value='$session1'$filter37 and group_name='$student_class_group' ORDER by $admit_card_date_short ASC";
$serial_no=0;
$res=mysqli_query($conn73,$query);
$total_subject = mysqli_num_rows($res);
while($row=mysqli_fetch_assoc($res)){
$subject_code=$row['subject_code'];
$subject_name1=$row['subject_name'];
$admit_card_date1=$exam_code."_time_date";
$exam_time_from1=$exam_code."_time_from";
$exam_time_to1=$exam_code."_time_to";
$exam_admit_card_date1=$row[$admit_card_date1];
$exam_admit_card_date2=explode('-',$exam_admit_card_date1);
$exam_admit_card_date=$exam_admit_card_date2[2]."-".$exam_admit_card_date2[1]."-".$exam_admit_card_date2[0];
$exam_admit_card_time_from11= $row[$exam_time_from1];
$exam_admit_card_time_from12 = new DateTime($exam_admit_card_time_from11);
$exam_admit_card_time_from = $exam_admit_card_time_from12->format('h:i a');
$exam_admit_card_time_to11 = $row[$exam_time_to1];
$exam_admit_card_time_to12 = new DateTime($exam_admit_card_time_to11);
$exam_admit_card_time_to = $exam_admit_card_time_to12->format('h:i a');

$serial_no++;

         $this->SetFont('');
		 $this->SetFont('Times','',12);
		 $this->SetTextColor(0,0,0);

$adjust=56/$total_subject;

$date = $exam_admit_card_date;
$days=date("l", strtotime($date));	

		 $this->Cell(60,''.$adjust,''.$subject_name1,1,0,'C');
		 $this->Cell(30,''.$adjust,''.$exam_admit_card_date,1,0,'C');
		 $this->Cell(30,''.$adjust,''.$days,1,0,'C');
		 $this->Cell(30,''.$adjust,''.$exam_admit_card_time_from,1,0,'C');
		 $this->Cell(30,''.$adjust,''.$exam_admit_card_time_to,1,0,'C');
		 $this->Ln();

         }

	    $this->Cell(30,14,'',0,0,'C');
		$this->Ln();

		 $this->SetLeftMargin(10);
		 $this->SetFont('Times','B',11);
		 $this->SetTextColor(0,0,0);
		 $this->Cell(5,7,"",0);
		 $this->Cell(40,7,"Exam Controller",0);
		 $this->SetFont('Times','B',11);
		 $this->Cell(100,7,'',0);
		 $this->Cell(30,7,'Principal Signature',0);
		 $this->Ln(-121);
		 
		 $this->SetDrawColor(128,0,0);
		 $this->SetLineWidth(0.75);
         $this->Cell(190,128,"",1);
         $this->Ln();
		 $this->SetDrawColor(0,0,0);
		 $this->SetLineWidth(0.35);
		 
		$xyz=$serial_no1%2;
		if($xyz==1){
		$this->Cell(190,10,"",0);
		}else{
		$this->Cell(190,0,"",0);
		}
        $this->Ln();
			
if($image_count==1){

		if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',14,12,21,23);
		}else{
		$this->Image($path1,14,12,21,23,'jpeg');
		}
    
//     	if($school_info_principal_signature==null){
// 		$this->Image('../../../images/blank_logo.png',174,118,15,15);
// 		}else{
// 		$this->Image($principal_signature,174,118,15,15,'jpeg');
// 		}	
		
// 		if($school_info_principal_seal==null){
// 		$this->Image('../../../images/blank_logo.png',100,118,35,19);
// 		}else{
// 		$this->Image($principal_seal,100,118,35,19,'jpeg');
// 		}
	     
		 if($student_photo==null){
		$this->Image('../../../images/blank.jpg',173,12,22,22);
		}else{
		$this->Image($student_image,173,12,22,26,'jpeg');
		}
		 
}else{
         //$this->Image('logo.png',16,150,18);
		 //$this->Image('blank.jpg',173,150,22,22);

		if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',14,150,21,23);
		}else{
		$this->Image($path1,14,150,21,23,'jpeg');
		}
	     	
// 	    if($school_info_principal_signature==null){
// 		$this->Image('../../../images/blank_logo.png',174,256,15,15);
// 		}else{
// 		$this->Image($principal_signature,174,256,15,15,'jpeg');
// 		}	
		
// 		if($school_info_principal_seal==null){
// 		$this->Image('../../../images/blank_logo.png',100,256,35,19);
// 		}else{
// 		$this->Image($principal_seal,100,256,35,19,'jpeg');
// 		}
		
		 if($student_photo==null){
		$this->Image('../../../images/blank.jpg',173,150,22,22);
		}else{
		$this->Image($student_image,173,150,22,26,'jpeg');
		}
		 $image_count=0;
		 
}
		
} 
   
}		 

}

function sign($s1, $s2){

	    $this->Cell(90,6,$s1,'',0,'L',false);
        $this->Cell(90,6,$s2,'',0,'R',false);
		$this->Ln();
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Table1();
$pdf->Ln();
		
$class_name=$_POST['student_class1'];
$exam_type1=$_POST['exam_type1'];	
$file_name="admit_cards_".$exam_type1."_".$class_name.".pdf";
$pdf->Output('I',$file_name);
?>