<?php include("../attachment/session.php");
$stream_name1 = $_POST['stream_name1'];

$que="select * from school_info_stream_info where stream_name='$stream_name1'";
$run=mysqli_query($conn73,$que) or die(mysqli_error($conn73));
while($row=mysqli_fetch_assoc($run)){

	$stream_group = $row['stream_group'];
	$stream_code = $row['stream_code'];

}
$stream_group=$stream_group+1;
switch ($stream_group) {
 case 1:
        $section_value='Group-A';
        break;
    case 2:
        $section_value='Group-B';
        break;
	case 3:
        $section_value='Group-C';
        break;
	case 4:
        $section_value='Group-D';
        break;
	case 5:
        $section_value='Group-E';
        break;
		case 6:
        $section_value='Group-F';
        break;
		case 7:
        $section_value='Group-G';
        break;
        case 8:
        $section_value='Group-H';
        break;
        case 9:
        $section_value='Group-I';
        break;
        case 10:
        $section_value='Group-J';
        break;
        case 11:
        $section_value='Group-K';
        break;
        case 12:
        $section_value='Group-L';
        break;
        case 13:
        $section_value='Group-M';
        break;
        case 14:
        $section_value='Group-N';
        break;
        case 15:
        $section_value='Group-O';
        break;
        case 16:
        $section_value='Group-P';
        break;
        case 17:
        $section_value='Group-Q';
        break;
        case 18:
        $section_value='Group-R';
        break;
        case 19:
        $section_value='Group-S';
        break;
        case 20:
        $section_value='Group-T';
        break; 
        case 21:
        $section_value='Group-U';
        break;
        
}

if($stream_group<=21){

try {
    $sno_res=mysqli_query($conn73,"select coalesce(max(s_no),0)+1 as nxt from school_info_stream_group");
    $sno_row=mysqli_fetch_assoc($sno_res);
    $next_sno=(int)$sno_row['nxt'];
    $quer127="insert into school_info_stream_group(s_no,stream_code,stream_name,group_name,session_value,$update_by_insert_sql_column)
    values('$next_sno','$stream_code','$stream_name1','$section_value','$session1',$update_by_insert_sql_value)";
    mysqli_query($conn73,$quer127);
} catch (Exception $e) { /* continue even if group row insert fails */ }

$quer1="update school_info_stream_info set stream_group='$stream_group',$update_by_update_sql  where stream_name='$stream_name1'";

if(mysqli_query($conn73,$quer1)){
echo "|?|success|?|ok|?|";
}

}else{
echo "|?|success|?|error|?|";
}
?>
