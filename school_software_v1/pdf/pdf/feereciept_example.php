<?php

require('fpdf_receipt.php');

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
    // Times 12
    $this->SetFont('Times','',12);
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
global $conn73,$school_info_school_name,$school_info_school_district,$school_info_logo,$student_name,$student_father_name,$student_class,$student_class_section,$fee_submission_date,$school_roll_no,$student_admission_fee_paid,$student_admission_fee_balance,$student_admission_fee_previous,$blank_field_5,$other_fee_amount,$other_fee_remark;
 
 for($j=0; $j<2; $j++){
 
$logo_image='../../documents/school_info/'.$school_info_logo;    
  
  
	
  
  
 
    $this->SetFont('Times','B',19);
	$this->SetTextColor(200,0,0);
    $this->Cell(0,7,"".$school_info_school_name,0,0,'C');
    $this->Ln();
	
	$this->Cell(190,1,"",0);
    $this->Ln(); 
	
    $this->SetLeftMargin(50);
    $this->SetFont('Times','B',15);
	$this->SetTextColor(200,0,0);
    $this->Cell(130,6,"DIST.  -  ".$school_info_school_district,0,0,'C');
    $this->Ln();
    
	
	$this->SetLeftMargin(116);
    $this->SetFont('Times','B',9);
	$this->SetTextColor(200,0,0);
    $this->Cell(130,0,"Receipt No.  ".$blank_field_5,0,0,'C');
    $this->Ln();
	
	$this->SetLeftMargin(10);
    $this->Cell(190,3,"",0);
    $this->Ln(); 
	
    $this->SetLeftMargin(10);
    $this->SetFont('Times','B',15);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.25);
    $this->Cell(190,0.10,"",1);
    $this->Ln();  
	

    $this->Cell(190,1,"",0);
    $this->Ln(); 
   
	$this->SetLeftMargin(10);
    $this->SetFont('Times','B',11);
	$this->SetTextColor(0,0,0);
	$this->Cell(10,5,"",0);
    $this->Cell(30,5," Name",0);
	$this->Cell(5,5,"-",0);
	$this->SetFont('Times','',11);
	$this->Cell(90,5,''.$student_name,0);
	$this->SetFont('Times','B',11);
	$this->SetTextColor(0,0,0);
    $this->Cell(18,5," Date",0);
	$this->Cell(5,5,"-",0);
	$this->SetFont('Times','',11);
	$this->Cell(20,5,''.$fee_submission_date,0);
	$this->Ln(); 
	
	

	$this->SetLeftMargin(10);
    $this->SetFont('Times','B',11);
	$this->SetTextColor(0,0,0);
	$this->Cell(10,5,"",0);
    $this->Cell(30,5," Father's Name",0);
    $this->Cell(5,5,"-",0);
	$this->SetFont('Times','',11);
	$this->Cell(90,5,''.$student_father_name,0);
	$this->SetFont('Times','B',11);
	$this->SetTextColor(0,0,0);
    $this->Cell(18,5," Class",0);
	$this->Cell(5,5,"-",0);
	$this->SetFont('Times','',11);
	$this->Cell(20,5,''.$student_class,0);
	$this->Ln(); 
	
	$this->SetLeftMargin(10);
    $this->SetFont('Times','B',11);
	$this->SetTextColor(0,0,0);
	$this->Cell(10,5,"",0);
    $this->Cell(30,5," Roll No.",0);
	$this->Cell(5,5,"-",0);
	$this->SetFont('Times','',11);
	$this->Cell(90,5,''.$school_roll_no,0);
	$this->SetFont('Times','B',11);
	$this->SetTextColor(0,0,0);
    $this->Cell(18,5," Section",0);
	$this->Cell(5,5,"-",0);
	$this->SetFont('Times','',11);
	$this->Cell(20,5,''.$student_class_section,0);
	$this->Ln(); 
	

	
	
	
	$this->Cell(190,1,"",0);
    $this->Ln(); 
	
    
	
	$this->SetLeftMargin(10);
    $this->SetFont('Times','B',12);
	$this->SetTextColor(0,0,0);
	$this->Cell(20,6,"S. No.",1,0,'C');
	$this->Cell(60,6,"FEES TYPE",1,0,'C');
	$this->Cell(45,6,"PREVIOUS BALANCE",1,0,'C');
	$this->Cell(35,6,"BALANCE",1,0,'C');
	$this->Cell(30,6,"PAID",1,0,'C');
	$this->Ln(); 

	$this->SetLeftMargin(10);
    $this->SetFont('Times','',11);
	$this->SetTextColor(0,0,0);
	$this->Cell(20,6,"1.",1);
	$this->Cell(60,6,"Penalty",1);
	$this->Cell(45,6,'',1,0,'C');
	$this->Cell(35,6,'',1,0,'C');
	$this->Cell(30,6,''.$student_admission_fee_paid,1,0,'C');
	$this->Ln();
	
    $s_no=$_GET['s_no1'];
    $medium=$_GET['medium'];
    $shift=$_GET['shift'];
    $board=$_GET['board'];
	$filter37='';
	if($medium!=''){
	$filter37=$filter37." and medium='$medium'";
	}else{
	$filter37='';
	}
	if($shift!=''){
	$filter37=$filter37." and shift='$shift'";
	}else{
	$filter37='';
	}
	if($board!=''){
	$filter37=$filter37." and board='$board'";
	}else{
	$filter37='';
	}
	
	$que="select * from school_info_fee_types where fee_type!=''$filter37";
    $total_fee_type=0;
	$run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
	while($row1=mysqli_fetch_assoc($run1)){
	$fee_type[] = $row1['fee_type'];     
	$fee_code[] = $row1['fee_code']; 
    $total_fee_type++;
    }
    
    $serial_no=1;
	for($i=0; $i<$total_fee_type; $i++){
	$serial_no++;
    $paid_fee="student_".$fee_code[$i]."_paid_total";
    $due_fee="student_".$fee_code[$i]."_balance";
    $que2="select * from fees_student_fee_add where s_no='$s_no'";
	$run2=mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
	while($row2=mysqli_fetch_assoc($run2)){
	$paid_fee1 = $row2[$paid_fee];     
	$due_fee1 = $row2[$due_fee]; 
    $paid_total = $row2['paid_total'];  
    $balance_total = $row2['balance_total'];  
      
}
    $previous_balance=$paid_fee1+$due_fee1;
    $previous_balance_total=$paid_total+$balance_total;

	$this->SetLeftMargin(10);
    $this->SetFont('Times','',11);
	$this->SetTextColor(0,0,0);
	
	 if($total_fee_type=='1' or $total_fee_type=='2' or $total_fee_type=='3' or $total_fee_type=='4'  or $total_fee_type=='5' or $total_fee_type=='6' or $total_fee_type=='7' or $total_fee_type=='8' or $total_fee_type=='9' or $total_fee_type=='10'){ 
	$this->Cell(20,5,"".$serial_no.".",1);
	$this->Cell(60,5,"".strtolower($fee_type[$i])." Fee / Year",1);
	$this->Cell(45,5,''.$previous_balance,1,0,'C');
	$this->Cell(35,5,''.$due_fee1,1,0,'C');
	$this->Cell(30,5,''.$paid_fee1,1,0,'C');
	$this->Ln();
    }else if($total_fee_type=='11' or $total_fee_type=='12'){ 
	$this->Cell(20,4,"".$serial_no.".",1);
	$this->Cell(60,4,"".strtolower($fee_type[$i])." Fee / Year",1);
	$this->Cell(45,4,''.$previous_balance,1,0,'C');
	$this->Cell(35,4,''.$due_fee1,1,0,'C');
	$this->Cell(30,4,''.$paid_fee1,1,0,'C');
	$this->Ln();
    }else{ 
	$this->Cell(20,4,"".$serial_no.".",1);
	$this->Cell(60,4,"".strtolower($fee_type[$i])." Fee / Year",1);
	$this->Cell(45,4,''.$previous_balance,1,0,'C');
	$this->Cell(35,4,''.$due_fee1,1,0,'C');
	$this->Cell(30,4,''.$paid_fee1,1,0,'C');
	$this->Ln();
}
	
	}
	
	//$this->Cell(95,6," TOTAL PREVIOUS BALANCE  -  25000.00",1);
	//$this->Cell(95,6," TOTAL DUE BALANCE  -  25000.00",1);
	
	$serial_no11=$serial_no+1;
	$this->SetLeftMargin(10);
    $this->SetFont('Times','',11);
	$this->SetTextColor(0,0,0);
	$this->Cell(20,4,"".$serial_no11.".",1);
	$this->Cell(60,4,"Other Fee",1);
	$this->Cell(45,4,'',1,0,'C');
	$this->Cell(35,4,'',1,0,'C');
	$this->Cell(30,4,''.$other_fee_amount,1,0,'C');
	$this->Ln();
	
	$this->SetLeftMargin(10);
    $this->SetFont('Times','B',11);
	$this->SetTextColor(0,0,0);
	$this->Cell(80,5,"TOTAL    ",1,0,'R');
	$this->Cell(45,5,''.$previous_balance_total,1,0,'C');
	$this->Cell(35,5,''.$balance_total,1,0,'C');
	$this->Cell(30,5,''.$paid_total,1,0,'C');
	$this->Ln(); 
	
	// $this->SetLeftMargin(10);
    // $this->SetFont('Times','B',11);
	// $this->SetTextColor(0,0,0);
	// $this->Cell(85,5,"Remark:    ",1,0,'L');
	// $this->Ln(); 
	
	if($total_fee_type=='0'){
	$this->Cell(190,60,"",0);
	}else if($total_fee_type=='1'){
	$this->Cell(190,54,"",0);
	}else if($total_fee_type=='2'){
	$this->Cell(190,48,"",0);
	}else if($total_fee_type=='3'){
	$this->Cell(190,42,"",0);
	}else if($total_fee_type=='4'){
	$this->Cell(190,36,"",0);
	}else if($total_fee_type=='5'){
	$this->Cell(190,30,"",0);
	}else if($total_fee_type=='6'){
	$this->Cell(190,24,"",0);
	}else if($total_fee_type=='7'){
	$this->Cell(190,18,"",0);
	}else if($total_fee_type=='8'){
	$this->Cell(190,12,"",0);
	}else if($total_fee_type=='9'){
	$this->Cell(190,6,"",0);
	}else if($total_fee_type=='10'){
	$this->Cell(190,0,"",0);
	}else if($total_fee_type=='11'){
	$this->Cell(190,5,"",0);
	}else if($total_fee_type=='12'){
	$this->Cell(190,0,"",0);
	}else{
	$this->Cell(190,0,"",0);
	}
    $this->Ln(); 
	
	$this->Cell(190,8.8,"",0);
    $this->Ln(); 
	
	$this->SetLeftMargin(10);
    $this->SetFont('Times','B',11);
	$this->SetTextColor(0,0,0);
	$this->Cell(18,5,"Remark:",0,0,'L');
	$this->Cell(122,5,"..................................................................................................................................",0,0,'L');
	$this->Cell(25,5,"Signature",0,0,'R');
	$this->Cell(25,7,"------------------",0);
	$this->Ln(); 
	
	$this->Cell(190,-6.5,"",0);
    $this->Ln(); 
	
	$this->SetLeftMargin(10);
    $this->SetFont('Times','B',11);
	$this->SetTextColor(0,0,0);
	$this->Cell(18,2,"",0);
	$this->Cell(95,2,"".$other_fee_remark,0);
	$this->Ln(-126); 
	
	
    $this->Cell(190,6,"",0);
    $this->Ln(); 
	
	$this->SetLeftMargin(10);
	$this->SetFont('Times','B',25);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(0.75);
    $this->Cell(190,132,"",1);
    $this->Ln();
	
	
	
   
	if($j==1){
	$this->Cell(190,0,"",0);
	}else{
	$this->Cell(190,12,"",0);
	}
    $this->Ln(); 
	
	}
		
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
$pdf->SetFont('Times','',14);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
	//  $pdf->SetLeftMargin(30);
		//$pdf->Table1();
		$pdf->SetTextColor(0,0,0);
	$pdf->Cell(18,5,"SAGAR GAIRE:",0,0,'');

		
	//	$pdf->SetLeftMargin(-30);

//$file_name="fees_receipt".$student_name."_".$student_class.".pdf";
$pdf->Output('I','hello.pdf');
?>