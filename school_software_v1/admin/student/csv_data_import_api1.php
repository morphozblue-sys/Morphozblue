<?php include("../attachment/session.php");
include('php-excel-reader/excel_reader2.php');
include('php-excel-reader/SpreadsheetReader.php');
 $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
 $database1=$_SESSION['database_name'];

	
	   $que11="select * from login ";
       $run11=mysqli_query($conn73,$que11) or die(mysqli_error($conn73));
       while($row11=mysqli_fetch_assoc($run11)){
       $class_roll=$row11['student_id_generate'];	   
       $student_id_generate=$row11['student_id_generate'];	   
	   }
	   
	  

				$session=$_POST['session'];
  if(in_array($_FILES["csv_file"]["type"],$allowedFileType)){

        $targetPath = 'php-excel-reader/uploads/'.$database1."_".$_FILES['csv_file']['name'];
        move_uploaded_file($_FILES['csv_file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
$p=0;
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            $first_line_skip=1;
            foreach ($Reader as $line)
            {
					
		
			if($first_line_skip==1){
				$head_count=count($line);
				$p=0;
				
			for($j=1;$j<$head_count;$j++){
			$head_value=$line[$j];
		
				 $head_value1=explode('_',$head_value);
				 $head_value1_count=count($head_value1);
				 if($head_value1_count>1){
			$column_name[$j]=$line[$j];
			}else{
			$skip_value[$p]=$line[$j];
			$p++;
			echo $line[$j]."  Not a Valid Column";
			}
			}
             $first_line_skip=0;
			 }else{
       ////////////////////////////////////////////////////
	   $m=0;
	   $b=0;
	   $v=0;
	   $update_where1='';
	   $update_where2='';
	   $update_where3='';
	   $condition_column='student_status';
	   $condition_value="'Active'";
	    $update_condition_value="student_status='Active'";
	   $final_where_update='';
	   		   $update_que_column="session_value='".$session."'";
				$insert_que_value="'".$session."'";
				$insert_que_column="session_value";
	    for($i=1;$i<$head_count;$i++){
	        $m=0;
				 for($n=0;$n<$p;$n++){
				 if($skip_value[$n]==$i){
				 $m=1;
				 }
				 }
				 if($m==0){

				 switch ($column_name[$i]) {
    case 'student_gender':
         $line[$i]=get_gender($line[$i]);
        break;
    case 'student_class':
         $line[$i]=get_class_value($line[$i]);
        break;
    case 'student_category':
         $line[$i]=get_category($line[$i]);
        break;
    case 'student_religion':
         $line[$i]=get_religion($line[$i]);
        break;
    case 'student_date_of_birth':
         $line[$i]=date_of_birth($line[$i]);
         if( $line[$i]!=''){
		 $student_date_of_birth_in_word=datetoword($line[$i]);
		 $update_condition_value=",student_date_of_birth_in_word ='".$student_date_of_birth_in_word."'";
		 $condition_column=$condition_column.",student_date_of_birth_in_word";
		 $condition_value=$condition_value.",'".$student_date_of_birth_in_word."'";
         }
		 $update_where2="student_date_of_birth ='".$line[$i]."'";
		$b++;
        break;
    case 'student_date_of_admission':
         $line[$i]=date_of_admission($line[$i]);
        break;
    case 'student_father_contact_number':
        $condition_column=$condition_column.",student_password,student_sms_contact_number";
		$condition_value=$condition_value.",'$line[$i]','$line[$i]'";
		 $update_condition_value=",student_password ='".$line[$i]."',student_sms_contact_number ='".$line[$i]."'";
        break;
    case 'student_name':
        $b++;
		$update_where1="student_name ='".$line[$i]."'";
        break;
     case 'student_father_name':
       $update_where3="student_father_name ='".$line[$i]."'";
		$b++;
        break;
    case 'student_class_section':
			$v++;
        break;
   if($v==0){
    $condition_column=$condition_column.",student_class_section";
	$condition_value=$condition_value.",'A'";
	$update_condition_value=",student_class_section ='A'";
   }
    
}
				 
				 
					 $insert_que_column=$insert_que_column.",".$column_name[$i];
					 $insert_que_value=$insert_que_value.",'".$line[$i]."'";
					 $update_que_column=$update_que_column.",".$column_name[$i]."='".$line[$i]."'";
		
					
					}
					}
					
					 if($update_where1!='' or $update_where2!='' or $update_where3!=''){
					 	   $final_where_update="where 1='1'";
					 }
					 if($update_where1!=''){
					 $final_where_update=$final_where_update."and ".$update_where1;
					 }
					if($update_where2!=''){
					 $final_where_update=$final_where_update."and ".$update_where2;
					 }
					  if($update_where3!=''){
					 $final_where_update=$final_where_update."and ".$update_where3;
					 }
		  	 
		 //////////////////////////////////////////////////////
        $c=0;     
if($b>1){
     echo    $prevQuery = "SELECT s_no FROM student_admission_info $final_where_update";
                $prevResult =mysqli_query($conn73,$prevQuery);
		$c=mysqli_num_rows($prevResult);
}
                if($c>0){
	$update_que="UPDATE student_admission_info SET $update_que_column $final_where_update";
                    mysqli_query($conn73,$update_que);
					
                }else{
                    	    $class_roll=$class_roll+1;
	   $student_id_generate=$student_id_generate+1;
	  
    if($class_roll<10)
    {
    $class_roll_new="0000".$class_roll;
    } else if($class_roll<100)
    {
    $class_roll_new="000".$class_roll;
    }
	else if($class_roll<1000)
    {
    $class_roll_new="00".$class_roll;
    }
	else if($class_roll<10000)
    {
    $class_roll_new="0".$class_roll;
    }
    $y=date("Y")-2000;
    $student_roll_no=$y.$class_roll_new;
      
     echo    $insert_que="INSERT INTO school_info_rfid_card (student_roll_no,student_id_generate,stuent_old_or_new,rfid_no,$insert_que_column,$condition_column) VALUES ('$student_roll_no','$student_id_generate','Old','yes',$insert_que_value,$condition_value)";
    //  echo    $insert_que="INSERT INTO student_admission_info (student_roll_no,student_id_generate,stuent_old_or_new,registration_final,$insert_que_column,$condition_column) VALUES ('$student_roll_no','$student_id_generate','Old','yes',$insert_que_value,$condition_value)";
					 mysqli_query($conn73,$insert_que);
                }
            
             
        }
		}
         }
		  $quer12="update login set student_id_generate='$student_id_generate'";
    mysqli_query($conn73,$quer12);
    echo "Data Successfully Updated";
  }
  else
  { 
      echo  $type = "error";
       echo $message = "Invalid File Type. Upload Excel File.";
  }
  
  
  
   function get_gender($student_gender){
      $student_gender=strtolower($student_gender);
		 if($student_gender=='male' or $student_gender=='m' or $student_gender=='boy'){
		 $gender_final='Male';
		 }else  if($student_gender=='female' or $student_gender=='f' or $student_gender=='girl'){
		 $gender_final='Female';
		 }else{
		  $gender_final=$student_gender;
		 }
		 return $gender_final;
  }
   function get_class_value($student_class){
             $student_class=strtolower($student_class);
   		 if($student_class=='nursery' or $student_class=='nur' ){
		 $class_final='NURSERY';
		 }else if($student_class=='lkg'or $student_class=='kg1' or $student_class=='kg-1' or $student_class=='kg 1'){
		 $class_final='LKG';
		 }else if($student_class=='ukg' or $student_class=='kg2' or $student_class=='kg-2' or $student_class=='kg 2'){
		  $class_final='UKG';
		 }else if($student_class=='1st' or $student_class=='first'or $student_class=='one' or$student_class=='1'or $student_class=='1 st'){
		  $class_final='1ST';
		 }else if($student_class=='2nd' or $student_class=='second'or $student_class=='two' or$student_class=='2'or $student_class=='2 nd'){
		  $class_final='2ND';
		 }else if($student_class=='3rd' or $student_class=='third'or $student_class=='three' or$student_class=='3'or $student_class=='3 rd'){
		  $class_final='3RD';
		 }else if($student_class=='4th' or $student_class=='fourth'or $student_class=='four' or $student_class=='4'or $student_class=='4 th'){
		  $class_final='4TH';
		 }else if($student_class=='5th' or $student_class=='fifth'or $student_class=='five' or $student_class=='5'or $student_class=='5 th'){
		  $class_final='5TH';
		 }else if($student_class=='6th' or $student_class=='sixth'or $student_class=='six' or $student_class=='6'or $student_class=='6 th'){
		  $class_final='6TH';
		 }else if($student_class=='7th' or $student_class=='seventh'or $student_class=='seven' or $student_class=='7'or $student_class=='7 th'){
		  $class_final='7TH';
		 }else if($student_class=='8th' or $student_class=='eighth'or $student_class=='eight' or $student_class=='8'or $student_class=='8 th'){
		  $class_final='8TH';
		 }else if($student_class=='9th' or $student_class=='ninth'or $student_class=='nine' or $student_class=='9'or $student_class=='9 th'){
		  $class_final='9TH';
		 }else if($student_class=='10th' or $student_class=='tenth'or $student_class=='ten' or $student_class=='10'or $student_class=='10 th'){
		  $class_final='10TH';
		 }else if($student_class=='11th' or $student_class=='eleventh'or $student_class=='eleven' or $student_class=='11'or $student_class=='11 th'){
		  $class_final='11TH';
		 }else if($student_class=='12th' or $student_class=='twelveth'or $student_class=='twelve' or $student_class=='12'or $student_class=='12 th'){
		  $class_final='12TH';
		 }else{
		 $class_final=$student_class;
		 }
		 return $class_final;
   }
   function get_category($student_category){
            $student_category=strtolower($student_category);
   if($student_category=='general' or $student_category=='gen' or $student_category=='gene' or $student_category=='g'){
		$student_category_final='General';
		 }else if($student_category=='obc' or $student_category=='o'){
		$student_category_final='OBC';
		 }else if($student_category=='sc'){
		$student_category_final='SC';
		 }else if($student_category=='st'){
		$student_category_final='ST';
		 }else if($student_category=='other'){
		$student_category_final='Other';
		 }else{
		 $student_category_final=$student_category;
		 }
		 return $student_category_final;
  }
   function get_religion($student_religion){
      $student_religion=strtolower($student_religion);
		 if($student_religion=='hindu' or $student_religion=='hin' or $student_religion=='h'){
		$student_religion_final='Hindu';
		 }else if($student_religion=='muslim' or $student_religion=='mus' or $student_religion=='m'){
		$student_religion_final='Muslim';
		 }else if($student_religion=='sikh'  or $student_religion=='s'){
		$student_religion_final='Sikh';
		 }else if($student_religion=='jain'  or $student_religion=='j'){
		$student_religion_final='Jain';
		 }else if($student_religion=='christian'  or $student_religion=='c' or $student_religion=='chirst'){
		$student_religion_final='Christian';
		 }else if($student_religion=='buddh'  or $student_religion=='budh' or $student_religion=='b'){
		$student_religion_final='Buddh';
		 }else if($student_religion=='other'  or $student_religion=='o'){
		$student_religion_final='Other';
		 }else{
		 $student_religion_final=$student_religion;
		 }
		 return  $student_religion_final;
	}
   function date_of_birth($dob){
	 $dob_dash=explode('-',$dob);
	 $dob_dash_count=count($dob_dash);
	 $dob_slash=explode('/',$dob);
	 $dob_slash_count=count($dob_slash);
	 $dob_under_score=explode('_',$dob);
	 $dob_under_score_count=count($dob_under_score);
	 $dob_comma=explode(',',$dob);
	 $dob_comma_count=count($dob_comma);
	  $dob_final='';
	 if($dob_dash_count>1){

	 if($dob_dash[0]>1900){
	 $dob_final=$dob_dash;
	 }else if($dob_dash[2]>1900){
	 $dob_final=$dob_dash[2]."-".$dob_dash[1]."-".$dob_dash[0];
	 }else{
	     if($dob_dash[2]>40 && $dob_dash[2]< 99){
	          $dob_final='19'.$dob_dash[2]."-".$dob_dash[1]."-".$dob_dash[0];
	     }else if($dob_dash[2]<=40){
	         $dob_final='20'.$dob_dash[2]."-".$dob_dash[1]."-".$dob_dash[0]; 
	     }else{
	 $dob_final='';
	     }
	 }
	 }else if($dob_slash_count>1){
	 if($dob_slash[0]>1900){
	$dob_final=$dob_slash[0]."-".$dob_slash[1]."-".$dob_slash[2];
	 }else if($dob_slash[2]>1900){
	 $dob_final=$dob_slash[2]."-".$dob_slash[1]."-".$dob_slash[0];
	 }else{
	   if($dob_slash[2]>40 && $dob_slash[2]< 99){
	          $dob_final='19'.$dob_slash[2]."-".$dob_slash[1]."-".$dob_slash[0];
	     }else if($dob_slash[2]<=40){
	         $dob_final='20'.$dob_slash[2]."-".$dob_slash[1]."-".$dob_slash[0]; 
	     }else{
	  $dob_final='';
	     }
	 }
	 }else if($dob_under_score_count>1){
	 if($dob_under_score[0]>1900){
	 $dob_final=$dob_under_score;
	 }else if($dob_under_score[2]>1900){
	 $dob_final=$dob_under_score[2]."-".$dob_under_score[1]."-".$dob_under_score[0];
	 }else{
	   if($dob_under_score[2]>40 && $dob_under_score[2]< 99){
	          $dob_final='19'.$dob_under_score[2]."-".$dob_under_score[1]."-".$dob_under_score[0];
	     }else if($dob_under_score[2]<=40){
	         $dob_final='20'.$dob_under_score[2]."-".$dob_under_score[1]."-".$dob_under_score[0]; 
	     }else{
	 $dob_final='';
	     }
	 }
	 }else if($dob_comma_count>1){
	 if($dob_comma[0]>1900){
	 $dob_final=$dob_comma;
	 }else if($dob_comma[2]>1900){
	 $dob_final=$dob_comma[2]."-".$dob_comma[1]."-".$dob_comma[0];
	 }else{
	
   if($dob_comma[2]>40 && $dob_comma[2]< 99){
	          $dob_final='19'.$dob_comma[2]."-".$dob_comma[1]."-".$dob_comma[0];
	     }else if($dob_comma[2]<=40){
	         $dob_final='20'.$dob_comma[2]."-".$dob_comma[1]."-".$dob_comma[0]; 
	     }else{
	  $dob_final='';
	     }
	 }
	 }else{
	 $dob_final='';
	 }
if($dob_final!=''){
     $dob_dash1=explode('-',$dob_final);
	 $dob_dash_count1=strlen($dob_dash1[1]);
	 $dob_dash_count2=strlen($dob_dash1[2]);
	 if($dob_dash_count1<1){
	    $dob_dash1[1]='0'.$dob_dash1[1];
	 }
	  if($dob_dash_count2<1){
	    $dob_dash1[2]='0'.$dob_dash1[2];
	 }
	 $dob_final=$dob_dash1[0]."-".$dob_dash1[1]."-".$dob_dash1[2]; 
}

  return $dob_final;
  
  }
   function date_of_admission($doa){
	 $doa_dash=explode('-',$doa);
	 $doa_dash_count=count($doa_dash);
	 $doa_slash=explode('/',$doa);
	 $doa_slash_count=count($doa_slash);
	 $doa_under_score=explode('_',$doa);
	 $doa_under_score_count=count($doa_under_score);
	 $doa_comma=explode(',',$doa);
	 $doa_comma_count=count($doa_comma);
	  $doa_final='';
	 if($doa_dash_count>1){

	 if($doa_dash[0]>1900){
	 $doa_final=$doa_dash;
	 }else if($doa_dash[2]>1900){
	 $doa_final=$doa_dash[2]."-".$doa_dash[1]."-".$doa_dash[0];
	 }else{
	     if($doa_dash[2]>40 && $doa_dash[2]< 99){
	          $doa_final='19'.$doa_dash[2]."-".$doa_dash[1]."-".$doa_dash[0];
	     }else if($doa_dash[2]<=40){
	         $doa_final='20'.$doa_dash[2]."-".$doa_dash[1]."-".$doa_dash[0]; 
	     }else{
	 $doa_final='';
	     }
	 }
	 }else if($doa_slash_count>1){
	 if($doa_slash[0]>1900){
	$doa_final=$doa_slash[0]."-".$doa_slash[1]."-".$doa_slash[2];
	 }else if($doa_slash[2]>1900){
	 $doa_final=$doa_slash[2]."-".$doa_slash[1]."-".$doa_slash[0];
	 }else{
	   if($doa_slash[2]>40 && $doa_slash[2]< 99){
	          $doa_final='19'.$doa_slash[2]."-".$doa_slash[1]."-".$doa_slash[0];
	     }else if($doa_slash[2]<=40){
	         $doa_final='20'.$doa_slash[2]."-".$doa_slash[1]."-".$doa_slash[0]; 
	     }else{
	  $doa_final='';
	     }
	 }
	 }else if($doa_under_score_count>1){
	 if($doa_under_score[0]>1900){
	 $doa_final=$doa_under_score;
	 }else if($doa_under_score[2]>1900){
	 $doa_final=$doa_under_score[2]."-".$doa_under_score[1]."-".$doa_under_score[0];
	 }else{
	   if($doa_under_score[2]>40 && $doa_under_score[2]< 99){
	          $doa_final='19'.$doa_under_score[2]."-".$doa_under_score[1]."-".$doa_under_score[0];
	     }else if($doa_under_score[2]<=40){
	         $doa_final='20'.$doa_under_score[2]."-".$doa_under_score[1]."-".$doa_under_score[0]; 
	     }else{
	 $doa_final='';
	     }
	 }
	 }else if($doa_comma_count>1){
	 if($doa_comma[0]>1900){
	 $doa_final=$doa_comma;
	 }else if($doa_comma[2]>1900){
	 $doa_final=$doa_comma[2]."-".$doa_comma[1]."-".$doa_comma[0];
	 }else{
	
   if($doa_comma[2]>40 && $doa_comma[2]< 99){
	          $doa_final='19'.$doa_comma[2]."-".$doa_comma[1]."-".$doa_comma[0];
	     }else if($doa_comma[2]<=40){
	         $doa_final='20'.$doa_comma[2]."-".$doa_comma[1]."-".$doa_comma[0]; 
	     }else{
	  $doa_final='';
	     }
	 }
	 }else{
	 $doa_final='';
	 }
if($doa_final!=''){
     $doa_dash1=explode('-',$doa_final);
	 $doa_dash_count1=strlen($doa_dash1[1]);
	 $doa_dash_count2=strlen($doa_dash1[2]);
	 if($doa_dash_count1<1){
	    $doa_dash1[1]='0'.$doa_dash1[1];
	 }
	  if($doa_dash_count2<1){
	    $doa_dash1[2]='0'.$doa_dash1[2];
	 }
	 $doa_final=$doa_dash1[0]."-".$doa_dash1[1]."-".$doa_dash1[2]; 
}
  return $doa_final;
  
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
function datetoword($date){
$date1=explode('-',$date);
$dd=$date1[2];
$mm=$date1[1];
$yy=$date1[0];

 $dd1=date2($dd);
 $mm1=month($mm);
 $yy1=year($yy);
$datetoword1=$dd1." ".$mm1." ".$yy1;
return $datetoword1;
}
function date2($x){

switch($x){
case 1:$y="First";break;
case 2:$y="Second";break;
case 3:$y="Third";break;
case 4:$y="Fourth";break;
case 5:$y="Fifth";break;
case 6:$y="Sixth";break;
case 7:$y="Seventh";break;
case 8:$y="Eighth";break;
case 9:$y="Ninth";break;
case 10:$y="Tenth";break;
case 11:$y="Eleventh";break;
case 12:$y="Twelfth";break;
case 13:$y="Thirteenth";break;
case 14:$y="Fourteenth";break;
case 15:$y="Fifteenth";break;
case 16:$y="Sixteenth";break;
case 17:$y="Seventeenth";break;
case 18:$y="Eighteenth";break;
case 19:$y="Nineteenth";break;
case 20:$y="Twentieth";break;
case 21:$y="Twenty First";break;
case 22:$y="Twenty Second";break;
case 23:$y="Twenty Third";break;
case 24:$y="Twenty Fourth";break;
case 25:$y="Twenty Fifth";break;
case 26:$y="Twenty Sixth";break;
case 27:$y="Twenty Seventh";break;
case 28:$y="Twenty Eighth";break;
case 29:$y="Twenty Ninth";break;
case 30:$y="Thirtieth";break;
case 31:$y="Thirty First";break;
}
return $y;
}
function month($a){
if($a=='08'){
$a=13;
}
if($a=='09'){
$a=14;
}
switch($a){
case 01:$b="January";break;
case 02:$b="February";break;
case 03:$b="March";break;
case 04:$b="April";break;
case 05:$b="May";break;
case 06:$b="June";break;
case 07:$b="July";break;
case 13:$b="August";break;
case 14:$b="September";break;
case 10:$b="October";break;
case 11:$b="November";break;
case 12:$b="December";break;
}
return $b;
}
function year($c){

  $m=intval($c/100);
  $j=intval($m*100);
  $n=intval($c-$j);
  $o=intval($n/10);
  $i=intval($o*10);
  $s=intval($n-$i);

$p='';
if($m==19){
 $p="Ninteen Hundred";
}
if($m==20){
 $p="Two Thousand";
}

if ($n >19){
switch($o){
case 2:$q="Twenty";break;
case 3:$q="Thirty";break;
case 4:$q="Fourty";break;
case 5:$q="Fifty";break;
case 6:$q="Sixty";break;
case 7:$q="Seventy";break;
case 8:$q="Eigthy";break;
case 9:$q="Ninety";break;
}

switch($s){
case 0:$t="";break;
case 1:$t="One";break;
case 2:$t="Two";break;
case 3:$t="Three";break;
case 4:$t="Four";break;
case 5:$t="Five";break;
case 6:$t="Six";break;
case 7:$t="Seven";break;
case 8:$t="Eight";break;
case 9:$t="Nine";break;

}
$f=$q." ".$t;
}
else
{
switch($n){
case 0:$u="";break;
case 1:$u="One";break;
case 2:$u="Two";break;
case 3:$u="Three";break;
case 4:$u="Four";break;
case 5:$u="Five";break;
case 6:$u="Six";break;
case 7:$u="Seven";break;
case 8:$u="Eight";break;
case 9:$u="Nine";break;
case 10:$u="Ten";break;
case 11:$u="Eleven";break;
case 12:$u="Twelve";break;
case 13:$u="Thirteen";break;
case 14:$u="Fourteen";break;
case 15:$u="Fifteen";break;
case 16:$u="Sixteen";break;
case 17:$u="Seventeen";break;
case 18:$u="Eighteen";break;
case 19:$u="Nineteen";break;

}
$f=$u;
}
$e=$p." ".$f;
return $e;
}
   
