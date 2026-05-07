<?php include("../attachment/session.php");
	
	$que1="select * from school_info_monthly_fees where fees_type_name!='' and session_value='$session1'$filter37 ORDER BY s_no";
	$run1=mysqli_query($conn73,$que1);
	while($row1=mysqli_fetch_assoc($run1)){
	$fees_type_name[] = $row1['fees_type_name'];	
	$fees_code[] = $row1['fees_code'];
	$fees_count = $row1['fees_count'];
	}
	
	$que="select * from school_info_fee_types where fee_code!='' and session_value='$session1'$filter37";
	$run=mysqli_query($conn73,$que);
	$serial_no=0;
	while($row=mysqli_fetch_assoc($run)){
	$fee_type = $row['fee_type'];
	$fee_code = $row['fee_code'];
	if($fee_type!=''){
	$fee_type1[$serial_no] = $row['fee_type'];
	$fee[$serial_no]="student_".$fee_code."_month";
	$serial_no++;
	} }
	
	$student_total_fee_per_year=$_POST['student_total_fee_per_year'];
	$s_no=$_POST['s_no'];
	$column_name2="";
    for($i=0;$i<$serial_no;$i++){
	for($j=0;$j<$fees_count;$j++){
	$column_name1=$fee[$i].$fees_code[$j];
	$fee2[$i] = $_POST[$column_name1];
	$column_name2=$column_name2.$column_name1."="."'".$fee2[$i]."',";
	}
	}
    $quer="update common_fees_fee_structure set $column_name2 total_fee='$student_total_fee_per_year',$update_by_update_sql where session_value='$session1' and s_no='$s_no'$filter37";
    if(mysqli_query($conn73,$quer)){
	echo "|?|success|?|";
	}
    
  ?>