<?php

require('fpdf_4_receipt.php');

class PDF extends FPDF
{

protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{			$this->SetFont('helvetica','',13);
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
    $this->SetFont('helvetica',$style,13);
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
    // helvetica 12
    $this->SetFont('helvetica','',12);
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
    // helvetica 12
    $this->SetFont('helvetica','',12);
    // Output justified text
    $this->MultiCell(0,5,$file);
    // Line break
    $this->Ln();
   
}

// Page header
function Header()
{

}

// Page footer
function Footer()
{
   // $this->SetDrawColor(0,0,0);
    //$this->SetXY(10,6);
    //$this->Cell(190,132,"",1);
   // $this->Ln();
	
	//$this->Cell(190,13,"",1);
   // $this->Ln();
	
	//$this->Cell(190,132,"",1);
   // $this->Ln();
 
}


function Table1()
{
    $s_no=$_GET['s_no1'];
	
	include("../../admin/attachment/session.php");
	$query="select * from school_info_general";
	$run=mysqli_query($conn73,$query);
	while($row=mysqli_fetch_assoc($run)){
	$school_info_school_name=$row['school_info_school_name'];
	$school_info_school_state=$row['school_info_school_state'];
	$school_info_school_district=$row['school_info_school_district'];
	$school_info_school_city=$row['school_info_school_city'];
	$school_info_school_pincode=$row['school_info_school_pincode'];
	$school_info_school_address=$row['school_info_school_address'];
	//$school_info_logo=$row['school_info_logo_name'];
	$fees_type=$row['fees_type'];
	//$logo_path="../../documents/school_info/";
	}
	
$database_name1=$_SESSION['database_name'];
$database_blob1=$database_name1."_blob";
$query121="select * from $database_blob1.school_document";
$run121=mysqli_query($conn73,$query121) or die(mysqli_error($conn73));
while($row121=mysqli_fetch_assoc($run121)){
 	$school_info_principal_seal=$row121['school_info_principal_seal_name'];
	$school_info_principal_signature=$row121['school_info_principal_signature_name'];
	$school_info_logo=$row121['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);

}
	$que="select * from school_info_fee_types where fee_type!=''";
	$run=mysqli_query($conn73,$que);
	$serial_no=0;
	$serial_no1=0;
	while($row=mysqli_fetch_assoc($run)){
	$fee_type5 = $row['fee_type'];
	$fee_code = $row['fee_code'];
	if($fee_type5!=''){
	$fee_type = preg_replace('/\s+/', '_', $fee_type5);
	$fee_type1[$serial_no] = $row['fee_type'];
	$fee_type=strtolower($fee_type);
	$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
	$serial_no++;
	$serial_no1++;
	}
	}
  
  	$fee_paid_months=$_GET['months'];
	$month_strcount1=substr_count($fee_paid_months,',');
	if($month_strcount1>0){
	$month_exp=explode(',',$fee_paid_months);	
	$month_count=count($month_exp);
	$month1='';
	$month2='';
	for($f=0;$f<$month_count;$f++){
	if($f==0){
		$comma='';
	}else{
		$comma=', ';
	}
	
		if($month_exp[$f]=='01'){
	$month1=$month1.$comma.'January';
	$month2=$month2.$comma.'Installment1';
	}elseif($month_exp[$f]=='02'){
	$month1=$month1.$comma.'February';
	$month2=$month2.$comma.'Installment2';
	}elseif($month_exp[$f]=='03'){
	$month1=$month1.$comma.'March';
	$month2=$month2.$comma.'Installment3';
	}elseif($month_exp[$f]=='04'){
	$month1=$month1.$comma.'April';
	$month2=$month2.$comma.'Installment4';
	}elseif($month_exp[$f]=='05'){
	$month1=$month1.$comma.'May';
	$month2=$month2.$comma.'Installment5';
	}elseif($month_exp[$f]=='06'){
	$month1=$month1.$comma.'June';
	$month2=$month2.$comma.'Installment6';
	}elseif($month_exp[$f]=='07'){
	$month1=$month1.$comma.'July';
	$month2=$month2.$comma.'Installment7';
	}elseif($month_exp[$f]=='08'){
	$month1=$month1.$comma.'August';
	$month2=$month2.$comma.'Installment8';
	}elseif($month_exp[$f]=='09'){
	$month1=$month1.$comma.'September';
	$month2=$month2.$comma.'Installment9';
	}elseif($month_exp[$f]=='10'){
	$month1=$month1.$comma.'October';
	$month2=$month2.$comma.'Installment10';
	}elseif($month_exp[$f]=='11'){
	$month1=$month1.$comma.'November';
	$month2=$month2.$comma.'Installment11';
	}elseif($month_exp[$f]=='12'){
	$month1=$month1.$comma.'December';
	$month2=$month2.$comma.'Installment12';
	}
	$month_array_var[$f]=$month_exp[$f];
	}
	}else{
	if($fee_paid_months=='01'){
	$month1='January';
	$month2='Installment1';
	}elseif($fee_paid_months=='02'){
	$month1='February';
	$month2='Installment2';
	}elseif($fee_paid_months=='03'){
	$month1='March';
	$month2='Installment3';
	}elseif($fee_paid_months=='04'){
	$month1='April';
	$month2='Installment4';
	}elseif($fee_paid_months=='05'){
	$month1='May';
	$month2='Installment5';
	}elseif($fee_paid_months=='06'){
	$month1='June';
	$month2='Installment6';
	}elseif($fee_paid_months=='07'){
	$month1='July';
	$month2='Installment7';
	}elseif($fee_paid_months=='08'){
	$month1='August';
	$month2='Installment8';
	}elseif($fee_paid_months=='09'){
	$month1='September';
	$month2='Installment9';
	}elseif($fee_paid_months=='10'){
	$month1='October';
	$month2='Installment10';
	}elseif($fee_paid_months=='11'){
	$month1='November';
	$month2='Installment11';
	}elseif($fee_paid_months=='12'){
	$month1='December';
	$month2='Installment12';
	}
	$month_array_var[]=$fee_paid_months;
	}
	$month_count11=count($month_array_var);
	$query1="select * from common_fees_student_fee_add where s_no='$s_no' and fee_status='Active' and session_value='$session1'";
	$run1=mysqli_query($conn73,$query1);
	$serial_no1=0;
	while($row1=mysqli_fetch_assoc($run1)){
	$s_no=$row1['s_no'];
	$fee_submission_date1=$row1['fee_submission_date'];
	$fee_submission_date2 = explode("-",$fee_submission_date1);
	$fee_submission_date=$fee_submission_date2[2]."-".$fee_submission_date2[1]."-".$fee_submission_date2[0];
	$student_roll_no=$row1['student_roll_no'];
	$paid_total=$row1['paid_total'];
	$fee_paid_months=$row1['fee_paid_months'];
	$penalty_amount=$row1['penalty_amount'];
	$blank_field_5=$row1['blank_field_5'];
	$other_fee_remark=$row1['other_fee_remark'];
	$other_fee_amount=$row1['other_fee_amount'];
	
	$student_transport_fee_paid_total=$row1['student_transport_fee_paid_total'];
	
	for($j=0;$j<$serial_no;$j++){
	$monthly_fee[]=0;
	for($k=0;$k<$month_count11;$k++){
	$monthly_var=$fee_paid[$j].$month_array_var[$k];
	$monthly_fee[$j]=$monthly_fee[$j]+$row1[$monthly_var];
	}
	}
	
	$serial_no1++;
	}
	
		$query2="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
	$run2=mysqli_query($conn73,$query2);
	while($row2=mysqli_fetch_assoc($run2)){
	$student_name=$row2['student_name'];
	$student_father_name=$row2['student_father_name'];
	$student_class=$row2['student_class'];
	$student_class_section=$row2['student_class_section'];
	$school_roll_no=$row2['school_roll_no'];
	$student_admission_number=$row2['student_admission_number'];
	$student_bus=$row2['student_bus'];
	$student_gender=$row2['student_gender'];
	}
	
	$this->Image($path1,1,2,8,9,'png');
	
    $this->Cell(190,-6,"",0);
    $this->Ln(); 
	
    $this->SetFont('helvetica','B',10);
	$this->SetTextColor(0,0,0);
    $this->Cell(58,2,"".$school_info_school_name,0,0,'C');
    $this->Ln();
	
	$this->Cell(190,2,"",0);
    $this->Ln(); 
	
    $this->SetFont('helvetica','B',8);
	$this->SetTextColor(0,0,0);
    $this->Cell(58,2,"Distt.  -  ".$school_info_school_district,0,0,'C');
    $this->Ln();

	
	$this->SetLeftMargin(10);
    $this->Cell(190,2,"",0);
    $this->Ln(); 
	

    $this->SetFont('helvetica','B',15);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.25);
    $this->Cell(-10,0.10,"",0);
    $this->Cell(73,0.10,"",1);
    $this->Ln();  

    $this->Cell(190,1,"",0);
    $this->Ln(); 
   
    $student_name1=strtoupper($student_name);
    $student_father_name1=strtoupper($student_father_name);
   
    $count_student=strlen($student_name);
    $count_student_father=strlen($student_father_name);
   
   // if($count_student>15 && $count_student_father>15){
//    $this->SetFont('helvetica','B',7.3);
//	}elseif($count_student<15 && $count_student_father<15){
//	$this->SetFont('helvetica','B',10);
//	}
	$this->SetFont('helvetica','B',10);
	$this->SetTextColor(0,0,0);
	$this->Cell(-9.5,5,"",0);
	$this->Cell(72,4,"".$student_name1,0,0,'C');
	$this->Ln();
	$this->Cell(-9.5,5,"",0);
	$this->SetFont('helvetica','B',7);
	if($student_gender=='Male'){
	$this->Cell(72,3,"S/O",0,0,'C');
	}elseif($student_gender=='Female'){
	$this->Cell(72,3,"D/O",0,0,'C');    
	}else{
	$this->Cell(72,3,"",0,0,'C'); 
	}
	$this->Ln();
	$this->Cell(-9.5,5,"",0);
	$this->SetFont('helvetica','B',9);
	$this->Cell(72,4,"".$student_father_name1,0,0,'C');
	$this->Ln();

    $this->SetFont('helvetica','B',8);
	$this->SetTextColor(0,0,0);
	$this->Cell(-9.5,5,"",0);
	$this->Cell(35,5,"CLASS : $student_class [ $student_class_section ]",0,'L');
	$this->Cell(35,5,"ROLL NO : $school_roll_no",0,'R');
	$this->Ln();

    $this->SetFont('helvetica','B',8);
	$this->SetTextColor(0,0,0);
	$this->Cell(-9.5,5,"",0);
	$this->Cell(35,5,"DATE : $fee_submission_date",0,0,'L');
	$this->Cell(35,5,"RECIEPT NO. : ".$blank_field_5,0,0,'R');
	$this->Ln();	
	
	$this->Cell(190,1,"",0);
    $this->Ln(); 
	
	$this->SetFont('helvetica','B',15);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.25);
    $this->Cell(-10,0.10,"",0);
    $this->Cell(73,0.10,"",1);
    $this->Ln();
    
    $this->SetFont('helvetica','B',10);
	$this->SetTextColor(0,0,0);
	$this->Cell(-9,5,"",0);
	$this->Cell(5,6,"#",1,0,'C');
	$this->Cell(48,6,"FEES TYPE",1,0,'C');
	$this->Cell(18,6,"PAID",1,0,'C');
	$this->Ln(); 
	
	$this->SetFont('helvetica','B',15);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.25);
    $this->Cell(-10,0.10,"",0);
    $this->Cell(73,0.10,"",1);
    $this->Ln();
    
    
	for($i=0;$i<$serial_no;$i++){
	
	
	$serial1=$i+1;
	$this->SetLeftMargin(10);
    $this->SetFont('helvetica','B',10);
	$this->SetTextColor(0,0,0);
	$this->Cell(-10,5,"",0);
	$this->Cell(5,6,"".$serial1.'.',0);
	$this->Cell(48,6,"".$fee_type1[$i],0);
	$this->Cell(18,6,''.$monthly_fee[$i],0,0,'C');
	$this->Ln();

	$this->SetFont('helvetica','B',15);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.25);
    $this->Cell(-10,0.10,"",0);
    $this->Cell(73,0.10,"",0);
    $this->Ln(); 
	
	
	}
	
	$for_penalty_ser=$serial_no;
	if($other_fee_amount!=''){
	$this->SetLeftMargin(10);
    $this->SetFont('helvetica','B',10);
	$this->SetTextColor(0,0,0);
	if($other_fee_amount!=''){
	$serial_no_othr=$serial_no+1;
	$serial_no_other=$serial_no_othr.'.';
	$for_penalty_ser=$serial_no_othr;
	}else{
	$serial_no_other='';
	$other_fee_remark='';
	$other_fee_amount='';
	}
    $this->Cell(-10,5,"",0);
	$this->Cell(5,6,"".$serial_no_other.'.',0);
	$this->Cell(48,6,"".$other_fee_remark,0);
	$this->Cell(18,6,''.$other_fee_amount,0,0,'C');
	$this->Ln();	
	
	$this->SetFont('helvetica','B',15);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.25);
    $this->Cell(-10,0.10,"",0);
    $this->Cell(73,0.10,"",0);
    $this->Ln(); 
	}
	
	$serial_no_pnlty=$for_penalty_ser;
	if($penalty_amount!=''){
	$this->SetLeftMargin(10);
    $this->SetFont('helvetica','B',10);
	$this->SetTextColor(0,0,0);
	if($penalty_amount!=''){
	$serial_no_pnlty=$for_penalty_ser+1;
	$serial_no_penalty=$serial_no_pnlty.'.';
	$penalty_name='Penalty Amount';
	$penalty_amount11=$penalty_amount;
	}else{
	$serial_no_penalty='';
	$penalty_name='';
	$penalty_amount11='';
	}
    $this->Cell(-10,5,"",0);
	$this->Cell(5,6,"".$serial_no_pnlty.'.',0);
	$this->Cell(48,6,"".$penalty_name,0);
	$this->Cell(18,6,''.$penalty_amount11,0,0,'C');
	$this->Ln();	
	
	$this->SetFont('helvetica','B',15);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.25);
    $this->Cell(-10,0.10,"",0);
    $this->Cell(73,0.10,"",0);
    $this->Ln(); 
	}
	
	if($student_transport_fee_paid_total!='' && $student_bus=='Yes'){
	$this->SetLeftMargin(10);
    $this->SetFont('helvetica','B',10);
	$this->SetTextColor(0,0,0);
	if($student_transport_fee_paid_total!='' && $student_bus=='Yes'){
	$serial_no_trnsprt=$serial_no_pnlty+1;
	$serial_no_transport=$serial_no_trnsprt.'.';
	$transport_name='Transport Amount';
	$student_transport_fee_paid_total11=$student_transport_fee_paid_total;
	}else{
	$serial_no_transport='';
	$transport_name='';
	$student_transport_fee_paid_total11='';
	}
    $this->Cell(-10,5,"",0);
	$this->Cell(5,6,"".$serial_no_trnsprt.'.',0);
	$this->Cell(48,6,"".$transport_name,0);
	$this->Cell(18,6,''.$student_transport_fee_paid_total11,0,0,'C');
	$this->Ln();	
	
	$this->SetFont('helvetica','B',15);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.25);
    $this->Cell(-10,0.10,"",0);
    $this->Cell(73,0.10,"",1);
    $this->Ln(); 
	}
	
	
    $this->SetFont('helvetica','B',10);
	$this->SetTextColor(0,0,0);
	$this->Cell(35.5,6,"TOTAL = ",0,0,'R');
	$this->Cell(35.5,6,"".$paid_total,1,0,'0');
	$this->Ln(); 
	
	$this->SetFont('helvetica','B',15);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.25);
    $this->Cell(-10,0.10,"",0);
    $this->Cell(73,0.10,"",1);
    $this->Ln();
    
	$this->Cell(190,60,"",0);
    $this->Ln(); 
	
	$this->Cell(190,8.8,"",0);
    $this->Ln(); 
	
	$this->SetLeftMargin(10);
    $this->SetFont('helvetica','B',8);
	$this->SetTextColor(0,0,0);
	$this->Ln(-126); 
	

	
	
	
	

	
	
 
	

		
	//$this->Image('logo.png',30,146,16,17);
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
$pdf->SetFont('helvetica','',14);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
	//  $pdf->SetLeftMargin(30);
		$pdf->Table1();
		
		
	//	$pdf->SetLeftMargin(-30);

$file_name="fees_receipt".$student_name."_".$student_class.".pdf";
$pdf->Output('I',$file_name);
?>