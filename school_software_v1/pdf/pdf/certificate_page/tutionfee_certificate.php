<?php include("../../../admin/attachment/session.php");

$s_no=$_GET['id'];
$query="select * from tutionfee_certificate where s_no='$s_no'";
$run=mysqli_query($conn73,$query) or die(mysql_error());
while($row=mysqli_fetch_assoc($run)){
$tutionfee_student_name = $row['tutionfee_student_name'];
$tutionfee_student_father_name = $row['tutionfee_student_father_name'];
$tutionfee_school_name = $row['tutionfee_school_name'];
$tutionfee_current_year_from = $row['tutionfee_current_year_from'];
$tutionfee_current_year_to = $row['tutionfee_current_year_to'];
$tutionfee_type = $row['tutionfee_type'];
$tutionfee_issue_date = $row['tutionfee_issue_date'];
$tutionfee_student_roll_no = $row['tutionfee_student_roll_no'];

}
$query1="select * from student_admission_info where student_roll_no='$tutionfee_student_roll_no' and session_value='$session1'";
$run1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($run1)){
$student_mother_name =$row1['student_mother_name'];
$student_admission_number =$row1['student_admission_number'];
$student_class =$row1['student_class'];
$student_date_of_admission =$row1['student_date_of_admission'];
}
$query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysql_error());
        while($row=mysqli_fetch_assoc($run1)){
        $school_info_school_name = $row['school_info_school_name'];
        $school_info_logo = $row['school_info_logo_name'];
        $school_info_school_district = $row['school_info_school_district'];
        $school_info_school_contact_no = $row['school_info_school_contact_no'];
        $school_info_school_email_id = $row['school_info_school_email_id'];
        $school_info_school_website = $row['school_info_school_website'];
        $school_info_school_address=$row['school_info_school_address'];
$school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
}  

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

global $school_info_school_address,$tutionfee_student_name,$student_date_of_admission,$student_class,$student_admission_number,$student_mother_name,$school_info_school_contact_no,$school_info_school_website,$school_info_school_email_id,$tutionfee_student_father_name,$bonafied_school_name,$tutionfee_current_year_from,$tutionfee_current_year_to,$tutionfee_type,$tutionfee_issue_date,$tutionfee_school_name,$tutionfee_student_roll_no,$school_info_school_name,$school_info_logo,$path1;
   

 
    $this->Image('../certificate_image/tutionfee.jpg',1,1,207,295);

	$this->SetXY(10,25);
    $this->SetFont('Times','B',25);
	$this->SetTextColor(135,109,52);
    $this->Cell(190,8,''.strtoupper($school_info_school_name),0,0,'C');
    $this->Ln(); 
   
    $this->SetXY(10,33);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(135,109,52);
    $this->Cell(190,6,''.$school_info_school_address,0,0,'C');
    $this->Ln();

	$this->SetXY(10,38);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(135,109,52);
    $this->Cell(190,7,'Contact No. :'.$school_info_school_contact_no,0,0,'C');
    $this->Ln();	
	
	$this->SetXY(10,42);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(135,109,52);
    //$this->Cell(106,9,'Website :'.$school_info_school_website,0,0,'R');
    $this->Cell(190,9,'Email :'.$school_info_school_email_id,0,0,'C');
    $this->Ln();
   
	$this->SetXY(90,113);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(76,0,153);
    $this->Cell(89,6,$tutionfee_student_name,0,0,'C');
    $this->Ln(); 
	
	$this->SetXY(35,122);
	$this->SetFont('Times','B',12);
	$this->SetTextColor(76,0,153);
    $this->Cell(65,6,$tutionfee_student_father_name,0,0,'C');
    $this->Ln(); 
    
    $this->SetXY(131,122);
	$this->SetFont('Times','B',12);
	$this->SetTextColor(76,0,153);
    $this->Cell(75,6,$student_mother_name,0,0,'C');
    $this->Ln(); 

	$this->SetXY(85,131);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(76,0,153);
    $this->Cell(120,6,$tutionfee_school_name,0,0,'C');
    $this->Ln(); 	
    
    $this->SetXY(164,140);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(76,0,153);
    $this->Cell(35,6,$student_class,0,0,'C');
    $this->Ln(); 
    
    $this->SetXY(82,150);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(76,0,153);
    $this->Cell(23,6,$student_admission_number,0,0,'C');
    $this->Ln(); 
  
	$this->SetXY(105,167);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(76,0,153);
    $this->Cell(60,6,$tutionfee_current_year_from.'-'.$tutionfee_current_year_to,0,0,'C');
    $this->Ln();

    $this->SetXY(30,158);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(76,0,153);
    $this->Cell(40,6,$tutionfee_type,0,0,'C');
    $this->Ln();

    $this->SetXY(1,178);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(76,0,153);
    $this->Cell(40,6,$student_date_of_admission,0,0,'C');
    $this->Ln();

	if($school_info_logo==null){
	$this->Image('../../../images/blank_logo.png',15,14,22,23);
	}
	else{
	$this->Image($path1,88,60,35,35,'jpeg');
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

	
$file_name="character_certificate_".$character_student_name.".pdf";
$pdf->Output('I',$file_name);
?>