<?php
include("../../../admin/attachment/session.php");

$query123="select * from school_info_general"; 
$run123=mysqli_query($conn73,$query123) or die(mysqli_error($conn73));
while($row123=mysqli_fetch_assoc($run123)){
    $school_info_school_board=$row123['school_info_school_board'];
}
if($school_info_school_board=='CBSE Board'){
    $var ='student_tc_cbse';
}else{
    $var ='student_tc';
}

$s_no=$_GET['id'];
$query="select * from $var where s_no='$s_no'";
$run=mysqli_query($conn73,$query) or die(mysql_error());
while($row=mysqli_fetch_assoc($run)){
    $s_no=$row['s_no'];
    $tc_student_roll_no = $row['tc_student_roll_no'];
    $date_of_school_leaving=date('d-m-Y',strtotime($date_of_school_leaving1));
$query12="select * from student_admission_info where student_roll_no='$tc_student_roll_no' and session_value='$session1'"; 
$run12=mysqli_query($conn73,$query12) or die(mysql_error());
while($row12=mysqli_fetch_assoc($run12)){
    $student_name=$row12['student_name'];
    $student_class=$row12['student_class'];
    $student_address=$row12['student_address'];
    $student_roll_no=$row12['student_roll_no'];
    $student_father_name=$row12['student_father_name'];
    $student_admission_number=$row12['student_admission_number'];
    $student_scholar_number=$row12['student_scholar_number'];
    if($student_admission_number==''){$student_admission_number=$student_scholar_number;}
  }
}
       $query1="select * from  school_info_general";
       $run1=mysqli_query($conn73,$query1) or (mysql_error());
       while($row1=mysqli_fetch_assoc($run1)){
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
       $school_info_school_contact_no=$row1['school_info_school_contact_no'];
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
    
global $student_name,$student_class,$date_of_school_leaving,$student_admission_number,$student_father_name,$date_of_school_leaving,$student_roll_no,$school_info_school_contact_no,$student_address,$school_info_school_name,$school_info_school_address;  

    $this->cell(190,10,"",0);
    $this->Ln();
    $this->SetFont('Times','B',16);
    $this->cell(190,10,"No Dues certificate Letter",0,0,'L');
    $this->Ln();
    $this->cell(190,8,"",0);
    $this->Ln();
    $this->SetFont('Times','B',12);
    $school_info_school_name1=strtoupper("$school_info_school_name");
    $this->cell(95,10,"".$school_info_school_name1,0,0,'L');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->cell(95,8,"".$school_info_school_address,0,0,'L');
    $this->Ln();
    $this->cell(95,8,"".date('d-m-Y'),0,0,'L');
    $this->Ln();
    $this->SetFont('Times','B',12);
    $this->cell(95,8,"".$school_info_school_contact_no,0,0,'L');
    $this->Ln();
    
    $this->SetFont('Arial','',11);
    $this->cell(95,8,"",0,0);
    $this->Ln();
    
    
    
    $this->cell(68,10,"To Whom It May Concern:",0,0);
    $this->Ln();
    
    if($student_gender=='Male'){
        $var="S/O";
    }elseif($student_gender=='Female'){
        $var="D/O";
    }else{
        $var="C/O";
    }
    $this->cell(68,10,"This Letter is to Certify That Mr./ Miss",0,0);
    $this->cell(-3,12,".............................................................................................................",0,0);
    $this->SetFont('Arial','B',11);
    
    $this->cell(70,10,"   ".$student_name.' '.$var.' '.$student_father_name,0,0);
    $this->SetFont('Arial','',11);
    $this->cell(15,10,"                                           ",0,0,'C');
    $this->Ln();
    $this->cell(-3,12,"                                     .........................                                  .............................................................................",0,0);
    $this->cell(35,10,"   with Admission Number",0,0);
    $this->SetFont('Arial','B',11);
    $this->cell(17,10,"            ".$student_admission_number,0,0);
    $this->SetFont('Arial','',11);
    $this->cell(40,10,"                 has no dues towards",0,0);
    $this->SetFont('Arial','B',11);
    $this->cell(46,10,"               ".$school_info_school_name1,0,0);
    $this->Ln();
    
    $this->SetFont('Arial','',11);
    $this->cell(24,10,'as of  Date ',0,0);
    $this->cell(-7,12,"...................                   .................................................................                                 ...............",0,0);
    $this->SetFont('Arial','B',11);
    
   $date = date('d-m-y');
    $this->cell(30,10,'      '.$date,0,0);
    $this->SetFont('Arial','',11);
    $this->cell(20,10,"Mr./ Miss",0,0,'L');
    $this->SetFont('Arial','B',11);
    $this->cell(60,10,"    ".$student_name,0,0);
    $this->SetFont('Arial','',11);
    $this->cell(64,10,"         confirms to his best ",0,0,'L');
    
    $this->Ln();
    $this->cell(66,10,"knowledge that he has surrendered all ",0,0);
    $this->cell(-7,12,"................................................................................................................",0,0);
    $this->SetFont('Arial','B',11);
    $this->cell(130,10,"         ".$school_info_school_name1."",0,0);
    $this->SetFont('Arial','',11);
    $this->SetTextColor(0,191,255);
    $this->cell(23,10," ",0);
    $this->SetTextColor(0,0,0);
    
    $this->Ln();
    $this->cell(190,10,"and cleared all of overdue amount as of the mantioned date. If it turnes out later that some dues have" ,0,0);
    $this->Ln();
    $this->cell(-7,12,"                                       .................................................................                             ........................................",0,0);
    $this->cell(30,10,'       been missed,  Mr./ Miss',0);
    $this->SetFont('Arial','B',11);
    $this->cell(70,10,'                   '.$student_name,0);
    $this->SetFont('Arial','',11);
    $this->cell(35,10,'                shall revert back to',0);
    $this->SetFont('Arial','B',11);
    
    $this->Ln();
    $this->SetFont('Arial','',11);
    $this->cell(-7,12,"...............................................................................                                ",0,0);
    $this->SetFont('Arial','B',11);
    $this->cell(80,10,'       '.$school_info_school_name1,0);
    $this->SetFont('Arial','',11);
    $this->cell(190,10,"             for further settlement.",0,0,'L');
    $this->Ln();
    $this->Ln();
    $this->Ln();
    $this->cell(190,3,"Sincerely,",0,0,'L');
    $this->Ln();
    $this->cell(190,10,"",0,0,'L');
    $this->Ln();
    $this->cell(190,5,"",0,0,'L');
    $this->Ln();
    $this->SetFont('Times','B',15);
    $this->cell(180,10,"Principal",0,0,'R');
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