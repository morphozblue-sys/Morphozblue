<?php include("../attachment/session.php");
 $s_no=$_POST['s_no'];
 $annualfee_school_name=$_POST['annualfee_school_name'];
 $annualfee_current_year_from=$_POST['annualfee_current_year_from'];
 $annualfee_current_year_to=$_POST['annualfee_current_year_to'];
 $annualfee_type=$_POST['annualfee_type'];
 $annualfee_issue_date1=$_POST['annualfee_issue_date'];
 $annualfee_issue_date2=explode("-",$annualfee_issue_date1);
 $annualfee_issue_date=$annualfee_issue_date2[2]."-".$annualfee_issue_date2[1]."-".$annualfee_issue_date2[0];
 
$query="update annualfee_certificate set annualfee_school_name='$annualfee_school_name', annualfee_current_year_from='$annualfee_current_year_from', annualfee_current_year_to='$annualfee_current_year_to', annualfee_type='$annualfee_type', annualfee_issue_date='$annualfee_issue_date',$update_by_update_sql  where s_no='$s_no'";
if(mysqli_query($conn73,$query)){
echo "|?|success|?|";
}
?>

	