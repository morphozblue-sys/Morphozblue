<?php include("../attachment/session.php"); ?>  
<?php
$stream_name = $_GET['stream_name'];

$query="select * from school_info_stream_group where stream_name='$stream_name'";
$result=mysqli_query($conn73,$query);
echo "<option value=All>All</option>";	
while($row=mysqli_fetch_assoc($result)){
$group_name = $row['group_name'];
echo "<option value=".$group_name.">".$group_name."</option>";
}
?>