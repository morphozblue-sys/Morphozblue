<?php include("../attachment/session.php");
	$class_section = $_POST['class_section'];


$que="select * from school_info_class_info where class_name='$class_section'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){

	$section = $row['section'];
	$class_code = $row['class_code'];

}
$section=$section+1;
switch ($section) {
    case 2:
        $section_value='B';
        break;
	case 3:
        $section_value='C';
        break;
	case 4:
        $section_value='D';
        break;
	case 5:
        $section_value='E';
        break;
    case 6:
        $section_value='F';
        break;
    case 7:
        $section_value='G';
        break;
    case 8:
        $section_value='H';
        break;
    case 9:
        $section_value='I';
        break;
    case 10:
        $section_value='J';
        break;
}
if($section > 10){
    echo "|?|success|?|error|?|";
    exit;
}

	try {
		$sno_res=mysqli_query($conn73,"select coalesce(max(s_no),0)+1 as nxt from class_time_table");
		$sno_row=mysqli_fetch_assoc($sno_res);
		$next_sno=(int)$sno_row['nxt'];
		$quer127="insert into class_time_table(s_no,class,section,class_code) values('$next_sno','$class_section','$section_value','$class_code')";
		mysqli_query($conn73,$quer127);
	} catch (Exception $e) { /* timetable pre-insert is optional */ }

$quer1="update school_info_class_info set section='$section',$update_by_update_sql where class_name='$class_section'";

if(mysqli_query($conn73,$quer1)){
	
	
$que121="select class,section from user_rights where designation='admin'";
$run122=mysqli_query($conn73,$que121);
while($row122=mysqli_fetch_assoc($run122)){
	$class=$row122['class'];
	$section123=$row122['section'];
	$class1=explode('|?|',$class);
	$section1=explode('|?|',$section123);
	$count=count($class1);
	$section12='';
	for($i=0;$i<$count;$i++){
		$new_section=$section1[$i];
		if($class1[$i]==$class_section){
			if($section==1){
				$new_section='A';
			}elseif($section==2){
				$new_section='A_B';
			}elseif($section==3){
				$new_section='A_B_C';
			}elseif($section==4){
				$new_section='A_B_C_D';
			}elseif($section==5){
				$new_section='A_B_C_D_E';
			}elseif($section==6){
				$new_section='A_B_C_D_E_F';
			}elseif($section==7){
				$new_section='A_B_C_D_E_F_G';
			}elseif($section==8){
				$new_section='A_B_C_D_E_F_G_H';
			}elseif($section==9){
				$new_section='A_B_C_D_E_F_G_H_I';
			}elseif($section==10){
				$new_section='A_B_C_D_E_F_G_H_I_J';
			}
     
		}
		if($i==0){
		$section12=$new_section;
		}else{
		$section12=$section12."|?|".$new_section;
		}
	}
	
}	
$quejk234="update user_rights set section='$section12',$update_by_update_sql  where designation='admin'";
mysqli_query($conn73,$quejk234);
	echo "|?|success|?|ok|?|";
}

?>