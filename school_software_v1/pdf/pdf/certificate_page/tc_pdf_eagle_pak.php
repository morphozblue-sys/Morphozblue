<?php include("../../../admin/attachment/session.php");
$tc_student_roll_no=$_GET['id'];
$query="select * from student_tc where s_no='$tc_student_roll_no'";
$run=mysqli_query($conn73,$query) or die(mysqli_error($conn73));

while($row=mysqli_fetch_assoc($run)){ //echo "<pre>"; print_r($row);
    $s_no=$row['s_no'];
    $tc_student_roll_no = $row['tc_student_roll_no'];
	$tc_student_sssm_id_no = $row['tc_student_sssm_id_no']; 
	$tc_student_uid_no = $row['tc_student_uid_no'];
	$tc_student_name = $row['tc_student_name'];
	$tc_student_father_name = $row['tc_student_father_name'];
	$tc_mother_name = $row['tc_mother_name'];
	$date_of_birth = $row['date_of_birth'];
    $date_of_birth_in_word = $row['date_of_birth_in_word'];
	$tc_admission_no = $row['tc_admission_no'];
	$tc_admission_date = $row['tc_admission_date'];
	$tc_student_class = $row['tc_student_class'];
	$tc_generate_no = $row['tc_generate_no'];
	$tc_student_class_leaving = $row['tc_student_class_leaving'];
	$tc_student_class_section = $row['tc_student_class_section'];
	$class_in_which_admitted = $row['class_in_which_admitted'];
	$date_of_school_leaving1 = $row['date_of_school_leaving'];
	$region_for_leaving = $row['region_for_leaving'];
	$tc_subject = $row['tc_subject'];
	$due_if_any = $row['due_if_any'];
	$blank_field_3 = $row['blank_field_3'];
	$conduct_and_behaviour = $row['conduct_and_behaviour'];
	$admission_date = date('d-m-Y',strtotime($tc_admission_date));
    $birth_date = date('d-m-Y',strtotime($date_of_birth));
	$date_of_school_leaving = date('d-m-Y',strtotime($date_of_school_leaving1));
	$tc_remark = $row['tc_remark'];
	$any_other_remark = $row['any_other_remark'];
}
    $query1="select * from  school_info_general";
       $run1=mysqli_query($conn73,$query1) or (mysqli_error($conn73));
       while($row1=mysqli_fetch_assoc($run1)){ //print_r($row1);
       $school_info_school_name=$row1['school_info_school_name'];
       $school_info_school_address=$row1['school_info_school_address'];
       $school_info_dise_code=$row1['school_info_dise_code'];
       $school_info_school_code=$row1['school_info_school_code'];
       $school_info_registration_code=$row1['school_info_registration_code'];
       $school_info_medium=$row1['school_info_medium'];
       $school_info_school_board=$row1['school_info_school_board'];
       $school_info_school_district=$row1['school_info_school_district'];
       $school_info_school_city=$row1['school_info_school_city'];
       $school_info_school_pincode=$row1['school_info_school_pincode'];
       $school_info_principal_signature = $row1['school_info_principal_signature'];
       $school_info_principal_seal = $row1['school_info_principal_seal'];
       $school_info_principal_name = $row1['school_info_principal_name'];
       
$school_info_logo=$row1['school_info_logo_name'];

	$logo_image=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$logo_image=str_replace(" ","%20",$logo_image);

} 

$query12="select * from student_admission_info where student_roll_no='$tc_student_roll_no' and session_value='$session1'$filter37";
$run12=mysqli_query($conn73,$query12) or die(mysqli_error($conn73));

while($row12=mysqli_fetch_assoc($run12)){  //echo "<pre>"; print_r($row12);
    $student_caste = $row12['student_caste']; 
    $student_adhar_number = $row12['student_adhar_number'];
    $student_state = $row12['student_state']; 
    $student_category = $row12['student_category']; 
    $student_date_of_birth_in_word = $row12['student_date_of_birth_in_word'];
    $student_scholar_number = $row12['student_scholar_number'];
    $student_admission_number = $row12['student_admission_number'];
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
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8 
    $this->SetFont('Arial','I',10);
    // Page number
      // Page number
	//$this->SetLineWidth(0.50);
	$this->SetXY(10,13.1);
    //$this->Cell(191,40,'',1,0,'C');
    $this->Ln();
}
function Table2()
{
global $conn73, $blank_field_3,$school_info_school_name,$school_info_school_address,$student_state,$student_admission_number,$student_date_of_birth_in_word,$student_scholar_number,$school_info_dise_code,$student_category,$student_caste,$school_info_school_code,$school_info_registration_code,$school_info_school_district,$school_info_school_city,$school_info_logo,$tc_student_roll_no,$tc_student_sssm_id_no,$tc_student_uid_no,$tc_student_name,$tc_student_father_name,$tc_mother_name,$date_of_birth,$date_of_birth_in_word,$tc_admission_no,$tc_admission_date,$tc_student_class,$tc_student_class_leaving,$tc_student_class_section,$class_in_which_admitted,$date_of_school_leaving,$region_for_leaving,$tc_subject,$due_if_any,$conduct_and_behaviour,$school_info_medium,$school_info_school_board, $s_no,$admission_date,$logo_image,$birth_date,$tc_generate_no,$student_adhar_number,$any_other_remark,$tc_remark,$school_info_principal_name,$school_info_principal_signature,$school_info_principal_seal;

	
	
	
    $this->SetFont('','B');
    $this->SetLeftMargin(10);
	
	    $this->Cell(22,15,'',0);
		$this->Ln();
	
		$this->SetTextColor(0,0,0);
		$this->Cell(198,-10,"",0);
        $this->Ln();

	    $this->SetLeftMargin(30);	
		$this->SetTextColor(0,0,0);
		$this->Cell(2,8,'',0);
        $this->Cell(35,8,'',0);
		$this->SetFont('Times','BU',18);
		$this->Cell(81,25, '' , 0,0);
		$this->Ln();
		$this->Ln();
		$this->Cell(160,6,'SCHOOL LEAVING CERTIFICATE',0,1,'C');
		
		$this->Ln();
		$this->Cell(50,1,"",0);
		$this->Ln();
		
		$this->SetLeftMargin(30);	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',14);
		$this->Cell(35,10,"Admission NO.",0);
        $this->Cell(80,10,''.$student_admission_number,0);
		$this->Cell(30,10,"Certificate No.",0);
        $this->Cell(22,10,' '.$tc_generate_no,0);
		$this->Ln();
		
//         $this->Cell(50,8,"",0);
// 		$this->Ln();
		
	     
		$this->Cell(198,2,"",0);
        $this->Ln();
	    $this->Ln();
	    
		$this->SetLeftMargin(30);	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                                      ____________________________________________________",0);
        $this->Cell(50,7,"This is to certify that  ",0);
        $this->SetFont('Times','B',12.5);
        $this->Cell(106,7,''.$tc_student_name,0);
		$this->Ln();
	
		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();
		
	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                                 _______________________________________________________",0);
        $this->Cell(35,7,"Son / Daughter of  	",0);
        $this->SetFont('Times','B',12.5);
        $this->Cell(106,7,'     '.$tc_student_father_name,0);
		$this->Ln();

		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();
		
	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                                                       ____________________  in Class   _______________",0);
        $this->Cell(67,7,"Was admitted in this School on	       ",0);
        $this->SetFont('Times','B',12.5);
        $this->Cell(106,7,''.$admission_date.'                                    '.$class_in_which_admitted,0);
		$this->Ln();

		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();
		
	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                                               ________________________________________________",0);
        $this->Cell(60,7,"and has left the school on 	               ",0);
        $this->SetFont('Times','B',12.5);
        $this->Cell(106,7,''.$date_of_school_leaving,0);
		$this->Ln();

		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();

		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                                                                 _______________________________________",0);
        $this->Cell(68,7,"He / She is currently studying in class 	          ",0);
		$this->SetFont('Times','B',12.5);
        $this->Cell(106,7,'      '.$tc_student_class,0);
		$this->Ln();

// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,2,"",0);
//         $this->Cell(85,2,"",0);
//         $this->Cell(101,2,"",0);
// 		$this->Ln();
		

// 		$this->SetTextColor(0,0,0);
// 		$this->SetFont('Times','',12.5);
// 		$this->Cell(2,9,"                                                        ____________________________________________",0);
//         $this->Cell(70,7,"and has been promoted to class             	        ",0);
// 		$this->SetFont('Times','B',12.5);
//         $this->Cell(106,7,'',0);
// 		$this->Ln();
		//$this->SetLeftMargin(30);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();
		
		// $this->SetLeftMargin(30);	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                                  _______________________________________________________",0);
        $this->Cell(47,7,"Dues of the school         	              ",0);
		$this->SetFont('Times','B',12.5);
        $this->Cell(106,7,''.$due_if_any,0);
		$this->Ln();
		// $this->SetLeftMargin(30);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                                             _________________________________________________",0);
        $this->Cell(60,7,"Date of Birth (In Digits) 	           ",0);
		$this->SetFont('Times','B',12.5);
        $this->Cell(106,7,''.$birth_date,0);
		$this->Ln();

		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();
	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                     _____________________________________________________________",0);
        $this->Cell(28,7,"(In Words)	             ",0);
		$this->SetFont('Times','B',12.5);
        $this->Cell(106,7,$date_of_birth_in_word,0);
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();
		
		$this->SetLeftMargin(30);	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                                                                                    ______________________________",0);
        $this->Cell(86,7,"His / Her conduct while at this institution has been                ",0);
		$this->SetFont('Times','B',12.5);
        $this->Cell(100,7,'           '.$tc_remark,0);
		$this->Ln();
		// $this->SetLeftMargin(30);
		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();
		
		// $this->SetLeftMargin(30);	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times','',12.5);
		$this->Cell(2,9,"                         ____________________________________________________________",0);
        $this->Cell(30,7,"and he / she 	                  ",0);
		$this->SetFont('Times','B',12.5);
        $this->Cell(106,7,''.$any_other_remark,0);
		$this->Ln();
		
		$this->SetTextColor(0,0,0);
		$this->Cell(2,2,"",0);
        $this->Cell(85,2,"",0);
        $this->Cell(101,2,"",0);
		$this->Ln();
		
// 		// $this->SetLeftMargin(30);	
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,12,"                                                                         ................................................................................",0);
//         $this->Cell(80,7," 12.  Class of School leaving (In Words) -",0);
//         $class_in_word=array('1ST'=>'First','2ND'=>'Second','3RD'=>'Third','4TH'=>'Third','4TH'=>'Fourth','5TH'=>'Fifth','6TH'=>'Sixth','7TH'=>'Seventh','8TH'=>'Eighth','9TH'=>'Nineth','10TH'=>'Tenth','11TH'=>'Eleventh','12TH'=>'Twelth');
//         $this->Cell(106,7,$class_in_word[$tc_student_class],0);
// 		$this->Ln();
		
		
// 		// $this->SetLeftMargin(30);
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,2,"",0);
//         $this->Cell(85,2,"",0);
//         $this->Cell(101,2,"",0);
// 		$this->Ln();
		
// 		// $this->SetLeftMargin(30);	
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,12,"                                                                         ................................................................................",0);
//         $this->Cell(80,7," 13.  Date of School leaving 	                    -",0);
//         $this->Cell(106,7,$date_of_school_leaving,0);
// 		$this->Ln();
// 		// $this->SetLeftMargin(30);
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,2,"",0);
//         $this->Cell(85,2,"",0);
//         $this->Cell(101,2,"",0);
// 		$this->Ln();
		
// 		// $this->SetLeftMargin(30);	
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,12,"                                                                         ................................................................................",0);
//         $this->Cell(80,7," 14.  Reason for leaving 	                          -",0);
//         $this->Cell(106,7,$region_for_leaving,0);
// 		$this->Ln();
		
		
		
		
		// $this->SetLeftMargin(30);
		
		
// 		// $this->SetLeftMargin(30);	
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,15,"                                                                         ................................................................................",0);
//         $this->Cell(80,10," 15.  Dues if any 	                                      -",0);
//         $this->Cell(106,10,$due_if_any,0);
// 		$this->Ln();
// 		// $this->SetLeftMargin(30);
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,2,"",0);
//         $this->Cell(85,2,"",0);
//         $this->Cell(101,2,"",0);
// 		$this->Ln();
		
// 		// $this->SetLeftMargin(30);	
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,9,"                                                                         ................................................................................",0);
//         $this->Cell(80,4," 16.  Conduct and behaviour 	                -",0);
//         $this->Cell(106,5,$conduct_and_behaviour,0);
// 		$this->Ln(8);
		
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,9,"                                                                         ................................................................................",0);
//         $this->Cell(80,4," 17.  SSSMID 	                -",0);
//         $this->Cell(106,5,$tc_student_sssm_id_no,0);
// 		$this->Ln(8);
		
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(2,9,"                                                                         ................................................................................",0);
//         $this->Cell(80,4," 18.  Adhar no. 	                -",0);
//         $this->Cell(106,5, $student_adhar_number,0);
// 		$this->Ln();
// 		// $this->SetLeftMargin(30);
// 		$this->SetTextColor(0,0,0);
// 		$this->Cell(198,25,"",0);
//         $this->Ln();
		
        
		$this->SetLeftMargin(30);	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times', '', 16);
		$this->Cell(10,35,"",0,1);
		$this->Cell(2,2,"                       __________________",0);
        $this->Cell(32,2,"Prepared By",0);
		$this->SetFont('Times','B', 12);
		$this->Cell(50,2,''.$school_info_principal_name,0,0, 'L');
		$this->SetFont('Times','', 16);
		$this->Cell(2,2,"                  _________________",0);
		$this->Cell(55,2,"Principal",0);
		$this->SetFont('Times','B', 16);
		$this->Cell(60,2,''.$school_info_principal_signature,0,0, 'L');
	
		$this->Ln();
		$this->Cell(10,25, '',0);
		$this->Ln();
		
		$this->SetLeftMargin(30);	
		$this->SetTextColor(0,0,0);
		$this->SetFont('Times', '', 16);
		$this->Cell(10,0,"",0,1);
		$this->Cell(2,2,"             _____________________",0);
        $this->Cell(30,2,"Dated",0);
		$this->SetFont('Times','B', 12);
		$this->Cell(50,2,''.date("d-m-y"),0,0, 'L');
		$this->SetFont('Times','', 16);
		$this->Cell(2,2,"         _______________________",0);
		$this->Cell(40,2,"Seal",0);
		$this->SetFont('Times','B', 16);
		$this->Cell(60,2,''.$school_info_principal_seal,0,0, 'L');
		
}
function Table1()
{
 global $conn73,$school_info_school_name,$school_info_school_address,$school_info_dise_code,$school_info_school_code,$school_info_registration_code,$school_info_school_district,$school_info_school_city,$school_info_logo,$logo_image;
 

//         if($school_info_logo==null){
// 		$this->Image('../../../images/blank_logo.png',14,17,22,15);
// 		}else{
// 	    $this->Image($logo_image,14,17,22,22);
// 		}
 
// 	    $this->SetFont('','B');
//  // $this->SetLeftMargin(30);
 
  
// 	$this->SetFont('Times','B',11);
//     $this->Cell(80,-12," ",0);
//     $this->Cell(65,3,'',0);
// 	$this->Cell(70,-12,"");
// 	 $this->Ln();
// 	$this->SetFont('Times','B',10);
//     $this->Cell(80,4,"",0);
//     $this->Cell(70,4,"",0);
// 	$this->Cell(65,4,"",0);
// 	$this->Ln();
//     $this->SetFont('Times','B',10);
    
   
	
//     $this->SetFont('Times','B',20);
//     $this->Ln();  
	
//     $this->Cell(70,4,"",0);
// 	$this->Ln();
	
// 	$this->SetFont('Times','B',11);
// 	$this->SetTextColor(0,0,0);
// 	$this->Cell(120,3,"School Code - " . $school_info_school_code,0,0,'L');
// 	$this->Cell(70,3,"Dise Code - " .$school_info_dise_code,0,0,'R');
// 	$this->Ln();  
	
	
// 	$this->SetFont('Times','B',16);
// 	$this->SetTextColor(180,0,0);
//     $this->Cell(190,8,''.$school_info_school_name,0,0,'C');
// 	$this->SetTextColor(255,0,0);
//     $this->Ln(); 
	
// 	$this->SetFont('Times','B',18);
// 	$this->SetTextColor(180,0,0); 
//     $this->Cell(190,9,'DIST.  -  '.strtoupper($school_info_school_district),0,0,'C');
// 	$this->SetTextColor(0,0,0);  
// 	$this->Ln(); 
      
	
//     $this->SetFont('Times','B',12);
// 	$this->SetLeftMargin(0);
	  
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
 //$pdf->Image('backimage111.jpg',0,0,210,300);
 //$pdf->Image('../certificate_image/tc_image.jpg',0,0,210,297);
	//	$pdf->AddPage();
// 		$pdf->SetLineWidth(1);
		$pdf->Ln(0);
		//$pdf->Cell(191,260,'',1,0,'C');
		$pdf->Ln(1);
// 		$pdf->SetLineWidth(0.25);
		$pdf->SetLeftMargin(11);
		$pdf->SetTextColor(0,0,0);
		
		$pdf->Ln(1);
		$pdf->SetTextColor(0,0,0);
		 $pdf->SetFont('Times','B',14);
	//  $pdf->SetLeftMargin(30);
		$pdf->Table1();
		$pdf->Ln(-1);
		$pdf->Table2();
		$pdf->Ln(50);
		
	//	$pdf->SetLeftMargin(-30);


$file_name="TC_".$tc_student_name."_".$tc_student_class.".pdf";
$pdf->Output('I',$file_name);
?>