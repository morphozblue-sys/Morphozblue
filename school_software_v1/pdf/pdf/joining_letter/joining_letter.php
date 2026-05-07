<?php
include("../../../admin/attachment/session.php");
//$s_no=$_GET['id'];
$emp_id=$_GET['emp_id'];
$query="select * from employee_info where emp_id='$emp_id'";
$run=mysqli_query($conn73,$query) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){

	$emp_name = $row['emp_name'];
	$emp_gender = $row['emp_gender'];
	$emp_mobile = $row['emp_mobile'];
	$emp_doj1 = $row['emp_doj'];
	$emp_doj2=explode("-",$emp_doj1);
	$emp_doj=$emp_doj2[2]."-".$emp_doj2[1]."-".$emp_doj2[0];
	$emp_designation = $row['emp_designation'];
    $emp_address = $row['emp_address'];
    $emp_email = $row['emp_email'];
$emp_photo=$row['emp_photo_name'];
$emp_photo1=$_SESSION['amazon_file_path']."employee_document/".$emp_photo;$emp_photo1=str_replace(" ","%20",$emp_photo1);


	$path="../../documents/Employee/".$emp_id;	
	
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
} 
require('../fpdf.php');

class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

// Page header
function Header()
{
	
}
// Page footer
function Footer()
{

}
function Table1()
{
    
global $emp_name,$emp_gender,$emp_mobile,$emp_doj,$emp_address,$emp_designation,$emp_photo,$emp_photo1,$emp_email,$emp_photo_name,$school_info_school_name,$school_info_school_city,$school_info_school_district,$school_info_school_pincode;
 
 if($emp_photo==null){
		$this->Image('../../../images/blank.jpg',20,30,22,22);
		}else{
		$this->Image($emp_photo1,20,30,22,22,'jpeg');
		}
		
 
 
    $this->SetFont('Times','B',20);
    $this->Cell(190,20,''.$school_info_school_name,0,0,'C');
	$this->Ln();
	$this->SetFont('Times','B',18);
	$this->Cell(190,10,'Joining Letter',0,0,'C');
	$this->Ln();
	$this->Cell(190,6,'',0,0,'L');
	$this->Ln();
	$this->SetFont('Times','B',12);
	$this->Cell(190,6,'Joining Date :'.$emp_doj,0,0,'R');
	$this->Ln();
	$this->SetFont('Times','',12);
	$this->Cell(190,6,'Your name :'.$emp_name,0,0,'R');
	$this->Ln();
	$this->Cell(190,6,'Your Address :'.$emp_address,0,0,'R');
	$this->Ln();
	$this->Cell(190,6,'Phone :'.$emp_mobile.' , Email :'.$emp_email,0,0,'R');
	$this->Ln();
	$this->Cell(190,6,''.date('d/m/Y'),0,0,'L');
	$this->Ln();
	$this->Cell(190,6,' ',0,0,'L');
	$this->Ln();
	$this->Cell(190,6,'To,',0,0,'l');
	$this->Ln();
	$this->Cell(190,6,''.$school_info_school_name,0,0,'L');
	$this->Ln();
	$this->Cell(190,6,''.$school_info_school_city,0,0,'L');
	$this->Ln();
	$this->Cell(190,6,''.$school_info_school_district.',',0,0,'L');
	$this->Ln();
	$this->Cell(190,6,'Pincode :'.$school_info_school_pincode,0,0,'L');
	$this->Ln();
	$this->Cell(190,6,'',0,0,'L');
	
	$this->Ln();
	$this->Cell(190,6,'',0,0,'L');
	$this->Ln();
	$this->Cell(190,10,'',0,0,'L');
	$this->Ln();
	$this->SetFont('Times','BU',13);
	$this->Cell(190,6,'SUB - JOINING LETTER',0,0,'C');
	$this->Ln();
	$this->Cell(190,6,'',0,0,'L');
	$this->Ln();
	$this->SetFont('Times','',12);
	$this->Cell(190,6,'Dear Sir, ',0,0,'L');
	$this->Ln();
	$this->Cell(190,6,'',0,0,'L');
	$this->Ln();
	$this->Cell(10,6,'',0,0,'L');
	$this->Cell(180,6,'I have honor to inform that i am joining the school from today as a '.$emp_designation.' in',0,0,'L');
	$this->Ln();
	$this->Cell(10,6,'',0,0,'L');
	$this->Cell(190,6,'respect to your appoinment letter.',0,0,'L');
	$this->Ln();
	$this->Cell(10,6,'',0,0,'L');
	$this->Cell(190,6,'I Kindly request you to accept my joining letter. ',0,0,'L');
	$this->Ln();
	$this->Cell(190,6,'',0,0,'L');
	$this->Ln();
	$this->Cell(190,6,'Regards,',0,0,'L');
	$this->Ln();
	$this->Cell(190,6,'',0,0,'L');
	$this->Ln();
	$this->Cell(190,6,'[YOUR NAME]',0,0,'L');
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
 
$pdf->Table1();	
$pdf->Output('');
?>