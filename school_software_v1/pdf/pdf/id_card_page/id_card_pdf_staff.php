<?php
include("../../../admin/attachment/session.php");
$que="select * from  school_info_general";
$run=mysqli_query($conn73,$que);
while($row=mysqli_fetch_assoc($run)){//echo print_r($row);

	$school_info_school_name = $row['school_info_school_name'];
	$school_info_school_contact_no = $row['school_info_school_contact_no'];
	$school_info_school_address = $row['school_info_school_address'];
	$school_info_school_code = $row['school_info_school_code'];
	$school_info_dise_code = $row['school_info_dise_code'];
	}

$query121="select * from school_info_general";
$run121=mysqli_query($conn73,$query121) or die(mysqli_error($conn73));
while($row121=mysqli_fetch_assoc($run121)){
 	$school_info_principal_seal=$row121['school_info_principal_seal_name'];
	$school_info_principal_signature=$row121['school_info_principal_signature_name'];
	$school_info_logo=$row121['school_info_logo_name'];
	$logo_image=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$logo_image=str_replace(" ","%20",$logo_image);
     $signature=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_signature;$signature=str_replace(" ","%20",$signature);

	
} 
$page_size_get="A4";
if($page_size_get=="A3"){
require('../fpdf_large1.php');
$horizontal_total_id_card="5";
$vertical_total_id_card="5";
$horizontal_gap_start=0.5;
$vertical_gap_start=0.5;

}else{
require('../fpdf.php');
$horizontal_total_id_card="3";
$vertical_total_id_card="3";
$horizontal_gap_start=10;
$vertical_gap_start=10;
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

global $conn73,$school_info_school_name,$logo_image,$school_info_school_contact_no,$school_info_dise_code,$emp_mobile,$emp_designation,$signature,$school_info_logo,$student_name,$student_class,$emp_address,$student_roll_no,$student_date_of_birth,$student_father_contact_number,$student_photo,$student_image,$roll_no,$school_roll_no,$school_info_school_code,$student_gender,$school_info_school_address;
global $horizontal_total_id_card,$vertical_total_id_card,$horizontal_gap_start,$school_info_dise_code,$School_info_school_address,$vertical_gap_start;


$height=86;
$width=52;
$horizontal=0;
$vertical=0;





if($_GET['staff_id_card_info']){
$employee_id=$_GET['staff_id_card_info'];
$employee_id=array($employee_id);
}else{
$employee_id=$_POST['staff_id_card_info'];	
}
$count=count($employee_id);

for($j=0;$j<$count;$j++){


$toatl_id_Card_one_page=$vertical_total_id_card*$horizontal_total_id_card;
if($j!=0 && fmod($j,$toatl_id_Card_one_page)==0){
   $this->AddPage(); 
   $horizontal=0;
$vertical=0;
}    
    
    
    
$que1="select * from employee_info where emp_id='$employee_id[$j]'";
$run1=mysqli_query($conn73,$que1);
while($row1=mysqli_fetch_assoc($run1)){//echo print_r($row1);
   
	$emp_name=$row1['emp_name'];
	$emp_categories=$row1['emp_categories'];
	$emp_id=$row1['emp_id'];
	$emp_dob1=$row1['emp_dob'];
	$emp_dob2=explode("-",$emp_dob1);
	$emp_dob=$emp_dob2[2]."-".$emp_dob2[1]."-".$emp_dob2[0];
	$emp_mobile=$row1['emp_mobile'];
     $emp_designation=$row1['emp_designation'];
    $emp_address=$row1['emp_address'];
$emp_photo=$row1['emp_photo_name'];
$emp_photo1=$_SESSION['amazon_file_path']."employee_document/".$emp_photo;$emp_photo1=str_replace(" ","%20",$emp_photo1);

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
            //$this->Image('../id_card_image/imageedit_6_2225713709.png',5+$start_x,5+$start_y,52,84);
        	$this->Image('../id_card_image/id_card_background_header_4.png',5+$start_x,5+$start_y,52,13.5);
			$this->Image('../id_card_image/id_card_background_footer_4.png',5+$start_x,73+$start_y,52,16);
		
	if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',8+$start_x,28+$start_y,18,18);
		}else{
		$this->Image($logo_image,5+$start_x,19+$start_y,12,12,'png');
		//	$this->Image($signature,47+$start_x,77+$start_y,9,8,'png');
	
		}

		
		if($emp_photo==null){
		
		$this->Image('../../../images/student_blank.png',26+$start_x,24+$start_y,18,18);
		}else{
		$this->Image($emp_photo1,23+$start_x,24+$start_y,18,18,'jpeg');
	
		}
		 $this->SetXY($start_x+5,$start_y+5);	
		$this->SetFont('Times','B',7);
		$this->SetTextColor(0,0,0);
			$this->Cell(52,84,'',1,0,'L');
			
			$this->SetXY($start_x+23,$start_y+24);	
		$this->SetFont('Times','B',7);
		$this->SetTextColor(0,0,0);
			$this->Cell(18,18,'',1,0,'L');
			
			
			
		 $this->SetXY($start_x+5,$start_y+5);	
		$this->SetFont('Times','B',7);
		$this->SetTextColor(0,0,0);
			$this->Cell(25,6,'School Code :- ',0,0,'L');
				$this->Cell(26,6,''.$school_info_school_code,0,0,'R');

		
		
		 $this->SetXY($start_x+5,$start_y+15);	
		$this->SetFont('Times','B',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(52,4,''.$school_info_school_name,0,'C');
		
		$this->SetXY($start_x+6,$start_y+21);	
		$this->SetFont('Times','B',8);
		$this->SetTextColor(0,0,0);
		$this->Cell(50,3,''.$School_info_school_address,0,0,'C');



        $this->SetXY($start_x+6,$start_y+42);	
		$this->SetFont('Times','B',10);
		$this->SetTextColor(0,0,0);
		$this->Cell(52,6,''.$emp_name,0,0,'C');

        $this->SetXY($start_x+8,$start_y+47);	
		$this->SetFont('Arial','B',9);
		$this->SetTextColor(0,0,0);
		$this->Cell(19,4,'Designation',0,0,'L');
		$this->MultiCell(30,4,': '.$emp_designation,0,'L');
		$this->Ln();

        $this->SetXY($start_x+8,$start_y+55);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',9);
		$this->Cell(19,4,'Emp-Id',0,0,'L');
		$this->Cell(52,4,': '.$emp_id,0,0,'L');
		
		 $this->SetXY($start_x+8,$start_y+59);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',9);
		$this->Cell(19,4,'D.O.B',0,0,'L');
		$this->Cell(52,4,': '.$emp_dob,0,0,'L');
		
		 $this->SetXY($start_x+8,$start_y+63);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',9);
		$this->Cell(19,4,'Mobile No.',0,0,'L');
		$this->Cell(52,4,': '.$emp_mobile,0,0,'L');
		
		$this->SetXY($start_x+8,$start_y+67);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',9);
        	$this->Cell(19,4,'Address.',0,0,'L');
        	$adjust="$emp_address";
		$this->MultiCell(30,4,': '.$adjust,0,'L');
		
		$this->SetXY($start_x+11,$start_y+83);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',8);
		$this->Cell(40,4,'Contact No.'.$school_info_school_contact_no,0,0,'C');
		
	
		
		
		
      	
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
?>df->Output('I',$file_name);
?>