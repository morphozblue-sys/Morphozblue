<?php
include("../../../admin/attachment/session.php");
$student_roll_no=$_GET['id'];
$query="select * from student_admission_info where student_roll_no='$student_roll_no'";
$run=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){//echo "<pre>"; print_r($row);
    $student_name=$row['student_name'];
      $father_qualification=$row['father_qualification'];
        $mother_qualification=$row['mother_qualification'];
        $mother_qualification=$row['mother_qualification'];
	$student_father_name=$row['student_father_name'];
	$student_previous_school_name=$row['student_previous_school_name'];
	$student_class=$row['student_class'];
	$student_date_of_birth_1 = $row['student_date_of_birth'];
	$student_date_of_birth_2 = explode("-",$student_date_of_birth_1);
 	$student_date_of_birth=$student_date_of_birth_2[2]."         ".$student_date_of_birth_2[1]."        ".$student_date_of_birth_2[0];
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
	
}

// Page footer
function Footer()
{

  
	
}
function Table2()
{
global $school_info_school_code,$school_info_dise_code,$student_admission_number,$student_class_stream,$student_previous_school_name,$father_qualification,$mother_qualification,$school_info_registration_code,$student_date_of_admission,$student_name,$student_father_name,$student_mother_name,$student_date_of_birth,$student_gender,$student_religion,$student_category,$student_date_of_birth_in_word,$student_class,$student_adress,$student_father_contact_number,$student_admission_type,$student_admission_scheme,$student_medium,$student_facility,$student_child_id,$student_family_id,$student_adhar_number,$student_sssmid_number,$student_bank_name,$student_account_number,$student_bank_ifsc_code,$student_bank_ifsc_code,$student_previous_class,$student_previous_school_name;
 	global $school_info_school_name,$school_info_school_state,$student_class_stream,$student_admission_number,$school_info_school_district,$school_info_school_city,$school_info_school_pincode,$school_info_school_address,$school_info_school_contact_no,$school_info_dise_code,$school_info_school_code,$school_info_registration_code,$school_info_principal_seal,$school_info_principal_signature,$school_info_logo,$school_info_school_email_id,$school_info_school_website,$student_id_generate,$student_photo,$student_photo1,$path1;
$student_roll_no=$_GET['id'];

/*  $this->SetXY(10,10);
	$this->Cell(190,277,'',1);*/
	
/*	$this->SetXY(10,280);
	$this->Cell(10,5,'',0);*/
	
	

/*	
  $this->SetXY(177,18);
  $this->Cell(20,26,'',1);*/
		if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',15,14,22,23);
		}else{
		$this->Image($path1,15,14,22,23,'png');
		}
  
        if($student_photo==null){
	    $this->Image('../../../images/blank.jpg',177,18,20,25);
		}
	    else{
			
	    $this->Image($student_photo1,177,18,20,25,'jpeg');
           
      } 
      
      
	  $this->Ln(-5);
	$this->SetFont('Times','B',20);
	$this->SetTextColor(0,0,0);
	$this->Cell(30,10.5,'',0);
    $this->Cell(135,10.5,''.$school_info_school_name,0,0,'C');
	$this->SetTextColor(255,0,0);
    $this->Ln();  
	
	
	$this->SetFont('Times','B',12);
	$this->SetTextColor(0,0,0); 
    $this->Cell(30,6,"",0,'C');
	$this->Cell(135,6,"".$school_info_school_address,0,0,'C');
	$this->SetTextColor(0,0,0);  
	$this->Ln(); 
	
	$this->Cell(100,1,"",0,'C'); 
	$this->Ln(); 
    $this->SetFont('Times','',11);
	$this->SetTextColor(0,0,0); 
    $this->Cell(30,6,"",0);
	$this->Cell(135,6,"Email :  ".$school_info_school_email_id.''.'           Call no : '.$school_info_school_contact_no,0,0,'C');
	$this->SetTextColor(0,0,0);  
	$this->Ln(); 
	
		$this->Cell(100,1,"",0,'C'); 
	$this->Ln(); 
    $this->SetFont('Times','',11);
	$this->SetTextColor(0,0,0); 
    $this->Cell(30,6,"",0);
	$this->Cell(135,6,"ADMISSION FORM: Note: Please complete each section in BLOCK LETTERS.",0,0,'C');
	$this->SetTextColor(0,0,0);  
	$this->Ln(); 
	
		$this->Cell(100,1,"",0,'C'); 
	$this->Ln(); 
    $this->SetFont('Times','',11);
	$this->SetTextColor(0,0,0); 
    $this->Cell(30,6,"",0);
	$this->Cell(135,6,"Form No. _______________Admission Required in_________________:Date:",0,0,'C');
	$this->SetTextColor(0,0,0);  
	$this->Ln(); 
	
	
	
    $this->Cell(200,4,"",0); 	
	$this->Ln();
   
    $this->Cell(10,5,"",0); 
    $this->Cell(170,0.10,"",1); 	
	$this->Ln();
	

	    $this->Cell(50,5,"",0);
		$this->Ln();

		$this->SetTextColor(0,0,0);
		$this->Cell(2,5,'',0);
        $this->Cell(42,5,'',0);
		$this->SetFont('Times','b',16);
		$this->Cell(81,5,'                  ADMISSION FORM',0);
        $this->Cell(50,5,"",0);
		$this->Ln();
		
	   $this->Cell(50,5,"",0);
		
		$this->Ln();
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','b',14);
		$this->Cell(190,10,"SECTION A : CANDIDATE'S PERSONAL DETAIL",1,0,'C');
		$this->Ln();
		

		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(40,10,"Name",1,0,'L');
		$this->SetFont('Times','B',12);
		$this->Cell(150,10,"".$student_name,1,0,'L');
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(40,10,"Father Name",1,0,'L');
		$this->SetFont('Times','B',12);
		$this->Cell(150,10,"".$student_father_name,1,0,'L');
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(40,20,"Date Of Birth",1,0,'L');
		$this->SetFont('Times','B',12);
		$this->Cell(15,10,"Day",1,0,'C');
		$this->Cell(15,10,"Month",1,0,'C');
		$this->Cell(15,10,"Year",1,0,'C');
		$this->Cell(27,20,"Nationality",1,0,'C');
		$this->Cell(25,20,"",1,0,'C');
		$this->Cell(27,20,"Religion",1,0,'C');
		$this->Cell(26,20,"".$student_religion,1,0,'C');
		$this->Ln(10);
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(40,10," ",0,0,'L');
		$this->SetFont('Times','B',12);
		$this->Cell(15,10,"                              ".$student_date_of_birth,1,0,'C');
		$this->Cell(15,10,"",1,0,'C');
		$this->Cell(15,10,"",1,0,'C');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(60,10,"Mother Tongue",1,0,'L');
		$this->SetFont('Times','B',12);
		$this->Cell(35,10,"",1,0,'L');
		$this->Cell(35,10,"Domicile",1,0,'L');
		$this->Cell(60,10,"",1,0,'L');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(60,10,"School Last Attended",1,0,'L');
		$this->SetFont('Times','B',12);
		$this->Cell(70,10,"".$student_previous_school_name,1,0,'L');
		$this->Cell(30,10,"Result Detail",1,0,'L');
		$this->Cell(30,10,"",1,0,'L');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(60,30,"Permanent Address",1,0,'L');
		$this->SetFont('Times','B',12);
		$this->Cell(70,30,"",1,0,'L');
		$this->Cell(30,30,"Village Name",1,0,'L');
		$this->Cell(30,30,"",1,0,'L');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(190,20,"Current Address".$student_adress,1,0,'L');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(190,20,"Residence Telephone",1,0,'L');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(190,10,"SECTION B: PARENTS / GUARDIAN PROFILE",1,0,'C');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->Cell(47,10,"Father's CNIC",1,0,'C');
			$this->Cell(11,10,"",1,0,'C');
				$this->Cell(11,10,"",1,0,'C');
					$this->Cell(11,10,"",1,0,'C');
						$this->Cell(11,10,"",1,0,'C');
							$this->Cell(11,10,"",1,0,'C');
								$this->Cell(11,10,"",1,0,'C');
									$this->Cell(11,10,"",1,0,'C');
										$this->Cell(11,10,"",1,0,'C');
											$this->Cell(11,10,"",1,0,'C');
												$this->Cell(11,10,"",1,0,'C');
													$this->Cell(11,10,"",1,0,'C');
														$this->Cell(11,10,"",1,0,'C');
															$this->Cell(11,10,"",1,0,'C');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(40,10,"Qualification ",1,0,'C');
			$this->Cell(55,10,"".$father_qualification,1,0,'C');
				$this->Cell(40,10,"Profession",1,0,'C');
					$this->Cell(55,10,"",1,0,'C');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(40,10,"Department",1,0,'C');
			$this->Cell(55,10,"",1,0,'C');
				$this->Cell(40,10,"Salary",1,0,'C');
					$this->Cell(55,10,"",1,0,'C');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(40,10,"Mother's Name",1,0,'L');
			$this->Cell(150,10,"".$student_mother_name,1,0,'C');
			
		$this->Ln();

		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(40,10,"Qualification",1,0,'C');
			$this->Cell(55,10,"".$mother_qualification,1,0,'C');
				$this->Cell(40,10,"Profession",1,0,'C');
					$this->Cell(55,10,"",1,0,'C');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(50,10,"Name of Guardian",1,0,'C');
			$this->Cell(50,10,"",1,0,'C');
				$this->Cell(40,10,"Relation",1,0,'C');
					$this->Cell(50,10,"",1,0,'C');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(190,10,"SECTION B: C CONTACT INFORMATION",1,0,'C');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(63.33,10,"Mobile No.",1,0,'C');
			$this->Cell(63.33,10,"Name ",1,0,'C');
				$this->Cell(63.33,10,"Relation",1,0,'C');
		$this->Ln();
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(63.33,10,"1",1,0,'L');
			$this->Cell(63.33,10,"",1,0,'C');
				$this->Cell(63.33,10,"",1,0,'C');
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(63.33,10,"2",1,0,'L');
			$this->Cell(63.33,10,"",1,0,'C');
				$this->Cell(63.33,10,"",1,0,'C');
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(63.33,10,"3",1,0,'L');
			$this->Cell(63.33,10,"",1,0,'C');
				$this->Cell(63.33,10,"",1,0,'C');
		$this->Ln();
		
	
		
		
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(190,30,"ATTACHMENTS REQUIRED",0,0,'C');
		
		$this->Ln(-10);
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',14);
		$this->Cell(190,30,"",1,0,'C');
		
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(190,10,"Please Attach the following with the form",0,0,'L');
		$this->Ln();
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(63.33,10,"* Passport size photographs 2",0,0,'L');
		$this->Cell(63.33,10,"* Result Sheet",0,0,'L');
		$this->Cell(63.33,10,"* School Leaving Certificate",0,0,'L');
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(95,10,"* Nadra Registration Form",0,0,'L');
		$this->Cell(95,10,"* Father's passport size photograph 1",0,0,'L');
			
		$this->Ln(-20);
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',12);
		$this->Cell(190,30,"",1,0,'L');
		
		$this->Ln();
		
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',16);
		$this->Cell(15,10,"",0,0,'L');
		$this->Cell(175,10,"PARENT SCHOOL AGREEMENT",0,0,'L');
		$this->Ln();
		
			$this->SetTextColor(0,0,0);
		$this->SetFont('Times','B',14);
		$this->Cell(190,10,"The Vision",0,0,'L');
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12);
		$this->MultiCell(180,10,"We believe that it is important that each child is given the opportunity to develop his/her full potential at School which is committed to continuously striving to raise achievement. Our school seeks to provide a broad and balanced curriculum for the children: high standards in the core skills of English, Urdu, Islamiat, Mathematics, Science and Information Technology, and opportunities for each child to develop the hidden abilities.",0,'L');
		$this->Ln();


	$this->Cell(60,5,' Signature of Students / Parents',0);
	$this->Cell(70,5,'',0);
	$this->Cell(40,5,'Principal Seal & Sign',0);
	

		
		
		
		
		
		
		
		
		
		
		
		
		
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