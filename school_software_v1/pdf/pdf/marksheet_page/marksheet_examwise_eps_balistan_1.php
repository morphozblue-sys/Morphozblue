<?php 
    include("../../../admin/attachment/session.php");
    
    $class_name=$_GET['class'];
    $roll_no=$_GET['roll_no'];
    $student_class_stream=$_GET['student_class_stream'];
    $student_class_group=$_GET['student_class_group'];
    $exam_code="";
    
    $que4="select * from school_info_class_info where class_name='$class_name'";
    $run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
    while($row4=mysqli_fetch_assoc($run4)){
     $class_code=$row4['class_code'];
    }

    $total_student=0;
    $query2="select * from student_admission_info where student_class='$class_name' and session_value='$session1'$filter37";
    $run2=mysqli_query($conn73,$query2) or die(mysqli_error($conn73));
    while($row2=mysqli_fetch_assoc($run2)){ 
    $student_roll_no1=$row2['student_roll_no'];
    $student_roll_no[$total_student]=$student_roll_no1;
    $student_address[$student_roll_no1] = $row2['student_adress'];
    $student_date_of_Birth[$student_roll_no1] = $row2['student_date_of_birth'];
    $school_roll_no[$student_roll_no1]=$row2['student_registration_number'];
    $student_name[$student_roll_no1]=$row2['student_name'];
    $student_father_name[$student_roll_no1]=$row2['student_father_name'];
    $student_class[$student_roll_no1]=$row2['student_class'];
    $student_admission_number[$student_roll_no1]=$row2['student_admission_number'];
  
    $student_photo[$student_roll_no1]=$row2['student_image_name'];
    $student_image[$student_roll_no1]=$_SESSION['amazon_file_path']."student_documents/".$student_photo[$student_roll_no1];
    $student_image[$student_roll_no1]=str_replace(" ","%20",$student_image[$student_roll_no1]);
    $total_student++;
    }
    
    $query1="select * from school_info_general";
    $run1=mysqli_query($conn73,$query1) or die(mysqli_error($conn73));
    while($row=mysqli_fetch_assoc($run1)){
    $school_info_school_district = $row['school_info_school_district'];
	$school_info_school_name = strtoupper($row['school_info_school_name']);
	$school_info_school_district = strtoupper($school_info_school_district);
	$school_info_school_address = $row['school_info_school_address'];
    $school_info_school_city = $row['school_info_school_city'];
    $school_info_school_state =$row['school_info_school_state'];
    $school_info_principal_seal=$row['school_info_principal_seal_name'];
	$school_info_principal_signature=$row['school_info_principal_signature_name'];
	$school_info_logo=$row['school_info_logo_name'];
	$path1=$_SESSION['amazon_file_path']."school_document/".$school_info_logo;$path1=str_replace(" ","%20",$path1);
    $signature_image=$_SESSION['amazon_file_path']."school_document/".$school_info_principal_signature;$signature_image=str_replace(" ","%20",$signature_image);
    }
    
    require('../fpdf.php');
    class PDF extends FPDF
    {
       
    // Page header
    function Header()
    {
        
    }
    
    function grade($marks)
    {
         $grade='';
         if($marks>=90){
         $grade="A+";
         }else if($marks>=80){
         $grade="A";
         }else if($marks>=70){
         $grade="B";
         }else if($marks>=60){
         $grade="C";
         }else if($marks>=50){
         $grade="D";
         }else if($marks>=40){
         $grade="E";
         }else if($marks>=0){
         $grade="F";
         }
         return $grade;
    
    }
    
    // Page footer
    function Footer()
    {        
     
    }
    
    function new_array($data)
    {
     $j=1;
     for($i=0;$i<count($data);$i++)
     {
       if($data[$i]!=''){    
       $data1[$j]=str_replace(array('|','|?','?',' '),'',$data[$i]);     
       $j++;
       }
       else
       {
        $data1[$j]=$data[$j];   
       }
     }
     return $data1;
    } 
     
    function get_exam_detail()
    {
      global $session1,$conn73,$filter37,$total_exam,$exam_type2,$exam_code2,$exam_type_name,$subject,$subject_code,$subjet_category_set,$subjet_category_name,$subjet_category_index,$subjet_category_count,$student_maximum_marks,$student_minimum_marks,$exam_marks_add,$total_subject,$subject_other,$subject_code_other,$subjet_other_category_set,$subjet_other_category_name,$subjet_other_category_index,$subjet_other_category_count,$student_other_maximum_marks,$student_other_minimum_marks,$exam_other_marks_add,$total_subject_other,$subject_practical,$subject_code_practical,$subjet_practical_category_set,$subjet_practical_category_name,$subjet_practical_category_index,$subjet_practical_category_count,$student_practical_maximum_marks,$student_practical_minimum_marks,$exam_practical_marks_add,$total_subject_practical;
        
        $class_name=$_GET['class'];
        $exam_code="";
        $student_class_stream=$_GET['student_class_stream'];
        $student_class_group=$_GET['student_class_group'];
        
        
        $exam_type_condition="";
        if($exam_code!=''){
        $exam_type_condition=" and exam_code='$exam_code' ";
        }
        
        
        $que4="select * from school_info_class_info where class_name='$class_name'";
    	$run4=mysqli_query($conn73,$que4) or die(mysqli_error($conn73));
    	while($row4=mysqli_fetch_assoc($run4)){
         $class_code=$row4['class_code'];
    	}
    	
    	$que="select * from school_info_exam_types where class_code='$class_code' and session_value='$session1'$exam_type_condition$filter37";
        $total_exam=0;
        
        $run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
        while($row1=mysqli_fetch_assoc($run1)){ 
            $exam_type = $row1['exam_type'];
            $exam_type_code = $row1['exam_code'];
            if($exam_type!=''){
               $exam_type2[$total_exam] = $row1['exam_type'];
               $exam_code2[$total_exam] = $row1['exam_code'];
               $exam_type_name[$exam_type_code]=$row1['exam_type'];
               $total_exam++;
            }
        }
        
        $que="select * from school_info_subject_info where class='$class_name' and group_name='$student_class_group' and stream_name='$student_class_stream' and session_value='$session1'$filter37";
        $total_subject=0;
        $total_subject_other=0;
        $run1=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
        while($row1=mysqli_fetch_assoc($run1)){ 
        $subject_type = $row1['subject_type'];
        //////////////////////////////////         Main Subject             /////////////////////////////////////////////
        if($subject_type=='subject'){
         $subject[$total_subject] = $row1['subject_name'];
         $subject_code[$total_subject] = $row1['subject_code']; 
         
         $subjet_category_set[$total_subject]='No';
         for($i=1; $i<=10; $i++){
         $subjet_category_name1 = $row1['category'.$i];
         if($subjet_category_name1!='')
         {
         $subjet_category_name[$total_subject][] = $row1['category'.$i];
         $subjet_category_index[$total_subject][] =$i;     
         $subjet_category_count[$total_subject]+=1;  
         $subjet_category_set[$total_subject]='Yes';  
         }
         }
         if($subjet_category_set[$total_subject]=='No')
         {
         $subjet_category_count[$total_subject]=1;          
         }
         
         for($a=0;$a<$total_exam;$a++)
         { 
         $student_maximum_marks1[$a][$total_subject]=$this->new_array(explode("|?|",$row1[$exam_code2[$a]."_maximum_mark"]));
         $student_minimum_marks1[$a][$total_subject]=$this->new_array(explode("|?|",$row1[$exam_code2[$a]."_minimum_mark"]));
         $exam_marks_add1[$a][$total_subject]=$this->new_array(explode("|?|",$row1[$exam_code2[$a]."_mark_add"]));
             
          for($i=0;$i<$subjet_category_count[$total_subject];$i++)
          {
           if(in_array($i+1,$subjet_category_index[$total_subject]) or $subjet_category_set[$total_subject_other]=='No')
           {
           $student_maximum_marks[$a][$total_subject][]=$student_maximum_marks1[$a][$total_subject][$i+1];
           $student_minimum_marks[$a][$total_subject][]=$student_minimum_marks1[$a][$total_subject][$i+1];
           $exam_marks_add[$a][$total_subject][]=$exam_marks_add1[$a][$total_subject][$i+1];
           }
          }
          
         }
         $total_subject++;
        	 
        } 
        //////////////////////////////////         Other Subject            ///////////////////////////////////////////// 
        if($subject_type=='other_subject'){
        $subject_other[$total_subject_other] = $row1['subject_name'];
        $subject_code_other[$total_subject_other] = $row1['subject_code']; 
        
        $subjet_other_category_set[$total_subject_other]='No';
        for($i=1; $i<=10; $i++){
        $subjet_other_category_name1 = $row1['category'.$i];
        if($subjet_other_category_name1!='')
        {
         $subjet_other_category_name[$total_subject_other][] = $row1['category'.$i];
         $subjet_other_category_index[$total_subject_other][] =$i;     
         $subjet_other_category_count[$total_subject_other]+=1;  
         $subjet_other_category_set[$total_subject_other]='Yes';  
        }
        }
        if($subjet_other_category_set[$total_subject_other]=='No')
        {
         $subjet_other_category_count[$total_subject_other]=1;          
        }
             
        for($a=0;$a<$total_exam;$a++)
        { 
         $student_other_maximum_marks1[$a][$total_subject_other]=$this->new_array(explode("|?|",$row1[$exam_code2[$a]."_maximum_mark"]));
         $student_other_minimum_marks1[$a][$total_subject_other]=$this->new_array(explode("|?|",$row1[$exam_code2[$a]."_minimum_mark"]));
         $exam_marks_other_add1[$a][$total_subject_other]=$this->new_array(explode("|?|",$row1[$exam_code2[$a]."_mark_add"]));
         for($i=0;$i<$subjet_other_category_count[$total_subject_other];$i++)
          {
           if(in_array($i+1,$subjet_other_category_index[$total_subject_other]) or $subjet_other_category_set[$total_subject_other]=='No')
           {
            if($session1=='2023_24')
            $student_other_maximum_marks[$a][$total_subject_other][]=1;
            else
            $student_other_maximum_marks[$a][$total_subject_other][]=$student_other_maximum_marks1[$a][$total_subject_other][$i+1];
            $student_other_minimum_marks[$a][$total_subject_other][]=$student_other_minimum_marks1[$a][$total_subject_other][$i+1];
            $exam_other_marks_add[$a][$total_subject_other][]=$exam_other_marks_add1[$a][$total_subject_other][$i+1];
           }
          }
              
         }
         $total_subject_other++;
        } 
        /////////////////////////////////         Practical Subject         /////////////////////////////////////////////
        if($subject_type=='practical_subject'){
        $subject_practical[$total_subject_practical] = $row1['subject_name'];
        $subject_code_practical[$total_subject_practical] = $row1['subject_code']; 
        
        $subjet_practical_category_set[$total_subject_practical]='No';
        for($i=1; $i<=10; $i++){
        $subjet_practical_category_name1 = $row1['category'.$i];
        if($subjet_practical_category_name1!='')
        {
         $subjet_practical_category_name[$total_subject_practical][] = $row1['category'.$i];
         $subjet_practical_category_index[$total_subject_practical][] =$i;     
         $subjet_practical_category_count[$total_subject_practical]+=1;  
         $subjet_practical_category_set[$total_subject_practical]='Yes';  
        }
        }
        if($subjet_practical_category_set[$total_subject_practical]=='No')
        {
         $subjet_practical_category_count[$total_subject_practical]=1;          
        }
             
        for($a=0;$a<$total_exam;$a++)
        { 
        $student_practical_maximum_marks1[$a][$total_subject_practical]=$this->new_array(explode("|?|",$row1[$exam_code2[$a]."_maximum_mark"]));
        $student_practical_minimum_marks1[$a][$total_subject_practical]=$this->new_array(explode("|?|",$row1[$exam_code2[$a]."_minimum_mark"]));
        $exam_marks_practical_add1[$a][$total_subject_practical]=$this->new_array(explode("|?|",$row1[$exam_code2[$a]."_mark_add"]));
        for($i=0;$i<$subjet_practical_category_count[$total_subject_practical];$i++)
        {
             if(in_array($i+1,$subjet_practical_category_index[$total_subject_practical]) or $subjet_practical_category_set[$total_subject_practical]=='No')
          {
          $student_practical_maximum_marks[$a][$total_subject_practical][]=$student_practical_maximum_marks1[$a][$total_subject_practical][$i+1];
          $student_practical_minimum_marks[$a][$total_subject_practical][]=$student_practical_minimum_marks1[$a][$total_subject_practical][$i+1];
          $exam_practical_marks_add[$a][$total_subject_practical][]=$exam_practical_marks_add1[$a][$total_subject_practical][$i+1];
          }
        }
              
        }
        $total_subject_practical++;
        } 
        
        }
        
        
    }
    
    function get_student_marks($roll_no)
    {
       global $session1,$conn73,$total_exam,$exam_code2,$subject_code,$subjet_category_count,$subjet_category_index,$subjet_category_set,$total_subject,$subject_code_other,$subjet_other_category_count,$subjet_other_category_index,$subjet_other_category_set,$total_subject_other,$subject_code_practical,$subjet_practical_category_count,$subjet_practical_category_index,$subjet_practical_category_set,$total_subject_practical;
       global $subject_marks,$subject_other_marks,$subject_practical_marks;
       global $filter37,$exam_type2,$subject,$subject_code,$subjet_category_set,$subjet_category_name,$student_maximum_marks,$student_minimum_marks,$exam_marks_add,$total_subject,$subject_other,$subject_code_other,$subjet_other_category_set,$subjet_other_category_name,$student_other_maximum_marks,$student_other_minimum_marks,$exam_other_marks_add,$subject_practical,$subjet_practical_category_name,$subjet_practical_category_index,$student_practical_maximum_marks,$student_practical_minimum_marks,$exam_practical_marks_add,$subject_clear,$subject_other_clear,$subject_practical_clear;
        $que2="select * from examination where student_roll_no='$roll_no' and session_value='$session1'";
        $run2 = mysqli_query($conn73,$que2) or die(mysqli_error($conn73));
        while($row2 = mysqli_fetch_assoc($run2)){
          $subject_marks=array();
          $subject_other_marks=array();
          $subject_practical_marks=array();
          for($a=0;$a<$total_exam;$a++){
           //////////////////////////////////         Main Subject           /////////////////////////////////////////////      
           for($s1=0; $s1<$total_subject;$s1++){
             $subject_clear[$a][$s1]="Yes";  
             $exam_marks11 = $exam_code2[$a].'_'.$subject_code[$s1].'_marks'; 
             $subject_marks1 = $this->new_array(explode('|?|',$row2[$exam_marks11]));   
             for($i=0;$i<$subjet_category_count[$s1];$i++)
             {
             if(in_array($i+1,$subjet_category_index[$s1]) or $subjet_category_set[$s1]=='No')
             {
              $subject_marks[$a][$s1][]=$subject_marks1[$i+1];     
             }
             }
            }
           //////////////////////////////////         Other Subject          /////////////////////////////////////////////
           for($o1=0; $o1<$total_subject_other;$o1++){
             $subject_other_clear[$a][$o1]="Yes";  
             $exam_other_marko11 = $exam_code2[$a].'_'.$subject_code_other[$o1].'_marks'; 
             $subject_other_marko1 = $this->new_array(explode('|?|',$row2[$exam_other_marko11]));   
             for($i=0;$i<$subjet_other_category_count[$o1];$i++)
             {
             if(in_array($i+1,$subjet_other_category_index[$o1]) or $subjet_other_category_set[$o1]=='No')
             {
              $subject_other_marks[$a][$o1][]=$subject_other_marko1[$i+1];     
             }
             }
            }
          //////////////////////////////////         Practical Subject       /////////////////////////////////////////////
           for($p1=0; $p1<$total_subject_practical;$p1++){
             $subject_practical_clear[$a][$p1]="Yes";    
             $exam_practical_markp11 = $exam_code2[$a].'_'.$subject_code_practical[$p1].'_marks'; 
             $subject_practical_markp1 = $this->new_array(explode('|?|',$row2[$exam_practical_markp11]));   
             for($i=0;$i<$subjet_practical_category_count[$p1];$i++)
             {
             if(in_array($i+1,$subjet_practical_category_index[$p1]) or $subjet_practical_category_set[$p1]=='No')
             {
              $subject_practical_marks[$a][$p1][]=$subject_practical_markp1[$i+1];     
             }
             }
            }
                 
          }
          ////////////////////////////////////////////////////////
           for($e1=0;$e1<$total_exam;$e1++)
           {
            for($s1=0;$s1<$total_subject;$s1++)
            {
             for($i=0;$i<$subjet_category_count[$s1];$i++)
             {
              
              $percent=$subject_marks[$e1][$s1][$i]*100/$student_maximum_marks[$e1][$s1][$i];
              if($percent>=40)
              $subject_clear[$e1][$s1]='Yes';
              else
              $subject_clear[$e1][$s1]='No';
             }
            }
           }  
           
           ////////////////////////////////////////////////////////
           for($e1=0;$e1<$total_exam;$e1++)
           {
            for($p1=0;$p1<$total_subject_practical;$p1++)
            {
             for($i=0;$i<$subjet_practical_category_count[$p1];$i++)
             {
              //if($subject_practical_marks[$e1][$p1][$i]<$student_practical_minimum_marks[$e1][$p1][$i] || $student_practical_minimum_marks[$e1][$p1][$i]==0)
              $percent=$subject_practical_marks[$e1][$p1][$i]*100/$student_practical_maximum_marks[$e1][$p1][$i];
              if($percent>=40)
              $subject_practical_clear[$e1][$p1]='Yes';
              else
              $subject_practical_clear[$e1][$p1]='No';
             }
            }
           }  
           ////////////////////////////////////////////////////////
           {
            for($o1=0;$o1<$total_subject_other;$o1++)
            {
             for($i=0;$i<$subjet_Other_category_count[$o1];$i++)
             {
             // if($subject_other_marks[$e1][$o1][$i]<$student_other_minimum_marks[$e1][$o1][$i] || $student_other_minimum_marks[$e1][$o1][$i]==0)
             $percent=$subject_other_marks[$e1][$o1][$i]*100/$student_other_maximum_marks[$e1][$o1][$i];
              if($percent>=40)
              $subject_other_clear[$e1][$p1]='Yes';
              else
              $subject_other_clear[$e1][$p1]='No';
             }
            }
           }  
           ////////////////////////////////////////////////////////
         }
           
    }
    
    function set_student_info($student_roll)
    {
        global $school_info_school_name,$school_info_school_address,$school_info_school_district,$school_info_school_state,$student_name,$student_father_name,$student_class,$student_address,$student_date_of_Birth,$school_roll_no,$school_info_logo,$path1,$student_photo,$student_image,$student_admission_number;
        $this->Ln(-3);
        $this->SetLeftMargin(15);
         
        if($school_info_logo==null){
		$this->Image('../../../images/blank_logo.png',51,20,18);
		}else{
		$this->Image($path1,5,5,18,18,'jpeg');
	    }
	    
	     if($school_info_principal_signature==null){
		$this->Image('../../../images/blank_logo.png',107,217,20,9,'jpeg');
		}else{
		$this->Image($signature_image,107,217,20,9,'jpeg');
		} 
	    
        if($student_photo[$student_roll]==null){
		$this->Image('../../../images/blank.jpg',180,5,21,21);
		}else{
		$this->Image($student_image[$student_roll],180,5,21,21,'jpeg');
		} 
         
           
	    $this->SetLineWidth(0.35);
        $this->SetFont('Times','B',19);
	    $this->Cell(-10);
	    $this->Cell(200,7,"".$school_info_school_name.' EPS',0,0,'C');
        $this->Ln();
    	
    	$this->SetFont('Times','B',10);
    	$this->Cell(-10);
    	$this->Cell(190,6,''.$school_info_school_address.','.$school_info_school_district.'('.$school_info_school_state.')',0,0,'C');
    	$this->Ln();
    	$this->SetFont('Times','B',14);
    	$this->Cell(-10);
    	$this->Cell(200,4,' REPORT CARD',0,1,'C');
    	$this->Cell(-10);
    	$this->Cell(200,-4,' _______________',0,0,'C');
    	$this->Ln();	
    	
    	$this->Cell(267,8,"",0);
        $this->Ln();
        
        $this->Cell(-10);
    	$this->SetFont('Times','B',10);
    	$this->Cell(15,6,"Name",0);
    	$this->Cell(5,6," :-",0);
    	$this->SetFont('Times','',10);
    	$this->SetTextColor(0,0,0);
    	$this->Cell(40,6,''.$student_name[$student_roll],0);
    	$this->SetFont('Times','B',10);
    	$this->Cell(25,6,"Father's Name",0);
    	$this->Cell(5,6," :-",0);
    	$this->SetTextColor(0,0,0);
    	$this->SetFont('Times','',10);
    	$this->Cell(40,6,''.$student_father_name[$student_roll],0);
    	$this->SetFont('Times','B',10);
    	$this->Cell(10,6,"Class",0);
    	$this->Cell(5,6," :-",0);
    	$this->SetTextColor(0,0,0);
    	$this->SetFont('Times','',10);
    	$this->Cell(60,6,''.$student_class[$student_roll],0);
    	$this->Ln();
    	
    	$this->Cell(-10); 
    	$this->SetFont('Times','B',10);
    	$this->Cell(15,6,"Address",0);
    	$this->Cell(5,6," :-",0);
    	$this->SetTextColor(0,0,0);
    	$this->SetFont('Times','',10);
    	$this->Cell(110,6,''.$student_address[$student_roll],0);
    	$this->SetFont('Times','B',10);
    	$this->Cell(10,6,"DOB",0);
    	$this->Cell(5,6," :-",0);
    	$this->SetTextColor(0,0,0);
    	$this->SetFont('Times','',10);
    	$this->Cell(20,6,''.$student_date_of_Birth[$student_roll],0);
    	$this->SetFont('Times','B',10);
    	$this->Cell(5,6,"ID",0);
    	$this->Cell(5,6," :-",0);
    	$this->SetTextColor(0,0,0);
    	$this->SetFont('Times','',10);
    	$this->Cell(60,6,''.$student_admission_number[$student_roll],0);
    	$this->Ln(7);    
    }
    
    
    function marksheet_design_1()
    {
        
    global $session1,$school_info_school_name,$school_info_principal_signature,$filter37,$signature_image,$school_info_school_district,$student_name,$student_class,$student_roll_no,$school_roll_no,$student_father_name,$exam_type_statement,$school_info_logo,$student_photo,$student_id_generate,$path1,$school_info_school_address, $school_info_school_city,$school_info_school_state,$student_address,$student_date_of_Birth,$conn73;
    global $session1,$filter37,$total_exam,$exam_type2,$exam_code2,$exam_type_name,$subject,$subject_code,$subjet_category_set,$subjet_category_name,$subjet_category_index,$subjet_category_count,$student_maximum_marks,$student_minimum_marks,$exam_marks_add,$total_subject,$subject_other,$subject_code_other,$subjet_other_category_set,$subjet_other_category_name,$subjet_other_category_index,$subjet_other_category_count,$student_other_maximum_marks,$student_other_minimum_marks,$exam_other_marks_add,$total_subject_other,$subject_practical,$subject_code_practical,$subjet_practical_category_set,$subjet_practical_category_name,$subjet_practical_category_index,$subjet_practical_category_count,$student_practical_maximum_marks,$student_practical_minimum_marks,$exam_practical_marks_add,$total_subject_practical;
    global $subject_marks,$subject_other_marks,$subject_practical_marks,$subject_clear,$subject_other_clear,$subject_practical_clear;
        
        $exam_code="";
        $exam_name_show='Final Exam';
        if(isset($exam_code) && $exam_code!='')
        $exam_name_show=$exam_type_name[$exam_code];
//          $this->Cell(-11);
// 		 $this->SetFont('Times','B',11.5); 
// 		 $this->SetTextColor(0,0,0);
// 		 $this->Cell(48,7,"RESULT",1,0,'C');
// 		 $this->Cell(110,7,"".strtoupper($exam_name_show),1,0,'C');
// 		 $this->Cell(42,7,'ACADEMIC SCORE',1,0,'C');
// 		 $this->Ln();
		 
		          $exam_code=$_GET['exam_type'];
       
         
         $exam_name_show='Final Exam';
         if(isset($exam_code))
         {
          $exam_name_show=$exam_type_name[$exam_code];
         }
         
         
         $result123 = strstr($session1, '_', true);
		
		 $this->Cell(-11);
		 $this->SetFont('Times','B',11); 
		 $this->SetTextColor(0,0,0);
		 $this->Cell(56,15,"".strtoupper("Subject Name"),1,0,'C');
		 $this->Cell(144,7,"".strtoupper($exam_name_show )." ".$result123,1,0,'C');
		 $this->Ln();
        
         $this->Cell(-11);
         $this->Cell(56,8,"",0,0,'C');
         $exam_adust=36/$total_exam;
        //  for($e1=0;$e1<$total_exam;$e1++)
        //  {
         $this->Cell(28.8,8,"Minimum",1,0,'C');
         $this->Cell(28.8,8,"Maximum",1,0,'C');
         $this->Cell(28.8,8,"Obtain",1,0,'C');
         $this->Cell(28.8,8,"%",1,0,'C');
         $this->Cell(28.8,8,"Result",1,0,'C');
        //  }
         $this->Ln();
         if($total_subject!=0)
         {
             $final_obtain=0;
             $final_maximum=0;
             $final_minimum=0;
             $adjust=65/$total_subject;
             $final_result="CLEAR";
             $min_marks=array();
             $max_marks=array();
             $obt_marks=array();
             for($s1=0;$s1<$total_subject;$s1++)
             {
              $result_subject_cat_wise[$s1]="CLEAR";     
              $total_maximum_subjectwise[$s]=0;      
              $total_minimun_subjectwise[$s]=0;      
              $total_obtain_subjectwise[$s]=0;      
              for($e1=0;$e1<$total_exam;$e1++)
              {
               for($i=0;$i<count($student_maximum_marks[$e1][$s1]);$i++)
               {
               $min_marks[$s1][$i]=$min_marks[$s1][$i]+$student_minimum_marks[$e1][$s1][$i]; 
               $max_marks[$s1][$i]=$max_marks[$s1][$i]+$student_maximum_marks[$e1][$s1][$i];
               $obt_marks[$s1][$i]=$obt_marks[$s1][$i]+$subject_marks[$e1][$s1][$i];
               }
               
              }
              
              
              
              //////////////////////////////////////////////////////////////////////new marksheet degine//////////////////////////////////////////////////
              
              
              
              

         
         

              
              
              /////////////////////////////////  Maximum Marks  Start      ///////////////////////
              $this->Cell(-11);
              $this->SetFont('Times','B',8);
            //   $this->Cell(10,4,"".$s1+1,1,0,'C');
              $this->SetFont('Times','B',8);
              $this->Cell(56,8,"".$subject[$s1],1,0,'C');
              $cate_adj=64.3/count($max_marks[$s1]);
              for($cat=0;$cat<count($max_marks[$s1]);$cat++)
              {
              
             
            //   $this->Cell($cate_adj,8,"".$max_marks[$s1][$cat],1,0,'C');   
              $total_maximum_subjectwise[$s1]+=$max_marks[$s1][$cat];
              }  
              
                  for($cat=0;$cat<count($min_marks[$s1]);$cat++)
              {
              
             
           
              $total_minimun_subjectwise[$s1]+=$min_marks[$s1][$cat];
              }  
              
             
               for($cat=0;$cat<count($max_marks[$s1]);$cat++)
              {
            //   $this->Cell($cate_adj,8,"",0,0,'C');   
            //   $this->Cell($cate_adj,4,"".$obt_marks[$s1][$cat],1,0,'C');   
              $total_obtain_subjectwise[$s1]+=$obt_marks[$s1][$cat];
              }  
           $this->SetFont('Times','B',9);
              $subject_per[$s1]=$total_obtain_subjectwise[$s1]*100/$total_maximum_subjectwise[$s1];
            //   $this->Cell(10,6,"".round($subject_per[$s1]),1,0,'C');
              if($subject_per[$s1]<40)
              $result_subject_cat_wise[$s1]="NOT CLEAR";
              $this->SetFont('Times','B',9);
            //   $this->Cell(38,6,"".$result_subject_cat_wise[$s1],1,0,'C');
            //   $this->Ln(); 
              ///////////////////////////////////  Rsult Section  End     ///////////////////////
              if($result_subject_cat_wise[$s1]=='NOT CLEAR')
              $final_result=$result_subject_cat_wise[$s1];  
              
              $this->Cell(28.8,8,''.$total_minimun_subjectwise[$s1],1,0,'C'); 
              $this->Cell(28.8,8,''.$total_maximum_subjectwise[$s1],1,0,'C'); 
              $this->Cell(28.8,8,''.$total_obtain_subjectwise[$s1],1,0,'C'); 
              $this->Cell(28.8,8,''.round($subject_per[$s1],2),1,0,'C'); 
              $this->Cell(28.8,8,''.$result_subject_cat_wise[$s1],1,0,'C'); 
            //   $this->Ln(); 
              ///////////////////////////////////  Maximum Marks  End      ///////////////////////
              
              
              
              
              
              
              
              
              ///////////////////////////////////  OBTAINED Marks  Start      ///////////////////////
            //   $this->Cell(-11);
            //   $this->Cell(10,4,"%",1,0,'C');
            //   $this->SetFont('Times','B',8); 
            //   $this->Cell(38,8,"",0,0,'C');
            //   for($cat=0;$cat<count($max_marks[$s1]);$cat++)
            //   {
            //   $this->Cell($cate_adj,8,"",0,0,'C');   
            // //   $this->Cell($cate_adj,4,"".$obt_marks[$s1][$cat],1,0,'C');   
            //   $total_obtain_subjectwise[$s1]+=$obt_marks[$s1][$cat];
            //   }   
            //   $this->Cell(11.6,8,'',0,0,'C'); 
            //   $this->Cell(11.6,4,''.$total_obtain_subjectwise[$s1],1,0,'C'); 
            //   $this->Ln(); 
              ///////////////////////////////////  OBTAINED Marks  End     ///////////////////////
              
              
              
              
              
              
              
              
              ///////////////////////////////////  Rsult Section  Start     ///////////////////////
            //   $this->Cell(-11);
              $this->SetFont('Times','B',9);
              $subject_per[$s1]=$total_obtain_subjectwise[$s1]*100/$total_maximum_subjectwise[$s1];
            //   $this->Cell(10,6,"".round($subject_per[$s1]),1,0,'C');
              if($subject_per[$s1]<40)
              $result_subject_cat_wise[$s1]="NOT CLEAR";
              $this->SetFont('Times','B',9);
            //   $this->Cell(38,6,"".$result_subject_cat_wise[$s1],1,0,'C');
            //   $this->Ln(); 
              ///////////////////////////////////  Rsult Section  End     ///////////////////////
              if($result_subject_cat_wise[$s1]=='NOT CLEAR')
              $final_result=$result_subject_cat_wise[$s1];  
              
            //   $this->Cell(38,2,"",0,0,'C');
              $this->Ln(); 
              
             }
              $final_minimum=array_sum($min_marks);
              $final_maximum=array_sum($total_maximum_subjectwise);
              $final_obtain=array_sum($total_obtain_subjectwise);
             
         }
         else
         {
                 
         }
         
         $this->SetFont('Times','B',11); 
         $this->SetY(201);
         $this->Cell(-11);
		 $this->Cell(48,6,'GENERAL SCORE',1,0,'C');
		 $this->Cell(15,6,'T.S',1,0,'C');
		 $this->Cell(15,6,'O.S',1,0,'C');
		 $this->Ln();
		 $this->SetFont('Times','B',9); 
		 if($total_subject_other!=0)
		 {
		  $final_other_max=0;   
		  $final_other_obt=0;   
		  $adjust1=60/$total_subject_other;   
		  for($o1=0;$o1<$total_subject_other;$o1++)
		  {
		    $total_max_marks_other_subjectwise[$o1]=0;    
		    $total_obt_marks_other_subjectwise[$o1]=0;    
		    $this->Cell(-11);
		    $this->Cell(10,$adjust1,"".$o1+1,1,0,"C");
		    $this->Cell(38,$adjust1,"".$subject_other[$o1],1,0,"C");
		    for($e1=0;$e1<$total_exam;$e1++)
		    {
		      $total_max_marks_other_subjectwise[$o1]+=array_sum($student_other_maximum_marks[$e1][$o1]);
              $total_obt_marks_other_subjectwise[$o1]+=array_sum($subject_other_marks[$e1][$o1]);    
		    }
		    $this->Cell(15,$adjust1,"".$total_max_marks_other_subjectwise[$o1],1,0,"C");
		    $this->Cell(15,$adjust1,"".$total_obt_marks_other_subjectwise[$o1],1,0,"C");
		    $final_other_max+=$total_max_marks_other_subjectwise[$o1];
            $final_other_obt+=$total_obt_marks_other_subjectwise[$o1];   
		    $this->Ln(); 
		  }
		  $this->Cell(-11);
		  $this->SetFont('Times','B',11); 
		  $this->Cell(48,6,'TOTAL SCORE',1,0,'C');
		  $this->Cell(15,6,''.$final_other_max,1,0,'C');
		  $this->Cell(15,6,''.$final_other_obt,1,0,'C');
		  $this->Ln();
		 }
         
         $overll_final_obt=$final_obtain+$final_other_obt;
         $overll_final_max=$final_other_max+$final_maximum;
         $final_per=round($overll_final_obt*100/$overll_final_max,2);
         if($final_result=='CLEAR')
         $final_grade=$this->grade($final_per);
         $this->SetFont('Times','',11);
		 $this->SetXY(90,201);
		 $this->Cell(50,72,'',1,0,'C');
		 $this->Ln(1);
		 $this->Cell(75);
		 $this->Cell(50,7,'Print Date : '.date('d-m-y'),0,0,'C');
		 $this->Ln(14);
		 $this->Cell(75);
		 $this->Cell(50,7,'Principal',0,0,'L');
		 $this->Ln(15);
		 $this->Cell(75);
		 $this->Cell(50,0.2,'',1,0,'L');
		 $this->Ln(22);
		 $this->Cell(75);
		 $this->Cell(50,7,'This is computer generated',0,0,'C');
		 $this->Ln(5);
		 $this->Cell(75);
		 $this->Cell(50,7,'report. Please let us know if',0,0,'C');
		 $this->Ln(5);
		 $this->Cell(75);
		 $this->Cell(50,7,'there are any errors.',0,0,'C');
		 
		 $this->SetFont('Times','B',11);
		 $this->SetXY(148,201);
		 $this->Cell(55,72,'',1,0,'C');
		 $this->Ln(0);
		 $this->Cell(133);
		 $this->Cell(55,8,'FINAL RESULT',1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->SetFont('Times','B',8);
		 $this->Cell(40,10,'TOTAL ACADEMIC SCORE',1,0,'R'); 
		 $this->Cell(15,10,''.$final_obtain,1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->Cell(40,10,'TOTAL GENERAL SCORE',1,0,'R'); 
		 $this->Cell(15,10,''.$final_other_obt,1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->Cell(40,10,'TOTAL OBTAINED SCORE',1,0,'R'); 
		 $this->Cell(15,10,''.$overll_final_obt,1,0,'C'); 
		 $this->Ln();

		 $this->Cell(133);
		 $this->Cell(40,10,'TOTAL SCORE',1,0,'R'); 
		 $this->Cell(15,10,''.$overll_final_max,1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->Cell(40,10,'PERCENTAGE',1,0,'R'); 
		 $this->Cell(15,10,''.$final_per.'%',1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 $this->Cell(40,7,'RESULT',1,0,'C'); 
		 $this->Cell(15,7,'GRADE',1,0,'C'); 
		 $this->Ln();
		 $this->Cell(133);
		 if($final_result=='CLEAR')
		 {
// 		 $this->SetTextColor(0,200,0); 
         $this->SetFont('Times','B',9);
		 $this->Cell(40,7,''.$final_result,1,0,'C'); 
		 $this->Cell(15,7,''.$final_grade,1,0,'C'); 
		 }
		 else
		 {
		 $this->SetFont('Times','B',8);    
// 		 $this->SetTextColor(200,0,0);    
		 $this->Cell(40,7,''.$final_result,1,0,'C'); 
		 $this->Cell(15,7,'',1,0,'C');    
		 }
    }    
    
    }
    
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetAutoPageBreak(false);
    $roll_no=$_GET['roll_no'];
    $class_name=$_GET['class'];
    $session1=$_GET['session1'];
    $section1=$_GET['section'];
    $student_class_stream=$_GET['student_class_stream'];
    $student_class_group=$_GET['student_class_group'];
    $section_conidtion="";
    if($section1!="All"){
        $section_conidtion="and student_class_section='$section1'";
    }
    if(isset($_GET['roll_no'])){
     $query2="select * from student_admission_info where student_class='$class_name' and student_roll_no='$roll_no' and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$filter37";   
    }
    else
    {
     $query2="select * from student_admission_info where student_class='$class_name' $section_conidtion and student_class_group='$student_class_group' and student_class_stream='$student_class_stream' and student_status='Active' and session_value='$session1'$filter37";   
    }
    
    $run2=mysqli_query($conn73,$query2) or die(mysql_error($conn73));
    while($row2=mysqli_fetch_assoc($run2)){
    $student_roll_no_array[]=$row2['student_roll_no'];
    }
    //////-----------------------------//////
    $pdf->get_exam_detail();
    for($s1=0;$s1<count($student_roll_no_array);$s1++)
    {
     $pdf->AddPage('P');     
     $student_roll=$student_roll_no_array[$s1];
     $pdf->set_student_info($student_roll);
     $pdf->get_student_marks($student_roll);
     $pdf->marksheet_design_1();
    }
    //////----------------------------//////
    $file_name="marksheet_".$student_name."_".$student_class.".pdf";
    $pdf->Output('I',$file_name);
?>