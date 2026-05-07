<?php include("../../../admin/attachment/session.php");
$s_no=$_GET['id'];
$emp_id=$_GET['emp_id'];
$date_diff=$_GET['date_diff'];
$query1="select * from employee_salary_generate where s_no='$s_no'";
$run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
while($row1=mysqli_fetch_assoc($run1)){
	$employee_name = $row1['employee_name'];
	$emp_id = $row1['emp_id'];
	$employee_salary_date_from1 = $row1['employee_salary_date_from'];
	$employee_salary_date_from2=explode("-",$employee_salary_date_from1);
	$employee_salary_date_from=$employee_salary_date_from2[2]."-".$employee_salary_date_from2[1]."-".$employee_salary_date_from2[0];
	$employee_salary_date_to1 = $row1['employee_salary_date_to'];
	$employee_salary_date_to2=explode("-",$employee_salary_date_to1);
	$employee_salary_date_to=$employee_salary_date_to2[2]."-".$employee_salary_date_to2[1]."-".$employee_salary_date_to2[0];
	$employee_total_working_day = $row1['employee_total_working_day'];
	$employee_total_incentive = $row1['employee_total_incentive'];
	$employee_salary_generate_date = $row1['employee_salary_generate_date'];
	$employee_total_pay = $row1['employee_total_pay'];
	$employee_deduct_pf = $row1['employee_deduct_pf'];
	$employee_pf_no = $row1['employee_pf_no'];
	$employee_pf_amount = $row1['employee_pf_amount'];
	$employee_total_pay_after_pf = $row1['employee_total_pay_after_pf'];
	$total_present = $row1['total_present'];
	$total_absent = $row1['total_absent'];
	$total_leave = $row1['total_leave'];
	$verify_total_leaves = $row1['verify_total_leaves'];
	$leave_verification = $row1['leave_verification'];
	$da_amount = $row1['da_amount'];
	$hra_amount = $row1['hra_amount'];
	$esic_deduction = $row1['esic_amount'];
	$tds_deduction = $row1['tds_amount'];
	$ptax_deduction = $row1['ptax_amount'];
	$other_deduction = $row1['other_deduction'];
	$salary_day = $row1['salary_day'];
	$final_salary = $row1['final_salary'];
	$advance_amount = $row1['advance_amount'];
	$allowance = $row1['allowance'];
	$total_day = $row1['total_day'];

	
	}
	
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
	$emp_pan_card_no = $row['emp_pan_card_no'];
	$emp_bank_name = $row['emp_bank_name'];
	$emp_account_no = $row['emp_account_no'];
	$emp_basic_salary = $row['emp_basic_salary'];
	$emp_pf_number = $row['emp_pf_number'];
	$emp_photo = $row['emp_photo'];
    $emp_uid_no = $row['emp_uid_no'];
	
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
$query121="select * from school_info_general";
$run121=mysqli_query($conn73,$query121) or die(mysqli_error($conn73));
while($row121=mysqli_fetch_assoc($run121)){
 	$school_info_principal_seal=$row121['school_info_principal_seal_name'];
	$school_info_principal_signature=$row121['school_info_principal_signature_name'];
	$school_info_logo=$row121['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
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
global $conn73,$employee_salary_date_from,$employee_salary_date_to,$emp_basic_salary,$employee_total_working_day,$employee_total_incentive,$employee_salary_generate_date,$employee_total_pay,$employee_deduct_pf,$employee_pf_amount,$employee_total_pay_after_pf,$total_present,$total_absent,$verify_total_leaves,$date_diff,$da_amount,$hra_amount,$tds_deduction,$esic_deduction,$ptax_deduction,$other_deduction,$salary_day,$final_salary,$advance_amount,$total_leave,$allowance,$total_day;

	
        $total_amount=$emp_basic_salary+$da_amount+$hra_amount+$allowance+$employee_total_incentive;	
        $total_deduction=$tds_deduction+$employee_pf_amount+$esic_deduction+$ptax_deduction+$other_deduction;			

		$this->SetFont('','B');
		$this->SetLeftMargin(13);
        $this->SetTextColor(128,0,0);
        $this->Cell(185,10,"From Date : $employee_salary_date_from     To   Date : $employee_salary_date_to",1,0,'C');
		$this->Ln();
		$this->SetTextColor(0,0,0);
		$this->Cell(50,10,"Salary",1,0,"C");
        $this->Cell(45,10,'Amount',1,0,"C");
		$this->Cell(50,10,'Deduction',1,0,"C");
		$this->Cell(40,10,"Amount",1,0,"C");
        $this->Cell(0.1,10,'',1,0,"C");
		$this->Ln();
       
	    $this->SetFont('Times','',11);
	   	$this->Cell(50,8,"Basic Salary",1,0,"C");
        $this->Cell(45,8,$emp_basic_salary.'',1,0,"C");
	    $this->Cell(50,8,"PF",1,0,"C");
        $this->Cell(40,8,''.$employee_pf_amount,1,0,"C");
		$this->Ln();
		
        $this->SetFont('Times','',11);
	   	$this->Cell(50,8,"DA",1,0,"C");
        $this->Cell(45,8,$da_amount.'',1,0,"C");
		$this->Cell(50,8,"TDS",1,0,"C");
        $this->Cell(40,8,''.$tds_deduction,1,0,"C");
		$this->Ln();
		
        $this->SetFont('Times','',11);
	   	$this->Cell(50,8,"HRA",1,0,"C");
        $this->Cell(45,8,$hra_amount.'',1,0,"C");
		$this->Cell(50,8,"ESIC",1,0,"C");
        $this->Cell(40,8,''.$esic_deduction,1,0,"C");
	    $this->Ln();
		
        $this->SetFont('Times','',11);
	   	$this->Cell(50,8,"Allowance",1,0,"C");
        $this->Cell(45,8,$allowance.'',1,0,"C");
		$this->Cell(50,8,"Professional Tax",1,0,"C");
        $this->Cell(40,8,''.$ptax_deduction,1,0,"C");
		$this->Ln();

		$this->SetFont('Times','',11);
	   	$this->Cell(50,8,"Incentive",1,0,"C");
        $this->Cell(45,8,$employee_total_incentive.'',1,0,"C");
		$this->Cell(50,8,"Other Deduction",1,0,"C");
        $this->Cell(40,8,''.$other_deduction,1,0,"C");
		$this->Ln();
       
	    $this->Cell(190,2,'',0,0,"C");
		$this->Ln();
	 
	    $this->SetFont('Times','B',11);
	   	$this->Cell(50,8,"Total ( Amount ) ( A )",1,0,"C");
        $this->Cell(45,8,$total_amount.'',1,0,"C");
		$this->Cell(50,8,"Total Deduction ( B )",1,0,"C");
        $this->Cell(40,8,''.$total_deduction,1,0,"C");
		$this->Ln(); 
	 
	    $this->SetFont('Times','B',11);
	   	$this->Cell(50,8,"Advance (C)",1,0,"C");
        $this->Cell(45,8,$advance_amount.'',1,0,"C");
		$this->Cell(50,8,"Final Salary ( A-B-C ) ",1,0,"C");
        $this->Cell(40,8,''.$final_salary,1,0,"C");
		$this->Ln(); 
	    $this->Cell(0,5,'',0,0,"C");			
		$this->Ln();
		
	    $this->SetFont('Times','B',11);
	   	$this->Cell(40,8,"Total Days ( A )",1,0,"C");
        $this->Cell(30,8,'Present',1,0,"C");
		$this->Cell(30,8,"Absent ( B )",1,0,"C");
        $this->Cell(40,8,'Leave',1,0,"C");
        $this->Cell(45,8,'Salary Day ( A-B )',1,0,"C");
		$this->Ln(); 
		
		if($total_day==''){
        $salary_from2=explode("-",$employee_salary_date_from);
        $salary_from_m=$salary_from2[1];
        $salary_from_y=$salary_from2[2];
        $d=cal_days_in_month(CAL_GREGORIAN,$salary_from_m,$salary_from_y);
        $total_day=$d;
		}
	    
		$this->SetFont('Times','B',11);
	   	$this->Cell(40,8,''.$total_day,1,0,"C");
        $this->Cell(30,8,''.$total_present,1,0,"C");
		$this->Cell(30,8,''.$total_absent,1,0,"C");
        $this->Cell(40,8,''.$total_leave,1,0,"C");
        $this->Cell(45,8,''.$salary_day,1,0,"C");
		$this->Ln(); 
	    $this->Cell(0,5,'',0,0,"C");			
		$this->Ln();
	
	 
		//this code is Salary amount in word convert start
			$number1 = $final_salary;
			$no = round($number1);
			$point = round($number1 - $no, 2) * 100;
			$hundred = null;
			$digits_1 = strlen($no);
			$i = 0;
			$str = array();
			$words = array('0' => '', '1' => 'One', '2' => 'Two',
			'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
			'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
			'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
			'13' => 'Thirteen', '14' => 'Fourteen',
			'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
			'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
			'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
			'60' => 'Sixty', '70' => 'Seventy',
			'80' => 'Eighty', '90' => 'Ninety');
			$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
			while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number1 = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number1) {
			$plural = (($counter = count($str)) && $number1 > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str [] = ($number1 < 21) ? $words[$number1] .
			" " . $digits[$counter] . $plural . " " . $hundred
			:
			$words[floor($number1 / 10) * 10]
			. " " . $words[$number1 % 10] . " "
			. $digits[$counter] . $plural . " " . $hundred;
			} else $str[] = null;
			}
			$str = array_reverse($str);
			$result1 = implode('', $str);
			$points1 = ($point) ?
			"And " . $words[$point / 10] . " " . 
			$words[$point = $point % 10] : '';
			//echo $result1 . "Rupees  " . $points1 . " Paise";
			// end
		
		$this->Ln();
        $this->SetFont('Times','B',13);
	    $this->SetTextColor(0,0,0);
		$this->Cell(185,10,"Net Pay In Word :  ".$result1 . "Rupees.",1);
        $this->SetTextColor(0,0,0);
		$this->Ln(25);
		$this->Cell(0,10,"Note:-  Salary information is confidential and is not to be shared with other employees.",0,'C');
		$this->SetLeftMargin(15);
		$this->Ln(25);
		$this->Cell(0,10,"",0,'C');

}
function Table1()
{
    global $conn73,$employee_name,$emp_gender,$emp_doj,$emp_mobile,$emp_email,$emp_id,$emp_designation,$emp_uid_no,$emp_pf_number,$emp_bank_name,$emp_account_no,$school_info_school_name,$path1;;
  
	$this->SetFont('','B');
    $this->Cell(185,10,"Employee Details",1,'B','C');
    $this->Ln();
    $this->SetFont('Times','',13);
    $this->Cell(46,8,"Employee Name",1);
	$this->SetTextColor(0,0,0);
    $this->Cell(139,8,$employee_name,1);
	$this->SetTextColor(0,0,0);
	$this->Ln();
       
	$this->Cell(46,8,"Gender",1);
	$this->SetFont('Times','',13);
	$this->SetTextColor(0,0,0);
    $this->Cell(46,8,$emp_gender,1);
	$this->SetTextColor(0,0,0);
	$this->SetFont('Times','',13);
	$this->Cell(46,8,'Group Joining Date',1);
	$this->Cell(47,8,$emp_doj,1);
	$this->Ln();
		
	$this->Cell(46,6,"Contact No.",1);
	$this->Cell(46,6,$emp_mobile,1);
	$this->Cell(46,6,"Designation",1);
	$this->Cell(47,6,$emp_designation,1);
	$this->Ln();
	
	$this->Cell(46,6,"Aadhar No",1);  
	$this->Cell(46,6,$emp_uid_no,1);
	$this->SetFont('Times','',13);
	$this->Cell(46,6,'PF No.',1);
	$this->SetTextColor(0,0,0);
	$this->Cell(47,6,$emp_pf_number,1);
	$this->SetTextColor(0,0,0);
	$this->Ln();
	
	$this->Cell(46,6,"Bank Name",1);  
	$this->Cell(46,6,$emp_bank_name,1);
	$this->SetFont('Times','',13);
	$this->Cell(46,6,'Account No.',1);
	$this->SetTextColor(0,0,0);
	$this->Cell(47,6,$emp_account_no,1);
	$this->SetTextColor(0,0,0);
	$this->Ln(-10);
   
	$this->SetLeftMargin(0);
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


 $pdf->SetFont('Arial','B',23.5);
 $pdf->SetTextColor(180,0,0);
 $pdf->Cell(157,9,"".$school_info_school_name,'B',2);
 $pdf->Image($path1,173,3,22,22,'jpeg');
 $pdf->SetFont('Times','',13);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetFont('','');
//	$pdf->AddPage(); //
 $pdf->SetTextColor(0,0,0);
 $pdf->SetLineWidth(1);
 $pdf->Ln(10);
 $pdf->Cell(191,230,'',1,0,'C');
 $pdf->Ln(10);
 $pdf->SetLineWidth(0.3);
 $pdf->SetLeftMargin(13);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetFont('Times','',15);
 $pdf->Cell(185,10,'SALARY SLIP',1,0,'C');
 $pdf->SetTextColor(0,0,0);
 $pdf->Ln(15);
 $pdf->SetFont('Times','',13);
//  $pdf->SetLeftMargin(30);
 $pdf->Table1();
 $pdf->Ln(15);
 $pdf->Table2();
 $pdf->Ln(50);
		
	//	$pdf->SetLeftMargin(-30);
 	
	
$file_name=$emp_id.'_'.'salary.pdf';
$pdf->Output('I',$file_name);
?>