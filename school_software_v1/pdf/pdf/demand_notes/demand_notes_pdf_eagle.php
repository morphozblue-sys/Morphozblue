<?php
include("../../../admin/attachment/session.php");
include("../number_to_words.php");
require('../fpdf.php');
 $student_roll_no=$_POST['student_info'];
 $fees_month=$_POST['fees_month'];
 for($i=0;$i<count($fees_month);$i++)
 $last_month_sel=$fees_month[$i];
 $total_student=count($student_roll_no);
    $total_student1=0;
    for($s=0;$s<$total_student;$s++)
    {
    $query2="select * from student_admission_info where student_roll_no='$student_roll_no[$s]' and student_status='Active' and session_value='$session1'";
    
	$run2=mysqli_query($conn73,$query2);
	while($row2=mysqli_fetch_assoc($run2)){// print_r($row2);
	$student_name[$total_student1]=strtolower($row2['student_name']);
	$student_father_name[$total_student1]=$row2['student_father_name'];
	$student_class=$row2['student_class'];
	$student_class_section[$total_student1]=$row2['student_class_section'];
	$school_roll_no[$total_student1]=$row2['school_roll_no'];
	$student_admission_number[$total_student1]=$row2['student_admission_number'];
	$student_bus[$total_student1]=$row2['student_bus'];
	$student_father_contact_number[$total_student1]=$row2['student_father_contact_number'];
	$student_class_stream[$total_student1]=$row2['student_class_stream'];
	
	$student_photo[$total_student1]=$row2['student_image_name'];
 	$student_image[$total_student1]=$_SESSION['amazon_file_path']."student_documents/".$student_photo[$total_student1];$student_image[$total_student1]=str_replace(" ","%20",$student_image[$total_student1]);
 	if($student_photo[$total_student1]==null){
     $student_image[$total_student1]="../../../images/blank.jpg";
    }
	$total_student1++;
	}
    }
	
class PDF extends FPDF
{

// Page header
function Header()
{
  
}

// Page footer
function Footer()
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
$calculate_penalty=0;
while($row11=mysqli_fetch_assoc($run11)){
for($g=0;$g<$select_count;$g++){
$show_balance_fee=0;
for($i=0;$i<$serial_no;$i++){ 

$fee_balance1[$i] = $row11[$fee_balance[$i].$select_month[$g]];
$fee_balance_121[$select_month[$g]] =$fee_balance_121[$select_month[$g]]+$row11[$fee_balance[$i].$select_month[$g]];
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
if($fee_balance_121[$select_month[$g]]>0)
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


function Table1()
{
    
	global $student_roll_no,$fees_month,$total_student1,$last_month_sel;
	global $student_name,$student_father_name,$student_class_section,$school_roll_no,$student_admission_number,$student_bus,$student_father_contact_number,$student_class_stream,$student_photo,$student_image,$student_class;
	
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
    
    
    $que_01="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
    $run_01=mysqli_query($conn73,$que_01) or die(mysqli_error($conn73));
    $sno_1=0;
    while($row_01=mysqli_fetch_assoc($run_01)){
    $fees_code_1[$sno_1] = $row_01['fees_code'];
    if($fees_code_1[$sno_1]==$last_month_sel)
    $dues_last_date_get= $row_01['dues_last_date'];
    $sno_1++;
    }
    $date_1=date_create($dues_last_date_get);
    date_add($date_1,date_interval_create_from_date_string("1 days"));
    $date_2=date_format($date_1,"Y-m-d");
    
    
//echo $date_1;
	$que="select * from school_info_fee_types where fee_type!='' and session_value='$session1'$filter37 ORDER BY s_no DESC";
	$run=mysqli_query($conn73,$que);
	$serial_no=0;
	while($row=mysqli_fetch_assoc($run)){ 
	$fee_type5 = $row['fee_type'];
	$fee_code = $row['fee_code'];
	if($fee_type5!=''){
	$fee_type = preg_replace('/\s+/', '_', $fee_type5);
	$fee_type1[$serial_no] = $row['fee_type'];
	$fee_type=strtolower($fee_type);
	$fee_dis[$serial_no]="student_".$fee_code."_discount_amount_month";
	$fee_set[$serial_no]="student_".$fee_code."_month";
	$fee_paid[$serial_no]="student_".$fee_code."_paid_total_month";
	$fee_total111[$serial_no]="student_".$fee_code."_total_amount_after_discount_month";
	$fee_balance111[$serial_no]="student_".$fee_code."_balance_month";
	$serial_no++;
	}
	}
	
	$selected_fees_generat_month=array("01"=>"Jan", "02"=>"Feb", "03"=>"Mar", "04"=>"Apr", "05"=>"May", "06"=>"Jun", "07"=>"Jul", "08"=>"Aug", "09"=>"Septr", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");
	
	////////////////////////////////////////////////////////   penaty detail Start           
	            $que001="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
				$run001=mysqli_query($conn73,$que001) or die(mysqli_error($conn73));
				$serial_no_penalty=0;
				while($row001=mysqli_fetch_assoc($run001)){ 
				$dues_last_date_penalty[$serial_no_penalty] = $row001['dues_last_date'];
				$get_fees_month[$serial_no_penalty] = $row001['fees_code'];
				$penalty_day_monthly = $row001['penalty_day_monthly'];
				$penalty_percent_rupees_amount = $row001['penalty_percent_rupees_amount'];
				$penalty_method = $row001['penalty_method'];
				$serial_no_penalty++;
				}
				for($m=0;$m<count($fees_month);$m++)
                {
                  $show_month121=$fees_month[$m];
                }
				for($i=0;$i<$serial_no_penalty;$i++)
				{
				   if($get_fees_month[$i]==$show_month121)
				    $fees_submit_dues_date12=explode('-',$dues_last_date_penalty[$i]);
				}
				if($fees_submit_dues_date12[2].'-'.$fees_submit_dues_date12[1].'-'.$fees_submit_dues_date12[0]!='00-00-0000')
				$fees_submit_dues_date=$fees_submit_dues_date12[2].'-'.$fees_submit_dues_date12[1].'-'.$fees_submit_dues_date12[0];
	//////////////////////////////////////////////////////////  Penalty Detail Ends
	$fee_paid_months="01,02,03,04,05,06,07,08,09,10,11,12";
	$month_count121=count($get_fees_month);
	
	if($month_count121>0){
	$month_count=count($get_fees_month);
	$month1='';
	$month2='';
	for($f=0;$f<$month_count;$f++){
	
	if($get_fees_month[$f]=='01'){
	$month1=$month1.$comma.'January';
	$month2=$month2.$comma.'Installment1';
	}elseif($get_fees_month[$f]=='02'){
	$month1=$month1.$comma.'February';
	$month2=$month2.$comma.'Installment2';
	}elseif($get_fees_month[$f]=='03'){
	$month1=$month1.$comma.'March';
	$month2=$month2.$comma.'Installment3';
	}elseif($get_fees_month[$f]=='04'){
	$month1=$month1.$comma.'April';
	$month2=$month2.$comma.'Installment4';
	}elseif($get_fees_month[$f]=='05'){
	$month1=$month1.$comma.'May';
	$month2=$month2.$comma.'Installment5';
	}elseif($get_fees_month[$f]=='06'){
	$month1=$month1.$comma.'June';
	$month2=$month2.$comma.'Installment6';
	}elseif($get_fees_month[$f]=='07'){
	$month1=$month1.$comma.'July';
	$month2=$month2.$comma.'Installment7';
	}elseif($get_fees_month[$f]=='08'){
	$month1=$month1.$comma.'August';
	$month2=$month2.$comma.'Installment8';
	}elseif($get_fees_month[$f]=='09'){
	$month1=$month1.$comma.'September';
	$month2=$month2.$comma.'Installment9';
	}elseif($get_fees_month[$f]=='10'){
	$month1=$month1.$comma.'October';
	$month2=$month2.$comma.'Installment10';
	}elseif($get_fees_month[$f]=='11'){
	$month1=$month1.$comma.'November';
	$month2=$month2.$comma.'Installment11';
	}elseif($get_fees_month[$f]=='12'){
	$month1=$month1.$comma.'December';
	$month2=$month2.$comma.'Installment12';
	}
	$month_array_var[$f]=$get_fees_month[$f];
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
	
	$session12=explode('_',$session1);
	$ye=$session12[0];
    $get_currect_month_year=explode('-',date('m-Y'));
    // $get_currect_month_year=explode('-',date('12-2023'));
    $year_month_condition=1;
    $month_count121=1;
	for($k=0;$k<$month_count11;$k++)
	{
     
	  if($month_array_var[$k]==$get_currect_month_year[0] && $ye==$get_currect_month_year[1])
     $year_month_condition=0; 
	 
     if($year_month_condition==0)
	 {
	 $monthly_fee_current_previou_month[$month_array_var[$k]]='Current';
	 }
	 else
	 {
	 $monthly_fee_current_previou_month[$month_array_var[$k]]='Previous';
	 }
	 
	 if($month_array_var[$k]==12)
	 $ye=$ye+1;
	 
	}
	
	$count1=0;
	$today_date=date('d-m-Y');
	for($f=0;$f<$total_student1;$f++)
	{
	$query1="select * from common_fees_student_fee where student_roll_no='$student_roll_no[$f]' and fee_status='Active' and session_value='$session1'";
	$run1=mysqli_query($conn73,$query1);
	$monthly_fee_paid_total=0;
    $monthly_fee_set_total=0;
    $current_fee_balance_total=0;
    $current_fee_balance_total_befor_discount=0;
    $current_fee_balance_previous_total_befor_discount=0;
    $current_fee_discount_current=0;
    $current_fee_discount_previous=0;
    $previous_month_balance=0;
    $total_cur_pre_fees=0;
    $total_penaly=0;
    
	while($row1=mysqli_fetch_assoc($run1)){  
	$s_no=$row1['s_no'];
	$fee_submission_date1=$row1['fee_submission_date'];
	$fee_submission_date2 = explode("-",$fee_submission_date1);
	$fee_submission_date=$fee_submission_date2[2]."-".$fee_submission_date2[1]."-".$fee_submission_date2[0];
// 	$student_roll_no=$row1['student_roll_no'];
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
    $monthly_fee_balance_monthwise=array();
    $fees_head_monthwise=array();
    $monthly_fee_paid_total=0;
    $monthly_fee1_set_total=0;
    $monthly_fee2_balance_total=0;
	for($k=0;$k<$month_count11;$k++)
	{
	$monthly_fee_paid[$month_array_var[$k]]=0;
	$monthly_fee_after_discount[$month_array_var[$k]]=0;
	$monthly_fee_balance[$month_array_var[$k]]=0;
	$monthly_fee_set[$month_array_var[$k]]=0;
	$monthly_fee_discount[$month_array_var[$k]]=0;
	}
    
	for($j=0;$j<$serial_no;$j++){
	 $comma='';   
	for($k=0;$k<$month_count11;$k++){
	$monthly_var=$fee_paid[$j].$month_array_var[$k];
	$monthly_var1=$fee_total111[$j].$month_array_var[$k];
	$monthly_var2=$fee_balance111[$j].$month_array_var[$k];
	$monthly_var3=$fee_set[$j].$month_array_var[$k];
	
    
	$monthly_fee_paid[$month_array_var[$k]]=$monthly_fee_paid[$month_array_var[$k]]+$row1[$monthly_var];
	$monthly_fee_after_discount[$month_array_var[$k]]=$monthly_fee_after_discount[$month_array_var[$k]]+$row1[$monthly_var1];
	$monthly_fee_balance[$month_array_var[$k]]=$monthly_fee_balance[$month_array_var[$k]]+$row1[$monthly_var2];
	$monthly_fee_balance_monthwise[$month_array_var[$k]][$j]=$row1[$monthly_var2];
	if($monthly_fee_balance_monthwise[$month_array_var[$k]][$j]>0)
	{
	   if(!isset($fees_head_monthwise[$month_array_var[$k]])) 
	   $fees_head_monthwise[$month_array_var[$k]]=$fee_type1[$j]; 
	   else
	   $fees_head_monthwise[$month_array_var[$k]]=$fees_head_monthwise[$month_array_var[$k]].','.$fee_type1[$j]; 
	   
	}
    $monthly_fee_set[$month_array_var[$k]]=$monthly_fee_set[$month_array_var[$k]]+$row1[$monthly_var3];
    $monthly_fee_discount[$month_array_var[$k]]=$monthly_fee_set[$month_array_var[$k]]-$monthly_fee_after_discount[$month_array_var[$k]];
	}
	}
    
    /////////////////    Selected month fees
   
    $monthly_var='';
    $monthly_var1='';
    $monthly_var2='';
    $monthly_var3='';
	for($j=0;$j<$serial_no;$j++){
	for($c=0;$c<count($fees_month);$c++){
	if($monthly_fee_current_previou_month[$fees_month[$c]]=='Current')
    {
	$monthly_var=$fee_paid[$j].$fees_month[$c];
	$monthly_var1=$fee_total111[$j].$fees_month[$c];
	$monthly_var2=$fee_balance111[$j].$fees_month[$c];
	
	$monthly_fee_paid_total=$monthly_fee_paid_total+$row1[$monthly_var];
	$monthly_fee_set_total=$monthly_fee_set_total+$row1[$monthly_var1];
	$current_fee_balance_total=$current_fee_balance_total+$row1[$monthly_var2];
    }
    else
    {
    $monthly_var2=$fee_balance111[$j].$fees_month[$c];
        
    $previous_month_balance=$previous_month_balance+$row1[$monthly_var2];    
    }
	}
	}
	for($m=0;$m<count($fees_month);$m++)
    {
        
        $show_month=$fees_month[$m];
        if($monthly_fee_current_previou_month[$show_month]=='Current')
        {
          if($monthly_fee_balance[$show_month]>0)
          {
	      $current_fee_discount_current=$current_fee_discount_current+$monthly_fee_discount[$show_month];
          $current_fee_balance_total_befor_discount=$current_fee_balance_total_befor_discount+$monthly_fee_set[$show_month];
          }
        }
        else{
          if($monthly_fee_balance[$show_month]>0)
          {    
          $current_fee_discount_previous=$current_fee_discount_previous+$monthly_fee_discount[$show_month];
          $current_fee_balance_previous_total_befor_discount=$current_fee_balance_previous_total_befor_discount+$monthly_fee_set[$show_month];
          }
        }
    }    
	/////////////////    Selected month fees
    
	}
    
    $total_cur_pre_fees=$previous_month_balance+$current_fee_balance_total;
    $total_penaly=$this->get_penalty($fees_month,count($fees_month),$student_roll_no[$f],$date_2);
	
    $side_position=3;
    $total_curret_mon=0;
    $total_previous_mon=0;
    $total_height=0;
    $current_paid_amount=0;
    for($m=0;$m<count($fees_month);$m++)
    {
      $show_month=$fees_month[$m];     
      if($monthly_fee_current_previou_month[$show_month]=='Current' && $monthly_fee_balance[$show_month]!=0)
      {
       $current_paid_amount+=$monthly_fee_paid[$show_month];        
       $total_curret_mon++;   
      } 
      if($monthly_fee_current_previou_month[$show_month]=='Previous' && $monthly_fee_balance[$show_month]!=0)
      {
       $total_previous_mon++;   
      }
    }
    
    if(!isset($total_height1))
    {
    $total_height1=290;
    $this->AddPage();
    }
    
    if($top_position_set+($static_height+($total_curret_mon*6)+ceil($total_previous_mon/3)*6)>290)
    {
    $total_height1=290;
    $top_position_set=0;
    $this->AddPage();    
    }
   
    $this->SetFont('Times','B',20);
    $this->SetTextColor(1,8,21);
    $this->SetXY(105,4);
    $this->Ln();
    
    if(!isset($top_position_set))
    $top_position_set=0;
    $static_height=114;
    for($aq=1; $aq<=2; $aq++){
    
    $top_position=$top_position_set;
    
    $side_position1=$side_position+1;
    $total_height=0;
    $top_position1=$top_position;
    
    $this->Image($student_image[$f],77+$side_position,$top_position+38,21,21,'jpeg');
    $this->Ln();
   
    $this->SetFont('Times','B',14);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position+1,2.5);
    $this->Cell(98,21,'',1,0,"C");
    $this->Ln();
    
    $this->SetFont('Times','B',12);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position,5+$top_position);
    $this->Cell(45,0.01,'',0);
    $this->Cell(13,0.01,"FEE VOUCHER",0,0,"C");
    $this->Ln();
    
    $this->SetFont('Times','B',12);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position,7+$top_position);
    $this->Cell(2,6,'',0,0,"C");
    $this->Cell(96,6,"   ".strtoupper($school_info_school_name),0,0,"C");
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,12+$top_position);
    $this->Cell(1,6,'',0,0,"C");
    $this->Cell(96,6,''.$school_info_school_address,0,0,"C");
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,17+$top_position);
    $this->Cell(1,6,'',0,0,"C");
    $this->Cell(96,6," MOB :  ".$school_info_school_contact_no,0,0,"C");
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,24+$top_position);
    $this->Cell(1,6,'',0,0,"C");
    $this->Cell(48,6," Issue Date :  ".date('d-m-Y'),1,0,"C");
    $this->SetFillColor(255,255,0);
    $this->Cell(20,6," Month :  ",1,0,"C",true);
    $this->SetTextColor(1,8,0);
    $this->Cell(28,6," ".$selected_fees_generat_month[date('m')],1,0,"C");
    $this->SetTextColor(1,8,21);
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,31+$top_position);
    $this->Cell(1,6,'',0,0,"C");
    $this->Cell(15,6,"Ch.No. :  ",0,0,"L");
    $this->Cell(15,6," ".$serial_no,1,0,"C");
    $this->Cell(14,6," GR :  ",0,0,"C");
    $this->Cell(15,6,"".$student_admission_number[$f],1,0,"C");
    $this->Cell(14,6,"  Class :  ",0,0,"C");
    $this->Cell(23,6,"".$student_class,1,0,"C");
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,38+$top_position);
    $this->Cell(1,6,'',0,0,"C");
    $this->Cell(15,6,"Name   :  ",0,0,"L");
    $this->Cell(49,6," ".strtoupper($student_name[$f]),1,0,"L");
    $this->Cell(1,6,'',0,0,"C");
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,45+$top_position);
    $this->Cell(1,6,'',0,0,"C");
    $this->Cell(15,6,"Father  :  ",0,0,"L");
    $this->Cell(49,6," ".strtoupper($student_father_name[$f]),1,0,"L");
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,52+$top_position);
    $this->Cell(1,6,'',0,0,"C");
    $this->SetFillColor(255,255,0);
    $this->Cell(18,6,"Due Date :  ",0,0,"L");
    $this->Cell(46,6," ".$fees_submit_dues_date,1,0,"L",true);
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,60+$top_position);
    $this->Cell(45,6,"P A R T I C U L A R S",1,0,"C");
    $this->Cell(18,6,"AMT ",1,0,"C");
    $this->Cell(18,6,"Disc ",1,0,"C");
    $this->Cell(17,6,"Net Amt ",1,0,"C");
    $this->Ln();
    
    $top_position=66+$top_position;
    $total_height=66;
    for($m=0;$m<count($fees_month);$m++)
    {
        $show_month=$fees_month[$m];
        if($monthly_fee_current_previou_month[$show_month]=='Current' && $monthly_fee_balance[$show_month]!=0)
        {
        $show_month1=$selected_fees_generat_month[$show_month];
        $this->SetXY($side_position1,$top_position);
        $this->Cell(45,6,str_replace('Fee','',$fees_head_monthwise[$show_month])."($show_month1)  ",1,0,"L");
        $this->Cell(18,6," ".$monthly_fee_set[$show_month]-$monthly_fee_paid[$show_month],1,0,"C");
        $this->Cell(18,6," ".$monthly_fee_discount[$show_month],1,0,"C");
        $this->Cell(17,6," ".$monthly_fee_balance[$show_month],1,0,"C");
        $top_position=$top_position+6;
        $total_height=$total_height+6;
        }
    }
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,$top_position+2);
    $this->Cell(45,6,"Amount :",0,0,'R');
    $this->SetFillColor(255,255,0);
    $this->Cell(18,6,''.$current_fee_balance_total_befor_discount-$current_paid_amount,1,0,'C',true);
    $this->Cell(18,6,''.$current_fee_discount_current,1,0,'C',true);
    $this->Cell(17,6,''.$current_fee_balance_total,1,0,'C',true);
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,$top_position+2);
    if($aq==1)
    $this->Cell(28,10,"  Office Copy",1,0,"C");    
    else
    $this->Cell(28,10,"  Student Copy",1,0,"C");
    $this->SetXY($side_position1+48,$top_position+9);
    $this->Cell(30,6," Arrears",1,0,"L");
    $this->SetTextColor(255,0,0);
    $this->Cell(20,6,"".$previous_month_balance+$student_previous_year_fee_balance,1,0,"C");
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,$top_position+12);
    $this->Cell(28,11," Received By",1,0,"C");
    $this->Cell(20,10," ",0,0,"C");
    $this->Ln();
    $this->SetXY($side_position1+48,$top_position+15);
    $this->Cell(30,6,"Before Due Date",1,0,"L");
    $this->Cell(20,6,"".$total_cur_pre_fees+$student_previous_year_fee_balance,1,0,"C");
    $this->Ln();

    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,$top_position+23);
    $this->Cell(28,10,"",1,0,"C");
    $this->SetXY($side_position1+48,$top_position+21);
    $this->Cell(30,6,"Late Fee ",1,0,"L");
    $this->Cell(20,6,"".$total_penaly,1,0,"C");
    $this->Ln();
    
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    $this->SetXY($side_position1,$top_position+28);
    $this->Cell(28,10,"",0,0,"C");
    $this->SetXY($side_position1+48,$top_position+27);
    $this->Cell(30,6,"After Due Date ",1,0,"L");
    $this->SetFillColor(255,255,0);
    $this->Cell(20,6,"".$total_penaly+$total_cur_pre_fees+$student_previous_year_fee_balance,1,0,"C",true);
    $this->Ln();
    
    $this->SetXY($side_position1,$top_position+33);
    $this->SetFont('Times','B',10);
    $this->SetTextColor(1,8,21);
    if($student_previous_year_fee_balance!='' && $student_previous_year_fee_balance!=0)
    {
    $this->Cell(37,7,"UN-PAID FEE Details",1,0,"L");
    $this->Cell(37,7,"Previous Year Fees ",1,0,"C");
    $this->Cell(24,7,"".$student_previous_year_fee_balance,1,0,"C");
    }else
    $this->Cell(98,7,"UN-PAID FEE Details",1,0,"L");
    $this->Ln();
    
   $y=$top_position+40; 
   $count121=0;
   $x=$side_position1;
   for($m=0;$m<count($fees_month);$m++)
    {
        $show_month=$fees_month[$m];
        if($monthly_fee_current_previou_month[$show_month]=='Previous' && $monthly_fee_balance[$show_month]!=0)
        {
        if($count121==3)
        {
          $count121=0;        
          $x=$side_position1;  
          $y+=6;
        }    
        $show_month1=$selected_fees_generat_month[$show_month];
        $this->SetXY($x,$y);
        $this->Cell(22,6,"$show_month1",1,0,"C"); //
        $this->Cell(10.66,6,"  ".$monthly_fee_balance[$show_month],1,0,"C");
        $x=$x+32.66;
        $count121++;
        }
    }
    
    
    $total_height+=46+($y-($top_position+40));
    $this->SetXY($side_position,1.50+$top_position1);
    $this->Cell(100,$total_height,"",1,0,"C");    
    
    $side_position=107;
    
    }
    $top_position_set+=$total_height+2;
    $total_height1=$total_height1-($static_height+($total_curret_mon*6));
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
$pdf->SetAutoPageBreak(false);


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
		$pdf->Table1();
		
$file_name="fee_receipt.pdf";
$pdf->Output('I',$file_name);
?>