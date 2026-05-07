<?php include("../../con73/con37.php"); 
if($_SERVER['REQUEST_METHOD'] == "POST"){
				$sql11="select school_info_school_name,school_info_logo_name from school_info_general";
				$run11=mysqli_query($conn73,$sql11) or die(mysqli_error($conn73));
				while($row11=mysqli_fetch_array($run11)){
			$school_info_school_name=$row11['school_info_school_name']; 

$school_info_logo = $_SESSION['amazon_file_path']."school_document/".$row11['school_info_logo_name'];
$_SESSION["school_info_logo_name"]=$school_info_logo;
	}
	$captcha_show = 0;
	if(($_SESSION['login_count'] ?? 0) > 5){
    $captcha_show = 1;
}

	echo "|?|".$school_info_school_name."|?|".$school_info_logo."|?|".$captcha_show;
}
				?>