<?php include("../attachment/session.php");
	
    $fees_type_code = $_POST['fees_type_code'];
    $dues_last_date = $_POST['dues_last_date'];
    
    $penalty_percent_rupees_amount = $_POST['penalty_percent_rupees_amount'];
    $penalty_method = $_POST['penalty_method'];
    $penalty_day_monthly = $_POST['penalty_day_monthly'];
    
    $count=count($fees_type_code);
	$final_rest=0;
	for($u=0;$u<$count;$u++){
	$query12="update school_info_monthly_transport_fees set penalty_day_monthly='$penalty_day_monthly',dues_last_date='$dues_last_date[$u]',penalty_percent_rupees_amount='$penalty_percent_rupees_amount',penalty_method='$penalty_method',$update_by_update_sql where fees_type_code='$fees_type_code[$u]' and session_value='$session1'$filter37";
	if(mysqli_query($conn73,$query12)){
		$final_rest++;
	}
	}
	if($final_rest>0){		
	echo "|?|success|?|";
	}
  ?>