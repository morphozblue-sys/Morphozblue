<?php
require('../fpdf.php');
include("../../../admin/attachment/session.php");
    $query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
        while($row=mysqli_fetch_assoc($run1)){
        $school_info_school_name = $row['school_info_school_name'];
        $school_info_logo = $row['school_info_logo'];
        $school_info_school_district = $row['school_info_school_district'];
        $school_info_school_contact_no = $row['school_info_school_contact_no'];
        $school_info_school_email_id = $row['school_info_school_email_id'];
        $school_info_school_website = $row['school_info_school_website'];
        $school_info_school_address = $row['school_info_school_address'];
        $school_info_school_code = $row['school_info_school_code'];
        $school_info_school_district = $row['school_info_school_district'];
        $school_info_school_state = $row['school_info_school_state'];
    $school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
    	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);

    }  
    
    $student_roll_no=$_GET['student_roll_no'];
    $query1="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
    $run1=mysqli_query($conn73,$query1);
    while($row1=mysqli_fetch_assoc($run1)){ //echo "<pre>"; print_r($row1);
    $s_no = $row1['s_no'];
    $student_father_name =$row1['student_father_name'];
    $student_name =$row1['student_name'];
    $student_admission_number =$row1['student_admission_number'];
    $student_class =$row1['student_class'];
    $student_class_section =$row1['student_class_section'];
    $student_gender=$row1['student_gender'];
    $student_date_of_admission =$row1['student_date_of_admission'];
    $student_date_of_birth =$row1['student_date_of_birth'];
    $student_date_of_birth_in_word =$row1['student_date_of_birth_in_word'];
    }
    
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
    global $conn73,$school_info_school_contact_no,$school_info_school_code;
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','',12);
       $this->Cell(190,5,' Ph. No. '.$school_info_school_contact_no,0,0,'R');

}

function footer()
{       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','',16);
         $this->SetXY(170,250);
       $this->Cell(10,5,'Principal',0,0,'R'); 
}

// Page footer

function Table1()
{
    global $conn73,$student_date_of_birth_in_word,$school_info_logo,$path1,$student_date_of_birth,$student_class_section,$student_class,$student_father_name,$student_name,$school_info_school_name,$school_info_school_address,$school_info_school_district,$school_info_school_state,$s_no,$school_info_school_email_id;


$this->image('../certificate_image/blue_bg.png',65,45,80,8);
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','B',20);
       $this->Cell(190,15,'',0,0,'C');
       $this->Ln();
       
       if($school_info_logo==null){
        $this->Image('../../../images/blank_logo.png',90,58,32,33);
        }else{
        $this->Image($path1,9,18,25,25,'jpeg');
        // $this->Image($path1,184,21,18,19,'jpeg');
        }  
    //   $this->SetTextColor(0,0,0);
    //   $this->SetFont('Times','B',22);
    //   $this->Cell(190,5,''.$school_info_school_name,0,0,'C');
    //   $this->Ln();
    
       if($school_info_school_name=='SCHOLARS ACADEMY'){
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','B',22);
       $this->Cell(86,5,'SCHOLARS',0,0,'R');
       $this->Cell(18,5,'',0,0,'C');
       $this->Cell(86,5,'ACADEMY',0,0,'L');
       $this->Ln();
       
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','B',22);
       $this->Cell(190,5,'',0,0,'C');
       $this->Ln();
       
        $this->SetTextColor(0,0,0);
        $this->SetFont('Times','B',10);
        $this->Cell(190,5,''.$school_info_school_address.','.$school_info_school_district.' '.$school_info_school_state,0,0,'C');
        $this->Ln();
        
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','B',22);
       $this->Cell(190,10,'',0,0,'C');
       $this->Ln();
       
        $this->Image($path1,95,15,20,20,'jpeg');
               
        
        
       }
       else{
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','B',22);
       $this->Cell(190,5,''.$school_info_school_name,0,0,'C');
       $this->Ln();
       
        $this->SetTextColor(0,0,0);
        $this->SetFont('Times','B',10);
        $this->Cell(190,8,''.$school_info_school_address,0,0,'C');
        $this->Ln();
       
      $this->Cell(0.1,0,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','B',10);
       $this->Cell(190,5,'Email :  '.$school_info_school_email_id,0,0,'C');
       $this->Ln(6);
    //   $this->SetTextColor(0,0,0);
    //   $this->SetFont('Times','B',22);
    //   $this->Cell(190,15,'',0,0,'C');
    //   $this->Ln();
       }
       
        // $this->SetTextColor(0,0,0);
        // $this->SetFont('Times','B',10);
        // $this->Cell(190,5,''.$school_info_school_address.','.$school_info_school_district.' '.$school_info_school_state,0,0,'C');
        // $this->Ln();
        
    //   $this->SetTextColor(0,0,0);
    //   $this->SetFont('Times','B',22);
    //   $this->Cell(190,15,'',0,0,'C');
    //   $this->Ln();
       

       
       $this->SetTextColor(255,255,255);
       $this->SetFont('Times','B',18);
       $this->Cell(190,10,'BIRTH CERTIFICATE',0,0,'C');
       $this->Ln();
       
       $this->Cell(190,10,'',0,0,'C');
       $this->Ln();
       
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','B',10);
       $this->Cell(90,5,' Certificate No. : '.$s_no,0,0,'L');
       $this->Cell(100,5,' Date : '.date("d-m-Y"),0,0,'R');
       $this->Ln(10);
       
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(20,15,'',0,0,'C');
       $this->Cell(80,15,'This is to certify that Master/Miss',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(60,15,''.$student_name,0,0,'');
       $this->Ln();
       
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(20,-10,'',0,0,'C');
       $this->Cell(78,-10,'',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(60,-10,'------------------------------------------------',0,0,'');
       $this->Ln();
       
       $this->Cell(60,10,'',0,0,'');
       $this->Ln();
       
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(60,15,'Son/Daughter of Shri',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(100,15,''.$student_father_name,0,0,'');
       $this->SetFont('Times','I',16);
       $this->Cell(60,15,'is a regular',0,0,'');
       $this->Ln();
       
      $this->SetTextColor(0,0,0);
      $this->SetFont('Times','I',16);
      $this->Cell(50,-10,'',0,0,'');
      $this->SetFont('Times','',16);
      $this->Cell(60,-10,'---------------------------------------------------------',0,0,'');
      $this->SetFont('Times','I',16);
      $this->Cell(60,-10,'',0,0,'');
      $this->Ln();
      
        $this->Cell(60,10,'',0,0,'');
        $this->Ln();
        
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(40,15,'Student of Class',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(40,15,''.$student_class,0,0,'');
       $this->SetFont('Times','I',16);
       $this->Cell(22,15,'Section',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(15,15,''.$student_class_section,0,0,'');
       $this->SetFont('Times','I',16);
       $this->Cell(60,15,'in our school. As per the',0,0,'');
       $this->Ln();
       
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(40,-10,'',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(40,-10,'--------------------',0,0,'');
       $this->SetFont('Times','I',16);
       $this->Cell(20,-10,'',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(20,-10,'------',0,0,'');
       $this->SetFont('Times','I',16);
       $this->Cell(60,-10,'',0,0,'');
       $this->Ln();
       
       $this->Cell(60,10,'',0,0,'');
        $this->Ln();
        
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(85,15,'school record his/her date of birth is',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(30,15,''.date('d-m-Y',strtotime($student_date_of_birth)),0,0,'');
       $this->Ln();
       
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(80,-10,'',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(30,-10,'   ------------------------',0,0,'');
       $this->Ln();
       
        $this->Cell(60,10,'',0,0,'');
        $this->Ln();
        
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(30,15,'In Words :',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(100,15,''.$student_date_of_birth_in_word,0,0,'');
       $this->Ln();
       
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(27,-10,'',0,0,'');
       $this->SetFont('Times','',16);
       $this->Cell(100,-10,'--------------------------------------------------------------------------------------',0,0,'');
       $this->Ln();
       
        $this->Cell(60,20,'',0,0,'');
        $this->Ln();
        
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','I',16);
       $this->Cell(30,15,'i wish him/her every success & a brilliant future.',0,0,'');
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
$pdf->AddPage();

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
  

 

	   
	//  $pdf->SetLeftMargin(30);
		$pdf->Table1();
		$pdf->Ln(0);
		
		
		
		
	//	$pdf->SetLeftMargin(-30);

	
// $file_name="Annualfee_certificate_".$caste_student_name.".pdf";
// $pdf->Output('I',$file_name);
$pdf->Output('I');
?>