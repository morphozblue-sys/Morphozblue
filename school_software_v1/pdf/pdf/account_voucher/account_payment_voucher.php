<?php
include("../../../admin/attachment/session.php");

$id=$_GET['id'];
//$session1=$_GET['session'];
$query1="select * from school_info_general";
        $run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
        while($row=mysqli_fetch_assoc($run1)){
        $school_info_school_name = $row['school_info_school_name'];
        $school_info_school_district = $row['school_info_school_district'];
	    $school_info_school_name = strtoupper($school_info_school_name);
		$school_info_school_district = strtoupper($school_info_school_district);
		$school_info_school_code = $row['school_info_school_code'];
	    $school_info_dise_code = $row['school_info_dise_code'];
		$school_info_logo = $row['school_info_logo'];
		$school_info_registration_code = $row['school_info_registration_code'];
		$school_info_school_address = $row['school_info_school_address'];
		$school_info_school_contact_no = $row['school_info_school_contact_no'];
		$school_info_school_email_id = $row['school_info_school_email_id'];
		$school_info_school_website = $row['school_info_school_website'];
		$school_info_school_city = $row['school_info_school_city'];
$school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
}

/*
$query28="select * from student_gate_pass where s_no='$id' and session_value='$session1'";
        
		$run28=mysqli_query($conn73,$query28) or die(mysqli_error($conn73));
        while($row28=mysqli_fetch_assoc($run28)){
        $student_name=$row28['student_name'];
        $student_class=$row28['student_class'];
        $student_roll_no=$row28['student_roll_no'];
        $student_admission_number=$row28['student_admission_number'];
        $student_section=$row28['student_section'];
        $gate_pass_date=$row28['gate_pass_date'];
        $gate_pass_time=$row28['gate_pass_time'];
        $recommender=$row28['recommender'];
        $approver=$row28['approver'];
        $gate_pass_status=$row28['gate_pass_status'];
        $reason_for_leaving=$row28['reason_for_leaving'];
        $last_updated_date=$row28['last_updated_date'];

}*/
                $que="select * from account_expence_info where account_status='Active' and s_no='$id' and session_value='$session1'";
				$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				$s_no=$row['s_no'];
				$account_amount_type=$row['account_amount_type'];
				$account_customer_date1=$row['account_customer_date'];
				$account_customer_date = date('d-m-Y',strtotime($account_customer_date1));
				$account_customer_name=$row['account_customer_name'];
				$account_customer_address=$row['account_customer_address'];
				$account_customer_designation=$row['account_customer_designation'];
				$account_customer_total_amount=$row['account_customer_total_amount'];
				$office_account_sno=$row['office_account_sno'];
				$query21="select * from account_office_bank_account where s_no='$office_account_sno'";
                $run21=mysqli_query($conn73,$query21) or die(mysqli_error($conn73));
                while($row21=mysqli_fetch_assoc($run21)){
                	$bank_account_no=$row21['bank_account_no'];
                	$bank_name=$row21['bank_name'];
                	$bank_branch_name=$row21['bank_branch_name'];
                	$bank_ifsc_code=$row21['bank_ifsc_code'];
                	$bank_account_holder_name=$row21['bank_account_holder_name'];
                }
}
$query2="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
        
		$run2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
        while($row2=mysqli_fetch_assoc($run2)){
        $student_roll_no=$row2['student_roll_no'];
        $school_roll_no=$row2['school_roll_no'];
		$student_photo=$row2['student_photo'];


	$que1="select * from $database_blob1.student_documents where student_roll_no='$student_roll_no'";
	$run1=mysqli_query($conn73,$que1);
	while($row1=mysqli_fetch_assoc($run1)){
	$student_photo=$row1['student_image_name'];
	$student_image=$_SESSION['amazon_file_path']."student_documents/".$student_photo;$student_image=str_replace(" ","%20",$student_image);
	}
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
global $conn73,$footer1;

$this->SetDrawColor(0,50,150);
$this->SetLineWidth(0.50);
$this->SetXY(3,3);
$this->Cell(200,90,'',1,0,'C');
$this->Ln();

$this->SetDrawColor(0,50,150);
$this->SetLineWidth(0.20);
$this->SetXY(3,3);
$this->Cell(198,25,'',0,0,'C');
$this->Ln();

$this->SetDrawColor(0,50,150);
$this->SetLineWidth(0.20);
$this->SetXY(3,3);
$this->Cell(200,90,'',0,0,'C');
$this->Ln();

}

function Table1()
{

global $conn73,$school_info_school_name,$approver,$recommender,$gate_pass_time,$reason_for_leaving,$gate_pass_date,$student_admission_number,$school_roll_no,$student_class,$student_name,$school_info_logo,$student_photo,$student_image,$path1,$school_info_school_city,$school_info_school_address;
global $s_no,$account_customer_date,$account_customer_total_amount,$account_customer_name,$account_customer_designation,$office_account_sno,$bank_account_holder_name,$bank_ifsc_code,$bank_branch_name,$bank_name,$bank_account_no;

/*$this->Cell(5,2,'',0);
$this->Ln();*/

$this->SetFont('Times','B',18);
$this->SetTextColor(0,0,150);
$this->Cell(188,2,"".$school_info_school_name,0,0,'C');
$this->Ln();

if($school_info_logo==null){
$this->Image('../../../images/blank_logo.png',9,8,23,25);
}else{
$this->Image($path1,15,8,21,22,"png");
}


$this->Cell(5,3,'',0);
$this->Ln();

$this->SetFont('Times','',12);
$this->SetTextColor(0,0,0);
$this->Cell(188,3,"$school_info_school_address, $school_info_school_city",0,0,'C');
$this->Ln();

$this->Cell(5,16,'',0);
//$this->Ln();

$this->SetFont('Times','B',15);
$this->SetTextColor(0,0,0);
$this->Cell(188,14,"PAYMENT VOUCHER",0,0,'C');
$this->Ln();
$this->SetFont('Times','B',12);
$this->Cell(8,9,"                     _________________                                                                              _________________",0,0,'');
$this->SetTextColor(0,0,0);
$this->Cell(5,8,'PV No.      0'.$s_no.'                                                                                         Dated :      '.$account_customer_date,0);
$this->Ln();

$this->SetFont('Times','B',12);
$this->Cell(5,11,"                                  ___________________________________________________________________",0,0,'');
$this->SetTextColor(0,0,150);
$this->Cell(5,10,"Sum of Rupees :        ".$account_customer_total_amount.'   Rupees Only',0,0,'L');
$this->SetFont('Times','',12);


$number = round($account_customer_total_amount);
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

$this->Ln();
$this->SetFont('Times','B',12);
$this->SetTextColor(0,0,0);
$this->Cell(5,7,"                                  ___________________________________________________________________",0,0,'');
$this->SetTextColor(0,0,150);
$this->Cell(5,6,"In Words :                 ".ucwords($result).' Rupees Only',0,0,'L');
$this->SetFont('Times','',12);
$this->Ln();
$this->SetFont('Times','B',12);
$this->SetTextColor(0,0,0);
$this->Cell(5,10,"                                  ___________________________________________________________________",0,0,'');
$this->SetTextColor(0,0,150);
if($account_customer_designation!=''){
$this->Cell(5,9,"Paid To :                    ".$account_customer_name.'  ('.$account_customer_designation.')',0,0,'L');
}else{
$this->Cell(5,9,"Paid To :                    ".$account_customer_name,0,0,'L');
}
$this->SetFont('Times','',12);
$this->Ln();
$this->SetFont('Times','B',12);
$this->SetTextColor(0,0,0);
$this->Cell(5,7,"                                  ___________________________________________________________________",0,0,'');
$this->SetTextColor(0,0,150);

if($office_account_sno!=''){
$this->Cell(5,6,"On Account of :        ",0,0,'L');
$this->SetFont('Times','B',8);
$this->Cell(5,6,"                                     ".$bank_account_holder_name.' /'.$bank_account_no.' /'.$bank_name.' /'.$bank_ifsc_code,0,0,'L');
}else{
$this->Cell(5,6,"On Account of :        ",0,0,'L');
$this->Cell(5,6,"                       ",0,0,'L');
}
$this->SetFont('Times','',12);
$this->Ln();
$this->Ln();


$this->SetFont('Times','B',13);
$this->SetTextColor(0,0,0);
$this->Cell(70,7,"          ____________________                                                _______________________",0,0,'');
$this->SetTextColor(0,0,0);
$this->Ln();

$this->SetFont('Times','B',13);
$this->SetTextColor(0,0,0);
$this->SetTextColor(0,0,0);
$this->Cell(70,6,"                  Prepared By:                                                                    Recieved By:",0,0,'');
$this->Ln();

}
function sign($s1, $s2){

$this->Cell(90,6,$s1,'',0,'L',false);
$this->Cell(90,6,$s2,'',0,'R',false);
$this->Ln();

}
}

//////----------------------------//////

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$footer1=1;
$pdf->Table1();


//////----------------------------//////

$pdf->Output('I');
?>