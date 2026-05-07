<?php include("../../con73/con37.php"); 
if($_SERVER['REQUEST_METHOD'] == "POST"){
				$sql11="select defalut_session_value from school_info_general";
				$run11=mysqli_query($conn73,$sql11) or die(mysqli_error($conn73));
				while($row11=mysqli_fetch_array($run11)){
				$default_session_value=$row11['defalut_session_value']; 
				}
 $sql="SELECT session FROM  `add_session`";
$qur=mysqli_query($conn73,$sql);
$x=0;
        	while($row = mysqli_fetch_array($qur)){
        	    $session=$row['session'];
        	        	$_SESSION['session_value_array'][$x]=$session; 
        	        	$session_explode=str_replace("_","-",$session);
        	        	$x++;
?>
<option value="<?php echo $session; ?>" <?php if($session==$default_session_value){ echo  "selected"; } ?> ><?php echo $session_explode; ?></option>
<?php } }	?>
