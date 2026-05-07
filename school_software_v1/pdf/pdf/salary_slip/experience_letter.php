<?php
include("../../../admin/attachment/session.php");

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
//$school_info_school_website=$row12['school_info_school_website'];
$school_info_dise_code=$row12['school_info_dise_code'];
$school_info_school_code=$row12['school_info_school_code'];
$school_info_registration_code=$row12['school_info_registration_code'];
}


$query121="select * from school_info_general";
$run121=mysqli_query($conn73,$query121) or die(mysqli_error($conn73));
while($row121=mysqli_fetch_assoc($run121)){
$school_info_principal_seal=$row121['school_info_principal_seal_name'];
$school_info_principal_signature=$row121['school_info_principal_signature_name'];
$school_info_logo=$row121['school_info_logo_name'];
$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
}

$s_no=$_GET['s_no'];
$query="select * from employee_info where s_no='$s_no'";
$run=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){

	$emp_name = $row['emp_name'];
	$emp_gender = $row['emp_gender'];
	if($emp_gender=='Male'){
	    $so_do_co="S/O";
	}elseif($emp_gender=='Female'){
	    $so_do_co="D/O / S/O";
	}else{
	    $so_do_co="C/O";
	}
	$emp_father = $row['emp_father'];
	$emp_mobile = $row['emp_mobile'];
	$emp_doj1 = $row['emp_doj'];
	if($emp_doj1!=''){
	$emp_doj2=explode("-",$emp_doj1);
	$emp_doj=$emp_doj2[2]."-".$emp_doj2[1]."-".$emp_doj2[0];
	}else{
	$emp_doj=$row['emp_doj'];
	}
	$emp_designation = $row['emp_designation'];
	//$emp_pan_card_no = $row['emp_pan_card_no'];
	//$emp_bank_name = $row['emp_bank_name'];
	//$emp_account_no = $row['emp_account_no'];
	//$emp_basic_salary = $row['emp_basic_salary'];
	//$emp_pf_number = $row['emp_pf_number'];
	//$emp_photo = $row['emp_photo'];
    $emp_uid_no = $row['emp_uid_no'];
    $emp_subject_preferred = $row['emp_subject_preferred'];
    $emp_drop_date1 = $row['emp_drop_date'];
    if($emp_drop_date1!=''){
	$emp_drop_date2=explode("-",$emp_drop_date1);
	$emp_drop_date=$emp_drop_date2[2]."-".$emp_drop_date2[1]."-".$emp_drop_date2[0];
	}else{
	$emp_drop_date=$row['emp_drop_date'];
	}
	//$path="../../documents/Employee/".$emp_id;		
}
require('../fpdf1.php');
class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

// Page header
function Header()
{
$this->Image('../certificate_image/experience_certificate.jpg',1,1,295,208);	
}

// Page footer
function Footer()
{
    $this->SetXY(30,185);
	$this->SettextColor(237,45,0);
$this->Cell(70,10,'Teacher Signature',0,0,'C');	
$this->Cell(100,10,'',0,0,'C');
$this->Cell(70,10,'Administrator Signature',0,0,'C');
		
		
		
		
}   

function Table1()
{
    
    global $conn73,$school_info_school_name,$school_info_school_state,$school_info_school_district,$school_info_school_city,$school_info_school_pincode,$school_info_school_address,$school_info_school_contact_no,$school_info_school_email_id,$school_info_dise_code,$school_info_school_code,$school_info_registration_code,$emp_name,$emp_gender,$emp_father,$emp_mobile,$emp_doj1,$emp_doj2,$emp_doj,$emp_designation,$emp_uid_no,$emp_subject_preferred,$emp_drop_date,$so_do_co,$school_info_principal_seal,$school_info_principal_signature,$path1;
    
	$this->SettextColor(180,0,0);
	$this->SetFont('Times','U',32);
	$this->Cell(5,5,'',0,0,'C');
	$this->Ln();
	$this->Cell(90,10,'',0,0,'C');  
	$this->Cell(100,15,''.$school_info_school_name,0,0,'C');
		$this->Ln();
	$this->Cell(90,5,'',0,0,'C');  
		$this->SetFont('Times','',18); 
	$this->Cell(100,9,'    '.$school_info_school_address.'  '.$school_info_school_district,0,0,'C');
	$this->Ln();
	$this->Cell(90,5,'                                                                                                                           '.$school_info_school_state.' - '.$school_info_school_pincode,0,0,'C');  
	$this->Ln();
	$this->SettextColor(30,144,255);
	$this->SetFont('Times','U',28);
	$this->Cell(100,5,'',0,0,'C');
	$this->Ln();
	
	$this->Cell(90,10,'',0,0,'C');  
	$this->Cell(100,15,'Teacher Experience Certificate',0,0,'C');
	$this->Ln();
	$this->SetFont('Times','I',18);
	$this->Cell(90,10,'',0,0,'C');
		$this->SettextColor(0,0,0);
	$this->Cell(100,10,'To Whome It May Concern:',0,0,'C');
	$this->Ln();
	$this->Cell(35,10,'',0,0,'C');  
	$this->Cell(50,10,'This is to certify that',0,0,'C');
	$this->SetFont('Times','I',15);
	$this->Cell(85,10,''.strtoupper($emp_name),0,0,'C');
	$this->Cell(15,10,''.$so_do_co,0,0,'C');
	$this->Cell(75,10,''.strtoupper($emp_father),0,0,'C');
	$this->Ln();
	$this->Cell(50,10,'',0,0,'C');
	$this->Cell(50,10,'has worked in ',0,0,'C');
	$this->Cell(120,10,''.strtoupper($school_info_school_name),0,0,'C');
	$this->Cell(20,10,'as',0,0,'C');
	$this->Ln();
	$this->Cell(55,10,'',0,0,'C');
	$this->Cell(65,10,'"'.ucfirst($emp_subject_preferred).' Teacher"',0,0,'C');
	$this->Cell(20,10,'from   ',0,0,'C');
	$this->Cell(70,10,$emp_doj.'   to   '.$emp_drop_date.' .',0,0,'C');
	$this->Ln();
	$this->Cell(50,10,'',0,0,'C');
	$this->Cell(190,10,'He / She TAUGHT    '.strtoupper($emp_subject_preferred).'    Classes.',0,0,'C');
	//$this->Cell(120,10,'Classes from'.'     '.'to'.'    '.'Classes.',0,0,'C');
	$this->Ln();
	$this->Cell(60,10,'',0,0,'C');
	$this->Cell(160,10,'He / She has shown the best possible results with good academic ',0,0,'C');
	$this->Ln();
	$this->Cell(50,10,'',0,0,'C');
	$this->Cell(180,10,'performance. He / She has been very innovative in his / her proffession and his / her ',0,0,'C');
	$this->Ln();
	$this->Cell(50,10,'',0,0,'C');
	$this->Cell(180,10,'performence in the School has been pleasent.',0,0,'C');
	$this->Ln();
	$this->Cell(70,10,'',0,0,'C');
	$this->Ln();
	$this->Cell(50,10,'',0,0,'C');
	$this->Cell(180,10,'We wish to his / her bright future & good luck in his / her career.',0,0,'C');
	$this->Ln(); 
	$this->Cell(40,10,'',0,0,'C');
	$this->Cell(20,10,'Name:',0,0,'C');
	$this->Cell(70,10,''.strtoupper($emp_name),0,0,'C');
	$this->Cell(10,10,'',0,0,'C');
	$this->Cell(100,10,'Join from'.'  '.$emp_doj.'  to  '.'  '.$emp_drop_date,0,0,'C');
	$this->Ln();
	$this->Cell(40,10,'',0,0,'C');
	$this->Cell(40,10,'Designation: '.$emp_designation,0,0,'C');
	$this->Image($path1,14,12,25,23,'jpeg');	
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

$pdf->Output('');
?>