<?php
include("../attachment/session.php");

$query="ALTER TABLE holiday_manage ADD holiday_date_new DATE NOT NULL AFTER holiday_date";
if(mysqli_query($conn73,$query)){
$que_res=0;	
	$query1="select * from holiday_manage";
	$run1=mysqli_query($conn73,$query1)or die(mysqli_error($conn73));
	if(mysqli_num_rows($run1)<=0){
	$que_res++;    
	}
	while($row1=mysqli_fetch_assoc($run1)){
		$s_no=$row1['s_no'];
		$holiday_date=$row1['holiday_date'];
		if($holiday_date!=''){
			$holiday_date1=explode('-',$holiday_date);
			$holiday_date2=$holiday_date1[2].'-'.$holiday_date1[1].'-'.$holiday_date1[0];
		}else{
			$holiday_date2='0000-00-00';
		}
		
		$query2="update holiday_manage set holiday_date_new='$holiday_date2' where s_no='$s_no'";
		if(mysqli_query($conn73,$query2)){
		$que_res++;
		}
	}
	if($que_res>0){
		echo "Successfully Completed !!!";
	}
}
?>