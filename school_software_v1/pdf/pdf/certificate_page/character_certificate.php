<?php
require('../fpdf.php');
//R
include("../../../admin/attachment/session.php");
$character_student_roll_no=$_GET['id'];
$query="select * from character_certificate where s_no='$character_student_roll_no'";
$run=mysqli_query($conn73,$query) or die(mysql_error());
while($row=mysqli_fetch_assoc($run)){
$character_student_name = $row['character_student_name'];
//$character_student_father_name = $row['character_student_father_name'];
//$character_student_father_name = $row['character_student_mother_name'];
$character_school_name = $row['character_school_name'];
$character_current_year_from = $row['character_current_year_from'];
$character_current_year_to = $row['character_current_year_to'];
$character_type = $row['character_type'];
$character_issue_date = $row['character_issue_date'];
$student_roll_no = $row['character_student_roll_no'];
$s_no = $row['s_no'];
}
$query1="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
$run1=mysqli_query($conn73,$query1);
while($row1=mysqli_fetch_assoc($run1)){
$character_student_mother_name =$row1['student_mother_name'];
$character_student_father_name =$row1['student_father_name'];
}
$query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysql_error());
        while($row=mysqli_fetch_assoc($run1)){
        $school_info_school_name = $row['school_info_school_name'];
        $school_info_school_code=$row['school_info_school_code'];
        $school_info_school_contact_no=$row['school_info_school_contact_no'];
        $school_info_school_address=$row['school_info_school_address'];
        $school_info_school_district=$row['school_info_school_district'];
        $school_info_school_state=$row['school_info_school_state'];
        $school_info_registration_code = $row['school_info_registration_code'];
        $school_info_dise_code = $row['school_info_dise_code'];
        $school_info_school_email_id = $row['school_info_school_email_id'];
$school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
	
}  
	$que1="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
	$run1=mysqli_query($conn73,$que1);
	while($row1=mysqli_fetch_assoc($run1)){
	$student_photo=$row1['student_image'];
	$student_image="data:image/jpeg;base64,".$student_photo;
	}
class PDF extends FPDF
{

protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function Header()
{
global $school_info_school_name,$school_info_school_code,$school_info_school_contact_no;

}

function footer()
{ 

}

function Table1()
{
 global $s_no,$school_info_registration_code,$character_student_mother_name,$character_student_father_name,$school_info_dise_code,$school_info_school_email_id,$school_info_school_district,$student_father_name,$student_mother_name,$conn73,$character_type,$character_current_year_to,$character_current_year_from,$character_school_name,$character_student_father_name,$character_student_name,$path1,$school_info_logo,$school_info_school_name,$school_info_school_address,$school_info_school_district,$school_info_school_state;


       $this->Cell(190,-2,'',0,0,'C');
       $this->Ln();
       $this->Cell(0.1,0,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','',16);
       $this->Cell(95,8,'Dise Code : '.$school_info_dise_code,0,0,'L');
       $this->Cell(95,8,'Affiliation No.: '.$school_info_registration_code,0,0,'R');
       $this->Ln();
    
        if($school_info_logo==null){
        $this->Image('../../../images/blank_logo.png',90,58,32,33);
        }else{
        $this->Image($path1,9,21,36,30,'jpeg');
        //$this->Image($path1,184,21,25,26,'jpeg');
        }    
        
       $this->Cell(190,10,'',0,0,'C');
       $this->Ln();
       $this->Cell(0.1,0,'',0,0,'C');
       $this->SetTextColor(50, 137, 168);
       $this->SetFont('Times','',20);
       $this->Cell(20,12,'',0,0,'C');
       $this->Cell(190,12,''.$school_info_school_name,0,0,'C');
       $this->Ln();
       
       $this->Cell(190,1,'',0,0,'C');
       $this->Ln();
       $this->Cell(0.1,0,'',0,0,'C');
       $this->SetTextColor(50, 137, 168);
       $this->SetFont('Times','',18);
       $this->Cell(40,8,'',0,0,'C');
       $this->Cell(150,8,'Distt-  '.$school_info_school_district,0,0,'C');
       $this->Ln();
       
       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(0.1,0,'',0,0,'C');
       $this->SetTextColor(50, 137, 168);
       $this->SetFont('Times','',16);
       $this->Cell(40,6,'',0,0,'C');
       $this->Cell(150,8,'Email :  '.$school_info_school_email_id,0,0,'C');
       $this->Ln();
       
       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(0.1,0,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','B',16);
       $this->Cell(190,5,'__________________________________________________________________________',0,0,'C');
       $this->Ln();
       
       $Curent_date = date('d-m-Y');
       $this->Cell(190,4,'',0,0,'C');
       $this->Ln();
       $this->Cell(0.1,0,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','',16);
       $this->Cell(95,8,'Sr. No. : '.$s_no,0,0,'L');
       $this->Cell(95,8,'Date : '.$Curent_date,0,0,'R');
       $this->Ln();

       $this->Cell(190,15,'',0,0,'C');
       $this->Ln();
       $this->Cell(0.1,0,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','B',30);
       $this->Cell(1,8,'                  __________________',0,0,'');
       $this->Cell(190,8,'Character Certificate',0,0,'C');
       $this->Ln();
       
       $this->Cell(190,20,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','B',16);
       $this->Cell(1,12,'                                                     __________________________________________',0,0,'');
       $this->SetFont('Times','',15);
       $this->Cell(73,10,'This is to certify that Master/Miss ',0,0,'');
       $this->SetTextColor(50, 137, 168);
       $this->SetFont('Times','I',14);
       $this->Cell(75,10,''.$character_student_name,0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','',15);
       $this->Cell(45,10,'',0,0,'');
       $this->Ln();

       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('Times','B',15);
       $this->Cell(1,12,'                                  _____________________                _____________________',0,0,'');
       $this->SetFont('Times','',15);
       $this->Cell(46,10,'Son/ daughter of Mr.',0,0,'');
       $this->SetFont('Times','I',14);
       $this->SetTextColor(50, 137, 168);
       $this->Cell(55,10,''.$character_student_father_name,0,0,'C');
       $this->SetFont('Times','',15);
       $this->SetTextColor(0, 0, 0);
       $this->Cell(20,10,'and Mrs.',0,0,'');
       $this->SetFont('Times','I',14);
       $this->SetTextColor(50, 137, 168);
       $this->Cell(55,10,''.$character_student_mother_name,0,0,'C');
       $this->SetFont('Times','',15);
       $this->SetTextColor(0, 0, 0);
       $this->Cell(17,10,'was ',0,0,'');
       $this->Ln();       


       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','',15);
       $this->Cell(1,12,'                                  ______________________      ________________________',0,0,'');
       $this->Cell(46,10,'Regular Student from ',0,0,''); 
       $this->SetFont('Times','I',15);
       $this->SetTextColor(50, 137, 168);
       $this->Cell(58,10,''.$character_current_year_from,0,0,'C');
       $this->SetFont('Times','',15);
       $this->SetTextColor(0,0,0);
       $this->Cell(11,10,'to',0,0,'');
       $this->SetFont('Times','I',15);
       $this->SetTextColor(50, 137, 168);
       $this->Cell(58,10,''.$character_current_year_to,0,0,'C');
       $this->SetFont('Times','',15);
       $this->SetTextColor(0,0,0);
       $this->Cell(20,10,'  his/ her',0,0,'');
       $this->Ln();

       $this->Cell(190,0,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','',15);
       $this->Cell(1,12,'                                              ____________________',0,0,'');
       $this->Cell(60,10,'character and conduct were',0,0,'');
       $this->SetFont('Times','I',15);
       $this->SetTextColor(50, 137, 168);
       $this->Cell(52,10,''.$character_type,0,0,'C');
       $this->SetTextColor(0,0,0);
       $this->SetFont('Times','',15);
       $this->Cell(81,10,'  during his / her  stay  in this school.',0,0,'');
       $this->Ln();


       $this->Cell(190,10,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetFont('Times','I',20);
       $this->SetTextColor(0, 0, 0);
       $this->Cell(194,8,"'School wished for your bright future'",0,0,'C');
       $this->Ln();
       
       $this->Cell(190,35,'',0,0,'C');
       $this->Ln();
       $this->Cell(-2,10,'',0,0,'C');
       $this->SetFont('Times','B',20);
       $this->SetTextColor(0, 0, 0);
       $this->Cell(95,8,"           Verified",0,0,'L');
       $this->Cell(80,8,"Principal",0,0,'R');
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
$pdf->Output('I');
?>