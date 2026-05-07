<?php
include("../../../admin/attachment/session.php");
$que="select * from  school_info_general";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){

	$school_info_school_name = $row['school_info_school_name'];
	$school_info_school_contact_no = $row['school_info_school_contact_no'];
	$school_info_school_address = $row['school_info_school_address'];
	$school_info_school_code = $row['school_info_school_code'];
}

$query121="select * from school_info_general";
$run121=mysqli_query($conn73,$query121) or die(mysqli_error($conn73));
while($row121=mysqli_fetch_assoc($run121)){
 	$school_info_principal_seal=$row121['school_info_principal_seal_name'];
	$school_info_principal_signature=$row121['school_info_principal_signature_name'];
	$school_info_logo=$row121['school_info_logo_name'];
$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
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
    
}

// Page footer
function Footer()
{
    
	     
	
	
}

function Table1()
{ 

global $conn73,$session1,$school_info_school_name,$school_info_school_contact_no,$school_info_logo,$student_name,$student_class,$student_roll_no,$student_date_of_birth,$student_father_contact_number,$student_photo,$student_image,$roll_no,$school_roll_no,$school_info_school_code,$student_gender,$school_info_school_address,$path1;

    $school_info_school_name=strtoupper($school_info_school_name);
	$c1=explode(' ',$school_info_school_name);
	$c2=count($c1);
	$x=0;
	$y=0;
	$y1=0;
	$x1=0;
	$x2=0;
	 $school_info_school_name_1= "";
	$school_info_school_name_2= "";
	$school_info_school_name_3= "";
	for($z=0;$z<$c2;$z++){
	 $x=strlen($c1[$z]);
	$y=$y+$x;
	if($y>15){
	if($x1==0){
	$y1='16';
	$x1++;
	}
	}
	if($y>31){
    if($x2==0){
	$y1='32';
	$x2++;
	}
	}
	$y1=$y1+$x;

	$y=$y1;
	if($y1<33){
	$school_info_school_name_1=$school_info_school_name_1.' '.$c1[$z];
	}elseif($y1<43){
	$school_info_school_name_2=$school_info_school_name_2.' '.$c1[$z];
	}else{
	$school_info_school_name_3=$school_info_school_name_3.' '.$c1[$z];
	}
	}

$height=0;
$height1=62;
$width=0;
$width1=95;
$horizontal=0;
$vertical=0;


$roll_no=$_POST['school_id_card_info'];
$count=count($roll_no);
for($j=0;$j<$count;$j++){
$que1="select * from student_admission_info where student_roll_no='$roll_no[$j]' and session_value='$session1'and session_value='$session1'";
    $student_photo='';
$run1=mysqli_query($conn73,$que1);
while($row1=mysqli_fetch_assoc($run1)){
   
	$student_name=$row1['student_name'];
	$student_father_name=$row1['student_father_name'];
	$student_mother_name=$row1['student_mother_name'];
	$student_class=$row1['student_class'];
	$student_roll_no=$row1['student_roll_no'];
	$student_class_section=$row1['student_class_section'];
	$student_scholar_number=$row1['student_scholar_number'];
	$school_roll_no=$row1['school_roll_no'];
	$student_guardian_name=$row1['student_guardian_name'];
	$student_gender=$row1['student_gender'];
	$student_date_of_birth1=$row1['student_date_of_birth'];
	if($student_date_of_birth1!=''){
	$student_date_of_birth2=explode("-",$student_date_of_birth1);
	$student_date_of_birth=$student_date_of_birth2[2]."-".$student_date_of_birth2[1]."-".$student_date_of_birth2[0];
	}else{
	$student_date_of_birth='';
	}
	$student_father_contact_number=$row1['student_father_contact_number'];
    $student_id_generate=$row1['student_id_generate'];
	
}
$que1="select * from student_admission_info where student_roll_no='$roll_no[$j]' and session_value='$session1'";
    $run1=mysqli_query($conn73,$que1);
    $student_photo='';
    $student_guardian_photo='';
    while($row1=mysqli_fetch_assoc($run1)){
	 $student_photo=$row1['student_image_name'];
	 $student_father_photo=$row1['student_father_image_name'];
  $student_photo1=$_SESSION['amazon_file_path']."student_documents/".$student_photo;$student_photo1=str_replace(" ","%20",$student_photo1);
	 $student_father_photo1=$_SESSION['amazon_file_path']."student_documents/".$student_father_photo;$student_father_photo1=str_replace(" ","%20",$student_father_photo1);
}
if($horizontal>2 && $vertical>1){
    $horizontal=0;
    $vertical=0;

	$this->Ln();
	
	$this->Cell(-195,0,'',0,0,'C');
}
  if($horizontal>2)
  {
  $horizontal=0;
  $vertical++;
  $this->Cell(-195,0,'',0,0,'C');
  }
  $height=$height1*$vertical;
  $width=$width1*$horizontal;
  
  
// 	$this->Image('ksok1s.jpg',10+$width,9+$height,80,53);
	$this->Image('../id_card_image/id_card_background_header_1.png',10+$width,9+$height,80,13.5);
		
		if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',10+$width,10+$height,11,12);
		}else{
		$this->Image($path1,10+$width,9+$height,11,13,'jpeg');
		}
		
		if($student_photo==null){
		$this->Image('../../../images/blank.jpg',10+$width,23+$height,14.6,14.6);
		}else{
		$this->Image($student_photo1,10+$width,23+$height,14.6,14.6,'jpeg');
		}	
		
		if($student_father_photo==null){
		$this->Image('../../../images/blank.jpg',75+$width,23+$height,14.6,14.6);
		}else{
		$this->Image($student_father_photo1,75+$width,23+$height,14.6,14.6,'jpeg');
		}
		
	$this->Image('../id_card_image/id_card_background_footer_1.png',10+$width,46+$height,80,16);	

if($horizontal>0)
  {
  $this->Ln(-62);
  $this->SetLeftMargin(10+$width);  
  }

        $this->SetLeftMargin(10+$width);
        $this->SetFont('Times','B',9);
		$this->SetTextColor(3,3,3);
		$this->Cell(12,5,'',0,0,'C');
		$this->Cell(68,5,''.$school_info_school_name_1,0,0,'C');
		$this->Ln();
		
		$this->SetFont('Times','B',9);
		$this->SetTextColor(3,3,3);
		$this->Cell(12,4,'',0,0,'C');
		$this->Cell(68,4,''.$school_info_school_name_2,0,0,'C');
		$this->Ln();
		
		$this->SetFont('Times','B',9);
		$this->SetTextColor(3,3,3);
		$this->Cell(12,4,'',0,0,'C');
		$this->Cell(68,4,'School Code: '.$school_info_school_code,0,0,'R');
		$this->Ln();
	
	
		//--------------------------------------------
		$this->Cell(52,0,'',0,0,'C');
		$this->Ln();
		//--------------------------------------------
		
		// image border code
		$this->SetLineWidth(0.25);
		$this->SetDrawColor(3,3,3);
		$this->Cell(15,15,'',1,0,'C');
		$this->Cell(50,15,'Father ID Card',1,0,'C');
		$this->Cell(15,15,'',1,0,'C');
		$this->Ln();
		//--------------------------------------------
		$this->Cell(52,0,'',0,0,'C');
		$this->Ln();
		//--------------------------------------------
		
		$this->SetFont('Times','B',9);
		$this->SetTextColor(3,3,3);
		$this->Cell(40,4,''.$student_name,1,0,'L');
		$this->Cell(40,4,'Class:'.$student_class."  [$student_class_section]",1,0,'R');
		$this->Ln();
		//--------------------------------------------
		$this->SetFont('Times','B',9);
		$this->SetTextColor(3,3,3);
		$this->Cell(40,4,'Fn :',0,0,'L');
		$this->Cell(40,4,''.$student_father_name,0,0,'R');
		$this->Ln();
		//--------------------------------------------
		$this->SetFont('Times','B',9);
		$this->SetTextColor(3,3,3);
		$this->Cell(40,4,'Carrying Prsn',0,0,'L');
		$this->Cell(40,4,''.$student_father_name,0,0,'R');
		$this->Ln();
		//--------------------------------------------
	
		//--------------------------------------------
		
		//--------------------------------------------
		$this->SetFont('Times','B',9);
		$this->SetTextColor(3,3,3);
		$this->Cell(40,4,'Mobile',1,0,'L');
		$this->Cell(40,4,''.$student_father_contact_number,1,0,'R');
		$this->Ln();
		
		$this->SetFont('Times','B',9);
		$this->SetTextColor(3,3,3);
		$this->Cell(70,5,'Principal',0,0,'R');
		$this->Ln();
		//--------------------------------------------
		$this->Cell(24,2,'',0,0,'L');
		$this->Ln();
		//--------------------------------------------
		
		$this->Ln(-75);
		
		$this->Cell(24,23,'',0,0,'L');
		$this->Ln();
		
		$this->SetLineWidth(0.35);
		$this->SetDrawColor(3,3,3);
		$this->Cell(80,53,'',1,0,'C');
	    $this->Ln();
		$horizontal++;
		
			if($horizontal>2)
          {
            // $this->Cell(80,10,'',1,0,'C');
	         //$this->Ln();
			   $this->Ln(10);	
          }else{
           $this->Ln(10);	
          }
		
	}    //---------------------------------------------------------------------------------------------------
		
	  
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
$pdf->SetFont('Times','',14);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
	
	//  $pdf->SetLeftMargin(30);
	    $pdf->Ln();
		$pdf->Table1();
	
$file_name="id_cards_".$student_class.".pdf";
$pdf->Output('I',$file_name);
?>