<?php include("../attachment/session.php")?>
<?php
$exp_session_year=explode('_',$session1);
$exp_session_year1=$exp_session_year[0];
$exp_session_year2=$exp_session_year[0]+1;

$roll=$_GET['id'];
$que15="select * from student_admission_info where student_status='Active' and student_roll_no='$roll' and session_value='$session1'";
$run15=mysqli_query($conn73,$que15) or die(mysqli_error($conn73));
$num=0;
while($row=mysqli_fetch_assoc($run15)){
                         $s_no=$row['s_no'];
						 $student_roll_no=$row['student_roll_no'];
						 $student_name=$row['student_name'];
						 $student_class=$row['student_class'];
						 $student_class_section=$row['student_class_section'];
						 $student_father_name=$row['student_father_name'];
						 $student_mother_name=$row['student_mother_name'];
						 $student_date_of_birth=$row['student_date_of_birth'];
						 $student_date_of_birth_in_word=$row['student_date_of_birth_in_word'];
						 $student_religion=$row['student_religion'];
						 $student_category=$row['student_category'];
						 $student_sssmid_number=$row['student_sssmid_number'];
						 $student_date_of_admission=$row['student_date_of_admission'];
						 $student_admission_number=$row['student_admission_number'];
						 $student_religion=$row['student_religion'];
						 $student_adhar_number=$row['student_adhar_number'];
						 $school_roll_no=$row['school_roll_no'];
						 $student_admission_class=$row['student_admission_class'];
						 //}
						 
						 //start attendance
						 

    $total_attendance=0;
    $total_present=0;
    $select_month="04,05,06,07,08,09,10,11,12,01,02,03";
    $exp_select_month=explode(',',$select_month);
    $exp_count=count($exp_select_month);
    for($ab=0; $ab<$exp_count; $ab++){
    
    $query01="select * from student_attendance where attendance_roll_no='$student_roll_no' and session_value='$session1' and month='$exp_select_month[$ab]'";
    $res01=mysqli_query($conn73,$query01) or die(mysqli_error($conn73));
    while($row01=mysqli_fetch_assoc($res01)){
    $year=$row01['year'];
    $month=$row01['month'];
    if(($month=='04' && $year==$exp_session_year1) || ($month=='06' && $year==$exp_session_year1) || ($month=='07' && $year==$exp_session_year1) || ($month=='08' && $year==$exp_session_year1) || ($month=='09' && $year==$exp_session_year1) || ($month=='10' && $year==$exp_session_year1) || ($month=='11' && $year==$exp_session_year1) || ($month=='12' && $year==$exp_session_year1) || ($month=='01' && $year==$exp_session_year2) || ($month=='02' && $year==$exp_session_year2) || ($month=='03' && $year==$exp_session_year2)){
    $complete_date=$year.'-'.$exp_select_month[$ab].'-01';
    $number = date(' t ', strtotime($complete_date) );
    
    $day_name = date(' N ', strtotime($complete_date) );
    $day_diff=8-$day_name;
    
    
    
    
        for($i=1;$i<=$number;$i++){
        
        if($i<10){
        $x='0'.$i;
        $a=$row01['0'.$i];
        $b=$a;
        }else{
        $x=$i;
        $a=$row01[$i];
        $b=$a;
        }
        
        if($i==$day_diff || $i==$day_diff+7 || $i==$day_diff+14 || $i==$day_diff+21 || $i==$day_diff+28){
        $a="S";
        }
        $date3=$x.'-'.$exp_select_month[$ab].'-'.$year;
        $que6="select * from holiday_manage where holiday_date='$date3'";
        $result=mysqli_query($conn73,$que6) or die(mysqli_error($conn73));
        while($row5=mysqli_fetch_assoc($result)){
        $a="H";
        }
        
        if($a!='S' && $a!='H'){
        $total_attendance=$total_attendance+1;
        }
        
        if($a=='P'){
        $total_present=$total_present+1;
        }elseif($a=='P/2'){
        $total_present=$total_present+0.5;
        }
        }
    
    
    
    
    }
    }
    //exit();
    }
	
}						 
						 
						 //end attendence
    if(mysqli_num_rows($run15)>0){
    $num=1;	
	//echo $total_attendance."|?|".$total_present;
	echo $student_name."|?|".$student_class."|?|".$student_class_section."|?|".$student_father_name."|?|".$student_mother_name."|?|".$student_date_of_birth."|?|".$student_date_of_birth_in_word."|?|".$student_sssmid_number."|?|".$student_date_of_admission."|?|".$student_admission_number."|?|".$student_roll_no."|?|".$student_admission_class."|?|".$student_class."|?|".$student_adhar_number."|?|".$student_category."|?|".$num."|?|".$total_attendance."|?|".$total_present."|?|".$s_no;
	}
?>