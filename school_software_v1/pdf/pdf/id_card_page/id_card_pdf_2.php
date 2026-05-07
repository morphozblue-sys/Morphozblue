<?php
include("../../../admin/attachment/session.php");

$que="select * from  school_info_general";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){

	$school_info_school_name = $row['school_info_school_name'];
	$school_info_school_contact_no = $row['school_info_school_contact_no'];
	$school_info_school_address = $row['school_info_school_address'];
	$school_info_school_code = $row['school_info_school_code'];
	$school_info_school_website = $row['school_info_school_website'];

 	$school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
	$logo_image=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$logo_image=str_replace(" ","%20",$logo_image);
	$signature=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_signature;$signature=str_replace(" ","%20",$signature);

	
} 
$page_size_get="A3";
if($page_size_get=="A3"){
require('../fpdf_large1.php');
$horizontal_total_id_card="5";
$vertical_total_id_card="5";
$horizontal_gap_start=1;
$vertical_gap_start=1;

}else{
require('../fpdf.php');
$horizontal_total_id_card="4";
$vertical_total_id_card="3";
$horizontal_gap_start=0.5;
$vertical_gap_start=2;
}

class PDF extends FPDF
{
function Header()
{
    
}

// Page footer
function Footer()
{
    
	     
	
	
}

function Table1()
{ 

global $conn73,$school_info_school_name,$logo_image,$school_info_school_contact_no,$school_info_logo,$student_name,$student_adress,$student_class,$student_roll_no,$student_date_of_birth,$student_father_contact_number,$student_photo,$student_image,$roll_no,$school_roll_no,$school_info_school_code,$student_gender,$school_info_school_address;
global $horizontal_total_id_card,$signature,$school_info_principal_signature,$vertical_total_id_card,$horizontal_gap_start,$vertical_gap_start,$session1,$school_info_school_website;



$height=84;
$width=52;
$horizontal=0;
$vertical=0;


$roll_no=$_POST['school_id_card_info'];
$count=count($roll_no);
for($j=0;$j<$count;$j++){


$toatl_id_Card_one_page=$vertical_total_id_card*$horizontal_total_id_card;
if($j!=0 && fmod($j,$toatl_id_Card_one_page)==0){
   $this->AddPage(); 
   $horizontal=0;
$vertical=0;
}    
    
 $que1="select * from student_admission_info where student_roll_no='$roll_no[$j]' and session_value='$session1'";
$run1=mysqli_query($conn73,$que1);
while($row1=mysqli_fetch_assoc($run1)){//print_r($row1);
	$student_name=$row1['student_name'];
	$student_father_name=$row1['student_father_name'];
	$student_mother_name=$row1['student_mother_name'];
	$student_class=$row1['student_class'];
	$student_admission_number=$row1['student_admission_number'];
	$student_roll_no=$row1['student_roll_no'];
	$student_class_section=$row1['student_class_section'];
	$student_scholar_number=$row1['student_scholar_number'];
	$school_roll_no=$row1['school_roll_no'];
	$student_guardian_name=$row1['student_guardian_name'];
	$student_gender=$row1['student_gender'];
	$session_value=$row1['session_value'];
	$student_adress=$row1['student_adress'];
	$student_date_of_birth1=$row1['student_date_of_birth'];
	if($student_date_of_birth1!=''){
	$student_date_of_birth2=explode("-",$student_date_of_birth1);
	$student_date_of_birth=$student_date_of_birth2[2]."-".$student_date_of_birth2[1]."-".$student_date_of_birth2[0];
	}else{
	$student_date_of_birth='';
	}
	$student_father_contact_number=$row1['student_father_contact_number'];
    $student_id_generate=$row1['student_id_generate'];

}
$que1="select * from student_admission_info where student_roll_no='$roll_no[$j]' and session_value='$session1'";
$run1=mysqli_query($conn73,$que1);
while($row1=mysqli_fetch_assoc($run1)){
$student_photo=$row1['student_image_name'];
$student_image=$_SESSION['amazon_file_path']."student_documents/".$student_photo;
  $student_image=str_replace(" ","%20",$student_image);
}

$horizontal_gap=0;
$vertical_gap=$vertical_gap_start;

if($horizontal>($horizontal_total_id_card-1)){
    $vertical++;
    $horizontal=0;
}
if($horizontal==0){
   $horizontal_gap="0"; 
}else{
    $horizontal_gap=$horizontal_gap_start;  
}
$start_x=$horizontal_gap_start+$width*$horizontal+$horizontal_gap*$horizontal;
$start_y=($height+$vertical_gap)*$vertical+$vertical_gap_start;




////////////////////////////////write your code here/////////////////////////////////////////


//	$this->Image('../id_card_image/ID_cards.jpg',$start_x,$start_y,$width,$height);
	$this->Image('../id_card_image/id_card_background_header_1.png',15+$start_x,15+$start_y,52,13.5);
		$this->Image('../id_card_image/id_card_background_footer_1.png',15+$start_x,83+$start_y,52,16);
	if($school_info_logo==null){
		//$this->Image('../../../images/blank_logo.png',15+$start_x,12+$start_y,10,10);
		}else{
		$this->Image($logo_image,16+$start_x,27+$start_y,12,12,'png');
	
		}

		
		if($student_photo==null){
		$this->Image('../../../images/blank.jpg',30+$start_x,35+$start_y,21,21);
		}else{
		$this->Image($student_image,30+$start_x,35+$start_y,21,21);
	
		}
		
	//	$this->Image($signature,54+$start_x,81+$start_y,12,8);
		
     $this->SetXY($start_x+15,$start_y+15);
		$this->SetFont('Times','B',8);
		$this->SetTextColor(0,0,0);
	    $this->Cell(52,84,'',1,0,'L');
	    
	    
	     $this->SetXY($start_x+30,$start_y+35);
		$this->SetFont('Times','B',8);
		$this->SetTextColor(0,0,0);
	    $this->Cell(21,21,'',1,0,'L');

        $this->SetXY($start_x+15,$start_y+15);
		$this->SetFont('Times','B',8);
		$this->SetTextColor(0,0,0);
	    $this->Cell(26,4,'School Code',0,0,'L');
	    $this->Cell(25,4,''.$school_info_school_code,0,0,'R');
			
        $this->SetXY($start_x+15,$start_y+17);
		$this->cell(51,5,'Website-'.$school_info_school_website,0,0,'C');
	

         $this->SetXY($start_x+15,$start_y+23);	
		$this->SetFont('Times','B',12);
		$this->SetTextColor(79,4,128);
		$this->Multicell(52,4,''.$school_info_school_name,0,'C');
		
		$this->SetXY($start_x+15,$start_y+30);	
		$this->SetFont('Times','',8);
		$this->SetTextColor(78,4,128);
		$this->Multicell(52,5,''.$school_info_school_address,0,'C');
			
		
         $this->SetXY($start_x+15,$start_y+57);	
		$this->SetFont('Times','B',9);
		$this->SetTextColor(79,4,128);
		$this->Cell(51,4,''.$student_name,0,0,'C');
	

        $this->SetXY($start_x+15,$start_y+61);	
		$this->SetFont('Times','B',8);
		$this->SetTextColor(79,4,128);
		if($student_gender=='Male'){
		$this->Cell(52,3.5,'S/O '.$student_father_name,0,0,'C');
		}elseif($student_gender=='Female'){
 		$this->Cell(52,3.5,'D/O '.$student_father_name,0,0,'C');
 		}else{
 		$this->Cell(52,3.5,''.$student_father_name,0,0,'C');
 		}
        $this->SetXY($start_x+20,$start_y+65);	
		$this->Cell(15,4,'Class',0,0,'L');
		$this->Cell(27,4,': '.$student_class,0,0,'L');
		
		$this->SetXY($start_x+20,$start_y+69);	
		$this->Cell(15,4,'Student Id',0,0,'L');
		$this->Cell(27,4,': '.$student_roll_no,0,0,'L');
		
		
		$this->SetXY($start_x+20,$start_y+73);	
		$this->Cell(15,4,'D.O.B.',0,0,'L');
		$this->Cell(27,4,': '.$student_date_of_birth,0,0,'L');
		
		
		$this->SetXY($start_x+20,$start_y+77);	
		$this->Cell(15,4,'Mobile',0,0,'L');
		$this->Cell(27,4,': '.$student_father_contact_number,0,0,'L');
		
		
		
        $this->SetXY($start_x+20,$start_y+81);	
		$this->cell(12,4,'Address',0,0,'L');
		$this->Multicell(34,4,': '.ucwords($student_adress),0,'L');
	
	    
		
		$this->SetTextColor(0,0,0);
        $this->SetXY($start_x+15,$start_y+91);
		$this->cell(50,5,'Principal',0,0,'R');
	
		$this->SetTextColor(0,0,0);
        $this->SetXY($start_x+15,$start_y+94);
		$this->cell(50,5,'School Contact-'.$school_info_school_contact_no,0,0,'C');
		 
		
		
	
	
////////////////////////////////write your code here/////////////////////////////////////////		
$horizontal++;		
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
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Times','',14);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
	
	//  $pdf->SetLeftMargin(30);
	    $pdf->Ln();
		$pdf->Table1();
	
$file_name="id_cards_".$student_class.".pdf";
$pdf->Output('I',$file_name);
?>