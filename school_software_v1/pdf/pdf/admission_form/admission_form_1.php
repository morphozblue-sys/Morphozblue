<?php
include("../../../admin/attachment/session.php");
$student_roll_no=$_GET['id'];
$query="select * from student_admission_info where student_roll_no='$student_roll_no'";
$run=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){
    $student_name=$row['student_name'];
	$student_father_name=$row['student_father_name'];
	$student_mother_name=$row['student_mother_name'];
	$student_class=$row['student_class'];
	$student_date_of_birth_1 = $row['student_date_of_birth'];
	$student_date_of_birth_2 = explode("-",$student_date_of_birth_1);
	$student_date_of_birth=$student_date_of_birth_2[2]."-".$student_date_of_birth_2[1]."-".$student_date_of_birth_2[0];
	$student_gender=$row['student_gender'];
	$student_handicapped=$row['student_handicapped'];
	$student_religion=$row['student_religion'];
	$student_category=$row['student_category'];
	$student_rf_id_number=$row['student_rf_id_number'];
	$student_adhar_number=$row['student_adhar_number'];
	$student_father_adhar_card_number=$row['student_father_adhar_card_number'];
	$student_sssmid_number=$row['student_sssmid_number'];
	$student_family_id=$row['student_family_id'];
	$student_child_id=$row['student_child_id'];
	$student_father_bank_name=$row['student_father_bank_name'];
	$student_father_bank_account_number=$row['student_father_bank_account_number'];
	$student_father_bank_ifsc_code=$row['student_father_bank_ifsc_code'];
	$student_bank_name=$row['student_bank_name'];
	$student_account_number=$row['student_account_number'];
	$student_bank_ifsc_code=$row['student_bank_ifsc_code'];
	$student_admission_type=$row['student_admission_type'];
	$student_admission_scheme=$row['student_admission_scheme'];
	$stuent_old_or_new=$row['stuent_old_or_new'];
	$student_medium=$row['student_medium'];
	$student_date_of_admission=$row['student_date_of_admission'];
	if($student_date_of_admission!=''){
	$student_date_of_admission_1 = $row['student_date_of_admission'];
	$student_date_of_admission_2 = explode("-",$student_date_of_admission_1);
	$student_date_of_admission=$student_date_of_admission_2[2]."-".$student_date_of_admission_2[1]."-".$student_date_of_admission_2[0];
	}
	$student_date_of_birth_in_word=$row['student_date_of_birth_in_word'];
	$student_previous_class=$row['student_previous_class'];
    $student_previous_school_name=$row['student_previous_school_name'];
	$student_admission_scheme=$row['student_admission_scheme'];
	$student_sibling_name_1=$row['student_sibling_name_1'];
	$student_sibling_unique_id_1=$row['student_sibling_unique_id_1'];
	$student_sibling_name_2=$row['student_sibling_name_2'];
	$student_sibling_unique_id_2=$row['student_sibling_unique_id_2'];
	$student_admission_number=$row['student_admission_number'];
	$student_scholar_number=$row['student_scholar_number'];
	if($student_admission_number==''){$student_admission_number=$student_scholar_number;}
	$student_father_contact_number=$row['student_father_contact_number'];
	$student_father_email_id=$row['student_father_email_id'];
	$student_mother_contact_number=$row['student_mother_contact_number'];
	$student_mother_email_id=$row['student_mother_email_id'];
	$student_father_occupation=$row['student_father_occupation'];
	$student_mother_occupation=$row['student_mother_occupation'];
	$student_contact_number=$row['student_contact_number'];
	$student_email_id=$row['student_email_id'];
	$student_last_passed_marksheet=$row['student_last_passed_marksheet'];
	$student_tc=$row['student_tc'];
	$student_income_certificate=$row['student_income_certificate'];
	$student_caste_certificate=$row['student_caste_certificate'];
	$student_dob_certificate=$row['student_dob_certificate'];
	$student_class_stream=$row['student_class_stream'];
	

	$student_roll_no=$row['student_roll_no'];
	$student_adress=$row['student_adress'];
	$student_id_generate=$row['student_id_generate'];
	$student_class_section=$row['student_class_section'];
	$student_facility=$row['student_facility'];	

 $student_photo=$row['student_image_name'];
	 $student_photo1=$_SESSION['amazon_file_path']."student_documents/".$student_photo;$student_photo1=str_replace(" ","%20",$student_photo1);
	}
	
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

	$school_info_principal_seal=$row12['school_info_principal_seal_name'];
	$school_info_principal_signature=$row12['school_info_principal_signature_name'];
	$school_info_logo=$row12['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
}   

if($student_medium==''){
$student_medium=$school_info_medium;
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
	
	global $school_info_school_name,$school_info_school_state,$student_class_stream,$student_admission_number,$school_info_school_district,$school_info_school_city,$school_info_school_pincode,$school_info_school_address,$school_info_school_contact_no,$school_info_dise_code,$school_info_school_code,$school_info_registration_code,$school_info_principal_seal,$school_info_principal_signature,$school_info_logo,$school_info_school_email_id,$school_info_school_website,$student_id_generate,$student_photo,$student_photo1,$path1;
$student_roll_no=$_GET['id'];
		if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',15,14,22,23);
		}else{
		$this->Image($path1,15,14,22,23,'png');
		}
  
        if($student_photo==null){
	    $this->Image('../../../images/blank.jpg',177,87,20,25);
		}
	    else{
			
	    $this->Image($student_photo1,177,87,20,26,'jpeg');
           
      } 
	
	$this->SetFont('Times','B',15);
	$this->SetTextColor(180,0,0);
	$this->Cell(58,10.5,'',0);
    $this->Cell(100,10.5,''.$school_info_school_name,0,0,'C');
	$this->SetTextColor(255,0,0);
    $this->Ln();  
	
	
	$this->SetFont('Times','B',12);
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
	$this->Cell(150,6,"Email :  ".$school_info_school_email_id.''.'           Call no : '.$school_info_school_contact_no,0,0,'C');
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
	
	
  $this->SetXY(177,87);
  $this->Cell(20,26,'',1);
	
}
function Table2()
{
global $school_info_school_code,$school_info_dise_code,$student_admission_number,$student_class_stream,$school_info_registration_code,$student_date_of_admission,$student_name,$student_father_name,$student_mother_name,$student_date_of_birth,$student_gender,$student_religion,$student_category,$student_date_of_birth_in_word,$student_class,$student_adress,$student_father_contact_number,$student_admission_type,$student_admission_scheme,$student_medium,$student_facility,$student_child_id,$student_family_id,$student_adhar_number,$student_sssmid_number,$student_bank_name,$student_account_number,$student_bank_ifsc_code,$student_bank_ifsc_code,$student_previous_class,$student_previous_school_name;
 
	    $this->Cell(50,5,"",0);
		$this->Ln();

		$this->SetTextColor(0,0,0);
		$this->Cell(2,5,'',0);
        $this->Cell(42,5,'',0);
		$this->SetFont('Times','b',16);
		$this->Cell(81,5,'                  ADMISSION FORM',0);
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
		$this->Cell(22,5,'School Reg. No :',0);
		$this->SetFont('Times','',12);
        $this->Cell(10,5,'',0);
		$this->Cell(88,5,$school_info_registration_code,0);
		$this->SetFont('Times','b',12);
        $this->Cell(42,5,'Date Of Admission    :',0);
		$this->SetFont('Times','',12);
        $this->Cell(25,5,"".$student_date_of_admission,0);
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
		$this->Cell(2,7.5,'                                                 .........................................................................................................',0);
		$this->Cell(46,4,'1. Name of Student',0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_name,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
        $this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 .........................................................................................................',0);
		$this->Cell(46,4,"2. Father's Name",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_father_name,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 .........................................................................................................',0);
		$this->Cell(46,4,"3. Mother's Name",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_mother_name,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 .............................................................                          ..................',0);
		$this->Cell(46,4,"4. Student Religion",0);
		$this->Cell(5,4,':',0);
        $this->Cell(64,4,$student_religion,0);
		$this->Cell(26,4,"Category",0);
		$this->Cell(2,4,":",0);
		$this->Cell(24,4,$student_category,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		 $this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 .............................................................                          ..................',0);
		$this->Cell(46,4,"5. Date Of Birth",0);
		$this->Cell(5,4,':',0);
        $this->Cell(64,4,$student_date_of_birth,0);
		$this->Cell(26,4," Gender",0);
		$this->Cell(2,4,":",0);
		$this->Cell(24,4,$student_gender,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		 $this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"6. Date Of Birth In Word",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_date_of_birth_in_word,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		if($student_class=='11TH' || $student_class=='12TH'){
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"7. Class Of Admission",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_class.' ('.$student_class_stream.')',0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		}
		else{
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"7. Class Of Admission",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_class,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		}
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"8. Full Address",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_adress,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"9. Father's Contact No.",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_father_contact_number,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();

		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 .............................................................                          ........................................',0);
		$this->Cell(46,4,"10. Admission Type",0);
		$this->Cell(5,4,':',0);
        $this->Cell(64,4,$student_admission_type,0);
		$this->Cell(26,4," Medium",0);
		$this->Cell(2,4,":",0);
		if($_SESSION['software_link']=='suryapunjshahour')
		$this->Cell(24,4,"Hindi",0);
		else
		$this->Cell(24,4,$student_medium,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ..............................................................................................................................',0);
		$this->Cell(46,4,"11. Admission Number",0);
		$this->Cell(5,4,':',0);
        $this->Cell(64,4,$student_admission_number,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"12. Admission Scheme",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_admission_scheme,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"13. Child Id No",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_child_id,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"14. Family Id No",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_family_id,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"15. Student Aadhaar No",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_adhar_number,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"16. Student SSSM Id No",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_sssmid_number,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 .............................................................                          ........................................',0);
		$this->Cell(46,4,"17. Bank Account Number",0);
		$this->Cell(5,4,':',0);
        $this->Cell(64,4,$student_account_number,0);
		$this->Cell(26,4," IFSC Code",0);
		$this->Cell(2,4,":",0);
		$this->Cell(24,4,$student_bank_ifsc_code,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		 $this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"18. Name of the Bank",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_bank_name,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"19. Admission Class",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_previous_class,0);
		$this->Ln();
		
		$this->Cell(50,5,"",0);
		$this->Ln();
		
		$this->SetFont('Times','',12);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,7.5,'                                                 ...............................................................................................................................',0);
		$this->Cell(46,4,"20. Previous School Name",0);
		$this->Cell(5,4,':',0);
        $this->Cell(50,4,$student_previous_school_name,0);
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

$file_name="admission_form".$student_name."_".$student_class.".pdf";
$pdf->Output('I',$file_name);
?>