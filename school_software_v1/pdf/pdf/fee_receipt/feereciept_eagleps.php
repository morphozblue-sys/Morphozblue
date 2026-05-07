<?php
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
    $this->Cell(0,6,"Chapter $num : $label",0,0,'L',true);
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
  
}

function get_penalty($select_month,$select_count,$selected_student,$selected_date)
{
global $session1,$filter37,$conn73;
$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
$run01=mysqli_query($conn73,$que01) or die(mysqli_error($conn73));
$sno=0;
while($row01=mysqli_fetch_assoc($run01)){
$fees_code[$sno] = $row01['fees_code'];
$penalty_day_monthly[$fees_code[$sno]] = $row01['penalty_day_monthly'];
$dues_last_date[$fees_code[$sno]] = $row01['dues_last_date'];
$penalty_percent_rupees_amount[$fees_code[$sno]] = $row01['penalty_percent_rupees_amount'];
$penalty_method[$fees_code[$sno]] = $row01['penalty_method'];
$sno++;
}
$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
$serial_no=0;
while($row=mysqli_fetch_assoc($run)){
$s_no=$row['s_no'];
$fee_type5 = $row['fee_type'];
$fee_code = $row['fee_code'];
if($fee_type5!=''){
$fee_balance[$serial_no]="student_".$fee_code."_balance_month";

$serial_no++;
}
}

$que11="select * from common_fees_student_fee where student_roll_no='$selected_student' and session_value='$session1' and fee_status='Active'";
$run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
$calculate_penalty='';
while($row11=mysqli_fetch_assoc($run11)){
for($g=0;$g<$select_count;$g++){
$show_balance_fee=0;
for($i=0;$i<$serial_no;$i++){ 

$fee_balance1[$i] = $row11[$fee_balance[$i].$select_month[$g]];
if($fee_balance1[$i]==''){
$fee_balance1[$i]=0;
}

$show_balance_fee=$show_balance_fee+$fee_balance1[$i];
}

if($selected_date > $dues_last_date[$select_month[$g]] && $dues_last_date[$select_month[$g]]!='0000-00-00'){
if($penalty_day_monthly[$select_month[$g]]=='Day'){

$current_date=date_create($selected_date);
$dues_last_date11=date_create($dues_last_date[$select_month[$g]]);
$diff=date_diff($current_date,$dues_last_date11);
$clear_difference=$diff->format("%a");

if($penalty_method[$select_month[$g]]=='%'){
$calculate_penalty=$calculate_penalty+(($show_balance_fee*$clear_difference*$penalty_percent_rupees_amount[$select_month[$g]])/100);
}elseif($penalty_method[$select_month[$g]]=='Rs'){
$calculate_penalty=$calculate_penalty+($penalty_percent_rupees_amount[$select_month[$g]]*$clear_difference);
}
}else{
if($penalty_method[$select_month[$g]]=='%'){
$calculate_penalty=$calculate_penalty+(($show_balance_fee*$penalty_percent_rupees_amount[$select_month[$g]])/100);
}elseif($penalty_method[$select_month[$g]]=='Rs'){
$calculate_penalty=$calculate_penalty+$penalty_percent_rupees_amount[$select_month[$g]];
}
}
}else{
$calculate_penalty=$calculate_penalty;
}
}
}

return $calculate_penalty;

}

// Page footer
function Footer()
{
	$this->SetXY(10,137);
	$this->SetDrawColor(19,18,16);
	$this->SetLineWidth(0.10);
    $this->Cell(190,1,'--------------------------------------------------------------------------------------------------------------------------------------------------------------',0,0,'C');
    $this->Ln();
	
	//	$this->Image('scissor.png',25,135,5,5,'png');
//		$this->Image('scissor.png',45,135,5,5,'png');	
//	$this->Image('scissor1.png',145,135.5,5,5,'png');
//		$this->Image('scissor1.png',175,135.5,5,5,'png');
$this->SetLineWidth(1);
//$this->SetXY(2.5,2.5);
//$this->Cell(290.5,102.25,'',1,0,'C');
//$this->SetXY(2.5,2.5);
//$this->Cell(290.5,112.25,'',1,0,'C');
    
}

function Table1()
{
    
	$s_no=$_GET['s_no1'];
	
	include("../../../admin/attachment/session.php");
	$query="select * from school_info_general";
	$run=mysqli_query($conn73,$query);
	while($row=mysqli_fetch_assoc($run)){ 
	$school_info_school_name=$row['school_info_school_name'];
	$school_info_school_state=$row['school_info_school_state'];
	$school_info_school_district=$row['school_info_school_district'];
	$school_info_school_city=$row['school_info_school_city'];
	$school_info_school_pincode=$row['school_info_school_pincode'];
	$school_info_school_address=$row['school_info_school_address'];
	$school_info_school_email_id=$row['school_info_school_email_id'];
	$school_info_school_contact_no=$row['school_info_school_contact_no'];
	$fees_type=$row['fees_type'];

}
	


$query121="select * from school_info_general";
$run121=mysqli_query($conn73,$query121) or die(mysql_error());
while($row121=mysqli_fetch_assoc($run121)){
 	$school_info_principal_seal=$row121['school_info_principal_seal_name'];
	$school_info_principal_signature=$row121['school_info_principal_signature_name'];
	$school_info_logo=$row121['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
}

	
	$que="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37 ORDER BY s_no DESC";
	$run=mysqli_query($conn73,$que);
	$serial_no=0;
	$serial_no1=0;
	while($row=mysqli_fetch_assoc($run)){//print_r($row);
	$fee_type5 = $row['fee_type'];
	$fee_code = $row['fee_code'];
	if($fee_type5!=''){
	$fee_type = preg_replace('/\s+/', '_', $fee_type5);
	$fee_type1[$serial_no] = $row['fee_type'];
	$fee_type=strtolower($fee_type);
	$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
	$fee_total_set[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
	$fee_total111[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
	$fee_balance111[$serial_no]="student_".$fee_code."_balance_month";
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
	
	$que01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
    $run01=mysqli_query($conn73,$que01) or die(mysqli_error($conn73));
    $sno1=0;
    while($row01=mysqli_fetch_assoc($run01)){
    $fees_code[$sno1] = $row01['fees_code'];
    $penalty_day_monthly[$fees_code[$sno1]] = $row01['penalty_day_monthly'];
    $dues_last_date[$fees_code[$sno1]] = $row01['dues_last_date'];
    $penalty_percent_rupees_amount[$fees_code[$sno1]] = $row01['penalty_percent_rupees_amount'];
    $penalty_method[$fees_code[$sno1]] = $row01['penalty_method'];
    $sno1++;
    }
	
	$month_count11=count($month_array_var);
	$query1="select * from common_fees_student_fee_add where s_no='$s_no' and fee_status='Active' and session_value='$session1'";
	$run1=mysqli_query($conn73,$query1);
	$serial_no1=0;
	while($row1=mysqli_fetch_assoc($run1)){
	$s_no=$row1['s_no'];
	$fee_submission_date1="2023-11-03";//$row1['fee_submission_date'];
	$fee_submission_date2 = explode("-",$fee_submission_date1);
	
	$fee_submission_date=$fee_submission_date2[2]."-".$fee_submission_date2[1]."-".$fee_submission_date2[0];
	$fee_submission_date_mon_ye=$fee_submission_date2[1]."-".$fee_submission_date2[0];
	$student_roll_no=$row1['student_roll_no'];
	$paid_total=$row1['paid_total'];
	$fee_paid_months=$row1['fee_paid_months'];
	$penalty_amount=$row1['penalty_amount'];
	$blank_field_5=$row1['blank_field_5'];
	$editable_receipt_no=$row1['editable_receipt_no'];
	$blank_field_1=$row1['blank_field_1'];
	$blank_field_2=$row1['blank_field_2'];
	$other_fee_remark=$row1['other_fee_remark'];
	$other_fee_amount=$row1['other_fee_amount'];
	$transaction_no=$row1['blank_field_3'];
	$student_transport_fee_balance=$row1['student_transport_fee_balance'];
	$student_transport_fee_paid_total=$row1['student_transport_fee_paid_total'];
	$student_previous_year_fee_paid_total=$row1['student_previous_year_fee_paid_total'];
    $student_previous_year_fee_balance=$row1['student_previous_year_fee_balance'];
    $student_previous_year_fee=$row1['student_previous_year_fee'];
    $office_account_sno=$row1['office_account_sno'];
    $update_change=$row1['update_change'];
    $student_payment_mode=$row1['student_payment_mode'];
    $cheque_bank_name=$row1['cheque_bank_name'];
    $cheque_no=$row1['cheque_no'];
    $last_updated_date=date('d-m-Y h:i:sa', strtotime($row1['last_updated_date']));
    $paid_month=explode(',',$fee_paid_months);
    
    $month_count11=count($month_array_var);
	$session12=explode('_',$session1);
	$ye=$session12[0];
    $get_currect_month_year=explode('-',$fee_submission_date_mon_ye);
    
    $month_count121=1;
    
    $total_curret_mon=0;
    $total_previous_mon=0;
    $year_month_condition=1;
	for($k=0;$k<$month_count11;$k++)
	{
	  
	 if($month_array_var[$k]==$get_currect_month_year[0] && $ye==$get_currect_month_year[1])
     $year_month_condition=0; 
	 
     if($year_month_condition==0)
	 {
	 $monthly_fee_current_previou_month[$month_array_var[$k]]='Current';
	 $total_curret_mon++;
	 }
	 else
	 {
	 $monthly_fee_current_previou_month[$month_array_var[$k]]='Previous';
	 $total_previous_mon++;
	 }
	 
	 
     
	 if($month_array_var[$k]==12)
	 $ye=$ye+1;
	}
    
     
    
    for($i=0;$i<count($paid_month);$i++)
    {
    $get_last_date=explode('-',$dues_last_date[$paid_month[$i]]);    
    $last_dues_date_fees_sub=$get_last_date[2].'-'.$get_last_date[1].'-'.$get_last_date[0];    
    }
    $monthly_fee1_total=0;
	$monthly_fee2_total=0;
	for($k=0;$k<$month_count11;$k++)
	{
	$monthly_fee_month_wise[$k]=0;
    $monthly_fee1_month_wise[$k]=0;
    $monthly_fee2_month_wise[$k]=0;   
	}
	
	for($j=0;$j<$serial_no;$j++){
	$monthly_fee[]=0;
	$monthly_fee1[]=0;
	$monthly_fee2[]=0;
	for($k=0;$k<$month_count11;$k++){
	$monthly_var=$fee_paid[$j].$month_array_var[$k];
	$monthly_var1=$fee_total111[$j].$month_array_var[$k];
	$monthly_var2=$fee_balance111[$j].$month_array_var[$k];
	
	$monthly_fee[$j]=$monthly_fee[$j]+$row1[$monthly_var];
	$monthly_fee1[$j]=$monthly_fee1[$j]+$row1[$monthly_var1];
	$monthly_fee2[$j]=$monthly_fee2[$j]+$row1[$monthly_var2];
	
	$monthly_fee_month_wise[$k]=$monthly_fee_month_wise[$k]+$row1[$monthly_var];
	$monthly_fee1_month_wise[$k]=$monthly_fee1_month_wise[$k]+$row1[$monthly_var1];
	$monthly_fee2_month_wise[$k]=$monthly_fee2_month_wise[$k]+$row1[$monthly_var2];
	if($monthly_fee_current_previou_month[$month_array_var[$k]]=='Current')
	{
	$monthly_fee1_total=$monthly_fee1_total+$row1[$monthly_var1];
	$monthly_fee2_total=$monthly_fee2_total+$row1[$monthly_var2];
	$monthly_fee_total=$monthly_fee_total+$row1[$monthly_var];
	}
	}
	}
	
	$serial_no1++;
	}
    
    
    
    
	$bank_name='';
	$bank_account_holder_name='';
	if($office_account_sno!=''){
	$query2="select bank_name,bank_account_holder_name from account_office_bank_account where s_no='$office_account_sno'";
	$run2=mysqli_query($conn73,$query2);
	while($row2=mysqli_fetch_assoc($run2)){//print_r($row2);
	$bank_name=$row2['bank_name'];
	$bank_account_holder_name=$row2['bank_account_holder_name'];
	}
	}
	
	$user_name='';
	if($update_change!=''){
	$query333="select user_name from user_rights where user_email='$update_change'";
	$run333=mysqli_query($conn73,$query333);
	while($row333=mysqli_fetch_assoc($run333)){
	$user_name=$row333['user_name'];
	}
	}
	
	$query2="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'$filter37";
	$run2=mysqli_query($conn73,$query2);
	while($row2=mysqli_fetch_assoc($run2)){// print_r($row2);
	$student_name=strtolower($row2['student_name']);
	$student_father_name=$row2['student_father_name'];
	$student_class=$row2['student_class'];
	$student_class_section=$row2['student_class_section'];
	$school_roll_no=$row2['school_roll_no'];
	$student_admission_number=$row2['student_admission_number'];
	$student_bus=$row2['student_bus'];
	$student_father_contact_number=$row2['student_father_contact_number'];
	$student_class_stream=$row2['student_class_stream'];
	}
	
		$que1="select * from student_admission_info where student_roll_no='$student_roll_no' and session_value='$session1'";
	$run1=mysqli_query($conn73,$que1);
	while($row1=mysqli_fetch_assoc($run1)){//print_r($row1);
	$student_photo=$row1['student_image_name'];
	//$student_image="data:image/jpeg;base64,".$student_photo;
 	$student_image=$_SESSION['amazon_file_path']."student_documents/".$student_photo;$student_image=str_replace(" ","%20",$student_image);
	}
$this->SetFont('Times','B',20);
$this->SetTextColor(1,8,21);
$this->SetXY(105,4);
//$this->Cell(0.01,125,'',1);
$this->Ln();



$side_position=3;
for($aq=1; $aq<=2; $aq++){

    
	    if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',12,6,18,18);
		$this->Image('../../../images/blank_logo.png',12,148,18,18);
		}else{
		$this->Image($path1,5,3,8,8,'jpeg');
 		$this->Image($path1,109,3,8,8,'jpeg');
		}
		if($student_photo==null){
		$this->Image('../../../images/blank.jpg',254,16,21,21);
		}
		else{
		$this->Image($student_image,80,50,21,21,'jpeg');
		$this->Image($student_image,184,50,21,21,'jpeg');
	    }
     
// if($aq==1){
// $this->Image('../../../images/wmsuc.jpg',0,-1,144,208);
// }else{
// $this->Image('../../../images/wmsuc.jpg',150,-1,144,208);
// }
$side_position1=$side_position+1;
$this->SetXY($side_position,1.50);
$this->Cell(100,135,"",1,0,"C");

$this->SetFont('Times','B',14);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,2);
$this->Cell(98,29,'',1,0,"C");
$this->Ln();

$this->SetFont('Times','B',12);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,5);
$this->Cell(45,0.01,'',0);
$this->Cell(13,0.01,"FEE VOUCHER",0,0,"C");
$this->Ln();




$this->SetFont('Times','B',14);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,11);
$this->Cell(2,6,'',0,0,"C");
$this->Cell(96,6,"".strtoupper($school_info_school_name),0,0,"C");
$this->Ln();

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,18);
$this->Cell(1,6,'',0,0,"C");
$this->Cell(96,6,''.strtoupper($school_info_school_address),0,0,"C");
$this->Ln();


$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,25);
$this->Cell(1,6,'',0,0,"C");
$this->Cell(96,6," MOB :  ".$school_info_school_contact_no,0,0,"C");
$this->Ln();

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,32);
$this->Cell(1,6,'',0,0,"C");
$this->Cell(48,6," Issue Date :  ".$fee_submission_date,1,0,"C");
$this->SetFillColor(255,255,0);
$this->Cell(20,6," Month :  ",1,0,"C",true);
$this->SetTextColor(1,8,0);
$this->Cell(28,6," ".$fee_paid_months,1,0,"C");
$this->SetTextColor(1,8,21);
$this->Ln();

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,39);
$this->Cell(1,6,'',0,0,"C");
$this->Cell(24,6," Re.No. :  ",0,0,"C");
$this->Cell(26,6," ".$blank_field_5,1,0,"C");
$this->Cell(22,6," GR :  ",0,0,"C");
$this->Cell(24,6,"".$student_admission_number,1,0,"C");
$this->Ln();

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,46);
$this->Cell(1,6,'',0,0,"C");
$this->Cell(24,6,"Name :  ",0,0,"C");
$this->Cell(50,6," ".strtoupper($student_name),1,0,"L");
$this->Ln();

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,53);
$this->Cell(1,6,'',0,0,"C");
$this->Cell(24,6," Father :  ",0,0,"C");
$this->Cell(50,6," ".strtoupper($student_father_name),1,0,"L");
$this->Ln();

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,60);
$this->Cell(1,6,'',0,0,"C");
$this->Cell(24,6," Class :  ",0,0,"C");
$this->Cell(50,6," ".$student_class,1,0,"L");
$this->Ln();


$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,67);
$this->Cell(1,6,'',0,0,"C");
$this->SetFillColor(255,255,0);
$this->Cell(24,6," Due Date :  ",0,0,"C");
$this->Cell(50,6," ".$last_dues_date_fees_sub,1,0,"L",true);
$this->Ln();

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,75);
$this->Cell(10,6,"S.No.",1,0,"C");
$this->Cell(35,6,"PARTICULARS",1,0,"C");
$this->Cell(18,6,"AMT ",1,0,"C");
$this->Cell(18,6,"Disc ",1,0,"C");
$this->Cell(17,6,"Net Amt ",1,0,"C");
$this->Ln();


    if($other_fee_amount!=''){
	$k=1;
	}else{
	$k=0;
	}
	
	if($penalty_amount!=''){
	$l=1;
	}else{
	$l=0;
	}
	
	if($student_transport_fee_paid_total!='' && $student_bus=='Yes'){
	$m=1;
	}else{
	$m=0;
	}
	
	if($student_previous_year_fee_paid_total!='' && $student_previous_year_fee_paid_total>0){
	$n=1;
	}else{
	$n=0;
	}
	
	$serial_no00=$serial_no+$k+$l+$m+$n;
	$serial_no1=$serial_no00-($k+$l+$m+$n);
$position=75;
/*
for($i=0;$i<$serial_no;$i++){
$position=$position+6;
$serial1=$i+1;

$this->SetFont('Times','',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,$position);
$this->Cell(1,7,'',0,0,'C');
$this->Cell(10,6,''.$serial1.'.',1,0,'C');
$this->Cell(35,6,''.$fee_type1[$i],1,0,'L');
$this->Cell(18,6,''.$monthly_fee1[$i],1,0,'C');
$this->Cell(18,6,''.$monthly_fee2[$i],1,0,'C');
$this->Cell(17,6,''.$monthly_fee[$i],1,0,'C');
$this->Ln();

}
*/  
	for($k=0;$k<$month_count11;$k++)
	{
	if($monthly_fee_current_previou_month[$month_array_var[$k]]=='Current')
	{
	$position=$position+6;
    $serial1=$k+1;  
    $month121=explode(',',$month1);
    $this->SetFont('Times','',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position,$position);
    $this->Cell(1,7,'',0,0,'C');
    $this->Cell(10,6,''.$serial1.'.',1,0,'C');
    $this->Cell(35,6,''.$month121[$k],1,0,'L');
    $this->Cell(18,6,''.$monthly_fee1_month_wise[$k],1,0,'C');
    $this->Cell(18,6,''.$monthly_fee2_month_wise[$k],1,0,'C');
    $this->Cell(17,6,''.$monthly_fee_month_wise[$k],1,0,'C');
    $this->Ln();
	}
	}
    $buttom_margin_1=($total_curret_mon-3)*6;
$for_penalty_ser=$serial_no1;
if($other_fee_amount!=''){
$position=$position+6;
$this->SetFont('Times','',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,$position);
if($other_fee_amount!=''){
$serial_no_othr=$serial_no1+1;
$serial_no_other=$serial_no_othr.'.';
$for_penalty_ser=$serial_no_othr;
}else{
$serial_no_other='';
$other_fee_remark='';
$other_fee_amount='';
}
$this->Cell(10,6,''.$serial_no_other,1,0,'C');
$this->Cell(35,6,''.$other_fee_remark,1,0,'L');
$this->Cell(19,6,'0',1,0,'C');
$this->Cell(18,6,''.$other_fee_amount,1,0,'C');
$this->Cell(18,6,'0',1,0,'C');
$this->Ln();
}

$serial_no_pnlty=$for_penalty_ser;
if($penalty_amount!=''){
$position=$position+6;
$this->SetFont('Times','',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,$position);
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
// $this->Cell(10,6,''.$serial_no_penalty,1,0,'C');
// $this->Cell(35,6,''.$penalty_name,1,0,'L');
// $this->Cell(19,6,'0',1,0,'C');
// $this->Cell(18,6,'0',1,0,'C');
// $this->Cell(18,6,''.$penalty_amount11,1,0,'C');
// $this->Ln();
}

if($student_transport_fee_paid_total!='' && $student_bus=='Yes'){
$position=$position+6;
$this->SetFont('Times','',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,$position);
if($student_transport_fee_paid_total!='' && $student_bus=='Yes'){
$serial_no_trnsprt=$serial_no_pnlty+1;
$serial_no_transport=$serial_no_trnsprt.'.';
$transport_name='Transport Amount';
$student_transport_fee_previous_balance11=$student_transport_fee_balance+$student_transport_fee_paid_total;
$student_transport_fee_balance11=$student_transport_fee_balance;
$student_transport_fee_paid_total11=$student_transport_fee_paid_total;
}else{
$serial_no_transport='';
$transport_name='';
$student_transport_fee_previous_balance11='';
$student_transport_fee_balance11='';
$student_transport_fee_paid_total11='';
}
// $this->Cell(10,6,''.$serial_no_transport,1,0,'C');
// $this->Cell(35,6,''.$transport_name,1,0,'L');
// $this->Cell(19,6,''.$student_transport_fee_previous_balance11,1,0,'C');
// $this->Cell(18,6,''.$student_transport_fee_paid_total11,1,0,'C');
// $this->Cell(18,6,''.$student_transport_fee_balance11,1,0,'C');
// $this->Ln();
}

if($student_previous_year_fee_paid_total!='' && $student_previous_year_fee_paid_total>0){
$position=$position+6;
$this->SetFont('Times','',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,$position);
if($student_previous_year_fee_paid_total!='' && $student_previous_year_fee_paid_total>0){
$serial_no_pre=$serial_no_transport+1;
$serial_no_pre_fee=$serial_no_pre.'.';
$pre_fee_name='Previous Year Fee Amount';
$student_previous_year_fee11=$student_previous_year_fee_balance+$student_previous_year_fee_paid_total;
$student_previous_year_fee_balance11=$student_previous_year_fee_balance;
$student_previous_year_fee_paid_total11=$student_previous_year_fee_paid_total;
}else{
$serial_no_pre_fee='';
$pre_fee_name='';
$student_previous_year_fee11='';
$student_previous_year_fee_balance11='';
$student_previous_year_fee_paid_total11='';
}
// $this->Cell(10,6,''.$serial_no_pre_fee,1,0,'C');
// $this->Cell(35,6,''.$pre_fee_name,1,0,'L');
// $this->Cell(19,6,''.$student_previous_year_fee11,1,0,'C');
// $this->Cell(18,6,''.$student_previous_year_fee_paid_total11,1,0,'C');
// $this->Cell(18,6,''.$student_previous_year_fee_balance11,1,0,'C');
// $this->Ln();
}

if($blank_field_2!=''){
$position=$position+6;
$this->SetFont('Times','',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,$position);
if($blank_field_2!=''){
$discount_name='Discount'.'('.$blank_field_1.')';
$discount_amount11=$blank_field_2;
}else{
$discount_name='';
$discount_amount11='';
}
$this->SetFont('Times','',10);
$this->SetTextColor(1,8,21);
//$this->Cell(10,6,'',1,0,'C');
//$this->Cell(35,6,''.$discount_name,1,0,'R');
//$this->Cell(57,6,'-'.$discount_amount11,1,0,'C');
//$this->Cell(30,6,''.$discount_amount11,1,0,'C');
//$this->Cell(30,6,''.$discount_amount11,1,0,'C');
//$this->Ln();
}

if($aq==1){
$monthly_fee1_total=$monthly_fee1_total+$student_transport_fee_previous_balance11+$student_previous_year_fee11;
$monthly_fee2_total=$monthly_fee2_total+$student_transport_fee_balance11+$student_previous_year_fee_balance11;
}else{
$monthly_fee1_total=$monthly_fee1_total;
$monthly_fee2_total=$monthly_fee2_total;
}


$position=$position+6;
$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position,100+$buttom_margin_1);
$this->Cell(1,7,'',0,0,'C');
$this->Cell(45,6,'Amount :',0,0,'R');
$this->SetFillColor(255,255,0);
$this->Cell(18,6,''.$monthly_fee1_total,1,0,'C',true);
$this->Cell(18,6,''.$monthly_fee2_total,1,0,'C',true);
$this->Cell(17,6,''.$monthly_fee_total,1,0,'C',true);
$this->Ln();



$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,100+$buttom_margin_1);
$this->Cell(25,10," Office Copy",1,0,"C");
$this->Cell(23,20," ",0,0,"C");
$this->Cell(30,20," Arrears",0,0,"L");
$this->SetTextColor(255,0,0);
$this->Cell(20,20,"0",0,0,"C");
$this->Ln();



$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,110+$buttom_margin_1);
$this->Cell(25,10," Received By",1,0,"C");
$this->Cell(23,10," ",0,0,"C");
$this->Cell(30,10,"Before Due Date",0,0,"L");
$this->Cell(20,10,"0",0,0,"C");
$this->Ln();

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,120+$buttom_margin_1);
$this->Cell(25,10,"",1,0,"C");
$this->Cell(23,1," ",0,0,"C");
$this->Cell(30,5,"Late Fee ",1,0,"L");
$this->Cell(20,5,"0",1,0,"C");
$this->Ln();

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,125+$buttom_margin_1);
$this->Cell(25,10,"",0,0,"C");
$this->Cell(23,1," ",0,0,"C");
$this->Cell(30,5,"After Due Date ",1,0,"L");
$this->SetFillColor(255,255,0);
$this->Cell(20,5,"0",1,0,"C",true);
$this->Ln();


$this->SetXY(52,108+$buttom_margin_1);
$this->Cell(30,5,"",1,0,"C");
$this->Cell(20,5,"",1,0,"C");

$this->SetXY(52,113+$buttom_margin_1);
$this->Cell(30,6.80,"",1,0,"C");
$this->Cell(20,6.80,"",1,0,"C");

$this->SetXY(156,108+$buttom_margin_1);
$this->Cell(30,5,"",1,0,"C");
$this->Cell(20,5,"",1,0,"C");

$this->SetXY(156,113+$buttom_margin_1);
$this->Cell(30,6.80,"",1,0,"C");
$this->Cell(20,6.80,"",1,0,"C");

$this->SetFont('Times','B',10);
$this->SetTextColor(1,8,21);
$this->SetXY($side_position1,130+$buttom_margin_1);
$this->Cell(98,7,"UN-PAID FEE Details",1,0,"L");
$this->Ln();

 $x=$side_position1;$y=123+$top_position;
    $count121=0;
    for($m=0;$m<count($fees_month);$m++)
    {
        $show_month=$fees_month[$m];
        if($monthly_fee_current_previou_month[$show_month]=='Previous')
        {
        if($count121==3)
        {
          $count121=0;        
          $x=$side_position1;  
          $y+=6;
        }    
        $show_month1=$selected_fees_generat_month[$show_month];
        $this->SetXY($x,$y);
        $this->Cell(22,6,"$show_month1 ",1,0,"C");
        $this->Cell(10.66,6,"  ".$monthly_fee_balance[$show_month],1,0,"C");
        $x=$x+32.66;
        $count121++;
        }
        
    }

$side_position=107;
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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
		$pdf->Table1();
		
$file_name="fee_receipt.pdf";
$pdf->Output('I',$file_name);
?>