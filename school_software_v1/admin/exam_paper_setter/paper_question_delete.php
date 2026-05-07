<?php include("../attachment/session.php")?>
<?php
$id=$_GET['id'];
$p_id=$_GET['p_id'];
$language=$_GET['language'];
$que="delete from question_paper_set where s_no='$id'";
if(mysqli_query($conn73,$que)){
echo "<script>post_content('exam_paper_setter/paper_edit','id=$p_id&language=$language');</script>";
}

?>