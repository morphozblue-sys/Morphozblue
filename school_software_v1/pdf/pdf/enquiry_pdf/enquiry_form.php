<?php
include("../../../admin/attachment/session.php");
$s_no=$_GET['s_no'];



$query12="select * from school_info_general";
$run12=mysqli_query($conn73,$query12) or die(mysqli_error($conn73));
while($row12=mysqli_fetch_assoc($run12)){
    $school_info_school_name=$row12['school_info_school_name'];
	$school_info_school_state=$row12['school_info_school_state'];
	$school_info_school_district=$row12['school_info_school_district'];
	$school_info_school_city=$row12['school_info_school_city'];
	$school_info_school_pincode=$row12['school_info_school_pincode'];
	$school_info_school_address=$row12['school_info_school_address'];
	$school_info_school_contact_no=$row12['school_info_school_contact_no'];
	$school_info_school_email_id=$row12['school_info_school_email_id'];
	$school_info_school_website=$row12['school_info_school_website'];
	$school_info_dise_code=$row12['school_info_dise_code'];
	$school_info_school_code=$row12['school_info_school_code'];
	$school_info_registration_code=$row12['school_info_registration_code'];
	$school_info_medium=$row12['school_info_medium'];

} 

$query121="select * from school_info_general";
$run121=mysqli_query($conn73,$query121) or die(mysqli_error($conn73));
while($row121=mysqli_fetch_assoc($run121)){
 	$school_info_principal_seal=$row121['school_info_principal_seal_name'];
	$school_info_principal_signature=$row121['school_info_principal_signature_name'];
	$school_info_logo=$row121['school_info_logo_name'];
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
  //  $this->Cell(0,6,'GROWIDE PORT FOLIO MANAGEMENT LIMITED',0,1,'C');
	$this->Ln(1);
	 $this->SetFont('Arial','B',10);
//	$this->Cell(0,6,'316, 3th Floor, ORBIT MALL, NEAR MALHAR MALL, A.B. ROAD, INDORE-425010 ',0,1,'C');
	
    // Line break
    $this->Ln(2);
	
	global $school_info_school_name,$school_info_school_state,$school_info_school_district,$school_info_school_city,$school_info_school_pincode,$school_info_school_address,$school_info_school_contact_no,$school_info_dise_code,$school_info_school_code,$school_info_registration_code,$school_info_principal_seal,$school_info_principal_signature,$school_info_logo,$school_info_school_email_id,$school_info_school_website,$path1;

		if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',15,14,22,23);
		}else{
		$this->Image($path1,15,14,22,23,'png');
		}
	
	$this->SetFont('Times','B',19);
	$this->SetTextColor(180,0,0);
	$this->Cell(35,10.5,'',0);
    $this->Cell(150,10.5,''.$school_info_school_name,0,0,'C');
	$this->SetTextColor(255,0,0);
    $this->Ln();  
	
	
	$this->SetFont('Times','B',10);
	$this->SetTextColor(0,0,0); 
    $this->Cell(35,6,"",0,'C');
	$this->Cell(150,6,"".$school_info_school_address,0,0,'C');
	$this->SetTextColor(0,0,0);  
	$this->Ln(); 
	
	$this->Cell(100,1,"",0,'C'); 
	$this->Ln(); 
    $this->SetFont('Times','',11);
	$this->SetTextColor(0,0,0); 
    $this->Cell(35,6,"",0);
	$this->Cell(150,6,"Email :  ".$school_info_school_email_id.''.'           Web : '.$school_info_school_website,0,0,'C');
	$this->SetTextColor(0,0,0);  
	$this->Ln(); 
	
	
	
    $this->Cell(200,4,"",0); 	
	$this->Ln();
   
    $this->Cell(10,5,"",0); 
    $this->Cell(170,0.10,"",1); 	
	$this->Ln();
	
}

// Page footer
function Footer()
{

    $this->SetXY(10,10);
	$this->Cell(190,277,'',1);
	
	$this->SetXY(10,280);
	$this->Cell(10,5,'',0);
	$this->Cell(60,5,' Signature of Students / Parents',0);
	$this->Cell(70,5,'',0);
	$this->Cell(40,5,'Principal Seal & Sign',0);
	
	
//   $this->SetXY(177,87);
//   $this->Cell(20,26,'',1);
	
}
function Table2()
{
global $conn73,$session1,$filter37,$school_info_school_code,$school_info_dise_code,$school_info_registration_code;

$s_no=$_GET['s_no'];
$que="select * from enquiry_info where session_value='$session1' and s_no='$s_no'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
$s_no=$row['s_no'];
$enquiry_type = $row['enquiry_type'];
$enquiry_name = $row['enquiry_name'];
$student_class = $row['blank_field_1'];
$enquiry_father_name = $row['enquiry_father_name'];
$student_medium = $row['student_medium'];
$enquiry_date1 = $row['enquiry_date'];
$enquiry_contact_no_1 = $row['enquiry_contact_no_1'];
$enquiry_contact_no_2 = $row['enquiry_contact_no_2'];
$enquiry_address = $row['enquiry_address'];
$enquiry_next_follow_up_date = $row['enquiry_next_follow_up_date'];

// if($row['enquiry_next_follow_up_date']!='0000-00-00' && $row['enquiry_next_follow_up_date']!=''){
// $enquiry_next_follow_up_date=date('d-m-Y',strtotime($row['enquiry_next_follow_up_date']));
// }else{
// $enquiry_next_follow_up_date=$row['enquiry_next_follow_up_date'];
// }

$enquiry_remark_1 = $row['enquiry_remark_1'];
$enquiry_remark_2 = $row['enquiry_remark_2'];
$enquiry_date = date('d-m-Y',strtotime($enquiry_date1));
$update_change=$row['update_change'];
if($row['last_updated_date']!='0000-00-00'){
$last_updated_date=date('d-m-Y',strtotime($row['last_updated_date']));
}else{
$last_updated_date=$row['last_updated_date'];
}
$serial_no++;
}

if($enquiry_contact_no_2!=''){
$enquiry_contact_no_info=$enquiry_contact_no_1.', '.$enquiry_contact_no_2;
}else{
$enquiry_contact_no_info=$enquiry_contact_no_1;
}

	    $this->Cell(50,5,"",0);
		$this->Ln();

		$this->SetTextColor(0,0,0);
		$this->Cell(2,5,'',0);
        $this->Cell(42,5,'',0);
		$this->SetFont('Times','b',16);
		$this->Cell(81,5,'                    ENQUIRY FORM',0);
        $this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->Cell(2,0,'',0);
        $this->Cell(68,0,'',0);
		$this->SetFont('Times','b',16);
		$this->Cell(52,0.08,'',1);
        $this->Cell(50,0,"",0);
		$this->Ln();

		$this->Cell(50,7,"",0);
		$this->Ln();
		
		
		$this->SetFont('Times','b',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,9,'                                                                                                                                                          ......................',0);
		$this->Cell(30,5,'School Code :',0);
		$this->SetFont('Times','',12);
        $this->Cell(40,5,$school_info_school_code,1);
		$this->Cell(50,5,"",0);
		$this->SetFont('Times','b',12.5);
		$this->Cell(42,5,"School Dise Code     :",0);
		$this->SetFont('Times','',12);
		$this->Cell(50,5,$school_info_dise_code,0);
		$this->Ln();
		
		
		
		$this->Cell(50,6,"",0);
		$this->Ln();
		
		
		$this->SetFont('Times','b',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,9,'                               ...................................                                                                                        ......................',0);
		$this->Cell(22,5,'Enquery Date :',0);
		$this->SetFont('Times','',12);
        $this->Cell(10,5,'',0);
		$this->Cell(88,5,$enquiry_date,0);
		$this->SetFont('Times','b',12);
        $this->Cell(42,5,'Next Follow up Date :',0);
		$this->SetFont('Times','',12);
        $this->Cell(25,5,$enquiry_next_follow_up_date,0);
		$this->Ln();
		
		
		$this->Cell(50,4,"",0);
		$this->Ln();
		
		
		$this->SetFont('Times','b',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,1.5,'',0);
		$this->Cell(22,1.5,'',0);
		$this->SetFont('Times','',12);
        $this->Cell(40,1.5,'',0);
		$this->Ln();
		
		$this->Cell(50,1.5,"",0);
		$this->Ln();
		
		
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ..............................................................................................................................',0);
		$this->Cell(46,4,'1. Enquiry Type',0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$enquiry_type,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ..............................................................................................................................',0);
		$this->Cell(46,4,'2. Medium',0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_medium,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ..............................................................................................................................',0);
		$this->Cell(46,4,'3. Name',0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$enquiry_name,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ..............................................................................................................................',0);
		$this->Cell(46,4,'4. Father Name',0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$enquiry_father_name,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ..............................................................................................................................',0);
		$this->Cell(46,4,'5. Contact No.',0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$enquiry_contact_no_info,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ..............................................................................................................................',0);
		$this->Cell(46,4,'6. Address',0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$enquiry_address,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ..............................................................................................................................',0);
		$this->Cell(46,4,'7. Enquery Remark 1',0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$enquiry_remark_1,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ..............................................................................................................................',0);
		$this->Cell(46,4,'8. Enquery Remark 2',0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$enquiry_remark_2,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		
		
		
}
function Table1()
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
$pdf->SetFont('Times','',14);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
	//  $pdf->SetLeftMargin(30);
		$pdf->Table1();
		$pdf->Ln();
		$pdf->Table2();
		$pdf->Ln();
		
	//	$pdf->SetLeftMargin(-30);

$file_name="enquiry_form.pdf";
$pdf->Output('I',$file_name);
?>