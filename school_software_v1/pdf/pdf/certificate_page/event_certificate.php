<?php include("../../../admin/attachment/session.php");
 
$s_no=$_GET['id'];
$session_value=$_GET['session'];


$query="select * from event_certificate where s_no='$s_no'";

$run=mysqli_query($conn73,$query) or die(mysql_error());

while($row=mysqli_fetch_assoc($run)){

    $event_student_name = $row['event_student_name'];

    $event_student_class = $row['event_student_class'];
    $event_student_section = $row['event_student_section'];
   
	$event_type = $row['event_type'];
	$event_organized_date = $row['event_organized_date'];
	$event_rank = $row['event_rank'];
    $event_student_roll_no=$row['event_student_roll_no'];
	
	
}
 $query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysql_error());
        while($row=mysqli_fetch_assoc($run1)){
      
            
        $school_info_school_name = $row['school_info_school_name'];
        $defalut_session_value = $row['defalut_session_value'];
        $school_info_registration_code=$row['school_info_registration_code'];
        $school_info_school_address=$row['school_info_school_address'];
        $school_info_school_city=$row['school_info_school_city'];
        $school_info_school_district=$row['school_info_school_district'];
$school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
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
   
}
	

function Table1()
{

global $school_info_school_address,$school_info_school_city,$school_info_school_district,$event_student_name,$event_student_class,$school_info_registration_code,$event_student_section,$event_type,$event_organized_date,$event_rank,$school_info_school_name,$path1,$school_info_logo,$session_value,$defalut_session_value,$logo_image;

    $this->Image('../certificate_image/sport_certificate3216.jpg',1,1,295,208);
    //$this->Image('../marksheet_image/Bemetara_watermark_img.jpeg',38,100,150,150);
	$this->SetXY(10,20);
    $this->SetFont('Times','B',25);
	$this->SetTextColor(255,0,0);
    $this->Cell(277,0,''.strtoupper($school_info_school_name),0,0,'C');
    $this->Ln(2); 
    
    // $this->SetXY(14,50);
    // $this->SetFont('Times','B',14);
    // $this->SetTextColor(255,128,0);
    // $this->Cell(272,10,"$school_info_school_city $school_info_school_district",0,0,'C');
    // $this->Ln();

  if ($session_value=='2017_18') {
    $session_value1='2017-18';
    
  }
  elseif ($session_value=='2018_19') {
    $session_value1='2018-19';
    
  }
  elseif ($session_value=='2019_20') {
    $session_value1='2019-20';
    
  }
  elseif ($session_value=='2020_21') {
    $session_value1='2020-21';  
  }
   elseif ($session_value=='2021_22') {
    $session_value1='2021-22';  
  }
  else
  {
    $session_value1="";
  }

    $this->SetXY(14,24);
    $this->SetFont('Times','B',13);
    $this->SetTextColor(255,128,0);
    $this->Cell(272,5,"",0,0,'C');
    $this->Ln(10);

   // $this->Image('../certificate_image/Capture.PNG',94,48,110,15);
    
    $this->SetXY(14,50);
    $this->SetFont('Times','B',22);
    $this->SetTextColor(255,128,0);
    $this->Cell(272,8,"EVENT CERTIFICATE",0,0,'C');
    $this->Ln(10);
    
    
    // $this->SetXY(14,63);
    $this->SetFont('Times','B',18);
    $this->SetTextColor(76,0,153);
    $this->Cell(272,5,"     Academic Session ".str_replace("_","-",$session_value),0,0,'C');
    $this->Ln(10);

	$this->SetXY(118,75);
    $this->SetFont('Times','B',19);
	$this->SetTextColor(76,0,153);
    $this->Cell(152,6,"$event_student_name.   ($event_student_class)",0,0,'C');
    $this->Ln();


	$this->SetXY(25,113.2);
	
    $this->SetFont('Times','B',19);
	$this->SetTextColor(76,0,153);
    $this->Cell(246,6,$event_type,0,0,'C');
    $this->Ln(); 
  
	$this->SetXY(75,133.5);
    $this->SetFont('Times','B',19);
	$this->SetTextColor(76,0,153);
    $this->Cell(100,6,$event_organized_date,0,0,'C');
    $this->Ln(); 
  
  	$this->SetXY(198,133.5);
    $this->SetFont('Times','B',19);
	$this->SetTextColor(76,0,153);
    $this->Cell(49,6,$event_rank,0,0,'C');
    $this->Ln(); 
    
	$this->SetXY(120,172);
    $this->SetFont('Times','B',17);
	$this->SetTextColor(0,0,128);
    // $this->Cell(49,6,'Director Sign.',0,0,'C');
    $this->Ln(); 
    
    $this->SetXY(23,172);
    $this->SetFont('Times','B',17);
	$this->SetTextColor(0,0,128);
    // $this->Cell(49,6,'Class Teacher Sign.',0,0,'C');
    $this->Ln();
    
    $this->SetXY(220,172);
    $this->SetFont('Times','B',17);
	$this->SetTextColor(0,0,128);
    $this->Cell(49,6,'Principal Sign.',0,0,'C');
    $this->Ln();
    
	if($school_info_logo==null){
	$this->Image('../../../images/blank_logo.png',142,30,20,20);
	}
	else{
	$this->Image($path1,142,30,20,20,'jpeg');
	}
  	
   
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
 
  

 

	   
	//  $pdf->SetLeftMargin(30);
		$pdf->Table1();
		$pdf->Ln(0);
		
		
		
		
	//	$pdf->SetLeftMargin(-30);

	

$file_name="event_certificate_".$event_student_name.".pdf";
$pdf->Output('I',$file_name);
?>