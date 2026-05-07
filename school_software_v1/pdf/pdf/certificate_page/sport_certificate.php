<?php include("../../../admin/attachment/session.php");
 
$s_no=$_GET['id'];


$query="select * from sport_certificate where s_no='$s_no'";

$run=mysqli_query($conn73,$query) or die(mysql_error());

while($row=mysqli_fetch_assoc($run)){

$sport_student_name = $row['sport_student_name'];
$sport_type = $row['sport_type'];
$sport_organized_date = $row['sport_organized_date'];
$sport_rank = $row['sport_rank'];

}
$query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysql_error());
        while($row=mysqli_fetch_assoc($run1)){
        $school_info_school_name = $row['school_info_school_name'];
$school_info_logo=$row1['school_info_logo_name'];
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

global $sport_student_name,$sport_type,$sport_organized_date,$sport_rank,$school_info_school_name,$school_info_logo,$path1;
   

    $this->Image('../certificate_image/sport_certificate.jpg',1,1,295,208);
	
	$this->SetXY(10,22);
    $this->SetFont('Times','B',30);
	$this->SetTextColor(255,0,0);
    $this->Cell(277,6,''.strtoupper($school_info_school_name),0,0,'C');
    $this->Ln(); 
   
    $this->SetXY(14,45);
    $this->SetFont('Times','B',28);
    $this->SetTextColor(255,128,0);
    $this->Cell(272,5,"SPORT CERTIFICATE",0,0,'C');
    $this->Ln();
   
	$this->SetXY(118,75);
    $this->SetFont('Times','B',19);
	$this->SetTextColor(76,0,153);
    $this->Cell(152,6,$sport_student_name,0,0,'C');
    $this->Ln(); 
	
	$this->SetXY(25,113.7);
	
    $this->SetFont('Times','B',19);
	$this->SetTextColor(76,0,153);
    $this->Cell(246,6,$sport_type,0,0,'C');
    $this->Ln(); 
  
	$this->SetXY(75,133.5);
    $this->SetFont('Times','B',19);
	$this->SetTextColor(76,0,153);
    $this->Cell(100,6,$sport_organized_date,0,0,'C');
    $this->Ln(); 
  
	$this->SetXY(198,133.5);
    $this->SetFont('Times','B',19);
	$this->SetTextColor(76,0,153);
    $this->Cell(49,6,$sport_rank,0,0,'C');
    $this->Ln(); 
    
    
//     if($school_info_logo==null){
// 	$this->Image('../../../images/blank_logo.png',142,30,20,20);
// 	}
// 	else{
// 	$this->Image($path1,142,30,20,20,'jpeg');
// 	}
    
  
	
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

$file_name="sport_certificate_".$sport_student_name.".pdf";
$pdf->Output('I',$file_name);
?>