<?php include("../../../admin/attachment/session.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
$s_no=$_GET['id'];
$query="select * from bonafied_certificate where s_no='$s_no'";
$run=mysqli_query($conn73,$query) or die(mysql_error());
while($row=mysqli_fetch_assoc($run)){  
$s_no = $row['s_no'];
$bonafied_student_name = $row['bonafied_student_name'];
$bonafied_s_no = $row['s_no'];
$bonafied_student_father_name = $row['bonafied_student_father_name'];
$bonafied_school_name = $row['bonafied_school_name'];
$bonafied_current_year_from = $row['bonafied_current_year_from'];
$bonafied_current_year_to = $row['bonafied_current_year_to'];
$bonafied_type = $row['bonafied_type'];
$bonafied_issue_date = $row['bonafied_issue_date'];
$bonafied_student_roll_no = $row['bonafied_student_roll_no'];

}
$query1="select * from student_admission_info where student_roll_no='$bonafied_student_roll_no' and session_value='$session1'";
$run1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($run1)){ // echo "<pre>"; var_dump($row1);
$student_mother_name =$row1['student_mother_name'];
$student_admission_number =$row1['student_admission_number'];
$student_date_of_birth_in_word=$row1['student_date_of_birth_in_word'];
$student_class =$row1['student_class'];
$student_class_section =$row1['student_class_section'];
$student_date_of_admission1 =$row1['student_date_of_admission'];
$student_date_of_admission=date("d-m-Y", strtotime($student_date_of_admission1) );
$student_scholar_number =$row1['student_scholar_number'];
$student_admission_class=$row1['student_admission_class'];
$student_roll_no =$row1['student_roll_no'];
$student_date_of_birth1 =$row1['student_date_of_birth'];
$student_date_of_birth=date("d-m-Y", strtotime($student_date_of_birth1) );
$student_photo=$row1['student_image_name'];
	 $student_photo1=$_SESSION['amazon_file_path']."student_documents/".$student_photo;$student_photo1=str_replace(" ","%20",$student_photo1);
}

$query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysql_error());
        while($row=mysqli_fetch_assoc($run1)){ 
        $school_info_school_name = $row['school_info_school_name'];
        $school_info_school_phone_no = $row['school_info_school_contact_no'];
        $school_info_school_email_id = $row['school_info_school_email_id'];
        $school_info_school_website =  $row['school_info_school_website'];
        $school_info_logo = $row['school_info_logo_name'];
        $school_info_school_district = $row['school_info_school_district'];
        $school_info_school_contact_no = $row['school_info_school_contact_no'];
        $school_info_school_email_id = $row['school_info_school_email_id'];
        $school_info_school_website = $row['school_info_school_website'];
        $school_info_school_address = $row['school_info_school_address'];
        $school_info_registration_code = $row['school_info_registration_code'];
        $school_info_dise_code = $row['school_info_dise_code'];
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

global $school_info_registration_code,$school_info_dise_code,$school_info_school_email_id,$school_info_school_district,$school_info_school_name,$student_class_section,$s_no,$conn73,$bonafied_student_name,$student_photo,$student_date_of_birth,$student_photo1,$student_date_of_admission,$school_info_school_address,$student_scholar_number,$student_class,$student_admission_number,$student_mother_name,$school_info_school_contact_no,$school_info_school_website,$school_info_school_email_id,$bonafied_student_father_name,$bonafied_school_name,$bonafied_current_year_from,$bonafied_current_year_to,$bonafied_type,$bonafied_issue_date,$bonafied_student_roll_no,$school_info_school_name,$school_info_logo,$path1,$school_info_school_phone_no,$bonafied_s_no,$student_admission_class,$student_date_of_birth_in_word;


       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(0.1,0,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','',16);
    //   $this->Cell(95,8,'Dise Code : '.$school_info_dise_code,0,0,'L');
    //   $this->Cell(95,8,'Affiliation No.: '.'330844',0,0,'R');
       $this->Ln();
           
        // if($school_info_logo==null){
        // $this->Image('../../../images/blank_logo.png',90,58,32,33);
        // }else{
        // //   $this->Image('../certificate_image/admission-background-min.jpg',0,0,210,290);
        // $this->Image($path1,9,21,18,19,'jpeg');
        // $this->Image($path1,184,21,18,19,'jpeg');
        // }    
        
    //   $this->Cell(190,4,'',0,0,'C');
    //   $this->Ln();
    //   $this->Cell(0.1,0,'',0,0,'C');
    //   $this->SetTextColor(0, 0, 0);
    //   $this->SetFont('Times','B',21);
    //   $this->Cell(190,12,''.$school_info_school_name,0,1,'C');
    //   $this->SetFont('Times','B',16);
    //   $this->Cell(190,10,"Affiliated to CBSE, New Delhi(10+2)",0,1,'C');
    //   $this->Cell(190,10,"Phone no. : ".$school_info_school_phone_no,0,0,'C');
      $this->Cell(190,50,"",0,0,'C');
    //   $this->Ln(15);
       $this->Ln();

       $this->SetTextColor(0, 0, 0);
    //   $this->SetLeftMargin(30);
       
       $this->SetLeftMargin(30);
    //   $this->SetRightMargin(30);
       $this->SetFont('Arial','BU',14);
       $this->Cell(45,8,'',0,0,'C');
       $this->Cell(100,8,'BONAFIDE CERTIFICATE',0,1,'L');
       $this->Ln();
       $this->SetFont('Arial','',14);
       $this->Cell(1,5,'                         ________',0,0,'');
       $this->Cell(42,5,"Admission No.",0,0);
       $this->SetFont('Arial','B',14);
       $this->Cell(65,5,"".$student_admission_number,0,0);
       
       
       $this->SetFont('Arial','',14);
       $this->Cell(1,5,'                         ________',0,0,'');
       $this->Cell(42,5,"Certificate No.",0,0);
       $this->SetFont('Arial','B',14);
       $this->Cell(85,5,"".$bonafied_s_no,0,0);
       
       
       
       
       
       
       
    //   $this->Cell(0,5,"Date"." : ".$bonafied_issue_date,0,0);
    //   $this->SetFont('Times','B',30);
    //   $this->Ln(15);
    //   $this->Cell(1,8,'           _________________________',0,0,'');
      $this->Ln(15);
       
       
       $this->Cell(190,5,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','',16); 
       $this->Cell(1,10,'                                _____________________________________',0,0,'');
       $this->SetFont('Times','',15);
       $this->Cell(65,10,'This is to certify that  ',0,0,'');
        $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','B',15);
       $this->Cell(75,10,''.$bonafied_student_name,0,0,'C');
      $this->Ln();
      $this->Ln(5);
        $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','',15);
       $this->Cell(0.1,10,'                            __________________________________________',0,0,'');
       $this->Cell(45,10,'Son/Daughter of ',0,0,'');
       $this->SetFont('Times','B',15);
       $this->Cell(81.5,10,''.$bonafied_student_father_name,0,0,'C');
      $this->Ln();

        $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','',15);
       $this->Cell(45,10,'is a bonafide student of this institution.',0,0,'');
   
   
   
   
   
   

    //   $this->Cell(190,0,'',0,0,'C');
    //   $this->Cell(-2,10,'',0,0,'C');
    //   $this->SetTextColor(0, 0, 128);
    //   $this->SetFont('Times','B',15);
    //   $this->SetTextColor(0, 0, 0);
    //   $this->SetTextColor(0, 0, 128);
    //   $this->SetFont('Times','B',12);
    //   $this->Cell(81.5,10,''.$student_mother_name,0,0,'C');
       $this->Ln(); 
         $this->Ln(5);

       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','',20);
       $this->Cell(1,10,'                                               _______',0,0,'');
       $this->SetFont('Times','',15); 
       $this->SetTextColor(0, 0, 0);
       $this->Cell(65.5,10,'He/She was admitted in this school on ',0,0,'L');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','B',14);
       $this->Cell(42,10,'              '.$student_date_of_admission,0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->Cell(1,10,'              __________',0,0,'');
       $this->SetFont('Times','',15);
       $this->Cell(18,10,'in class',0,0,'L');
       $this->SetFont('Times','B',14);
       $this->Cell(18,10,'      '.$student_admission_class,0,0,'C');
       $this->Ln(); 
       $this->SetFont('Times','',15);
       $this->Ln(5);
       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->Cell(1,10,'                                                                 _________________________',0,0,'');
       $this->Cell(90,10,'and he/she is currently studying in class ',0,0,'L');
       
       $this->SetFont('Times','B',15);
       $this->Cell(43,10,''.$student_class.'   '.$student_class_section,0,0,'C');
       
       
       
       $this->Ln();
         $this->Ln(5);
       
       $this->SetFont('Times','',15);
       
       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->Cell(1,10,'                                                        _____________________________',0,0,'');
       $this->Cell(85,10,'His/Her date of birth is (in figures) ',0,0,'L');
         
       $this->SetFont('Times','B',15);
       $this->Cell(43,10,''.$student_date_of_birth,0,0,'C');
       
       $this->Ln();
         $this->Ln(5);
       
       $this->SetFont('Times','',15);
       
       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->Cell(1,10,'                  ________________________________________________',0,0,'');
       $this->Cell(45,10,'(in words) ',0,0,'L');
         
       $this->SetFont('Times','B',15);
       $this->Cell(43,10,'                '.$student_date_of_birth_in_word,0,0,'C');
       
       
  
       
       
       $this->Ln();
         $this->Ln(5);
       
       $this->SetFont('Times','',15);
       
       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->Cell(1,10,'                                                               _____________',0,0,'');
       $this->Cell(82,10,'His/Her conduct at this institution was',0,0,'L');
         
       $this->SetFont('Times','B',15);
      $this->Cell(35,10,'Good',0,0,'C');
      $this->Cell(1,10,'.',0,0,'L');
       
       
  
       
       
       
       
       
       
       
       
       
       
       $this->Ln();
       $this->Ln();
       $this->Ln();
       
       
     $this->Ln();
       $this->SetFont('Times','',14);    
       $this->Cell(80,5,'Prepared by.................... ',0,0,'L');
       $this->Cell(80,5,'Principal .................... ',0,0,'L');
         $this->Ln();
         $this->Ln();
         $this->Ln();
         $this->Ln();
         $this->Ln(5);
         
       $this->Cell(1,5,'          ....................... ',0,0,'L');
       $this->Cell(80,3,'Date   '.$bonafied_issue_date,0,0,'L');
       $this->Cell(80,5,'Seal .................... ',0,0,'L');
        

    //   $this->Cell(190,20,'',0,0,'C');
    //   $this->Ln();
    //   $this->Cell(-2,10,'',0,0,'C');
    //   $this->SetFont('Times','B',20);
    //   $this->SetTextColor(0, 0, 128);
    //   $this->Cell(190,8,"Principal",0,1,'R');
    //   $this->SetFont('Times','',15);
    //   $this->SetTextColor(0, 0, 128);
    //   $this->Cell(100,8,"",0,0,'R');
    //     $this->Cell(90,8,"",0,1,'R');
    //   $this->Cell(90,8,"S.B.M HIGH SCHOOL BHAUNKHEDI",0,1,'R');
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
		$pdf->Table1();
		$pdf->Ln(0);
$file_name="character_certificate_".$bonafied_student_name.".pdf";
$pdf->Output('I',$file_name);
?>