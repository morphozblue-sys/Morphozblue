<?php include("../attachment/session.php");
$id=$_GET['id'];
$query="delete from school_info_identity_category where s_no='$id'";
if(mysqli_query($conn73,$query)){
echo "<script>get_content('school_info/add_student_identity_category');</script>";
}
?>