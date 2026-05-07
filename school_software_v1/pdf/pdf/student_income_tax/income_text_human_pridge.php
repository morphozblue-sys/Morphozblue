<?php
include("../../../admin/attachment/session.php");
require('../fpdf.php');

echo $student_roll_no=$_POST['student_data'];
$total_student=0;
for($k=0; $k<count($student_roll_no); $k++){
$sql=mysqli_query($conn73,"select * from student_admission_info where student_roll_no='$student_roll_no[$k]' and session_value='$session1'");
while($res=mysqli_fetch_assoc($sql)){
    $student_name[$total_student]=$res['student_name'];
    $student_father_name[$total_student]=$res['student_father_name'];
    $student_class[$total_student]=$res['student_class'];
    $student_class_section[$total_student]=$res['student_class_section'];
    $student_mother_name[$total_student]=$res['student_mother_name'];
    $student_adress[$total_student]=$res['student_adress'];
    $student_district[$total_student]=$res['student_district'];
    $student_admission_number[$total_student]=$res['student_admission_number'];
$que1="select * from student_admission_info where student_roll_no='$student_roll_no[$k]'";
$run1=mysqli_query($conn73,$que1);
while($row1=mysqli_fetch_assoc($run1)){
	 $student_photo[$total_student]=$row1['student_image_name'];
	 $student_image[$total_student]=$_SESSION['amazon_file_path']."student_documents/".$student_photo[$total_student];$student_image[$total_student]=str_replace(" ","%20",$student_image[$total_student]);
	}
}
$total_student++;  
}
$query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
        while($row=mysqli_fetch_assoc($run1)){
        $school_info_school_name = $row['school_info_school_name'];
        $school_info_school_district = $row['school_info_school_district'];
        $school_info_school_address = $row['school_info_school_address'];
        $fees_category = $row['fees_category'];
	    $school_info_school_name = strtoupper($school_info_school_name);
		$school_info_school_district = strtoupper($school_info_school_district);
}
$query121="select * from school_info_general";
$run121=mysqli_query($conn73,$query121) or die(mysqli_error($conn73));
while($row121=mysqli_fetch_assoc($run121)){
 	$school_info_principal_seal=$row121['school_info_principal_seal_name'];
	$school_info_principal_signature=$row121['school_info_principal_signature_name'];
	$school_info_logo=$row121['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
}
//print_r($student_roll_no);
class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';
 

function Header()
{

}


function Footer()
{
		
}   

function Table1()
{
global  $fees_category,$session1,$filter37,$student_admission_number,$student_class,$student_roll_no,$student_class_section,$student_district,$student_adress,$student_mother_name,$student_father_name,$student_name,$school_info_school_address,$student_photo,$student_image,$total_student,$school_info_school_name,$school_info_school_district,$school_info_logo,$path1;
   
   $s_no=0;
	$sql4=mysqli_query($conn73,"select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37");
	while($res4=mysqli_fetch_assoc($sql4)){
	  $fee_type[$s_no]=$res4['fee_type'];  
	  $fee_code[$s_no]=$res4['fee_code'];  
	  $s_no++;
	}
	
	$sql5=mysqli_query($conn73,"select * from school_info_".$fees_category."_fees where  fees_type_name!='' and session_value='$session1'$filter37");
	$ab=0;
	while($res5=mysqli_fetch_assoc($sql5)){
	  $fees_type_name[$ab]=$res5['fees_type_name'];  
	  $fees_code[$ab]=$res5['fees_code'];  
	  $ab++;
	}
   
   $session2=explode("_",$session1);
   $session=$session2[0].' - '.$session2[1];
   for($f=0; $f<$total_student; $f++){
	$this->SetFont('Times','',20);
	$this->SettextColor(0,0,0);
	$this->Cell(190,5,''.$school_info_school_name,0,0,'C');
	$this->Ln();
	
	$this->SetFont('Times','',16);
	$this->SettextColor(0,0,0);
	$this->Cell(190,10,''.$school_info_school_address,0,0,'C');
	$this->Ln();
	
	$this->SetFont('Times','',16);
	$this->SettextColor(0,0,0);
	$this->Cell(190,5,'',0,0,'C');
	$this->Ln();
	
	if($school_info_logo!=''){
	    $this->image($path1,10,15,25,25,'.jpeg');
	}else{
	   $this->image("../blank.jpg",10,15,25,25); 
	}
	
	$this->SetFont('Times','',22);
	$this->SettextColor(0,0,0);
	$this->Cell(190,10,'For Income Tax',0,0,'C');
	$this->Ln();
	
	$this->SetFont('Times','',22);
	$this->SettextColor(0,0,0);
	$this->Cell(190,-9,'________________',0,0,'C');
	$this->Ln();
	
	$this->SetFont('Times','',22);
	$this->SettextColor(0,0,0);
	$this->Cell(190,15,'',0,0,'C');
	$this->Ln();
	
	$this->SetFont('Times','',12);
	$this->SettextColor(0,0,0);
	$this->Cell(190,10,'Print Date    '.date('d-m-Y'),0,0,'R');
	$this->Ln();
	
	$this->SetFont('Times','B',14);
	$this->SettextColor(0,0,0);
	$this->Cell(190,10,'TO WHOM IT MAY CONCERN',0,0,'C');
	$this->Ln();  
	
	$this->SetFont('Times','B',14);
	$this->SettextColor(0,0,0);
	$this->Cell(190,-9,'_______________________________',0,0,'C');
	$this->Ln();  
	
	if($student_photo[$f]!=''){
	    $this->image($student_image[$f],175,60,25,25,'.jpeg');
	}else{
	   $this->image("../blank.jpg",175,60,25,25); 
	}
	
	$this->SetFont('Times','B',14);
	$this->SettextColor(0,0,0);
	$this->Cell(190,30,'',0,0,'C');
	$this->Ln();  
	
	$this->SetFont('Times','',12);
	$this->SettextColor(0,0,0);
	$this->Cell(1,11,'                                   .............................................................                   .....................................................................',0);
    $this->Cell(39,10,'This is to certify that  ',0,0);
	$this->SetFont('Times','B',11);
	$this->Cell(55,10,''.strtoupper($student_name[$f]),0,0);
	$this->SetFont('Times','',12);
	$this->Cell(30,10,'        Son of Mr.',0,0,'');
	$this->SetFont('Times','B',11);
	$this->Cell(60,10,''.strtoupper($student_father_name[$f]),0,0);
	$this->Ln();  
	$this->SetFont('Times','',12);
    $this->Cell(1,11,'         .......................................                   ........................................................................................................',0);
    $this->Cell(9,10,'Mrs.',0,0,'');
	$this->SettextColor(0,0,0);
	$this->SetFont('Times','B',11);
	$this->Cell(42,10,''.strtoupper($student_mother_name[$f]),0,0,'');
	$this->SetFont('Times','',12);
	$this->Cell(23,10,'Resident of',0,0,'');
	$this->SetFont('Times','B',11);
	$this->Cell(107,10,''.strtoupper($student_adress[$f]),0,0,'');
	$this->SetFont('Times','',12);
	$this->Cell(20,10,'District',0,0,'');
	$this->SetFont('Times','B',11);
	$this->Ln();
	$this->SetFont('Times','',12);
	$this->Cell(1,11,'................................                                ..........................                                         ...........................                                    ...................................',0);
    $this->SetFont('Times','B',11);
    $this->Cell(34,10,''.strtoupper($student_district[$f]),0,0,'');
	$this->SetFont('Times','',12);
    $this->Cell(33,10,'is studying in class',0,0,'');
	$this->SetFont('Times','B',11);
	$this->SettextColor(0,0,0);
	$this->Cell(27,10,' '.$student_class[$f] .' ('.$student_class_section[$f].')',0,0);
	$this->SetFont('Times','',12);
	$this->Cell(46,10,'having admission number',0,0);
	$this->SetFont('Times','B',11);
	$this->Cell(25,10,''.$student_admission_number[$f],0,0);
	$this->SetFont('Times','',12);
	$this->Cell(40,10,' for the academic  ',0,0);
	$this->Ln(); 
	$this->SetFont('Times','',12);
	$this->Cell(1,11,'         .................................................',0);
    $this->Cell(10,10,'Year  ',0,0);
	$this->SetFont('Times','B',11);
	$this->Cell(30,10,''.$session1.'                                    .',0,0);
	$this->Ln(); 
	
		
	$this->SetFont('Times','B',12);
	$this->SettextColor(0,0,0);
	$this->Cell(190,20,'',0,0,'');
	$this->Ln(); 
	
	$this->SetFont('Times','B',12);
	$this->SettextColor(0,0,0);
	$this->Cell(190,7,'Details of paid fees are as follows :- ',0,0,'');
	$this->Ln(); 
	
	$this->SetFont('Times','B',12);
	$this->SettextColor(0,0,0);
	$this->Cell(190,7,'',0,0,'');
	$this->Ln(); 
	
	
	
	
	
	$this->SetFont('Times','B',12);
	$this->SettextColor(0,0,0);
	$this->Cell(50,7,'',0,0,'');
	$this->Cell(50,7,'PARTICULAR ',1,0,'C');
	$this->Cell(50,7,'FEES ',1,0,'C');
	$this->Ln();
$grand_total[$f]=0;
	$sql6=mysqli_query($conn73,"select * from common_fees_student_fee   where  student_roll_no='$student_roll_no[$f]' and session_value='$session1' and fee_status='Active'");
	while($res6=mysqli_fetch_assoc($sql6)){
	  for($j=0;$j<$s_no;$j++)
	  {
	      $fee_head_amount[$j]=0;
	    for($l=0;$l<$ab;$l++)
	    {
	       $fee_head_amount[$j]=$fee_head_amount[$j]+$res6['student_'.$fee_code[$j].'_total_amount_after_discount_month'.$fees_code[$l]];
	    $grand_total[$f]=$grand_total[$f]+$res6['student_'.$fee_code[$j].'_total_amount_after_discount_month'.$fees_code[$l]];
	        
	    }
	  } 
   }
	
	$grand_total=0;
	for($i=0;$i<$s_no;$i++){
	$this->Cell(50,7,'',0,0,'');
	$this->Cell(50,7,''.$fee_type[$i],1,0,'C');
	$this->Cell(50,7,''.$fee_head_amount[$i],1,0,'C');
	$this->Ln();
	$grand_total=$grand_total+$fee_head_amount[$i];
	}
	
	$this->Cell(50,7,'',0,0,'');
	$this->Cell(50,7,'Grand Total',1,0,'C');
	$this->Cell(50,7,''.$grand_total,1,0,'C');
	$this->Ln();
	
   $number = round($grand_total);
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  $this->setFont('Times','','15');          
  $this->Cell(200,20,'IN WORDS  -  '.ucwords($result),0,0,'C'); 
  $this->Ln();
	
   
  $this->Cell(10,35,'',0,0); 
  $this->Ln();
   }
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