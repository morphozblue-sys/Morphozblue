<?php include("../attachment/session.php");
  $s_no=$_POST['s_no'];
 $sport_type=$_POST['sport_type'];
 $sport_organized_date1=$_POST['sport_organized_date'];
 $sport_organized_date2=explode("-",$sport_organized_date1);
 $sport_organized_date=$sport_organized_date2[2]."-".$sport_organized_date2[1]."-".$sport_organized_date2[0];
 $sport_rank=$_POST['sport_rank'];
 
$query="update sport_certificate set sport_type='$sport_type', sport_organized_date='$sport_organized_date', sport_rank='$sport_rank',$update_by_update_sql  where s_no='$s_no'";
  

    if(mysqli_query($conn73,$query)){
		
		echo "|?|success|?|";
	}
 
  
  
?>
