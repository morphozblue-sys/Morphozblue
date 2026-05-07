<?php include("../attachment/session.php")?>
<?php
$emp_id=$_GET['id'];

$que22="select * from employee_info where emp_id='$emp_id'";
$run22=mysqli_query($conn73,$que22) or die(mysqli_error($conn73));
while($row22=mysqli_fetch_assoc($run22)){
	    $emp_name=$row22['emp_name'];
	    $emp_id=$row22['emp_id'];
		$emp_address=$row22['emp_address'];
		$emp_mobile=$row22['emp_mobile'];
		$emp_designation=$row22['emp_designation'];
	}
    if(mysqli_num_rows($run22)>0){
	echo $emp_name."|?|".$emp_address."|?|".$emp_mobile."|?|".$emp_id."|?|".$emp_designation;
	}
	
    
?>