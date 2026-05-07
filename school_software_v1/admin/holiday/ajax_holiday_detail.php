<?php include("../attachment/session.php");
$date_1 = $_GET['holiday'];
$date_2 = explode("-",$date_1);
$date=$date_2[2]."-".$date_2[1]."-".$date_2[0];
$exist=0;
				$query="select * from holiday_manage where holiday_date='$date'";
				$run=mysqli_query($conn73,$query) or die (mysqli_error($conn73));
				$serial_no=0;
				while($row=mysqli_fetch_assoc($run)){
				    $exist=$row['holiday_name'];
				} 
				echo $exist;
					  ?>