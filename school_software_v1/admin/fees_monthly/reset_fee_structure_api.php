<?php include("../attachment/session.php");
	
	$qry="select * from school_info_general";
	$rest=mysqli_query($conn73,$qry);
	while($row22=mysqli_fetch_assoc($rest)){
	$fees_type=$row22['fees_type'];
	}
	if($fees_type=='installmentwise'){
	$show_var='Set Fee Installments';
	}elseif($fees_type=='monthly'){
	$show_var='Set Fee Months';
	}else{
	$show_var='';
	}
	$table_var="school_info_".$fees_type."_fees";
	
    $fees_type_name = $_POST['fees_type_name'];
	
	$query13="update $table_var set fees_type_name='',fees_count='',$update_by_update_sql where session_value='$session1'$filter37";
	mysqli_query($conn73,$query13);
	$count11=count($fees_type_name);
	$final_rest=0;
	for($u=0;$u<$count11;$u++){
	$fees_type_name1=explode('|?|',$fees_type_name[$u]);
	$s_no=$fees_type_name1[0];
	$fees_type_name2=$fees_type_name1[1];
	
	$query12="update $table_var set fees_type_name='$fees_type_name2',fees_count='$count11',$update_by_update_sql where s_no='$s_no' and session_value='$session1'$filter37";
	if(mysqli_query($conn73,$query12)){
		$final_rest++;
	}
	}
	if($final_rest>0){		
	echo "|?|success|?|";
	}
  ?>